<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = 'medicine';

    protected $fillable = [
      'id',
      'meds_type_id',
      'meds_category_id',
      'name',
      'price',
      'factory',
      'curr_stock',
      'min_stock',
    ];

    public function medsType()
    {
        return $this->belongsTo(MedsType::class);
    }

    public function medsCategory()
    {
        return $this->belongsTo(MedsCategory::class);
    }
}