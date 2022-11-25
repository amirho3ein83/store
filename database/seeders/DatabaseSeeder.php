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
            MaterialSeeder::class,
            CriticismSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            AmazingOfferSeeder::class,
            PermissionSeeder::class
        ]);

        $admin = User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('111111'),
            'name' => 'Admin',
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'email' => 'demo@demo.com',
            'password' => Hash::make('111111'),
            'name' => 'Alexander',
        ]);

        $user->address()->create([
            'text' => 'تهران مهران خیابان فرچام کوچه ۳۲',
            'zipcode' => '1789654-5224',
            'user_id' => $user->id,
            'recipient_name' => $user->name,
            'mobile' => '09125698433'
        ]);

        $wanna_like = Product::inRandomOrder()->limit(2)->get();

        foreach ($wanna_like as $key => $product) {
            $product->likedBy()->attach($user->id);
        }
    }
}
