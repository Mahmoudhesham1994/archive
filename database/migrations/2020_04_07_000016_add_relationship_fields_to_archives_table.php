<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToArchivesTable extends Migration
{
    public function up()
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->unsignedInteger('doc_type_id')->nullable();
            $table->foreign('doc_type_id', 'doc_type_fk_1272867')->references('id')->on('doc_types');
        });

    }
}