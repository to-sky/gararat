<div class="footer__top">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer__top-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/logos/logo-footer.png') }}" alt="Gararat Logo" height="80">
                    </a>
                </div>

                <div class="footer__top-slogan">
                    <p>{{ __('GARARAT – the first e-hypermarket for agricultural tractors, equipment and spare parts!') }}</p>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-9">
                <div class="footer__top-menu">
                    <ul>
                        @include('website.layouts.includes._menu')
                    </ul>
                </div>

                <div class="text-right footer__top-phone">
                    <p class="ltr">
                        <a href="tel:+201016200599" class="text-white">+20-101-620-05-99</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer__bottom">
    <div class="container">
        <p>&copy; 2019-{{ date('Y') }}
            <a href="{{ route('home') }}">Gararat.com</a> {{ __('All rights reserved') }}
        </p>
    </div>
</div>