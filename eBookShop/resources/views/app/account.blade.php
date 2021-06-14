@extends('app.home')
@section('pageWrapper')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Tài khoản</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="{{route('account',Auth::user()->id)}}">Tài khoản</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
@endsection
@section('content')
    <!-- Account-Page -->
    <div class="page-account u-s-p-t-80">
        <div class="container">
            <div class="row">
                <!-- Login -->
                <div class="col-lg-6">
                    <div class="login-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Thông tin tài khoản</h2>
                        <h6 class="account-h6 u-s-m-b-30">Xin chào! Thông tin tài khoản của {{Auth::user()->full_name}}</h6>
                        <form>
                            <div class="u-s-m-b-30">
                                <label for="user-name-email">Email
                                    <span style="color: black;">: {{Auth::user()->full_name}}</span>
                                </label>

                            </div>
                            <div class="u-s-m-b-30">
                                <label>Số điện thoại
                                    <span style="color: black;">: {{Auth::user()->phoneNumber}}</span>
                                </label>
                            </div>
                            <div class="u-s-m-b-30">
                                <label>Địa chỉ
                                    <span style="color: black;">: {{Auth::user()->address}}</span>
                                </label>
                            </div>
                            <div class="u-s-m-b-30">
                                <label>Ngày tạo
                                    <span style="color: black;">: {{Auth::user()->created_at}}</span>
                                </label>
                            </div>
                            <div class="u-s-m-b-30">
                                <label>Ngày cập nhật gần đây:
                                    <span style="color: black;">: {{Auth::user()->updated_at}}</span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Login /- -->
                <!-- Register -->
                <div class="col-lg-6">
                    <div class="reg-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">Cập nhật tài khoản</h2>
                        <h6 class="account-h6 u-s-m-b-30">Cập nhật thông tin cá nhân tại form mày.</h6>
                        {!! Form::open(['method' => 'POST' ,'route' => ['account.update',Auth::user()->id]]) !!}

                        <div class="u-s-m-b-15">
                                <label for="lastName">Họ lót
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="lastName" id="lastName" class="text-field" value="{{Auth::user()->lastName}}" placeholder="Họ lót">
                            @if(count($errors) >0)
                                @if($errors->has('lastName'))
                                    <span style="color: red;" class="lastName">{{$errors->first('lastName')}}</span>
                                @endif
                            @endif
                                <label for="firstName">Tên
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="firstName" id="firstName" class="text-field"  value="{{Auth::user()->firstName}}" placeholder="Tên">
                            @if(count($errors) >0)
                                @if($errors->has('firstName'))
                                    <span style="color: red;" class="firstName">{{$errors->first('firstName')}}</span>
                                @endif
                            @endif
                            </div>
                            <div class="u-s-m-b-15">
                                <label for="address">Địa chỉ
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="address" id="address" class="text-field" value="{{Auth::user()->address}}" placeholder="Địa chỉ">
                                @if(count($errors) >0)
                                    @if($errors->has('address'))
                                        <span style="color: red;" class="address">{{$errors->first('address')}}</span>
                                    @endif
                                @endif
                            </div>
                            <div class="u-s-m-b-15">
                                <label for="phoneNumber">Số điện thoại
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="phoneNumber" id="phoneNumber" class="text-field"  value="{{Auth::user()->phoneNumber}}" placeholder="Số điện thoại">
                                @if(count($errors) >0)
                                    @if($errors->has('phoneNumber'))
                                        <span style="color: red;" class="phoneNumber">{{$errors->first('phoneNumber')}}</span>
                                    @endif
                                @endif
                            </div>
                            <div class="u-s-m-b-15">
                                <label for="email">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="email" id="email" class="text-field"  value="{{Auth::user()->email}}" placeholder="Địa chỉ email">
                                @if(count($errors) >0)
                                    @if($errors->has('email'))
                                        <span style="color: red;" class="email">{{$errors->first('email')}}</span>
                                    @endif
                                @endif
                            </div>

                            <div class="u-s-m-b-15">
                                <label for="passwordOld">Mật khẩu cũ
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="passwordOld" id="passwordOld" class="text-field" placeholder="Mật khẩu cũ">
                                @if(count($errors) >0)
                                    @if($errors->has('passwordOld'))
                                        <span style="color: red;" class="passwordOld">{{$errors->first('passwordOld')}}</span>
                                    @endif
                                @endif
                            </div>
                            <div class="u-s-m-b-15">
                                <label for="password">Mật khẩu mới
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" name="password" id="password" class="text-field" placeholder="Mật khẩu mới">
                                @if(count($errors) >0)
                                    @if($errors->has('password'))
                                        <span style="color: red;" class="password">{{$errors->first('password')}}</span>
                                    @endif
                                @endif
                            </div>
                            <div class="u-s-m-b-15">
                                <label for="password_confirmation">Xác nhận mật khẩu
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="password_confirmation" name="password_confirmation" class="text-field" placeholder="Xác nhận mật khẩu">
                            </div>
                            <div class="u-s-m-b-45">
                                <button class="button button-primary w-100">Cập nhật</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- Register /- -->
            </div>
        </div>
    </div>
    <!-- Account-Page /- -->
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
