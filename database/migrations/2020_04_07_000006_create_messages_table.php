<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num');
            $table->date('msg_date');
            $table->string('msg_title');
            $table->longText('msg_subject')->nullable();
            $table->string('msg_desc')->nullable();
            $table->boolean('need_replay')->default(0)->nullable();
            $table->date('replay_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}