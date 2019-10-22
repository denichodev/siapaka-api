<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Procurement;

class ProcurementTransformer extends TransformerAbstract
{
  protected $defaultIncludes = [
    'supplier',
    'staff',
  ];

  public function transform(Procurement $procurement)
  {
    return [
      'id' => $procurement->id,
      'status' => $procurement->status,
    ];
  }

  public function includeSupplier(Procurement $procurement)
  {
      return $this->item($procurement->supplier, new SupplierTransformer);
  }

  public function includeStaff(Procurement $procurement)
  {
      return $this->item($procurement->users, new UserTransformer);
  }
}
