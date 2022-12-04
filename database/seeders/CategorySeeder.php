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
            ' کالای دیجیتال ' => ['دوربین', 'لوازم چانبی', 'لپ تاپ', 'کامپیوتر', 'ساعت', 'تبلت', 'کنسول بازی'],
            '  موبایل ' => ['گوشی موبایل', 'لوازم چانبی موبایل'],
            'ابزار آلات' => ['وسایل نقلیه', 'تجهیزات', 'استخر سونا', 'یراق آلات'],
            ' زیبایی و سلامت ' => ['لوازم آرایشی', 'عطر و ادکلن', 'لوازم شخصی برقی'],
            'خانه و آشپزخانه' => ['صوتی و تصویری', 'آشپزخانه', 'سرو', 'دکوراسیون', 'لوازم برقی خانگی'],
            'ورزش و سفر' => ['لوازم ورزشی', 'لوازم سفر'],
            'مد و پوشاک' => ['مردانه', 'زنانه', 'بچگانه', 'اکسسوری'],
            'کتاب و لوازم تحریر'  => ['کتاب', 'آلات موسیقی', 'بازی', 'لوازم تحریر'],
        ];

        foreach ($categories as $category => $subCategories) {

            $category = Category::create([
                'name' => $category
            ]);

            foreach ($subCategories as $key => $subCategory) {
                $subCategory = Category::create([
                    'name' => $subCategory,
                    'parent_id' => $category->id
                ]);
            }
        }
    }
}
