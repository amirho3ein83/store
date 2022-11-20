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
            'silver',
            'maroon',
            'blue',
            'white',
            'pink',
            'gray',
            'brown',
            'yellow',
            'fuchsia',
            'olive',
            'lime',
            'burlywood',
            'darkorange',
            'gold',
            'lightsteelblue',
            'yellowgreen',
        ];

        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
    }
}
