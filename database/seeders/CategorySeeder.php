<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ' موبایل' => ['گوشی موبایل' => ['برند' => [1 => 'Apple', 2 => 'Samsung'], 'رزولوشن عکس' => [1 => '68px', 2 => '48px'], 'حافظه داخلی' => [1 => '64g', 2 => '128g'], 'مقدار RAM' => [1 => '2', 2 => '4', 3 => '6', 4 => '8']], 'لوازم چانبی موبایل' => ['برند' => [1 => 'Dala', 2 => 'Dilo']]],
            'ابزار آلات' => ['وسایل نقلیه', 'تجهیزات', 'استخر سونا', 'یراق آلات'],
            ' زیبایی و سلامت ' => ['لوازم آرایشی', 'عطر و ادکلن', 'لوازم شخصی برقی'],
            'خانه و آشپزخانه' => ['صوتی و تصویری', 'آشپزخانه', 'سرو', 'دکوراسیون', 'لوازم برقی خانگی'],
            'ورزش و سفر' => ['لوازم ورزشی', 'لوازم سفر'],
            'مد و پوشاک' => ['مردانه', 'زنانه', 'بچگانه', 'اکسسوری'],
            'کتاب و لوازم تحریر'  => ['کتاب', 'آلات موسیقی', 'بازی', 'لوازم تحریر'],
            'کتاب و لوازم تحریر'  => ['کتاب', 'آلات موسیقی', 'بازی', 'بازی و سرگرمی'],
        ];

        foreach ($categories as $category => $subCategories) {

            $category = Category::create([
                'name' => $category
            ]);

            foreach ($subCategories as $title => $attributes) {
                if (gettype($title) == 'string') {
                    $subCategory = Category::create([
                        'name' => $title,
                        'parent_id' => $category->id
                    ]);
                } else {
                    $subCategory = Category::create([
                        'name' => $attributes,
                        'parent_id' => $category->id
                    ]);
                }

                if (gettype($title) == 'string') {
                    foreach ($attributes as $attrTitle => $options) {
                        $attribute = Attribute::create([
                            'name' => $attrTitle,
                        ]);

                        foreach ($options as $key => $option) {
                            AttributeOption::create([
                                'name' => $option,
                                'attribute_id' => $attribute->id
                            ]);
                        }

                        DB::table('category_attribute')->insert(
                            [
                                'category_id' => $subCategory->id,
                                'attribute_id' => $attribute->id,
                            ]
                        );
                    }
                }
            }
        }
    }
}
