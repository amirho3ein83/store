<?php

namespace Database\Seeders;

use App\Models\AmazingOffer;
use App\Models\Color;
use App\Models\Comment;
use App\Models\Product;
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


        for ($i = 1; $i < 25; $i++) {

            $product =  Product::factory()->create();

            $product->categories()->attach(rand(1, 10));

            //set image
            $pic = rand(1, 11);
            File::copy(public_path('/watches/' . $pic . '.webp'), public_path('/watches2/' . $pic . '.webp'));

            $product->addMedia(public_path('/watches2/' . $pic . '.webp'))
                ->toMediaCollection();

            // $colors = Color::inRandomOrder()->take(rand(2, 5))->get();
            // foreach ($colors as $key => $color) {
            //     $product->availableColors()->attach($color->id);
            // }

            // $sizes = Size::inRandomOrder()->take(rand(3, 5))->get();
            // foreach ($sizes as $key => $size) {
            //     $product->availableSizes()->attach($size->id);
            // }

            Comment::factory()->create([
                'product_id' => $i
            ]);
        }
    }
}
