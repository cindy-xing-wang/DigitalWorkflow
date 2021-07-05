<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreFlightLogViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createPreFlightLogView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }

    private function createPreFlightLogView(): string
    {
        return <<< SQL
            create VIEW pre_flight_log_view AS
            select o.id, c.name  from checklist_logs cl
            inner join checklists c on cl.checklist_id = c.id
            inner join ops_logs o on o.id = cl.ops_log_id;
            SQL;
    }

    private function dropView(): string
    {
        return <<< SQL

            DROP VIEW IF EXISTS `pre_flight_log_view`;
            SQL;
    }
}
