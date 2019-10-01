<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;
    protected $table = 'doctor';

    protected $fillable = [
        'id',
        'name',
        'address',
        'phone_no'
    ];
}