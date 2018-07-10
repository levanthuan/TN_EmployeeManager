<div class="col-md-12 col-xs-12">
	<div class="box box-primary">
		<div class="box-body">
			<table class="table table-hover table-bordered table-striped table-responsive">
				<thead>
				<tr style="color: #43a047; font-size: large">
					<th style="text-align: center">NO</th>
					<th style="text-align: center">Title</th>
					<th style="text-align: center">Time Sent</th>
					<th style="text-align: center">Status</th>
					<th style="text-align: center">See more</th>
				</tr>
				<tbody>
					<?php
						$count = 0;
					?>
					@foreach($listNotification as $notification)
						<?php
							$count++;
						?>
						<tr style="color: #43a047; font-size: 15px;">
							<td> <p style="text-align: center">{{$count}} </td></p>
							<td style="text-align: center"> {{ $notification->notification->title }} </td>
							<td style="text-align: center"> {{ $notification->notification->time_send }} </td>
							<td style="text-align: center">
								@if($notification->status == 'seen')
									<span ><i class="fa fa-check"></i> seen</span>
								@else
									<span style="color: red"><i class="fa fa-times"></i> unseen</span>
								@endif
							</td>
							<td style="text-align: center"><a href="{{ route('user_notification', ['id' => $notification->notifications_id]) }}" ><i class="material-icons" style="color: #43a047; text-align: center;">remove_red_eye</i> read</a></td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>
		<!-- /.box-body -->
		<hr style="margin: 0px auto 20px auto; background: #DDDDDD">
			<div class="box-footer text-center" style="margin-bottom: 10px;">
				<a style="text-align: center; color: #43a047;" href="notifications" class="uppercase">View All Notifications</a>
			</div>
		</hr>
		<!-- /.box-footer -->
	</div>
</div>