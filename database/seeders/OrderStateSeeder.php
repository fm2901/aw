<?php

namespace Database\Seeders;

use App\Models\OrderState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_states')->truncate();

        OrderState::create(['name' => 'Pending Fulfillment']);
        OrderState::create(['name' => 'Fulfilled']);
        OrderState::create(['name' => 'Deleted']);
    }
}
