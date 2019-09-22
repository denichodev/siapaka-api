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

  // public function update($id, array $data)
  // {
  //     $Outlet = $this->find($id);
  //     return $Outlet->update([
  //         'name' => $data['name'],
  //         'full_name' => $data['full_name'],
  //         'role_id' => $data['role_id'],
  //     ]);
  // }

  // public function delete($id)
  // {
  //   return $this->repo->delete($id);
  // }
}
