<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sender_account_id')->nullable(false);
            $table->foreign('sender_account_id')->references('id')->on('users');
            $table->unsignedInteger('receiver_account_id')->nullable(false);
            $table->foreign('receiver_account_id')->references('id')->on('users');
            $table->integer('amount')->nullable(false);
            $table->enum('type', ['national', 'international'])->nullable(false);
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
        Schema::dropIfExists('transfers');
    }
}
