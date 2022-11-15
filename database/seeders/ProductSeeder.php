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

        for ($i = 1; $i < 5; $i++) {

            $product =  Product::factory()->create([
                'title' => 'watch Rolex'
            ]);

            //set image
            File::copy(public_path('/watches/' . $i . '.webp'), public_path('/watches2/' . $i . '.webp'));

            $product->addMedia(public_path('/watches2/' . $i . '.webp'))
                ->toMediaCollection();

            for ($d = 1; $d < 5; $d++) {
                $product->availableSizes()->attach($d);
            }

            for ($f = 3; $f < 7; $f++) {
                $product->availableColors()->attach($f);
            }


            Comment::factory()->create([
                'product_id' => $i
            ]);
        }
    }
}
