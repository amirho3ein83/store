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
            1 => ' کالای دیجیتال ',
            2 => 'موبایل',
            3 => 'ابزار آلات',
            4 => ' زیبایی و سلامت ',
            5 => 'خانه و آشپزخانه',
            6 => 'ورزش و سفر',
            7 => 'مد و پوشاک',
            8 => ' کتاب',
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
