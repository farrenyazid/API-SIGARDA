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
        Schema::create('post_logs', function (Blueprint $table) {
            $table->id();

            // Optional user ID column for tracking the user who made the change
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts');

            $table->string('action');

            $table->text('previous_title')->nullable();
            $table->text('new_title')->nullable();

            $table->string('previous_image')->nullable();
            $table->string('new_image')->nullable();

            $table->text('previous_news_content')->nullable();
            $table->text('new_news_content')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_logs');
    }
};
