@extends('app.home')
@section('pageWrapper')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Thanh toán</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="{{route('cart.checkout')}}">Thanh toán</a>
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
                    {!! Form::open(['method' => 'POST' ,'route' => ['cart.order',Auth::user()->id]]) !!}
                        <div class="row">
                            <!-- Billing-&-Shipping-Details -->
                            <div class="col-lg-6">
                                <h4 class="section-h4">Chi tiết thanh toán</h4>
                                <input name="userId" type="hidden" value="{{Auth::user()->id}}">
                                <!-- Form-Fields -->
                                <div class="group-inline u-s-m-b-13">
                                        <label for="nameReceive">Họ và tên người nhận
                                            <span class="astk">*</span>
                                        </label>

                                        <input name="nameReceive" type="text" id="nameReceive" class="text-field" value="{{Auth::user()->full_name}}">
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
                                    <div class="select-box-wrapper">
                                        <select class="select-box"  id="national" name="national">
                                            <option selected="selected"  value="0">-- Quốc gia --</option>
                                            <option>Việt Nam</option>
                                        </select>
                                        @if(count($errors) >0)
                                            @if($errors->has('national'))
                                                <span style="color: red;" class="national">{{$errors->first('national')}}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="select-country">Thành phố
                                        <span class="astk">*</span>
                                    </label>
                                    <div class="select-box-wrapper">
                                        <select class="select-box" name="city" id="city">
                                            <option  value="0">-- Tỉnh/Thành phố --</option>
                                            <option>Cần Thơ</option>
                                            <option>Đà Nẵng</option>
                                            <option>Hải Phòng</option>
                                            <option>Hà Nội</option>
                                            <option>TP HCM</option>
                                            <option>An Giang</option>
                                            <option>Bà Rịa - Vũng Tàu</option>
                                            <option>Bắc Giang</option>
                                            <option>Bắc Kạn</option>
                                            <option>Bạc Liêu</option>
                                            <option>Bắc Ninh</option>
                                            <option>Bến Tre</option>
                                            <option>Bình Định</option>
                                            <option>Bình Dương</option>
                                            <option>Bình Phước</option>
                                            <option>Bình Thuận</option>
                                            <option>Cà Mau</option>
                                            <option>Cao Bằng</option>
                                            <option>Đắk Lắk</option>
                                            <option>Đắk Nông</option>
                                            <option>Điện Biên</option>
                                            <option>Đồng Nai</option>
                                            <option>Đồng Tháp</option>
                                            <option>Gia Lai</option>
                                            <option>Hà Giang</option>
                                            <option>Hà Nam</option>
                                            <option>Hà Tĩnh</option>
                                            <option>Hải Dương</option>
                                            <option>Hậu Giang</option>
                                            <option>Hòa Bình</option>
                                            <option>Hưng Yên</option>
                                            <option>Khánh Hòa</option>
                                            <option>Kiên Giang</option>
                                            <option>Kon Tum</option>
                                            <option>Lai Châu</option>
                                            <option>Lâm Đồng</option>
                                            <option>Lạng Sơn</option>
                                            <option>Lào Cai</option>
                                            <option>Long An</option>
                                            <option>Nam Định</option>
                                            <option>Nghệ An</option>
                                            <option>Ninh Bình</option>
                                            <option>Ninh Thuận</option>
                                            <option>Phú Thọ</option>
                                            <option>Quảng Bình</option>
                                            <option>Quảng Nam</option>
                                            <option>Quảng Ngãi</option>
                                            <option>Quảng Ninh</option>
                                            <option>Quảng Trị</option>
                                            <option>Sóc Trăng</option>
                                            <option>Sơn La</option>
                                            <option>Tây Ninh</option>
                                            <option>Thái Bình</option>
                                            <option>Thái Nguyên</option>
                                            <option>Thanh Hóa</option>
                                            <option>Thừa Thiên Huế</option>
                                            <option>Tiền Giang</option>
                                            <option>Trà Vinh</option>
                                            <option>Tuyên Quang</option>
                                            <option>Vĩnh Long</option>
                                            <option>Vĩnh Phúc</option>
                                            <option>Yên Bái</option>
                                            <option>Phú Yên</option>
                                        </select>

                                        @if(count($errors) >0)
                                            @if($errors->has('city'))
                                                <span style="color: red;" class="city">{{$errors->first('city')}}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="district">Quận/Huyện
                                        <span class="astk">*</span>
                                    </label>
                                    <div class="select-box-wrapper">
                                        <select class="select-box"  id="district" name="district">
                                            <option value="0">Quận/Huyện</option>
                                            <option>Huyện Hóc Môn</option>
                                            <option>Quận Gò Vấp</option>
                                            <option>Quận Tân Phú</option>
                                            <option>Huyện Bình Chánh</option>
                                            <option>Quận Bình Tân</option>
                                            <option>Quận Bình Thạnh</option>
                                            <option>Huyện Cần Giờ</option>
                                            <option>Huyện Nhà Bè</option>
                                        </select>
                                        @if(count($errors) >0)
                                            @if($errors->has('district'))
                                                <span style="color: red;" class="district">{{$errors->first('district')}}</span>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                                <div class="street-address u-s-m-b-13">
                                    <label for="address">Địa chỉ nhận hàng
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" name="address" id="address" class="text-field" placeholder="Địa chỉ nhận hàng">
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
                                        <input name="phoneNumber" type="text" id="phoneNumber" class="text-field" placeholder="Nhập số điện thoại">
                                        @if(count($errors) >0)
                                            @if($errors->has('phoneNumber'))
                                                <span style="color: red;" class="phoneNumber">{{$errors->first('phoneNumber')}}</span>
                                            @endif
                                        @endif
                                    </div>

                                </div>

                                <div>
                                    <label for="message">Ghi chú</label>
                                    <textarea name="message" id="message" class="text-area"  placeholder="Ghi chú về đơn hàng."></textarea>
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

                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Tổng tiền</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3 subtotal"></h3>
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
                                            <td>
                                                <h3 class="order-h3">Tổng tiền thu</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3 totalPrice"></h3>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="u-s-m-b-13">
                                        <input type="radio"   value="1" onclick="hidePay()" class="radio-box" name="payment_online" id="cash-on-delivery">
                                        <label class="label-text" for="cash-on-delivery">Thanh toán khi nhận hàng</label>
                                    </div>

                                    <div class="u-s-m-b-13">
                                        <input type="radio" value="2" onclick="openPay()" class="radio-box" name="payment_online" id="paypal">
                                        <label class="label-text" for="paypal">Thanh toán qua thẻ</label>
                                    </div>
                                    <div style="display: none" class="vnpay u-s-m-b-13">
                                        <label for="bank_code">Chọn ngân hàng
                                            <span class="astk">*</span>
                                        </label>
                                        <div class="select-box-wrapper">
                                            <select class="select-box"  id="bank_code" name="bank_code">
                                                <option value="0">Không chọn</option>
                                                <option value="NCB"> Ngan hang NCB</option>
                                                <option value="AGRIBANK"> Ngan hang Agribank</option>
                                                <option value="SCB"> Ngan hang SCB</option>
                                                <option value="SACOMBANK">Ngan hang SacomBank</option>
                                                <option value="EXIMBANK"> Ngan hang EximBank</option>
                                                <option value="MSBANK"> Ngan hang MSBANK</option>
                                                <option value="NAMABANK"> Ngan hang NamABank</option>
                                                <option value="VNMART"> Vi dien tu VnMart</option>
                                                <option value="VIETINBANK">Ngan hang Vietinbank</option>
                                                <option value="VIETCOMBANK"> Ngan hang VCB</option>
                                                <option value="HDBANK">Ngan hang HDBank</option>
                                                <option value="DONGABANK"> Ngan hang Dong A</option>
                                                <option value="TPBANK"> Ngân hàng TPBank</option>
                                                <option value="OJB"> Ngân hàng OceanBank</option>
                                                <option value="BIDV"> Ngân hàng BIDV</option>
                                                <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                                                <option value="VPBANK"> Ngan hang VPBank</option>
                                                <option value="MBBANK"> Ngan hang MBBank</option>
                                                <option value="ACB"> Ngan hang ACB</option>
                                                <option value="OCB"> Ngan hang OCB</option>
                                                <option value="IVB"> Ngan hang IVB</option>
                                                <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                                            </select>
                                            @if(count($errors) >0)
                                                @if($errors->has('bank_code'))
                                                    <span style="color: red;" class="bank_code">{{$errors->first('bank_code')}}</span>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                    <div style="display: none" class="content-pay u-s-m-b-13">
                                        <label for="order_desc">Nội dung thanh toán</label>
                                        <textarea name="order_desc" id="order_desc" class="text-area"  placeholder="Nội dung thanh toán."></textarea>
                                        @if(count($errors) >0)
                                            @if($errors->has('order_desc'))
                                                <span style="color: red;" class="order_desc">{{$errors->first('order_desc')}}</span>
                                            @endif
                                        @endif
                                    </div>

                                    <button type="submit" class="button button-outline-secondary">Đặt hàng</button>
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

    <script src={{asset("error-handler/exception.js")}}></script>
   <script>
      function openPay(){
              $('.vnpay').show();
          $('.content-pay').show();

      }
      function hidePay(){
          $('.vnpay').hide();
          $('.content-pay').hide();
      }
       $('.cart-anchor').show();
       window.onload = function() {
           if (localStorage.getItem("items") !== null && JSON.parse(localStorage.getItem('items')).length > 0) {
               $('.coupon-area').show();
               $('.checkout').show();
           }
           // adding data to shopping cart
           const iconShoppingP = document.querySelector('#mini-cart-trigger span');
           const totalPrice = document.querySelector('#mini-cart-trigger').children[2];
           let no = 0;
           let priceTotal = 0;
           JSON.parse(localStorage.getItem('items')).map(data => {
               no = no + parseInt(data.no);

               priceTotal = priceTotal + (parseInt(data.no) * data.price);
               var formatPrice = (data.price).toLocaleString(
                   undefined,
                   {minimumFractionDigits: 3}
               );
               $html = '<li class="clearfix">' +
                   '<a href="http://127.0.0.1:8000/home/' + data.name + '/' + data.id + '">' +
                   '<img src="' + data.img + '" alt="Product">' +
                   '<span class="mini-item-name">' + data.name + '</span>' +
                   '<span class="mini-item-price">' + formatPrice + ' VND</span>' +
                   '<span class="mini-item-quantity"> x ' + data.no + '</span>' +
                   '</a>' +
                   '</li>';
               $('.mini-cart-list').append($html);
           });

           let formatPrice = (priceTotal).toLocaleString(
               undefined,
               {minimumFractionDigits: 3}
           );

           if (formatPrice !== "0.000") {
               var formatPriceTotal = (parseFloat(priceTotal + 30.000)).toLocaleString(
                   undefined,
                   {minimumFractionDigits: 3}
               );
               iconShoppingP.innerHTML = no;
               totalPrice.innerHTML = formatPrice + "VND";
               $('.totalPrice').text(formatPriceTotal + " VND")
               $('.mini-total-price').text(formatPrice + ' VND');
               $('.subtotal').text(formatPrice + ' VND');
           }
           const cartBox = document.querySelector('.order-table');
           const cardBoxTable = cartBox.querySelector('tbody');
           let tableData = '';
           JSON.parse(localStorage.getItem('items')).map(data=>{
               tableData +='<input type="hidden" name="book[]" value="'+data.id+','+data.no +'">'+
                   '<tr>'+
                   '<td>'+
                   '<h6 class="order-h6">'+data.name+'</h6>'+
               '<span class="order-span-quantity"> x ' +data.no+'</span>'+
           '</td>'+
           '<td>'+
           '<h6 class="order-h6">'+(data.price * data.no).toFixed(3)+' VND</h6>'+
           '</td>'+
           '</tr>';
           });
           tableData+='<input type="hidden" name="totalPrice" value="'+formatPrice.split("đ")[0].replace(/\,/g,'').split('.').join('')+'">'+
               '<input type="hidden" name="totalPriceOrder" value="'+ formatPriceTotal.split("đ")[0].replace(/\,/g,'').split('.').join('')+'">'+
               '<input type="hidden" name="quantity" value="'+no+'">'+
               '<tr>'+
               '<td>'+
               '<h3 class="order-h3">Tổng tiền</h3>'+
               '</td>'+
               '<td>'+
               '<h3 class="order-h3 subtotal">'+formatPrice+' VND</h3>'+
               '</td>'+
               '</tr>'+
               '<tr>'+
               '<td>'+
               '<h3 class="order-h3">Phí giao hàng</h3>'+
               '</td>'+
               '<td>'+
               '<h3 class="order-h3">30.000 VND</h3>'+
               '</td>'+
               '</tr>'+

               '<tr>'+
               '<td>'+
               '<h3 class="order-h3">Tổng tiền thu</h3>'+
               '</td>'+
               '<td>'+
               '<h3 class="order-h3 totalPrice">'+formatPriceTotal +' VND</h3>'+
               '</td>'+
               '</tr>';
           cardBoxTable.innerHTML =tableData;
       }

   </script>
@endsection
