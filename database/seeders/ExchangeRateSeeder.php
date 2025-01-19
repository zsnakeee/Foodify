<?php

namespace Database\Seeders;

use App\Models\ExchangeRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExchangeRate::create([
            'currency' => 'EGP',
            'rate' => 1.0,
        ]);

        ExchangeRate::create([
            'currency' => 'USD',
            'rate' => 50.22,
        ]);

        ExchangeRate::create([
            'currency' => 'EUR',
            'rate' => 51.76,
        ]);

        ExchangeRate::create([
            'currency' => 'GBP',
            'rate' => 61.26,
        ]);

    }
}
