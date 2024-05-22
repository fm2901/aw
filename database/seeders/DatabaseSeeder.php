<?php

namespace Database\Seeders;

use App\Models\CarState;
use App\Models\DamageLevel;
use App\Models\ToExport;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            AccountTypeSeeder::class,
            PurchasePurposeSeeder::class,
            CarStateSeeder::class,
            ExperiensePeriodSeeder::class,
            PriceRangeSeeder::class,
            VehicleToSeeder::class,
            ToExportSeeder::class,
            OrderStateSeeder::class,
            DamageLevelSeeder::class,
            MakeSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
        ]);
    }
}
