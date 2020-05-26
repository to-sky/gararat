<div class="header-top">
    <div class="container">
        <div class="d-flex flex-column flex-sm-row justify-content-between py-2">
            {{-- Contacts --}}
            <div class="d-flex justify-content-between align-items-center pb-2 pb-sm-0">
                <a href="tel:+201016200599" class="header-contact">
                    <i class="fas fa-phone"></i>
                    <span class="ltr">+20-101-620-05-99</span>
                </a>

                <a href="mailto:sales@gararat.com" class="header-contact px-sm-3">
                    <i class="far fa-envelope align-middle"></i>
                    <span>sales@gararat.com</span>
                </a>
            </div>

            {{-- Socials--}}
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <a href="https://www.facebook.com/gararatcom" class="header__social-icon facebook-icon" target="_blank"></a>
                    <a href="https://www.youtube.com/channel/UCoBI2FCQzx4tMEUbMpVphJw" class="header__social-icon youtube-icon mx-2" target="_blank"></a>
                    <a href="https://api.whatsapp.com/send?phone=00201016200599" class="header__social-icon whatsapp-icon" target="_blank"></a>
                </div>

                <span class="d-sm-flex d-none px-2">|</span>

                <a href="#" class="header__lang-switcher" id="changeLang">
                    <i class="fa fa-globe"></i>
                    <span class="px-2">{{ __('EN') }}</span>
                    <i class="fa fa-caret-down"></i>

                    <ul class="header__lang__items" id="langBody">
                        <li class="header__lang__item">
                            <input type="radio" name="lang" id="en" value="en" @if(isLocaleEn()) checked @endif />
                            <label for="en" class="header__lang__item-text">
                                <img src="{{ asset('images/icons/flag-en.svg') }}" alt="en">
                                <span>English</span>
                            </label>
                        </li>

                        <li class="header__lang__item">
                            <input type="radio" name="lang" id="ar" value="ar" @if(! isLocaleEn()) checked @endif/>
                            <label for="ar" class="header__lang__item-text">
                                <img src="{{ asset('images/icons/flag-ar.svg') }}" alt="ar">
                                <span>عربى</span>
                            </label>
                        </li>
                    </ul>
                </a>
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
                        <div class="header-main__search align-self-end px-3">
                            <i class="fas fa-search header-main__search-icon"></i>
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