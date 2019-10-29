<?php

namespace App\Services;

use App\UnverifiedMedicine;

class UnverifiedMedicineService
{
  public function get()
  {
    return UnverifiedMedicine::get();
  }

  public function find($id)
  {
    return UnverifiedMedicine::findOrFail($id);
  }

  public function delete($id)
  {
    $unverifiedMedicine = $this->find($id);

    $unverifiedMedicine->delete();

    return $unverifiedMedicine->refresh();
  }
}
