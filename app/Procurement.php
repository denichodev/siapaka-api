<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Carbon;

class Procurement extends Model
{
    protected $with = ['users', 'supplier'];
    
    protected $table = 'procurement';

    protected $fillable = [
      'id',
      'supplier_id',
      'staff_id',
      'order_date',
      'status',
      'medicines',
      'unverified_medicines',
    ];

    protected $casts = [
      'order_date' => 'datetime',
    ];

    public function supplier()
    {
      return $this->belongsTo(Supplier::class);
    }

    public function users()
    {
      return $this->belongsTo(User::class, 'staff_id', 'id');
    }

    public function medicines()
    {
      return $this->hasMany(ProcurementMedicine::class);
    }

    public function unverified_medicines()
    {
      return $this->hasMany(UnverifiedMedicine::class);
    }
}