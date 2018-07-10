@extends('admin.layout.index')

@section('content')
	<div class="content-wrapper">
		<div class="main-content">

		    <div class="container-fluid">
		    	<form action="new_user" method="POST" enctype="multipart/form-data">
		            {{csrf_field()}}
		           	<div class="col-md-12">
		           		<div class="box box-into" style="margin: 20px 0px;">
	                        <div class="box-header with-border">
	                            <h3 class="box-title" style="font-size: 30px; margin: 5px;">Create new user
	                            </h3>                           
	                        </div>
	                    	<form class="form-horizontal">								
	                    		<div class="box-body">
	                    			<div class="form-group" style="font-size: 15px;">
		                    			@if(session('notification'))
										    <div class="alert alert-success">
										        {{session('notification')}}
										    </div>
										@endif
										<div class="col-sm-12" style="padding-top: 25px;">
										    <div class="form-group">
										        <label class="col-lg-2 col-sm-3 col-md-2 col-xs-12" style="padding-top: 5px;text-align: left;">Full Name</label>
										       	<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12" ">
										        	<input class="form-control" style="width: 100%; height: 34px;" type="text" name="fullname" value="{{ old('fullname') }}" placeholder="">
											        @if($errors->has('fullname'))
											        	<div style="color: red">
											        		{{$errors->first('fullname')}}
											        	</div>
											        @endif
										        </div>										        
										    </div>
										</div>	                    				
			                            <div class="col-sm-12" style="padding-top: 25px;" >
										    <div class="form-group">
										        <label class="col-lg-2 col-sm-3 col-md-2 col-xs-12" style="padding-top: 5px;text-align: left;">Email</label>
										       	<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12">
										        	<input class="form-control" style="width: 100%; height: 34px; type="text" name="email" value="{{ old('email') }}" placeholder="you@yours.com">
										        	@if($errors->has('email'))
											        	<div style="color: red">
											        		{{$errors->first('email')}}
											        	</div>
											        @endif
										        </div>
										    </div>
										</div>
										<div class="col-sm-12" style="padding-top: 25px;">
										    <div class="form-group">
										        <label class="col-lg-2 col-sm-3 col-md-2 col-xs-12" style="padding-top: 5px;text-align: left;">Password</label>
										       	<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12">
										        	<input class="form-control" style="width: 100%; height: 34px;"
										        	 type="password" name="password" value="" placeholder="6-30 characters needed">
										        	@if($errors->has('password'))
											        	<div style="color: red">
											        		{{$errors->first('password')}}
											        	</div>
											        @endif
										        </div>
										    </div>
										</div>
										<div class="col-sm-12" style="padding-top: 25px;">
										    <div class="form-group">
										        <label class="col-lg-2 col-sm-3 col-md-2 col-xs-12" style="padding-top: 5px;text-align: left;">Confirm Password</label>
										       	<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12" >
										        	<input class="form-control" style="width: 100%; height: 34px;"
										        	 type="password" name="repassword" value="" placeholder="Confirm your password">
										        	@if($errors->has('repassword'))
											        	<div style="color: red">
											        		{{$errors->first('repassword')}}
											        	</div>
											        @endif
										        </div>
										    </div>
										</div>                             	
										<div class="col-sm-12" style="padding-top: 25px;">
										    <div class="form-group">
										        <label class="col-lg-2 col-sm-3 col-md-2 col-xs-12" style="padding-top: 5px;text-align: left;">Day Into</label>
										       	<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12">
										        	<input class="form-control" style="width: 100%; height: 34px;" type="date" name="day_into" value="{{ old('day_into') }}" placeholder="">
										        	@if($errors->has('day_into'))
											        	<div style="color: red">
											        		{{$errors->first('day_into')}}
											        	</div>
											        @endif
										        </div>
										    </div>
										</div>
										<div class="col-sm-12" style="padding-top: 25px;">
										    <div class="form-group">
										        <label class="col-lg-2 col-sm-3 col-md-2 col-xs-12" style="padding-top: 5px;text-align: left;">Position</label>
										       	<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12">
										        	<select class="form-control" name="position" style="width: 100%;height: 34px;">
										        		<option value="5" @if(old('position') == 5) selected @endif>User</option>
										        		<option value="4" @if(old('position') == 4) selected @endif>Team leader</option>
										        		<option value="3" @if(old('position') == 3) selected @endif>Division leader</option>
										        	</select>
										        </div>
										    </div>
										</div>
	                    		    </div>
	                    		</div>
	                    		<div class="box-footer" style="margin-top: 20px;">
	                    			<div class="form-group row" style="padding-right: 27px;">
	                    				<div class="col-md-11">
	                    					<button type="submit" class="btn btn-info btn-fill pull-right">Create</button>
	                    				</div>
					                    <div class="clearfix"></div> 
	                    			</div>
	                    		</div>
	                    	</form>
		    			</div>
		           	</div>
		       	</form>
			</div>
		</div>
	</div>	
@endsection

