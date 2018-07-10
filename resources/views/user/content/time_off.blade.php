@extends('user.layout.index')
    <link rel="stylesheet" type="text/css" href="{{ asset('js/jquery.datetimepicker.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header" data-background-color="green">
                            <h3 class="title">Time-Off Request Form</h3>
                            <p class="category">Please fill in all blank fields</p>
                        </div>
                        <div class="card-content">
                            <div id="div_notification">
                                @include('errors.note')
                            </div>
                            <form action="time_off_request" method="post">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label>Starting On</label>
                                            <input id="datetime" name="start_time" class="datetime" value="{{ old('start_time') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label>Ending On</label>
                                            <input id="datetime" name="end_time" class="datetime" value="{{ old('end_time') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Reason</label>
                                            <input type="text" class="form-control" name="reason" value="{{ old('reason') }}">
                                        </div>
                                    </div>
                                </div>
                                <label class="checkbox-inline" style="margin-top: 15px; ">
                                    <input type="checkbox" value="on" name="ck_send_email">
                                    Send from mails
                                </label>
                                <button type="submit" class="btn btn-success pull-right" id="button_send">Send</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>            
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header" data-background-color="green">
                            <h3 class="title">Absence List</h3>
                        </div>
                        <div class="card-content table-responsive">
                            <table class="table">
                                <thead class="text-primary" style="color: #43a047; font-size: large">
                                    <th>Starting On</th>
                                    <th>Ending On</th>
                                    <th>Time Sent</th>
                                    <th>Approved</th>
                                </thead>
                                <tbody>
                                    @foreach($listTimeOffRequest as $timeOffRequest)
                                        <tr>
                                            <td>{{ $timeOffRequest->time_start }}</td>
                                            <td>{{ $timeOffRequest->time_end }}</td>
                                            <td>{{ $timeOffRequest->time_send }}</td>
                                            <td>
                                                @if($timeOffRequest->status == 'done')
                                                    <i class="material-icons">done</i>
                                                    <i class="material-icons">done</i>
                                                @elseif($timeOffRequest->status == 'div_done')
                                                    <i class="material-icons">done</i>
                                                    <i class="material-icons">close</i>
                                                @elseif($timeOffRequest->status == 'team_done')
                                                    <i class="material-icons">close</i>
                                                    <i class="material-icons">done</i>
                                                @else
                                                    <i class="material-icons">close</i>
                                                    <i class="material-icons">close</i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".datetime").datetimepicker({
            step: 5
        });
        $(document).ready(function(){
            $("#div_notification").fadeToggle(8000);
        });        
    </script>
@endsection