@extends('layouts.main')

@section('name')
    <h1>Thanh toán online</h1>
@endsection
@section('root')
    <a href="{{route('admin.index')}}">
        App
    </a>

@endsection
@section('model')
    Thanh toán online
@endsection

@section('content')

    <div class="col-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-flex justify-content-between">
                <h2>Thanh toán online</h2>
       {!! Form::open(['method' => 'POST' ,'route' => ['payment.export'],'enctype'=>'multipart/form-data']) !!}
            <button class="btn btn-success" type="submit">
                <i class=" mdi mdi-plus-circle"></i> Xuất file Excel
            </button>
           {!! Form::close() !!}
            </div>
            <div class="card-body">
                <div class="basic-data-table">

                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Tên khách hàng</th>
                            <th>Số tiền</th>
                            <th>Nội dung thanh toán</th>
                            <th class="d-none d-lg-table-cell">Thời gian</th>
                            <th>Mã GD Tại VNPAY</th>
                            <th>Mã Ngân hàng</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $item)

                            <tr>
                                   @if($item->order !== null)
                                <td>{{$item->order->id}}</td>
                                @else
                                    <td>Đơn hàng đã xóa</td>
                                  @endif
                                       <td>{{$item->thanh_vien}}</a></td>
                                <td>{{$item->money}}</a></td>
                                <td>
                                <span>{{$item->note}}</span>
                                </td>
                                <td class="d-none d-lg-table-cell">{{$item->time}}</td>
                                <td>{{$item->code_vnpay}}</td>
                                <td>{{$item->code_bank}}</td>
                                <td>
                                    @if($item->vnp_response_code === "00")
                                        <span class="badge badge-success">Thanh công</span>
                                    @else
                                        <span class="badge badge-danger">Không thành công</span>
                                    @endif
                                </td>
                                <td>
                                    @if(auth()->user()->hasDirectPermission('Delete')||auth()->user()->hasRole('Administrator'))
                                        {!! Form::open(['method' => 'DELETE' ,'route' => ['payment.destroy',$item->id] ]) !!}
                                        <button  class="mb-1 btn btn-sm btn-danger" type="submit">Delete</button>
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

