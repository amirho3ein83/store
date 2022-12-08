<?php

namespace Database\Seeders;

use App\Models\AmazingOffer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmazingOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $featuredProducts = Product::take(5)->get();

        foreach ($featuredProducts as $key => $product) {
            AmazingOffer::create([
                'product_id' => $product->id,
                'discount_percent' => rand(5, 30),
                'expiry_date' => Carbon::parse(Carbon::yesterday())->addHour(rand(6, 26))
            ]);
        }
    }
}
