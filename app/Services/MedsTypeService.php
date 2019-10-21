<?php
namespace App\Services;

use App\MedsType;

class MedsTypeService
{
    public function get()
    {
        return MedsType::get(['id', 'name']);
    }

    public function find($id)
    {
        return MedsType::findOrFail($id);
    }
}