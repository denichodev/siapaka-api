<?php
namespace App\Http\Controllers;
use App\Services\RoleService;
use App\Transformers\RoleTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleController extends RestController
{
    protected $transformer_name = RoleTransformer::class;

    public function index(RoleService $service)
    {
        return $this->sendCollection($service->get());
    }

    public function show(RoleService $service, $id)
    {
        try {
            return $this->sendItem($service->find($id));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Role not found');
        }
    }
}