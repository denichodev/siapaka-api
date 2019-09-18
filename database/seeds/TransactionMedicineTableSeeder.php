<?php

use Illuminate\Database\Seeder;
use App\TransactionMedicine;

class TransactionMedicineTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => 1,
            'transaction_id' => 'R180919001',
            'medicine_id' => 1,
            'qty' => 2,
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
            if (is_null(TransactionMedicine::find($data['id']))) {
                TransactionMedicine::create([
                    'id' => $data['id'],
                    'transaction_id' => $data['transaction_id'],
                    'medicine_id' => $data['medicine_id'],
                    'qty' => $data['qty']
                ]);
            }
        });
    }
}
