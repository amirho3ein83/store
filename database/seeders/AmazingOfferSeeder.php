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
        $featured_products = Product::take(5)->featured()->get();

        foreach ($featured_products as $key => $product) {

            $discount_percent = (int)($product->sale_price  / $product->price * 10);

            AmazingOffer::create([
                'product_id' => $product->id,
                'discount_percent' => $discount_percent,
                'expiry_date' => Carbon::parse(Carbon::yesterday())->addHour(rand(6, 26))
            ]);
        }
    }
}
