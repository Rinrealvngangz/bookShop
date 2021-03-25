@extends('layouts.main')

@section('content')

    @if(Session::has('update-role'))
        <div class="alert alert-primary" role="alert">
            <p >{{session('update-role')}}</p>
        </div>

    @endif
    @if(Session::has('create-role'))
        <div class="alert alert-success" role="alert">
            <p >{{session('create-role')}}</p>
        </div>

    @endif

    @if(Session::has('delete-role'))
        <div class="alert alert-danger" role="alert">
            <p >{{session('delete-role')}}</p>
        </div>

    @endif


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        {!! Form::open(['method'=>'POST' , 'route' => ['order.store']]) !!}

                        <table id="table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="active">
                                    <input type="checkbox" class="select-all checkbox" name="select-all" />
                                </th>
                                <th>Id</th>
                                <th>Customer</th>
                                <th>State</th>
                                <th>Active</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order as $orders )
                                <tr>
                                    <td class="active">
                                        <input type="checkbox" class="select-item checkbox" name="chk[]" value="{{$orders->id}}"/>
                                    </td>
                                    <td>{{$orders->id}}</td>
                                    <td>{{$orders->user->lastName}} {{$orders->user->firstName}}</td>
                                    @if($orders->state === 0)
                                        <td> Đang chờ xử lý</td>
                                    @else
                                        <td>Đang giao hàng</td>
                                    @endif
                                    @if($orders->active === 0)
                                        <td>Chờ chấp nhận</td>
                                    @else
                                        <td>Đã chấp nhận</td>
                                    @endif
                                </tr>

                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Customer</th>
                                <th>State</th>
                                <th>Active</th>

                            </tr>
                            </tfoot>
                        </table>
                        <div class="flex-column">

                            {{ Form::button('Accept', ['class' => 'btn btn-primary' ,'disabled'=>true ,'type' => 'submit']) }}

                            {{ Form::button('Decline', ['class' => 'btn btn-danger','disabled'=>true ,'id'=>$orders->id, 'type' => 'submit']) }}
                        </div>
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

            //button select all or cancel
            $("#select-all").click(function () {
                var all = $("input.select-all")[0];
                all.checked = !all.checked
                var checked = all.checked;
                $("input.select-item").each(function (index,item) {
                    item.checked = checked;
                });
            });
            //column checkbox select all or cancel
            $("input.select-all").click(function () {
                var checked = this.checked;
                $("input.select-item").each(function (index,item) {
                    item.checked = checked;

                });
                var arrChecked = $('input.select-item:checked');
                var arrayId = [];
                arrChecked.each(function(index,item) {
                    var id =$(item).val();
                    arrayId.push(id);

                });

                $("button.btn-danger").each(function (index,item) {
                    var idDel =  item.id;
                    if(jQuery.inArray(idDel, arrayId)!==-1){

                        $(item).prop('disabled',false);
                        $("button.btn-primary").prop('disabled',false);
                    }else{
                        $(item).prop('disabled',true);
                        $("button.btn-primary").prop('disabled',true);
                    }
                });

            });
            //check selected items
            $("input.select-item").click(function () {
                var checked = this.checked;

                var all = $("input.select-all")[0];
                var total = $("input.select-item").length;
                var len = $("input.select-item:checked:checked").length;
                all.checked = len===total;

                if(checked){
                    $("button.btn-primary").prop('disabled',false);
                    $("button.btn-danger").prop('disabled',false);
                }else{
                    $("button.btn-primary").prop('disabled',true);
                    $("button.btn-danger").prop('disabled',true);
                }

            });

        });


    </script>

@endsection

