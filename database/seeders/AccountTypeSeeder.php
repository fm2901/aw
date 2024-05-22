<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('account_types')->truncate();

        AccountType::create(['name' => 'Business']);
        AccountType::create(['name' => 'Personal']);
    }
}
