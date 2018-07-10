@extends('user.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                @if ($users->count() || $teams->count() || $divs->count())
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="card">
                        <div class="card-header" data-background-color="green">
                            <h3 class="title">Users</h3>
                        </div>
                        <div class="card-content table-responsive">
                            <table class="table">
                                <thead class="text-primary" style="color: #43a047; font-size: large;">
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
                                            <td><a href="profile/{{ $user->id }}" style="color: #43a047;">
                                                {{ $user->fullname }}</a></td>
                                            <td style="color: #43a047;">{{ $user->birth_day }}</td>
                                            <td>
                                                @if ($user->team)
                                                    <a href="team_info/{{ $user->team->id }}" style="color: #43a047;">
                                                        {{ $user->team->name }}
                                                    </a>
                                                @else
                                                @endif
                                            <td>
                                                @if($user->teams_divisions_id)
                                                    <a href="division_info/{{ $user->division->id }}" style="color: #43a047;">
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
                    </div>
                    <div class="col-md-6"> 
                        <div class="card">
                            <div class="card-header" data-background-color="green">
                                <h3 class="title">Teams</h3>
                            </div>
                            <div class="card-content table-responsive">
                                <table class="table">
                                        <thead class="text-primary">
                                            <tr style="color: #43a047; font-size: large;">                           
                                                <th>Name</th>
                                                <th>Leader</th>
                                                <th>Division</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($teams as $team)
                                            <tr>
                                            <td>
                                                <a href="team_info/{{ $team->id }}" style="color: #43a047;">
                                                {{ $team->name }}
                                                </a>
                                            </td>
                                            <td>
                                                @if($team->user)
                                                    <a href="profile/{{ $team->user->id }}" style="color: #43a047;">
                                                        {{ $team->leader->fullname }}
                                                    </a>
                                                @else
                                                @endif
                                            </td>
                                            <td>
                                                @if($team->division->name)
                                                    <a href="division_info/{{ $team->division->id }}" style="color: #43a047;">
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
                    </div>
                        <div class="col-md-6"> 
                        <div class="box box-info">
                            <div class="card">
                                <div class="card-header" data-background-color="green">
                                    <h3 class="title">Divisions</h3>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                            <thead class="text-primary">
                                                <tr style="color: #43a047; font-size: large;">
                                                    <th>Name</th>
                                                    <th>Leader</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($divs as $division)
                                                <tr style="color: #43a047;">
                                                <td>
                                                    @if($division->name)
                                                        <a href="division_info/{{ $division->id }}" style="color: #43a047;">
                                                            {{ $division->name }}</td>
                                                        </a>
                                                    @else
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($division->leader->fullname)
                                                        <a href="profile/{{ $division->leader->id }}" style="color: #43a047;">
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
