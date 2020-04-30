<div class="footer-top">
    <div class="container">
        <div class="row">
            {{-- First column --}}
            <div class="col-12 col-lg-3 col-md-6">
                <div class="footer-top__logo">
                    <a href="http://gararat.test">
                        <img src="http://gararat.test/images/logo-footer.png" alt="Gararat Logo" height="80">
                    </a>
                </div>

                <div class="footer-top__slogan">
                    <p>{{ __('GARARAT – the first e-hypermarket for agricultural tractors, equipment and spare parts!') }}</p>
                </div>
            </div>

            {{-- Second column --}}
            <div class="col-lg-3">
                <h5 class="footer-top__title">{{ __('Follow Us') }}</h5>
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

            {{-- Third column --}}
            <div class="col-12 col-lg-2 col-lg-3 col-md-6">
                <h5 class="footer-top__title">{{ __('Company') }}</h5>
                <div class="footer-top__menu">
                    @include('website.layouts.includes._menu')
                </div>
            </div>

            {{-- Fourth column --}}
            <div class="col-lg-3">
                <h5 class="footer-top__title">{{ __('Contact Us') }}</h5>

                <div class="footer-top__contact-item">
                    <i class="fas fa-map-marker-alt footer-top__contact-icon footer-address-icon"></i>
                    <span class="footer-top__contact-text">Villa 318, Al Showaifat region, Al Tagamoa  AL Khames, 90th st., New Cairo-Egypt</span>
                </div>

                <div class="footer-top__contact-item">
                    <a href="tel:+201016200599">
                        <i class="fas fa-phone footer-top__contact-icon align-baseline"></i>
                        <span class="footer-top__contact-text">+20-101-620-05-99</span>
                    </a>
                </div>

                <div class="footer-top__contact-item">
                    <a href="mailto:sales@gararat.com">
                        <i class="fas fa-envelope footer-top__contact-icon align-text-bottom"></i>
                        <span class="footer-top__contact-text">sales@gararat.com</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer-bottom">
    <div class="container">
        <p class="footer__copyright-text">&copy; 2019-{{ date('Y') }}
            <a href="{{ route('home') }}">{{ config('app.site_name')  }}</a> {{ __('All rights reserved') }}
        </p>
    </div>
</div>