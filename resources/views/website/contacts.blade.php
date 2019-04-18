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
                    <form action="{{ route('sendContactsMail') }}" method="post" autocomplete="off">
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
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d863.6868215099953!2d31.411449829250078!3d30.015411998868327!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzDCsDAwJzU1LjUiTiAzMcKwMjQnNDMuMiJF!5e0!3m2!1sru!2seg!4v1555091379312!5m2!1sru!2seg" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <!-- /.contacts__map -->
            </div>
            <!-- /.col-12 -->
        </div>
        <!-- /.row contacts -->
    </div>
    <!-- /.container -->
@endsection
