<div class="footer-top">
    <div class="container">
        <div class="row">
            {{-- First column --}}
            <div class="col-sm-6 col-lg-3 footer-top__column">
                <a href="{{ route('home') }}">
                    <img src="{{ SettingService::getLogoUrl('footer') }}" class="footer-top__logo" alt="Logo">
                </a>

                <p class="footer-top__slogan">
                    @php($footerSlogan = isLocaleEn() ? 'footer_slogan' : 'footer_slogan_ar')
                    @setting($footerSlogan)
                </p>
            </div>

            {{-- Second column --}}
            <div class="col-sm-6 col-lg-3 footer-top__column">
                <h5 class="footer-top__title">{{ __('Follow Us') }}</h5>

                <div class="footer-top__social">
                    @if(setting('facebook'))
                        <div class="footer-top__social-item">
                            <a href="{{ setting('facebook') }}" class="footer-top__social-icon facebook-mono-icon"
                               target="_blank" data-social="facebook"
                            >
                                <span class="footer-top__social-label">Facebook</span>
                            </a>
                        </div>
                    @endif

                    @if(setting('youtube'))
                        <div class="footer-top__social-item">
                            <a href="{{ setting('youtube') }}" class="footer-top__social-icon youtube-mono-icon"
                               target="_blank" data-social="youtube"
                            >
                                <span class="footer-top__social-label">YouTube</span>
                            </a>
                        </div>
                    @endif

                    @if(setting('whatsapp'))
                        <div class="footer-top__social-item">
                            <a href="https://api.whatsapp.com/send?phone={{ setting('whatsapp') }}"
                               class="footer-top__social-icon whatsapp-mono-icon" target="_blank" data-social="whatsapp"
                            >
                                <span class="footer-top__social-label">WhatsApp</span>
                            </a>
                        </div>
                    @endif

                    @if(setting('instagram'))
                        <div class="footer-top__social-item">
                            <a href="{{ setting('instagram') }}" class="footer-top__social-icon instagram-mono-icon"
                               target="_blank" data-social="instagram"
                            >
                                <span class="footer-top__social-label">Instagram</span>
                            </a>
                        </div>
                    @endif

                    @if(setting('twitter'))
                        <div class="footer-top__social-item">
                            <a href="{{ setting('twitter') }}" class="footer-top__social-icon twitter-mono-icon"
                               target="_blank" data-social="twitter"
                            >
                                <span class="footer-top__social-label">Twitter</span>
                            </a>
                        </div>
                    @endif

                    @if(setting('linkedin'))
                        <div class="footer-top__social-item">
                            <a href="{{ setting('linkedin') }}" class="footer-top__social-icon linkedin-mono-icon"
                               target="_blank" data-social="linkedin"
                            >
                                <span class="footer-top__social-label">LinkedIn</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Third column --}}
            <div class="col-sm-6 col-lg-3 footer-top__column">
                <h5 class="footer-top__title">{{ __('Company') }}</h5>
                <div class="footer-top__menu">
                    @include('website.layouts.includes._menu')
                </div>
            </div>

            {{-- Fourth column --}}
            <div class="col-sm-6 col-lg-3 footer-top__column">
                <h5 class="footer-top__title">{{ __('Contact Us') }}</h5>

                <div class="footer-top__contact-item">
                    <i class="fas fa-map-marker-alt footer-top__contact-icon"></i>
                    <span class="footer-top__contact-label footer-top__contact-label_not-hovered">
                        @php($footerAddress = isLocaleEn() ? 'footer_address' : 'footer_address_ar')
                        @setting($footerAddress, __('Villa 318, Al Showaifat region, Al Tagamoa  AL Khames, 90th st., New Cairo-Egypt'))
                    </span>
                </div>

                <div class="footer-top__contact-item">
                    <i class="fas fa-phone footer-top__contact-icon"></i>
                    <a href="tel:{{ SettingService::getFormattedPhone() }}" class="footer-top__contact-label ltr">
                        @setting('phone', '+20-101-620-05-99')
                    </a>
                </div>

                <div class="footer-top__contact-item">
                    <i class="fas fa-envelope footer-top__contact-icon"></i>
                    <a href="mailto:{{ setting('email', 'sales@gararat.com') }}" class="footer-top__contact-label align-self-baseline">
                        @setting('email', 'sales@gararat.com')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer-bottom">
    <div class="container">
        <p class="footer-bottom__copyright-text">&copy; 2019-{{ date('Y') }}
            <a href="{{ route('home') }}">{{ config('app.site_name')  }}</a> {{ __('All rights reserved') }}
        </p>
    </div>
</div>
