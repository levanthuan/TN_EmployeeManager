@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                @if ($users->count() || $teams->count() || $divs->count())
                    <div class="col-md-6">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Users</h3>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Birthday</th>
                                            <th>Team</th>
                                            <th>Division</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td><a href="profile/{{ $user->id }}">
                                                {{ $user->fullname }}</a></td>
                                            <td>{{ $user->birth_day }}</td>
                                            <td>
                                                @if ($user->team)
                                                    <a href="team_info/{{ $user->team->id }}">
                                                        {{ $user->team->name }}
                                                    </a>
                                                @else
                                                @endif
                                            <td>
                                                @if($user->teams_divisions_id)
                                                    <a href="team_division/{{ $user->division->id }}">
                                                        {{ $user->division->name }}
                                                    </a>
                                                @else
                                                @endif
                                            </td>
                                        </tr> 
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Teams</h3>
                            </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Leader</th>
                                        <th>Division</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teams as $team)
                                    <tr>
                                    <td>
                                        <a href="team_info/{{ $team->id }}">
                                        {{ $team->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($team->user)
                                            <a href="profile/{{ $team->user->id }}">
                                                {{ $team->leader->fullname }}
                                            </a>
                                        @else
                                        @endif
                                    </td>
                                    <td>
                                        @if($team->division->name)
                                            <a href="team_division/{{ $team->division->id }}">
                                                {{ $team->division->name }}
                                            </a>
                                        @else
                                        @endif
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Divisions</h3>
                            </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Leader</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($divs as $division)
                                        <tr>
                                        <td>
                                            @if($division->name)
                                                <a href="team_division/{{ $division->id }}">
                                                    {{ $division->name }}</td>
                                                </a>
                                            @else
                                            @endif
                                        </td>
                                        <td>
                                            @if($division->leader->fullname)
                                                <a href="profile/{{ $division->leader->id }}">
                                                    {{ $division->leader->fullname }}
                                                </a>
                                            @else
                                            @endif
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <h3>No result!</h3>
                    </div>
                @endif
            </div>
    <!-- /.content-wrapper -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
