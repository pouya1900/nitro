@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.og-twitter-html-meta')
@endsection
@section('content')
    <section class="about-wrapper bg-gradient-ps">
        @include('v1.site.includes.top-menu')
        <div class="about-intro content_above">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-6">
                        <h1>کسب و کار خود را قرار دهید خدمات مناسب را پیدا کنید</h1>
                        <{{--a href="https://www.youtube.com/watch?v=0C4fX_x_Vsg" class="video-iframe play-btn-two">
                            <span class="icon"><i class="la la-youtube-play"></i></span>
                            <span>پخش فیلم ما</span>
                        </a>--}}
                    </div>
                    <div class="col-lg-6 offset-lg-1 col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                        <img src="{{ asset('assets/index/img/about-illustration.png') }}" alt="درباره ما">
                    </div>
                </div>
            </div>
        </div><!-- ends: .about-intro -->
    </section><!-- ends: .intro-wrapper -->

    <section class="about-contents section-padding">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 contents-wrapper">
                    <div class="contents">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-sm-6">
                                <img src="{{ asset('assets/index/img/about-img1.png')}}" alt="درباره ما">
                            </div>
                            <div class="col-lg-6 offset-lg-1 col-sm-6 mt-5 mt-md-0">
                                <h1>درباره Qiqoo</h1>
                                <p>با استفاده از سامانه Qiqoo آگهی کسب و کار خود را برای افرادی که به دنبال آن هستند قرار دهید. همچنین کسب و کار مورد نظر خود را در سریعترین زمان ممکن پیدا کنید.</p>
                            </div>
                        </div>
                    </div><!-- ends: .contents -->
                    <div class="contents">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-sm-6">
                                <h1>چرا استفاده از <span> QiQoo </span></h1>
                                <ul class="list-unstyled list-features p-top-15">
                                    <li>
                                        <div class="list-count"><span>1</span></div>
                                        <div class="list-content">
                                            <h4>ثبت نام آسان</h4>
                                            <p>شما می توانید با انتخاب گزینه عضو شوید به راحتی در سامانه ثبت نام کرده و از مزایای آن بهره مند گردید</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-count"><span>2</span></div>
                                        <div class="list-content">
                                            <h4>تبلیغ آگهی و کسب و کار شما</h4>
                                            <p>با استفاده از سامانه Qiqoo می توانید هر نوع کالا و کسب و کار خود را تبلیغ کنید</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-count"><span>3</span></div>
                                        <div class="list-content">
                                            <h4>یافتن مناسب ترین کالا و خدمات</h4>
                                            <p>کالا و کسب و کار مناسب خود را در سریعترین زمان ممکن و با مقایسه با دیگر موارد، پیدا کنید</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 offset-lg-1 text-right col-sm-6 mt-5 mt-md-0">
                                <img src="{{ asset('assets/index/img/about-img2.png')}}" alt="درباره ما">
                            </div>
                        </div>
                    </div><!-- ends: .contents -->
                </div><!-- ends: .content-block -->

            </div>
        </div>
    </section><!-- ends: .about-contents -->

    <section class="counters-wrapper bg-gradient-pw section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>میلیون ها نفر</h1>
                    <p>هر روز برای تصمیم گیری و انتخاب خدمات مناسب از خانه خارج می شوند.</p>
                    <ul class="list-unstyled counter-items">
                        <li>
                            <p><span class="count_up">59</span>k+</p>
                            <span>آگهی</span>
                        </li>
                        <li>
                            <p><span class="count_up">23</span>k+</p>
                            <span>کاربر تأیید شده</span>
                        </li>
                        <li>
                            <p><span class="count_up">5</span>k+</p>
                            <span>کاربر جدید در هر ماه</span>
                        </li>
                        <li>
                            <p><span class="count_up">42</span>k+</p>
                            <span>بازدید کننده در هر ماه</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!-- ends: .counter-wrapper -->

{{--    <section class="testimonial-wrapper section-padding-strict">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>اعتماد توسط بیش از 4000+ کاربر</h2>
                        <p>در اینجا چیزی است که مردم در مورد دیرو می گویند</p>
                    </div>
                </div><!-- ends: .col-lg-12 -->

                <div class="testimonial-carousel owl-carousel">

                    <div class="carousel-single">
                        <div class="author-thumb">
                            <img src="img/tthumb1.jpg" alt="" class="rounded-circle">
                        </div>
                        <div class="author-info">
                            <h4>آرش خادملو</h4>
                            <span>تورنتو، کانادا</span>
                        </div>
                        <p class="author-comment">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز.</p>
                    </div><!-- ends: .carousel-single -->


                    <div class="carousel-single">
                        <div class="author-thumb">
                            <img src="img/tthumb1.jpg" alt="" class="rounded-circle">
                        </div>
                        <div class="author-info">
                            <h4>آرش خادملو</h4>
                            <span>تورنتو، کانادا</span>
                        </div>
                        <p class="author-comment">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز.</p>
                    </div><!-- ends: .carousel-single -->


                    <div class="carousel-single">
                        <div class="author-thumb">
                            <img src="img/tthumb1.jpg" alt="" class="rounded-circle">
                        </div>
                        <div class="author-info">
                            <h4>آرش خادملو</h4>
                            <span>تورنتو، کانادا</span>
                        </div>
                        <p class="author-comment">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز.</p>
                    </div><!-- ends: .carousel-single -->

                </div><!-- ends: .testimonial-carousel -->

            </div>
        </div>
    </section><!-- ends: .testimonial-wrapper -->

    <section class="clients-logo-wrapper border-top p-top-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="logo-carousel owl-carousel">
                        <div class="carousel-single">
                            <img src="img/cl1.png" alt="">
                        </div>
                        <div class="carousel-single">
                            <img src="img/cl2.png" alt="">
                        </div>
                        <div class="carousel-single">
                            <img src="img/cl3.png" alt="">
                        </div>
                        <div class="carousel-single">
                            <img src="img/cl4.png" alt="">
                        </div>
                        <div class="carousel-single">
                            <img src="img/cl5.png" alt="">
                        </div>
                        <div class="carousel-single">
                            <img src="img/cl1.png" alt="">
                        </div>
                    </div><!-- ends: .logo-carousel -->

                </div>
            </div>
        </div>
    </section><!-- ends: .clients-logo-wrapper -->

    <section class="subscribe-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h1>مشترک شدن در خبرنامه</h1>
                    <p>اشتراک برای دریافت به روز رسانی و اطلاعات. نگران نباشید، هرزنامه ارسال نخواهد شد!</p>
                    <form action="http://aazztech.com/" class="subscribe-form m-top-40">
                        <div class="form-group">
                            <span class="la la-envelope-o"></span>
                            <input type="text" placeholder="ایمیل خود را وارد کنید" required>
                        </div>
                        <button class="btn btn-gradient btn-gradient-one">ارسال</button>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- ends: .subscribe-wrapper -->--}}

@endsection
