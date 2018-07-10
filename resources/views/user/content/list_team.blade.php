@extends('user.layout.index')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" data-background-color="green">
                            <h3 class="title">List Teams</h3>
                        </div>
                        <div class="card-content table-responsive">
                            <table class="table table-bordered" style="color: #43a047;">
                                <thead class="form-group" style="font-size: large;">
                                    <th class="col-md-3" ">Avatar</th>
                                    <th class="col-md-2" ">Team</th>
                                    <th class="col-md-3" ">Leader</th>
                                    <th class="col-md-7" style="height: 10px; text-align: center;">Description</th>
                                </thead>
                                <tbody class="form-group">
                                    @foreach($listTeam as $team)
                                        <tr style="height: 80px;">
                                            <td>
                                                <a href="team_info/{{ $team->id }}">
                                                    <img src="{{ asset('../image/'.$team->avatar) }}" class="img-circle" alt="Team Image" style="width: 70px; height: 70px; color: #43a047;">
                                                </a>
                                            </td>
                                            <td> 
                                                <a href="team_info/{{ $team->id }}" style="color: #43a047;">
                                                {{ $team->name }}</td>
                                                </a>
                                            <td>
                                            @if($team->leader_id != null)
                                                <a href="profile/{{ $team->leader->id }}" style="color: #43a047;">
                                                {{ $team->leader->fullname }}</td>
                                                </a>
                                            @endif
                                            <td>
                                                <div>
                                                    <span>{{ $team->description }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach                                    
                                </tbody>
                            </table>
                        </div>
                         <div class="paginate" style="text-align: center;">{!! $listTeam->links() !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection