<?php

namespace App\Services;

use App\Transaction;
use App\Customer;
use App\TransactionMedicine;
use App\Medicine;

class TransactionService
{
    public function get()
    {
        return Transaction::with(['users', 'customer', 'doctor'])->get();
    }

    public function create(array $data)
    {
        $customer = Customer::firstOrNew([
            'id' => $data['customer_id'],
            'name' => $data['name'],
        ]);

        if ($customer->exists) {
            // user already exists
        } else {
            $customer->save();
        }

        $transaction = Transaction::create([
            'id' => $data['id'],
            'staff_id' => $data['staff_id'],
            'date' => $data['date'],
            'customer_id' => $customer->id,
            'doctor_id' => $data['doctor_id'],
            'subtotal' => $data['subtotal'],
            'tax' => $data['tax'],
        ]);

        $id = $transaction->id;

        foreach ($data['medicines'] as $med) {
            TransactionMedicine::create([
                'qty' => $med['qty'],
                'transaction_id' => $id,
                'medicine_id' => $med['id'],
                'instructions' => $med['instruction']
            ]);
        }

        return $transaction->refresh();
    }

    public function find($id)
    {
        return Transaction::with(['users', 'customer', 'doctor', 'medicines', 'medicines.medicine'])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $transaction = $this->find($id);

        $transaction->update([
            'subtotal' => $data['subtotal'],
            'tax' => $data['subtotal']
        ]);

        foreach ($data['medicines'] as $data) {
            if (!is_null($data['dbId'])) {
                $transactionMedicine = TransactionMedicine::findOrFail($data['dbId']);

                $transactionMedicine->update([
                    'qty' => $data['qty'],
                    'instructions' => $data['instruction']
                ]);
            } else {
                TransactionMedicine::create([
                    'qty' => $data['qty'],
                    'transaction_id' => $id,
                    'medicine_id' => $data['id'],
                    'instructions' => $data['instruction']
                ]);
            }
        }


        return $transaction->refresh();
    }

    public function pay($id, array $data)
    {
        $transaction = $this->find($id);

        $transaction->update([
            'pay_amt' => $data['pay_amt'],
        ]);

        $transaction->medicines->each(function ($item) {
            $medicine = $item->medicine;

            $medicine->update([
                'curr_stock' => $medicine->curr_stock - $item->qty
            ]);
        });

        return $transaction->refresh();
    }

    public function take($id)
    {
        $transaction = $this->find($id);

        $transaction->update([
            'taken' => true,
        ]);

        return $transaction->refresh();
    }

    //   public function delete($id)
    //   {
    //     $medicine = $this->find($id);

    //     $medicine->delete();

    //     return $medicine->refresh();
    //   }
}
