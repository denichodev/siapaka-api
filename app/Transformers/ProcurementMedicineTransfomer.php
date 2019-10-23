<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\ProcurementMedicine;

class ProcurementMedicineTransformer extends TransformerAbstract
{
  protected $defaultIncludes = [
    'medicine',
  ];

  public function transform(ProcurementMedicine $procurementMedicine)
  {
    return [
      'id' => $procurementMedicine->id,
      'qty' => $procurementMedicine->qty,
      'qtyType' => $procurementMedicine->qty_type,
    ];
  }

  public function includeMedicine(ProcurementMedicine $procurementMedicine)
  {
      return $this->item($procurementMedicine->medicine, new MedicineTransformer);
  }
}
