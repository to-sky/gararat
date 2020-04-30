<div class="header__top">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="header__top-contacts ltr">
                    <a href="tel:+201016200599">
                        <i class="fas fa-phone"></i>
                        <span>+20-101-620-05-99</span>
                    </a>
                    <a href="mailto:sales@gararat.com">
                        <i class="far fa-envelope align-middle"></i>
                        <span>sales@gararat.com</span>
                    </a>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="header__top-social-container d-flex justify-content-end">
                    <div class="header__top-social">
                        <a href="https://www.facebook.com/gararatcom" class="header__top-social-icon facebook-icon" target="_blank"></a>
                        <a href="https://www.youtube.com/channel/UCoBI2FCQzx4tMEUbMpVphJw" class="header__top-social-icon youtube-icon" target="_blank"></a>
                        <a href="https://api.whatsapp.com/send?phone=00201016200599" class="header__top-social-icon whatsapp-icon" target="_blank"></a>
                    </div>

                    <span class="divider">|</span>

                    <div class="header__top-lang" id="changeLang">
                        <div class="lang__header">
                            <i class="fa fa-globe"></i>
                            <span class="px-2">{{ __('English') }}</span>
                            <i class="fa fa-caret-down"></i>
                        </div>

                        <div class="lang__body shadow">
                            <ul class="lang__body_switcher">
                                <li class="lang__body_switcher-item">
                                    <input type="radio" name="lang" id="en" value="en" class="d-none" />
                                    <label for="en" class="lang__body_switcher-text">
                                        <img src="{{ asset('images/icons/flag-en.svg') }}" alt="en">
                                        <span>English</span>
                                    </label>
                                </li>
                                <li class="lang__body_switcher-item">
                                    <input type="radio" name="lang" id="ar" value="ar" />
                                    <label for="ar" class="lang__body_switcher-text">
                                        <img src="{{ asset('images/icons/flag-ar.svg') }}" alt="ar">
                                        <span>عربى</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="header__main py-3">
    <div class="container">
        <div class="row">
            {{-- Logo --}}
            <div class="col-12 col-lg-2">
                <div class="header__main-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Gararat Logo" height="55">
                    </a>
                </div>
            </div>

            {{-- Menu --}}
            <div class="col-12 col-lg-6 offset-1">
                <div class="header__mobile-activator">
                    <a href="#"><img src="{{ asset('images/menu.svg') }}" alt="Menu"></a>
                </div>

                <div class="header__main-menu">
                    @include('website.layouts.includes._menu')
                </div>
            </div>

            {{-- Cart --}}
            <div class="col-12 col-lg-3">
                <div class="header__main-cart-container d-flex justify-content-end">
                    <div class="header__main-search">
                        <i class="fas fa-search"></i>
                    </div>

                    <div class="header__main-cart">
                        <a href="{{ route('cart') }}"><i class="fas fa-shopping-bag"></i></a>
                        <span id="cartItems" class="header__main-cart-amount">{{ Cart::count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>