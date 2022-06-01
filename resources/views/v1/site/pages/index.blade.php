@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.og-twitter-html-meta')
@endsection

@section('content')
    <section class="intro-wrapper bgimage overlay overlay--dark">
        @include('v1.site.includes.top-menu')
        <div class="bg_image_holder"><img src="{{asset('assets/index/img/intro.png')}}" alt=""></div>
        <div class="directory_content_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="search_title_area">
                            <h2 class="title">بهترین انتخاب ها را انجام دهید</h2>
                            <p class="sub_title">همه آگهی های مربوط به مشاغل، بنگاه ها، مراکز خرید، رستوران ها و هزاران
                                آگهی متنوع دیگر...</p>
                        </div><!-- ends: .search_title_area -->

                        <form action="{{ route('search-ads') }}" method="post" class="search_form">
                            {{ csrf_field() }}
                            <div class="atbd_seach_fields_wrapper">
                                <div class="single_search_field search_query">
                                    <input class="form-control search_fields" type="text" name="title"
                                           placeholder="جستجوی عنوان آگهی">
                                </div>

                                {{--<div class="single_search_field search_category">
                                    <select class="search_fields" id="at_biz_dir-category">
                                        <option value="">انتخاب یک دسته</option>
                                        <option value="automobile">خودرو</option>
                                        <option value="education">آموزش</option>
                                        <option value="event">رویداد</option>
                                    </select>
                                </div>--}}
                                <div class="single_search_field search_category">
                                    <select name="category" class="search_fields" id="at_biz_dir-category">
                                        <option selected value="">همه دسته ها</option>
                                        @if(!empty($adsCategories->count()))
                                            @foreach($adsCategories as $row)
                                                <option value="{{ $row->id}}">{{ $row->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="single_search_field search_location">
                                    <select name="city" class="search_fields" id="at_biz_dir-location">
                                        <option selected value="">همه مکان ها</option>
                                        @if(count($cities))
                                            @foreach($cities as $row)
                                                <option value="{{ $row->id}}">{{ $row->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="atbd_submit_btn">
                                    <button type="submit"
                                            class="btn btn-block btn-gradient btn-gradient-one btn-md btn_search">جستجو
                                    </button>
                                </div>
                            </div>
                        </form><!-- ends: .search_form -->
                        @if(!empty($adsFavoriteCategories->count()))
                            <div class="directory_home_category_area">
                                <ul class="categories">
                                    @foreach($adsFavoriteCategories as $row)
                                        <li>
                                            <a href="#">
                                                <span class="color-primary"><i class="la la-cutlery"></i></span>
                                                رستوران
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- ends: .directory_home_category_area -->
                        @endif
                    </div><!-- ends: .col-lg-10 -->
                </div>
            </div>
        </div><!-- ends: .directory_search_area -->

    </section><!-- ends: .intro-wrapper -->

    <section class="categories-cards section-padding-two">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>به دنبال چه چیزی می گردید؟</h2>
                        <p>سرویس مورد نظر خود را در سریعترین زمان پیدا کنید و یا خدماتی که ارایه می دهید برای دیگران به
                            نمایش بگذارید.</p>
                    </div>
                </div>
            </div>

            @if(!empty($adsHomeCategories->count()))
                <div class="row">
                    @foreach($adsHomeCategories as $row)
                        <div class="col-lg-4 col-sm-6">

                            <div class="category-single category--img">
                                <figure class="category--img4">
                                    <img src="{{ $row->logo['large'] }}" alt="{{$row->title}}"
                                         title="{{ $row->title }}">
                                    <figcaption class="overlay-bg">
                                        <a href="#" class="cat-box">
                                            <div>
                                                <div class="icon">
                                                    <span class="la la-cutlery"></span>
                                                </div>
                                                <h4 class="cat-name">{{ $row->title }}</h4>
                                                <span
                                                    class="badge badge-pill badge-success">{{ count($row->ads) }} آگهی</span>
                                            </div>
                                        </a>
                                    </figcaption>
                                </figure>
                            </div><!-- ends: .category-single -->

                        </div><!-- ends: .col -->
                    @endforeach
                </div>
            @endif
        </div>
    </section><!-- ends: .categories-cards -->

    <section class="listing-cards section-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>پربازدیدترین آگهی ها</h2>
                        <p>جستجوی آگهی های مختلف در سراسر بریتانیا</p>
                    </div>
                </div>

                <div class="listing-cards-wrapper col-lg-12">
                    <div class="row">
                        @if(!empty($topViewAds->count()))
                            @foreach($topViewAds as $row)
                                <div class="col-lg-4 col-sm-6">

                                    <div class="atbd_single_listing ">
                                        <article class="atbd_single_listing_wrapper">
                                            <figure class="atbd_listing_thumbnail_area">
                                                <div class="atbd_listing_image">
                                                    <a href="{{ route('ads.show',  [$row->id, 'dsf']) }}">
                                                        <img style="width: 349px; height: 219px;"
                                                             src="{{ $row->logo['large'] }}"
                                                             alt="{{$row->title}}" title="{{ $row->title }}">
                                                    </a>
                                                </div><!-- ends: .atbd_listing_image -->
                                                <div class="atbd_author atbd_author--thumb">
                                                    <a href="{{ route('user.profile', [$row->user->id, $row->user->fullName]) }}">
                                                        <img src="{{ $row->user->avatar['tiny'] }}"
                                                             alt="{{ $row->user->fullName }}">
                                                        <span class="custom-tooltip">{{ $row->user->fullName }}</span>
                                                    </a>
                                                </div>
                                                <div class="atbd_thumbnail_overlay_content">
                                                    <ul class="atbd_upper_badge">
                                                        @if($row->is_vip)
                                                            <li><span class="atbd_badge atbd_badge_featured">ویژه</span>
                                                            </li>@endif
                                                        @if($row->is_popular)
                                                            <li><span class="atbd_badge atbd_badge_popular">محبوب</span>
                                                            </li>@endif
                                                        @if($row->is_new)
                                                            <li><span class="atbd_badge atbd_badge_new">جدید</span>
                                                            </li>@endif
                                                    </ul><!-- ends .atbd_upper_badge -->
                                                </div><!-- ends: .atbd_thumbnail_overlay_content -->
                                            </figure><!-- ends: .atbd_listing_thumbnail_area -->

                                            <div class="atbd_listing_info">
                                                <div class="atbd_content_upper">
                                                    <h4 class="atbd_listing_title">
                                                        <a href="{{ route('ads.show',  ['id' => $row->id, 'title' => $row->urlTitle]) }}">{{ $row->shortTitle }}</a>
                                                    </h4>

                                                    <div class="atbd_listing_meta">
                                                        <span class="atbd_meta atbd_listing_rating">{{ $row->scoreAverage }}<i
                                                                class="la la-star"></i></span>

                                                        <a href="{{ route('ads.show',  [$row->id, $row->urlTitle]) }}" title="جزییات"><span
                                                                class="atbd_meta atbd_listing_price">نمایش جزییات</span></a>
                                                        {{--<span class="atbd_meta atbd_badge_open">اکنون باز</span>--}}

                                                    </div><!-- End atbd listing meta -->
                                                    <div class="atbd_listing_data_list">
                                                        <ul>
                                                            <li>
                                                                <p>
                                                                    <span
                                                                        class="la la-map-marker"></span>{{$row->city->title}}
                                                                    ، {{ $row->country->title }}</p>
                                                            </li>
                                                            <li>
                                                                <p><span class="la la-phone"></span>{{ $row->phone }}
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span
                                                                        class="la la-calendar-check-o"></span>{{ $row->jalaliUserCreatedAt }}
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </div><!-- End atbd listing meta -->

                                                </div><!-- end .atbd_content_upper -->

                                                <div class="atbd_listing_bottom_content">
                                                    <div class="atbd_content_left">
                                                        <div class="atbd_listing_category">
                                                            <a href="{{ route('ads.category', $row->category->id) }}"><span
                                                                    class="la la-list"></span>{{ $row->category->title }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <ul class="atbd_content_right">
                                                        <li class="atbd_count"><span
                                                                class="la la-eye"></span>{{ $row->viewCount }}</li>

                                                    </ul>
                                                </div><!-- end .atbd_listing_bottom_content -->
                                            </div><!-- ends: .atbd_listing_info -->
                                        </article><!-- atbd_single_listing_wrapper -->
                                    </div>

                                </div><!-- ends: .col-md-6 -->
                            @endforeach
                        @endif
                        <div class="col-lg-12 text-center m-top-20">
                            <a href="{{ route('ads.grid-index') }}" class="btn btn-gradient btn-gradient-two">نمایش
                                همه</a>
                        </div>
                    </div>
                </div><!-- ends: .listing-cards-wrapper -->

            </div>
        </div>
    </section><!-- ends: .listing-cards -->

    <section class="cta section-padding border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>چرا <span>QiQoo</span> برای کسب و کار شما مناسب است؟</h2>
                        <p>کاوش آگهی های محبوب در سراسر جهان</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <img src="{{ asset('assets/index/img/svg/illustration-1.svg') }}" alt="" class="svg">
                        </div>
                        <div class="col-lg-5 offset-lg-1 col-md-6 mt-5 mt-md-0">

                            <ul class="feature-list-wrapper list-unstyled">
                                <li>
                                    <div class="icon"><span class="circle-secondary"><i
                                                class="la la-check-circle"></i></span></div>
                                    <div class="list-content">
                                        <h4>آگهی رایگان</h4>
                                        <p>تبلیغ رایگان کسب و کار شما</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon"><span class="circle-success"><i class="la la-money"></i></span>
                                    </div>
                                    <div class="list-content">
                                        <h4>درآمدزایی با فروش محصول شما</h4>
                                        <p>با استفاده از سامانه QiQoo می توانید محصولات خود را به راحتی بفروشید</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon"><span class="circle-primary"><i
                                                class="la la-line-chart"></i></span>
                                    </div>
                                    <div class="list-content">
                                        <h4>تجارت خود را ارتقا دهید</h4>
                                        <p>هر نوع خدمت و سرویسی را در سامانه ارائه دهید یا می توانید از سرویس های موجود
                                            استفاده کنید</p>
                                    </div>
                                </li>
                            </ul><!-- ends: .feature-list-wrapper -->

                            <ul class="action-btns list-unstyled">
                                {{--<li><a href="#" class="btn btn-success">مشاهده قیمت گذاری ما</a></li>--}}
                                <li><a href="{{ route('ads.create') }}" class="btn btn-primary">درج آگهی</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- ends: .cta -->

    @if(!empty($topLikeBlogs->count()))
        <section class="places section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>سامانه اخبار Qiqoo</h2>
                            <p>آشنایی با اطلاعات کسب و کارهای مختلف</p>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="cat-places-wrapper">
                            @foreach($topLikeBlogs as $blog)
                                <div class="category-place-single">
                                    <figure>
                                        <a href="{{ route('blog.show', ['id' => $blog->id, 'title' => $blog->userTitle]) }}"><img
                                                style="width: 540px; height: 200px;" src="{{ $blog->logo['large'] }}"
                                                alt="{{ $blog->shortTitle }}"></a>
                                        <figcaption>
                                            <h3>{{ $blog->shortTitle }}</h3>
                                        </figcaption>
                                    </figure>
                                </div><!-- ends: .category-place-single -->
                            @endforeach
                        </div>

                    </div>

                </div>
            </div>
        </section><!-- ends: .places -->
    @endif
@endsection
