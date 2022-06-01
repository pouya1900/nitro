@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.custom-og-twitter-html-meta')
    <title>افزودن آگهی | QiQoo سایت</title>
    <meta name="description" content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">

    <meta property="og:title" content="افزودن آگهی | QiQoo سایت"/>
    <meta property="og:url" content="{{route('ads.checkout')}}"/>
    <meta property="og:image" content="{{asset('assets/dashboard/img/logo.png')}}"/>
    <meta property="og:description"
          content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما"/>

    <meta property=twitter:title content="افزودن آگهی | QiQoo سایت">
    <meta property=twitter:description
          content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">
    <meta property=twitter:image content="{{asset('assets/dashboard/img/logo.png')}}">
    <meta property=twitter:site content="{{route('ads.checkout')}}">

    <link rel="canonical" href="{{route('ads.checkout')}}">
@endsection
@section('custom_head')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/index/plugins/dropify/css/dropify.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/index/plugins/leaflet/leaflet.css') }}"/>
    <script src="{{ asset('assets/index/plugins/leaflet/leaflet.js') }}"></script>
    <style>
        #mapid {
            height: 180px;
        }
    </style>
@endsection
@section('content')
    <section class="header-breadcrumb bgimage overlay overlay--dark">
        @include('v1.site.includes.top-menu')
        <div class="bg_image_holder"><img src="{{ asset('assets/index/img/breadcrumb1.jpg')}}" alt=""></div>
        <div class="breadcrumb-wrapper content_above">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="page-title">افزودن آگهی</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">خانه</a></li>
                                <li class="breadcrumb-item active" aria-current="page">افزودن آگهی</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div><!-- ends: .breadcrumb-wrapper -->

    </section>

    <section class="add-listing-wrapper border-bottom section-bg section-padding-strict">
        <div class="container">
            <form method="post" action="{{ route('ads.postCategory') }}">
                {{ csrf_field() }}
                <div id="app" class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="atbd_content_module">
                            <div class="atbd_content_module__tittle_area">
                                <div class="atbd_area_title">
                                    <h4><span class="la la-user"></span>انتخاب دسته بندی</h4>
                                </div>
                            </div>
                            <div class="atbdb_content_module_contents">
                                <div class="form-group">
                                    <label for="category_id" class="form-label">دسته بندی</label>
                                    <select id="category_id" name="category_id" class="form-control">
                                        <option disabled selected>انتخاب</option>
                                        @foreach($categories as $cat)
                                            <option
                                                value="{{ $cat->id }}" {{ (old('category_id')  == $cat->id ? "selected": "") }}>{{ $cat->shortTitle }}</option>
                                        @endforeach()
                                    </select>

                                    @if ($errors->has('category_id'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <strong>{{$errors->first('category_id')}}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div><!-- ends: .atbdb_content_module_contents -->
                        </div><!-- ends: .atbd_content_module -->

                        <div  class="btn_wrap list_submit m-top-25" style="float: right">
                            <a href="{{ route('index') }}" class="btn btn-primary btn-group-sm listing_submit_btn">انصراف</a>
                        </div>

                        <div  class="btn_wrap list_submit m-top-25" style="float: left; background: green">
                            <button type="submit" class="btn btn-primary btn-lg listing_submit_btn" style="background: green; border-color: green">ادامه</button>
                        </div>
                    </div><!-- ends: .col-lg-10 -->
                </div>
            </form>

        </div>
    </section><!-- ends: .add-listing-wrapper -->
@endsection
