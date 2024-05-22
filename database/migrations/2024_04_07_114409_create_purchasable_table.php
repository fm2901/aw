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
        Schema::create('purchasable', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('purchasable_id');
            $table->string('purchasable_type');

            $table->unique([
                'user_id',
                'purchasable_id',
                'purchasable_type'
            ], 'user_purchase_uniq')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchasable');
    }
};
