<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDronesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drones', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('airport_id')->nullable()->unsigned();
            $table->foreign('airport_id')->references('id')->on('airport_infos')->onDelete('SET NULL');
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
        Schema::table('drones', function (Blueprint $table) {
            $table->dropForeign('drones_airport_id_foreign');
        });
        Schema::dropIfExists('drones');
    }
}
