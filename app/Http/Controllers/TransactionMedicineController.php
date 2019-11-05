<?php

namespace App\Http\Controllers;

use App\Services\TransactionMedicineService;
use App\Transformers\TransactionMedicineTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TransactionMedicineController extends RestController
{
    protected $transformer_name = TransactionMedicineTransformer::class;

    protected $service;

    public function __construct(TransactionMedicineService $service)
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
            return $this->notFoundResponse('TransactionMedicine not found');
        }
    }

    public function destroy($id)
    {
        try {
            return $this->sendItem($this->service->delete($id));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('TransactionMedicine not found');
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }
}
