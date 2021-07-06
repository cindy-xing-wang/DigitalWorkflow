@extends('admin.layouts.master')

@section('content')
      
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>Pre-flight checklist</h5>
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

<div class="card">
    <div class="card-body">
        <form class="forms-sample" enctype="multipart/form-data" action="{{route('preFlightLogs.store')}}" method="POST">
            @csrf
            {{-- <form  class="forms-sample" enctype="multipart/form-data" action="{{route('checklist.storeIssue')}}" method="POST">
                @csrf --}}
            @foreach ($data['tasks'] as $task)
                <input type="checkbox" id="preStep" name={{$task->id}} value={{$task->id}}>
                <label for=""> {{$task->name}}</label><br>
            @endforeach
            <input type="text" name="operationId" value="{{$data['operationId']}}" hidden>
            {{-- <a href="{{route('checklist.create')}}" class="btn btn-secondary mr-2">Cancel</a> --}}
            {{-- <button type="submit" class="btn btn-primary mr-2">Complete</button>
            <button class="btn btn-danger mr-2">Report Issue</button> --}}
        {{-- </form> --}}
            <br>
            <p></p>
            <div class="form-group">
                <label for="exampleTextarea1">Log Note</label>
                <textarea class="form-control" id="exampleTextarea1" rows="4"name="logNote">{{ old('lognote') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Next</button>
        </form>
    </div>
</div>
</div>
</div>
@endsection
