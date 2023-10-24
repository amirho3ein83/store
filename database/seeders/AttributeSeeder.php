<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $attributes = [
            1 => 'سایز',
            2 => 'جنس',
            3 => 'نوع',
            4 => 'ظرفیت حافظه RAM',
            5 => 'سری پردازنده',
        ];

        foreach ($attributes as $key => $attr) {
            Attribute::create([
                'name' => $attr,
            ]);
        }
    }
}
