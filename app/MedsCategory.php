<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class MedsCategory extends Model
{
    protected $table = 'meds_category';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
    ];

    public $timestamps = false;
}