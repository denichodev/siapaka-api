<?php
namespace App\Repositories;
use App\Role;

class RoleRepo implements RepositoryInterface
{
    public function get()
    {
        $a = Role::get(['id', 'name']);

        return $a;
    }
    public function find($id)
    {
        return Role::findOrFail($id);
    }
}