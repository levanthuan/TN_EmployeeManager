@extends('user.layout.index')

@section('content')

	<!-- <div class="content-wrapper"> -->
		<!-- Main content -->
		<section class="content">
			<div class="card">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="card-header" data-background-color="green">List Notifications</h3>
						</div>
						@foreach($notificationsUser as $userNotification)
							<div class="content" style="min-height: 150px;">
								<div class="row">
									<div class="col-md-1">
										<a class="admin-img content" href="#">
											<img src="{{asset('../image/'.$admin->avatar)}}" class="img-circle" alt="User Image" style="width: 50px; height: 50px;">
										</a>
									</div>
									<div class="col-md-11">
										<div class="header" style="margin-top: 10px; color: #6F0FFF">
											<span><h4>Admin đã đăng tải 1 thông báo! </h4>
											{{$userNotification->notification->time_send}}
											</span>
										</div>
										<div class="content">
											<h5> {{ $userNotification->notification->title }} </h5>
											<p> {!! $userNotification->notification->content !!} </p>
										</div>
									</div>
								</div>
							</div>
							<hr>
						@endforeach
						<div class="paginate" style="text-align: center">{!! $notificationsUser->links() !!}</div>
					</div>
				</div>
			</div>
			</div>
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
@endsection
