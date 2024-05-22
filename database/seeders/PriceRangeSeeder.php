<?php

namespace Database\Seeders;

use App\Models\PriceRange;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('price_ranges')->truncate();

        PriceRange::create(['name' => '$500 - $5,000']);
        PriceRange::create(['name' => '$5,000 - $15,000']);
        PriceRange::create(['name' => '$15,000 - $45,000']);
        PriceRange::create(['name' => '$45,000 - $100,000']);
        PriceRange::create(['name' => '$100,000 +']);
    }
}
