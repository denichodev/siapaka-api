<?php

namespace App\Services;

use App\Procurement;

class ProcurementService
{
  public function get()
  {
    return Procurement::get();
  }

  // public function create(array $data)
  // {
  //   $procurement = Procurement::create([
  //     'supplier_id' => $data['supplier_id'],
  //     'staff_id' => $data['staff_id'],
  //     'status' => $data['status'],
  //   ]);

  //   return $procurement;
  // }

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

  // public function delete($id)
  // {
  //   $procurement = $this->find($id);

  //   $procurement->delete();

  //   return $procurement->refresh();
  // }
}
