@extends('user.layout.index')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" data-background-color="green">
                            <h3 class="title">List Divisions</h3>
                        </div>
                        <div class="card-content table-responsive">
                            <table class="table table-bordered" style="color: #43a047;">
                                <thead class="form-group" style="font-size: large;">
                                    <th class="col-md-3" ">Avatar</th>
                                    <th class="col-md-2" ">Division</th>
                                    <th class="col-md-3" ">Leader</th>
                                    <th class="col-md-7" style="height: 10px; text-align: center;">Description</th>
                                </thead>
                                <tbody class="form-group">
                                    @foreach($listDivision as $division)
                                        <tr style="height: 80px;">
                                            <td>
                                                <a href="division_info/{{ $division->id }}">
                                                    <img src="{{ asset('../image/'.$division->avatar )}}" class="img-circle" alt="Team Image" style="width: 70px; height: 70px; color: #43a047;">
                                                </a>
                                            </td>
                                            <td> 
                                                <a href="division_info/{{ $division->id }}" style="color: #43a047;">
                                                {{ $division->name }}</td>
                                                </a>
                                            <td>
                                            @if($division->leader_id != null)
                                                <a href="profile/{{ $division->leader->id }}" style="color: #43a047;">
                                                {{ $division->leader->fullname }}</td>
                                                </a>
                                            @endif
                                            <td>
                                                <div>
                                                    <span>{{ $division->description }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="paginate" style="text-align: center;">{!! $listDivision->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection