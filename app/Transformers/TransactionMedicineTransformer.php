<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\TransactionMedicine;

class TransactionMedicineTransformer extends TransformerAbstract
{
  protected $defaultIncludes = [
    'medicine',
  ];

  public function transform(TransactionMedicine $transactionMedicine)
  {
    return [
      'id' => $transactionMedicine->id,
      'qty' => $transactionMedicine->qty,
      'instruction' => $transactionMedicine->instructions
    ];
  }

  public function includeMedicine(TransactionMedicine $transactionMedicine)
  {
      return $this->item($transactionMedicine->medicine, new MedicineTransformer);
  }
}
