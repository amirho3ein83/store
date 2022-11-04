<?php

namespace Database\Seeders;

use App\Models\AmazingOffer;
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
        for ($i = 0; $i < 20; $i++) {

            $product =  Product::factory()->create();

            $pic = rand(1, 4);
            File::copy(public_path('/watches/' . $pic . '.webp'), public_path('/watches2/' . $pic . '.webp'));

            $product->addMedia(public_path('/watches2/' . $pic . '.webp'))
                ->toMediaCollection('photo');
        }

        for ($i = 1; $i <= 7; $i++) {
            AmazingOffer::create([
                'product_id' => $i,
                'expiration_date' => Carbon::now()->addHour(rand(1, 14))
            ]);
        }
    }
}
