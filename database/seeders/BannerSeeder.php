<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->banners() as $banner) {
            \App\Models\Banner::create($banner);
        }
    }

    private function banners(): array
    {
        return [
            [
                'title' => [
                    'en' => 'Grocery deals',
                    'ar' => 'عروض البقالة',
                ],
                'body' => [
                    'en' => 'Get the best deals on groceries',
                    'ar' => 'احصل على أفضل العروض على المواد الغذائية',
                ],
                'button_text' => [
                    'en' => 'Shop now',
                    'ar' => 'تسوق الآن',
                ],
                'image' => 'seeds/banners/slide-gocery1.jpg',
                'url' => route('home'),
                'is_active' => 1,
                'order' => 1,
            ],
            [
                'title' => [
                    'en' => 'Sweet Crunchy Salad',
                    'ar' => 'سلطة مقرمشة حلوة',
                ],
                'body' => [
                    'en' => 'Get the best deals on groceries',
                    'ar' => 'احصل على أفضل العروض على المواد الغذائية',
                ],
                'button_text' => [
                    'en' => 'Shop now',
                    'ar' => 'تسوق الآن',
                ],
                'image' => 'seeds/banners/slide-gocery2.jpg',
                'url' => route('products'),
                'is_active' => 1,
                'order' => 2,
            ],
            [
                'title' => [
                    'en' => 'Fresh Fruits',
                    'ar' => 'فواكه طازجة',
                ],
                'body' => [
                    'en' => 'Get the best deals on groceries',
                    'ar' => 'احصل على أفضل العروض على المواد الغذائية',
                ],
                'button_text' => [
                    'en' => 'Shop now',
                    'ar' => 'تسوق الآن',
                ],
                'image' => 'seeds/banners/slide-gocery3.jpg',
                'url' => route('products.view', Product::first()),
                'is_active' => 1,
                'order' => 3,
            ],
        ];
    }
}
