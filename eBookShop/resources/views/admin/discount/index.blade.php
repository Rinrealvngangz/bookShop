@extends('layouts.main')

@section('content')
    @if(session('delete'))
        <div class="alert alert-primary" role="alert">
            {{ session('delete') }}
        </div>
        @endif
    @if(session('update'))
        <div class="alert alert-primary" role="alert">
            {{ session('update') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Discount</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">


                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Value</th>
                                <th>Tools</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($discount as $discounts )
                                <tr>
                                    <td>{{$discounts->id}}</td>
                                    <td>{{$discounts->name}}</td>
                                    <td>{{round ($discounts->value * 100 / 100) }}%</td>
                                    <td>
                                        <div class="form-group" >
                                            {!! Form::open(['method'=>'DELETE' , 'route' => ['discount.destroy',$discounts->id]]) !!}
                                            {{ Form::button('Delete', ['class' => 'btn btn-danger float-right m-2','type' => 'submit']) }}
                                            {!! Form::close() !!}
                                            {!! Form::open(['method'=>'GET' , 'route' => ['discount.edit',$discounts->id]]) !!}
                                            {{ Form::button('Update', ['class' => 'btn btn-primary float-right m-2' ,'type' => 'submit']) }}
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
                                <th>Value</th>
                                <th>Tools</th>
                            </tr>
                            </tfoot>
                        </table>
                        {!! Form::open(['method'=>'GET' , 'route' => ['discount.create']]) !!}
                        {{ Form::button('Create', ['class' => 'btn btn-primary m-2','type' => 'submit']) }}
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
    </script>
    <script>
        $(function () {
            $(".alert").fadeTo(2000, 500).slideUp(500, function () {
                $(".alert").slideUp(500);
            });
        });
    </script>
@endsection

