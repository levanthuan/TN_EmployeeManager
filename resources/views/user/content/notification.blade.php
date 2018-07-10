@extends('user.layout.index')
@section('content')
	<div class="content">
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card">
	                    <div class="card-header" data-background-color="green">
	                        <h4 class="title">{{ $notification->title }}</h4>
	                    </div>
	                    <div class="card-content table-responsive">
	                        <div style="float: left;">
	                        	<p>{!! $notification->content !!}</p>
	                        </div>
	                        <div style="float: right;">
	                        	{!! $notification->time_send !!}
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection