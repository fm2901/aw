<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->integer('balance')->nullable()->change(); // Изменение существующей колонки
        });
    }

    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->integer('balance')->nullable(false)->change(); // Возвращаем обратно
        });
    }
};
