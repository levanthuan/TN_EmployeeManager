@extends('user.layout.index')

@section('content')
    <div class="content">
        {{ csrf_field() }}
        <div class="container-fluid">
            <div class="row">
                <div style="width: 300px; margin-left: 15px">
                    @if (Session::has('notification'))
                        @include('errors.note')
                    @endif
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" data-background-color="green">
                            <h3 class="title">List Users</h3>
                        </div>
                        <div class="card-content table-responsive">
                            <div class="box-header">
                                <div class="dropdown" style="float: left; font-size: 20px;">
                                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" style="width: 80px;">
                                        <span>{{$limit}}</span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" style="min-width: 80px; ">
                                        <li><a href="{{ route('user_list_user', ['limit' => '5']) }}">5</a></li>
                                        <li><a href="{{ route('user_list_user', ['limit' => '10']) }}">10</a></li>
                                        <li><a href="{{ route('user_list_user', ['limit' => '25']) }}">25</a></li>
                                        <li><a href="{{ route('user_list_user', ['limit' => '50']) }}">50</a></li>
                                        <li><a href="{{ route('user_list_user', ['limit' => 'all']) }}">All</a></li>
                                    </ul>
                                    record
                                </div>
                                <input class="pull-right" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" style="width: 150px; height: 30px; margin: 20px 0px;">                               
                            </div>

                            <table id="myTable" class="table table-bordered">
                                <thead class="text-primary" style="color: #43a047; font-size: large">
                                    <th>ID</th>
                                    <th>Avatar</th>                                    
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Team</th>
                                    <th>Division</th>
                                    <th>Phone number</th>
                                </thead>
                                <tbody>
                                    @foreach($listUser as $user)
                                        <tr>
                                            <td style="color: #43a047;"> {{$user->id}} </td>
                                            <td style="width: 140px; height: 70px;">
                                                <a href="{{ route('user_profile', ['id' => $user->id]) }}">
                                                    @if($user->avatar != null)
                                                        <img src="{{ asset('../image/'.$user->avatar) }}" class="img-circle" alt="User Avatar" style="width: 70px; height: 70px; color: #43a047;">
                                                    @else
                                                        <img src="{{ asset('../image/icon_user.png') }}" class="img-circle" alt="User Avatar" style="width: 70px; height: 70px; color: #43a047;">
                                                    @endif
                                                </a>
                                            </td>
                                            <td> 
                                                <a href="{{ route('user_profile', ['id' => $user->id]) }}" style="color: #43a047;"> {{$user->fullname}} 
                                                </a>
                                            </td>
                                            <td> 
                                                <a href="{{ route('user_profile', ['id' => $user->id]) }}" style="color: #43a047;"> {{$user->email}} 
                                                </a>
                                            </td>                                            
                                            <td>
                                                @if ($user->teams_id)
                                                    <a href="{{ route('user_team_info', ['id' => $user->team->id]) }}"  style="color: #43a047;">
                                                        {{ $user->team->name }}</td>
                                                    </a>
                                                @else
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->teams_divisions_id)
                                                    <a href="{{ route('user_division_info', ['id' => $user->division->id]) }}" style="color: #43a047;">
                                                        {{ $user->division->name }}</td>
                                                    </a>
                                                @else
                                                @endif
                                            </td>
                                            <td style="color: #43a047;"> {{ $user->phone_number }} </td>
                                        </tr>
                                    @endforeach()
                                </tbody>
                            </table>
                            @if($limit != 'all')
                            <div style="float: left; margin: 25px;">
                                Showing {{($listUser->currentpage()-1)*$listUser->perpage()+1}}
                                to {{(($listUser->currentpage()-1)*$listUser->perpage())+$listUser->count()}}
                                of  {{$listUser->total()}} 
                                entries
                            </div>
                            <div style="width: 100%; text-align: right; mar">{!! $listUser->links() !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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