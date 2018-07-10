@extends('admin.layout.index')

@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <legend>List Notification</legend>
                        </div>
                            <div class="content" style="min-height: 150px;">
                                <div class="row">
                                    <div class="col-md-1">
                                        <a class="admin-img" href="#">
                                            <img src="{{asset('../image/'.$admin->avatar)}}" class="img-circle" alt="User Image" style="width: 50px; height: 50px;">
                                        </a>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="header" style="margin-top: 10px; color: #00C0EF">
                                            <span>Admin đã đăng tải 1 thông báo !</span>
                                            <div> {{$notification->time_send}} </div>
                                        </div>
                                        <div class="content">
                                            <h4> {{ $notification->title }} </h4>
                                            <p> {!! $notification->content !!} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <a class="pull-left" href="<?= route('admin_create_notification'); ?>" class="uppercase">Create New Notifications</a>
                                <a class="pull-right" href="<?= route('admin_notifications'); ?>" class="uppercase">View All Notifications</a>
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
