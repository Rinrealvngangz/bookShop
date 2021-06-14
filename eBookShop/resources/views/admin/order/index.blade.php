@extends('layouts.main')

@section('name')
    <h1>Orders</h1>
@endsection
@section('root')
    <a href="{{route('admin.index')}}">
        App
    </a>

@endsection
@section('model')
    Orders
@endsection

@section('content')

            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom d-flex justify-content-between">
                        <h2>Order</h2>

                    </div>
                <div class="card-body">
                <div class="basic-data-table">

                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th class="d-none d-lg-table-cell">Order Date</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $item)

                        <tr>
                            <td>{{$item->id}}</td>
                            <td >
                                <a class="text-dark" href="{{route('order.orderShow',[$item->id,$item->user->id])}}">{{$item->user->full_name}}</a>
                            </td>
                            <td class="d-none d-lg-table-cell">{{$item->created_at}}</td>
                            <td>{{$item->city}}</td>
                            <td>{{$item->country}}</td>
                            <td>
                                @if($item->status === "Waiting accepted")
                                <span class="badge badge-warning">{{$item->status}}</span>
                                    @elseif($item->status === "Waiting delivery")
                                    <span class="badge badge-secondary">{{$item->status}}</span>
                                @elseif($item->status === "Successfully delivered")
                                    <span class="badge badge-success">{{$item->status}}</span>
                                @elseif($item->status === "Accepted")
                                    <span class="badge badge-info">{{$item->status}}</span>
                                @else
                                    <span class="badge badge-danger">{{$item->status}}</span>
                                    @endif
                            </td>
                            <td>
                                @if($item->payment === null)
                                      Thanh toán khi nhận hàng
                                @else
                                    <ul>
                                        <li>Thanh toán:Online</li>
                                        <li>Số tiền:{{number_format(substr($item->payment->money,0,-2), 0)}} vnd</li>
                                        <li>Nội dung thanh toán:{{$item->payment->note}}</li>
                                        @if($item->payment->vnp_response_code == 00)
                                        <li>Trạng thái:Thành công</li>
                                        @endif
                                        <li>Mã GD Tại VNPAY:{{$item->payment->code_vnpay}}</li>
                                        <li>Mã Ngân hàng:{{$item->payment->code_bank}}</li>
                                        <li>Thời gian:{{$item->payment->time}}</li>
                                    </ul>
                                    @endif
                            </td>
                            <td>
                                @if(auth()->user()->hasDirectPermission('Update')||auth()->user()->hasRole('Administrator'))
                                    <select class="form-select" data-value="{{$item->id}}" id="setColor{{$item->id}}" onchange="getColor(this)">

                                       <option class="badge badge-info" value="0">Accepted</option>
                                        <option class="badge badge-warning" value="1">Waiting accepted</option>
                                        <option class="badge badge-secondary" value="2">Waiting delivery</option>
                                        <option class="badge badge-success" value="3">Successfully delivered</option>
                                        <option class="badge badge-danger" value="4">Cancel</option>

                                    </select>
                                    @endif

                            </td>
                            <td>
                                @if(auth()->user()->hasDirectPermission('Update')||auth()->user()->hasRole('Administrator'))
                                {!! Form::open(['method' => 'PATCH' ,'route' => ['order.update',$item->id] ]) !!}
                                             <input id="status{{$item->id}}" name="status" type="hidden" value="">
                                    <button data-value="{{$item->id}}"   class="mb-1 btn btn-sm btn-primary" type="submit">Save</button>
                                {!! Form::close() !!}
                                 @endif

                            </td>

                        </tr>

                        @endforeach
                        </tbody>
                    </table>

                </div>
                </div>
            </div>
        </div>

@endsection
@section('script')
    <script>
        @if(Session::has('update-status'))
        $(".alert-highlighted span").text("{{session('update-status')}}");
        $('.alert-highlighted').show();
        $('.alert-highlighted').fadeOut(5000);
        @elseif(Session::has('delete-success'))
        $(".alert-highlighted span").text("{{session('delete-success')}}");
        $('.alert-highlighted').show();
        $('.alert-highlighted').fadeOut(5000);
        @endif
       function getColor(item){
             var id =  item.getAttribute("data-value");
             var htmlId = "#setColor"+id;
           var val = $(htmlId).find('option:selected').text();

           $(`input[id="status${id}"]`).val(val);
               console.log(val);
               $(htmlId).removeClass('btn-info');
               $(htmlId).removeClass('btn-success');
               $(htmlId).removeClass('btn-warning');
               $(htmlId).removeClass('btn-danger');
               $(htmlId).removeClass('btn-secondary');
               if(val === "Waiting delivery"){
                   $(htmlId).addClass('btn-secondary');
               }
               else if(val === "Successfully delivered"){
                   $(htmlId).addClass('btn-success');
               }
               else if(val === "Accepted"){
                   $(htmlId).addClass('btn-info');
               }
               else if(val === "Cancel"){
                   $(htmlId).addClass('btn-danger');
               }else if (val === "Waiting accepted"){
                   $(htmlId).addClass('btn-warning');
               }
       }


       </script>

@endsection
