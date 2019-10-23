<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\UnverifiedMedicine;

class UnverifiedMedicineTransformer extends TransformerAbstract
{
  protected $defaultIncludes = [
    'medsType',
    'medsCategory',
  ];

  public function transform(UnverifiedMedicine $medicine)
  {
    return [
      'id' => $medicine->id,
      'qty' => $medicine->qty,
      'qtyType' => $medicine->qty_type,
      'name' => $medicine->name,
      'price' => $medicine->price,
      'factory' => $medicine->factory,
      'minStock' => $medicine->min_stock,
    ];
  }

  public function includeMedsType(UnverifiedMedicine $medicine)
  {
      return $this->item($medicine->meds_type, new MedsTypeTransformer);
  }

  public function includeMedsCategory(UnverifiedMedicine $medicine)
  {
      return $this->item($medicine->meds_category, new MedsCategoryTransformer);
  }
}
