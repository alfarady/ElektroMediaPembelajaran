<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawabans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->bigInteger('soal_id')->unsigned()->nullable();
            $table->bigInteger('pilihan_id')->unsigned()->nullable();
            $table->boolean('is_true');
            $table->string('jawaban');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('soal_id')->references('id')->on('soals');
            $table->foreign('pilihan_id')->references('id')->on('pilihans');
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
        Schema::dropIfExists('jawabans');
    }
}
