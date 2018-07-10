@extends('user.layout.index')
    <script src="{{asset('../assets/js/jquery-3.1.0.min.js')}}" type="text/javascript"></script>
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" data-background-color="green">
                        @if(Auth::user()->id == $user->id)
                            <h4 class="title">Edit Profile</h4>
                            <p class="category">Complete your profile</p>
                        @else
                            <h4 class="title">Profile</h4>
                        @endif
                        </div>
                        <div class="card-content">
                        @include('errors.note')
                            <form action="{{ route('user_edit_user', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Username</label>
                                            @if($user_login = Auth::user()->id == $user->id)
                                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                            @else
                                                <input type="text" class="form-control" name="name" disabled="disabled" value="{{ $user->name }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">ID</label>
                                            <input type="email" class="form-control" name="id" disabled="disabled" value="{{ $user->id }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Full Name</label>
                                            @if($user_login = Auth::user()->id == $user->id)
                                                <input type="text" class="form-control" name="fullname" disabled="disabled" value="{{ $user->fullname }}">
                                            @else
                                                <input type="text" class="form-control" name="fullname" disabled="disabled" value="{{ $user->fullname }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Position</label>
                                            @if($user->level == 1) <?php $lv = 'Super Admin'?>
                                            @elseif ($user->level == 2) <?php $lv = 'Admin'?>
                                            @elseif ($user->level == 3) <?php $lv = 'Division Leader'?>
                                            @elseif ($user->level == 4) <?php $lv = 'Team Leader'?>
                                            @elseif ($user->level == 5) <?php $lv = 'Dev'?>
                                            @endif
                                            <input type="text" class="form-control" name="level" disabled="disabled" value="{{ $lv }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email</label>
                                            @if($user_login = Auth::user()->id == $user->id)
                                                <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                                            @else
                                                <input type="text" class="form-control" name="email" disabled="disabled" value="{{ $user->email }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Team</label>
                                            @if($user->teams_id != 0)
                                                <input type="text" class="form-control" name="teamid" disabled="disabled" value="{{ $user->team->name }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Address</label>
                                            @if($user_login = Auth::user()->id == $user->id)
                                                <input type="text" class="form-control" name="address" value="{{ $user->address }}">
                                            @else
                                                <input type="text" class="form-control" name="address" disabled="disabled" value="{{ $user->address }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Team Division</label>
                                            @if($user->teams_divisions_id != 0)
                                                <input type="text" class="form-control" name="teamdivi" disabled="disabled" value="{{ $user->division->name }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Phone Number</label>
                                            @if($user_login = Auth::user()->id == $user->id)
                                                <input type="text" class="form-control" name="phone_number" value="{{ $user->phone_number }}">
                                            @else
                                                <input type="text" class="form-control" name="phone_number" disabled="disabled" value="{{ $user->phone_number }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Day Into</label>
                                        <div class="form-group label-floating" style="margin-top: 2px";>
                                            <input type="date" class="form-control" style="height: 30px" name="day_into" disabled="disabled" value="{{ $user->day_into }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                    <label class="control-label">Birthday</label>
                                        <div class="form-group label-floating" style="margin-top: 2px";>
                                            @if($user_login = Auth::user()->id == $user->id)
                                                <input type="date" class="form-control" style="height: 30px" name="birth_day" value="{{ $user->birth_day }}">
                                            @else
                                                <input type="date" class="form-control" style="height: 30px" name="birth_day" disabled="disabled" value="{{ $user->birth_day }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Gender</label>
                                        <div class="form-group label-floating" style="margin-top: 0px";>
                                            @if($user_login = Auth::user()->id == $user->id)
                                                <select class="form-control" name="gender">
                                                    @if($user->gender == null) 
                                                        <option></option>
                                                    @endif
                                                    <option value="Male" @if($user->gender == 'Male') selected="selected" @endif>Male</option>
                                                    <option value="FeMale" @if($user->gender == 'FeMale') selected="selected" @endif>FeMale</option>
                                                </select>
                                            @else
                                                <input type="text" class="form-control" name="gender" disabled="disabled" value="{{ $user->gender }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    @if($user_login = Auth::user()->id == $user->id)
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Salary</label>
                                                <input type="text" class="form-control" name="salary" disabled="disabled" value="{{ $user->salary }}">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <?php $i = 0?>
                                @foreach($profiles as $profile)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ $profile->description }}</label>
                                                <input type="text" class="form-control border-input" 
                                                    placeholder="Input value" 
                                                    name="element<?php echo '['.$i.']';?>" 
                                                    value="@if($i < count($userProfiles))
                                                            {{$userProfiles[$i]->value}}
                                                    @endif">
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++?>
                                @endforeach
                                @if($user_login = Auth::user()->id == $user->id)
                                    <button type="submit" class="btn btn-primary pull-right btn-update">Update Profile</button>
                                    <a href="{{ route('update_pass') }}">
                                        <button type="button" class="btn btn-success" style="margin-right: 30px">Change Password</button>
                                     </a>
                                    <div class="clearfix"></div>
                                @endif
                            </form>
                        </div>
                    </div>
                        <div style="margin: 0px 0 0 560px">
                            <a href="{{ route('user_list_user', ['limit' => '10']) }}">
                                <button class="btn btn-success" style="margin-right: 30px">Back</button>
                            </a>
                        </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile">
                        <div class="card-avatar">                       
                            <img class="img" id="user_avatar" src="{{asset('../image/'.$user->avatar)}}"/>
                        </div>
                        @if(Auth::user()->id == $user->id)
                            <label id="change_avatar">change avatar</label>
                        @endif
                        <div class="content">
                            <h5>{{ $user->fullname }}</h5>
                            <h6 class="category text-gray">
                                @if($user->level == 1) Super Admin
                                @elseif ($user->level == 2) Admin
                                @elseif ($user->level == 3) Leader Devision
                                @elseif ($user->level == 4) Team Leader
                                @elseif ($user->level == 5) User
                                @endif
                            </h6>
                        </div>
                        @if(Auth::user()->id == $user->id)
                            <div class="card-footer upload_img" hidden style="margin-bottom: 10px;">
                                <form action="{{ route('user_change_avatar', Auth::user()->id) }}" 
                                            method="POST" role="form" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="file" name="image" class="form-group">
                                    <button type="submit" class="btn btn-success">Change avatar</button>
                                </form>
                            </div>
                        @endif
                    </div>
                    @if($user->teams_divisions_id != 0 || $user->teams_id != 0)
                        <div class="card card-profile">
                            <div class="content">
                                @if($user->teams_id != 0)
                                    <h4 class="card-title">Team</h4>
                                    <div class="card card-stats">
                                        <div class="card-header img-team">
                                            <a href="{{ route('user_team_info', ['id' => $user->team->id]) }}">
                                                <img class="img" src="{{asset('../image/'.$user->team->avatar)}}" />
                                            </a>
                                        </div>
                                        <div class="card-content">
                                            <p class="category">{{ $user->team->name }}</p>
                                            <h5 class="title"><small>{{ $user->team->leader->fullname }}</small></h5>
                                        </div>
                                    </div>
                                @endif
                                @if($user->teams_divisions_id != 0)
                                    <h4 class="card-title">Division</h4>
                                    <div class="card card-stats">
                                        <div class="card-header img-team">
                                            <a href="{{ route('user_division_info', ['id' => $user->division->id]) }}">
                                                <img class="img" src="{{asset('../image/'.$user->division->avatar)}}" />
                                            </a>
                                        </div>
                                        <div class="card-content">
                                            <p class="category">{{ $user->division->name }}</p>
                                            @if($user->division->leader_id != null)
                                            <h5 class="title"><small>{{ $user->division->leader->fullname }}</small></h5>
                                            @endif
                                        </div>
                                    </div>
                                @endif                                 
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript">
    $(document).ready(function() {
        $('#user_avatar').click(
           function () {
              $('.upload_img').removeAttr('hidden');
           },                 
        );
        $('#change_avatar').click(
           function () {
              $('.upload_img').removeAttr('hidden');
           },                 
        );        
    });
</script>