<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCommentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comment_id');
            $table->foreign('comment_id')->references('id')->on('comments');

            $table->string('action');

            $table->text('previous_content')->nullable();
            $table->text('new_content')->nullable();

            $table->unsignedBigInteger('previous_user_id')->nullable();
            $table->foreign('previous_user_id')->references('id')->on('users');

            $table->unsignedBigInteger('new_user_id')->nullable();
            $table->foreign('new_user_id')->references('id')->on('users');

            $table->timestamps();
        });

        // Not required in this approach
        // DB::statement("ALTER TABLE $table MODIFY previous_content TEXT");
        // DB::statement("ALTER TABLE $table MODIFY new_content TEXT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_logs');
    }
}
