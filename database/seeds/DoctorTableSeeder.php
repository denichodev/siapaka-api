<?php

use Illuminate\Database\Seeder;
use App\Doctor;

class DoctorTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => 1,
            'name' => 'Dr. Pranowo',
            'address' => 'Jl. Model Optimisasi',
            'phone_no' => '0274-4812344'
        ],
        [
            'id' => 2,
            'name' => 'Dr. Dento',
            'address' => 'Jl. Gigi',
            'phone_no' => '0274-4823424'
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
            if (is_null(Doctor::find($data['id']))) {
                Doctor::create([
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'phone_no' => $data['phone_no'],
                ]);
            }
        });
    }
}
