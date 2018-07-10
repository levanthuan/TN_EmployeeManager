<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('../image/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->fullname}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <!-- search form -->
        <form action="{{ route('search') }}" method="post" class="sidebar-form">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" name="key" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header"><h4 style="color: white"><i class="fa fa-dashboard"></i> <span>Dashboard</span></h4></li>
            <li>
                <a href="<?= route('admin_home'); ?>">
                    <i class="fa fa-home"></i> <span>Homepage</span>
                </a>
            </li>            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Human Resources</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= route('admin_list_division'); ?>"><i class="fa fa-users"></i>List Divisions</a></li>
                    <li><a href="<?= route('admin_list_team'); ?>"><i class="fa fa-users"></i>List Teams</a></li>
                    <li><a href="{{ route('admin_list_user', ['limit' => '10']) }}"><i class="fa fa-user"></i>List Users</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-plus-square"></i>
                    <span>Update Human Resources</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= route('new_division'); ?>"><i class="fa fa-sitemap"></i>Create New Division</a></li>
                    <li><a href="<?= route('new_team'); ?>"><i class="fa fa-sitemap"></i>Create New Team</a></li>
                    <li><a href="<?= route('new_user'); ?>"><i class="fa fa-user-plus"></i>Create New User</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-file-excel-o"></i> <span>Timesheet</span>
                </a>
            </li>

            @if(Auth::user()->level == 1)
                <li>
                    <a href="">
                        <i class="fa fa-money"></i> <span>Salary</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin_show_table_salary') }}"><i class="fa fa-table"></i> Show Salary Table</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Update Salary</a></li>
                    </ul>
                </li>
            @endif

            <li>
                <a href="<?= route('admin_list_review_salary'); ?>">
                    <i class="fa fa-pencil-square-o"></i> <span>List Review Salary</span>
                </a>
            </li>

            <li>
                <a href="<?= route('admin_create_notification'); ?>">
                    <i class="fa fa-bullhorn"></i> <span>Create new notification</span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?= route('admin_list_time_off_request'); ?>">
                    <i class="fa fa-file-text-o"></i>
                    <span>List Time-off Request </span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?= route('add_new_field'); ?>">
                    <i class="fa fa-database" aria-hidden="true"></i>
                    <span>Add New Field to User Info</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>