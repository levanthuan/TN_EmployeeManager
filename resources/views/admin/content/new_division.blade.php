@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    
    <div class="content-wrapper">
        <div class="main-content">

            <div class="container-fluid">    
        <!-- Main content -->
                <div class="content col-md-8">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="font-size: 30px; margin: 5px;">Create new division
                            </h3>                           
                        </div>
                        <div class="content table-responsive table-full-width">
                            <form action="new_division" method="POST" enctype="multipart/form-data">
                                {{ csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12" style="margin: 20px auto;">
                                        <div class="card">
                                            @if(session('notification'))
                                                <div class="alert alert-success">
                                                    {{session('notification')}}
                                                </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input name="name" type="text" class="form-control" placeholder="Enter a name" value="{{ old('name') }}">
                                                        @if($errors->has('name'))
                                                            <div style="color: red">
                                                                {{$errors->first('name')}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea name="description" rows="6" class="form-control" placeholder="Write something about this division." value="{{ old('description') }}"></textarea>
                                                        @if($errors->has('description'))
                                                            <div style="color: red">
                                                                {{$errors->first('description')}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-info btn-fill pull-right">Create</button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div> 
                            </form>    
                        </div>
                    </div>
                </div>
                <div class="content col-md-4" >
                    <div class="box box-info">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Division</th>
                                    <th>Leader division</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listDivision as $division)
                                    <tr>
                                        <td>{{ $division->name }}</td>
                                        @if($division->leader_id != null)
                                            <td>{{ $division->leader->fullname }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <!-- /.content-wrapper -->
@endsection
