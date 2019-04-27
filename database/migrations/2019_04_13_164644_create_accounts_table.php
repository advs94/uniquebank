<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('balance')->nullable(false);
            $table->smallInteger('pin')->nullable(false);
            $table->decimal('nib', 21, 0)->unique()->nullable(false);
            $table->string('iban')->unique()->nullable(false);
            $table->unsignedInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('type', ['checking', 'savings'])->nullable(false);
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
        Schema::dropIfExists('accounts');
    }
}
