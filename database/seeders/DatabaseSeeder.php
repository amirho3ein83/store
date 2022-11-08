<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\Product;
use App\Models\Wallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'email' => 'amir@amir.com',
            'password' => Hash::make('11111111'),
            'name' => 'amirshafi',
        ]);

        Wallet::create([
            'user_id' => 1,
            'balance' => 4500,
        ]);

        Address::create([
            'text' => 'Robert Robertson, 1234 NW Bobcat Lane, St. Robert, MO 65584-5678.',
            'user_id' => 1,
            'recipient_name' => 'John',
            'mobile' => '555-1234'
        ]);



        // $wanna_like = Product::inRandomOrder()->limit(5)->get();

        // foreach ($wanna_like as $key => $product) {
        //     $product->likedBy()->attach(1);
        // }
    }
}
