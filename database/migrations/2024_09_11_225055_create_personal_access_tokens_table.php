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
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned(); // BIGINT(20) UNSIGNED for primary key with auto-increment
            $table->string('tokenable_type'); // VARCHAR(255) for the type of the entity that the token belongs to
            $table->bigInteger('tokenable_id')->unsigned(); // BIGINT(20) UNSIGNED for the ID of the entity
            $table->string('name'); // VARCHAR(255) for the name of the token
            $table->string('token', 64); // VARCHAR(64) for the token value
            $table->text('abilities')->nullable(); // TEXT for token abilities, can be NULL
            $table->timestamp('last_used_at')->nullable(); // TIMESTAMP for the last used date, can be NULL
            $table->timestamp('expires_at')->nullable(); // TIMESTAMP for the expiration date, can be NULL
            $table->timestamps(); // Created_at and updated_at timestamps

            // Add an index on the tokenable_type and tokenable_id columns for faster lookups
            $table->index(['tokenable_type', 'tokenable_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
