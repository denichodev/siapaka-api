<?php
namespace App\Http\Controllers;
use App\Services\MedsCategoryService;
use App\Transformers\MedsCategoryTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MedsCategoryController extends RestController
{
    protected $transformer_name = MedsCategoryTransformer::class;

    public function index(MedsCategoryService $service)
    {
        return $this->sendCollection($service->get());
    }

    public function show(MedsCategoryService $service, $id)
    {
        try {
            return $this->sendItem($service->find($id));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Meds category not found');
        }
    }
}