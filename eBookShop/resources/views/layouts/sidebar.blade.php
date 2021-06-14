<!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="{{route('admin.index')}}" title="Sleek Dashboard">
                <svg
                    class="brand-icon"
                    xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="xMidYMid"
                    width="30"
                    height="33"
                    viewBox="0 0 30 33"
                >
                    <g fill="none" fill-rule="evenodd">
                        <path
                            class="logo-fill-blue"
                            fill="#7DBCFF"
                            d="M0 4v25l8 4V0zM22 4v25l8 4V0z"
                        />
                        <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                </svg>
                <span class="brand-name text-truncate">Admin Dashboard</span>
            </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar">

            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">



                <li  class="has-sub active expand" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
                       aria-expanded="false" aria-controls="dashboard">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse show"  id="dashboard"
                         data-parent="#sidebar-menu">
                        <div class="sub-menu">



                            <li  class="active" >
                                <a class="sidenav-item-link" href="{{route('category.index')}}">
                                    <span class="nav-text">Category</span>

                                </a>
                            </li>

                            <li >
                                <a class="sidenav-item-link" href="{{route('book.index')}}">
                                    <span class="nav-text">Books</span>

                                    <span class="badge badge-success">new</span>

                                </a>
                            </li>

                        </div>
                    </ul>
                </li>

                <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#app"
                       aria-expanded="false" aria-controls="app">
                        <i class="mdi mdi-pencil-box-multiple"></i>
                        <span class="nav-text">App</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="app"
                         data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            @if(auth()->user()->hasRole('Administrator')||auth()->user()->hasRole('Manager') || auth()->user()->hasRole('HR'))
                            <li >
                                <a class="sidenav-item-link" href="{{route('user.index')}}">
                                    <span class="nav-text">Users</span>

                                </a>
                            </li>
                            @endif
                             @if(auth()->user()->hasRole('Administrator'))
                            <li >
                                <a class="sidenav-item-link" href="{{route('role.index')}}">
                                    <span class="nav-text">Access Control</span>

                                </a>
                            </li>
                            @endif
                            <li >
                                <a class="sidenav-item-link" href="{{route('order.index')}}">
                                    <span class="nav-text">Order</span>

                                </a>
                            </li>
                                <li >
                                    <a class="sidenav-item-link" href="{{route('review.index')}}">
                                        <span class="nav-text">Review</span>

                                    </a>
                                </li>
                                <li >
                                    <a class="sidenav-item-link" href="{{route('payment.index')}}">
                                        <span class="nav-text">Payment</span>

                                    </a>
                                </li>
                        </div>
                    </ul>
                </li>

            </ul>

        </div>

    </div>
</aside>
