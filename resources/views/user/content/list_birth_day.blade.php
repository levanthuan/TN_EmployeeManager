@extends('user.layout.index')

@section('content')
	<div class="content">
		<section class="content-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header" data-background-color="green">
							<h3 class="title">In this month</h3>
						<p class="category"></p>
						</div>
						<div class="content">
							<table class="table table-hover table-bordered table-striped table-responsive">
								<thead>
								<tr style="color: #43a047; font-size: large">
									<th><p style="margin-left: 30px "> User ID</p></th>
									<th><p style="margin-left: 70px ">Name</p></th>
									<th><p style="margin-left: 10px ">Birthday</p></th>
								</tr>
								</thead>
								<tbody>
								@foreach($listBirthdays as $birthday)
									<tr>
										<td>
											<p style="margin-left: 46px; color: #43a047;"> {{$birthday->id}} </p>
										</td>
										<td>
											<a style="margin-left: 40px; color: #43a047;" href="{{ route('profile', ['id' => $birthday->id]) }}">
												{{$birthday->fullname}}
											</a>
										</td>
										<td><p style="margin-right: 20px"> {{$birthday->birth_day}}</p></td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						<div class="paginate" style="text-align: center;">{!! $listBirthdays->links() !!}</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
							<div class="card-header" data-background-color="green">
								<h3 class="title">In the following month</h3>
							</div>
							<div class="content">
								<table class="table table-hover table-bordered table-striped table-responsive">
									<thead>
										<tr style="color: #43a047; font-size: large">
											<th><p style="margin-left: 30px;">User ID</p></th>
											<th><p style="margin-left: 70px;">Name</p></th>
											<th><p style="margin-left: 10px;">Birthday</p></th>
										</tr>
									</thead>
									<tbody>
										@foreach($listBirthdays2 as $birthday )
											<tr>
												<td>
													<p style="margin-left: 46px; color: #43a047;"> {{$birthday->id}} </p>
												</td>
												<td>
												    <a style="margin-left: 40px; color: #43a047;" href="{{ route('profile', ['id' => $birthday->id]) }}">
														{{$birthday->fullname}}
													</a>
												</td>
												<td><p style="margin-right: 20px; color: #43a047;"> {{$birthday->birth_day}}</p></td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<div class="paginate" style="text-align: center; color: #43a047;">{!! $listBirthdays2->links() !!}</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
@endsection
