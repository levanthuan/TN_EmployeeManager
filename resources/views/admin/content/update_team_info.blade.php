@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-xs-12 col-sm-12">
                            <div class="card card-user card-team-info box box-info" style="margin: 0px; margin-bottom: 20px; min-height: 250px;">
                                <div class="image" style="margin-top: 10px;">
                                    <img src="{{asset('../image/'.$team->avatar)}}" alt="..."/>
                                </div>
                                <h4 style="text-align: center;">TEAM : {{ $team->name }}</h4>
                                @if($team->leader_id != null)
                                    <div class="panel-body" style="background-color: white">
                                        <p style="text-align: center;">
                                            Leader :{{ $team->leader->fullname }}
                                        </p>
                                    </div>
                                @endif
                                @if($team->description != null)
                                    <div class="panel-body" style="background-color: white">
                                        <p style="text-align: center;">
                                            {{ $team->description }}
                                        </p>
                                    </div>
                                @endif                                
                                @if($team->divisions_id != null)
                                    <div class="box-footer" style="text-align: center;">
                                        DIVISION: {{ $team->division->name }}
                                    </div>
                                @endif
                            </div>                            
                        </div>
                        <div class="col-lg-8 col-md-7 col-xs-12 col-sm-12">
                            <div class="box box-info">
                                <div class="content">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">TEAM INFOMATION</h3>
                                    </div>
                                    <div class="row" style="margin-top: 20px;">
                                        <form action="{{ route('update_team_info', ['id' => $team->id]) }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field()}}
                                            <div class="col-md-12">
                                                @include('errors.note')
                                            </div>                                            
                                            <div class="col-md-12" style="margin-top: 10px;">
                                                <label>Name Team : </label>
                                            </div>
                                            <div class="col-md-12">                                            
                                                <input class="form-control" type="text" name="name_team" value="{{ $team->name }}" style="width: 100%;">
                                            </div>
                                            <div class="col-md-12" style="margin-top: 15px;">
                                                <label>Leader : </label>
                                            </div>
                                            <div class="col-md-12">
                                                <select class="form-control" name="leader" style="width: 100%;">
                                                    <option></option>
                                                    @foreach($listUser as $user)
                                                        <option value="{{$user->id}}"
                                                        @if($team->leader_id != null && $user->id == $team->leader->id)
                                                            selected="selected"                               
                                                        @endif
                                                        >{{$user->fullname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>                                      
                                            <div class="col-md-12" style="margin-top: 15px;">
                                                <label>Division : </label>
                                            </div>
                                            <div class="col-md-12">
                                                <select class="form-control" name="division" style="width: 100%;">
                                                    <option></option>
                                                    @foreach($listDivision as $division)
                                                        <option value="{{$division->id}}"
                                                        @if($team->divisions_id != null && $division->id == $team->division->id)
                                                            selected="selected"                               
                                                        @endif
                                                        >{{$division->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12" style="margin-top: 15px;">
                                                <label>Description : </label>
                                            </div>
                                            <div class="col-md-12">
                                                @if($team->description != null)
                                                    <textarea name="description" rows="5" class="form-control">{{ $team->description }}</textarea>
                                                @else
                                                    <textarea name="description" rows="5" class="form-control"></textarea>
                                                @endif
                                            </div>
                                            <div class="col-md-12" style="margin-top: 15px;">
                                                <label>Avatar : </label>
                                            </div>                                        
                                            <div class="col-md-12">
                                                <input class="form-control" type="file" name="image">
                                            </div>
                                            <div class="col-md-12" style="margin-top: 10px; text-align: right;">
                                                <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>                                    
                                            </div>                                        
                                        </form>
                                    </div>                                    
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