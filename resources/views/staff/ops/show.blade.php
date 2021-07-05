@extends('admin.layouts.master')

@section('content')
<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
    <i class="ik ik-calendar bg-blue"></i>
    <div class="d-inline">
        <h5>Calendars</h5>
    </div>
</div>
</div>
</div>
</div>

<form action="{{route('ops.check')}}" method="post">
    @csrf
    @method('POST')
    <div class="card">
    <div class="card-header"><strong>Choose a date</strong></div>
    <div class="card-body">
        <input type="text" autocomplete="off" name="date" class="form-control datetimepicker-input" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker">
       <br>
        <button type="submit" class="btn btn-primary mr-2">Check</button>
    </div>
</div>
</form>

<div class="row">
<div class="col-md-12">
    @if (Session::has('message'))
        <div class="alert bg-success alert-success text-white" role="alert">
            {{ Session::get('message')}}
        </div>
            
    @endif
<div class="card">
<div class="card-body">
    <table class="table">
        <thead>
            <tr>
                <th class="nosort">Airport</th>
                <th class="nosort">Created By</th>
                <th  class="nosort">Created At</th>
                <th class="nosort">Completed</th>
                <th class="nosort">Update Ops Log Note</th>
                <th class="nosort">Download log file</th>

            </tr>
        </thead>
        <tbody>
            @if (count($opsLogs)>0)
                @foreach ($opsLogs as $opsLog)
                    <tr>
                        <td>
                            @php
                            $user = App\Models\User::find($opsLog->user_id);
                            @endphp
                            {{$user->airport->name }}
                        </td>
                        <td>
                            @php
                            $user = App\Models\User::find($opsLog->user_id);
                            @endphp
                            {{$user->name }}
                        </td>
                        <td>
                            {{$opsLog->created_at; }}
                        </td>
                        @php
                            if ($opsLog->completion) {
                                echo '<td>Yes</td>';
                            }  else {
                                echo '<td>No</td>';
                            }
                        @endphp
                        <td>
                            <a href="{{route('ops.edit', $opsLog->id)}} "><i class="ik ik-edit-2"></i></a>
                        </td>
                        <td><a href="{{url('/export-excel',$opsLog->id)}}">Download</a></td>
                        <td></td>
                    </tr>
                @endforeach
            @else
                <td>No records found</td>
            @endif
            
        </tbody>
    </table>
</div>
</div>
</div>
</div>
@endsection