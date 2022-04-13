@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.og-twitter-html-meta')
@endsection
@section('custom_head')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/index/plugins/dropify/css/dropify.css')}}"/>
@endsection
@section('content')

    <section class="header-breadcrumb bgimage overlay overlay--dark">
        @include('v1.site.includes.top-menu')
        <div class="bg_image_holder"><img src="{{ asset('assets/index/img/breadcrumb1.jpg')}}" alt=""></div>
        <div class="breadcrumb-wrapper content_above">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="page-title">داشبورد</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('index')}}">خانه</a></li>
                                <li class="breadcrumb-item active" aria-current="page">داشبورد</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div><!-- ends: .breadcrumb-wrapper -->

    </section>

    <section class="dashboard-wrapper section-bg p-bottom-70">
        <div class="dashboard-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dashboard-nav-area">
                            <ul class="nav" id="dashboard-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                       aria-controls="profile" aria-selected="false">پروفایل من</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="all-listings" data-toggle="tab" href="#listings"
                                       role="tab" aria-controls="listings" aria-selected="true">آگهی های من</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="faborite-listings" data-toggle="tab" href="#favorite"
                                       role="tab" aria-controls="favorite" aria-selected="false">آگهی موردعلاقه</a>
                                </li>
                            </ul>

                            <div class="nav_button">
                                <a href="{{ route('ads.create') }}" class="btn btn-primary"><span
                                        class="la la-plus"></span> افزودن آگهی</a>
                                <a href="{{ route('logout') }}" class="btn btn-secondary">خروج</a>
                            </div>
                        </div>
                    </div><!-- ends: .col-lg-12 -->
                </div>
            </div>
        </div><!-- ends: .dashboard-nav -->

        <div class="tab-content p-top-100" id="dashboard-tabs-content">

            @include('v1.site.pages.dashboard.sections.owner-ads')

            @include('v1.site.pages.dashboard.sections.profile')

            @include('v1.site.pages.dashboard.sections.bookmark-ads')

        </div>

    </section>

@endsection

@section('custom_script')
    <script src="{{asset('assets/index/plugins/dropify/js/dropify.js')}}"></script>

    <script>
        $(document).ready(function () {
            $(".dropify").dropify({
                messages: {
                    'default': 'با کشیدن و رها کردن فایل خود در این قسمت یا با کلیک کردن می توانید فایل خود را انتخاب کنید',
                    'replace': 'برای تعویض تصویر خود کلیک کنید',
                    'remove': 'حذف',
                    'error': 'متاسفانه مشکلی پیش آمده است.'
                },
                error: {
                    'fileSize': 'اندازه فایل خیلی زیاد است (حداکثر 2MB).',
                    'minWidth': 'The image width is too small (400px min).',
                    'maxWidth': 'The image width is too big (1080px max).',
                    'minHeight': 'The image height is too small (50px min).',
                    'maxHeight': 'The image height is too big (10px max).',
                    'imageFormat': 'The image format is not allowed (10 only).'
                }
            });
        });
    </script>

    @if(!empty(Session::get('dest')) && Session::get('dest') == 'ownerAds')
        <script>
            $(function() {
                $('#listings').modal('show');
            });
        </script>
    @endif

    @if(!empty(Session::get('dest')) && Session::get('dest') == 'profile')
        <script>
            $(function() {
                $('#profile').modal('show');
            });
        </script>
    @endif

    @if(!empty(Session::get('dest')) && Session::get('dest') == 'favoriteAds')
        <script>
            $(function() {
                $('#favorite').modal('show');
            });
        </script>
    @endif
@endsection
