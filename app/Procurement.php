<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    protected $table = 'procurement';

    protected $fillable = [
      'id',
      'supplier_id',
      'staff_id',
      'date',
      'status',
    ];

    protected $casts = [
      'date' => 'datetime',
    ];

    public function supplier()
    {
      return $this->belongsTo(Supplier::class);
    }

    public function staff()
    {
      return $this->belongsTo(Staff::class);
    }
}