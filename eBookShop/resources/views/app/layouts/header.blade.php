
<header>
    <!-- Top-Header -->
    <div class="full-layer-outer-header">
        <div class="container clearfix">
            <nav>
                <ul class="primary-nav g-nav">
                    <li>
                        <a href="tel:+111444989">
                            <i class="fas fa-phone u-c-brand u-s-m-r-9"></i>
                            Telephone:+111-444-989</a>
                    </li>
                    <li>
                        <a href="mailto:contact@domain.com">
                            <i class="fas fa-envelope u-c-brand u-s-m-r-9"></i>
                            E-mail: tuannmctk42@gmail.com
                        </a>
                    </li>
                </ul>
            </nav>
            <nav>
                <ul class="secondary-nav g-nav">
                    <li>
                        <a>Tài khoản
                            <i class="fas fa-chevron-down u-s-m-l-9"></i>
                        </a>
                        <ul class="g-dropdown" style="width:200px">
                            <li>
                                @if(Auth::check())
                                <a href="{{route('account',Auth::user()->id)}}">
                                    <i class="fas fa-cog u-s-m-r-9"></i>
                                    Thông tin tài khoản</a>
                                    @endif
                            </li>
                            <li>
                                <a href="{{route('cart')}}">
                                    <i class="fas fa-cog u-s-m-r-9"></i>
                                    Giỏ hàng</a>
                            </li>
                            <li>
                                <a href="{{route('cart.wishList')}}">
                                    <i class="far fa-heart u-s-m-r-9"></i>
                                    Danh sách yêu thichs</a>
                            </li>
                            @if(Auth::check())
                            <li>
                                <a href="{{route('cart.salesOrder',Auth::user()->id)}}">
                                    <i class="far fa-check-circle u-s-m-r-9"></i>
                                    Đơn hàng</a>
                            </li>
                            @endif
                            <li>
                                @if(Auth::check())
                                <a href="{{route('logout')}}"  onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                    Đăng xuất</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @else
                                    <a href="{{route('login')}}">
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        Đăng nhập</a>
                                    @endif
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- Top-Header /- -->
    <!-- Mid-Header -->
    <div class="full-layer-mid-header">
        <div class="container">
            <div class="row clearfix align-items-center">
                <div class="col-lg-3 col-md-9 col-sm-6">
                    <div class="brand-logo text-lg-center">
                       <a href="{{route('home')}}">
                            <img src="{{asset('assets/webApp/images/main-logo/groover-branding-1.png')}}" alt="Groover Brand Logo" class="app-brand-logo">
                       </a>
                    </div>
                </div>
                <div class="col-lg-6 u-d-none-lg">
                    {!! Form::open(['method' => 'POST' ,'class'=>'form-searchbox' ,'route' => ['home.findProduct']]) !!}

                        <label class="sr-only" for="search-landscape">Tìm kiếm</label>
                        <input id="search-landscape" name="name" type="text" class="text-field" placeholder="Tìm kiếm sản phẩm">
                        <div class="select-box-position">
                            <div class="select-box-wrapper select-hide">
                                <label class="sr-only" for="select-category">Choose category for search</label>
                                <select name="category" class="select-box" id="select-category">
                                    <option  selected="selected" value="0">
                                        All
                                    </option>
                                    @foreach($products->getListCategory() as $item)
                                        <option value="{{$item->getId()}}">{{$item->getName()}}</option>
                                        @foreach($item->getChilds() as $child)
                                            <option value="{{$child->getId()}}">{{$child->getName()}}</option>
                                        @endforeach
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <button id="btn-search" type="submit" class="button button-primary fas fa-search"></button>
                    {!! Form::close() !!}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <nav>
                        <ul class="mid-nav g-nav">
                            <li class="u-d-none-lg">
                                <a href="{{route('home')}}">
                                    <i class="ion ion-md-home u-c-brand"></i>
                                </a>
                            </li>
                            <li class="u-d-none-lg">
                                <a href="{{route('cart.wishList')}}">
                                    <i class="far fa-heart"></i>
                                </a>
                            </li>
                            <li>
                                <a id="mini-cart-trigger">
                                    <i class="ion ion-md-basket"></i>
                                    <span class="item-counter">0</span>
                                    <span class="item-price"></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Mid-Header /- -->
    <!-- Responsive-Buttons -->
    <div class="fixed-responsive-container">
        <div class="fixed-responsive-wrapper">
            <button type="button" class="button fas fa-search" id="responsive-search"></button>
        </div>
        <div class="fixed-responsive-wrapper">
            <a href="{{route('cart.wishList')}}">
                <i class="far fa-heart"></i>
                <span class="fixed-item-counter">4</span>
            </a>
        </div>
    </div>
    <!-- Responsive-Buttons /- -->
    <!-- Mini Cart -->
    <div class="mini-cart-wrapper">
        <div class="mini-cart">
            <div class="mini-cart-header">
                Giỏ hàng của bạn
                <button type="button" class="button ion ion-md-close" id="mini-cart-close"></button>
            </div>
            <ul class="mini-cart-list">

            </ul>
            <div class="mini-shop-total clearfix">
                <span class="mini-total-heading float-left">Total:</span>
                <span class="mini-total-price float-right"></span>
            </div>
            <div class="mini-action-anchors">

                <a style="display:none;" href="{{route('cart')}}" class="cart-anchor">Xem giỏ hàng</a>


                <a  style="display:none;" href="{{route('cart.checkout')}}" class="checkout-anchor">Thanh toán</a>

            </div>
        </div>
    </div>
    <!-- Mini Cart /- -->
    <!-- Bottom-Header -->
    <div class="full-layer-bottom-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="v-menu">
                            <span class="v-title">
                                <i class="ion ion-md-menu"></i>
                                 Tất cả danh mục
                                <i class="fas fa-angle-down"></i>
                            </span>
                        <nav>
                            <div class="v-wrapper">
                                <ul class="v-list animated fadeIn">

                                    <li class="js-backdrop">
                                        <a
                                            href='#'>
                                            <i class="ion ion-md-shirt"></i>
                                                  Sách
                                            <i class="ion ion-ios-arrow-forward"></i>
                                        </a>
                                        <button class="v-button ion ion-md-add"></button>
                                        <div class="v-drop-right" style="width: 700px;">
                                            <div class="row">
                                                @foreach($products->getListCategory() as $item)
                                                <div class="col-lg-4">
                                                    <ul class="v-level-2">

                                                        <li>
                                                            <a data-value="{{$item->getId()}}"
                                                               href='http://127.0.0.1:8000/product/{{$item->getTitleSlug()}}/{{$item->getId()}}'>

                                                                {{$item->getName()}}
                                                            </a>
                                                            <ul>
                                                                @foreach($item->getChilds() as $child)
                                                                <li>
                                                                    <a data-value="{{$child->getId()}}"
                                                                       href='http://127.0.0.1:8000/product/{{$child->getTitleSlug()}}/{{$child->getId()}}'>

                                                                        {{$child->getName()}}
                                                                    </a>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>

                                                    </ul>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-9">
                    <ul class="bottom-nav g-nav u-d-none-lg">
                        <li>
                            <a href="{{route('home.productNew')}}">Sách mới
                                <span class="superscript-label-new">NEW</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('home.productHot')}}">Sách bán chạy
                                <span class="superscript-label-hot">HOT</span>
                            </a>
                        </li>

                        <li class="mega-position">
                            <a>Pages
                                <i class="fas fa-chevron-down u-s-m-l-9"></i>
                            </a>
                            <div class="mega-menu mega-3-colm">
                                <ul>
                                    <li class="menu-title">Home & Static Pages</li>
                                    <li>
                                        <a href="home.html" class="u-c-brand">Home</a>
                                    </li>
                                    <li>
                                        <a href="about.html">About</a>
                                    </li>
                                    <li>
                                        <a href="contact.html">Contact</a>
                                    </li>
                                    <li>
                                        <a href="faq.html">FAQ</a>
                                    </li>
                                    <li>
                                        <a href="store-directory.html">Store Directory</a>
                                    </li>
                                    <li>
                                        <a href="terms-and-conditions.html">Terms & Conditions</a>
                                    </li>
                                    <li>
                                        <a href="404.html">404</a>
                                    </li>
                                    <li class="menu-title">Single Product Page</li>
                                    <li>
                                        <a href="single-product.html">Single Product Fullwidth</a>
                                    </li>
                                    <li class="menu-title">Blog</li>
                                    <li>
                                        <a href="blog.html">Blog Page</a>
                                    </li>
                                    <li>
                                        <a href="blog-detail.html">Blog Details</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="menu-title">Ecommerce Pages</li>
                                    <li>
                                        <a href="shop-v2-sub-category.html">Shop</a>
                                    </li>
                                    <li>
                                        <a href="cart.html">Cart</a>
                                    </li>
                                    <li>
                                        <a href="checkout.html">Checkout</a>
                                    </li>
                                    <li>
                                        <a href="account.html">My Account</a>
                                    </li>
                                    <li>
                                        <a href="wishlist.html">Wishlist</a>
                                    </li>
                                    <li>
                                        <a href="track-order.html">Track your Order</a>
                                    </li>
                                    <li class="menu-title">Cart Variations</li>
                                    <li>
                                        <a href="cart-empty.html">Cart Ver 1 Empty</a>
                                    </li>
                                    <li>
                                        <a href="cart.html">Cart Ver 2 Full</a>
                                    </li>
                                    <li class="menu-title">Wishlist Variations</li>
                                    <li>
                                        <a href="wishlist-empty.html">Wishlist Ver 1 Empty</a>
                                    </li>
                                    <li>
                                        <a href="wishlist.html">Wishlist Ver 2 Full</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="menu-title">Shop Variations</li>
                                    <li>
                                        <a href="shop-v1-root-category.html">Shop Ver 1 Root Category</a>
                                    </li>
                                    <li>
                                        <a href="shop-v2-sub-category.html">Shop Ver 2 Sub Category</a>
                                    </li>
                                    <li>
                                        <a href="shop-v3-sub-sub-category.html">Shop Ver 3 Sub Sub Category</a>
                                    </li>
                                    <li>
                                        <a href="shop-v4-filter-as-category.html">Shop Ver 4 Filter as Category</a>
                                    </li>
                                    <li>
                                        <a href="shop-v5-product-not-found.html">Shop Ver 5 Product Not Found</a>
                                    </li>
                                    <li>
                                        <a href="shop-v6-search-results.html">Shop Ver 6 Search Results</a>
                                    </li>
                                    <li class="menu-title">My Account Variation</li>
                                    <li>
                                        <a href="lost-password.html">Lost Your Password ?</a>
                                    </li>
                                    <li class="menu-title">Checkout Variation</li>
                                    <li>
                                        <a href="confirmation.html">Checkout Confirmation</a>
                                    </li>
                                    <li class="menu-title">Custom Deals Page</li>
                                    <li>
                                        <a href="custom-deal-page.html">Custom Deal Page</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="{{route('home.productSale')}}">Giảm giá
                                <span class="superscript-label-discount">sale</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom-Header /- -->
</header>

