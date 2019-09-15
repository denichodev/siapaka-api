<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $table = 'outlet';

    protected $fillable = [
        'id',
        'name',
        'address',
        'phone_no'
    ];
}