@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="font-size: 30px; margin: 5px;">LIST TEAM</h3>
                            <a href="{{route('new_user')}}" class="btn btn-success pull-right" style="margin-right: 10px; font-size: 20px; color: white;" data-toggle="tooltip" data-placement="left" title="create new user">                                
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                 Add new
                            </a> 
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped table-bordered">
                                @include('errors.note')
                                <thead>
                                    <tr style="font-size: large">
                                        <th style="text-align: center">ID</th>
                                        <th style="text-align: center">Avatar</th>     
                                        <th style="text-align: center">Name</th>
                                        <th style="text-align: center">Description</th>
                                        <th style="text-align: center">Leader</th>
                                        <th style="text-align: center">Division</th>
                                        <th style="text-align: center">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($listTeam as $team)
                                        <tr>
                                            <td style="text-align: center"> <a href="{{ route('team_info', ['id' => $team->id]) }}">{{$team->id}} </a></td>
                                            <td style="width: 140px; height: 70px">
                                                <a href="{{ route('team_info', ['id' => $team->id]) }}" style="">
                                                    <img src="{{asset('../image/'.$team->avatar)}}" alt="Team Avatar" style="width: 70px; height: 70px;margin-left: 25px;" class="img-circle">
                                                </a>
                                            </td>

                                            <td> <a href="{{ route('team_info', ['id' => $team->id]) }}"> {{$team->name}} </a></td>
                                            <td> <p style="margin-left: 20px;margin-right: 20px">{{$team->description}}</p></td>
                                            <td> 
                                                @if($team->leader_id != '')
                                                    <a href="{{ route('profile', ['id' => $team->leader->id]) }}"> 
                                                    {{$team->leader->fullname}} </a>
                                                @endif
                                            </td>
                                            @if($team->divisions_id != '')
                                                <td> <a href="{{ route('team_division', ['id' => $team->division->id]) }}">{{$team->division->name}} </a>
                                                </td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td style="text-align: center"> 
                                                <a href="{{route('update_team_info', ['id' => $team->id])}}" 
                                                    style="margin: 10px;" 
                                                    data-toggle="tooltip" data-placement="bottom" title="edit team">
                                                    <i class="fa fa-pencil fa-1x fa-lg" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('delete_team', ['id' => $team->id]) }}" 
                                                    onclick="return confirm('Are you sure you want to delete?');" data-toggle="tooltip" data-placement="bottom" title="delete team">
                                                    <i class="fa fa-trash-o fa-1x fa-lg" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="paginate" style="text-align: center;">{!! $listTeam->links() !!}</div>
                        </div>
                    </div>
                </div>
            </div>
    <!-- /.content-wrapper -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection