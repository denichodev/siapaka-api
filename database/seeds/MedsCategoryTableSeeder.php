<?php

use Illuminate\Database\Seeder;
use App\MedsCategory;

class MedsCategoryTableSeeder extends Seeder
{
    private $data = [
        [
            'id' => 'FREE',
            'name' => 'Obat Bebas',
        ],
        [
            'id' => 'LFREE',
            'name' => 'Obat Bebas Terbatas',
        ],
        [
            'id' => 'POTENT',
            'name' => 'Obat Keras',
        ],
        [
            'id' => 'PSY',
            'name' => 'Obat Psikotropika',
        ],
        [
            'id' => 'HERB',
            'name' => 'Obat Herbal',
        ],
        [
            'id' => 'TRAD',
            'name' => 'Obat Tradisional',
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
            if (is_null(MedsCategory::find($data['id']))) {
                MedsCategory::create([
                    'id' => $data['id'],
                    'name' => $data['name'],
                ]);
            }
        });
    }
}
