<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelHistoryTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('model-history.database.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id');
            $table->string('entity_type', 255);
            $table->integer('entity_id');
            $table->text('values');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop(config('model-history.database.table'));
    }
}
