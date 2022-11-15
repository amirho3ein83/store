<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\Product;
use App\Models\User;
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
            SizeSeeder::class,
            ColorSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            PermissionSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        $admin = User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('11111111'),
            'name' => 'Admin',
        ]);

        $admin->assignRole('admin');

        User::create([
            'email' => 'amir@amir.com',
            'password' => Hash::make('11111111'),
            'name' => 'Amirhossein',
        ]);

        Wallet::create([
            'user_id' => 2,
            'stock' => 4500,
        ]);

        Address::create([
            'text' => 'S2r 1234 NW Bobcat Lane, St. Robert, MO ghgt',
            'postal_code' => '1789654-5224',
            'user_id' => 2,
            'recipient_name' => 'Robert Robertson',
            'mobile' => '555-1234'
        ]);



        // $wanna_like = Product::inRandomOrder()->limit(5)->get();

        // foreach ($wanna_like as $key => $product) {
        //     $product->likedBy()->attach(1);
        // }
    }
}
