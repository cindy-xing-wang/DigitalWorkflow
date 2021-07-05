<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpsLogViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createOpsLogView());
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

    private function createOpsLogView(): string
    {
        return <<< SQL
            create VIEW ops_log_view AS
            select o.id, a.name airport, wind_speed, temperature, visibility, lognote,dro.name drone_name, fp.name flight_path_name,
                pil.name pilot_name, creu.name support_crew, u.name created_by, completion, o.created_at from ops_logs o
            inner join users u on o.user_id = u.id
            inner join support_crews cre on o.id = cre.ops_log_id
            inner join users creu on cre.user_id = creu.id 
            inner join users pil on o.pilot_id = pil.id
            inner join drones dro on o.drone_id = dro.id
            inner join flight_paths fp on o.flight_path_id = fp.id
            inner join airport_infos a on u.airport_id = a.id;
            SQL;
    }

    private function dropView(): string
    {
        return <<< SQL

            DROP VIEW IF EXISTS `ops_log_view`;
            SQL;
    }
}
