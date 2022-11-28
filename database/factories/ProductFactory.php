<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = Str::random(6) . '-کالا';
        $price = mt_rand(5, 120);
        $price *= 1000;

        $desc = 'آیفون 14 پلاس نسخه پایه‌ای ایفون‌های جدید با نمایشگر بزرگ‌تر است. به نوعی سری ایفون‌ 14 چهار گوشی به نام‌های ایفون 14، ایفون 14 پرو، ایفون 14 مکس و آيفون 14 پرو مکس را شامل خواهد شد که دو مدل 14 پرو و 14 نمایشگرهای 14 پرو مکس به پنل‌های 6.7 اینچی مجهز می‌شوند.

آیفون 14 و آیفون 14 پلاس به قابلیت‌های تازه‌ای مجهز شده‌اند و البته بعد از سال‌ها، اپل تصمیم گرفته از تراشه جدید برای آن‌‌ها استفاده نکند.';

        $details = 'دو سیم‌ کارت ظرفیت 512 گیگابایت و رم 6';

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $desc,
            'details' => $details,
            'default_price' => $price,
            'sold_qty' => rand(144, 254),
            'brand_id' => rand(1, 8),
            'stock' => rand(10, 30),
            'rate' => mt_rand(10, 50) / 10,
            'reviews' => rand(10, 30),
            'featured' => rand(1, 0)
        ];
    }
}
