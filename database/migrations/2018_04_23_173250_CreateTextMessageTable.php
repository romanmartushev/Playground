<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('texts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('msisdn');
            $table->string('to');
            $table->string('messageId');
            $table->string('text');
            $table->string('type');
            $table->string('keyword');
            $table->string('message_timestamp');
            $table->string('concat');
            $table->string('concat_ref');
            $table->string('concat_total');
            $table->string('concat_part');
            $table->rememberToken();
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
        Schema::dropIfExists('texts');
    }
}
