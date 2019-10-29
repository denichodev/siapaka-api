<?php

namespace App\Http\Controllers;

use App\Services\ProcurementMedicineService;
use App\Transformers\ProcurementMedicineTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProcurementMedicineController extends RestController
{
    protected $transformer_name = ProcurementMedicineTransformer::class;

    protected $service;

    public function __construct(ProcurementMedicineService $service)
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
            return $this->notFoundResponse('ProcurementMedicine not found');
        }
    }

    public function destroy($id)
    {
        try {
            return $this->sendItem($this->service->delete($id));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('ProcurementMedicine not found');
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }
}
