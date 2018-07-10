@extends('admin.layout.index')

@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">TIME OFF REQUEST</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>                
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive table-bordered">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Time start</th>
                                        <th>Time end</th>
                                        <th>Time send</th>
                                        <th>Status</th>
                                        <th>Open</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($timeOffs as $timeOff)
                                        <a href="">
                                            <tr>
                                                <td>
                                                    {{$timeOff->user->id}}
                                                </td>
                                                <td><a href="{{ route('profile', ['id' => $timeOff->user->id]) }}">
                                                    {{$timeOff->user->fullname}}</a>
                                                </td>
                                                <td>{{$timeOff->time_start}}</td>
                                                <td>{{$timeOff->time_end}}</td>
                                                <td>{{$timeOff->time_send}}</td>
                                                <td>
                                                    @if($timeOff->status == 'done')
                                                        <span class="label label-success">Approved</span>
                                                    @elseif($timeOff->status == 'none')
                                                        <span class="label label-danger">Rejected</span>
                                                    @else
                                                        <span class="label label-warning">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin_show_time_off_request', 
                                                        ['id'=>$timeOff->id]) }}">Open
                                                    </a>
                                                </td>
                                            </tr>
                                        </a>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <div class="paginate" style="text-align: center;">{!! $timeOffs->links() !!}</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection