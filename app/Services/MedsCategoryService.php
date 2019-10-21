<?php
namespace App\Services;

use App\MedsCategory;

class MedsCategoryService
{
    public function get()
    {
        return MedsCategory::get(['id', 'name']);
    }

    public function find($id)
    {
        return MedsCategory::findOrFail($id);
    }
}