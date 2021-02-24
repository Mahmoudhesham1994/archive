<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsgStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('msg_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('msg_status_desc');
            $table->timestamps();
            $table->softDeletes();
        });

    }
}