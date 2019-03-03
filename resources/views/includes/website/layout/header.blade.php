<div class="header__top">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="header__top-contacts">
                    <a href="tel:+375224443333"><i class="fas fa-phone"></i><span>+375-22-444-3333</span></a>
                    <a href="email:info@gararat.com"><i class="far fa-envelope"></i><span>info@gararat.com</span></a>
                </div>
                <!-- /.header__top-contacts -->
            </div>
            <!-- /.col-12 col-lg-6 -->
            <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-end">
                    <div class="header__top-search">
                        <form action="#" method="get">
                            <input type="text" name="q" required />
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <!-- /.header__top-search -->
                    <div class="header__top-auth">
                        @if(! Auth::check())
                            <a href="{{ route('login') }}"><i class="far fa-user"></i> <span>Login</span></a><span>|</span><a href="{{ route('register') }}">{{ __('Register') }}</a>
                        @else
                            <a href="#"><i class="far fa-user"></i> <span>My account</span></a><span>|</span><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>Logout</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    </div>
                    <!-- /.header__top-auth -->
                    <!--
                    <div class="header__top-lang">
                        <select name="lang" id="lang">
                            <option value="en">English</option>
                            <option value="ar">Arabic</option>
                        </select>
                    </div>
                    -->
                    <!-- /.header__top-lang -->
                </div>
                <!-- /.d-flex justify-content-end -->
            </div>
            <!-- /.col-12 col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<!-- /.header__top -->
<div class="shadow pt-3 pb-3 header__main">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-2">
                <div class="text-center header__main-logo">
                    <a href="{{ route('homePage') }}"><img src="{{ asset('assets/logos/logo.png') }}" alt="Gararat Logo" height="64"></a>
                </div>
                <!-- /.header__main-logo -->
            </div>
            <!-- /.col-12 col-lg-2 -->
            <div class="col-12 col-lg-7">
                <div class="header__main-menu">
                    <ul>
                        <li @if(in_array(\Request::route()->getName(), ['homePage'])) class="active" @endif>
                            <a href="{{ route('homePage') }}">Home</a>
                        </li>
                        <li @if(in_array(\Request::route()->getName(), ['catalogPage'])) class="active" @endif>
                            <a href="{{ route('catalogPage', 1) }}">Equipments</a>
                        </li>
                        <li @if(in_array(\Request::route()->getName(), ['catalogPage'])) class="active" @endif>
                            <a href="{{ route('catalogPage', 2) }}">Parts</a>
                        </li>
                        <li>
                            <a href="#">Services</a>
                        </li>
                        <li>
                            <a href="#">News</a>
                        </li>
                        <li>
                            <a href="#">Contacts</a>
                        </li>
                    </ul>
                </div>
                <!-- /.header__main-menu -->
            </div>
            <!-- /.col-12 col-lg-7 -->
            <div class="col-12 col-lg-3">
                <div class="header__main-cart">
                    @include('includes.website.layout.cart')
                </div>
                <!-- /.header__main-cart -->
            </div>
            <!-- /.col-12 col-lg-3 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<!-- /.shadow header__main -->
