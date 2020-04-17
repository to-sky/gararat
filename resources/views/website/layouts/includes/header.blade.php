<div class="header__top">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="header__top-contacts ltr">
                    <a href="tel:+201016200599">
                        <i class="fas fa-phone"></i>
                        <span>+20-101-620-05-99</span>
                    </a>
                    <a href="mailto:sales@gararat.com">
                        <i class="far fa-envelope"></i>
                        <span>sales@gararat.com</span>
                    </a>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-end search__mobile">
                    <div class="header__top-search px-5">
                        <form action="{{ route('search') }}" method="get" autocomplete="off">
                            <input type="text" name="q" required autocomplete="off" value="{{ $searchRequest ?? '' }}" />
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>

                    <div class="header__top-lang" id="changeLang">
                        <div class="lang__header text-white">
                            <i class="fa fa-globe text-white"></i>
                            <span class="px-2">{{ __('English') }}</span>
                            <i class="fa fa-caret-down text-white"></i>
                        </div>

                        <div class="lang__body text-white shadow">
                            <ul class="lang__body_switcher">
                                <li class="lang__body_switcher-item">
                                    <input type="radio" name="lang" id="en" value="en" class="d-none"
                                           @if (isLocaleEn()) checked @endif />
                                    <label for="en" class="lang__body_switcher-text">
                                        <img src="{{ asset('images/en.svg') }}" alt="en">
                                        <span>English</span>
                                    </label>
                                </li>
                                <li class="lang__body_switcher-item">
                                    <input type="radio" name="lang" id="ar" value="ar"
                                           @if (isLocaleEn()) checked @endif />
                                    <label for="ar" class="lang__body_switcher-text">
                                        <img src="{{ asset('images/ar.svg') }}" alt="ar">
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

<div class="pt-3 pb-3 header__main">
    <div class="container">
        <div class="row">
            {{-- Logo --}}
            <div class="col-12 col-lg-2">
                <div class="header__main-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/logos/logo.png') }}" alt="Gararat Logo" height="64">
                    </a>
                </div>
            </div>

            {{-- Menu --}}
            <div class="col-12 col-lg-7">
                <div class="header__mobile-activator">
                    <a href="#"><img src="{{ asset('assets/menu.svg') }}" alt="Menu"></a>
                </div>

                <div class="header__main-menu">
                    @include('website.layouts.includes._menu')
                </div>
            </div>

            {{-- Cart --}}
            <div class="col-12 col-lg-3">
                <div class="header__main-cart">
                    <div class="cart">
                        <div class="cart__top">
                            <div class="d-flex justify-content-between">
                                <div class="cart__item-count text-left">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span id="cartItems">{{ Cart::count() }}</span> {{ __('item(-s)') }}
                                </div>

                                <div class="cart__checkout">
                                    <a href="{{ route('cart') }}"
                                       class="shadow-sm btn btn-checkout">{{ __('Cart') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>