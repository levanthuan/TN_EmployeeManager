@extends('admin.layout.index')

@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="font-size: 30px; color: #0000cc">UPCOMING REVIEW SALARY</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Avatar</th>
                                        <th>Fullname</th>
                                        <th>Position</th>
                                        <th>Day into</th>
                                        <th>Review day</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listUser as $user)
                                            <tr>
                                                <td> {{$user->id}} </td>
                                                <td style="width: 140px; height: 70px">
                                                    <a href="{{ route('profile', ['id' => $user->id]) }}">
                                                        <img src="{{asset('../image/'.$user->avatar)}}" class="img-circle" alt="User Avatar" style="width: 70px; height: 70px;">
                                                    </a>
                                                </td>
                                                <td> <a href="{{ route('profile', ['id' => $user->id]) }}">{{$user->fullname}}</a></td>                                                
                                                <td>
                                                    @if($user->level == 1)
                                                        Super Admin
                                                    @endif
                                                    @if($user->level == 2)
                                                        Admin
                                                    @endif
                                                    @if($user->level == 3)
                                                        Leader division
                                                    @endif
                                                    @if($user->level == 4)
                                                        Team leader
                                                    @endif
                                                    @if($user->level == 5)
                                                        Human resource
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$user->day_into}}
                                                </td>
                                                <td>
                                                    1/1/2011
                                                </td>
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection