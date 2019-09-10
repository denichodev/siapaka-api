<?php
namespace App\Services;
use App\Repositories\RepositoryInterface;
use App\User;
class UserService
{
    protected $repo;

    public function __construct(RepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function get()
    {
        return $this->repo->get();
    }

    public function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
            'email' => $data['email'],
            'role_id' => $data['role_id'],
        ]);

        return $user;
    }

    public function find($id)
    {
        return $this->repo->find($id);
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
        return $this->repo->delete($id);
    }
}