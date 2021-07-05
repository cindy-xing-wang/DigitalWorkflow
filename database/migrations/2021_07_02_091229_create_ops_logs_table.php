<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ops_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('wind_speed', 4,2);
            $table->decimal('temperature', 5,2);
            $table->text('visibility');
            $table->longText('lognote')->nullable();
            $table->boolean('completion')->default(false);
            
            $table->integer('drone_id')->nullable()->unsigned();
            $table->foreign('drone_id')->references('id')->on('drones')->onDelete('SET NULL');
           
            $table->integer('flight_path_id')->nullable()->unsigned();
            $table->foreign('flight_path_id')->references('id')->on('flight_paths')->onDelete('SET NULL');
           
            $table->integer('pilot_id')->nullable()->unsigned();
            $table->foreign('pilot_id')->references('id')->on('users')->onDelete('SET NULL');
           
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
           
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
        Schema::table('ops_logs', function (Blueprint $table) {
            $table->dropForeign('ops_logs_drone_id_foreign');
            $table->dropForeign('ops_logs_flight_path_id_foreign');
            $table->dropForeign('ops_logs_pilot_id_foreign');
            $table->dropForeign('ops_logs_user_id_foreign');
        });
        Schema::dropIfExists('ops_logs');
    }
}
