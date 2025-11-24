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
        // NOTICE: We are creating 'likes' here, NOT 'tweets'
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            
            // Who liked it (Foreign Key)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Which tweet was liked (Foreign Key)
            $table->foreignId('tweet_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();

            // LOGIC PRIORITY: Ensure a user can only like a tweet ONCE
            // This prevents duplicate likes from the same user on the same tweet
            $table->unique(['user_id', 'tweet_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};