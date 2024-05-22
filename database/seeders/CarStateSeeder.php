<?php

namespace Database\Seeders;

use App\Models\CarState;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('car_states')->truncate();

        CarState::create(['name' => 'Wrecked (mostly Salvage)']);
        CarState::create(['name' => 'Intact (mostly Clean Title)']);
    }
}
