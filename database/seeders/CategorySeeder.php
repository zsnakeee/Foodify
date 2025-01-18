<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Sauces, Gravies & Marinades',
            'Herbs, Spices & Seasonings',
            'Oil, Vinegar & Salad Dressings',
            'Beverages, Coffee & Tea',
            'Snacks & Sweets',
            'Cooking & Baking Supplies',
            'Bakery',
            'Canned & Packaged Foods',
            'Dairy, Cheese & Eggs',
            'Fresh Fruit & Vegetables',
        ];

        $names_ar = [
            'صلصات وصلصات وتتبيلات',
            'أعشاب وتوابل وتوابل',
            'زيت وخل وصلصة السلطة',
            'مشروبات وقهوة وشاي',
            'وجبات خفيفة وحلويات',
            'مستلزمات الطهي والخبز',
            'مخبز',
            'معلبات وأطعمة معبأة',
            'منتجات الألبان والجبن والبيض',
            'الفواكه والخضروات الطازجة',
        ];

        foreach ($names as $index => $name) {
            $image = $index + 1;
            Category::create([
                'name' => [
                    'en' => $name,
                    'ar' => $names_ar[$index],
                ],
                'slug' => [
                    'en' => slug($name),
                    'ar' => slug($names_ar[$index]),
                ],
                'description' => [
                    'en' => fake()->sentence,
                    'ar' => 'هذا الوصف باللغة العربية للفئة',
                ],
                'image' => "seeds/category/$image.jpg",
            ]);
        }
    }
}
