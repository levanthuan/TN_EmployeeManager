@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="box box-info" style="min-height: 500px;">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="font-size: 30px; color: #0000cc; margin: 5px;">Time off request</h3>
                        </div>
                        <br>
                        <div class="box-content" style="margin: 10px;">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user-2 content" style="background: wheat;">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-green">
                                    <div class="widget-user-image">
                                        <img class="img-circle" src="{{asset('../image/'.$timeOffRequest->user->avatar)}}" alt="User Avatar">
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <h3 class="widget-user-username">{{ $timeOffRequest->user->fullname }}</h3>
                                    <h5 class="widget-user-desc">{{ $timeOffRequest->user->birth_day }}</h5>
                                </div>
                                <div class="box-footer no-padding">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                    <ul class="nav nav-stacked" style="font-size: medium; color: #0000cc">
                                        <br>
                                        <li class="row">                                         
                                            @if($timeOffRequest->user->teams_id != 0)
                                                <b style="color: #ff3d00" class="col-md-2">Team: </b>
                                                {{ $timeOffRequest->user->team->name }}
                                            @endif
                                        </li>
                                        <br>
                                        <li class="row">
                                            @if($timeOffRequest->user->teams_divisions_id != 0)
                                                <b style="color: #ff3d00" class="col-md-2">Team Division: </b>
                                                {{ $timeOffRequest->user->division->name }}
                                            @endif
                                        </li>                                        
                                        <br>
                                        <li class="row">
                                            <b style="color: #ff3d00" class="col-md-2">Date time off: </b>
                                            {{ $timeOffRequest->time_start }} 
                                            --> {{ $timeOffRequest->time_end }}
                                        </li>
                                        <br>
                                        <li class="row">
                                            <b style="color: #ff3d00" class="col-md-2">Time send:</b>
                                            {{ $timeOffRequest->time_send    }}
                                        </li>
                                        <br>
                                        <li class="row">
                                            <b style="color: #ff3d00" class="col-md-2">Reason:</b>
                                            {{ $timeOffRequest->reason }}
                                        </li>
                                        <br>
                                        <li class="row">
                                            <b style="color: #ff3d00" class="col-md-2">Status: </b>
                                            @if($timeOffRequest->status == 'done')
                                                Accepted
                                            @endif
                                            @if($timeOffRequest->status == 'none')
                                                None
                                            @endif
                                            @if($timeOffRequest->status == 'div_done')
                                                Leader division accepted
                                            @endif
                                            @if($timeOffRequest->status == 'team_done')
                                                Team leader accepted
                                            @endif
                                        </li>
                                        <br>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection