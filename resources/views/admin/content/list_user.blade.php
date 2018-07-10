@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="font-size: 30px; color: #0000cc; margin: 5px;">LIST USER</h3>
                            <a href="{{route('new_user')}}" class="btn btn-success pull-right" style="margin-right: 10px; font-size: 20px; color: white;" data-toggle="tooltip" data-placement="left" title="create new user">                                
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                 Add new
                            </a> 
                        </div>
                        <div class="content table-responsive table-full-width">
                            <div class="dropdown" style="float: left; font-size: 20px;">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="width: 55px;">
                                    <span>{{$limit}}</span>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" style="min-width: 55px;">
                                    <li><a href="{{ route('admin_list_user', ['limit' => '5']) }}">5</a></li>
                                    <li><a href="{{ route('admin_list_user', ['limit' => '10']) }}">10</a></li>
                                    <li><a href="{{ route('admin_list_user', ['limit' => '25']) }}">25</a></li>
                                    <li><a href="{{ route('admin_list_user', ['limit' => '50']) }}">50</a></li>
                                    <li><a href="{{ route('admin_list_user', ['limit' => 'all']) }}">All</a></li>
                                </ul>
                                record
                            </div>
                            <input class="form-group pull-right" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" style="width: 200px; height: 30px;">
                            
                            <table id="myTable" class="table table-hover table-striped table-bordered">
                                @include('errors.note')
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Avatar</th>
                                        <th>Email</th>
                                        <th>Fullname</th>
                                        <th>Phone Number</th>
                                        <th>Team</th>
                                        <th>Division</th>
                                        <th>Delete</th>
                                    </tr>
                                <tbody>
                                    @foreach($listUser as $user)
                                        <tr>
                                            <td> {{$user->id}} </td>
                                            <td style="width: 140px; height: 70px">
                                                <a href="{{ route('profile', ['id' => $user->id]) }}">
                                                    <img src="{{asset('../image/'.$user->avatar)}}" class="img-circle" alt="User Avatar" style="width: 70px; height: 70px;">
                                                </a>
                                            </td>
                                            <td><a href="{{ route('profile', ['id' => $user->id]) }}"> {{$user->email}} </td>
                                            <td> <a href="{{ route('profile', ['id' => $user->id]) }}">{{$user->fullname}}</a></td>
                                            <td> {{$user->phone_number}} </td>
                                            <td>
                                                @if($user->teams_id != '')
                                                    {{ $user->team->name }}                                     
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->teams_divisions_id != '')
                                                    {{ $user->division->name }}                                     
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                @if($user->level > 2)
                                                    <a href="{{ route('delete_user', ['id' => $user->id]) }} "
                                                        data-toggle="tooltip" data-placement="left" title="delete user"
                                                        onclick="return confirm('Are you sure you want to delete?');">
                                                        <i class="fa fa-trash-o fa-1x fa-lg" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>                            
                            </table>
                            @if($limit != 'all')
                            <div style="float: left; margin: 25px;">
                                Showing {{($listUser->currentpage()-1)*$listUser->perpage()+1}}
                                to {{(($listUser->currentpage()-1)*$listUser->perpage())+$listUser->count()}}
                                of  {{$listUser->total()}} 
                                entries
                            </div>
                            <div class="paginate" style="text-align: right; margin-right: 20px;">{!! $listUser->links() !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    <!-- /.content-wrapper -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>