<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HBLAB | HR Manager</title>
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/icon_hblab.png" />
    <link rel="icon" type="image/png" href="../assets/img/icon_hblab.png" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('/bower_components/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/bower_components/AdminLTE/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('/bower_components/AdminLTE/dist/css/skins/_all-skins.min.css')}}">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/css/admin-style.css')}}">

    <script type="text/javascript" language="javascript" src="{{asset('../ckeditor/ckeditor.js')}}"></script>  
    <script src="{{asset('../assets/js/jquery-3.1.0.min.js')}}" type="text/javascript"></script>  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('admin.layout.main-header')
    @include('admin.layout.main-sidebar')

    @yield('content')

    @include('admin.layout.main-footer')

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
</body>
<script src="{{ asset('/assets/js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('/bower_components/AdminLTE/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/bower_components/AdminLTE/dist/js/app.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('/bower_components/AdminLTE/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{ asset('/bower_components/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset('/bower_components/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('/bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('/bower_components/AdminLTE/plugins/chartjs/Chart.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('/bower_components/AdminLTE/dist/js/pages/dashboard2.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/bower_components/AdminLTE/dist/js/demo.js')}}"></script>



<script src="{{ asset('/assets/js/search-add.js') }}"></script>

</html>
