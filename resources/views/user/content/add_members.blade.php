@extends('user.layout.index')

@section('content')
    <div class="hide" data-route={{ url('user/search_add_mem') }}> 
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="card">
                            <div class="card-header" data-background-color="green">
                                <h3 class="title">Team {{ $team->name }}</h4>
                            </div>
                            <div class="card-content table-responsive">
                                <table class="table">
                                    <tbody>
                                        @foreach($usersTeam as $user)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('user_profile', ['id'=> $user->id])}}" style="color: #43a047;">
                                                    {{ $user->fullname }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($user->id != Auth::user()->id && Auth::user()->team->id == $team->id && Auth::user()->level <= 4)
                                                        <form action="{{ action('UserController@putRemove', $user->id) }}" method="GET">    
                                                            <button type = 'submit', class = 'btn btn-danger btn-xs delete-button pull-right'> 
                                                            Delete</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>                                    
                                        @endforeach  
                                    </tbody>
                                </table>
                                <div style="text-align: center; color: #43a047;">{{ $usersTeam->render() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->team->id == $team->id && Auth::user()->level <= 4)
                    <div class="col-md-6">
                        <form action="{{ route('user_search') }}" method="post" role="search">
                            {{ csrf_field() }}
                            <div class="col-md-12 bg-white "> 
                                <div class="form-group  is-empty">
                                    <input type="text" class="form-control" placeholder="Add a member..." name="key" id="search-input-1" data-team-id="{{ $team->id }}" data-div-id="{{ $team->divisions_id }}">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </form>
                        <div class="search-area col-md-12"></div>
                    </div>  
                @endif  
            </div>
        </div>
    </div>
@endsection