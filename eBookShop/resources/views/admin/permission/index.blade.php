@extends('layouts.main')

@section('content')
    @if(Session::has('update-permission'))
        <div class="alert alert-primary" role="alert">
            <p >{{session('update-permission')}}</p>
        </div>

    @endif

    @if(Session::has('delete-permission'))
        <div class="alert alert-danger" role="alert">
            <p >{{session('delete-permission')}}</p>
        </div>

    @endif

    @if(Session::has('create-permission'))
        <div class="alert alert-success" role="alert">
            <p >{{session('create-permission')}}</p>
        </div>

    @endif

    <div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permission</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Permissions</th>
                        <th>Tools</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permission as $permissions )
                        <tr>
                            <td>{{$permissions->id}}</td>
                            <td>{{$permissions->name}}</td>
                            <td>
                                <div class="input-group mb-2">

                                    {!! Form::open(['method'=>'GET' , 'route' => ['permission.edit',$permissions->id]]) !!}
                                    {{ Form::button('<i class="fas fa-edit"></i>', ['class' => 'btn btn-success', 'type' => 'submit']) }}
                                    {!! Form::close() !!}

                                    {!! Form::open(['method'=>'DELETE' , 'route' => ['permission.destroy',$permissions->id]]) !!}
                                    {{ Form::button('<i class="far fa-trash-alt"></i>', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
                                    {!! Form::close() !!}
                                </div>
                            </td>

                        </tr>

                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Permissions</th>
                        <th>Tools</th>
                    </tr>
                    </tfoot>
                </table>
                {!! Form::open(['method'=>'GET' , 'route' => ['permission.create']]) !!}
                {{ Form::button('Create Permission', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
                {!! Form::close() !!}

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

        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
    </script>


@endsection
