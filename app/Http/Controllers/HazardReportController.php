<?php

namespace App\Http\Controllers;

use App\Models\HazardReport;
use Illuminate\Http\Request;

class HazardReportController extends Controller
{
    public function index()
    {
        return view('staff.report.hazard');
    }

    public function store(Request $request)
    {
        if ($this->validateHazardForm($request)) {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'date_of_hazard' => $request->dateOfHazard,
                'description' => $request->description,
                'suggestion' => $request->suggestion,
                'user_id' => auth()->user()->id,
            ];
            
            HazardReport::create($data);
            return redirect()->route('hazardReport.index')->with('message','Hazard report completed');
        }
    }

    public function validateHazardForm(Request $request)
    {
        return $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'dateOfHazard'=>'required',
            'description'=>'required',
            'suggestion'=>'required',
        ]);
    }
}
