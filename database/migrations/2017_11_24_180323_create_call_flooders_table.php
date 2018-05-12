<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallFloodersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_flooders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('seconds');
            $table->text('numbers');
            $table->unsignedSmallInteger('num_of_calls');
            $table->integer('audio_id')->unsigned();
            $table->foreign('audio_id')->references('id')->on('audio')->onDelete('cascade');
            $table->string('from', 20);
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
        Schema::dropIfExists('call_flooders');
    }
}
