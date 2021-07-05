<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OpsLog;
use App\Models\Checklist;
use App\Models\AirportInfo;
use App\Models\SupportCrew;
use Illuminate\Http\Request;
use App\Models\OpsLogByAirportView;
use Illuminate\Support\Facades\Auth;

class OpsLogController extends Controller
{
    public function index()
    {
        return view('staff.ops.index');
    }

    public function create()
    {
        return view('staff.ops.create');
    }

    public function store(Request $request)
    {
        if( $this->validateOpsCompletion($request))
        {
             $data = [
                'wind_speed' => $request->windSpeed,
                'temperature' => $request->temperature,
                'visibility' => $request->visibility,
                'drone_id' => $request->droneId,
                'pilot_id' => $request->pilotId,
                'flight_path_id' => $request->flightPathId,
                'user_id' => auth()->user()->id,
            ];

            if ($request->windSpeed > 8) {
                $data['completion'] = false;
                $data['lognote'] = 'Wind Speed was more than 8 Knots.';
            } else {
                $data['completion'] = true;
            }
            OpsLog::create($data);
            if (Auth::user()->id == 1) {
                $supportCrews = User::get();
            } else {
                $supportCrews = User::where('airport_id', '=', Auth::user()->airport_id)->get();
            }
            
            $opsLog = OpsLog::where('user_id',  Auth::user()->id)->latest()->first();
            $opsLogId = $opsLog->id;
            foreach ($supportCrews as $supportCrew) {
                $supportCrewId = $supportCrew->id;
                if ($request->$supportCrewId) {
                    $this->saveSupportCrew($supportCrewId,$opsLogId);
                }    
            }
            if ($data['completion']) {

                $checklists = Checklist::get();
                $data = [
                    'tasks' => $checklists,
                    'operationId' => $opsLogId,
                ];
                return view('staff.preFlightLog.index',compact('data'));
            } else {
                return redirect()->back()->with('message', 'Wind Speed is more than 8 Knot. Operation is canceled and a notification will be sent to the Head Office.');
            }
        }
    }

    public function edit($id)
    {
        $checklist = OpsLog::find($id);
        return view('staff.ops.edit', compact('checklist'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->logNote;
        $checklist = OpsLog::find($id);

        $checklist->logNote = $data;
        $checklist->save();
        return redirect()->route('ops.index')->with('message', 'Log Note updated successfully');
  
    }

    public function check(Request $request)
    {
        $date = $request->date;

        // find user role id, filter log results according to different roles
        if (Auth::user()->role_id==1) {
            $opsLogs = OpsLog::whereDate('created_at', $date)->get();
            return view('staff.ops.show',compact('opsLogs'));
        }
        if (Auth::user()->role_id==2|| Auth::user()->role_id==3) {
            $opsLogs = $this->filterOpsResult(Auth::user()->airport_id, $date);
            return view('staff.ops.show',compact('opsLogs'));
        }
    }

    public function validateOpsCompletion(Request $request)
    {
        return $this->validate($request,[
            'windSpeed'=>'required',
            'temperature'=>'required',
            'visibility'=>'required',
            'droneId'=>'required',
            'flightPathId'=>'required',
            'pilotId'=>'required',
        ]);
    }

    public function saveSupportCrew($user_id, $opsLogId)
    {
        $supportCrew = [
            'user_id' => $user_id,
            'ops_log_id' => $opsLogId,
        ];

        SupportCrew::create($supportCrew);
    }

    public function filterOpsResult($airport_id, $date)
    {
        $opsLogByAirport = new OpsLogByAirportView();
        return $opsLogByAirport->getOpsLog($airport_id, $date);
    }
}
