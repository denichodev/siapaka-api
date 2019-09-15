<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SupplierTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => 1,
            'name' => 'Kimia Farma',
            'address' => 'Jl. Sehat Selalu',
            'phone_no' => '0274-487272'
        ],
        [
            'id' => 2,
            'name' => 'Sadewa Medicines',
            'address' => 'Jl. Obat Obatan Ampuh',
            'phone_no' => '0274-481234'
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
            if (is_null(Supplier::find($data['id']))) {
                Supplier::create([
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'phone_no' => $data['phone_no'],
                ]);
            }
        });
    }
}
