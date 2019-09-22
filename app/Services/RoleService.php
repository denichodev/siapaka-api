<?php
namespace App\Services;

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