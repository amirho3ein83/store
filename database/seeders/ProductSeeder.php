<?php

namespace Database\Seeders;

use App\Models\AmazingOffer;
use App\Models\Color;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeQty;
use App\Models\Size;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        File::deleteDirectory(public_path('storage/images'));


        for ($i = 1; $i < 40; $i++) {

            $product =  Product::factory()->create();

            $product->categories()->attach(rand(1, 10));

            //set image
            $pic = rand(1, 11);
            File::copy(public_path('/watches/' . $pic . '.webp'), public_path('/watches2/' . $pic . '.webp'));

            $product->addMedia(public_path('/watches2/' . $pic . '.webp'))
                ->toMediaCollection();

            $productQty = 0;
            for ($h = 0; $h < rand(1, 5); $h++) {


                $color = Color::inRandomOrder()
                    ->take(1)
                    ->first();

                $size = Size::inRandomOrder()
                    ->take(1)
                    ->first();

                $items = [$product->getRawOriginal('default_price'), $product->getRawOriginal('default_price') + 100];
                $randomPrice = $items[array_rand($items)];


                $productAttribute = ProductAttribute::create([
                    'product_id' => $product->id,
                    'size_id' => $size->id,
                    'color_id' => $color->id,
                    'price' => $randomPrice

                ]);

                $productAttributeQty = ProductAttributeQty::create([
                    'qty' => rand(5, 50),
                    'product_attribute_id' => $productAttribute->id
                ]);

                $productQty += $productAttributeQty->qty;
            }

            $product->update([
                'stock' => $productQty
            ]);

            Comment::factory()->create([
                'product_id' => $i
            ]);
        }
    }
}
