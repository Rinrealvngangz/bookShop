@extends('app.home')
@section('pageWrapper')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Danh sách yêu thích</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="{{route('cart.wishList')}}">Danh sách yêu thích</a>
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
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Tình trạng</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
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

            //adding cartbox data in table
            const cartBox = document.querySelector('.table-wrapper');
            const cardBoxTable = cartBox.querySelector('tbody');
            let tableData = '';
            if(JSON.parse(localStorage.getItem('wishlist'))[0] === null){
                tableData += '<tr><td colspan="5">No items found</td></tr>'
            }else{
                JSON.parse(localStorage.getItem('wishlist')).map(data=>{
                    tableData += '<tr>'+
                        '<td>'+
                        '<div class="cart-anchor-image">'+
                        '<a href="http://127.0.0.1:8000/home/'+data.name+'/'+data.id+'">'+
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
                        '<div class="cart-stock">Còn hàng'+
                        '</td>'+
                        '<td>'+
                        '<div class="action-wrapper">'+
                        '<button onclick="addToCart(this)" data-value="'+data.id+'" class="button button-outline-secondary">Thêm vào giỏ hàng</button>'+
                        '<button onclick="deleteCart(this)" data-value="'+data.id+'" class="button button-outline-secondary fas fa-trash"></button>'+
                        '</div>'+
                        '</td>'+
                        '</tr>';

                });
                cardBoxTable.innerHTML = tableData;
            }

        }
        function deleteCart(item){
            let items =[];
            const id = item.getAttribute('data-value');
            JSON.parse(localStorage.getItem('wishlist')).map(data=>{
                if(data.id != id){
                    items.push(data);
                }
            });
            localStorage.setItem('wishlist',JSON.stringify(items));
            window.location.reload();

        }
        function setLocalStorage(id,name,price,img,quantity,items){
            if(typeof(Storage) !== 'undefined'){

                let item = {
                    id:parseInt(id),
                    name: name,
                    price:parseFloat(price),
                    img :img,
                    no: parseInt(quantity)
                };
                if(JSON.parse(localStorage.getItem('items')) === null){
                    items.push(item);
                    localStorage.setItem("items",JSON.stringify(items));
                    window.location.reload();
                }else{
                    const localItems = JSON.parse(localStorage.getItem("items"));
                    localItems.map(data=>{
                        if(item.id === parseInt(data.id)){
                            item.no = parseInt(data.no) + Number(quantity);

                        }else{
                            items.push(data);
                        }
                    });
                    items.push(item);
                    localStorage.setItem('items',JSON.stringify(items));
                    window.location.reload();
                }

            }else{
                alert('local storage is not working on your browser');
            }

        }

        function addToCart(item){
            var id =item.getAttribute('data-value');
            let items = [];

            JSON.parse(localStorage.getItem('wishlist')).map(data=>{
                if(data.id === parseInt(id)){
                    setLocalStorage(id,data.name,data.price,data.img,1,items);
                }
            });

            // adding data to shopping cart
            const iconShoppingP = document.querySelector('#mini-cart-trigger span');
            const totalPrice = document.querySelector('#mini-cart-trigger').children[2];
            let no = 0;
            let priceTotal =0;
            JSON.parse(localStorage.getItem('items')).map(data=>{
                no = no+ parseInt(data.no);
                priceTotal = priceTotal +(parseInt(data.no) * data.price);
            });
            var formatPrice =(priceTotal).toLocaleString(
                undefined,
                { minimumFractionDigits: 3 }
            );
            iconShoppingP.innerHTML = no;
            totalPrice.innerHTML =formatPrice + "VND";
        }
    </script>
@endsection
