<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class UnverifiedMedicine extends Model
{
    protected $table = 'unverified_medicine';

    protected $fillable = [
      'id',
      'procurement_id',
      'meds_type_id',
      'meds_category_id',
      'name',
      'price',
      'factory',
      'min_stock',
      'qty',
      'qty_type',
    ];

    public function procurement()
    {
      return $this->belongsTo(Procurement::class);
    }

    public function meds_type()
    {
        return $this->belongsTo(MedsType::class);
    }

    public function meds_category()
    {
        return $this->belongsTo(MedsCategory::class);
    }
}