<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportCrewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_crews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->integer('ops_log_id')->nullable()->unsigned();
            $table->foreign('ops_log_id')->references('id')->on('ops_logs')->onDelete('SET NULL');
           
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
        Schema::table('support_crews', function (Blueprint $table) {
            $table->dropForeign('support_crews_user_id_foreign');
            $table->dropForeign('support_crews_ops_log_id_foreign');
        });
        Schema::dropIfExists('support_crews');
    }
}
