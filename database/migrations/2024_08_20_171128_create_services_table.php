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
        Schema::create('services', function (Blueprint $table) {
           
            $table->id('serviceId');
            $table->string('tos');
            $table->json('partsChanged');
            $table->string('nextService');
            $table->bigInteger('amount')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('staff_id');           
            $table->foreign('customer_id')->references('individual_id')->on('individuals')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
