@extends('layouts.main')

@section('content')
    @if(session('delete-category'))
        <div class="alert alert-primary" role="alert">
            {{ session('delete-category') }}
        </div>
        @endif
    @if(session('update-category'))
        <div class="alert alert-primary" role="alert">
            {{ session('update-category') }}
        </div>
    @endif
    @if(session('create-category'))
        <div class="alert alert-primary" role="alert">
            {{ session('create-category') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['action'=>'','method'=>'GET' , 'route' => ['category.create']]) !!}
                             {{ Form::button('Create', ['class' => 'btn btn-primary m-2','name'=>'action' ,'type' => 'submit','value' => 'add-cate']) }}
                    {!! Form::close() !!}
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Tools</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($category as $cate )
                                <tr>
                                    <td>{{$cate->id}}</td>
                                    <td>{{$cate->name}}</td>

                                    <td>
                                        <div class="form-group" >
                                            {!! Form::open(['method'=>'GET' , 'route' => ['category.edit',$cate->id]]) !!}
                                            {{ Form::button('Update', ['class' => 'btn btn-primary float-right m-2' ,'type' => 'submit']) }}
                                            {!! Form::close() !!}
                                            {!! Form::open(['method'=>'DELETE' , 'route' => ['category.destroy',$cate->id]]) !!}
                                            {{ Form::button('Delete', ['class' => 'btn btn-danger float-right m-2','type' => 'submit']) }}
                                            {!! Form::close() !!}

                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
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

