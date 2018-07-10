@extends('admin.layout.index')

@section('content')
    <div class="hide" data-route="{{ url('admin/search_add_mem') }}"> 
    </div>
    <div class="content-wrapper">
    <section class="content">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="card">
                            <div class="card-header">
                                <div class="box-header with-border">
                                    <div class="box-title">Team {{ $team->name }}</div>
                                </div>
                            </div>
                            <div class="card-content table-responsive">
                                <table class="table">
                                    <tbody>
                                        @foreach($usersTeam as $user)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('user_profile', ['id'=> $user->id])}}">
                                                    {{ $user->fullname }}
                                                    </a>
                                                </td>                                                
                                                <td>
                                                    @if ($user->level != 4)
                                                        <form action="{{ action('AdminController@putRemove', $user->id) }}" method="GET">    
                                                            <button type = 'submit', class = 'btn btn-danger btn-xs delete-button pull-right'> 
                                                            Delete</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>                                    
                                        @endforeach  
                                    </tbody>
                                </table>
                                <div style="text-align: center;">{{ $usersTeam->render() }}</div>
                            </div>
                        </div>
                    </div> 
                </div>
                    <div class="col-md-6">
                        <form action="{{ route('search') }}" method="post" role="search">
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
            <!-- </div>--> 
        </div>
    </div> 
    </section>
    </div>
@endsection