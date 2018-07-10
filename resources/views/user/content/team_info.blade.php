@extends('user.layout.index')

<script src="{{asset('../assets/js/jquery-3.1.0.min.js')}}" type="text/javascript"></script>

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" data-background-color="green">
                            <h3 class="title">Team {{ $team->name }}</h3>
                            <p class="category">List Members</p>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                @foreach($team->users as $user)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-avatar img-member-team">
                                                <a href="{{ route('user_profile', ['id' => $user->id]) }}">
                                                    <img class="img img-circle" src="{{ asset('../image/'.$user->avatar) }}"/>
                                                </a>
                                            </div> 
                                            <div class="card-footer" style="text-align:center; color: #43a047;">
                                                <span>{{ $user->fullname }}</span><br>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        @if(Auth::user()->level == 4 && Auth::user()->team->id  == $team->id)
                            <a href="{{ route('user_add_members', ['id' => $team->id]) }}" class="card-footer" >
                                <button class="btn btn-success">Add members</button>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile">
                        <div class="card-avatar">
                            <a>
                                <img class="img" id="team_avatar" src="{{ asset('../image/'.$team->avatar) }}" />
                            </a>
                        </div>
                        <h3>{{ $team->name }}</h3>
                        @if($team->leader_id != null)
                            <h5>Team leader: {{ $team->leader->fullname }}</h5>
                        @endif
                        @if($team->divisions_id != null)
                            <h5>Division: {{ $team->division->name }}</h5>
                        @endif
                        <form action="{{ route('edit_team', $team->id) }}" 
                            method="POST" role="form" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @if($team->leader_id != null && $team->leader->id == Auth::user()->id)
                                <div class="card-content upload_avatar" hidden>
                                    <input type="file" name="image">
                                </div>
                            @endif
                            <div class="card-footer" style="margin-top: 20px;">
                                <h6 class="card-title">Description</h6>
                                @if($team->leader_id != null && Auth::user()->id == $team->leader->id)
                                    <textarea name="description" rows="4" style="width: 100%;">{{ $team->description }}</textarea>
                                @else
                                    <label>{{ $team->description }}</label>
                                @endif
                            </div>
                            @if($team->leader_id != null && $team->leader->id == Auth::user()->id)
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            @endif
                        </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript">
    $(document).ready(function() {
        $('#team_avatar').click(
           function () {
              $('.upload_avatar').removeAttr('hidden');
           },                 
        );
    });
</script>
