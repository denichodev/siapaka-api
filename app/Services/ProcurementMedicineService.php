<?php

namespace App\Services;

use App\ProcurementMedicine;

class ProcurementMedicineService
{
  public function get()
  {
    return ProcurementMedicine::get();
  }

  public function find($id)
  {
    return ProcurementMedicine::findOrFail($id);
  }

  public function delete($id)
  {
    $ProcurementMedicine = $this->find($id);

    $ProcurementMedicine->delete();

    return $ProcurementMedicine->refresh();
  }
}
