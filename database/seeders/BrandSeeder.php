<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Nescafe',
            'Abu Auf',
            'Imtenan',
            'Al Doha',
            'Rehana',
            'AFIA',
            'Lavazza',
            'Cadbury',
            'ELMALEKA',
            'Lipton',
        ];

        $names_ar = [
            'نسكافيه',
            'أبو عوف',
            'امتنان',
            'الدوحة',
            'ريحانة',
            'عافية',
            'لافازا',
            'كادبوري',
            'الملكة',
            'ليبتون',
        ];

        $names = ['Dior', 'Sailor', 'Tomosa', 'Cofox', 'Adidssi', 'Paopi', 'Lotoria', 'Monjon', 'Adidas', 'Carogi'];
        foreach ($names as $key => $name) {
            $index = $key + 1;
            Brand::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => fake()->sentence,
                'image' => "brand/brand-$index.png",
            ]);
        }
    }
}
