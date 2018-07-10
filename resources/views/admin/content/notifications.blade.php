@extends('admin.layout.index')

@section('content')
    
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">LIST NOTIFICATIONS</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div style="border: 1px #CCCCCC solid; margin: 1px;">
                            @foreach($notifications as $notification)
                                <div class="content" style="min-height: 150px; ">
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
                                            <div class="content__">
                                                <h4> {{ $notification->title }} </h4>
                                                <p> {!! $notification->content !!} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach                            
                        </div>
                        <div class="paginate" style="text-align: center;">{!! $notifications->links() !!}</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
