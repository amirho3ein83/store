<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
            ProductSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'email' => 'amir@amir.com',
            'password' => Hash::make('11111111'),
            'name' => 'amirshafi',
        ]);
    }
}
