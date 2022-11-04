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
            1 => 'Digital',
            2 => 'Mobile',
            3 => 'Tools',
            4 => 'Health',
            5 => 'Furniture',
            6 => 'Sport',
            7 => 'Clothes',
            8 => 'Stationary',
            9 => 'Accessory',
            10 => 'Game Console',
        ];

        foreach ($categories as $key => $category) {
            Category::factory()->create([
                'name' => $category
            ]);
        }
    }
}
