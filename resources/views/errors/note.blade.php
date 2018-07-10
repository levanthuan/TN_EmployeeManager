
@if(count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
            {{$err}}<br>
        @endforeach                    
    </div>
@endif
@if(session('notification'))
    <div class="alert alert-success">
        {{session('notification')}}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
@if(session('warning'))
    <div class="alert alert-warning">
        {{session('warning')}}
    </div>
@endif