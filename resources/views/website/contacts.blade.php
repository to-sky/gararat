@extends('layouts.app')

@section('content')
    <div class="container" style="min-height: 400px; margin-bottom: 30px;">
        <h1 class="page-title">{{ $pageTitle }}</h1>
        <div class="row contacts">
            <div class="col-12 col-lg-6">
                <div class="contacts__info">
                    @if(App::isLocale('en'))
                        {!! $page->pg_body !!}
                    @else
                        {!! $page->pg_body_ar !!}
                    @endif
                </div>
                <!-- /.contacts__info -->
            </div>
            <!-- /.col-12 col-lg-6 -->
            <div class="col-12 col-lg-6">
                <div class="contacts__form">
                    <h3>
                        @if(App::isLocale('en'))
                            Contact Us
                        @else
                            اتصل بنا
                        @endif
                    </h3>
                    <form action="" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="name">
                                    @if(App::isLocale('en'))
                                        Name*
                                    @else
                                        اسم*
                                    @endif
                                </label>
                                <input type="text" name="name" id="name" required>
                            </div>
                            <!-- /.col-12 -->
                        </div>
                        <!-- /.form-group row -->
                        <div class="form-group row">
                            <div class="col-12 col-lg-6">
                                <label for="email">
                                    @if(App::isLocale('en'))
                                        Email*
                                    @else
                                        البريد الإلكتروني*
                                    @endif
                                </label>
                                <input type="email" name="email" id="email" required>
                            </div>
                            <!-- /.col-12 col-lg-6 -->
                            <div class="col-12 col-lg-6">
                                <label for="phone">
                                    @if(App::isLocale('en'))
                                        Phone*
                                    @else
                                        هاتف*
                                    @endif
                                </label>
                                <input type="text" name="phone" id="phone" required>
                            </div>
                            <!-- /.col-12 col-lg-6 -->
                        </div>
                        <!-- /.form-group row -->
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="message">
                                    @if(App::isLocale('en'))
                                        Message*
                                    @else
                                        رسالة*
                                    @endif
                                </label>
                                <textarea name="message" id="message" required></textarea>
                            </div>
                            <!-- /.col-12 -->
                        </div>
                        <!-- /.form-group row -->
                        <div class="form-group row">
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">
                                    @if(App::isLocale('en'))
                                        Send
                                    @else
                                        إرسال
                                    @endif
                                </button>
                                <!-- /.btn btn-primary -->
                            </div>
                            <!-- /.col-12 -->
                        </div>
                        <!-- /.form-group row -->
                    </form>
                </div>
                <!-- /.contacts__form -->
            </div>
            <!-- /.col-12 col-lg-6 -->
            <div class="col-12">
                <div class="contacts__map">
                    <h3>
                        @if(App::isLocale('en'))
                            Map
                        @else
                            خريطة
                        @endif
                    </h3>
                    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A321f80a1403148c2e7eff608823556f9cfbc1bec2bfb0d2bb6fbd083758e858d&amp;width=100%&amp;height=400&amp;lang=en_GB&amp;scroll=true"></script>
                </div>
                <!-- /.contacts__map -->
            </div>
            <!-- /.col-12 -->
        </div>
        <!-- /.row contacts -->
    </div>
    <!-- /.container -->
@endsection
