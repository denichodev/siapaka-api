<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionMedicine extends Model
{
  protected $table = 'transaction_medicine';

  protected $fillable = [
    'id',
    'transaction_id',
    'medicine_id',
    'qty',
    'instructions',
  ];

  public function transaction()
  {
    return $this->belongsTo(Transaction::class);
  }

  public function medicine()
  {
    return $this->belongsTo(Medicine::class);
  }
}
