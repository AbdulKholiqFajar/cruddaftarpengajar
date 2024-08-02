<?php

namespace Database\Seeders;

use App\Models\Golongan;
use Illuminate\Database\Seeder;

class GolonganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'Golongan I',
            'Golongan II',
            'Golongan III',
            'Golongan IV',
        ];

        foreach ($datas as $data) {
            Golongan::updateOrCreate(['nama' => $data]);
        }
    }
}
