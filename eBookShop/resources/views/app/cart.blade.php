@extends('app.home')
@section('pageWrapper')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Cart</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="{{route('cart')}}">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
@endsection
@section('content')
    <!-- Cart-Page -->
    <div class="page-cart u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form>
                        <!-- Products-List-Wrapper -->
                        <div class="table-wrapper u-s-m-b-60">
                            <table class="table-cart">
                                <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- Products-List-Wrapper /- -->
                        <!-- Coupon -->
                        <div class="coupon-continue-checkout u-s-m-b-60">
                            @if(!Auth::check())
                            <div style="display:none;" class="coupon-area">
                                <h6>Đăng nhập để thanh toán</h6>
                                <input class="button button-primary d-block w-40" type="button" onclick="location.href='http://127.0.0.1:8000/login';" value="Đăng nhập" />

                            </div>
                            @endif
                            <div class="button-area">
                                <a href="{{route('home')}}" class="continue">Tiếp tục mua hàng</a>
                                <a href="{{route('cart.checkout')}}" style="display: none" class="checkout">Tiến hành thanh toán</a>
                            </div>
                        </div>
                        <!-- Coupon /- -->
                    </form>
                    <!-- Billing -->
                    <div class="calculation u-s-m-b-60">
                        <div class="table-wrapper-2">
                            <table>
                                <thead>
                                <tr>
                                    <th colspan="2">Tổng giỏ hàng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <h3 class="calc-h3 u-s-m-b-0">Tổng tiền</h3>
                                    </td>
                                    <td>
                                        <span class="calc-text calc-text-total"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h3 class="calc-h3 u-s-m-b-0" id="tax-heading">Phí giao hàng</h3>
                                        <span>(Mặc định)</span>
                                    </td>
                                    <td>
                                        <span class="calc-text">30.000 VND</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3 class="calc-h3 u-s-m-b-0">Tổng đơn hàng</h3>
                                    </td>
                                    <td>
                                        <span class="calc-text calc-text-order"></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Billing /- -->
                </div>
            </div>
        </div>
    </div>
    <!-- Cart-Page /- -->

@endsection




@section('script')
    <script>
            $('.checkout-anchor').show();

        let newItems =[];
        let no =0;
        function clearDataCart(item){
            const localItems =  JSON.parse(localStorage.getItem('items'));
              $id =  item.getAttribute('data-value');
              newItems.forEach((val,index)=>{
                  console.log(val);
                     if(parseInt($id) === val.id){
                         no = val.no;
                     }
              })
            localItems.map(data=>{
                if(data.id === parseInt($id)){
                    data.no = no;
                }
            });
           localStorage.setItem('items',JSON.stringify(localItems));
            window.location.reload();
        }
        window.onload = function() {
            if (localStorage.getItem("items") !== null &&  JSON.parse(localStorage.getItem('items')).length >0 ) {
                $('.coupon-area').show();
                   $('.checkout').show();
            }

            // adding data to shopping cart
            const iconShoppingP = document.querySelector('#mini-cart-trigger span');
            const totalPrice = document.querySelector('#mini-cart-trigger').children[2];
            let no = 0;
            let priceTotal =0;
            JSON.parse(localStorage.getItem('items')).map(data=>{
                newItems.push(data);
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
                //adding cartbox data in table
            const cartBox = document.querySelector('.table-wrapper');
            const cardBoxTable = cartBox.querySelector('tbody');
            let tableData = '';
            if(JSON.parse(localStorage.getItem('items'))[0] === null){
                tableData += '<tr><td colspan="5">No items found</td></tr>'
            }else{
                JSON.parse(localStorage.getItem('items')).map(data=>{
                    tableData += '<tr>'+
                        '<td>'+
                            '<div class="cart-anchor-image">'+
                                '<a href="single-product.html">'+
                                    '<img src="'+data.img+'" alt="Product">'+
                                        '<h6>'+data.name+'</h6>'+
                                '</a>'+
                            '</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="cart-price cart-price-single">'+
                                  data.price.toFixed(3)
                            +' đ</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="cart-quantity">'+
                                '<div class="quantity">'+
                                    '<input data-value="'+data.id+'" onkeypress="javascript:return isNumber(event)" type="text" class="quantity-text-field" value="'+data.no+'">'+
                                        '<a class="plus-a" data-max="1000">&#43;</a>'+
                                        '<a class="minus-a" data-min="1">&#45;</a>'+
                                '</div>'+
                            '</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="cart-price cart-price-total">'+
                        (data.price * data.no).toFixed(3)
                            +' đ</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="action-wrapper">'+
                                '<button type="button" onclick="clearDataCart(this)" data-value="'+data.id+'" class="button button-outline-secondary fas fa-sync"></button>'+
                                '<button onclick="deleteCart(this)" data-value="'+data.id+'" class="button button-outline-secondary fas fa-trash"></button>'+
                            '</div>'+
                        '</td>'+
                    '</tr>'  ;
                });
            }
            cardBoxTable.innerHTML = tableData;

            $(document).ready(function (){
                $('.quantity-text-field').on('keyup keypress',function (e){
                    update_amounts();
                })
              //increment quantity
                $(".plus-a").click(function (e){
                    e.preventDefault();

                    var $n =$(this).parent(".quantity").find(".quantity-text-field");
                    $n.val(Number($n.val())+1);
                    update_amounts();
                })
                //decrement quantity
                $(".minus-a").click(function (e){
                    e.preventDefault();
                    var $n =$(this).parent(".quantity").find(".quantity-text-field");
                    $n.val(Number($n.val())-1);
                    update_amounts();
                })

            });

        }
        function deleteCart(item){
            let items =[];
           const id = item.getAttribute('data-value');
              JSON.parse(localStorage.getItem('items')).map(data=>{
                  if(data.id != id){
                       items.push(data);
                  }
              });
              localStorage.setItem('items',JSON.stringify(items));
              window.location.reload();

        }


        function update_amounts(){
            var sum =0;
         var countQuantity =0;
            $('.table-cart > tbody >tr').each(function (){
                var quantity =$(this).find('.quantity-text-field').val();
                var id = $(this).find('.quantity-text-field').attr('data-value');
                countQuantity = countQuantity +parseInt(quantity);
                var price = $(this).find('.cart-price-single').text().split('đ').join(' ');
                     var amount = (Number(price)*parseInt(quantity));

                var value = (amount).toLocaleString(
                    undefined,
                    { minimumFractionDigits: 3}
                );
                $(this).find('.cart-price-total').text(value + ' đ');
                var regex = /[.,\s]/g;
                sum+= Number(value.replace(regex, ''));

                var formatDigit = ( parseFloat(sum).toLocaleString(
                    undefined,
                    { minimumFractionDigits: 0 }
                ));
                var formatDigitTotal = ( parseFloat(sum+ 30000).toLocaleString(
                    undefined,
                    { minimumFractionDigits: 0 }
                ));
                $('.calc-text-order').text(formatDigitTotal + ' VND');
                $('.calc-text-total').text(formatDigit + ' VND');

                 const localItems =  JSON.parse(localStorage.getItem('items'));
                 console.log(id);
                 localItems.map(data=>{
                     if(data.id === parseInt(id)){
                        data.no = parseInt(quantity);
                     }

                 });
              localStorage.setItem('items', JSON.stringify(localItems));
                const iconShoppingP = document.querySelector('#mini-cart-trigger span');
                const totalPrice = document.querySelector('#mini-cart-trigger').children[2];
                iconShoppingP.innerHTML =countQuantity;
                totalPrice.innerHTML =formatDigit + ' VND';
            });
            $('.mini-cart-list').text("");
            JSON.parse(localStorage.getItem('items')).map(data=>{
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
        }



    </script>
@endsection

