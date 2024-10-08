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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('order_id');
            $table->integer('state');
            $table->string('make');
            $table->string('model');
            $table->string('years');
            $table->string('colors')->nullable();
            $table->string('max_miles')->nullable();
            $table->integer('max_bid')->nullable();
            $table->integer('damage_level');
            $table->string('notes')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
