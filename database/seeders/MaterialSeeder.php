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
            1 => 'glass',
            2 => 'plastic',
            3 => 'paper',
            4 => 'leather',
            5 => 'Chemical',
            5 => 'wood',
            5 => 'steel',
            5 => 'metal',
        ];

        foreach ($materials as $key => $material) {
            Material::create([
                'name' => $material
            ]);
        }
    }
}
