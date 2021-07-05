<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightPathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_paths', function (Blueprint $table) {
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
        Schema::table('flight_paths', function (Blueprint $table) {
            $table->dropForeign('flight_paths_airport_id_foreign');
        });
        Schema::dropIfExists('flight_paths');
    }
}
