<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin',
            'role_id' => 'ADM',
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
                    'role_id' => $data['role_id']
                ]);
            }
        });
    }
}
