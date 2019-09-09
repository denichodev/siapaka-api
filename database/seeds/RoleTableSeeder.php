<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['id' => 'ADM', 'name' => 'Admin']);
        Role::create(['id' => 'KG', 'name' => 'Kepala Gudang']);
        Role::create(['id' => 'APT', 'name' => 'Apoteker']);
        Role::create(['id' => 'KAS', 'name' => 'Kasir']);
    }
}
