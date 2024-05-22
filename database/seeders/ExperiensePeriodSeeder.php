<?php

namespace Database\Seeders;

use App\Models\ExperiensePeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperiensePeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('experiense_periods')->truncate();

        ExperiensePeriod::create(['name' => 'Less than 1 year']);
        ExperiensePeriod::create(['name' => '1 - 3 years']);
        ExperiensePeriod::create(['name' => '4 - 9 years']);
        ExperiensePeriod::create(['name' => '10 years +']);
    }
}
