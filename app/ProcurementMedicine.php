<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class ProcurementMedicine extends Model
{
    protected $table = 'procurement_medicine';

    protected $fillable = [
      'id',
      'procurement_id',
      'medicine_id',
      'qty',
      'qty_type',
    ];

    public function procurement()
    {
      return $this->belongsTo(Procurement::class);
    }

    public function medicine()
    {
      return $this->belongsTo(Medicine::class);
    }
}