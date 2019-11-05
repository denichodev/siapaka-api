<?php

namespace App\Services;

use App\TransactionMedicine;

class TransactionMedicineService
{
  public function get()
  {
    return TransactionMedicine::get();
  }

  public function find($id)
  {
    return TransactionMedicine::findOrFail($id);
  }

  public function delete($id)
  {
    $transactionMedicine = $this->find($id);

    $transactionMedicine->delete();

    return $transactionMedicine->refresh();
  }
}
