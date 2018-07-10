@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-xs-12" style="padding: 0px;">
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
                                <div class="table-responsive">
                                    <table class="table no-margin table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Time start</th>
                                                <th>Time end</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($listTimeOff as $timeOff)
                                                <tr>
                                                    <td>
                                                        {{$timeOff->id}}
                                                    </td>
                                                    <td><a href="{{ route('profile', ['id' => $timeOff->user->id]) }}">
                                                        {{$timeOff->user->fullname}}</a>
                                                    </td>
                                                    <td>{{$timeOff->time_start}}</td>
                                                    <td>{{$timeOff->time_end}}</td>
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
                                                                ['id' => $timeOff->id]) }}">Open
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a href="{{ route('admin_list_time_off_request') }}" class="btn btn-sm btn-primary btn-flat pull-right">View All</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">UPCOMING BIRTHDAY</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-bordered">
                                        <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Birthday</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($listUserBirthday != null)
                                            @foreach($listUserBirthday as $birthday)
                                                <tr>
                                                    <td style="margin-left: 20px">
                                                        {{$birthday->id}}
                                                    </td>
                                                    <td><a href="{{ route('profile', ['id' => $birthday->id]) }}">
                                                            {{$birthday->fullname}}</a>
                                                    </td>
                                                    <td>{{$birthday->birth_day}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if($listUserBirthday2 != null)
                                            @foreach($listUserBirthday2 as $birthday)
                                                <tr>
                                                    <td style="margin-left: 20px">
                                                        {{$birthday->id}}
                                                    </td>
                                                    <td><a href="{{ route('profile', ['id' => $birthday->id]) }}">
                                                            {{$birthday->fullname}}</a>
                                                    </td>
                                                    <td>{{$birthday->birth_day}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if($listUserBirthday3 != null)
                                            @foreach($listUserBirthday3 as $birthday)
                                                <tr>
                                                    <td style="margin-left: 20px">
                                                        {{$birthday->id}}
                                                    </td>
                                                    <td><a href="{{ route('profile', ['id' => $birthday->id]) }}">
                                                            {{$birthday->fullname}}</a>
                                                    </td>
                                                    <td>{{$birthday->birth_day}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a href="{{ route('admin_list_birthday') }}" class="btn btn-sm btn-primary btn-flat pull-right">View All</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">NOTIFICATIONS</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                @foreach($listNotification as $notification)
                                    <li class="item">
                                        <div >
                                            <span> {{$notification->title}} </span>
                                            <a class="pull-right" href="notification/{{$notification->id}}" >More</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a class="btn btn-sm btn-primary btn-flat pull-left" href="<?= route('admin_create_notification'); ?>" class="uppercase">Create New Notification</a>
                            <a class="btn btn-sm btn-primary btn-flat pull-right" href="<?= route('admin_notifications'); ?>">View All Notifications</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
