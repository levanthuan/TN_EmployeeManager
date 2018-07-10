@extends('admin.layout.index')
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/css/animate.min.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('../assets/css/paper-dashboard.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/css/themify-icons.css')}}">

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-xs-12 col-sm-12">
                            <div class="card card-user card-team-info box box-info" style="margin: 0px; margin-bottom: 20px;">
                                <div class="image" style="margin-top: 10px;">
                                    <img src="{{asset('../image/'.$division->avatar)}}" alt="..."/>
                                </div>
                                <h2 style="text-align: center;">{{ $division->name }}</h2>
                                <div class="content box-footer">
                                    <p style="text-align: center;">
                                        Leader division : 
                                        @if($division->leader_id != null)
                                            {{$division->leader->fullname}}
                                        @endif
                                    </p>
                                </div>
                                <div class="content box-footer">
                                    <p style="text-align: center;">
                                        {{$division->description}}
                                    </p>
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <a href="{{route('update_division_info', ['id' => $division->id])}}">
                                        <button class="btn btn-info btn-fill">Update</button>   
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-7 col-xs-12 col-sm-12">
                            <div class="box box-info">
                                <div class="box-header with-border div-box-header" style="text-align: center">
                                    <h2>LIST TEAM</h2>
                                </div>
                                <div class="content" style="margin-top: 20px; min-height: 400px;">
                                    <div class="list-team">
                                        <div class="row">
                                            @foreach($division->teams as $team)
                                                <div class="col-md-3 col-lg-3 col-xs-12 col-sm-4" id="team-member">
                                                    <a class="member-img" href="{{ route('team_info', ['id' => $team->id]) }}">
                                                        <img  src="{{asset('../image/'.$team->avatar)}}" class="img-circle" alt="User Image">
                                                    </a>
                                                    <div class="member-info">
                                                        <h4>Team : {{$team->name}}</h4>
                                                        <div class="clear-both"></div>
                                                        @if($team->leader_id != '')
                                                            <h5>Leader : {{$team->leader->fullname}}</h5>
                                                        @endif                                      
                                                    </div>
                                                    <div class="clear-both"></div>
                                                </div>
                                            @endforeach
                                        </div>
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