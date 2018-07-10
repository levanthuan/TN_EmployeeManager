@inject('notifications', 'App\Services\NotificationService')

<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>H</b>B</span>
        <!-- logo for regular state and mobile devices -->
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">                
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        @if($notifications->countNotifications() > 0)
                            <span class="label label-danger">{{ $notifications->countNotifications() }}</span>
                        @endif                        
                    </a>
                    <ul class="dropdown-menu">
                        @if($notifications->countNotifications() > 0)
                            <li class="header">You have {{ $notifications->countNotifications() }} notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    @foreach($notifications->getListTimeOffRequest() as $timeOffRequest)
                                        <li>
                                            <a href="{{ route('admin_show_time_off_request', 
                                                        ['id'=>$timeOffRequest->id]) }}">
                                                <i class="fa fa-file-text-o text-green"></i> There are 1 time-off request
                                            </a>
                                        </li>
                                    @endforeach                    
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu" style="margin-right: 35px;">
                    <a href="profile" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('../image/'.Auth::user()->avatar)}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Auth::user()->fullname}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('../image/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image">
                            <p>
                                {{Auth::user()->fullname}}
                                <small>Admin HBLAB Company</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('profile', ['id' => Auth::user()->id]) }}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</header>