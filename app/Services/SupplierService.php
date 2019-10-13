<?php

namespace App\Services;

use App\Supplier;

class SupplierService
{
  public function get()
  {
    return Supplier::get();
  }

  public function create(array $data)
  {
    $supplier = Supplier::create([
      'name' => $data['name'],
      'address' => $data['address'],
      'phone_no' => $data['phone_no'],
    ]);

    return $supplier;
  }

  public function find($id)
  {
    return Supplier::findOrFail($id);
  }

  public function update($id, array $data)
  {
      $supplier = $this->find($id);

      $supplier->update([
          'name' => $data['name'],
          'address' => $data['address'],
          'phone_no' => $data['phone_no'],
      ]);

      return $supplier->refresh();
  }

  public function delete($id)
  {
    $supplier = $this->find($id);

    $supplier->delete();

    return $supplier->refresh();
  }
}
