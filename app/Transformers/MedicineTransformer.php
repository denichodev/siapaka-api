<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Medicine;

class MedicineTransformer extends TransformerAbstract
{
  protected $defaultIncludes = [
    'medsType',
    'medsCategory',
  ];

  public function transform(Medicine $medicine)
  {
    return [
      'id' => $medicine->id,
      'name' => $medicine->name,
      'price' => $medicine->price,
      'factory' => $medicine->factory,
      'currStock' => $medicine->curr_stock,
      'minStock' => $medicine->min_stock,
    ];
  }

  public function includeMedsType(Medicine $medicine)
  {
      return $this->item($medicine->meds_type, new MedsTypeTransformer);
  }

  public function includeMedsCategory(Medicine $medicine)
  {
      return $this->item($medicine->meds_category, new MedsCategoryTransformer);
  }
}
