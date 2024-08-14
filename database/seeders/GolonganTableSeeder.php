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
        // Data baru yang ingin dimasukkan
        $datas = [
            1, 
            2, 
            3,
            4, 
        ];

        foreach ($datas as $data) {
            Golongan::updateOrCreate(['nama' => $data]);
        }
    }
}
