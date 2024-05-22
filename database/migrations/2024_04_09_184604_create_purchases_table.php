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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('purchase_id');
            $table->string('vin');
            $table->string('title');
            $table->integer('year');
            $table->integer('make');
            $table->string('model');
            $table->string('trim');
            $table->date('award_date');
            $table->string('auction');
            $table->string('auction_location');
            $table->string('lot');
            $table->string('invoice')->nullable();
            $table->integer('balance');
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
        Schema::dropIfExists('purchases');
    }
};
