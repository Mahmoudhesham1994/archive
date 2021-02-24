<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMessagesTable extends Migration
{
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedInteger('doc_type_id')->nullable();
            $table->foreign('doc_type_id', 'doc_type_fk_1272440')->references('id')->on('doc_types');
            $table->unsignedInteger('from_contact_id')->nullable();
            $table->foreign('from_contact_id', 'from_contact_fk_1272444')->references('id')->on('contacts');
            $table->unsignedInteger('priority_id')->nullable();
            $table->foreign('priority_id', 'priority_fk_1272445')->references('id')->on('priorities');
            $table->unsignedInteger('msg_type_id');
            $table->foreign('msg_type_id', 'msg_type_fk_1272479')->references('id')->on('msg_types');
            $table->unsignedInteger('rel_num_id')->nullable();
            $table->foreign('rel_num_id', 'rel_num_fk_1272480')->references('id')->on('messages');
            $table->unsignedInteger('forward_to_id')->nullable();
            $table->foreign('forward_to_id', 'forward_to_fk_1272493')->references('id')->on('contacts');
        });

    }
}