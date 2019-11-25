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

        $month = $request->query('month');
        $year = $request->query('year');

        if (is_null($month) || is_null($year)) {
            return $this->response([
                'data' => []
            ]);
        }

        try {
            $top10 = DB::table('transaction')
                ->selectRaw('medicine.id as medicineId')
                ->selectRaw('medicine.name as medicineName')
                ->selectRaw('meds_type.id as medsTypeId')
                ->selectRaw('meds_category.name as medsCategoryName')
                ->selectRaw('SUM(transaction_medicine.qty) as sellAmt')
                ->join('transaction_medicine', 'transaction_medicine.transaction_id', '=', 'transaction.id')
                ->join('medicine', 'transaction_medicine.medicine_id', '=', 'medicine.id')
                ->join('meds_type', 'medicine.meds_type_id', '=', 'meds_type.id')
                ->join('meds_category', 'medicine.meds_category_id', '=', 'meds_category.id')
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

    public function indexTop10Doctors(Request $request)
    {

        $month = $request->query('month');
        $year = $request->query('year');

        if (is_null($month) || is_null($year)) {
            return $this->response([
                'data' => []
            ]);
        }

        try {
            $top10 = DB::table('transaction')
                ->selectRaw('doctor_id as doctorId')
                ->selectRaw('count(doctor_id) as recipeAmt')
                ->selectRaw('doctor.name as doctorName')
                ->selectRaw('doctor.address as doctorAddress')
                ->selectRaw('doctor.phone_no as doctorPhoneNo')
                ->join('doctor', 'transaction.doctor_id', '=', 'doctor.id')
                ->whereRaw('transaction.pay_amt IS NOT NULL AND MONTH(transaction.date) = ' . $month . ' AND YEAR(transaction.date) = ' . $year)
                ->groupBy('doctorId')
                ->orderBy('recipeAmt', 'desc')
                ->limit(10)
                ->get();

            return $this->response([
                'data' => $top10
            ]);
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }

    public function indexTopMonthlyMeds(Request $request)
    {
        $year = $request->query('year');

        if (is_null($year)) {
            return $this->response([
                'data' => []
            ]);
        }

        try {
            $top10 = DB::table('transaction')
                ->selectRaw('medicine.id as medicineId')
                ->selectRaw('medicine.name as medicineName')
                ->selectRaw('meds_type.id as medsTypeId')
                ->selectRaw('meds_category.name as medsCategoryName')
                ->selectRaw('SUM(transaction_medicine.qty) as sellAmt')
                ->selectRaw('MONTHNAME(transaction.date) as dateMonth')
                ->join('transaction_medicine', 'transaction_medicine.transaction_id', '=', 'transaction.id')
                ->join('medicine', 'transaction_medicine.medicine_id', '=', 'medicine.id')
                ->join('meds_type', 'medicine.meds_type_id', '=', 'meds_type.id')
                ->join('meds_category', 'medicine.meds_category_id', '=', 'meds_category.id')
                ->whereRaw('transaction.pay_amt IS NOT NULL AND YEAR(transaction.date) = ' . $year)
                ->groupBy(['medicineId', 'dateMonth'])
                ->orderBy('dateMonth', 'desc')
                ->get();

            return $this->response([
                'data' => $top10
            ]);
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }

    public function monthlySales(Request $request)
    {
        $year = $request->query('year');

        if (is_null($year)) {
            return $this->response([
                'data' => []
            ]);
        }

        try {
            $top10 = DB::table('transaction')
                ->selectRaw('YEAR(date) as year')
                ->selectRaw('MONTHNAME(date) as month')
                ->selectRaw('SUM(subtotal + tax) AS total')
                ->selectRaw('SUBSTRING(id, 1, 1) as transactionType')
                ->whereRaw('transaction.pay_amt IS NOT NULL AND YEAR(transaction.date) = ' . $year)
                ->groupBy(['year', 'month', 'transactionType'])
                ->orderBy('month')
                ->orderBy('year')
                ->get();

            return $this->response([
                'data' => $top10
            ]);
        } catch (\Exception $e) {
            return $this->iseResponse($e->getMessage());
        }
    }

    public function yearlySales(Request $request)
    {
        try {
            $top10 = DB::table('transaction')
                ->selectRaw('YEAR(date) as year')
                ->selectRaw('outlet.name as outletName')
                ->selectRaw('SUM(subtotal + tax) AS total')
                ->join('users', 'users.id', '=', 'transaction.staff_id')
                ->join('outlet', 'outlet.id', '=', 'users.outlet_id')
                ->whereRaw('transaction.pay_amt IS NOT NULL')
                ->groupBy(['year', 'outlet.name'])
                ->orderBy('year')
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
