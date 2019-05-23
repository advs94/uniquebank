<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_transfer', function (Blueprint $table) {
            $table->unsignedInteger('account_id')->nullable(false);
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->unsignedInteger('transfer_id')->nullable(false);
            $table->foreign('transfer_id')->references('id')->on('transfers');
            $table->primary(['account_id', 'transfer_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_transfer');
    }
}
