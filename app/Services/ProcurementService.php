<?php

namespace App\Services;

use App\Procurement;
use App\ProcurementMedicine;
use App\UnverifiedMedicine;
use App\Services\ProcurementMedicineService;
use App\Services\UnverifiedMedicineService;
use Log;

class ProcurementService
{
  public function get()
  {
    return Procurement::get();
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
    return Procurement::findOrFail($id);
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
