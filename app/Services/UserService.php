<?php
namespace App\Services;
use App\User;

class UserService
{
    public function get()
    {
        return User::with(['role', 'outlet'])->get();
    }

    public function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
            'email' => $data['email'],
            'role_id' => $data['role_id'],
            'outlet_id' => $data['outlet_id'],
        ]);

        return $user;
    }

    public function find($id)
    {
        return User::with(['role', 'outlet'])->findOrFail($id);
    }

    // public function update($id, array $data)
    // {
    //     $user = $this->find($id);
    //     return $user->update([
    //         'name' => $data['name'],
    //         'full_name' => $data['full_name'],
    //         'role_id' => $data['role_id'],
    //     ]);
    // }

    public function delete($id)
    {
        $model = $this->find($id);

        return $model->delete();
    }
}