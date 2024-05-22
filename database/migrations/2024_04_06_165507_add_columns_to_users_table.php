<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('street_address');
            $table->string('apt');
            $table->string('city');
            $table->string('state');
            $table->integer('country');
            $table->string('zip')->nullable();
            $table->string('phone');
            $table->integer('vehicle_to');
            $table->integer('account_type');
            $table->integer('client_id');
            $table->integer('manager')->nullable();
            $table->integer('deposit_min')->nullable();
            $table->integer('deposit')->nullable();
            $table->integer('buy_power')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('middle_name');
            $table->dropColumn('last_name');
            $table->dropColumn('street_address');
            $table->dropColumn('apt');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('country');
            $table->dropColumn('zip');
            $table->dropColumn('phone');
            $table->dropColumn('vehicle_to');
            $table->dropColumn('account_type');
            $table->dropColumn('client_id');
            $table->dropColumn('manager');
            $table->dropColumn('deposit_min');
            $table->dropColumn('deposit');
            $table->dropColumn('buy_power');
        });
    }
};
