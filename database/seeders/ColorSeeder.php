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
            1 => [
                'fa_name' => 'نقره ای',
                'en_name' => 'silver',
            ],
            2 => [
                'fa_name' => 'خرمایی',
                'en_name' => 'maroon',
            ],
            3 => [
                'fa_name' => 'آبی',
                'en_name' => 'blue',
            ],
            4 => [
                'fa_name' => 'سفید',
                'en_name' => 'white',
            ],
            5 => [
                'fa_name' => 'صورتی',
                'en_name' => 'pink',
            ],
            6 => [
                'fa_name' => 'خاکستری',
                'en_name' => 'gray',
            ],
            7 => [
                'fa_name' => 'قهوه ای',
                'en_name' => 'brown',
            ],
            8 => [
                'fa_name' => 'زرد',
                'en_name' => 'yellow',
            ],
            9 => [
                'fa_name' => 'زیتونی',
                'en_name' => 'olive',
            ],
            10 => [
                'fa_name' => 'لیمویی',
                'en_name' => 'lime',
            ],
            11 => [
                'fa_name' => 'چوبی',
                'en_name' => 'burlywood',
            ],
            12 => [
                'fa_name' => 'نارنجی',
                'en_name' => 'darkorange',
            ],
            13 => [
                'fa_name' => 'طلایی',
                'en_name' => 'gold',
            ],
            14 => [
                'fa_name' => 'آبی روشن',
                'en_name' => 'lightsteelblue',
            ],

        ];

        foreach ($colors as $key => $value) {
            Color::create([
                'fa_name' => $value['fa_name'],
                'en_name' => $value['en_name'],
            ]);
        }

    }
}
