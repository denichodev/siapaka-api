<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    public $incrementing = false;
    protected $fillable = [
        'phone_no',
        'name',
    ];

    public $timestamps = false;
}