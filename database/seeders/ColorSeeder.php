<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            1 => 'red',
            2 => 'blue',
            3 => 'black',
            4 => 'white',
            5 => 'pink',
            6 => 'gray',
            7 => 'brown',
            8 => 'yellow',
            9 => 'purple',
        ];

        foreach ($colors as $key => $color) {
            Color::factory()->create([
                'name' => $color
            ]);
        }
    }
}
