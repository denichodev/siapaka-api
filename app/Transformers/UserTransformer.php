<?php
namespace App\Transformers;
use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'role',
        'outlet',
    ];

    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
    }

    public function includeRole(User $user)
    {
        return $this->item($user->role, new RoleTransformer);
    }

    public function includeOutlet(User $user)
    {
        return $this->item($user->outlet, new OutletTransformer);
    }
}