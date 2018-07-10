@extends('admin.layout.index')    
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/css/animate.min.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('../assets/css/paper-dashboard.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/css/themify-icons.css')}}">  
    <script src="{{asset('../assets/js/jquery-3.1.0.min.js')}}" type="text/javascript"></script>
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-xs-12 col-sm-12">
                            <div class="box box-info" style="padding: 0px">
                                <div class="content" style="padding-left: 0px; padding-right: 0px;">
                                    <div class="card card-user"">
                                        <div class="image">
                                            @if(Auth::user()->id == $user->id)
                                            <img id="user_avatar" src="{{asset('../image/change_avatar.png')}}" class="img-circle" style="position: absolute; z-index: 1;"/>
                                            @endif
                                            <img id="user_avatar" src="{{asset('../image/'.$user->avatar)}}" class="img-circle" style="z-index: 2;"/>                                            
                                        </div>
                                        <h4 style="text-align: center;">{{ $user->fullname }}</h4>
                                    </div>                                    
                                    @if(Auth::user()->id == $user->id)
                                        <div class="card-footer upload_img" hidden style="margin: 10px;">
                                            <form action="{{ route('admin_change_avatar', Auth::user()->id) }}" 
                                                        method="POST" role="form" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <input type="file" name="image" class="form-group">
                                                <button type="submit" class="btn-success">Change</button>
                                            </form>
                                            <hr>
                                        </div>                                        
                                    @endif                                    
                                    <div class="card card-team">
                                        @if($user->teams_id != 0)
                                            <div class="box-footer">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <div class="avatar">
                                                            <img src="{{asset('../image/'.$user->team->avatar)}}" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        {{ $user->team->name }}
                                                        <br/>
                                                        <span class="text-muted"><small>Leader: 
                                                        @if($user->team->leader_id != '')
                                                        {{ $user->team->leader->fullname }}</small>
                                                        @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        @endif
                                        @if($user->teams_divisions_id != 0)
                                            <div class="box-footer">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <div class="avatar">
                                                            <img src="{{asset('../image/'.$user->division->avatar)}}" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        {{ $user->division->name }}
                                                        <br/>
                                                        <span class="text-muted"><small>Leader:
                                                        @if($user->division->leader_id != null)
                                                            {{ $user->division->leader->fullname }}
                                                        @endif
                                                        </small></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        @endif
                                    </div>                                    
                                </div>
                            </div>                       
                        </div>
                        <div class="col-lg-8 col-md-7 col-xs-12 col-sm-12">
                            <div class="box box-info">
                                <div class="content">
                                    <div class="box-header with-border" style="text-align: center; padding: 0px; margin-bottom: 20px;">
                                        @if(Auth::user()->id == $user->id)
                                            <h2 style="margin-top: 0px;">My Profile</h2>
                                        @else
                                            <h2 style="margin-top: 0px;">User Profile</h2>
                                        @endif
                                    </div>
                                    @include('errors.note')
                                    <form action="{{ route('post_profile', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Company</label>
                                                    <input type="text" class="form-control border-input" readonly placeholder="Company" value="HBLAB Company">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control border-input" placeholder="Username" name="username" value="{{ $user->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email address</label>
                                                    <input class="form-control border-input" placeholder="Email" name="email" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                        </div>                                        

                                        <div class="row detailDiv">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>New password</label>
                                                    <input type="password" class="form-control border-input" placeholder="6-30 characters needed" name="new_password" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Confirm password</label>
                                                    <input type="password" class="form-control border-input" placeholder="Confirm new password" name="re_password" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="on" id="cb_change_pass" name="cb_change_pass">Change password
                                        </label>
                                        <hr>                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fullname</label>
                                                    <input type="text" class="form-control border-input" name="fullname" value="{{ $user->fullname }}">
                                                </div>
                                            </div>                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Birthday</label>
                                                    <input type="date" class="form-control border-input"
                                                        name="birth_day" value="{{ $user->birth_day }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select name="gender" class="form-control" style="width: 100%;height: 34px;">
                                                        <option value="Male" @if($user->gender == 'Male') selected @endif>Male</option>
                                                        <option value="Female" @if($user->gender == 'Female') selected @endif>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Phone number</label>
                                                    <input type="text" class="form-control border-input" 
                                                        name="phone_number" value="{{ $user->phone_number }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control border-input" placeholder="Home Address" name="address" value="{{ $user->address }}">
                                                </div>
                                            </div>
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
                                                                    @endif"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $i++?>
                                        @endforeach
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Day into</label>
                                                    <input type="date" class="form-control border-input" name="day_into" value="{{ $user->day_into }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Position</label>
                                                @if($user->level == 1)
                                                    <input type="text" class="form-control border-input" readonly value="Super Admin">
                                                @elseif($user->level == 2)
                                                    <input type="text" class="form-control border-input" readonly value="Admin">
                                                @else
                                                    <select name="position"  style="width: 100%;height: 34px;">
                                                        <option value="5" @if($user->level == 5) selected @endif>
                                                            User
                                                        </option>
                                                        <option value="4" @if($user->level == 4) selected @endif>
                                                            Team leader
                                                        </option>
                                                        <option value="3" @if($user->level == 3) selected @endif>Division leader
                                                        </option>
                                                    </select>
                                                @endif
                                            </div>
                                        </div>
                                        @if(Auth::user()->level == 1)
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Salary</label>
                                                        <input type="text" class="form-control border-input" name="salary" value="{{ $user->salary }} (vnd)">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <hr>
                                        <div style="text-align: left; margin-bottom: 10px;">
                                            <a href="<?= route('add_new_field'); ?>">
                                                <h4 class="btn btn-default">Add new field to user info</h4>
                                            </a>
                                        </div>
                                        <div style="text-align: right;">
                                            <button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
                                        </div>
                                    </form>
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
<script type="text/javascript">
    $(document).ready(function(){
        $(".detailDiv").hide();
        $('#cb_change_pass').change(function(){
            $(".detailDiv").slideToggle();
        });
        $('#user_avatar').click(
           function () {
              $('.upload_img').removeAttr('hidden');
           },                 
        );
    });
</script>
