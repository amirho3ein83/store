<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            1 => 'Apple',
            2 => 'Samsung',
            3 => 'LG',
            4 => 'Rolex',
            5 => 'Snowa',
            6 => 'Sinia',
            7 => 'CIA',
            8 => 'Mac donald',
        ];

        foreach ($brands as $key => $brand) {
            Brand::factory()->create([
                'name' => $brand
            ]);
        }
    }
}
