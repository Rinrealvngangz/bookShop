@extends('app.home')
@section('pageWrapper')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Danh sách đơn hàng</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="{{route('cart.salesOrder',Auth::user()->id)}}">Danh sách đơn hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
@endsection
@section('content')
    <!-- Wishlist-Page -->
    <div class="page-wishlist u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Products-List-Wrapper -->
                    <div class="table-wrapper u-s-m-b-60">
                        <table>
                            <thead>
                            <tr>
                                <th>Mã hóa đơn</th>
                                <th>Tên người nhận</th>
                                <th>Giá phải trả</th>
                                <th>Tình trạng</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $order)

                            <tr>
                                {!! Form::open(['method' => 'DELETE' ,'route' => ['cart.deleteSalesOrderDetail',$order->id,Auth::user()->id]]) !!}
                                <td>
                                    <div class="cart-anchor-image">
                                        <a href="javascript:void(0)">
                                            <h6>{{$order->id}}</h6>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="order-name">
                                        <a href="http://127.0.0.1:8000/sales/order/{{$order->id}}/customer/{{Auth::user()->id}}">{{$order->nameReceive}}</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-price">
                                            @if($order->payment === null)
                                            {{number_format($order->totalPriceFee, 0)}} vnd
                                        @else
                                                Đã thanh toán online
                                        @endif
                                    </div>
                                </td>
                                <td class="cart-stock">
                                    {{$order->status}}
                                </td>
                                <td>
                                    <div class="action-wrapper">

                                        <input type="button"  onclick="location.href='http://127.0.0.1:8000/sales/order/{{$order->id}}/customer/{{Auth::user()->id}}'" class="button button-outline-secondary" value="Xem chi tiết"></input>
                                        @if($order->status === "Waiting accepted" || $order->status === "Accepted" )


                                        <button type="submit" class="button button-outline-secondary fas fa-trash"></button>

                                        @endif

                                    </div>
                                </td>
                                {!! Form::close() !!}
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- Products-List-Wrapper /- -->
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist-Page /- -->
@endsection
@section('script')
    <script>

        window.onload = function() {
            if (localStorage.getItem("items") !== null &&  JSON.parse(localStorage.getItem('items')).length >0 ) {
                $('.cart-anchor').show();
                $('.checkout-anchor').show();
                // adding data to shopping cart
                const iconShoppingP = document.querySelector('#mini-cart-trigger span');
                const totalPrice = document.querySelector('#mini-cart-trigger').children[2];
                let no = 0;
                let priceTotal =0;
                JSON.parse(localStorage.getItem('items')).map(data=>{
                    no = no+ parseInt(data.no);
                    priceTotal = priceTotal +(parseInt(data.no) * data.price);
                    var formatPrice =(data.price).toLocaleString(
                        undefined,
                        { minimumFractionDigits: 3 }
                    );
                    $html =  '<li class="clearfix">'+
                        '<a href="http://127.0.0.1:8000/home/'+data.name+'/'+data.id +'">'+
                        '<img src="'+data.img+'" alt="Product">'+
                        '<span class="mini-item-name">'+data.name+'</span>'+
                        '<span class="mini-item-price">'+formatPrice+ ' VND</span>'+
                        '<span class="mini-item-quantity"> x '+data.no +'</span>'+
                        '</a>'+
                        '</li>';
                    $('.mini-cart-list').append($html);
                });

                let formatPrice =(priceTotal).toLocaleString(
                    undefined,
                    { minimumFractionDigits: 3 }
                );

                if(formatPrice !== "0.000"){
                    var formatPriceTotal =(parseFloat(priceTotal+30.000)).toLocaleString(
                        undefined,
                        { minimumFractionDigits: 3 }
                    );
                    iconShoppingP.innerHTML = no;
                    totalPrice.innerHTML =formatPrice + "VND";
                    $('.calc-text-total').text(formatPrice + ' VND');
                    $('.calc-text-order').text(formatPriceTotal + ' VND');
                    $('.mini-total-price').text(formatPrice + ' VND');
                }
            }
        }

    </script>
@endsection
