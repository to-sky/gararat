<div class="header-top">
    <div class="container">
        <div class="row">
            {{-- Phone and email --}}
            <div class="align-self-center col-md-7 pt-2 pt-md-0">
                <div class="d-flex justify-content-between justify-content-md-start">
                    <div class="d-flex">
                        <a href="tel:+201016200599" class="header-contact">
                            <i class="fas fa-phone"></i>
                            <span>+20-101-620-05-99</span>
                        </a>
                    </div>

                    <div class="d-flex px-md-3">
                        <a href="mailto:sales@gararat.com" class="header-contact">
                            <i class="far fa-envelope align-middle"></i>
                            <span>sales@gararat.com</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Socials--}}
            <div class="col-md-5 pt-2 pt-md-0">
                <div class="d-flex justify-content-between justify-content-end justify-content-md-end">
                    <div class="d-flex align-items-center">
                        <a href="https://www.facebook.com/gararatcom" class="header-top__social-icon facebook-icon" target="_blank"></a>
                        <a href="https://www.youtube.com/channel/UCoBI2FCQzx4tMEUbMpVphJw" class="header-top__social-icon youtube-icon" target="_blank"></a>
                        <a href="https://api.whatsapp.com/send?phone=00201016200599" class="header-top__social-icon whatsapp-icon" target="_blank"></a>
                    </div>

                    <span class="divider d-md-block d-none">|</span>

                    <div class="header-top-lang" id="changeLang">
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

<div class="header-main">
    <div class="container">
        <div class="d-flex justify-content-between">
            {{-- Logo --}}
            <div class="align-self-start">
                <div class="header-main__logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Gararat Logo" height="55">
                    </a>
                </div>
            </div>

            {{-- Menu --}}
            <div class="header__menu">
                @include('website.layouts.includes._menu')
            </div>

            <div class="d-flex">
               {{-- Burger button --}}
                <div class="align-self-center order-1 d-md-none">
                    <label class="toggle">
                        <input type="checkbox" id="burgerIcon">
                        <div>
                            <div>
                                <span></span>
                                <span></span>
                            </div>
                            <svg>
                                <use xlink:href="#path">
                            </svg>
                            <svg>
                                <use xlink:href="#path">
                            </svg>
                        </div>
                    </label>

                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" id="path">
                            <path d="M22,22 L2,22 C2,11 11,2 22,2 C33,2 42,11 42,22"></path>
                        </symbol>
                    </svg>
                </div>

                <div class="align-self-center px-5 px-md-3">
                    <div class="d-flex">

                        {{-- Search --}}
                        <div class="header-main__search align-self-end">
                            <i class="fas fa-search"></i>
                        </div>

                        {{-- Cart --}}
                        <div class="header-main__cart">
                            <a href="{{ route('cart') }}"><i class="fas fa-shopping-bag"></i></a>
                            <span id="cartItems" class="header-main__cart-amount">{{ Cart::count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>