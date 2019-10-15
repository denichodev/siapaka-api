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

    public function update($id, array $data)
    {
        $user = $this->find($id);

        if ($data['password'] != '') {
            $user->update([
                'name' => $data['name'],
                'password' => bcrypt($data['password']),
                'email' => $data['email'],
                'role_id' => $data['role_id'],
                'outlet_id' => $data['outlet_id'],
            ]);
        } else {
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['role_id'],
                'outlet_id' => $data['outlet_id'],
            ]);
        }

        return $user->refresh();
    }

    public function delete($id)
    {
        $user = $this->find($id);

        $user->delete();

        return $user->refresh();
    }
}