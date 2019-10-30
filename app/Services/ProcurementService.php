<?php

namespace App\Services;

use App\Procurement;
use App\Medicine;
use App\ProcurementMedicine;
use App\UnverifiedMedicine;
use App\Services\ProcurementMedicineService;
use App\Services\UnverifiedMedicineService;
use Log;

class ProcurementService
{
  public function get()
  {
    return Procurement::with('unverified_medicines')->get();
  }

  public function create(array $data)
  {
    $procurement = Procurement::create([
      'supplier_id' => $data['supplier_id'],
      'staff_id' => $data['staff_id'],
      'status' => $data['status'],
      'order_date' => $data['order_date'],
    ]);

    $id = $procurement->id;

    foreach($data['medicines'] as $data) {
      if (strpos($data['medicineId'], 'baru') !== false) {
        UnverifiedMedicine::create([
          'procurement_id' => $id,
          'meds_type_id' => $data['medsTypeId'],
          'meds_category_id' => $data['medsCategoryId'],
          'name' => $data['name'],
          'price' => $data['price'],
          'factory' => $data['factory'],
          'min_stock' => $data['minStock'],
          'qty' => $data['qty'],
          'qty_type' => $data['qtyType'],
        ]);
      } else {
        ProcurementMedicine::create([
          'procurement_id' => $id,
          'medicine_id' => $data['medicineId'],
          'qty' => $data['qty'],
          'qty_type' => $data['qtyType']
        ]);
      }
    }

    return $procurement->refresh();
  }

  public function find($id)
  {
    return Procurement::with(['unverified_medicines', 'medicines', 'medicines.medicine'])->findOrFail($id);
  }

  public function verify($id, array $data)
  {
      $procurement = $this->find($id);

      $procurement->update([
        'status' => 'VERIFIED',
      ]);

      foreach($data['medicines'] as $data) {
        if (strpos($data['medicineId'], 'baru') !== false) {
          UnverifiedMedicine::create([
            'procurement_id' => $procurement->id,
            'meds_type_id' => $data['medsTypeId'],
            'meds_category_id' => $data['medsCategoryId'],
            'name' => $data['name'],
            'price' => $data['price'],
            'factory' => $data['factory'],
            'min_stock' => $data['minStock'],
            'qty' => $data['qty'],
            'qty_type' => $data['qtyType'],
          ]);
        } else {
          if ($data['unverified']  == true) {
            $unverifiedMedicine = UnverifiedMedicine::findOrFail($data['dbId']);

            $unverifiedMedicine->update([
              'meds_type_id' => $data['medsTypeId'],
              'meds_category_id' => $data['medsCategoryId'],
              'name' => $data['name'],
              'price' => $data['price'],
              'factory' => $data['factory'],
              'min_stock' => $data['minStock'],
              'qty' => $data['qty'],
              'qty_type' => $data['qtyType'],
            ]);
          } else {
            $procurementMedicine = ProcurementMedicine::findOrFail($data['dbId']);

            $procurementMedicine->update([
              'procurement_id' => $id,
              'medicine_id' => $data['medicineId'],
              'qty' => $data['qty'],
              'qty_type' => $data['qtyType']
            ]);
          }
        }
      }

      return $procurement->refresh();
  }

  public function retrieve($id)
  {
    $procurement = $this->find($id);

    if ($procurement->status !== 'VERIFIED') {
      return $procurement->refresh();
    }

    $procurement->update([
      'status' => 'DONE',
    ]);

    $procurement->unverified_medicines->each(function($item) {
      $sumMultiplier = 0;

      if ($item['meds_type_id'] === 'TABLET') {
        if ($item['qty_type'] === 'CARTON') {
          $sumMultiplier = 1000;
        } else {
          $sumMultiplier = 100;
        }
      } else if ($item['meds_type_id'] === 'SYRUP') {
        if ($item['qty_type'] === 'CARTON') {
          $sumMultiplier = 100;
        } else {
          $sumMultiplier = 10;
        }
      } else {
        if ($item['qty_type'] === 'CARTON') {
          $sumMultiplier = 10000;
        } else {
          $sumMultiplier = 1000;
        }
      };

      Medicine::create([
        'name' => $item['name'],
        'price' => $item['price'],
        'meds_type_id' => $item['meds_type_id'],
        'meds_category_id' => $item['meds_category_id'],
        'factory' => $item['factory'],
        'curr_stock' => $item['qty'] * $sumMultiplier,
        'min_stock' => $item['qty'] * $sumMultiplier,
      ]);
    });

    $procurement->medicines->each(function($item) {
      $sumMultiplier = 0;

      if ($item['meds_type_id'] === 'TABLET') {
        if ($item['qty_type'] === 'CARTON') {
          $sumMultiplier = 1000;
        } else {
          $sumMultiplier = 100;
        }
      } else if ($item['meds_type_id'] === 'SYRUP') {
        if ($item['qty_type'] === 'CARTON') {
          $sumMultiplier = 100;
        } else {
          $sumMultiplier = 10;
        }
      } else {
        if ($item['qty_type'] === 'CARTON') {
          $sumMultiplier = 10000;
        } else {
          $sumMultiplier = 1000;
        }
      };

      $medicine = $item->medicine()->get()->first();

      $oldMedicine = Medicine::with(['meds_type', 'meds_category'])->findOrFail($medicine->id);

      $oldMedicine->update([
        'curr_stock' => ($item['qty'] * $sumMultiplier) + $oldMedicine->curr_stock,
      ]);
    });

    return $procurement->refresh();
  }

  public function decline($id, array $data)
  {
      $procurement = $this->find($id);

      $procurement->update([
        'status' => $data['status'],
      ]);

      return $procurement->refresh();
  }

  public function delete($id)
  {
    $procurement = $this->find($id);
    $procurement->medicines()->delete();
    $procurement->unverified_medicines()->delete();

    $procurement->delete();

    return $procurement->refresh();
  }
}
