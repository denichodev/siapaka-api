<?php

use Illuminate\Database\Seeder;
use App\MedsType;

class MedsTypeTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => 'TAB',
            'name' => 'Tablet',
        ],
        [
            'id' => 'SYRUP',
            'name' => 'Syrup',
        ],
        [
            'id' => 'CAPSULE',
            'name' => 'Kapsul',
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
            if (is_null(MedsType::find($data['id']))) {
                MedsType::create([
                    'id' => $data['id'],
                    'name' => $data['name'],
                ]);
            }
        });
    }
}
