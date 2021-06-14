@extends('app.home')
@section('pageWrapper')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Shop</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascript:void(0)">Shop</a>
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
            <!-- Result-Wrapper -->
            <div class="result-wrapper u-s-p-y-80">
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <a href="home.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="store-directory.html">All Categories</a>
                    </li>
                </ul>
                <h4>Không tìm thấy sản phẩm</h4>
                <h4>Tìm kiếm liên quan:
                    <a href="http://127.0.0.1:8000/product/Tieu-thuyet/2">Văn học</a> ,
                    <a href="http://127.0.0.1:8000/product/Kinh-te/7">Kinh tế</a> ,
                    <a href="http://127.0.0.1:8000/product/Tam-ly-ki-nang-song/11">Tâm lý - kỷ năng sống</a>
                </h4>
                <h1>SORRY</h1>
                {!! Form::open(['method' => 'POST'  ,'route' => ['home.findProduct']]) !!}
                    <label class="sr-only" for="search-not-found">Nhập tên sản phẩm</label>
                        <input hidden name="category" value="0">
                     <input type="text" class="text-field" name="name" id="search-not-found" placeholder="Search Products...">
                    <button class="button">Tìm kiếm</button>
                {!! Form::close() !!}
            </div>
            <!-- Result-Wrapper /- -->
        </div>
    </div>
    <!-- Shop-Page /- -->
    @endsection
