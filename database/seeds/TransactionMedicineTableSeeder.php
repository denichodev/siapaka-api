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
        [
            'id' => 2,
            'transaction_id' => 'R180919001',
            'medicine_id' => 2,
            'qty' => 2,
        ],
        [
            'id' => 3,
            'transaction_id' => 'R180919002',
            'medicine_id' => 3,
            'qty' => 2,
        ],
        [
            'id' => 4,
            'transaction_id' => 'R180919003',
            'medicine_id' => 1,
            'qty' => 1,
        ],
        [
            'id' => 4,
            'transaction_id' => 'T180919001',
            'medicine_id' => 1,
            'qty' => 1,
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
