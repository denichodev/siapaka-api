<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class MedsType extends Model
{
    protected $table = 'meds_type';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
    ];

    public $timestamps = false;
}