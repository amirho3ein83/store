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
            7 => '4',
            7 => '4.5',
            7 => '5',
            7 => '5.5',
            7 => '6',
            7 => '6.5',
            7 => '7',
            7 => '7.5',
            7 => '8',
            7 => '8.5',
            7 => '9',
            7 => '9.5',
            7 => '10',
            7 => '10.5',
            7 => '11',
            7 => '11.5',
            7 => '12',
            7 => '12.5',
            7 => '13',
            7 => '13.5',
            7 => '14.5',
            7 => '14',
            7 => '15',
        ];

        foreach ($sizes as $key => $size) {
            Size::create([
                'name' => $size
            ]);
        }
    }
}
