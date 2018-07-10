@extends('user.layout.index')

<style type="text/css">
	.time-off-label{
		float: left;
		margin-left: 20px;
		font-size: 20px;
		font-family: Arial;
		font-weight: bold;
	}
	.time-off-value{
		float: right;
		margin-left: 20px;
		font-style: italic;
		font-size: 15px;
	}
</style>

@section('content')
	<div class="content">
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card">
	                    <div class="card-header" data-background-color="green">
	                        <h4 class="title">{{ $timeOffRequest->content }}</h4>
	                    </div>
	                    <div class="card-content table-responsive">
	                    	@include('errors.note')
	                        <div style="float: left;">
	                        	<label class="time-off-label">Họ và tên: </label>
	                        	<div class="time-off-value">{{ $timeOffRequest->user->fullname }}</div>
	                        	<div class="clear-both"></div>
	                        	<label class="time-off-label">Division: </label>
	                        	<div class="time-off-value">{{ $timeOffRequest->user->team->division->name }}</div>
	                        	<div class="clear-both"></div>
	                        	<label class="time-off-label">Team: </label>
	                        	<div class="time-off-value">{{ $timeOffRequest->user->team->name }}</div>
	                        	<div class="clear-both"></div>
	                        	<label class="time-off-label">Time Off Start : </label>
	                        	<div class="time-off-value">{{ $timeOffRequest->time_start }}</div>
	                        	<div class="clear-both"></div>
	                        	<label class="time-off-label">Time Off End : </label>
	                        	<div class="time-off-value">{{ $timeOffRequest->time_end }}</div>
	                        	<div class="clear-both"></div>
	                        	<label class="time-off-label">Reason : </label>
	                        	<div class="time-off-value">{{ $timeOffRequest->reason }}</div>
	                        	<div class="clear-both"></div>
	                        	<a href="{{ route('approve_time_off_request', ['id' => $timeOffRequest->id]) }}">
	                        		<button type="submit" class="btn btn-success">Approve</button>
	                        	</a>
	                        </div>
	                        <div style="float: right;">
	                        	{{ $timeOffRequest->time_send }}
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection