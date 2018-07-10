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
                                    <img src="{{asset('../image/'.$team->avatar)}}" alt="..."/>
                                </div>
                                <h4 style="text-align: center;">TEAM : {{ $team->name }}</h4>
                                @if($team->description != null)
                                    <div class="panel-body" style="background-color: white">
                                        <p style="text-align: center;">
                                            {{ $team->description }}
                                        </p>
                                    </div>
                                @endif
                                @if($team->divisions_id != null)
                                    <div class="box-footer" style="text-align: center;">
                                        DIVISION: {{ $team->division->name }}
                                    </div>
                                @endif
                                <div class="box-footer" style="text-align: right;">
                                    <a href="{{route('update_team_info', ['id' => $team->id])}}">
                                        <button class="btn btn-info btn-fill">Update</button>
                                    </a>
                                </div>
                            </div>                            
                        </div>
                        <div class="col-lg-8 col-md-7 col-xs-12 col-sm-12">
                            <div class="box box-info">
                                <div class="content">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">LIST MEMBER</h3>
                                    </div>
                                    <div class="list-member content">
                                        <table class="table table-hover table-striped" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Avatar</th>
                                                    <th>Fullname</th>
                                                    <th>Position</th>
                                                </tr>
                                            <tbody>
                                                @foreach($listUser as $user)
                                                    <tr>
                                                        <td> {{$user->id}} </td>
                                                        <td style="width: 140px; height: 70px">
                                                            <a href="{{ route('profile', ['id' => $user->id]) }}">
                                                                <img src="{{asset('../image/'.$user->avatar)}}" class="img-circle" alt="User Avatar" style="width: 70px; height: 70px;">
                                                            </a>
                                                        </td>
                                                        <td> <a href="{{ route('profile', ['id' => $user->id]) }}">{{$user->fullname}}</a></td>
                                                        <td>
                                                            @if($user->level == 4)
                                                                Leader
                                                            @else
                                                                Human Resource
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach                                
                                            </tbody>                            
                                        </table>
                                    </div>
                                    <div class="box-footer btn-add-member">                             
                                        <a href="{{ route('admin_add_members', $team->id) }}">
                                            <button class="btn btn-success" id="btn-add-member">Add new members</button>
                                        </a>
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