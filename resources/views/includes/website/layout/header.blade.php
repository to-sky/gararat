<div class="header__top">
    <div class="container" style="position:relative; z-index: 20;">
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
                    <div class="header__top-search px-5">
                        <form action="{{ route('searchResults') }}" method="get" autocomplete="off">
                            <input type="text" name="q" required @if(isset($searchRequest) && $searchRequest !== null) value="{{ $searchRequest }} @endif" autocomplete="off" />
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <!-- /.header__top-search -->

                    <!-- /.header__top-auth -->
                    <div class="header__top-lang" id="changeLangHandler" style="z-index: 10;">
                        <div class="lang__header text-white">
                            <i class="fa fa-globe text-white"></i>
                            <span class="px-2">@if (Session::get('locale') == 'ar')عربى@else English @endif</span>
                            <i class="fa fa-caret-down text-white"></i>
                        </div>

                        <div class="lang__body text-white shadow" style="@if(Session::get('locale') == 'en') right: 0 @endif">
                            <ul class="lang__body_switcher">
                                <li class="lang__body_switcher-item">
                                    <input type="radio" name="lang" id="en" value="en" class="d-none" @if (Session::get('locale') == 'en') checked @endif>
                                    <label for="en" class="lang__body_switcher-text">
                                        <img src="{{ asset('images/en.svg') }}" alt="en">
                                        <span>English</span>
                                    </label>
                                </li>
                                <li class="lang__body_switcher-item">
                                    <input type="radio" name="lang" id="ar" value="ar" @if (Session::get('locale') == 'ar') checked @endif>
                                    <label for="ar" class="lang__body_switcher-text">
                                        <img src="{{ asset('images/ar.svg') }}" alt="ar">
                                        <span>عربى</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
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
