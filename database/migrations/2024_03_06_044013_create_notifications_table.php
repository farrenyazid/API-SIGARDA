<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');

            // Notification details
            $table->enum('type', [
                'user_followed',
                'forum_recommendation',
                'post_uploaded',
                'post_upload_failed',
                'comment_on_post',
            ]); // Specific notification types
            $table->json('data'); // Notification data specific to the type

            $table->boolean('read')->default(false); // Indicates if the notification is read
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'read']); // Index for efficient read status and user lookups
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
