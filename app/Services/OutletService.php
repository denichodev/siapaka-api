<?php

namespace App\Services;

use App\Outlet;

class OutletService
{
  public function get()
  {
    return Outlet::get();
  }

  public function create(array $data)
  {
    $outlet = Outlet::create([
      'name' => $data['name'],
      'address' => $data['address'],
      'phone_no' => $data['phone_no'],
    ]);

    return $outlet;
  }

  public function find($id)
  {
    return Outlet::findOrFail($id);
  }

  public function update($id, array $data)
  {
      $outlet = $this->find($id);

      $outlet->update([
          'name' => $data['name'],
          'address' => $data['address'],
          'phone_no' => $data['phone_no'],
      ]);

      return $outlet->refresh();
  }

  public function delete($id)
  {
    $outlet = $this->find($id);

    $outlet->delete();

    return $outlet->refresh();
  }
}
