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
                        <a href="{{route('home')}}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="single-product.html">Detail</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
@endsection
@section('content')
    <!-- Single-Product-Full-Width-Page -->
    <div class="page-detail u-s-p-t-80">
        <div class="container">
            <!-- Product-Detail -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- Product-zoom-area -->
                     @if(count($productDetail->getlistImages()))
                    <div class="zoom-area">
                        <img id="zoom-pro" class="img-fluid" src="{{$productDetail->getlistImages()[0]}}" data-zoom-image="{{$productDetail->getlistImages()[0]}}" alt="Zoom Image">

                        <div id="gallery" class="u-s-m-t-10">
                            @for($i =0  ;$i<count($productDetail->getlistImages()); $i++)
                            <a class="active" data-image="{{$productDetail->getlistImages()[$i]}}" data-zoom-image="{{$productDetail->getlistImages()[$i]}}">
                                <img src="{{$productDetail->getlistImages()[$i]}}" alt="Product">
                            </a>

                            @endfor
                        </div>
                    </div>
                    @endif
                    <!-- Product-zoom-area /- -->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- Product-details -->
                    <div class="all-information-wrapper">
                        <div class="section-1-title-breadcrumb-rating">
                            <div class="product-title">
                                <h1>
                                    <a class="title-book" href="{{route('home.productDetail',[$productDetail->getTitle(),$productDetail->getId()])}}">
                                        {{$productDetail->getTitle()}}
                                    </a>
                                </h1>
                            </div>
                            <ul class="bread-crumb">
                                <li class="has-separator">
                                    <a href="home.html">Home</a>
                                </li>
                                <li class="has-separator">
                                    <a href="shop-v1-root-category.html">Product</a>
                                </li>
                                <li class="is-marked">
                                    <a class="category-root" href="http://127.0.0.1:8000/product/{{$productDetail->getCategorySlug()}}/{{$productDetail->getIdCategory()}}">
                                        {{$productDetail->getCategory()}}
                                    </a>
                                </li>

                            </ul>
                            <div class="product-rating">
                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                    <span style='width:67px'></span>
                                </div>
                                <span>(23)</span>
                            </div>
                        </div>
                        <div class="section-2-short-description u-s-p-y-14">
                            <h6 class="information-heading u-s-m-b-8">Mô tả:</h6>
                            <p class="description-book">
                                {!! $productDetail->getDescribe() !!}
                            </p>
                        </div>
                        <div class="section-3-price-original-discount u-s-p-y-14">
                            <div class="price">
                                <h4>{{$productDetail->getPrice()}}</h4>
                            </div>
                            @if(round($productDetail->getPercentDiscount() * 100 / 100) !== 0.000 && $productDetail->getPercentDiscount() !== null)
                                <div class="original-price">
                                    <span>Giá gốc:</span>
                                    <span>{{$productDetail->getOriginalPrice()}}</span>
                                </div>
                                <div class="discount-price">
                                    <span>Giảm giá:</span>
                                    <span>{{$productDetail->getPercentDiscount()}}</span>
                                </div>
                            @endif

                        </div>
                        <div class="section-4-sku-information u-s-p-y-14">
                            <h6 class="information-heading u-s-m-b-8">Thông tin:</h6>
                            <div class="availability">
                                <span>Tình trạng:</span>
                                <span>Còn hàng</span>
                            </div>
                        </div>
                        <div class="section-5-product-variants u-s-p-y-14">
                            <h6 class="information-heading u-s-m-b-8">Sản phẩm:</h6>
                            <div class="color u-s-m-b-11">
                                <span>Hình thức:</span>
                                @if($productDetail->getFormality() === "Soft Cover")
                                <span class="formality">Bìa mềm</span>
                                @else
                                    <span class="formality">Bìa cứng</span>
                                @endif
                            </div>
                            <div class="color u-s-m-b-11">
                                <span>Tác giả:</span>
                                <span class="book-author">{{$productDetail->getAuthor()}}</span>
                            </div>
                            <div class="color u-s-m-b-11">
                                <span>Nhà xuất bản:</span>
                                <span class="book-publisher">{{$productDetail->getPublisher()}}</span>
                            </div>
                        </div>

                    </div>
                    <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                        <form action="#" class="post-form">

                            <div class="quantity-wrapper u-s-m-b-22">
                                <span>Quantity:</span>
                                <div class="quantity">
                                    <input type="text" class="quantity-text-field" value="1"  onkeypress="javascript:return isNumber(event)">
                                    <a class="plus-a" data-max="1000">&#43;</a>
                                    <a class="minus-a" data-min="1">&#45;</a>
                                </div>
                            </div>
                            <div>
                                <button data-value="{{ $productDetail->getId()}},{{$productDetail->getlistImages()[0]}}" onclick="addToCartModal(this)" class="button btn-addToCart button-outline-secondary" type="button">Thêm vào giỏ hàng</button>
                                <button data-value="{{ $productDetail->getId()}},{{$productDetail->getlistImages()[0]}}" onclick="addToWishListModal(this)" class="button btn-addToWishList button-outline-secondary far fa-heart u-s-m-l-6" type="button"></button>

                            </div>
                        </form>
                    </div>
                </div>
                <!-- Product-details /- -->
            </div>
            <!-- Product-Detail /- -->
            <!-- Detail-Tabs -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="detail-tabs-wrapper u-s-p-t-80">
                        <div class="detail-nav-wrapper u-s-m-b-30">
                            <ul class="nav single-product-nav justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#description">Mô tả</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#specification">Chi tiết</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#review">Đánh giá ({{count($productDetail->getReviewer())}})</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <!-- Description-Tab -->
                            <div class="tab-pane fade active show" id="description">
                                <div class="description-whole-container">
                                    <p class="desc-p u-s-m-b-26">
                                        {!! $productDetail->getDescribe() !!}
                                    </p>

                                </div>
                            </div>
                            <!-- Description-Tab /- -->
                            <!-- Specifications-Tab -->
                            <div class="tab-pane fade" id="specification">
                                <div class="specification-whole-container">
                                    <div class="spec-table u-s-m-b-50">
                                        <h4 class="spec-heading">Thông tin sản phẩm</h4>
                                        <table>
                                            <tr>
                                                <td>Tác giả</td>
                                                <td>{{$productDetail->getAuthor()}}</td>
                                            </tr>
                                            <tr>
                                                <td>Nhà xuất bản</td>
                                                <td>{{$productDetail->getPublisher()}}</td>
                                            </tr>
                                            <tr>
                                                <td>Trọng lượng (gr)</td>
                                                <td>{{$productDetail->getWeight()}}</td>
                                            </tr>
                                            <tr>
                                                <td>Số trang</td>
                                                <td>{{$productDetail->getNumber_of_pages()}}</td>
                                            </tr>
                                            <tr>
                                                <td>Kích Thước Bao Bì</td>
                                                <td>{{$productDetail->getSize()}} x 13cm</td>
                                            </tr>
                                            <tr>
                                                <td>Hình thức</td>
                                                <td>
                                                    @if($productDetail->getFormality() === "Hard Cover")
                                                        Bìa cứng
                                                    @else
                                                        Bìa mềm
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Specifications-Tab /- -->
                            <!-- Reviews-Tab -->
                            @if(count(array_keys($productDetail->getReviewBest())))
                            <div class="tab-pane fade" id="review">
                                <div class="review-whole-container">
                                    <div class="row r-1 u-s-m-b-26 u-s-p-b-22">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="total-score-wrapper">
                                                <h6 class="review-h6">Đánh giá trung bình</h6>
                                                <div class="circle-wrapper">
                                                                 @if( round((int)$productDetail->getReviewBest()[array_keys($productDetail->getReviewBest())[0]] /100,1 ) >=1 )
                                                        <h1>{{array_keys($productDetail->getReviewBest())[0]}} . 9</h1>
                                                    @else
                                                    <h1> {{array_keys($productDetail->getReviewBest())[0] + round((int)$productDetail->getReviewBest()[array_keys($productDetail->getReviewBest())[0]] /100,1 ) }}</h1>
                                                              @endif


                                                </div>
                                                <h6 class="review-h6">Dựa trên {{$productDetail->getReviewNumberStar()[array_keys($productDetail->getReviewBest())[0] -1]}} Reviews</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="total-star-meter">
                                                <div class="star-wrapper">
                                                    <span>5 Sao</span>
                                                    <div class="star">
                                                        @if(array_key_exists(5,$productDetail->getReviewBest()))
                                                                        @if((int)$productDetail->getReviewBest()[5] >= 72)
                                                                <span style='width:71px'></span>
                                                                            @else
                                                        <span style='width:{{(int)$productDetail->getReviewBest()[5]}}px'></span>
                                                                            @endif
                                                            @else
                                                                <span style='width:0px'></span>
                                                            @endif
                                                    </div>
                                                    <span>({{$productDetail->getReviewNumberStar()[4]}})</span>
                                                </div>
                                                <div class="star-wrapper">
                                                    <span>4 Sao</span>
                                                    <div class="star">
                                                        @if(array_key_exists(4,$productDetail->getReviewBest()))
                                                            @if((int)$productDetail->getReviewBest()[4] >= 72)
                                                                <span style='width:71px'></span>
                                                            @else
                                                            <span style='width:{{(int)$productDetail->getReviewBest()[4]}}px'></span>
                                                            @endif
                                                        @else
                                                            <span style='width:0px'></span>
                                                        @endif
                                                    </div>
                                                    <span>({{$productDetail->getReviewNumberStar()[3]}})</span>
                                                </div>
                                                <div class="star-wrapper">
                                                    <span>3 Sao</span>
                                                    <div class="star">
                                                        @if(array_key_exists(3,$productDetail->getReviewBest()))
                                                            @if((int)$productDetail->getReviewBest()[3] >= 72)
                                                                <span style='width:71px'></span>
                                                            @else
                                                            <span style='width:{{(int)$productDetail->getReviewBest()[3]}}px'></span>
                                                            @endif
                                                        @else
                                                            <span style='width:0px'></span>
                                                        @endif
                                                    </div>
                                                    <span>({{$productDetail->getReviewNumberStar()[2]}})</span>
                                                </div>
                                                <div class="star-wrapper">
                                                    <span>2 Sao</span>
                                                    <div class="star">
                                                        @if(array_key_exists(2,$productDetail->getReviewBest()))
                                                            @if((int)$productDetail->getReviewBest()[2] >= 72)
                                                                <span style='width:71px'></span>
                                                            @else
                                                            <span style='width:{{(int)$productDetail->getReviewBest()[2]}}px'></span>
                                                            @endif
                                                        @else

                                                            <span style='width:0px'></span>
                                                        @endif
                                                    </div>
                                                    <span>({{$productDetail->getReviewNumberStar()[1]}})</span>
                                                </div>
                                                <div class="star-wrapper">
                                                    <span>1 Sao</span>
                                                    <div class="star">
                                                        @if(array_key_exists(1,$productDetail->getReviewBest()))
                                                            @if((int)$productDetail->getReviewBest()[1] >= 72)
                                                                <span style='width:71px'></span>
                                                            @else
                                                            <span style='width:{{(int)$productDetail->getReviewBest()[1]}}px'></span>
                                                            @endif
                                                        @else
                                                            <span style='width:0px'></span>
                                                        @endif
                                                    </div>
                                                    <span>({{$productDetail->getReviewNumberStar()[0]}})</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row r-2 u-s-m-b-26 u-s-p-b-22">
                                        <div class="col-lg-12">
                                            <div class="your-rating-wrapper">
                                               <form method="post" action="{{route('home.review',$productDetail->getId())}}">
                                                   @csrf
                                                <h6 class="review-h6">Đánh giá của bạn về sách</h6>
                                                <h6 class="review-h6">Bạn đã từng mua sản phẩm này?</h6>
                                                <div class="star-wrapper u-s-m-b-8">
                                                    <div class="star">
                                                        <span id="your-stars" style='width:0'></span>
                                                    </div>
                                                    <label for="your-rating-value"></label>
                                                    <input id="your-rating-value" name="numberStar" type="text" class="text-field" placeholder="0.0">
                                                    <span id="star-comment"></span>
                                                </div>


                                                <label for="nameCustomer">Tên của bạn
                                                        <span class="astk"> *</span>
                                                    </label>
                                                    <input id="nameCustomer" type="text" name="nameCustomer" class="text-field" placeholder="Tên của bạn">
                                                    <label for="reviewDesc">Nhận xét
                                                        <span class="astk"> *</span>
                                                    </label>
                                                    <textarea class="text-area u-s-m-b-8" id="reviewDesc" name="reviewDesc" placeholder="Viết nhận xét"></textarea>
                                                    <button class="button button-outline-secondary">Gửi nhận xét</button>
                                               </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Get-Reviews -->
                                    <div class="get-reviews u-s-p-b-22">
                                        <!-- Review-Options -->
                                        <div class="review-options u-s-m-b-16">
                                            <div class="review-option-heading">
                                                <h6>Đánh giá
                                                    <span> ({{count($productDetail->getReviewer())}}) </span>
                                                </h6>
                                            </div>

                                        </div>
                                        <!-- Review-Options /- -->
                                        <!-- All-Reviews -->
                                        <div class="reviewers">
                                            @foreach($productDetail->getReviewer() as $item)
                                            <div class="review-data">
                                                <div class="reviewer-name-and-date">
                                                    <h6 class="reviewer-name">{{$item->getNameReviewer()}}</h6>
                                                    <h6 class="review-posted-date">{{$item->getCreate_atReview()}}</h6>
                                                </div>
                                                <div class="reviewer-stars-title-body">
                                                    <div class="reviewer-stars">
                                                        <div class="star">
                                                            @if(round($item->getNumberStar()) == 5 )
                                                                <span style='width:71px'></span>
                                                            @elseif(round($item->getNumberStar()) == 4)
                                                                <span style='width:60px'></span>
                                                            @elseif(round($item->getNumberStar()) == 3)
                                                                <span style='width:40px'></span>
                                                            @elseif(round($item->getNumberStar()) == 2)
                                                                <span style='width:20px'></span>
                                                            @elseif(round($item->getNumberStar()) == 1)
                                                                <span style='width:10px'></span>
                                                            @endif

                                                        </div>
                                                        @if(round($item->getNumberStar()) == 5 )
                                                        <span class="review-title">Tuyệt vời.</span>
                                                        @elseif(round($item->getNumberStar()) == 4)
                                                            <span class="review-title">Tôi thích sản phẩm này.</span>
                                                        @elseif(round($item->getNumberStar()) == 3)
                                                            <span class="review-title"> Tốt</span>
                                                        @elseif(round($item->getNumberStar()) == 2)
                                                            <span class="review-title"> Tôi không thích sách này.</span>
                                                        @elseif(round($item->getNumberStar()) == 1)
                                                            <span class="review-title"> Tôi ghét sản phẩm này.</span>
                                                            @endif
                                                    </div>
                                                    <p class="review-body">
                                                      {{$item->getReviewDesc()}}
                                                    </p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <!-- All-Reviews /- -->
                                    </div>
                                    <!-- Get-Reviews /- -->
                                </div>
                            </div>
                        @else
                                <div class="tab-pane fade" id="review">
                                    <div class="review-whole-container">
                                        <div class="row r-1 u-s-m-b-26 u-s-p-b-22">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="total-score-wrapper">
                                                    <h6 class="review-h6">Đánh giá trung bình</h6>
                                                    <div class="circle-wrapper">
                                                        <h1>0</h1>
                                                    </div>
                                                    <h6 class="review-h6">Dựa trên 0 đánh</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="total-star-meter">
                                                    <div class="star-wrapper">
                                                        <span>5 sao</span>
                                                        <div class="star">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                    <div class="star-wrapper">
                                                        <span>4 sao</span>
                                                        <div class="star">
                                                            <span style='width:0px'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                    <div class="star-wrapper">
                                                        <span>3 Sao</span>
                                                        <div class="star">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                    <div class="star-wrapper">
                                                        <span>2 Sao</span>
                                                        <div class="star">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                    <div class="star-wrapper">
                                                        <span>1 Sao</span>
                                                        <div class="star">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row r-2 u-s-m-b-26 u-s-p-b-22">
                                            <div class="col-lg-12">
                                                <div class="your-rating-wrapper">
                                                    <form method="post" action="{{route('home.review',$productDetail->getId())}}">
                                                        @csrf
                                                        <h6 class="review-h6">Đánh giá của bạn về sách</h6>
                                                        <h6 class="review-h6">Bạn đã từng mua sản phẩm này?</h6>
                                                        <div class="star-wrapper u-s-m-b-8">
                                                            <div class="star">
                                                                <span id="your-stars" style='width:0'></span>
                                                            </div>
                                                            <label for="your-rating-value"></label>
                                                            <input id="your-rating-value" name="numberStar" type="text" class="text-field" placeholder="0.0">
                                                            <span id="star-comment"></span>
                                                        </div>


                                                        <label for="nameCustomer">Tên của bạn
                                                            <span class="astk"> *</span>
                                                        </label>
                                                        <input id="nameCustomer" type="text" name="nameCustomer" class="text-field" placeholder="Tên của bạn">
                                                        <label for="reviewDesc">Nhận xét
                                                            <span class="astk"> *</span>
                                                        </label>
                                                        <textarea class="text-area u-s-m-b-8" id="reviewDesc" name="reviewDesc" placeholder="Viết nhận xét"></textarea>
                                                        <button class="button button-outline-secondary">Gửi nhận xét</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Get-Reviews -->
                                        <div class="get-reviews u-s-p-b-22">
                                            <!-- Review-Options -->
                                            <div class="review-options u-s-m-b-16">
                                                <div class="review-option-heading">
                                                    <h6>Đánh giá
                                                        <span> (0) </span>
                                                    </h6>
                                                </div>
                                            </div>
                                            <!-- Review-Options /- -->
                                        </div>
                                        <!-- Get-Reviews /- -->
                                    </div>
                                </div>
                            @endif
                            <!-- Reviews-Tab /- -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Detail-Tabs /- -->
            <!-- Different-Product-Section -->
            <div class="detail-different-product-section u-s-p-t-80">
                <!-- Similar-Products -->
                <section class="section-maker">
                    <div class="container">
                        <div class="sec-maker-header text-center">
                            <h3 class="sec-maker-h3">Sản phẩm tương tự</h3>
                        </div>
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach($productDetail->getListBookAll() as $item)
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="single-product.html">
                                                <img src="{{$item->getImages()}}" alt="img-{{$item->getTitle()}}">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-nameCategory="{{$item->getCategory()}}" data-categoryId="{{$item->getIdCategory()}}" data-id="{{$item->getId()}}" data-value="{{$item->getTitle()}}" onclick="setValueQuickView(this)" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}"  class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}" class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="shop-v1-root-category.html">Sản phẩm</a>
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
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
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
                </section>
                <!-- Similar-Products /- -->
                <!-- Recently-View-Products  -->
                <section class="section-maker">
                    <div class="container">
                        <div class="sec-maker-header text-center">
                            <h3 class="sec-maker-h3">Sản phẩm gần đây</h3>
                        </div>
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach($productDetail->getListBookRecent() as $item)
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="single-product.html">
                                                <img src="{{$item->getImages()}}" alt="img-{{$item->getTitle()}}">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-nameCategory="{{$item->getCategory()}}" data-categoryId="{{$item->getIdCategory()}}" data-id="{{$item->getId()}}" data-value="{{$item->getTitle()}}" onclick="setValueQuickView(this)" data-toggle="modal" href="#quick-view">Quick Look
                                                </a>
                                                <a  data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}" class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a data-value="{{$item->getId()}},{{$item->getTitle()}},{{$item->getPrice()}}" class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="shop-v1-root-category.html">Sản phẩm</a>
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
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>(0)</span>
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
                </section>
                <!-- Recently-View-Products /- -->
            </div>
            <!-- Different-Product-Section /- -->
        </div>
    </div>
    <!-- Single-Product-Full-Width-Page /- -->
@endsection

@section('script')
    <script>
        $('.checkout-anchor').show();
        $('.cart-anchor').show();
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

            iconShoppingP.innerHTML = no;
            var formatPrice =(price).toLocaleString(
                undefined,
                { minimumFractionDigits: 3 }
            );
            totalPrice.innerHTML = formatPrice +" VND";
            $('.mini-total-price').append(formatPrice +" VND");
        }
        function addToWishListModal(item){
            let items = [];
            var id =item.getAttribute('data-value').split(',')[0];
            var price = $('.price h4').text();
            var title =  $('.title-book').text().replace(/\s+/g, ' ').trim();
            var img =item.getAttribute('data-value').split(',')[1];
            setLocalStorageWishlist(id,title,price,img,items);
        }
        function addToCartModal(item){
            let items = [];
            var id =item.getAttribute('data-value').split(',')[0];
            var price = $('.price h4').text();
            var title = $('.title-book').text().replace(/\s+/g, ' ').trim();
            var quantity = $('.quantity-text-field').val();
            var img = item.getAttribute('data-value').split(',')[1];
            console.log(img);
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
            var price = $('.price-modal h4').text();
            var title = $('.title-book-modal').text().replace(/\s+/g, ' ').trim();

            var quantity = $('.quantity-text-field-modal').val();
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
            $.ajax({
                method :"GET",
                url: '/home/'+$title + '/'+$id,
                contentType: "application/json",
                dataType: "json",
                success: function(data) {
                    clearDataBookDetail();
                    $('.btn-addToCart-Modal').attr("data-value", $id);
                    $('.btn-addToWishList-Modal').attr("data-value", $id);
                    $('.description-book-modal').append(data[0]);
                    $('.price-modal h4').append(data[1] + "đ");
                    if(data[6].localeCompare("Hard Cover")){
                        $('.formality-modal').append("Bìa cứng");
                    }else {
                        $('.formality-modal').append("Bìa mềm");
                    }
                    $patchTitle ='<h1>'+
                        '<a class="title-book title-book-modal" href="http://127.0.0.1:8000/home/'+data[2]+'/'+$id+'">'+data[2]+'</a>'+
                        '</h1>';
                    $('.product-title-modal').append($patchTitle);
                    $('.book-author-modal').append(data[7]);
                    $('.book-publisher-modal').append(data[8]);
                    var href = $('.ids'+categoryId).attr('href');
                    $('.category-root-modal').attr('href',href);
                    $('.category-root-modal').append(nameCategory);
                    var $img;
                    $img = '<img id="zoom-pro-quick-view" class="img-fluid zoom-pro-quick-view-modal" src="'+data[9][0]+'" data-zoom-image="" alt="Zoom Image">';
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
                    $('.zoom-area-modal').append($img);

                    if(Math.round(parseInt(data[5])) !== 0 && data[5] !== null){
                        $('.original-price-modal').append('<span> Giá gốc : </span>' );
                        $('.original-price-modal').append( '<span>'+ data[4] + '</span>');
                        $('.discount-price-modal').append('<span> Giảm giá : </span>' );
                        $('.discount-price-modal').append( Math.round(parseInt(data[5])) + '%');
                    }
                }
            });
        }
        function clearDataBookDetail(){
            $('.description-book-modal').text("");
            $('.price-modal h4').text("");
            $('.original-price-modal').text("");
            $('.discount-price-modal').text("");
            $('.formality-modal').text("");
            $('.book-author-modal').text("");
            $('.book-publisher-modal').text("");
            $('.zoom-area-modal').text("");
            $('.category-root-modal').text("");
            $('.product-title-modal').text("");
        }
        function active(item){
            $('.zoom-area-modal').find('.active').removeClass("active");
            $src = item.childNodes[0].getAttribute('src');
            $(item).addClass('active');
            $('.zoom-pro-quick-view-modal').attr('src',$src);
        }
        function isNumber(evt) {
            var iKeyCode = (evt.which) ? evt.which : evt.keyCode
            if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                return false;
            return true;
        }
    </script>
@endsection
