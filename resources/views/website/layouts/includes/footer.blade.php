<div class="footer-top">
    <div class="container">
        <div class="row">
            {{-- First column --}}
            <div class="col-sm-6 col-lg-3 footer-top__column">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo-footer.png') }}" class="footer-top__logo" alt="Gararat Logo">
                </a>

                <p class="footer-top__slogan">{{ __('GARARAT – the first e-hypermarket for agricultural tractors, equipment and spare parts!') }}</p>
            </div>

            {{-- Second column --}}
            <div class="col-sm-6 col-lg-3 footer-top__column">
                <h5 class="footer-top__title">{{ __('Follow Us') }}</h5>

                <div class="footer-top__social">
                    <div class="footer-top__social-item">
                        <a href="https://www.facebook.com/gararatcom" class="footer-top__social-icon facebook-icon" target="_blank">
                            <span class="footer-top__social-label">Facebook</span>
                        </a>
                    </div>

                    <div class="footer-top__social-item">
                        <a href="https://www.youtube.com/channel/UCoBI2FCQzx4tMEUbMpVphJw" class="footer-top__social-icon youtube-icon" target="_blank">
                            <span class="footer-top__social-label">YouTube</span>
                        </a>
                    </div>

                    <div class="footer-top__social-item">
                        <a href="https://api.whatsapp.com/send?phone=00201016200599" class="footer-top__social-icon whatsapp-icon" target="_blank">
                            <span class="footer-top__social-label">WhatsApp</span>
                        </a>
                    </div>
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
                        Villa 318, Al Showaifat region, Al Tagamoa  AL Khames, 90th st., New Cairo-Egypt
                    </span>
                </div>

                <div class="footer-top__contact-item">
                    <i class="fas fa-phone footer-top__contact-icon"></i>
                    <a href="tel:+201016200599" class="footer-top__contact-label ltr">
                        +20-101-620-05-99
                    </a>
                </div>

                <div class="footer-top__contact-item">
                    <i class="fas fa-envelope footer-top__contact-icon"></i>
                    <a href="mailto:sales@gararat.com" class="footer-top__contact-label">
                       sales@gararat.com
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