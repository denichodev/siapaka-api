<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Supplier;

class SupplierTransformer extends TransformerAbstract
{

  public function transform(Supplier $supplier)
  {
    return [
      'id' => $supplier->id,
      'name' => $supplier->name,
      'address' => $supplier->address,
      'phoneNo' => $supplier->phone_no,
    ];
  }
}
