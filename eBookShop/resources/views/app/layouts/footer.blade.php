<footer class="footer">
    <div class="container">
        <!-- Outer-Footer -->
        <div class="outer-footer-wrapper u-s-p-y-80">
            <h6>
               Tìm kiếm đơn hàng của bạn một cách nhanh chóng!
            </h6>
            <h1>
               Nhập mã đơn hàng
            </h1>
            @if(!Auth::check())
            <p>
               Đăng nhập tài khoản để tìm đơn hàng
            </p>
            @else
                <p>
                   Cảm ơn bạn đã mua sản phẩm của tôi!
                </p>
            @endif
            @if(Auth::check())
            {!! Form::open(['method' => 'POST' ,'class'=>'newsletter-form' ,'route' => ['cart.findOrder',Auth::user()->id]]) !!}

                <label class="sr-only" for="newsletter-field">Mã đơn hàng</label>
                <input name="idOrder" type="text" id="newsletter-field" placeholder="Nhập mã đơn hàng của bạn">

                <button type="submit" class="button">Tìm</button>

            {!! Form::close() !!}
            @endif
        </div>
        <!-- Outer-Footer /- -->
        <!-- Mid-Footer -->
        <div class="mid-footer-wrapper u-s-p-b-80">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="footer-list">
                        <h6>CUSTOMER SERVICE</h6>
                        <ul>
                            <li>
                                <a href="faq.html">FAQs</a>
                            </li>
                            <li>
                                <a href="track-order.html">Track Order</a>
                            </li>
                            <li>
                                <a href="terms-and-conditions.html">Terms & Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="footer-list">
                        <h6>COMPANY</h6>
                        <ul>
                            <li>
                                <a href="home.html">Home</a>
                            </li>
                            <li>
                                <a href="about.html">About</a>
                            </li>
                            <li>
                                <a href="contact.html">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="footer-list">
                        <h6>INFORMATION</h6>
                        <ul>
                            <li>
                                <a href="store-directory.html">Categories Directory</a>
                            </li>
                            <li>
                                <a href="wishlist.html">My Wishlist</a>
                            </li>
                            <li>
                                <a href="cart.html">My Cart</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="footer-list">
                        <h6>Address</h6>
                        <ul>
                            <li>
                                <i class="fas fa-location-arrow u-s-m-r-9"></i>
                                <span>819 Sugar Camp Road, West Concord, MN 55985</span>
                            </li>
                            <li>
                                <a href="tel:+923086561801">
                                    <i class="fas fa-phone u-s-m-r-9"></i>
                                    <span>+111-444-989</span>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:contact@domain.com">
                                    <i class="fas fa-envelope u-s-m-r-9"></i>
                                    <span>
                                            contact@domain.com</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mid-Footer /- -->
        <!-- Bottom-Footer -->
        <div class="bottom-footer-wrapper">
            <div class="social-media-wrapper">
                <ul class="social-media-list">
                    <li>
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-google-plus-g"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-rss"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <p class="copyright-text">Copyright &copy; 2018
                <a href="home.html">Groover</a> All Right Reserved</p>
        </div>
    </div>
    <!-- Bottom-Footer /- -->
</footer>
