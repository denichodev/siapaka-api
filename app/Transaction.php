<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  public $incrementing = false;
  protected $with = ['users', 'customer', 'doctor'];
  protected $table = 'transaction';

  protected $fillable = [
    'id',
    'staff_id',
    'customer_id',
    'doctor_id',
    'date',
    'subtotal',
    'tax',
    'pay_amt',
  ];

  protected $casts = [
    'date' => 'datetime',
  ];

  public function customer()
  {
    return $this->belongsTo(Customer::class);
  }

  public function users()
  {
    return $this->belongsTo(User::class, 'staff_id', 'id');
  }

  public function doctor()
  {
    return $this->belongsTo(Doctor::class);
  }
}
