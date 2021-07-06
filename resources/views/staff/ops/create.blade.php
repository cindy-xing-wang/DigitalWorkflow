@extends('admin.layouts.master')

@section('content')
      
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>Create an operation</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="row justify-content-center">
<div class="col-md-10">
    @if (Session::has('message'))
        <div class="alert alert-warning">
            {{Session::get('message')}}
        </div>
    @endif

    <span><strong>Airport name:</strong>  {{Auth::user()->airport->name}} </span><br>
<div class="card">
    <div class="card-body">
        <form class="forms-sample" enctype="multipart/form-data" action="{{route('ops.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputName1">Select A Flight Path</label>
                        <select name="flightPathId" class="form-control @error('flightPathId') is-invalid @enderror">
                                <option value="">Please select a flight path</option>
                                @if (Auth::user()->id == 1)
                                    @foreach (App\Models\FlightPath::get() as $flightPath)
                                    <option value="{{$flightPath->id}}">{{$flightPath->name}}</option>
                                    @endforeach
                                @else
                                    @foreach (App\Models\FlightPath::where('airport_id', '=', Auth::user()->airport_id)->get() as $flightPath)
                                    <option value="{{$flightPath->id}}">{{$flightPath->name}}</option>
                                    @endforeach
                                @endif
                        </select> 
                            @error('flightPathId')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputName1">Select A Drone</label>
                        <select name="droneId" class="form-control @error('droneId') is-invalid @enderror">
                            <option value="">Please select a drone</option>
                                @if (Auth::user()->id == 1)
                                    @foreach (App\Models\Drone::get() as $drone)
                                    <option value="{{$drone->id}}">{{$drone->name}}</option>
                                    @endforeach
                                @else
                                    @foreach (App\Models\Drone::where('airport_id', '=', Auth::user()->airport_id)->get() as $drone)
                                    <option value="{{$drone->id}}">{{$drone->name}}</option>
                                    @endforeach
                                @endif
                        </select> 
                            @error('droneId')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                  
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputName1">Select A Pilot</label>
                        <select name="pilotId" class="form-control @error('pilotId') is-invalid @enderror">
                            <option value="">Please select a pilot</option>
                                @if (Auth::user()->id == 1)
                                    @foreach (App\Models\User::get() as $pilot)
                                    <option value="{{$pilot->id}}">{{$pilot->name}}</option>
                                    @endforeach
                                @else
                                    @foreach (App\Models\User::where('airport_id', '=', Auth::user()->airport_id)->get() as $pilot)
                                    <option value="{{$pilot->id}}">{{$pilot->name}}</option>
                                    @endforeach
                                @endif
                        </select> 
                            @error('pilotId')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                  
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputName1">Wind Speed (Knot)</label>
                    <input type="number" min="0" class="form-control @error('wind_speed') is-invalid @enderror" value="{{ old('windSpeed') }}" id="exampleInputName1" placeholder="Wind Speed" name="windSpeed">
                    @error('wind_speed')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail3">Temperature (&deg;C)</label>
                        <input type="number" min="0" class="form-control @error('temperature') is-invalid @enderror" value="{{ old('temperature') }}" id="exampleInputEmail3" placeholder="Temperature" name="temperature">
                        @error('temperature')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputName1">Visibility (Meters)</label>
                    <input type="number" min="0" class="form-control @error('visibility') is-invalid @enderror" value="{{ old('visibility') }}" id="exampleInputName1" placeholder="Visibility" name="visibility">
                    @error('visibility')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                    <label>Choose all support crews</label>
                    <div>
                        @if (Auth::user()->id == 1)
                            @foreach (App\Models\User::get() as $supportCrew)
                            <div>
                                <input type="checkbox" id={{$supportCrew->id}} name={{$supportCrew->id}} value={{$supportCrew->id}}>
                                <label for={{$supportCrew->id}}>{{$supportCrew->name}}</label>
                            </div>
                            @endforeach
                        @else
                            @foreach (App\Models\User::where('airport_id', '=', Auth::user()->airport_id)->get() as $supportCrew)
                            <div>
                                <input type="checkbox" id={{$supportCrew->id}} name={{$supportCrew->id}} value={{$supportCrew->id}}>
                                <label for={{$supportCrew->id}}>{{$supportCrew->name}}</label>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <div>
                    </div>
                </div>
            </div>
            </div>
           
            <button type="submit" class="btn btn-primary mr-2">Next</button>
        </form>
    </div>
</div>
</div>
</div>
@endsection
