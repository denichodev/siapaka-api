<?php
namespace App\Services;

use App\Role;

class RoleService
{
    public function get()
    {
        return Role::get(['id', 'name']);
    }

    public function find($id)
    {
        return Role::findOrFail($id);
    }
}