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
        Schema::create('master_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('商品名');
            $table->integer('price')->comment('単価');
            $table->text('description')->comment('商品説明');
            $table->string('image_name', 50)->default('')->comment('画像ファイル名');
            $table->timestamps();
            $table->comment('商品マスタ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_products');
    }
};
