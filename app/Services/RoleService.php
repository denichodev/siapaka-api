<?php
namespace App\Services;
use App\Repositories\RepositoryInterface;

class RoleService
{
    /**
     * @var RepositoryInterface
     */
    protected $repo;

    public function __construct(RepositoryInterface $role_repo)
    {
        $this->repo = $role_repo;
    }

    public function get()
    {
        return $this->repo->get();
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }
}