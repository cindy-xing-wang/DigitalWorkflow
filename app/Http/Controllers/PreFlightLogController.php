<?php

namespace App\Http\Controllers;

use Excel;
use App\Models\OpsLog;
use App\Models\Checklist;
// use App\Models\OpsLogView;
use App\Models\ChecklistLog;
// use App\Models\ProcedureLog;
use Illuminate\Http\Request;
// use App\Mail\PreFlightLogEmail;
// use App\Models\PreFlightLogView;
// use App\Exports\OpsLogViewExport;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;
use App\Exports\OpsLogViewMultiSheetExport;

class PreFlightLogController extends Controller
{
    public function store(Request $request)
    {
        // Find the latest operation log created by the user
        $operationLog = OpsLog::where('user_id',  Auth::user()->id)->latest()->first();
        $operationLog->lognote = $request->logNote;
        $operationLog->save();
        $preFlightTasks = Checklist::get();
        $checklistCount = 0;
        foreach ($preFlightTasks as $preFlightTask) {
            $checklistId = $preFlightTask->id;
            if ($request->$checklistId) {
                $operationLogId = $operationLog->id;
                $checklistCount ++;
                $this->saveChecklist($operationLogId,$checklistId);
            }
        }
        if ($checklistCount == count($preFlightTasks)) {
            return redirect()->back()->with('message', 'The checklist was completed.');
        } else {
            $operationLog->completion = 0;
            $operationLog->save();
            return redirect()->back()->with('message', 'The checklist was not completed. A notification email will be sent to the Head Office.');
    
        }
    }

    public function saveChecklist($operationLogId,$checklistId)
    {
        $checklistData = [
            'checklist_id' => $checklistId,
            'ops_log_id' => $operationLogId,
        ];

        ChecklistLog::create($checklistData);
    }

    public function exportIntoExcel($id)
    {
        return Excel::download(new OpsLogViewMultiSheetExport($id), 'opsLogViewList.xlsx');
    }
}
