<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctor';

    protected $fillable = [
        'id',
        'name',
        'address',
        'phone_no'
    ];
}