<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsgTypesTable extends Migration
{
    public function up()
    {
        Schema::create('msg_types', function (Blueprint $table) {
            $table->increments('id');
          $table->string('msg_type_desc');
            $table->string('msg_type_num')->nullable();;
            $table->timestamps();
            $table->softDeletes();
        });

    }
}