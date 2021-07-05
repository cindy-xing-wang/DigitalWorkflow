<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHazardReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hazard_reports', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('email');
            $table->date('date_of_hazard');
            $table->longText('description');
            $table->longText('suggestion');

            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::table('hazard_reports', function (Blueprint $table) {
            $table->dropForeign('hazard_reports_user_id_foreign');
        });

        Schema::dropIfExists('hazard_reports');
    }
}