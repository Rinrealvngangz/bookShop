@extends('layouts.main')

@section('content')
    @if(session('genres-delete'))
        <div class="alert alert-primary" role="alert">
            {{ session('genres-delete') }}
        </div>
    @endif
    @if(session('update-genres'))
        <div class="alert alert-primary" role="alert">
            {{ session('update-genres') }}
        </div>
    @endif
    @if(session('genres-create'))
        <div class="alert alert-primary" role="alert">
            {{ session('genres-create') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Genres</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['action'=>'','method'=>'GET' , 'route' => ['genres.create']]) !!}
                        {{ Form::button('Create', ['class' => 'btn btn-primary m-2','name'=>'action' ,'type' => 'submit','value' => 'add-genres']) }}
                        {!! Form::close() !!}
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Categories name</th>
                                <th>Tools</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($genres as $key => $gen )
                                <tr>
                                    <td>{{$gen['id']}}</td>
                                    <td>{{$gen['name']}}</td>

                                    @if($gen->categories !== null)
                                        <td>{{$gen->categories->name}}</td>
                                    @else
                                        <td></td>
                                        @endif
                                    <td>
                                        <div class="form-group" >
                                            {!! Form::open(['method'=>'GET' , 'route' => ['genres.edit',$gen->id]]) !!}
                                            {{ Form::button('Update', ['class' => 'btn btn-primary float-right m-2' ,'type' => 'submit']) }}
                                            {!! Form::close() !!}
                                            {!! Form::open(['method'=>'DELETE' , 'route' => ['genres.destroy',$gen->id]]) !!}
                                            {{ Form::button('Delete', ['class' => 'btn btn-danger float-right m-2','type' => 'submit']) }}
                                            {!! Form::close() !!}

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                           {!! Form::close() !!}
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Categories name</th>
                                <th>Tools</th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <!-- Page specific script -->
    @if(count($errors) >0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('script')
    <!-- DataTables  & Plugins -->
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/plugins/jszip/jszip.min.js"></script>
    <script src="/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $(function () {
            $(".alert").fadeTo(2000, 500).slideUp(500, function () {
                $(".alert").slideUp(500);
            });
        });
    </script>
@endsection

