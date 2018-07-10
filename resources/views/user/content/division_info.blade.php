@extends('user.layout.index')

<script src="{{ asset('../assets/js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" data-background-color="green">
                            <h3 class="title">Division {{ $division->name }}</h3>
                            <p class="category">List Teams</p>
                        </div>
                        <div class="card-content">
                            <div class="row">
                            @include('errors.note')
                                @foreach($division->teams as $team)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-avatar img-member-team">
                                                <a href="{{ route('user_team_info', ['id' => $team->id]) }}">
                                                    <img class="img img-circle" src="{{ asset('../image/'.$team->avatar) }}"/>
                                                </a>
                                            </div> 
                                            <div class="card-footer" style="text-align:center; color: #43a047;">
                                                <span>{{ $team->name }}</span><br>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile">
                        <div class="card-avatar">
                            <a>
                                <img class="img" id="division_avatar" src="{{ asset('../image/'.$division->avatar) }}" />
                            </a>
                        </div>
                        <h6>{{$division->name}}</h6>
                        <form action="{{ route('edit_division', $division->id) }}" 
                                            method="POST" role="form" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @if($division->leader_id != null && $division->leader->id == Auth::user()->id)
                                <div class="card-content upload_avatar" hidden>
                                    <input type="file" name="image">
                                </div>
                            @endif                            
                            <div class="card-footer" style="margin-top: 20px;">
                                <h6 class="card-title">Description</h6>
                                @if($division->leader_id != null && Auth::user()->id == $division->leader->id)
                                    <textarea name="description" rows="4" style="width: 100%;">{{ $division->description }}</textarea>
                                @else
                                    <label>{{ $division->description }}</label>
                                @endif
                            </div>
                            @if($division->leader_id != null && $division->leader->id == Auth::user()->id)
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
        $('#division_avatar').click(
           function () {
              $('.upload_avatar').removeAttr('hidden');
           },                 
        );
    });
</script>