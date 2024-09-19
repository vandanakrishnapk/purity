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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->UnsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->UnsignedBigInteger('subcategoryId');
            $table->foreign('subcategoryId')->references('subcat_id')->on('subcategories')->onDelete('cascade');
            
            $table->string('product_name');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
