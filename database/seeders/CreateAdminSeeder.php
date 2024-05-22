<?php

namespace Database\Seeders;

use App\Models\AccountType;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_user')->truncate();

        DB::insert("INSERT INTO role_user(user_id, role_id) VALUES(1,1)");
    }
}
