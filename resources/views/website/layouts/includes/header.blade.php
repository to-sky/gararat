<div class="header-top">
    <div class="container">
        <div class="d-flex flex-column flex-sm-row justify-content-between py-2">
            {{-- Contacts --}}
            <div class="d-flex justify-content-between align-items-center pb-3 pb-sm-0">
                <a href="tel:{{ SettingService::getFormattedPhone() }}" class="header-contact">
                    <i class="fas fa-phone"></i>
                    <span class="ltr">@setting('phone', '+20-101-620-05-99')</span>
                </a>

                <a href="mailto:{{ setting('email', 'sales@gararat.com') }}" class="header-contact px-sm-3">
                    <i class="far fa-envelope align-middle"></i>
                    <span>@setting('email', 'sales@gararat.com')</span>
                </a>
            </div>

            {{-- Socials--}}
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    @if(setting('facebook'))
                        <a href="{{ setting('facebook') }}" class="header__social-icon facebook-icon" target="_blank"></a>
                    @endif

                    @if(setting('youtube'))
                        <a href="{{ setting('youtube') }}" class="header__social-icon youtube-icon" target="_blank"></a>
                    @endif

                    @if(setting('whatsapp'))
                        <a href="https://api.whatsapp.com/send?phone={{ setting('whatsapp') }}" class="header__social-icon whatsapp-icon" target="_blank"></a>
                    @endif

                    @if(setting('instagram'))
                        <a href="{{ setting('instagram') }}" class="header__social-icon instagram-icon" target="_blank"></a>
                    @endif

                    @if(setting('twitter'))
                        <a href="{{ setting('twitter') }}" class="header__social-icon twitter-icon" target="_blank"></a>
                    @endif

                    @if(setting('linkedin'))
                        <a href="{{ setting('linkedin') }}" class="header__social-icon linkedin-icon" target="_blank"></a>
                    @endif
                </div>

                <span class="d-sm-flex d-none px-2">|</span>

                <div class="language-switcher">
                    <input id="langAr" type="radio" name="language" value="ar" @if(! isLocaleEn()) checked @endif />
                    <label class="language_label flag-ar" for="langAr"></label>

                    <input id="langEn" type="radio" name="language" value="en" @if(isLocaleEn()) checked @endif />
                    <label class="language_label flag-en" for="langEn"></label>
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
                        <img src="{{ SettingService::getLogoUrl('header') }}" alt="Gararat Logo" class="header-main__logo-image">
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
