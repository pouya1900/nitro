@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.custom-og-twitter-html-meta')
<title>دسته بندی آگهی ها | QiQoo سایت</title>
<meta name="description" content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">

<meta property="og:title" content="دسته بندی آگهی ها | QiQoo سایت"/>
<meta property="og:url" content="{{route('ads.category')}}"/>
<meta property="og:image" content="{{asset('assets/dashboard/img/logo.png')}}"/>
<meta property="og:description"
      content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما"/>

<meta property=twitter:title content="دسته بندی آگهی ها | QiQoo سایت">
<meta property=twitter:description
      content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">
<meta property=twitter:image content="{{asset('assets/dashboard/img/logo.png')}}">
<meta property=twitter:site content="{{route('ads.category')}}">

<link rel="canonical" href="{{route('ads.category')}}">
@endsection
@section('content')

    <section class="header-breadcrumb bgimage overlay overlay--dark">
        @include('v1.site.includes.top-menu')
        <div class="bg_image_holder"><img src="{{ asset('assets/index/img/breadcrumb1.jpg')}}" alt=""></div>
        <div class="breadcrumb-wrapper content_above">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="page-title">دسته بندی ها</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">خانه</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('ads.grid-index') }}">آگهی ها</a></li>
                                <li class="breadcrumb-item active" aria-current="page">دسته بندی ها</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div><!-- ends: .breadcrumb-wrapper -->

    </section>

    <section class="section-padding-1_7 border-bottom">
        <div class="container">
            @if($categories->count())
            <div class="row">
                    @foreach($categories as $row)
                        <div class="col-lg-4 col-sm-6">
                            <div class="category-single category--img">
                                <figure class="category--img4">
                                    <img src="{{ $row->logo['large'] }}" alt="{{$row->title}}" title="{{ $row->title }}">
                                    <figcaption class="overlay-bg">
                                        <a href="{{ route('ads.all-index', [$row->id, 'Category', $row->urlTitle]) }}"
                                           class="cat-box">
                                            <div>
                                                <h4 class="cat-name">{{ $row->shortTitle }}</h4>
                                                <span class="badge badge-pill badge-success">{{ $row->ads->count() }} آگهی</span>
                                            </div>
                                        </a>
                                    </figcaption>
                                </figure>
                            </div><!-- ends: .category-single -->
                        </div><!-- ends: .col -->
                    @endforeach
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <nav class="navigation pagination d-flex justify-content-center" role="navigation">
                        <div class="nav-links">
                            {{ $categories->render() }}
                        </div>
                    </nav>

                </div>
            </div>

            @else
                <div class="row">
                    <div class="col-lg-12">
                        <p>در حال حاضر اطلاعاتی وجود ندارد!</p>
                    </div>
                </div>
            @endif

        </div>
    </section><!-- ends: section -->

@endsection
