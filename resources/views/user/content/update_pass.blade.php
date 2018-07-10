@extends('user.layout.index')

@section('content')
	<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header" data-background-color="green">
                            <h4 class="title">Change password</h4>
                        </div>
                        <div class="card-content">
							<form action="{{ route('change_pass', Auth::user()->id) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
							 {{ csrf_field() }}
							 @include('errors.note')
							<fieldset>

							<!-- Password input-->
							<div class="form-group">
							  <label class="col-md-4 control-label"><h5>Current password</h5></label>
							  <div class="col-md-6">
							    <input name="current_password" type="password" placeholder="6-30 characters needed" class="form-control input-md">
							    
							  </div>
							</div>

							<!-- Password input-->
							<div class="form-group">
							  <label class="col-md-4 control-label"><h5>Enter new password</h5></label>
							  <div class="col-md-6">
							    <input name="NewPass" type="password" placeholder="6-30 characters needed" class="form-control input-md">
							    
							  </div>
							</div>

							<!-- Password input-->
							<div class="form-group">
							  <label class="col-md-4 control-label"><h5>Confirm password</h5></label>
							  <div class="col-md-6">
							    <input name="NewPassRepeat" type="password" placeholder="Confirm new password" class="form-control input-md">
							    
							  </div>
							</div>

							<!-- Button (Double) -->
							  <div class="col-md-12">
							    <button name="change" class="btn btn-success pull-right">Change</button>
							  </div>

							</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection