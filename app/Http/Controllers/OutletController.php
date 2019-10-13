<?php

namespace App\Http\Controllers;

use App\Services\OutletService;
use App\Transformers\OutletTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class OutletController extends RestController
{
    protected $transformer_name = OutletTransformer::class;

    protected $service;

    protected static $rule = [
        'name' => 'required',
        'address' => 'required',
        'phoneNo' => 'required'
    ];

    public function __construct(OutletService $service)
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
            return $this->notFoundResponse('Outlet not found');
        }
    }

    public function create(Request $request)
    {
        $this->validate($request, self::$rule);

        try {
            return $this->sendItem($this->service->create([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone_no' => $request->input('phoneNo'),
            ]));
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, self::$rule);

        try {
            return $this->sendItem($this->service->update($id, [
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone_no' => $request->input('phoneNo'),
            ]));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Outlet not found');
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return $this->sendItem($this->service->delete($id));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Outlet not found');
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }
}
