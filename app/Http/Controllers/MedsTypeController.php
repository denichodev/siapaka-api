<?php
namespace App\Http\Controllers;
use App\Services\MedsTypeService;
use App\Transformers\MedsTypeTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MedsTypeController extends RestController
{
    protected $transformer_name = MedsTypeTransformer::class;

    public function index(MedsTypeService $service)
    {
        return $this->sendCollection($service->get());
    }

    public function show(MedsTypeService $service, $id)
    {
        try {
            return $this->sendItem($service->find($id));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Meds type not found');
        }
    }
}