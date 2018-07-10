@inject('notifications', 'App\Services\NotificationService')

<nav class="navbar navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Welcome to HBLAB!</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="material-icons">notifications</i>
						@if($notifications->countNotifications() > 0)
							<span class="notification">{{ $notifications->countNotifications() }}</span>
						@endif
						<p class="hidden-lg hidden-md">Notifications</p>
					</a>
					<ul class="dropdown-menu">
						@if($notifications->countNotifications() > 0)
							@foreach($notifications->getListUnseenNotification() as $unseenNotification)
								<li>
									<a href="{{ route('user_notification', ['id' => $unseenNotification->notification->id]) }}">
										Admin has just posted a notification:
											{{ $unseenNotification->notification->title }}
									</a>
								</li>
							@endforeach
							@if(Auth::user()->level == 3)
								@foreach($notifications->getListTimeOffRequest() as $timeOffRequest)
									@if($timeOffRequest->user->teams_divisions_id == Auth::user()->teams_divisions_id)
										<li>
											<a href="{{ route('show_time_off_request', ['id' => $timeOffRequest->id ]) }}">
												There are 1 time-off request need approve
											</a>
										</li>
									@endif
								@endforeach
							@endif
							@if(Auth::user()->level == 4)
								@foreach($notifications->getListTimeOffRequest() as $timeOffRequest)
									@if($timeOffRequest->user->team->id == Auth::user()->team->id)
										<li>
											<a href="{{ route('show_time_off_request', ['id' => $timeOffRequest->id ]) }}">
												There are 1 time-off request need approve
											</a>
										</li>
									@endif
								@endforeach
							@endif
						@else
							<li><a>There are no announcements</a></li>
						@endif
					</ul>
				</li>
				<li>
					<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
						   <i class="material-icons">person</i>
						   <p class="hidden-lg hidden-md">Profile</p>
						</a>
						<ul class="dropdown-menu" style="width: 250px; padding: 10px">
                         <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('../image/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image" style="margin-left: 70px; height: 90px">
                            <p style="text-align: center;">
                                {{ Auth::user()->fullname }}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                              <div class="pull-left">
                                  <a href="{{ route('user_profile', ['id' => Auth::user()->id]) }}" class="btn btn-default">Profile</a>
                              </div>
                              <div class="pull-right">
                                  <a href="<?= route('logout'); ?>" class="btn btn-default">Sign out</a>
                              </div>
                        </li>
					</ul>
				</li>
			</ul>

			<form action="{{ route('user_search') }}" method="post" class="navbar-form navbar-right" role="search">
				{{ csrf_field() }}
				<div class="form-group  is-empty">
					<input type="text" class="form-control" placeholder="Search" name="key">
					<span class="material-input"></span>
				</div>
				<button type="submit" class="btn btn-white btn-round btn-just-icon">
					<i class="material-icons">search</i><div class="ripple-container"></div>
				</button>
			</form>
		</div>
	</div>
</nav>