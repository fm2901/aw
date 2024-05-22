<?php

namespace Database\Seeders;

use App\Models\PurchasePurpose;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchasePurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('purchase_purposes')->truncate();

        PurchasePurpose::create(['name' => 'Personal Use']);
        PurchasePurpose::create(['name' => 'Business Use (resale, rental fleet, dismantling)']);
    }
}
