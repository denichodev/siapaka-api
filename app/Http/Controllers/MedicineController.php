<?php
namespace App\Http\Controllers;
use App\Services\MedicineService;
use App\Transformers\MedicineTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicineController extends RestController
{
    protected $transformer_name = MedicineTransformer::class;

    protected $service;

    protected static $rule = [
        'name' => 'required',
        'price' => 'required',
        'medsTypeId' => 'required',
        'medsCategoryId' => 'required',
        'factory' => 'required',
        'cur_stock' => 'required',
        'min_stock' => 'required',
    ];

    // protected static $updateRule = [
    //     'name' => 'required',
    //     'email' => 'required',
    //     'roleId' => 'required',
    //     'outletId' => 'required',
    // ];

    public function __construct(MedicineService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function index()
    {
        return $this->sendCollection($this->service->get());
    }

    // public function create(Request $request)
    // {
    //     $this->validate($request, self::$rule);
    //     try {
    //         $user = DB::transaction(function () use ($request) {
    //             return $this->service->create([
    //                 'name' => $request->input('name'),
    //                 'email' => $request->input('email'),
    //                 'password' => $request->input('password'),
    //                 'role_id' => $request->input('roleId'),
    //                 'outlet_id' => $request->input('outletId'),
    //             ]);
    //         });

    //         return $this->sendItem($user);
    //     } catch (\Exception $e) {
    //         return $this->iseResponse($e->getMessage());
    //     }
    // }

    // public function show($id)
    // {
    //     try {
    //         return $this->sendItem($this->service->find($id));
    //     } catch (ModelNotFoundException $e) {
    //         return $this->notFoundResponse('User not found');
    //     }
    // }
    
    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, self::$updateRule);

    //     try {
    //         return $this->sendItem($this->service->update($id, [
    //             'name' => $request->input('name'),
    //             'email' => $request->input('email'),
    //             'password' => $request->input('password'),
    //             'role_id' => $request->input('roleId'),
    //             'outlet_id' => $request->input('outletId'),
    //         ]));
    //     } catch (ModelNotFoundException $e) {
    //         return $this->notFoundResponse('User not found');
    //     } catch (\Exception $e) {
    //         return $this->iseResponse($e->getMessage());
    //     }
    // }

    // public function destroy($id)
    // {
    //     try {
    //         return $this->sendItem($this->service->delete($id));
    //     } catch (ModelNotFoundException $e) {
    //         return $this->notFoundResponse('User not found');
    //     } catch (\Exception $e) {
    //         return $this->iseResponse($e->getMessage());
    //     }
    // }
}