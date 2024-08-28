<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['name' => 'Londres', 'country' => 'Reino Unido', 'currency' => 'GBP', 'currency_symbol' => '£'],
            ['name' => 'New York', 'country' => 'Estados Unidos', 'currency' => 'USD', 'currency_symbol' => '$'],
            ['name' => 'París', 'country' => 'Francia', 'currency' => 'EUR', 'currency_symbol' => '€'],
            ['name' => 'Tokio', 'country' => 'Japón', 'currency' => 'JPY', 'currency_symbol' => '¥'],
            ['name' => 'Madrid', 'country' => 'España', 'currency' => 'EUR', 'currency_symbol' => '€'],
        ]);
    }
}
