<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Services\TransactionService;
use App\Transformers\TransactionTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends RestController
{
    protected $transformer_name = TransactionTransformer::class;

    protected $service;

    protected static $rule = [
        'name' => 'required',
        'phoneNo' => 'required',
        'orderDate' => 'required',
        'medicines' => 'required',
        'staffId' => 'required',
    ];

    protected static $updateRule = [
        'medicines' => 'required',
        'subtotal' => 'required',
        'tax' => 'required',
    ];

    public function __construct(TransactionService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function index()
    {
        return $this->sendCollection($this->service->get());
    }

    public function indexMinimal()
    {
        return $this->sendCollection($this->service->getMinimal());
    }

    public function generateId(string $date, $doctorId)
    {
        $time = strtotime($date);
        $dateTime = getDate($time);
        $day = str_pad($dateTime['mday'], 2, '0', STR_PAD_LEFT);
        $mon = str_pad($dateTime['mon'], 2, '0', STR_PAD_LEFT);
        $year = substr($dateTime['year'], 2);
        $code = $doctorId ? 'R' : 'T';
        $dateCode = $code . $day . $mon . $year;
        $whereLikeQuery = $dateCode . '%';

        $tr = Transaction::where('id', 'like', $whereLikeQuery)->get()->last();

        $lastId = $tr ? $tr->id : NULL;
        $lastCount = $lastId ? (int) substr($lastId, 7) : 0;
        $countCode = $lastCount ? str_pad($lastCount + 1, 3, '0', STR_PAD_LEFT) : '001';

        $fullCode = $code . $day . $mon . $year . $countCode;

        return $fullCode;
    }

    public function create(Request $request)
    {
        $this->validate($request, self::$rule);

        try {
            $transaction = DB::transaction(function () use ($request) {
                $id = $this->generateId($request->input('orderDate'), $request->input('doctorId'));

                return $this->service->create([
                    'id' => $id,
                    'name' => $request->input('name'),
                    'doctor_id' => $request->input('doctorId'),
                    'date' => $request->input('orderDate'),
                    'staff_id' => $request->input('staffId'),
                    'medicines' => $request->input('medicines'),
                    'customer_id' => $request->input('phoneNo'),
                    'tax' => $request->input('tax'),
                    'subtotal' => $request->input('subtotal'),
                ]);
            });

            return $this->sendItem($transaction);
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return $this->sendItem($this->service->find($id));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Transaction not found');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, self::$updateRule);

        try {
            return $this->sendItem($this->service->update($id, [
                'medicines' => $request->input('medicines'),
                'subtotal' => $request->input('subtotal'),
                'tax' => $request->input('tax'),
            ]));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Transaction not found');
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }

    // public function destroy($id)
    // {
    //     try {
    //         return $this->sendItem($this->service->delete($id));
    //     } catch (ModelNotFoundException $e) {
    //         return $this->notFoundResponse('Medicine not found');
    //     } catch (\Exception $e) {
    //         return $this->iseResponse($e->getMessage());
    //     }
    // }
}
