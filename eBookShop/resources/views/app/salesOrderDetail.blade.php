@extends('app.home')
@section('pageWrapper')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Đơn hàng chi tiết</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="http://127.0.0.1:8000/sales/order/{{$item->getId()}}/customer/{{Auth::user()->id}}">Đơn hàng chi tiết</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
@endsection
@section('content')
    <!-- Checkout-Page -->
    <div class="page-checkout u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    {!! Form::open(['method' => 'POST' ,'route' => ['cart.updateSalesOrderDetail',$item->getId(),Auth::user()->id]]) !!}
                    <div class="row">
                        <!-- Billing-&-Shipping-Details -->
                        <div class="col-lg-6">
                            <h4 class="section-h4">THông tin khách hàng</h4>
                            <input name="userId" type="hidden" value="{{Auth::user()->id}}">
                            <!-- Form-Fields -->
                            <div class="group-inline u-s-m-b-13">
                                <label for="nameReceive">Họ và tên người nhận
                                    <span class="astk">*</span>
                                </label>

                                <input name="nameReceive" type="text" id="nameReceive" class="text-field" value="{{$item->getName()}}">
                                @if(count($errors) >0)
                                    @if($errors->has('nameReceive'))
                                        <span style="color: red;" class="nameReceive">{{$errors->first('nameReceive')}}</span>
                                    @endif
                                @endif

                            </div>

                            <div class="u-s-m-b-13">
                                <label for="national">Quốc gia
                                    <span class="astk"> *</span>
                                </label>
                                <input name="national" type="text" id="national" class="text-field" value="{{$item->getCountry()}}">
                                    @if(count($errors) >0)
                                        @if($errors->has('national'))
                                            <span style="color: red;" class="national">{{$errors->first('national')}}</span>
                                        @endif
                                    @endif
                            </div>
                            <div class="u-s-m-b-13">
                                <label for="city">Thành phố
                                    <span class="astk">*</span>
                                </label>
                                <input name="city" type="text" id="city" class="text-field" value="{{$item->getCity()}}">
                                @if(count($errors) >0)
                                    @if($errors->has('city'))
                                        <span style="color: red;" class="city">{{$errors->first('city')}}</span>
                                    @endif
                                @endif
                            </div>
                            <div class="u-s-m-b-13">
                                <label for="district">Quận/Huyện
                                    <span class="astk">*</span>
                                </label>
                                <input name="district" type="text" id="district" class="text-field" value="{{$item->getDistrict()}}">

                            @if(count($errors) >0)
                                        @if($errors->has('district'))
                                            <span style="color: red;" class="district">{{$errors->first('district')}}</span>
                                        @endif
                                    @endif
                            </div>
                            <div class="street-address u-s-m-b-13">
                                <label for="address">Địa chỉ nhận hàng
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="address" id="address" class="text-field" placeholder="Địa chỉ nhận hàng" value="{{$item->getAddress()}}">
                                @if(count($errors) >0)
                                    @if($errors->has('address'))
                                        <span style="color: red;" class="address">{{$errors->first('address')}}</span>
                                    @endif
                                @endif

                            </div>


                            <div class="group-inline u-s-m-b-13">
                                <div class="group-1 u-s-p-r-16">
                                    <label for="email">Email address
                                        <span class="astk">*</span>
                                    </label>
                                    <input readonly name="email" type="text" id="email" class="text-field" value="{{Auth::user()->email}}">
                                    @if(count($errors) >0)
                                        @if($errors->has('email'))
                                            <span style="color: red;" class="email">{{$errors->first('email')}}</span>
                                        @endif
                                    @endif
                                </div>
                                <div class="group-2">
                                    <label for="phoneNumber">Số điện thoại
                                        <span class="astk">*</span>
                                    </label>
                                    <input name="phoneNumber" type="text" id="phoneNumber" class="text-field" placeholder="Nhập số điện thoại" value="{{$item->getPhoneNumber()}}">
                                    @if(count($errors) >0)
                                        @if($errors->has('phoneNumber'))
                                            <span style="color: red;" class="phoneNumber">{{$errors->first('phoneNumber')}}</span>
                                        @endif
                                    @endif
                                </div>

                            </div>

                            <div>
                                <label for="message">Ghi chú</label>
                                <textarea name="message" id="message" class="text-area"  placeholder="Ghi chú về đơn hàng.">{{$item->getNote()}}</textarea>
                            </div>
                        </div>
                        <!-- Billing-&-Shipping-Details /- -->
                        <!-- Checkout -->
                        <div class="col-lg-6">
                            <h4 class="section-h4">Đơn hàng của bạn</h4>
                            <div class="order-table">
                                <table class="u-s-m-b-13">
                                    <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($item->getListBookViewModel() as $book)
                                    <tr>
                                        <td>
                                            <h6 class="order-h6">{{$book->getTitle()}}</h6>
                                            <span class="order-span-quantity"> x {{$book->getAmount()}}</span>
                                            </td>
                                        <td>
                                            <h6 class="order-h6">{{ number_format($book->getPrice() * $book->getAmount(),3)}} VND</h6>
                                            </td>
                                        </tr>
                                    <tr>
                                        @endforeach
                                        <td>
                                            <h3 class="order-h3">Tổng tiền</h3>
                                        </td>
                                        <td>
                                            <h3 class="order-h3 subtotal">{{$item->getTotalPrice()}} VND</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="order-h3">Phí giao hàng</h3>
                                        </td>
                                        <td>
                                            <h3 class="order-h3">30.000 VND</h3>
                                        </td>
                                    </tr>

                                    <tr>
                                        @if($item->getPayment() !== "Thanh toán online")
                                        <td>
                                            <h3 class="order-h3">Tổng tiền phải trả</h3>
                                        </td>
                                        @else
                                            <td>
                                                <h3 class="order-h3">Đã thanh toán</h3>
                                            </td>
                                        @endif
                                        <td>
                                            <h3 class="order-h3 totalPrice">{{number_format($item->getTotalPriceFee(),0)}} VND</h3>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                                @if($item->getPayment() === null)
                                <div class="u-s-m-b-13">
                                    <input  readonly type="radio" checked="checked"  value="1" onclick="hidePay()" class="radio-box" name="payment_online" id="cash-on-delivery">
                                    <label class="label-text" for="cash-on-delivery">Thanh toán khi nhận hàng</label>
                                </div>
                                    @else
                                    <div class="u-s-m-b-13">
                                        <input readonly type="radio" checked="checked" value="2" onclick="openPay()" class="radio-box" name="payment_online" id="paypal">
                                        <label class="label-text" for="paypal">Đã thanh toán qua thẻ</label>
                                    </div>

                                    <div  class="content-pay u-s-m-b-13">
                                        <label for="order_desc">Nội dung thanh toán</label>
                                        <textarea name="order_desc" id="order_desc" class="text-area"  placeholder="Nội dung thanh toán.">{{$item->getPaymentNote()}}</textarea>
                                        @if(count($errors) >0)
                                            @if($errors->has('order_desc'))
                                                <span style="color: red;" class="order_desc">{{$errors->first('order_desc')}}</span>
                                            @endif
                                        @endif
                                    </div>
                               @endif
                                @if($item->getStatus() === "Waiting accepted" || $item->getStatus() === "Accepted" )
                                    <div class="u-s-m-b-13">
                                <button type="submit" class="button button-outline-secondary">Cập nhật thông tin đơn hàng</button>
                                    </div>
                                @if($item->getStatus() === "Waiting accepted")
                                    <div class="u-s-m-b-13">
                                        <span >Đang chờ chấp nhận đơn hàng</span>
                                    </div>
                                @elseif($item->getStatus() === "Accepted")
                                        <div class="u-s-m-b-13">
                                            <span style="color: #007bff;">Đang xử lý đơn hàng</span>
                                        </div>
                                    @endif
                               @endif
                                @if($item->getStatus() === "Waiting delivery")
                                <div class="u-s-m-b-13">
                                    <span style="color: #ffc107">Đơn hàng đang vận chuyển</span>
                                </div>
                                    @elseif($item->getStatus() === "Successfully delivered")
                                    <div class="u-s-m-b-13">
                                        <span style="color: #29cc97;">Đơn hàng đã được giao</span>
                                    </div>
                                @elseif($item->getStatus() === "Cancel")
                                    <div class="u-s-m-b-13">
                                        <span style="color: #d90429;">Đơn hàng đã bị hủy</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Checkout /- -->
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout-Page /- -->
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
