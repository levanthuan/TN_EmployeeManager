<div class="card">
    <div class="card-content table-responsive">
        <table class="table">
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <a href="{{ route('user_profile', ['id'=> $user->id])}}" style="color: #43a047;">
                            {{ $user->fullname }}
                            </a>
                        </td>
                        <td>
                        <form action="{{ action('UserController@addMember', $user->id) }}" method="GET">
                        	<input type="hidden" name="team_id" value="{{ $team_id }}">
                            <button type = 'submit', class = 'btn btn-success btn-xs delete-button pull-right'> 
                            Add</button>
                        </form>
                        </td>
                    </tr>                                    
                @endforeach   
            </tbody>
        </table>
    </div>
</div>