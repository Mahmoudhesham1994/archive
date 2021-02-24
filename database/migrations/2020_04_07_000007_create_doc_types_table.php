<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocTypesTable extends Migration
{
    public function up()
    {
        Schema::create('doc_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('doc_type_desc');
            $table->timestamps();
            $table->softDeletes();
        });

    }
}