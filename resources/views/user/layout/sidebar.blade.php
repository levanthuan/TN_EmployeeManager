<div class="sidebar" data-color="green" data-image="{{ asset('../assets/img/sidebar-1.jpg') }}">
	<!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->

	<div class="logo">
		<a href="<?= route('user_home'); ?>" class="simple-text">
			HBLAB
		</a>
	</div>

	<div class="sidebar-wrapper">
        <ul class="nav">
            <li id="home" class="{{ Request::is('user/home') ? 'active' : ''}}">
                <a href="{{ route('user_home') }}">
                    <i class="material-icons">home</i>
                    <p>Homepage</p>
                </a>
            </li>
            <li id="list-division" class="{{ Request::is('user/list_division') ? 'active' : ''}}">
                <a href="{{ route('user_list_division') }}">
                    <i class="material-icons">group</i>
                    <p>List Division</p>
                </a>
            </li>
            <li id="list-team" class="{{ Request::is('user/list_team') ? 'active' : ''}}">
                <a href="{{ route('user_list_team') }}">
                    <i class="material-icons">group</i>
                    <p>List Team</p>
                </a>
            </li>
            <li id="list-user" class="{{ Request::is('user/list_user') ? 'active' : ''}}">
                <a href="{{ route('user_list_user', ['limit' => '10']) }}">
                    <i class="material-icons">person</i>
                    <p>List User</p>
                </a>
            </li>
            <li id="time-sheet" class="{{ Request::is('user/timesheet') ? 'active' : ''}}">
                <a href="{{ route('user_timesheet') }}">
                    <i class="material-icons">content_paste</i>
                    <p>See Your Timesheet</p>
                </a>
            </li>
            <li id="salary" class="{{ Request::is('user/salary') ? 'active' : ''}}">
                <a href="{{ route('user_salary') }}">
                    <i class="material-icons">attach_money</i>
                    <p>Salary</p>
                </a>
            </li>
            <li id="time-off" class="{{ Request::is('user/time_off_request') ? 'active' : ''}}">
                <a href="{{ route('user_time_off_request') }}">
                    <i class="material-icons">library_books</i>
                    <p>Absence List</p>
                </a>
            </li>
            <li id="list-birthday" class="{{ Request::is('user/list_birthday') ? 'active' : ''}}">
                <a href="{{ route('user_list_birthday', ['item' => '3']) }}">
                    <i class="material-icons">cake</i>
                    <p>Birthdays</p>
                </a>
            </li>
            @if(Auth::user()->level == 4 && Auth::user()->teams_id != null)
                <li id="list-birthday" class="{{ Request::is('user/add_members') ? 'active' : ''}}">
                    <a href="{{ route('user_add_members', ['id' => Auth::user()->team->id]) }}">
                        <i class="material-icons">person_add</i>
                        <p>Edit Members</p>
                    </a>
                </li>
            @endif
        </ul>
	</div>
</div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#home").change(function(){
                if ($(this).click() {
                    $("#home").attr('active');
                }
            });
            $("#list-team").change(function(){
                if ($(this).click() {
                    $("#list-team").attr('active');
                }
            });
        });
    </script>