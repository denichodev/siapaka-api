<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => 1,
            'name' => 'Pak Martin',
            'email' => 'admin@gmail.com',
            'password' => 'adminsiapaka',
            'role_id' => 'ADM',
            'outlet_id' => 1
        ],
        [
            'id' => 2,
            'name' => 'Kepala Gudang',
            'email' => 'kg@gmail.com',
            'password' => 'kgsiapaka',
            'role_id' => 'KG',
            'outlet_id' => 2
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->data)->each(function ($data) {
            if (is_null(User::find($data['id']))) {
                User::create([
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'role_id' => $data['role_id'],
                    'outlet_id' => $data['outlet_id'],
                ]);
            }
        });
    }
}
