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
        Schema::create('subcentres', function (Blueprint $table) {
            $table->id('subcentre_id');
            $table->unsignedBigInteger('company_id'); // Foreign key column
            $table->unsignedBigInteger('centre_id'); // Foreign key column
            $table->string('subcentre_name'); // Subcentre name column
            $table->string('remarks'); // Remarks column
          

            // Foreign key constraints
            $table->foreign('company_id')
                  ->references('company_id')->on('companies')
                  ->onDelete('cascade');

            $table->foreign('centre_id')
                  ->references('centre_id')->on('centres')
                  ->onDelete('cascade');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcentres');
    }
};
