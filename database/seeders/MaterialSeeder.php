<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $materials = [
            1 => [
                'fa_name' => ' شیشه',
                'en_name' => 'glass',
            ],
            2 => [
                'fa_name' => 'پلاستیک',
                'en_name' => 'plastic',
            ],
            3 => [
                'fa_name' => 'کاغذ',
                'en_name' => 'paper',
            ],
            4 => [
                'fa_name' => 'چرم',
                'en_name' => 'leather',
            ],
            5 => [
                'fa_name' => 'چوبی',
                'en_name' => 'wood',
            ],
            6 => [
                'fa_name' => 'فولاد',
                'en_name' => 'steel',
            ],
            7 => [
                'fa_name' => ' فلز',
                'en_name' => 'metal',
            ],
            8 => [
                'fa_name' => 'نانو',
                'en_name' => 'nano',
            ],


        ];

        foreach ($materials as $key => $material) {
            Material::create([
                'fa_name' => $material['fa_name'],
                'en_name' => $material['en_name'],
            ]);
        }
    }
}
