<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accident_reports', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('email');
            $table->date('accident_date');
            $table->text('accident_time');
            $table->text('accident_location');
            $table->text('name_involved_party');
            $table->text('address');
            $table->date('dob');
            $table->text('phone');
            $table->longText('injury');
            $table->longText('damage');
            $table->longText('scenario');
            $table->boolean('notified')->default(false);

            $table->integer('accident_level_id')->nullable()->unsigned();
            $table->foreign('accident_level_id')->references('id')->on('accident_levels');
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
        Schema::table('accident_reports', function (Blueprint $table) {
            $table->dropForeign('accident_reports_accident_level_id_foreign');
            $table->dropForeign('accident_reports_user_id_foreign');
        });
        Schema::dropIfExists('accident_reports');
    }
}