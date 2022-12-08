<?php

namespace Database\Seeders;

use App\Models\AmazingOffer;
use App\Models\Category;
use App\Models\Color;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (!Product::exists()) {
            File::deleteDirectory(public_path('storage/images'));
        }

        $materials = [
            1 => 'شیشه',
            2 => 'پلاستیک',
            3 => 'کاغذ',
            4 => 'چرم',
            5 => 'چوب',
            6 => 'فلز',
            7 => 'نانو',
            8 => 'نخ',
            9 => 'پارچه',
        ];

        $brands = [
            1 => 'Apple',
            2 => 'Samsung',
            3 => 'Black Afghan',
            4 => 'Rolex',
            5 => 'Snowa',
            6 => 'Sinia',
            7 => 'CIA',
            8 => 'Mac donald',
        ];

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

        $skus = [
            1 => 'BD1249229',
            2 => 'SD2534234',
            3 => 'TN2345245',
            4 => 'KJ5453454',
            5 => 'PL2345345',
            6 => 'RE2524523',
            7 => 'ED4534442',
        ];


        for ($i = 1; $i < 20; $i++) {

            $title = Str::random(6) . '-کالا';
            $price = mt_rand(5, 120);
            $price *= 1000;




            $product =  Product::create([
                'title' => $title,
                'description' => Str::random(250),
                'details' => Str::random(70),
                'sold_qty' => rand(144, 254),
                'rate' => mt_rand(10, 50) / 10,
                'reviews' => rand(10, 30),
                'sku' => $skus[array_rand($skus)]
            ]);

            $categoryId = Category::sub()->inRandomOrder()->take(rand(1, 2))->pluck('id');
            $product->categories()->attach($categoryId);

            //set image
            $pic = rand(1, 15);
            File::copy(public_path('/dumpics1/' . $pic . '.webp'), public_path('/dumpics2/' . $pic . '.webp'));

            $product->addMedia(public_path('/dumpics2/' . $pic . '.webp'))
                ->toMediaCollection();

            $colorIds = Color::inRandomOrder()
                ->take(rand(1, 4))
                ->pluck('id')->toArray();

            $totalStock = 0;
            foreach ($colorIds as $key => $id) {
                $randomStock = rand(2, 14);
                $randomPrice = mt_rand(5, 1200);
                $randomPrice *= 1000;
                $product->availableColors()->attach($id, ['price' => $randomPrice, 'stock' => $randomStock]);
                $totalStock += $randomStock;
            }

            $randomSize = $sizes[array_rand($sizes)];
            $randomMaterial = $materials[array_rand($materials)];
            $randomBrand = $brands[array_rand($brands)];

            ProductAttribute::create([
                'product_id' => $product->id,
                'title' => 'سایز',
                'value' => $randomSize
            ]);
            ProductAttribute::create([
                'product_id' => $product->id,
                'title' => 'برند',
                'value' => $randomBrand
            ]);
            ProductAttribute::create([
                'product_id' => $product->id,
                'title' => 'جنس',
                'value' => $randomMaterial
            ]);

            Comment::factory(2)->create([
                'product_id' => $i
            ]);

            $defaultPrice = $product->availableColors()->where('color_id', $colorIds[0])->first()->pivot->price;

            $product->update([
                'default_price' => $defaultPrice,
                'stock' => $totalStock,
            ]);
        }
    }
}
