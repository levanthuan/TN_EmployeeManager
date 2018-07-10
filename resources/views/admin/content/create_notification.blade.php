@extends('admin.layout.index')

@section('content')
    
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">CREATE A NEW NOTIFICATION</h3>
                        </div>                        
                        <div class="content table-responsive table-full-width">
                            @include('errors.note')
                            <form action="create_notification" method="POST" role="form">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" placeholder="Input title" name="title">
                                    <label for="">Content</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="10" placeholder="Input Content" name="content"></textarea>
                                </div>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="on" name="ck_send_system" checked="checked">Send in system
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="on" name="ck_send_email">Send from mails
                                </label>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>          
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
