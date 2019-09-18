<?php

use Illuminate\Database\Seeder;
use App\Transaction;

class TransactionTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => 'R180919001',
            'staff_id' => 2,
            'customer_id' => '087718271562',
            'doctor_id' => 1,
            'subtotal' => 8000,
            'tax' => 800,
            'pay_amt' => 10000
        ],
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->data)->each(function ($data) {
            if (is_null(Transaction::find($data['id']))) {
                Transaction::create([
                    'id' => $data['id'],
                    'customer_id' => $data['customer_id'],
                    'staff_id' => $data['staff_id'],
                    'doctor_id' => $data['doctor_id'],
                    'date' => new DateTime(),
                    'subtotal' => $data['subtotal'],
                    'tax' => $data['tax'],
                    'pay_amt' => $data['pay_amt'],
                ]);
            }
        });
    }
}
