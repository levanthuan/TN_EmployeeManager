@extends('user.layout.index')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-sm-11 col-xs-11">
                    <div class="card">
                        <div class="card-header" data-background-color="green">
                            <h3 class="title">Notifications</h3>
                            <p class="category"></p>
                        </div>
                        <div class="card-content list-notification">
							@include('user.content.list_notification')
                    	</div>
                	</div>
            	</div>

            <!-- Upcoming Birthday Table -->
            	<div class="col-md-4 col-sm-12 col-xs-12">
            		<div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header" data-background-color="green" style="background-color: #BBBBBB">
                                <h4 class="box-title">Upcoming Birthdays</h4>
                            </div>
                                <!-- /.box-header -->
                                <div class="card-content">
                                    <table class="table table-hover table-bordered table-striped" style="color: #43a047;">
                                        <thead>
                                        <tr style="font-size: large;">
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Birthday</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($listUserBirthday != null)
                                            @foreach($listUserBirthday as $birthday)
                                                <tr>
                                                    <td style="margin-left: 20px">
                                                        {{$birthday->id}}
                                                    </td>
                                                    <td><a href="{{ route('user_profile', ['id' => $birthday->id]) }}">
                                                            {{$birthday->fullname}}</a>
                                                    </td>
                                                    <td>{{$birthday->birth_day}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if($listUserBirthday2 != null)
                                            @foreach($listUserBirthday2 as $birthday)
                                                <tr>
                                                    <td style="margin-left: 20px">
                                                        {{$birthday->id}}
                                                    </td>
                                                    <td><a href="{{ route('user_profile', ['id' => $birthday->id]) }}" style="color: #43a047;">
                                                            {{$birthday->fullname}}</a>
                                                    </td>
                                                    <td>{{$birthday->birth_day}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if($listUserBirthday3 != null)
                                            @foreach($listUserBirthday3 as $birthday)
                                                <tr>
                                                    <td style="margin-left: 20px">
                                                        {{$birthday->id}}
                                                    </td>
                                                    <td><a href="{{ route('user_profile', ['id' => $birthday->id]) }}" style="color: #43a047;">
                                                            {{$birthday->fullname}}</a>
                                                    </td>
                                                    <td>{{$birthday->birth_day}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix card-content">
                                    <a href="{{ route('user_list_birthday') }}" class="btn btn-sm btn-success btn-flat pull-right">View All</a>
                                </div>
                                <!-- /.box-footer -->
                            </div>
                        </div>
            <!-- List Team Table -->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                			<div class="card">
                                <div class="card-header" data-background-color="green">
                                    <h4 class="title">Teams</h4>
                                </div>
                                <div class="card-content">
                                    <tbody class="form-group">
                                        <tr>
                                            @foreach($listTeam as $team)
                                                <tr class="col-md-6 col-sm-12 col-xs-12">
                                                    <td>
                                                        <a href="{{ route('user_team_info', ['id' => $team->id]) }}">
                                                            <img src="{{ asset('../image/'.$team->avatar) }}" class="img-circle" alt="Team Image" style="width: 70px; height: 70px; color: #43a047;">
                                                        </a>
                                                    </td>
                                                    <td style="color: #43a047;" class="pull-right"> {{ $team->name }} </td>
                                                </tr>
                                            @endforeach
                                        </tr>
                                    </tbody>
                            	</div>
                            </div>
                        </div>
            		</div>
            	</div>
        	</div>
    	</div>
	</div>
@endsection