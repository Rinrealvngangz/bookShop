@extends('app.home')

@section('pageWrapper')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Detail</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="http://127.0.0.1:8000/product/{{$product->getpathName()}}/{{$product->getpathId()}}">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
@endsection
@section('content')
    <!-- Shop-Page -->
    <div class="page-shop u-s-p-t-80">
        <div class="container">
            <!-- Shop-Intro -->
            <div class="shop-intro">
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li class="has-separator">
                        <a href="javascript:void(0)">Sản phẩm</a>
                    </li>
                    <li class="is-marked">
                        <a href="http://127.0.0.1:8000/product/{{$product->getpathName()}}/{{$product->getpathId()}}">{{$product->getNameCategory()}}</a>

                    </li>
                </ul>
            </div>
            <!-- Shop-Intro /- -->
            <div class="row">
                <!-- Shop-Left-Side-Bar-Wrapper -->
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <!-- Fetch-Categories-from-Root-Category  -->
                    <div class="fetch-categories">
                        <h3 class="title-name">Danh mục</h3>
                        <h3 class="fetch-mark-category">
                            <a  id="category" data-name="{{$product->getListCategory()[0]->getTitleSlug()}}" data-value="{{$product->getListCategory()[0]->getId()}}"
                                href='http://127.0.0.1:8000/product/{{$product->getListCategory()[0]->getTitleSlug()}}/{{$product->getListCategory()[0]->getId()}}'>{{$product->getListCategory()[0]->getName()}}
                                <span class="total-fetch-items"></span>
                            </a>
                        </h3>
                        <!-- Level 3 -->
                        <ul>
                            @for($i =0 ; $i < count($product->getListCategory()[0]->getChilds()); $i++ )
                            <li>
                                <a  id="category" data-name="{{$product->getListCategory()[0]->getChilds()[$i]->getTitleSlug()}}" data-value="{{$product->getListCategory()[0]->getChilds()[$i]->getId()}}"
                                    href='http://127.0.0.1:8000/product/{{$product->getListCategory()[0]->getTitleSlug()}}/{{$product->getListCategory()[0]->getId()}}/{{$product->getListCategory()[0]->getChilds()[$i]->getTitleSlug()}}/{{$product->getListCategory()[0]->getChilds()[$i]->getId()}}'>{{$product->getListCategory()[0]->getChilds()[$i]->getName()}}
                                    <span class="total-fetch-items"></span>
                                </a>
                            </li>
                            @endfor
                        </ul>
                        <!-- //end Level 3 -->
                    </div>
                    <!-- Fetch-Categories-from-Root-Category  /- -->
                    <!-- Filters -->
                    <!-- Filters /- -->
                </div>
                <!-- Shop-Left-Side-Bar-Wrapper /- -->
                <!-- Shop-Right-Wrapper -->
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <!-- Page-Bar -->
                    <div class="page-bar clearfix">
                        <div class="shop-settings">
                            <a id="grid-anchor">
                                <i class="fas fa-th"></i>
                            </a>
                        </div>
                        <!-- Toolbar Sorter 1  -->
                        <div class="toolbar-sorter">
                            <div class="select-box-wrapper">
                                <label class="sr-only" for="sort-by">Sắp xếp</label>
                                <select class="select-box" id="sort-by">
                                    <option value="" selected="selected">Sắp xếp:</option>
                                    <option value="{{route('home.product',['category'=>$product->getpathName(),'id'=>$product->getpathId(),'sortname'=>'ten-tang'])}}">Sắp xếp: tăng theo tên</option>
                                    <option value="{{route('home.product',['category'=>$product->getpathName(),'id'=>$product->getpathId(),'sortname'=>'ten-giam'])}}">Sắp xếp: giảm theo tên</option>
                                    <option value="{{route('home.product',['category'=>$product->getpathName(),'id'=>$product->getpathId(),'sort'=>'gia-cao'])}}">Sắp xếp: giá cao</option>
                                    <option value="{{route('home.product',['category'=>$product->getpathName(),'id'=>$product->getpathId(),'sort'=>'gia-thap'])}}">Sắp xếp: giá thấp</option>
                                    <option value="{{route('home.product',['category'=>$product->getpathName(),'id'=>$product->getpathId(),'sortFormality'=>'biaMem'])}}">Sắp xếp: bìa mềm</option>
                                    <option value="{{route('home.product',['category'=>$product->getpathName(),'id'=>$product->getpathId(),'sortFormality'=>'biaCung'])}}">Sắp xếp: bìa cứng</option>
                                </select>
                            </div>
                        </div>
                        <!-- //end Toolbar Sorter 1  -->
                        <!-- Toolbar Sorter 2  -->
                        <div class="toolbar-sorter-2">
                            <div class="select-box-wrapper">
                                <label class="sr-only" for="show-records">Show Records Per Page</label>
                                <select class="select-box" id="show-records">
                                    <option value="" selected="selected">Hiển thị:</option>
                                    <option value="show=2">Hiển thị: 2</option>
                                    <option value="show=5">Hiển thị: 5</option>
                                    <option value="show=25">Hiển thị: 25</option>
                                </select>
                            </div>
                        </div>
                        <!-- //end Toolbar Sorter 2  -->
                    </div>
                    <!-- Page-Bar /- -->
                    <!-- Row-of-Product-Container -->
                    <div class="row product-container grid-style">
                        @if(count($product->getListBook()))
                            @foreach($product->getListBook() as $item)
                        <div class="product-item col-lg-4 col-md-6 col-sm-6">
                            <div class="item">
                                <div class="image-container">
                                    <a class="item-img-wrapper-link" href="{{route('home.productDetail',[$item->getTitle(),$item->getId()])}}">
                                        <img class="img-fluid" src="{{$item->getImages()}}" alt="Product">
                                    </a>
                                    <div class="item-action-behaviors">
                                        <a class="item-quick-look" data-TitleSlug="{{$item->getCategorySlug()}}" data-ParentTitleSlug="{{$product->getListCategory()[0]->getTitleSlug()}}" data-parentCate="{{$product->getListCategory()[0]->getName()}}" data-IdParentCate="{{$product->getListCategory()[0]->getId()}}"   data-nameCategory="{{$item->getCategory()}}" data-categoryId="{{$item->getIdCategory()}}" data-id="{{$item->getId()}}" data-value="{{$item->getTitle()}}" onclick="setValueQuickView(this)" data-toggle="modal" href="#quick-view">Quick Look</a>
                                        <a data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}" class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                        <a data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}" class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <div class="what-product-is">
                                        <ul class="bread-crumb">
                                            <li class="has-separator">
                                                <a href="javascript:void(0)">Sản phẩm</a>
                                            </li>
                                             @if($product->getpathId() === $product->getListCategory()[0]->getId())
                                            <li class="is-marked">
                                                <a href="http://127.0.0.1:8000/product/{{$product->getpathName()}}/{{$product->getpathId()}}">
                                                    {{$product->getNameCategory()}}</a>
                                            </li>
                                            @else
                                                <li class="has-separator">
                                                    <a href="http://127.0.0.1:8000/product/{{$product->getListCategory()[0]->getTitleSlug()}}/{{$product->getListCategory()[0]->getId()}}">
                                                        {{$product->getListCategory()[0]->getName()}}</a>
                                                </li>
                                                <li class="is-marked">
                                                    <a  href="http://127.0.0.1:8000/product/{{$product->getpathName()}}/{{$product->getpathId()}}">
                                                        {{$product->getNameCategory()}}</a>
                                                </li>
                                                 @endif
                                        </ul>
                                        <h6 class="item-title">
                                            <a href="{{route('home.productDetail',[$item->getTitle(),$item->getId()])}}">
                                                {{$item->getTitle()}}
                                            </a>
                                        </h6>
                                        <div class="item-stars">
                                            <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                @if(array_key_exists(0,$item->getReviewBest()))
                                                    @if((int)$item->getReviewBest()[0] >= 72)
                                                        <span style='width:71px'></span>
                                                    @else
                                                        <span style='width:{{(int)$item->getReviewBest()[0]}}px'></span>
                                                    @endif
                                                @else
                                                    <span style='width:0px'></span>
                                                @endif
                                            </div>
                                            <span>({{$item->getReviewNumberStar()}})</span>
                                        </div>
                                    </div>
                                    <div class="price-template">
                                        <div class="item-new-price">
                                            {{$item->getPrice()}} đ
                                        </div>
                                        @if( !round ($item->getPercentDiscount() * 100 / 100) == 0 && $item->getPercentDiscount() !== null)
                                            <div class="item-old-price">
                                                {{$item->getOriginalPrice()}} đ
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if( !round ($item->getPercentDiscount() * 100 / 100) == 0 && $item->getPercentDiscount() !== null)
                                    <div class="tag sale">
                                        <span>Sale</span>
                                    </div>

                                @else
                                    <div class="tag new">
                                        <span>New</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                            @endforeach

                        @else
                            <div class="content-404">
                                <p>Sản phẩm không có</p>
                            </div>
                        @endif
                    </div>
                    <!-- Row-of-Product-Container /- -->
                </div>
                <!-- Shop-Right-Wrapper /- -->
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $('#sort-by').change(function (){
            var currentUrl =window.location.href;
              let queryRecord;
            if(currentUrl.includes('&') && currentUrl.includes('?')){
                queryRecord  =  currentUrl.split('&')[1];
                document.location.href = $(this).val()+'&' +queryRecord;
            }else if ( currentUrl.includes('?') && currentUrl.includes('show')){
                 queryRecord = currentUrl.split('?')[1];
                document.location.href = $(this).val()+'&' +queryRecord;
            }
            else{
                  document.location.href = $(this).val();
            }
        })
        $('#show-records').change(function (){
            var currentUrl =window.location.href;
            let query;
            var record =$(this).val();
            var urlOrigin =  currentUrl.split('?')[0];
            var urlOriginWithSort =  currentUrl.split('&')[0];
            if(currentUrl.includes('show') && currentUrl.includes('?')){
                    query =urlOrigin +'?'+record;
            }else if(currentUrl.includes('?')){
                query =currentUrl+'&'+record;
            }else if(currentUrl.includes('&') && currentUrl.includes('?')){
                  query =urlOriginWithSort+'&'+record;
            }else{
                query = currentUrl +'?' +record;

            }
             document.location.href =query;

        })
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
        function setLocalStorageWishlist(id,name,price,img,wishlist){
            if(typeof(Storage) !== 'undefined'){

                let item = {
                    id:parseInt(id),
                    name: name,
                    price:parseFloat(price),
                    img :img,
                };
                if(JSON.parse(localStorage.getItem('wishlist')) === null){
                    wishlist.push(item);
                    localStorage.setItem("wishlist",JSON.stringify(wishlist));
                    window.location.reload();
                }else{
                    const localItems = JSON.parse(localStorage.getItem("wishlist"));
                    localItems.map(data=>{
                        if(item.id !== parseInt(data.id)) {
                            wishlist.push(data);

                        }
                    });
                    wishlist.push(item);
                    localStorage.setItem('wishlist',JSON.stringify(wishlist));
                    window.location.reload();
                }

            }else{
                alert('local storage is not working on your browser');
            }

        }
        window.onload = function() {
            if (localStorage.getItem("items") !== null &&  JSON.parse(localStorage.getItem('items')).length >0 ) {
                $('.cart-anchor').show();
                $('.checkout-anchor').show();
            }
            const attToWishListBtn = document.getElementsByClassName('item-addwishlist');
            let wishlist = [];
            for(let i=0; i<attToWishListBtn.length; i++){
                attToWishListBtn[i].addEventListener("click",function(e){
                    e.preventDefault();
                    var id =this.getAttribute('data-value').split(',')[0];
                    var name =this.getAttribute('data-value').split(',')[1];
                    var price =this.getAttribute('data-value').split(',')[2];
                    var img =e.target.parentElement.parentElement.children[0].getElementsByTagName("img")[0].getAttribute("src");
                    setLocalStorageWishlist(id,name,price,img,wishlist);
                });
            }
            // adding data to localstorage
            const attToCartBtn = document.getElementsByClassName('item-addCart');

            let items = [];
            for(let i=0; i<attToCartBtn.length; i++){
                attToCartBtn[i].addEventListener("click",function(e){
                    e.preventDefault();
                    var id =this.getAttribute('data-value').split(',')[0];
                    var name =this.getAttribute('data-value').split(',')[1];
                    var price =this.getAttribute('data-value').split(',')[2];
                    var img =e.target.parentElement.parentElement.children[0].getElementsByTagName("img")[0].getAttribute("src");
                    setLocalStorage(id,name,price,img,1,items);
                });
            }
            // adding data to shopping cart
            const iconShoppingP = document.querySelector('#mini-cart-trigger span');
            const totalPrice = document.querySelector('#mini-cart-trigger').children[2];
            let no = 0;
            let price = 0;
            $('.mini-cart-list').text("");
            JSON.parse(localStorage.getItem('items')).map(data=>{
                no = no+ data.no;
                price = price + (data.no * data.price);
                var formatPrice =(data.price).toLocaleString(
                    undefined,
                    { minimumFractionDigits: 3 }
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

            if(price !== 0){
                var formatPriceTotal =(price).toLocaleString(
                    undefined,
                    { minimumFractionDigits: 3 }
                );
                totalPrice.innerHTML = formatPriceTotal +" VND";
                iconShoppingP.innerHTML = no;
                $('.mini-total-price').append(formatPriceTotal +" VND");
            }



        }
        function addToWishList(item){
            let items = [];
            var id =item.getAttribute('data-value');
            var price = $('.price h4').text();
            var title = $('.title-book').text();
            var img = $('.img-default').find(".image-book").attr("src");
            setLocalStorageWishlist(id,title,price,img,items);
        }

        function addToCart(item){
            let items = [];
            var id =item.getAttribute('data-value');
            var price = $('.price h4').text();
            var title = $('.title-book').text();
            var quantity = $('.quantity-text-field').val();
            var img = $('.img-default').find(".image-book").attr("src");
            setLocalStorage(id,title,price,img,quantity,items);
            // adding data to shopping cart
            const iconShoppingP = document.querySelector('#mini-cart-trigger span');
            const totalPrice = document.querySelector('#mini-cart-trigger').children[2];
            console.log(totalPrice);
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
        function setValueQuickView(item){
            $id= item.getAttribute('data-id');
            $title = item.getAttribute('data-value');
            var categoryId = item.getAttribute('data-categoryId');
            var nameCategory = item.getAttribute('data-nameCategory');
            var parentCategoryId = item.getAttribute('data-IdParentCate');
            var parentCategory = item.getAttribute('data-parentCate');
            var titleParentSlug = item.getAttribute('data-ParentTitleSlug');
            var titleSlug = item.getAttribute('data-titleSlug');
            $.ajax({
                method :"GET",
                url: '/home/'+$title + '/'+$id,
                contentType: "application/json",
                dataType: "json",
                success: function(data) {
                    clearDataBookDetail();
                    $('.btn-addToCart-Modal').attr("data-value", $id);
                    $('.btn-addToWishList-Modal').attr("data-value", $id);
                    $('.description-book').append(data[0]);
                    $('.price h4').append(data[1] + "đ");
                    if(data[6].localeCompare("Hard Cover")){
                        $('.formality').append("Bìa cứng");
                    }else {
                        $('.formality').append("Bìa mềm");
                    }
                    $patchTitle ='<h1>'+
                        '<a class="title-book" href="http://127.0.0.1:8000/home/'+data[2]+'/'+$id+'">'+data[2]+'</a>'+
                        '</h1>';
                    $('.product-title').append($patchTitle);
                    $('.book-author').append(data[7]);
                    $('.book-publisher').append(data[8]);
                      var htmlRoot ;
                    if(parseInt(categoryId) === parseInt(parentCategoryId)){
                          htmlRoot ='<li class="has-separator">'+
                            '<a href="http://127.0.0.1:8000/home">Trang chủ</a>'+
                    '</li>'+
                    '<li class="is-marked">'+
                    '<a href="http://127.0.0.1:8000/product/'+titleParentSlug+'/'+parentCategoryId+'">'+nameCategory+'</a>'+
                    '</li>';
                    }else{
                        htmlRoot ='<li class="has-separator">'+
                            '<a href="http://127.0.0.1:8000/home">Trang chủ</a>'+
                            '</li>'+
                            '<li class="has-separator">'+
                            '<a href="http://127.0.0.1:8000/product/'+titleParentSlug+'/'+parentCategoryId+'">'+parentCategory+'</a>'+
                            '</li>'+
                        '<li class="is-marked">'+
                        '<a class="category-root category-root-modal" href="http://127.0.0.1:8000/product/'+titleParentSlug+'/'+parentCategoryId+'/'+titleSlug+'/'+categoryId+'">'+nameCategory+'</a>'+
                        '</li>';
                    }
                    $('.bread-crumb-modal').append(htmlRoot);
                    var $img;
                    $img = '<img id="zoom-pro-quick-view" class="img-fluid" src="'+data[9][0]+'" data-zoom-image="'+data[9][0]+'" alt="Zoom Image">';
                    $imgZoom =  '<div id="gallery-quick-view" class="u-s-m-t-10">';
                    $img +=$imgZoom;
                    for (var i = 0; i < data[9].length; i++) {
                        var $html;
                        if(i===0){

                            $html =  '<a id="img-book" onclick="active(this)" class="active img-default" data-image="'+data[9][0]+'" data-zoom-image="'+data[9][0]+'">'+
                                '<img class="image-book"  src="'+data[9][0]+'" alt="Product">'+
                                '</a>';
                            $img +=$html;
                        }else{
                            $html =   '<a id="img-book" onclick="active(this)"  data-image="'+data[9][i]+'" data-zoom-image="'+data[9][i]+'">'+
                                '<img  src="'+data[9][i]+'" alt="Product">'+
                                '</a>';
                            $img +=$html;
                        }
                    }
                    $img += '</div>';
                    $('.zoom-area').append($img);

                    if(Math.round(parseInt(data[5])) !== 0 && data[5] !== null){
                        $('.original-price').append('<span> Giá gốc : </span>' );
                        $('.original-price').append( '<span>'+ data[4] + '</span>');
                        $('.discount-price').append('<span> Giảm giá : </span>' );
                        $('.discount-price').append( Math.round(parseInt(data[5])) + '%');
                    }
                }
            });
        }
        function clearDataBookDetail(){
            $('.description-book').text("");
            $('.price h4').text("");
            $('.original-price').text("");
            $('.discount-price').text("");
            $('.formality').text("");
            $('.book-author').text("");
            $('.book-publisher').text("");
            $('.book-publisher').text("");
            $('.zoom-area').text("");
            $('.category-root').text("");
            $('.product-title').text("");
            $('.bread-crumb-modal').text("");
        }
        function active(item){
            $('.zoom-area').find('.active').removeClass("active");
            $src = item.childNodes[0].getAttribute('src');
            $(item).addClass('active');
            $('#zoom-pro-quick-view').attr('src',$src);
        }


        function removeVietnameseTones(str) {
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
            str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
            str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
            str = str.replace(/đ/g,"d");
            str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
            str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
            str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
            str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
            str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
            str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
            str = str.replace(/Đ/g, "D");
            // Some system encode vietnamese combining accent as individual utf-8 characters
            // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
            str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
            str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
            // Remove extra spaces
            // Bỏ các khoảng trắng liền nhau
            str = str.replace(/ + /g," ");
            str = str.trim();
            // Remove punctuations
            // Bỏ dấu câu, kí tự đặc biệt
            str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
            return str;
        }
        function cleanArray(actual) {
            var newArray = new Array();
            for (var i = 0; i < actual.length; i++) {
                if (actual[i]) {
                    newArray.push(actual[i]);
                }
            }
            return newArray;
        }
        $overlay = $('<div id="overlay"/>').css({
            position: 'fixed',
            display: 'none',
            top: 0,
            left: 0,
            color: '#adbcbf',
            width: '100%',
            height: $(window).height() + 'px',
            opacity: 0.4,
            background: '#f5f6f7 url("/images/Blocks-1s-200px.gif") no-repeat center'
        });

          $('a#category').on('click',function(event) {
              event.preventDefault();
              var href;
              var id =$(this).attr('data-value');
              var name =$(this).attr('data-name');
              var nameSort =$(this).attr('data-sort');
              var type =$(this).attr('data-type');

              if(type === "sort"){
                  href  = '/product/'+name+'/' +id +'?sort=' +nameSort;
              }else if(type === "sortname"){
                  href  = '/product/'+name+'/' +id +'?sortname=' +nameSort;
              }else if(type === "sortFormality"){
                  href  = '/product/'+name+'/' +id +'?sortFormality=' +nameSort;
              }
              else{
                  href  = '/product/'+name+'/' +id;
              }

              $overlay.appendTo("body");
              $('#overlay').show();
              setTimeout(function (){
                  $.ajax({
                      method :"GET",
                      url: href,
                      success: function(data) {
                          $(".features_items").html("");
                          var htmlSidebar ='<h2>Hình Thức</h2>';
                          var html ='<h2 class="title text-center">Mục Sản Phẩm</h2>';
                          if(Array.isArray(data)){
                              html +=data[0];
                              htmlSidebar +=data[1];
                              var htmtSidebarSort =data[2];
                              $(".sort_sidebar").html("");
                              $(".formality_sidebar").html("");
                              $(".formality_sidebar").append(htmlSidebar);
                              $(".sort_sidebar").append(htmtSidebarSort);
                          }else{
                              html =data;
                          }
                          $(".features_items").append(html);

                          $('#overlay').hide();

                          window.history.pushState("", "", href);
                          window.location.reload();
                      }
                  });
              },500);
              return false;
          });


    </script>

@endsection

