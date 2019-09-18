<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomerTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => '087718271562',
            'name' => 'Dencho',
        ],
        [
            'id' => '081234123412',
            'name' => 'Bayu',
        ],
        [
            'id' => '081234128394',
            'name' => 'Intan',
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
            if (is_null(Customer::find($data['id']))) {
                Customer::create([
                    'id' => $data['id'],
                    'name' => $data['name'],
                ]);
            }
        });
    }
}
