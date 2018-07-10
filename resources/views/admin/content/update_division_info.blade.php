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
                            <div class="card card-user card-team-info box box-info" style="margin: 0px; margin-bottom: 20px;">
                                <div class="image" style="margin-top: 10px;">
                                    <img src="{{asset('../image/'.$division->avatar)}}" alt="..."/>
                                </div>
                                <h2 style="text-align: center;">{{ $division->name }}</h2>
                                <div class="content box-footer">
                                    <p style="text-align: center;">
                                        Leader division : 
                                        @if($division->leader_id != null)
                                            {{$division->leader->fullname}}
                                        @endif
                                    </p>
                                </div>
                                <div class="content box-footer">
                                    <p style="text-align: center;">
                                        {{$division->description}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-7 col-xs-12 col-sm-12">
                            <div class="box box-info">
                            <div class="content">
                                <div class="box-header with-border div-box-header" style="text-align: center">
                                    <h2 class="box-title">DIVISION INFOMATION</h2>
                                </div>
                                <div class="row" style="margin-top: 20px;">
                                    <form action="{{ route('update_division_info', ['id' => $division->id]) }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field()}}
                                        <div class="col-md-12">
                                            @include('errors.note')
                                        </div>                                            
                                        <div class="col-md-12" style="margin-top: 10px;">
                                            <label>Name Division : </label>
                                        </div>
                                        <div class="col-md-12">                                            
                                            <input type="text" class="form-control" name="name_division" value="{{ $division->name }}" style="width: 100%;">
                                        </div>
                                        <div class="col-md-12" style="margin-top: 20px;">
                                            <label>Leader : </label>
                                        </div>
                                        <div class="col-md-12">
                                            <select name="leader" class="form-control" style="width: 100%;">
                                                <option></option>
                                                @foreach($listUser as $user)
                                                    <option value="{{$user->id}}"
                                                    @if($division->leader_id != null && $user->id == $division->leader->id)
                                                        selected="selected"
                                                    @endif
                                                    >{{$user->fullname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 20px;">
                                            <label>Description : </label>
                                        </div>
                                        <div class="col-md-12">
                                            @if($division->description != null)
                                                <textarea name="description" rows="5" class="form-control">{{ $division->description }}</textarea>
                                            @else
                                                <textarea name="description" rows="5" class="form-control"></textarea>
                                            @endif
                                        </div>
                                        <div class="col-md-12" style="margin-top: 20px;">
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