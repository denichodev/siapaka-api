<?php
namespace App\Http\Controllers;
use App\Services\OutletService;
use App\Transformers\OutletTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OutletController extends RestController
{
    protected $transformer_name = OutletTransformer::class;

    public function index(OutletService $service)
    {
        return $this->sendCollection($service->get());
    }

    public function show(OutletService $service, $id)
    {
        try {
            return $this->sendItem($service->find($id));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Outlet not found');
        }
    }
}