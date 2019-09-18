<?php

use Illuminate\Database\Seeder;
use App\Medicine;

class MedicineTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => 1,
            'meds_type_id' => 'TABLET',
            'meds_category_id' => 'FREE',
            'name' => 'Intunal 500mg',
            'price' => 8000,
            'factory' => 'PT. Kimia Farma',
            'curr_stock' => 1200,
            'min_stock' => 1000,
        ],
        [
            'id' => 2,
            'meds_type_id' => 'CAPSULE',
            'meds_category_id' => 'POTENT',
            'name' => 'Paracetamol Kapsul 500mg',
            'price' => 3000,
            'factory' => 'PT. Kimia Farma',
            'curr_stock' => 12000,
            'min_stock' => 10000,
        ],
        [
            'id' => 3,
            'meds_type_id' => 'SYRUP',
            'meds_category_id' => 'FREE',
            'name' => 'Sanmol Syrup 500ml',
            'price' => 15000,
            'factory' => 'PT. Kimia Farma',
            'curr_stock' => 120,
            'min_stock' => 100,
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
            if (is_null(Medicine::find($data['id']))) {
                Medicine::create([
                    'id' => $data['id'],
                    'meds_type_id' => $data['meds_type_id'],
                    'meds_category_id' => $data['meds_category_id'],
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'factory' => $data['factory'],
                    'curr_stock' => $data['curr_stock'],
                    'min_stock' => $data['min_stock'],
                ]);
            }
        });
    }
}
