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
        Schema::create('forum_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('forum_id');
            $table->string('action', 255);
            
            $table->string('previous_title')->nullable();  // Store the previous title
            $table->string('new_title')->nullable();  // Store the new title

            $table->string('previous_description')->nullable();  // Store the previous description
            $table->text('new_description')->nullable();  // Store the new description
            $table->timestamps();

            $table->foreign('forum_id')
                ->references('id')
                ->on('forums')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_logs');
    }
};
