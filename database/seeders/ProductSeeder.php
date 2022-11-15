<?php

namespace Database\Seeders;

use App\Models\AmazingOffer;
use App\Models\Comment;
use App\Models\Product;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i < 2; $i++) {

            $product =  Product::factory()->create([
                'title' => 'watch Rolex'
            ]);

            //set image
            $pic = rand(1, 4);
            File::copy(public_path('/watches/' . $pic . '.webp'), public_path('/watches2/' . $pic . '.webp'));

            $product->addMedia(public_path('/watches2/' . $pic . '.webp'))
                ->toMediaCollection();


            for ($i = 1; $i < 3; $i++) {
                $product->availableSizes()->attach($i);
            }

            for ($i = 1; $i < 4; $i++) {
                $product->availableColors()->attach($i);
            }

            Comment::factory()->create([
                'product_id' => $i
            ]);
        }
    }
}
