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
        Schema::create('installations', function (Blueprint $table) {
            $table->id('installId');
            $table->string('rawWater');
            $table->json('sow');  
            $table->string('nextService');
            $table->date('mainService');
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
        Schema::dropIfExists('installations');
    }
};
