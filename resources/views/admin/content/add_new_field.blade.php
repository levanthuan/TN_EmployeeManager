@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add New Field to User Infomation</h3>
                            </div>
                            <div class="box-body">
                                @include('errors.note')
                                <form action="add_new_field" method="POST">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select name="type" class="form-control" style="height: 34px; width: 100%;">
                                            <option value="int">INT</option>
                                            <option value="char">CHAR</option>
                                            <option value="string">VARCHAR</option>
                                            <option value="date">DATE</option>
                                            <option value="time">TIME</option>
                                            <option value="enum">ENUM</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Field's Name</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    @foreach($listField as $field)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $field }}</td>
                                            <td>Can't delete</td>
                                        </tr>
                                    @endforeach
                                    @foreach($profiles as $profile)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $profile->description }}</td>
                                            <td style="text-align: center;">
                                                <a href="{{ route('delete_field', ['id' => $profile->id]) }}"
                                                    onclick="return confirm('Are you sure you want to delete?');">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>                        
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
