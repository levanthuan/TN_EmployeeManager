@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-5" style="margin-left: 70px">
                    <div class="card">
                        <div class="box box-info">
                            <div class="card-header" data-background-color="purple">
                                <h3 class="box-title">Birthday in month</h3>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th><p style="margin-left: 15px "> User ID</p></th>
                                        <th><p style="margin-left: 50px ">Name</p></th>
                                        <th><p style="margin-left: 3px ">Birthday</p></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($listBirthdays as $birthday )
                                        <tr>
                                            <td>
                                                <p style="margin-left: 30px"> {{$birthday->id}} </p>
                                            </td>
                                            <td><a style="margin-left: 20px" href="{{ route('profile', ['id' => $birthday->id]) }}">
                                                    {{$birthday->fullname}}</a>
                                            </td>
                                            <td><p style="margin-right: 10px"> {{$birthday->birth_day}}</p></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="paginate" style="text-align: center;">{!! $listBirthdays->links() !!}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5" style="margin-left: 40px">
                    <div class="card">
                        <div class="box box-info">
                            <div class="card-header" data-background-color="purple">
                                <h3 class="box-title">Birthday the following month</h3>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th><p style="margin-left: 10px "> User ID</p></th>
                                        <th><p style="margin-left: 50px ">Name</p></th>
                                        <th><p style="margin-left: 3px ">Birthday</p></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($listBirthdays2 as $birthday )
                                        <tr>
                                            <td>
                                                <p style="margin-left: 30px"> {{$birthday->id}} </p>
                                            </td>
                                            <td><a style="margin-left:40px" href="{{ route('profile', ['id' => $birthday->id]) }}">
                                                    {{$birthday->fullname}}</a>
                                            </td>
                                            <td><p style="margin-right: 10px"> {{$birthday->birth_day}}</p></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="paginate" style="text-align: center;">{!! $listBirthdays2->links() !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
