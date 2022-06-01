@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.og-twitter-html-meta')
@endsection
@section('content')

    <section class="header-breadcrumb bgimage overlay overlay--dark">
        @include('v1.site.includes.top-menu')
        <div class="bg_image_holder"><img src="{{ asset('assets/index/img/breadcrumb1.jpg')}}" alt=""></div>
        <div class="breadcrumb-wrapper content_above">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="page-title">پیام QiQoo</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">خانه</a></li>
                                <li class="breadcrumb-item active" aria-current="page">پیام</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div><!-- ends: .breadcrumb-wrapper -->

    </section>

    <section class="blog-area section-padding-strict border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="text-align: center">{{$msg}}</h2>
                    <br>
                    <br>
                    <p></p><a href="{{ url()->previous() }}"><i class="la la-forward"></i> بازگشت</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
