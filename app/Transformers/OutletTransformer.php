<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Outlet;

class OutletTransformer extends TransformerAbstract
{

  public function transform(Outlet $outlet)
  {
    return [
      'id' => $outlet->id,
      'name' => $outlet->name,
      'address' => $outlet->address,
      'phone_no' => $outlet->phone_no,
    ];
  }
}
