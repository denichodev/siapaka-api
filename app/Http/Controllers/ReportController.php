<?php

namespace App\Http\Controllers;

use App\Services\ProcurementService;

use App\Transformers\Top10MedsReportTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends RestController
{
    protected $transformer_name = Top10MedsReportTransformer::class;

    protected $service;

    protected static $top10medsRule = [
        'month' => 'required',
        'year' => 'required',
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

    public function indexTop10Meds(Request $request)
    {
        $this->validate($request, self::$top10medsRule);

        $month = $request->input('month');
        $year = $request->input('year');

        try {
            $top10 = DB::table('transaction')
                ->selectRaw('medicine.id as medicineId')
                ->selectRaw('SUM(transaction_medicine.qty) as sellAmt')
                ->join('transaction_medicine', 'transaction_medicine.transaction_id', '=', 'transaction.id')
                ->join('medicine', 'transaction_medicine.medicine_id', '=', 'medicine.id')
                ->whereRaw('transaction.pay_amt IS NOT NULL AND MONTH(transaction.date) = ' . $month . ' AND YEAR(transaction.date) = ' . $year)
                ->groupBy('medicineId')
                ->orderBy('sellAmt', 'desc')
                ->limit(10)
                ->get();

            return $this->response([
                'data' => $top10
            ]);
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }

    // public function create(Request $request)
    // {
    //     $this->validate($request, self::$rule);
    //     try {
    //         $procurement = DB::transaction(function () use ($request) {
    //             return $this->service->create([
    //                 'supplier_id' => $request->input('supplierId'),
    //                 'staff_id' => $request->input('staffId'),
    //                 'order_date' => $request->input('orderDate'),
    //                 'medicines' => $request->input('medicines'),
    //                 'status' => 'PROCESS',
    //             ]);
    //         });

    //         return $this->sendItem($procurement);
    //     } catch (\Exception $e) {
    //         return $this->iseResponse($e->getMessage());
    //     }
    // }
}
