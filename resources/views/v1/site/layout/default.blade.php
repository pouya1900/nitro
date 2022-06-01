<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta lang="fa" xml:lang="fa">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
@yield('og-twitter-html-tags')

<!-- inject:css-->
    <link rel="stylesheet" href="{{ asset('assets/index/css/plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/index/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/index/css/custom-style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/index/css/toastr.css')}}"/>

    <!-- endinject -->
    <link rel="icon" sizes="32x32" href="{{ asset('favicon.ico')}}">

    @yield('custom_head')
</head>
<body>
@yield('content')
<footer class="footer-three footer-grey p-top-95">
    <div class="footer-top p-bottom-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-sm-6">

                    <div class="widget widget_pages">
                        <h2 class="widget-title">اطلاعات Qiqoo</h2>

                        <ul class="list-unstyled">

                            <li class="page-item"><a href="{{ route('about-us') }}">درباره ما</a></li>

                            <li class="page-item"><a href="{{ route('contact-us')  }}">تماس با ما</a></li>

                            <li class="page-item"><a href="{{ route('terms') }}">قوانین سایت</a></li>

                            <li class="page-item"><a href="{{ route('contact-us') }}">پشتیبانی</a></li>

                            <li class="page-item"><a href="{{ route('about-us') }}">مزایا</a></li>

                        </ul>
                    </div>

                </div><!-- ends: .col-lg-3 -->
                <div class="col-lg-3 d-flex justify-content-lg-center  col-sm-6">

                    <div class="widget widget_pages">
                        <h2 class="widget-title">لینک های مفید</h2>
                        <ul class="list-unstyled">

                            <li class="page-item"><a href="{{ route('ads.grid-index') }}">آگهی ها</a></li>

                            <li class="page-item"><a href="{{ route('blog.index') }}">اخبار</a></li>

                            <li class="page-item"><a href="{{ route('ads.create') }}">آگهی جدید</a></li>

                            <li class="page-item"><a href="{{ route('faq') }}">سوالات متداول</a></li>

                            <li class="page-item"><a href="#">برنامه QiQoo</a></li>


                            {{--<li class="page-item"><a href="#">بسته ها</a></li>--}}

                        </ul>
                    </div>

                </div><!-- ends: .col-lg-3 -->
                <div class="col-lg-3 col-sm-6">

                    <div class="widget widget_social">
                        <h2 class="widget-title">تماس با ما</h2>

                        <ul class="list-unstyled social-list">
                            <li><a href="{{ route('contact-us') }}"><span class="mail"><i
                                            class="la la-envelope"></i></span> پشتیبانی تماس</a>
                            </li>
                            <li><a href="#"><span class="twitter"><i class="fab fa-twitter"></i></span> توییتر</a></li>
                            <li><a href="#"><span class="facebook"><i class="fab fa-facebook-f"></i></span> فیسبوک</a>
                            </li>
                            <li><a href="#"><span class="instagram"><i class="fab fa-instagram"></i></span>
                                    اینستاگرام</a></li>
                            {{--<li><a href="#"><span class="gplus"><i class="fab fa-google-plus-g"></i></span> گوگل+</a>
                            </li>--}}
                        </ul>

                    </div><!-- ends: .widget -->

                </div><!-- ends: .col-lg-3 -->
                <div class="col-lg-4 col-sm-6">

                    <div class="widget widget_text">
                        <h2 class="widget-title">QiQoo روی موبایل</h2>
                        <div class="textwidget">
                            <p>برنامه QiQoo را دانلود کنید، و کسب و کار خود را به اشتراک بگذارید.</p>
                            <ul class="list-unstyled store-btns">
                                <li><a href="#"
                                       class="btn-gradient btn-gradient-two btn btn-md btn-icon icon-left"><span
                                            class="fab fa-apple"></span> اپ استور</a></li>
                                <li><a href="#" class="btn btn-dark btn-md btn-icon btn-icon"><span
                                            class="fab fa-android"></span> گوگل پلی</a></li>
                            </ul>
                        </div>
                    </div><!-- ends: .widget -->

                </div><!-- ends: .col-lg-3 -->
            </div>
        </div>
    </div><!-- ends: .footer-top -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-bottom--content">
                        <a href="#" class="footer-logo"><img src="{{asset('assets/index/img/logo.png')}}" alt=""></a>
                        <p class="m-0 copy-text"> تمامی حقوق متعلق به تیم برنامه نویسی<a href="#"> QiQoo</a> می باشد</p>
                        <ul class="list-unstyled lng-list">
                            <li><a href="{{route('index')}}">QiQoo</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- ends: .footer-bottom -->
</footer><!-- ends: .footer -->

@include('v1.site.includes.auth-modals')

<!-- inject:js-->
<script src=" {{ asset('assets/index/js/plugins.min.js') }}"></script>
<script src=" {{ asset('assets/index/js/script.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/dashboard/js/pack-2.js') }}"></script>
<script src="{{asset('assets/index/ajax/search.js')}}"></script>
@include('v1.site.includes.toast')

<!-- endinject-->
@yield('custom_script')

</body>

</html>
