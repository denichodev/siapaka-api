<?php

use Illuminate\Database\Seeder;
use App\ProcurementMedicine;

class ProcurementMedicineTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => 1,
            'procurement_id' => 1,
            'medicine_id' => 1,
            'qty' => 2,
            'qty_type' => 'BOX',
        ],
        [
            'id' => 2,
            'procurement_id' => 2,
            'medicine_id' => 2,
            'qty' => 4,
            'qty_type' => 'CARTON',
        ],
        [
            'id' => 3,
            'procurement_id' => 2,
            'medicine_id' => 3,
            'qty' => 1,
            'qty_type' => 'CARTON',
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
            if (is_null(ProcurementMedicine::find($data['id']))) {
                ProcurementMedicine::create([
                    'id' => $data['id'],
                    'procurement_id' => $data['procurement_id'],
                    'medicine_id' => $data['medicine_id'],
                    'qty' => $data['qty'],
                    'qty_type' => $data['qty_type']
                ]);
            }
        });
    }
}
