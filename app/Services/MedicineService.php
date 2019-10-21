<?php

namespace App\Services;

use App\Medicine;

class MedicineService
{
  public function get()
  {
    return Medicine::with(['meds_type', 'meds_category'])->get();
  }

  public function getMinimal()
  {
    return Medicine::whereRaw('medicine.curr_stock < medicine.min_stock')->get();
  }

  public function create(array $data)
  {
    $medicine = Medicine::create([
      'name' => $data['name'],
      'price' => $data['price'],
      'meds_type_id' => $data['meds_type_id'],
      'meds_category_id' => $data['meds_category_id'],
      'factory' => $data['factory'],
      'curr_stock' => $data['curr_stock'],
      'min_stock' => $data['min_stock'],
    ]);

    return $medicine;
  }

  public function find($id)
  {
    return Medicine::with(['meds_type', 'meds_category'])->findOrFail($id);
  }

  public function update($id, array $data)
  {
      $medicine = $this->find($id);

      $medicine->update([
        'name' => $data['name'],
        'price' => $data['price'],
        'meds_type_id' => $data['meds_type_id'],
        'meds_category_id' => $data['meds_category_id'],
        'factory' => $data['factory'],
        'curr_stock' => $data['curr_stock'],
        'min_stock' => $data['min_stock'],
      ]);

      return $medicine->refresh();
  }

  public function delete($id)
  {
    $medicine = $this->find($id);

    $medicine->delete();

    return $medicine->refresh();
  }
}
