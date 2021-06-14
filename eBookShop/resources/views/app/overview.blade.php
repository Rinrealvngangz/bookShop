@extends('app.home')

@section('slider')
    @include('app.layouts.main-slider')
@endsection

@section('banner')
    <div class="banner-layer">
        <div class="container">
            <div class="image-banner">
                <a href="shop-v1-root-category.html" class="mx-auto banner-hover effect-dark-opacity">
                    <img class="img-fluid"   src="{{asset('assets/webApp/images/banners/photo-15720614861d811e12d0a10.jpg')}}"   style=" width: 1340px ;  height: 236px;"   alt="Winter Season Banner">
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
    <div class="sec-maker-header text-center">
        <h3 class="sec-maker-h3">BOOKS</h3>
        <ul class="nav tab-nav-style-1-a justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#book-latest-products">Sản phẩm mới nhất</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#book-best-selling-products">Bán chạy nhất</a>
            </li>

        </ul>
    </div>
        <div class="wrapper-content">
            <div class="outer-area-tab">
                <div class="tab-content">
                    <div class="tab-pane active show fade" id="book-latest-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                      @foreach($products->getListBook() as $item)
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="single-product.html">
                                                <img src="{{$item->getImages()}}" alt="img-{{$item->getTitle()}}">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-parentCate="{{$products->getListCategory()[0]->getName()}}" data-IdParentCate="{{$products->getListCategory()[0]->getId()}}"
                                                   data-TitleSlug="{{$item->getCategorySlug()}}" data-ParentTitleSlug="{{$products->getListCategory()[0]->getTitleSlug()}}"
                                                   data-nameCategory="{{$item->getCategory()}}" data-categoryId="{{$item->getIdCategory()}}" data-id="{{$item->getId()}}" data-value="{{$item->getTitle()}}" onclick="setValueQuickView(this)" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a  data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}"  class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}" class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="avascript:void(0)">Sản phẩm</a>
                                                    </li>
                                                    <li class="is-marked">
                                                        <a class="ids{{$item->getIdCategory()}}" href='http://127.0.0.1:8000/product/{{$item->getCategorySlug()}}/{{$item->getIdCategory()}}'>{{$item->getCategory()}}</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="{{route('home.productDetail',[$item->getTitle(),$item->getId()])}}">{{$item->getTitle()}}</a>
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
                              @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane active show fade" id="book-best-selling-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @if($productsBestSell !== null)
                                @foreach($productsBestSell->getListBook() as $item)
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="single-product.html">
                                                <img src="{{$item->getImages()}}" alt="img-{{$item->getTitle()}}">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-parentCate="{{$products->getListCategory()[0]->getName()}}" data-IdParentCate="{{$products->getListCategory()[0]->getId()}}"
                                                   data-TitleSlug="{{$item->getCategorySlug()}}" data-ParentTitleSlug="{{$products->getListCategory()[0]->getTitleSlug()}}"
                                                   data-nameCategory="{{$item->getCategory()}}" data-categoryId="{{$item->getIdCategory()}}" data-id="{{$item->getId()}}" data-value="{{$item->getTitle()}}" onclick="setValueQuickView(this)" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a  data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}"  class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}" class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="avascript:void(0)">Sản phẩm</a>
                                                    </li>
                                                    <li class="is-marked">
                                                        <a class="ids{{$item->getIdCategory()}}" href='http://127.0.0.1:8000/product/{{$item->getCategorySlug()}}/{{$item->getIdCategory()}}'>{{$item->getCategory()}}</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="{{route('home.productDetail',[$item->getTitle(),$item->getId()])}}">{{$item->getTitle()}}</a>
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
                                            <div class="tag hot ">
                                                <span>Hot</span>
                                            </div>
                                    </div>
                                @endforeach
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Men-Clothing-Timing-Section -->
    <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <span class="sec-maker-span-text">Sách giảm giá</span>
                <h3 class="sec-maker-h3 u-s-m-b-22">FLASH SALE</h3>
                <span class="sec-maker-span-text">Kết thúc</span>
                <!-- Timing-Box -->
                <div class="section-timing-wrapper dynamic">
                    <span class="fictitious-seconds" style="display:none;">18000</span>
                    <div class="section-box-wrapper box-days">
                        <div class="section-box">
                            <span class="section-key">120</span>
                            <span class="section-value">Days</span>
                        </div>
                    </div>
                    <div class="section-box-wrapper box-hrs">
                        <div class="section-box">
                            <span class="section-key">54</span>
                            <span class="section-value">HRS</span>
                        </div>
                    </div>
                    <div class="section-box-wrapper box-mins">
                        <div class="section-box">
                            <span class="section-key">3</span>
                            <span class="section-value">MINS</span>
                        </div>
                    </div>
                    <div class="section-box-wrapper box-secs">
                        <div class="section-box">
                            <span class="section-key">32</span>
                            <span class="section-value">SEC</span>
                        </div>
                    </div>
                </div>
                <!-- Timing-Box /- -->
            </div>
            <!-- Carousel -->
            <div class="slider-fouc">
                <div class="products-slider owl-carousel" data-item="4">
                    @foreach($productsSale->getListBook() as $item)
                        <div class="item">
                            <div class="image-container">
                                <a class="item-img-wrapper-link" href="single-product.html">
                                    <img src="{{$item->getImages()}}" alt="img-{{$item->getTitle()}}">
                                </a>
                                <div class="item-action-behaviors">
                                    <a class="item-quick-look" data-parentCate="{{$products->getListCategory()[0]->getName()}}" data-IdParentCate="{{$products->getListCategory()[0]->getId()}}"
                                       data-TitleSlug="{{$item->getCategorySlug()}}" data-ParentTitleSlug="{{$products->getListCategory()[0]->getTitleSlug()}}"
                                       data-nameCategory="{{$item->getCategory()}}" data-categoryId="{{$item->getIdCategory()}}" data-id="{{$item->getId()}}" data-value="{{$item->getTitle()}}" onclick="setValueQuickView(this)" data-toggle="modal" href="#quick-view">Quick Look
                                    </a>
                                    <a  data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}"  class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                    <a data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}" class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                </div>
                            </div>
                            <div class="item-content">
                                <div class="what-product-is">
                                    <ul class="bread-crumb">
                                        <li class="has-separator">
                                            <a href="avascript:void(0)">Sản phẩm</a>
                                        </li>
                                        <li class="is-marked">
                                            <a class="ids{{$item->getIdCategory()}}" href='http://127.0.0.1:8000/product/{{$item->getCategorySlug()}}/{{$item->getIdCategory()}}'>{{$item->getCategory()}}</a>
                                        </li>
                                    </ul>
                                    <h6 class="item-title">
                                        <a href="{{route('home.productDetail',[$item->getTitle(),$item->getId()])}}">{{$item->getTitle()}}</a>
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
                                <div class="tag sale">
                                    <span>Sale</span>
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Carousel /- -->
        </div>
    </section>

    <div class="banner-layer">
        <div class="container">
            <div class="image-banner">
                <a href="shop-v1-root-category.html" class="mx-auto banner-hover effect-dark-opacity">
                    <img class="img-fluid"   src="{{asset('assets/webApp/images/banners/photo-1511881220587-13b89d1da6b8.jpg')}}"   style=" width: 1340px ;  height: 236px;"   alt="Winter Season Banner">
                </a>
            </div>
        </div>
    </div>

    <!-- Women-Clothing -->
    <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <h3 class="sec-maker-h3">THIẾU NHI</h3>
                <ul class="nav tab-nav-style-1-a justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#thieunhi-latest-products">Thiếu nhi mới nhất</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#manga-best-selling-products">Manga -comic</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#serialManga-top-rating-products">Series Manga</a>
                    </li>
                </ul>
            </div>
            <div class="wrapper-content">
                <div class="outer-area-tab">
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="thieunhi-latest-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    @foreach($productsChildren->getListBook() as $item)
                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="single-product.html">
                                                    <img src="{{$item->getImages()}}" alt="img-{{$item->getTitle()}}">
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-parentCate="{{$products->getListCategory()[0]->getName()}}" data-IdParentCate="{{$products->getListCategory()[0]->getId()}}"
                                                       data-TitleSlug="{{$item->getCategorySlug()}}" data-ParentTitleSlug="{{$products->getListCategory()[0]->getTitleSlug()}}"
                                                       data-nameCategory="{{$item->getCategory()}}" data-categoryId="{{$item->getIdCategory()}}" data-id="{{$item->getId()}}" data-value="{{$item->getTitle()}}" onclick="setValueQuickView(this)" data-toggle="modal" href="#quick-view">Quick Look
                                                    </a>
                                                    <a  data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}"  class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                    <a data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}" class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li class="has-separator">
                                                            <a href="avascript:void(0)">Sản phẩm</a>
                                                        </li>
                                                        <li class="is-marked">
                                                            <a class="ids{{$item->getIdCategory()}}" href='http://127.0.0.1:8000/product/{{$item->getCategorySlug()}}/{{$item->getIdCategory()}}'>{{$item->getCategory()}}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="{{route('home.productDetail',[$item->getTitle(),$item->getId()])}}">{{$item->getTitle()}}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                            @if(array_key_exists(5,$item->getReviewBest()))
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
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="manga-best-selling-products">
                            <!-- Product Not Found -->
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                @foreach($productsManga->getListBook() as $item)
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="single-product.html">
                                                <img src="{{$item->getImages()}}" alt="img-{{$item->getTitle()}}">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-parentCate="{{$products->getListCategory()[0]->getName()}}" data-IdParentCate="{{$products->getListCategory()[0]->getId()}}"
                                                   data-TitleSlug="{{$item->getCategorySlug()}}" data-ParentTitleSlug="{{$products->getListCategory()[0]->getTitleSlug()}}"
                                                   data-nameCategory="{{$item->getCategory()}}" data-categoryId="{{$item->getIdCategory()}}" data-id="{{$item->getId()}}" data-value="{{$item->getTitle()}}" onclick="setValueQuickView(this)" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a  data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}"  class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}" class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="avascript:void(0)">Sản phẩm</a>
                                                    </li>
                                                    <li class="is-marked">
                                                        <a class="ids{{$item->getIdCategory()}}" href='http://127.0.0.1:8000/product/{{$item->getCategorySlug()}}/{{$item->getIdCategory()}}'>{{$item->getCategory()}}</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="{{route('home.productDetail',[$item->getTitle(),$item->getId()])}}">{{$item->getTitle()}}</a>
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
                                @endforeach
                            </div>
                            </div>
                            <!-- Product Not Found /- -->
                        </div>
                        <div class="tab-pane fade" id="serialManga-top-rating-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    @foreach($productsSeriesManga->getListBook() as $item)
                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="single-product.html">
                                                    <img src="{{$item->getImages()}}" alt="img-{{$item->getTitle()}}">
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-parentCate="{{$products->getListCategory()[0]->getName()}}" data-IdParentCate="{{$products->getListCategory()[0]->getId()}}"
                                                       data-TitleSlug="{{$item->getCategorySlug()}}" data-ParentTitleSlug="{{$products->getListCategory()[0]->getTitleSlug()}}"
                                                       data-nameCategory="{{$item->getCategory()}}" data-categoryId="{{$item->getIdCategory()}}" data-id="{{$item->getId()}}" data-value="{{$item->getTitle()}}" onclick="setValueQuickView(this)" data-toggle="modal" href="#quick-view">Quick Look
                                                    </a>
                                                    <a  data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}"  class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                    <a data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}" class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li class="has-separator">
                                                            <a href="avascript:void(0)">Sản phẩm</a>
                                                        </li>
                                                        <li class="is-marked">
                                                            <a class="ids{{$item->getIdCategory()}}" href='http://127.0.0.1:8000/product/{{$item->getCategorySlug()}}/{{$item->getIdCategory()}}'>{{$item->getCategory()}}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="{{route('home.productDetail',[$item->getTitle(),$item->getId()])}}">{{$item->getTitle()}}</a>
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
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="women-featured-products">
                            <!-- Product Not Found -->
                            <div class="product-not-found">
                                <div class="not-found">
                                    <h2>SORRY!</h2>
                                    <h6>There is not any product in specific catalogue.</h6>
                                </div>
                            </div>
                            <!-- Product Not Found /- -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="banner-layer">
        <div class="container">
            <div class="image-banner">
                <a href="shop-v1-root-category.html" class="mx-auto banner-hover effect-dark-opacity">
                    <img class="img-fluid"   src="{{asset('assets/webApp/images/banners/photo-1588025681119-4af9a661fec2.jpg')}}"   style=" width: 1340px ;  height: 236px;"   alt="Winter Season Banner">
                </a>
            </div>
        </div>
    </div>
    <!-- Men-Clothing-Timing-Section -->
    <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <span class="sec-maker-span-text">Truyện đọc</span>
                <h3 class="sec-maker-h3 u-s-m-b-22">MANGA</h3>
            </div>
            <!-- Carousel -->
            <div class="slider-fouc">
                <div class="products-slider owl-carousel" data-item="4">
                    @foreach($productsManga->getListBook() as $item)
                        <div class="item">
                            <div class="image-container">
                                <a class="item-img-wrapper-link" href="single-product.html">
                                    <img src="{{$item->getImages()}}" alt="img-{{$item->getTitle()}}">
                                </a>
                                <div class="item-action-behaviors">
                                    <a class="item-quick-look" data-parentCate="{{$products->getListCategory()[0]->getName()}}" data-IdParentCate="{{$products->getListCategory()[0]->getId()}}"
                                       data-TitleSlug="{{$item->getCategorySlug()}}" data-ParentTitleSlug="{{$products->getListCategory()[0]->getTitleSlug()}}"
                                       data-nameCategory="{{$item->getCategory()}}" data-categoryId="{{$item->getIdCategory()}}" data-id="{{$item->getId()}}" data-value="{{$item->getTitle()}}" onclick="setValueQuickView(this)" data-toggle="modal" href="#quick-view">Quick Look
                                    </a>
                                    <a  data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}"  class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                    <a data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}" class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                </div>
                            </div>
                            <div class="item-content">
                                <div class="what-product-is">
                                    <ul class="bread-crumb">
                                        <li class="has-separator">
                                            <a href="avascript:void(0)">Sản phẩm</a>
                                        </li>
                                        <li class="is-marked">
                                            <a class="ids{{$item->getIdCategory()}}" href='http://127.0.0.1:8000/product/{{$item->getCategorySlug()}}/{{$item->getIdCategory()}}'>{{$item->getCategory()}}</a>
                                        </li>
                                    </ul>
                                    <h6 class="item-title">
                                        <a href="{{route('home.productDetail',[$item->getTitle(),$item->getId()])}}">{{$item->getTitle()}}</a>
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
                    @endforeach
                </div>
            </div>
            <!-- Carousel /- -->
        </div>
    </section>
    <!-- Women-Clothing -->

    <div class="banner-layer">
        <div class="container">
            <div class="image-banner">
                <a href="shop-v1-root-category.html" class="mx-auto banner-hover effect-dark-opacity">
                    <img class="img-fluid"   src="{{asset('assets/webApp/images/banners/photo-1541697349791-30e88807ccc8.jpg')}}"   style=" width: 1340px ;  height: 236px;"   alt="Winter Season Banner">
                </a>
            </div>
        </div>
    </div>
    <!-- Men-Clothing-Timing-Section -->
    <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <span class="sec-maker-span-text">Bài học - kinh doanh</span>
                <h3 class="sec-maker-h3 u-s-m-b-22">Kinh tế</h3>
            </div>
            <!-- Carousel -->
            <div class="slider-fouc">
                <div class="products-slider owl-carousel" data-item="4">
                    @foreach($productsKinhTe->getListBook() as $item)
                        <div class="item">
                            <div class="image-container">
                                <a class="item-img-wrapper-link" href="single-product.html">
                                    <img src="{{$item->getImages()}}" alt="img-{{$item->getTitle()}}">
                                </a>
                                <div class="item-action-behaviors">
                                    <a class="item-quick-look" data-parentCate="{{$products->getListCategory()[0]->getName()}}" data-IdParentCate="{{$products->getListCategory()[0]->getId()}}"
                                       data-TitleSlug="{{$item->getCategorySlug()}}" data-ParentTitleSlug="{{$products->getListCategory()[0]->getTitleSlug()}}"
                                       data-nameCategory="{{$item->getCategory()}}" data-categoryId="{{$item->getIdCategory()}}" data-id="{{$item->getId()}}" data-value="{{$item->getTitle()}}" onclick="setValueQuickView(this)" data-toggle="modal" href="#quick-view">Quick Look
                                    </a>
                                    <a  data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}"  class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                    <a data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}" class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                </div>
                            </div>
                            <div class="item-content">
                                <div class="what-product-is">
                                    <ul class="bread-crumb">
                                        <li class="has-separator">
                                            <a href="avascript:void(0)">Sản phẩm</a>
                                        </li>
                                        <li class="is-marked">
                                            <a class="ids{{$item->getIdCategory()}}" href='http://127.0.0.1:8000/product/{{$item->getCategorySlug()}}/{{$item->getIdCategory()}}'>{{$item->getCategory()}}</a>
                                        </li>
                                    </ul>
                                    <h6 class="item-title">
                                        <a href="{{route('home.productDetail',[$item->getTitle(),$item->getId()])}}">{{$item->getTitle()}}</a>
                                    </h6>
                                    <div class="item-stars">
                                        <div class='star' title="0 out of 5 - based on 0 Reviews">
                                            @if(array_key_exists(0,$item->getReviewBest()))
                                                @if((int)$item->getReviewBest()[0] >= 72)
                                                    <span style='width:71px'></span>
                                                @else
                                                    <span style='width:{{(int)$item->getReviewBest()[0]}}px'></span>
                                                    <span>({{$item->getReviewNumberStar()}})</span>
                                                @endif
                                            @else
                                                <span style='width:0px'></span>
                                                <span>(0)</span>
                                            @endif
                                        </div>
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
                    @endforeach
                </div>
            </div>
            <!-- Carousel /- -->
        </div>
    </section>
    <!-- Women-Clothing /- -->
    <!-- Men-Clothing-Timing-Section /- -->
{{--<ul class="pagination">--}}
{{--    <!-- Array Of Links -->--}}
{{--    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/home?page=1">1</a></li>--}}
{{--    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/home?page=2">2</a></li>--}}
{{--    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/home?page=3">3</a></li>--}}
{{--    <!-- Next Page Link -->--}}
{{--    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/home?page=2" rel="next">&raquo;</a></li>--}}
{{--</ul>--}}


@endsection
@section('script')
    <script>
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
    </script>
@endsection
