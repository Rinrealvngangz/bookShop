@extends('app.home')
@section('pageWrapper')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Thanh toán chi tiết</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="#">Thanh toán chi tiết</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
@endsection
@section('content')
    <div class="page-checkout u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
    <div class="col-lg-12">
        <h4 class="section-h4">
            Thông tin thanh toán
        </h4>
        <div class="order-table">
            <table class="u-s-m-b-13">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <h6 class="order-h6">Mã đơn hàng</h6>
                        <span class="order-span-quantity">{{$result->order->id}}</span>
                    </td>
                    <td>
                        <h6 class="order-h6">Số tiền:</h6>
                        <span class="order-span-quantity">{{number_format(substr($result->money,0,-2), 0)}}</span>
                    </td>
                    <td>
                        <h6 class="order-h6">Nội dung thanh toán:</h6>
                        <span class="order-span-quantity">{{$result->note}}</span>
                    </td>
                    <td>
                        <h6 class="order-h6">Mã phản hồi (vnp_ResponseCode):</h6>
                        <span class="order-span-quantity">{{$result->vnp_response_code}}</span>
                    </td>
                    <td>
                        <h6 class="order-h6">Mã GD Tại VNPAY:</h6>
                        <span class="order-span-quantity">{{$result->code_vnpay}}</span>
                    </td>
                    <td>
                        <h6 class="order-h6">Mã Ngân hàng:</h6>
                        <span class="order-span-quantity">{{$result->code_bank}}</span>
                    </td>
                    <td>
                        <h6 class="order-h6">Thời gian thanh toán:</h6>
                        <span class="order-span-quantity">{{$result->time}}</span>
                    </td>
                    <td>
                        <h6 class="order-h6">Kết quả</h6>
                        <span class="order-span-quantity">Đặt hàng thành công</span>
                    </td>
                </tr>
                </tbody>
            </table>
            <input class="button button-primary d-block w-40" type="button" onclick="location.href='http://127.0.0.1:8000/home';" value="Về trang chủ" />

        </div>
    </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        localStorage.removeItem("items");
    </script>

@endsection
