<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Procurement;

class ProcurementTransformer extends TransformerAbstract
{
  protected $defaultIncludes = [
    'supplier',
    'staff',
    'medicines',
    'unverifiedMedicines',
  ];

  public function transform(Procurement $procurement)
  {
    return [
      'id' => $procurement->id,
      'status' => $procurement->status,
      'orderDate' => $procurement->order_date,
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

  public function includeMedicines(Procurement $procurement)
  {
    return $this->collection($procurement->medicines, new ProcurementMedicineTransformer);
  }

  public function includeUnverifiedMedicines(Procurement $procurement)
  {
    return $this->collection($procurement->unverified_medicines, new UnverifiedMedicineTransformer);
  }
}
