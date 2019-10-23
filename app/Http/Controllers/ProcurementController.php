<?php
namespace App\Http\Controllers;
use App\Services\ProcurementService;

use App\Transformers\ProcurementTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcurementController extends RestController
{
    protected $transformer_name = ProcurementTransformer::class;

    protected $service;

    protected static $rule = [
        'supplierId' => 'required',
        'staffId' => 'required',
        'orderDate' => 'required',
        'medicines' => 'required',
    ];

    public function __construct(ProcurementService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function index()
    {
        return $this->sendCollection($this->service->get());
    }

    // public function indexMinimal()
    // {
    //     return $this->sendCollection($this->service->getMinimal());
    // }

    public function create(Request $request)
    {
        $this->validate($request, self::$rule);
        try {
            $procurement = DB::transaction(function () use ($request) {
                return $this->service->create([
                    'supplier_id' => $request->input('supplierId'),
                    'staff_id' => $request->input('staffId'),
                    'order_date' => $request->input('orderDate'),
                    'medicines' => $request->input('medicines'),
                    'status' => 'PROCESS',
                ]);
            });

            return $this->sendItem($procurement);
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }

    // public function show($id)
    // {
    //     try {
    //         return $this->sendItem($this->service->find($id));
    //     } catch (ModelNotFoundException $e) {
    //         return $this->notFoundResponse('Medicine not found');
    //     }
    // }
    
    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, self::$rule);

    //     try {
    //         return $this->sendItem($this->service->update($id, [
    //             'name' => $request->input('name'),
    //                 'price' => $request->input('price'),
    //                 'meds_type_id' => $request->input('medsTypeId'),
    //                 'meds_category_id' => $request->input('medsCategoryId'),
    //                 'factory' => $request->input('factory'),
    //                 'curr_stock' => $request->input('currStock'),
    //                 'min_stock' => $request->input('minStock'),
    //         ]));
    //     } catch (ModelNotFoundException $e) {
    //         return $this->notFoundResponse('Medicine not found');
    //     } catch (\Exception $e) {
    //         return $this->iseResponse($e->getMessage());
    //     }
    // }

    public function destroy($id)
    {
        try {
            return $this->sendItem($this->service->delete($id));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Procurement not found');
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }
}