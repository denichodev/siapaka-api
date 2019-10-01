<?php

namespace App\Services;

use App\Doctor;

class DoctorService
{
  public function get()
  {
    return Doctor::get();
  }

  public function create(array $data)
  {
    $doctor = Doctor::create([
      'name' => $data['name'],
      'address' => $data['address'],
      'phone_no' => $data['phone_no'],
    ]);

    return $doctor;
  }

  public function find($id)
  {
    return Doctor::findOrFail($id);
  }

  public function update($id, array $data)
  {
      $doctor = $this->find($id);

      $doctor->update([
          'name' => $data['name'],
          'address' => $data['address'],
          'phone_no' => $data['phone_no'],
      ]);

      return $doctor->refresh();
  }

  public function delete($id)
  {
    $doctor = $this->find($id);

    $doctor->delete();

    return $doctor->refresh();
  }
}
