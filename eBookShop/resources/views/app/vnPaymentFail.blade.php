@extends('app.home')
@section('pageWrapper')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Error</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascript:void(0)">Error</a>
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
                        <a href="store-directory.html">Error</a>
                    </li>
                </ul>
                <h4>Đã sảy ra lỗi khi thanh toán, hãy thử lại</h4>

                <h1>SORRY</h1>
            </div>
            <!-- Result-Wrapper /- -->
        </div>
    </div>
    <!-- Shop-Page /- -->
@endsection
