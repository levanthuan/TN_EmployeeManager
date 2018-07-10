<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/icon_hblab.png" />
	<link rel="icon" type="image/png" href="../assets/img/icon_hblab.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>HBLAB JSC.</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->

    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!--  Material Dashboard CSS    -->
    <link href="{{ asset('/assets/css/material-dashboard.css') }}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('/assets/css/demo.css" rel="stylesheet') }}" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/user-style.css') }}">
</head>

<body>

	<div class="wrapper">

	    @include('user.layout.sidebar')

	    <div class="main-panel">
			@include('user.layout.navbar')

			@yield('content')

			@include('user.layout.footer')
		</div>
	</div>
	@yield('content_notification')
</body>

	<!--   Core JS Files   -->
	<script src="{{ asset('/assets/js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/assets/js/material.min.js') }}" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="{{ asset('/assets/js/chartist.min.js') }}"></script>

	<!--  Notifications Plugin    -->
	<script src="{{ asset('/assets/js/bootstrap-notify.js') }}"></script>

	<!--  Google Maps Plugin    -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

	<!-- Material Dashboard javascript methods -->
	<script src="{{ asset('/assets/js/material-dashboard.js') }}"></script>

	<!-- Material Dashboard DEMO methods, don't include it in your project! -->
	<script src="{{ asset('/assets/js/demo.js') }}"></script>

	<script src="{{ asset('/assets/js/search-add.js') }}"></script>

	<script type="text/javascript">
    	$(document).ready(function(){

			// Javascript method's body can be found in assets/js/demos.js
        	demo.initDashboardPageCharts();

    	});
	</script>

</html>
