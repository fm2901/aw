<?php

namespace Database\Seeders;

use App\Models\ToExport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToExportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('to_export')->truncate();

        ToExport::create(['name' => 'Yes']);
        ToExport::create(['name' => 'No']);
    }
}
