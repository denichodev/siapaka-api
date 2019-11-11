<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transaction;


class TransactionTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'staff',
        'customer',
        'doctor',
        'medicines',
    ];

    public function transform(Transaction $transaction)
    {
        // dd($transaction);
        return [
            'id' => (string) $transaction->id,
            'staffId' => $transaction->staff_id,
            'customerId' => $transaction->customer_id,
            'date' => $transaction->date,
            'doctorId' => $transaction->doctor_id,
            'subtotal' => $transaction->subtotal,
            'tax' => $transaction->tax,
            'payAmt' => $transaction->pay_amt,
            'taken' => $transaction->taken,
        ];
    }

    public function includeCustomer(Transaction $transaction)
    {
        return $this->item($transaction->customer, new CustomerTransformer);
    }

    public function includeStaff(Transaction $transaction)
    {
        return $this->item($transaction->users, new UserTransformer);
    }

    public function includeMedicines(Transaction $transaction)
    {
        return $this->collection($transaction->medicines, new TransactionMedicineTransformer);
    }

    public function includeDoctor(Transaction $transaction)
    {
        return $transaction->doctor ?
            $this->item($transaction->doctor, new DoctorTransformer)
            : $this->null();
    }
}
