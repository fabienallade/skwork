<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRapportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapports', function (Blueprint $table) {
            $table->increments('id');
            /*debut*/
            $table->string('name');
            $table->text("body")->nullable(true);
            $table->integer('taches_id')->unsigned();
            $table->foreign('taches_id')->references('id')->on('taches');
            $table->boolean('certifié')->nullable(true);
            /*fin*/
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
        Schema::dropIfExists('rapports');
    }
}
