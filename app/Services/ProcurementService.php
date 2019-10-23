<?php

namespace App\Services;

use App\Procurement;
use App\ProcurementMedicine;
use App\UnverifiedMedicine;
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

  // public function update($id, array $data)
  // {
  //     $procurement = $this->find($id);

  //     $procurement->update([
  //       'name' => $data['name'],
  //       'price' => $data['price'],
  //       'meds_type_id' => $data['meds_type_id'],
  //       'meds_category_id' => $data['meds_category_id'],
  //       'factory' => $data['factory'],
  //       'curr_stock' => $data['curr_stock'],
  //       'min_stock' => $data['min_stock'],
  //     ]);

  //     return $procurement->refresh();
  // }

  public function delete($id)
  {
    $procurement = $this->find($id);
    $procurement->medicines()->delete();
    $procurement->unverified_medicines()->delete();

    $procurement->delete();

    return $procurement->refresh();
  }
}
