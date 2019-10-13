<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outlet extends Model
{
    use SoftDeletes;
    protected $table = 'outlet';

    protected $fillable = [
        'id',
        'name',
        'address',
        'phone_no'
    ];
}