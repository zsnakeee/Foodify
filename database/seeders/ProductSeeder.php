<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Storage;
use Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Product::factory(50)->create();

        $names = [
            7 => [
                "Cadbury Double Chocolate Delight Biscuits - 2 Pcs (34g)pack of 9",
                "Oreo vanilla crème filled biscuit - 2 Cookies(18.4 g) pack of 12",
                "Tawtaw cocoa biscuits filled with marshmallow & coated with cocoa - 6 pouches",
                "Fitness Biscuits Plain 30g",
                "Al Abd Excellent Betefour- 14 Pieces, 250 Grams",
                "Mcvitie'S Dark Chocolate Digestive Biscuits - 28 gm - 12 Pieces",
                "Fitness Biscuits Apple & Cinnamon 30g",
                "Mcvitie'S Digestive Biscuits Milk Chocolate 28gm - 12 Pieces",
                "Tuc Original Salt Biscuit (24g) Pack of 12",
                "McVitie's Digestive Wheat Biscuits - 250gm",
                "Abu Auf Maamoul with Cinnamon (Box)",
                "Abu Auf Maamoul date (Box)",
                "Al Abd Biscuits With Chocolate Chips, 2 Pieces - 12 Packs pack may vary",
                "Classic digestive wheat biscuits - 1 kg",
                "ElShamadan Wafers Filled With Vanilla Cream Set Of 6",
                "El Abd Biscuits with Chocolate Chunks Vanilla (18 Pieces)",
            ]
        ];

        $names_ar = [
            7 => [
                "كادبوري بسكويت دبل شوكولاتة ديليت - 2 قطعة (34 جرام) عبوة من 9",
                "بسكويت أوريو بالفانيليا محشو بكريمة - 2 كوكيز (18.4 جرام) عبوة من 12",
                "بسكويت توتاو بالكاكاو محشو بالخطمي ومغطى بالكاكاو - 6 أكياس",
                "بسكويت اللياقة البدنية عادي 30 جرام",
                "العبد ممتاز بتيفور - 14 قطعة، 250 جرام",
                "بسكويت مكفيتيز الداكن بالشوكولاتة الداكنة - 28 جم - 12 قطعة",
                "بسكويت اللياقة البدنية تفاح وقرفة 30 جرام",
                "بسكويت مكفيتيز الهضمي بالشوكولاتة الحليبية 28 جم - 12 قطعة",
                "بسكويت توك الأصلي بالملح (24 جرام) عبوة من 12",
                "بسكويت القمح الهضمي مكفيتيز - 250 جم",
                "أبو عوف معمول بالقرفة (صندوق)",
                "أبو عوف معمول بالتمر (صندوق)",
                "بسكويت العبد بشرائح الشوكولاتة، 2 قطعة - 12 عبوة قد تختلف العبوة",
                "بسكويت القمح الهضمي الكلاسيكي - 1 كجم",
                "ويفر الشمادان محشو بكريمة الفانيليا مجموعة من 6",
                "بسكويت العبد بشرائح الشوكولاتة الفانيليا (18 قطعة)",
            ]
        ];


        $categories = Category::all();
        foreach ($categories as $category) {
            foreach ($names[$category->id] ?? [] as $index => $name) {
                $image = $index + 1;
                $image_path = "seeds/products/{$category->id}/$image.jpg";
                Product::factory()->create([
                    'category_id' => $category->id,
                    'name' => [
                        'en' => $name,
                        'ar' => $names_ar[$category->id][$index],
                    ],
                    'code' => Str::random(5),
                    'description' => [
                        'en' => fake()->sentence,
                        'ar' => 'هذا الوصف باللغة العربية للمنتج',
                    ],
                    'slug' => [
                        'en' => Str::slug($name),
                        'ar' => Str::slug($names_ar[$category->id][$index]),
                    ],
                    'image' => $image_path,
                    'gallery' => [$image_path, $image_path],
                ]);
            }
        }


    }
}
