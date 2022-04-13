@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.custom-og-twitter-html-meta')
    <title>لیست آگهی ها | QiQoo سایت</title>
    <meta name="description"
          content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">

    <meta property="og:title" content="لیست آگهی ها | QiQoo سایت"/>
    <meta property="og:url" content="{{route('ads.grid-index')}}"/>
    <meta property="og:image" content="{{asset('assets/dashboard/img/logo.png')}}"/>
    <meta property="og:description"
          content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما"/>

    <meta property=twitter:title content="لیست آگهی ها | QiQoo سایت">
    <meta property=twitter:description
          content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">
    <meta property=twitter:image content="{{asset('assets/dashboard/img/logo.png')}}">
    <meta property=twitter:site content="{{route('ads.grid-index')}}">

    <link rel="canonical" href="{{route('ads.grid-index')}}">
@endsection
@section('content')

    <section class="header-breadcrumb bgimage overlay overlay--dark">
        @include('v1.site.includes.top-menu')
        <div class="bg_image_holder"><img src="{{ asset('assets/index/img/breadcrumb1.jpg')}}" alt=""></div>
        <div class="breadcrumb-wrapper content_above">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="page-title">همه آگهی ها</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">خانه</a></li>
                                <li class="breadcrumb-item active" aria-current="page">همه آگهی ها</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div><!-- ends: .breadcrumb-wrapper -->
    </section>

    <section class="all-listing-wrapper section-bg">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="atbd_generic_header">
                        <div style="width: 100%">
                            <form method="get" action="{{ route('ads.grid-index') }}">
                                <input tabindex="100" style="float: right; width: 78%" name="st" type="text" placeholder="به دنبال چه چیزی هستید؟" class="form-control">
                                <input tabindex="99" type="submit" value="جستجو" style="float: left; width: 20%" class="btn btn-gradient btn-gradient-two ">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 order-lg-1 order-0">
                    @if(!empty($ads->count()))
                        <div class="row">
                            @foreach($ads as $row)
                                <div class="col-sm-3">
                                    <div class="atbd_single_listing ">
                                        @include('v1.site.includes.ads-block')
                                    </div>
                                </div><!-- ends: .col-md-6 -->
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <nav class="navigation pagination d-flex justify-content-end" role="navigation">
                                    <div class="nav-links">
                                        {{ $ads->render() }}
                                    </div>
                                </nav>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-lg-12">
                                <p> در حال حاضر اطلاعاتی وجود ندارد!</p>
                            </div>
                        </div>
                    @endif
                </div><!-- ends: .col-lg-8 -->
            </div>
        </div><!-- ends: .listing-items -->
    </section><!-- ends: .all-listing-wrapper -->

@endsection
