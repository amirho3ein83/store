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



// $categories = [
//     ' کالای دیجیتال ' => ['دوربین' => ['klk'], 'لوازم چانبی', 'لپ تاپ' => ['سری پردازنده','ظرفیت حافظه RAM'], 'کامپیوتر', 'ساعت', 'تبلت'=> ['برند', 'رزولوشن عکس', 'حافظه داخلی', 'مقدار RAM'], 'کنسول بازی'],
//     '  موبایل ' => ['گوشی موبایل' => ['برند', 'رزولوشن عکس', 'حافظه داخلی', 'مقدار RAM'], 'لوازم چانبی موبایل' => ['برند']],
//     'ابزار آلات' => ['وسایل نقلیه', 'تجهیزات', 'استخر سونا', 'یراق آلات'],
//     ' زیبایی و سلامت ' => ['لوازم آرایشی', 'عطر و ادکلن', 'لوازم شخصی برقی'],
//     'خانه و آشپزخانه' => ['صوتی و تصویری', 'آشپزخانه', 'سرو', 'دکوراسیون', 'لوازم برقی خانگی'],
//     'ورزش و سفر' => ['لوازم ورزشی', 'لوازم سفر'],
//     'مد و پوشاک' => ['مردانه', 'زنانه', 'بچگانه', 'اکسسوری'],
//     'کتاب و لوازم تحریر'  => ['کتاب', 'آلات موسیقی', 'بازی', 'لوازم تحریر'],
// ];

// foreach ($categories as $category => $subCategories) {

//     $category = Category::create([
//         'name' => $category
//     ]);

//     foreach ($subCategories as $title => $attributes) {
//         Category::create([
//             'name' => $title,
//             'parent_id' => $category->id
//         ]);

//         foreach ($attributes as $attrTitle) {
//             $attribute = Attribute::create([
//                 'name' => $attrTitle,
//                 'parent_id' => $category->id
//             ]);

//             DB::table('category_attribute')->insert(
//                 [
//                     'category_id' => $category->id,
//                     'category_id' => $attribute->id,
//                 ]
//             );
//         }
//     }
// }