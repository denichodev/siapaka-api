<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';

    protected $fillable = [
      'id',
      'staff_id',
      'customer_phone_no',
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

    public function staff()
    {
      return $this->belongsTo(Staff::class);
    }

    public function doctor()
    {
      return $this->belongsTo(Doctor::class);
    }
}