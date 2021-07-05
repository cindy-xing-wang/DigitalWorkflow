<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccidentReport;

class AccidentReportController extends Controller
{
    public function index()
    {
        return view('staff.report.accident');
    }
    
    public function store(Request $request)
    {
        if ($this->validateAccidentForm($request)) {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'accident_level_id'=> $request->accident_level_id,
                'accident_date'=> $request->accidentDate,
                'accident_time'=> $request->accidentTime,
                'accident_location'=> $request->accidentLocation,
                'name_involved_party'=> $request->nameInvolvedParty,
                'address'=> $request->address,
                'dob'=> $request->dateOfBirth,
                'phone'=> $request->phone,
                'injury'=> $request->injury,
                'damage'=> $request->damage,
                'scenario'=> $request->scenario,
                'notified'=> $request->notified,
                'user_id' => auth()->user()->id,
            ];
            
            AccidentReport::create($data);
            return redirect()->route('accidentReport.index')->with('message','Accident report completed');
        }
    }
    
    public function validateAccidentForm(Request $request)
    {
        // dd($request);
        return $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'accidentLevelId'=>'required',
            'accidentDate'=>'required',
            'accidentTime'=>'required',
            'accidentLocation'=>'required',
            'nameInvolvedParty'=>'required',
            'address'=>'required',
            'dateOfBirth'=>'required',
            'phone'=>'required',
            'injury'=>'required',
            'damage'=>'required',
            'scenario'=>'required',
            'notified'=>'required',
        ]);
    }
}
