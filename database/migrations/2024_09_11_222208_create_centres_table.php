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
        Schema::create('centres', function (Blueprint $table) {
            $table->id('centre_id');
            $table->unsignedBigInteger('company_id'); // Foreign key column
            $table->string('centre_name'); // Centre name column
           
            
            // Optional: Add foreign key constraint
            $table->foreign('company_id')
                  ->references('company_id')->on('companies')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centres');
    }
};
