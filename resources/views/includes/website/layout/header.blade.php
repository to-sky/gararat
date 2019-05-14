<div class="header__top">
    <div class="container">
        <div class="row @if(!App::isLocale('en')) flex-row-reverse @endif">
            <div class="col-12 col-lg-6">
                <div class="header__top-contacts @if(!App::isLocale('en')) text-right @endif">
                    <a href="tel:+375224443333"><i class="fas fa-phone"></i><span>+20-101-620-05-99</span></a>
                    <a href="mailto:sales@gararat.com"><i class="far fa-envelope"></i><span>sales@gararat.com</span></a>
                </div>
                <!-- /.header__top-contacts -->
            </div>
            <!-- /.col-12 col-lg-6 -->
            <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-end @if(!App::isLocale('en')) flex-row-reverse @endif search__mobile">
                    <div class="header__top-search">
                        <form action="{{ route('searchResults') }}" method="get" autocomplete="off">
                            <input type="text" name="q" required @if(isset($searchRequest) && $searchRequest !== null) value="{{ $searchRequest }} @endif" autocomplete="off" />
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <!-- /.header__top-search -->
                    <div class="header__top-auth">
                        @if(! Auth::check())
                            <a href="{{ route('login') }}#top"><i class="far fa-user"></i>
                                @if(App::isLocale('en'))
                                    <span>Login</span>
                                @else
                                    <span>تسجيل الدخول</span>
                                @endif
                            </a>
                            <span>|</span>
                            <a href="{{ route('register') }}#top">
                                @if(App::isLocale('en'))
                                    {{ __('Register') }}
                                @else
                                    <span>تسجيل بالموقع</span>
                                @endif
                            </a>
                        @else
                            <a href="#"><i class="far fa-user"></i></a><!--<span>My account</span></a><span>|</span>-->
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span>
                                        @if(App::isLocale('en'))
                                            Logout
                                        @else
                                            الخروج
                                        @endif
                                    </span>
                                </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    </div>
                    <!-- /.header__top-auth -->
                    <div class="header__top-lang" id="changeLangHandler">
                        <select name="lang" id="lang" autocomplete="off">
                            <option @if(Session::get('locale') == 'en') selected @endif value="en">English</option>
                            <option @if(Session::get('locale') == 'ar') selected @endif value="ar">عربى</option>
                        </select>
                    </div>
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
        <div class="row @if(!App::isLocale('en')) flex-row-reverse @endif">
            <div class="col-12 col-lg-2">
                <div class="text-center header__main-logo">
                    <a href="{{ route('homePage') }}"><img src="{{ asset('assets/logos/logo.png') }}" alt="Gararat Logo" height="64"></a>
                </div>
                <!-- /.header__main-logo -->
            </div>
            <!-- /.col-12 col-lg-2 -->
            <div class="col-12 col-lg-7">
                <div class="header__mobile-activator">
                    <a href="#"><img src="{{ asset('assets/menu.svg') }}" alt="Menu"></a>
                </div>
                <!-- /.header__mobile-activator -->
                <div class="header__main-menu">
                    @if(App::isLocale('en'))
                        <ul>
                            <li @if(in_array(\Request::route()->getName(), ['homePage'])) class="active" @endif>
                                <a href="{{ route('homePage') }}">
                                    @if(App::isLocale('en'))
                                        Home
                                    @else
                                        الرئيسية
                                    @endif
                                </a>
                            </li>
                            <li @if(isset($catalogType) && $catalogType !== null && $catalogType == 0) class="active" @endif>
                                <a href="{{ route('catalogPage', 1) }}">
                                    @if(App::isLocale('en'))
                                        Equipment
                                    @else
                                        معدات
                                    @endif
                                </a>
                            </li>
                            <li @if(isset($catalogType) && $catalogType !== null && $catalogType == 1) class="active" @endif>
                                <a href="{{ route('catalogPage', 2) }}">
                                    @if(App::isLocale('en'))
                                        Parts
                                    @else
                                        قطع الغيار
                                    @endif
                                </a>
                            </li>
                            <li @if(in_array(\Request::route()->getName(), ['servicesPage'])) class="active" @endif>
                                <a href="{{ route('servicesPage') }}">
                                    @if(App::isLocale('en'))
                                        Service
                                    @else
                                        الخدمة
                                    @endif
                                </a>
                            </li>
                            <li @if(in_array(\Request::route()->getName(), ['newsPage'])) class="active" @endif>
                                <a href="{{ route('newsPage') }}">
                                    @if(App::isLocale('en'))
                                        News
                                    @else
                                        أخبار
                                    @endif
                                </a>
                            </li>
                            <li @if(in_array(\Request::route()->getName(), ['contactsPage'])) class="active" @endif>
                                <a href="{{ route('contactsPage') }}">
                                    @if(App::isLocale('en'))
                                        Contact
                                    @else
                                        إتصل بنا
                                    @endif
                                </a>
                            </li>
                        </ul>
                    @else
                        <ul>
                            <li @if(in_array(\Request::route()->getName(), ['contactsPage'])) class="active" @endif>
                                <a href="{{ route('contactsPage') }}">
                                    @if(App::isLocale('en'))
                                        Contact
                                    @else
                                        إتصل بنا
                                    @endif
                                </a>
                            </li>
                            <li @if(in_array(\Request::route()->getName(), ['newsPage'])) class="active" @endif>
                                <a href="{{ route('newsPage') }}">
                                    @if(App::isLocale('en'))
                                        News
                                    @else
                                        أخبار
                                    @endif
                                </a>
                            </li>
                            <li @if(in_array(\Request::route()->getName(), ['servicesPage'])) class="active" @endif>
                                <a href="{{ route('servicesPage') }}">
                                    @if(App::isLocale('en'))
                                        Service
                                    @else
                                        الخدمة
                                    @endif
                                </a>
                            </li>
                            <li @if(isset($catalogType) && $catalogType !== null && $catalogType == 1) class="active" @endif>
                                <a href="{{ route('catalogPage', 2) }}">
                                    @if(App::isLocale('en'))
                                        Parts
                                    @else
                                        قطع الغيار
                                    @endif
                                </a>
                            </li>
                            <li @if(isset($catalogType) && $catalogType !== null && $catalogType == 0) class="active" @endif>
                                <a href="{{ route('catalogPage', 1) }}">
                                    @if(App::isLocale('en'))
                                        Equipment
                                    @else
                                        معدات
                                    @endif
                                </a>
                            </li>
                            <li @if(in_array(\Request::route()->getName(), ['homePage'])) class="active" @endif>
                                <a href="{{ route('homePage') }}">
                                    @if(App::isLocale('en'))
                                        Home
                                    @else
                                        الرئيسية
                                    @endif
                                </a>
                            </li>
                        </ul>
                    @endif

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
