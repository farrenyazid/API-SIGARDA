<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->enum('type', [
                'email', // Notification sent via email
                'push',  // Notification sent via push notification
                'other', // Notification sent via other channels
            ]);

            $table->text('content')->nullable(); // Notification content (optional)
            $table->text('data')->nullable(); // Additional notification data (optional)
            $table->string('channel')->nullable(); // Channel used for delivery (e.g., email address, device ID)

            $table->boolean('delivered')->default(false); // Indicates if the notification was delivered
            $table->timestamp('delivered_at')->nullable(); // Timestamp of notification delivery (if applicable)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_logs');
    }
}
