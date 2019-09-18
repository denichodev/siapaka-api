<?php

use Illuminate\Database\Seeder;
use App\Procurement;

class ProcurementTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => 1,
            'supplier_id' => 1,
            'staff_id' => 2,
            'status' => 'PROCESS',
        ],
        [
            'id' => 2,
            'supplier_id' => 2,
            'staff_id' => 2,
            'status' => 'VERIFIED',
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
            if (is_null(Procurement::find($data['id']))) {
                Procurement::create([
                    'id' => $data['id'],
                    'supplier_id' => $data['supplier_id'],
                    'staff_id' => $data['staff_id'],
                    'date' => new DateTime(),
                    'status' => $data['status']
                ]);
            }
        });
    }
}
