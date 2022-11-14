<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            1 => 'XS',
            2 => 'S',
            3 => 'M',
            4 => 'L',
            5 => 'XL',
            6 => 'XXL',
            7 => 'XXXL'
        ];

        foreach ($sizes as $key => $size) {
            Size::factory()->create([
                'name' => $size
            ]);
        }    }
}
