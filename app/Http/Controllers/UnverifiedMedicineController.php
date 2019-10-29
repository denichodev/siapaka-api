<?php

namespace App\Http\Controllers;

use App\Services\UnverifiedMedicineService;
use App\Transformers\UnverifiedMedicineTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UnverifiedMedicineController extends RestController
{
    protected $transformer_name = UnverifiedMedicineTransformer::class;

    protected $service;

    public function __construct(UnverifiedMedicineService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function index()
    {
        return $this->sendCollection($this->service->get());
    }

    public function show($id)
    {
        try {
            return $this->sendItem($this->service->find($id));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('UnverifiedMedicine not found');
        }
    }

    public function destroy($id)
    {
        try {
            return $this->sendItem($this->service->delete($id));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('UnverifiedMedicine not found');
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }
}
