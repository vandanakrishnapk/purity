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
        Schema::create('corporates', function (Blueprint $table) {
            $table->id('corporate_id');
            $table->unsignedBigInteger('company_name');
            $table->unsignedBigInteger('center_name');
            $table->unsignedBigInteger('sub_center');
            $table->string('located_on');
            $table->string('contact_person');
            $table->bigInteger('contact_mobile');
            $table->string('center_address'); 
            $table->unsignedBigInteger('category_id'); 
            $table->unsignedBigInteger('subcat_id');
            $table->unsignedBigInteger('product_id');  
            $table->string('filter_change_on');       
            $table->unsignedBigInteger('assigned_to');
            $table->string('remarks')->nullable(); 

            $table->foreign('company_name')->references('company_id')->on('companies')->onDelete('cascade');
            $table->foreign('center_name')->references('centre_id')->on('centres')->onDelete('cascade');
            $table->foreign('sub_center')->references('subcentre_id')->on('subcentres')->onDelete('cascade');     
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
             
            $table->foreign('subcat_id')->references('subcat_id')->on('subcategories')->onDelete('cascade');
          
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->string('purchased_from');
    
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corporates');
    }
};
