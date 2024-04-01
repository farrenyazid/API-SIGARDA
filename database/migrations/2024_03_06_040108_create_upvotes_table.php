<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpvotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upvotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->enum('upvotable_type', ['post'])->default('post'); // Only allow "post"
            $table->unsignedBigInteger('upvotable_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('upvotable_id')->references('id')->on('posts')->onDelete('cascade'); // Update foreign key
            $table->unique(['user_id', 'upvotable_id']); // Enforce unique upvote per user-post
            $table->index(['upvotable_id']); // Index for performance
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upvotes');
    }
}
