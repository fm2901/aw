<?php

namespace Database\Seeders;

use App\Models\VehicleTo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleToSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicle_to')->truncate();

        VehicleTo::create(['name' => 'The Business']);
        VehicleTo::create(['name' => 'The Representative']);
    }
}
