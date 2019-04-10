<div class="footer__top">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="text-center footer__top-logo">
                    <a href="{{ route('homePage') }}"><img src="{{ asset('assets/logos/logo-footer.png') }}" alt="Gararat Logo" height="80"></a>
                </div>
                <!-- /.footer__top-logo -->
                <div class="text-center footer__top-slogan">
                    @if(App::isLocale('en'))
                        <p>GARARAT –the first e-hypermarket for agricultural tractors, equipment and spare parts!</p>
                    @else
                        <p class="text-right">جرارات هو اول سوق إليكترونى للجرارات الزراعية و المعدات وقطع الغيار</p>
                    @endif
                </div>
                <!-- /.footer__top-slogan -->
            </div>
            <!-- /.col-12 col-md-6 col-lg-3 -->
            <div class="col-12 col-md-6 col-lg-9">
                <div class="footer__top-menu">
                    <ul>
                        <li @if(in_array(\Request::route()->getName(), ['homePage'])) class="active" @endif>
                            <a href="{{ route('homePage') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('catalogPage', 1) }}">Equipment</a>
                        </li>
                        <li>
                            <a href="{{ route('catalogPage', 2) }}">Parts</a>
                        </li>
                        <li>
                            <a href="{{ route('servicesPage') }}">Service</a>
                        </li>
                        <li>
                            <a href="{{ route('newsPage') }}">News</a>
                        </li>
                        <li>
                            <a href="{{ route('contactsPage') }}">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- /.footer__top-menu -->
                <div class="text-right footer__top-phone">
                    <p>+20-101-620-05-99</p>
                </div>
                <!-- /.text-right footer__top-phone -->
            </div>
            <!-- /.col-12 col-md-6 col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<!-- /.footer__top -->
<div class="footer__bottom">
    <div class="container">
        <p><i class="far fa-copyright"></i> All rights reserved. Developed by <a href="https://www.protus.by" target="_blank">Protus</a>.</p>
    </div>
    <!-- /.container -->
</div>
<!-- /.footer__bottom -->
