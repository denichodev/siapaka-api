<?php

namespace App\Services;

use App\Transaction;
use App\Customer;
use App\TransactionMedicine;

class TransactionService
{
    public function get()
    {
        return Transaction::with(['users', 'customer', 'doctor'])->get();
    }

    //   public function getMinimal()
    //   {
    //     return Medicine::whereRaw('medicine.curr_stock < medicine.min_stock')->get();
    //   }

    public function create(array $data)
    {
        $customer = Customer::firstOrCreate([
            'id' => $data['customer_id'],
            'name' => $data['name'],
        ]);

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
        return Transaction::with(['users', 'customer', 'doctor'])->findOrFail($id);
    }

    //   public function update($id, array $data)
    //   {
    //       $medicine = $this->find($id);

    //       $medicine->update([
    //         'name' => $data['name'],
    //         'price' => $data['price'],
    //         'meds_type_id' => $data['meds_type_id'],
    //         'meds_category_id' => $data['meds_category_id'],
    //         'factory' => $data['factory'],
    //         'curr_stock' => $data['curr_stock'],
    //         'min_stock' => $data['min_stock'],
    //       ]);

    //       return $medicine->refresh();
    //   }

    //   public function delete($id)
    //   {
    //     $medicine = $this->find($id);

    //     $medicine->delete();

    //     return $medicine->refresh();
    //   }
}
