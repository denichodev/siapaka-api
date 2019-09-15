<?php

use Illuminate\Database\Seeder;
use App\Outlet;

class OutletTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => 1,
            'name' => 'Apotek Atma Medika Babarsari',
            'address' => 'Jl. Babarsari No. 42, Yogyakarta 55281',
            'phone_no' => '0274-487712'
        ],
        [
            'id' => 2,
            'name' => 'Apotek Atma Medika Malioboro',
            'address' => 'Jl. Malioboro No. 123, Yogyakarta 55271',
            'phone_no' => '0274-514980'
        ],
        [
            'id' => 3,
            'name' => 'Apotek Atma Medika Gejayan',
            'address' => 'Jl. Affandi No. 123, Yogyakarta 55283',
            'phone_no' => '0274-566944'
        ],
        [
            'id' => 4,
            'name' => 'Apotek Atma Medika Solo',
            'address' => 'Jl. Muh. Yamin No. 91, Solo 57153 ',
            'phone_no' => '0271-638598'
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
            if (is_null(Outlet::find($data['id']))) {
                Outlet::create([
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'phone_no' => $data['phone_no'],
                ]);
            }
        });
    }
}
