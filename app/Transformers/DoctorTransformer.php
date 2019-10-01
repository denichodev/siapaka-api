<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Doctor;

class DoctorTransformer extends TransformerAbstract
{

  public function transform(Doctor $doctor)
  {
    return [
      'id' => $doctor->id,
      'name' => $doctor->name,
      'address' => $doctor->address,
      'phoneNo' => $doctor->phone_no,
    ];
  }
}
