<?php

namespace Database\Seeders;

use App\Models\DamageLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DamageLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('damage_levels')->truncate();

        DamageLevel::create(['name' => 'Clean Only']);
        DamageLevel::create(['name' => 'Minor Damage']);
        DamageLevel::create(['name' => 'Moderate Damage']);
        DamageLevel::create(['name' => 'Severe Damage']);
    }
}
