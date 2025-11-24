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
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            
            // Link to the user who posted (Foreign Key)
            // This ensures if a user is deleted, their tweets are also deleted (cascade)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Tweet content with max limit of 280 characters
            $table->string('content', 280);
            
            // Handles created_at and updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweets');
    }
};