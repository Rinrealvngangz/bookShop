<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('layouts.head')

<body class="header-fixed sidebar-fixed sidebar-light header-light" id="body">


<div id="toaster"></div>
<div class="wrapper">
    <!-- Github Link -->
    <a href="https://github.com/coding-gang" target="_blank" class="github-link">
        <svg width="70" height="70" viewBox="0 0 250 250" aria-hidden="true">
            <defs>
                <linearGradient id="grad1" x1="0%" y1="75%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#896def;stop-opacity:1"/>
                    <stop offset="100%" style="stop-color:#482271;stop-opacity:1"/>
                </linearGradient>
            </defs>
            <path d="M 0,0 L115,115 L115,115 L142,142 L250,250 L250,0 Z" fill="url(#grad1)"></path>
        </svg>
        <i class="mdi mdi-github-circle"></i>
    </a>
    <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
    @include('layouts.sidebar')

    <div class="page-wrapper">

        <div class="d-flex justify-content-center container mt-5" style="position: fixed; z-index: 999;">
            <div class="row " id="notification-user-order"  style=" display: none ; position: absolute; top: 0; right: 0; margin-right: 30px;" data-delay="5000">
                <div class="col-md-12">
                    <div class="d-flex flex-row justify-content-between align-items-center card cookie p-3">
                        <div class="d-flex flex-row align-items-center new-order">
                            <span class="badge badge-success">new</span>
                            <div class="ml-2 mr-2">
                                <span>Bạn có một thông báo mới.</span><br>
                                <div class="info-user"> </div><br>
                                <span class="see-order"></span>
                            </div>
                        </div>
                        <div><button class="btn btn-dark" onclick="removeNotification()" type="button">Okay</button></div>
                    </div>
                </div>
            </div>
        </div>
        @if(Session::has('review-accepted'))
            <div class="alert alert-success alert-highlighted"
                 style="z-index: 9999; position: fixed; top: 150px; right: 0;  " data-delay="5000">
                <span>{{Session::get('review-accepted')}}</span>
            </div>
        @elseif(Session::has('review-delete'))
            <div class="alert alert-success alert-highlighted"
                 style="z-index: 9999; position: fixed; top: 150px; right: 0;  " data-delay="5000">
                <span>{{Session::get('review-delete')}}</span>
            </div>

        @elseif(Session::has('import-success'))
            <div class="alert alert-success alert-highlighted"
                 style="z-index: 9999; position: fixed; top: 150px; right: 0;  " data-delay="5000">
                <span>{{Session::get('import-success')}}</span>
            </div>
        @elseif(Session::has('delete-paymentFail'))
            <div class="alert alert-danger alert-highlighted"
                 style="z-index: 9999; position: fixed; top: 150px; right: 0;  " data-delay="5000">
                <span>{{Session::get('delete-paymentFail')}}</span>
            </div>
        @elseif(Session::has('delete-paymentSuccess'))
            <div class="alert alert-success alert-highlighted"
                 style="z-index: 9999; position: fixed; top: 150px; right: 0;  " data-delay="5000">
                <span>{{Session::get('delete-paymentSuccess')}}</span>
            </div>
        @elseif(Session::has('export'))
            <div class="alert alert-success alert-highlighted"
                 style="z-index: 9999; position: fixed; top: 150px; right: 0;  " data-delay="5000">
                <span>{{Session::get('export')}}</span>
            </div>
        @endif
        <div aria-live="polite" aria-atomic="true" style="position: relative;">
            <div class="alert alert-success alert-highlighted"
                 style="position: absolute; top: 0; right: 0; display: none;" data-delay="5000">
                <i class="mdi mdi-chevron-down-circle"></i>

                <span></span>


            </div>
        </div>

        @include('layouts.header')
        <div class="content-wrapper">
            <div class="content">

                <!--
        ====================================
        ——— OVERVIEW
        =====================================
      -->
                @if(\Illuminate\Support\Facades\Route::currentRouteName()==="admin.index")
{{--                    @include('layouts.overview-order')--}}
                    @yield('overview-order')
                @else

                    <div class="breadcrumb-wrapper">
                        @yield('name')
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.index')}}">
                                        <span class="mdi mdi-home"></span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                        @yield('root')
                                </li>
                                <li class="breadcrumb-item" aria-current="page">@yield('model')</li>
                            </ol>
                        </nav>

                    </div>
                    <div class="row">
                        <div class="col-12">

                            @yield('content')
                            @endif

                        </div>
                    </div>
            </div>
        </div>

        @include('layouts.footer')

    </div>
</div>
<!-- jQuery -->

@include('layouts.script')
@yield('script')

</body>
</html>

