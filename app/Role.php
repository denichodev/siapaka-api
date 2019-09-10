<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
    ];

    public $timestamps = false;
}