<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    protected $with = ['users', 'supplier'];
    
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

    public function users()
    {
      return $this->belongsTo(User::class, 'staff_id', 'id');
    }
}