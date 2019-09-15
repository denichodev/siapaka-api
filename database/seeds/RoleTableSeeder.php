<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => 'ADM',
            'name' => 'Admin',
        ],
        [
            'id' => 'KG',
            'name' => 'Kepala Gudang',
        ],
        [
            'id' => 'APT',
            'name' => 'Apoteker',
        ],
        [
            'id' => 'KAS',
            'name' => 'Kasir',
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
            if (is_null(Role::find($data['id']))) {
                Role::create([
                    'id' => $data['id'],
                    'name' => $data['name'],
                ]);
            }
        });
    }
}
