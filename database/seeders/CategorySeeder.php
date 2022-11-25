<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            1 => 'دیجیتال',
            2 => 'موبایل',
            3 => 'ابزار آلات',
            4 => 'سلامتی',
            5 => 'مبلمان',
            6 => 'ورزشی',
            7 => 'لباس',
            8 => 'لوازم تحریر',
            9 => 'اکسسوری',
            10 => 'کنسول و بازی',
        ];

        foreach ($categories as $key => $category) {
            Category::factory()->create([
                'name' => $category
            ]);
        }
    }
}
