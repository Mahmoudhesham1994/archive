<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactMessagePivotTable extends Migration
{
    public function up()
    {
        Schema::create('contact_message', function (Blueprint $table) {
            $table->unsignedInteger('message_id');
            $table->foreign('message_id', 'message_id_fk_1272492')->references('id')->on('messages')->onDelete('cascade');
            $table->unsignedInteger('contact_id');
            $table->foreign('contact_id', 'contact_id_fk_1272492')->references('id')->on('contacts')->onDelete('cascade');
        });

    }
}