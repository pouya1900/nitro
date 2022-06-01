@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.custom-og-twitter-html-meta')
    <title>آگهی {{$ads->shortTitle}} | QiQoo سایت</title>
    <meta name="description"
          content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">

    <meta property="og:title" content="{{$ads->shortTitle}} | QiQoo سایت"/>
    <meta property="og:url" content="{{route('ads.show', [$ads->id, $ads->urlTitle])}}"/>
    <meta property="og:image" content="{{asset('assets/dashboard/img/logo.png')}}"/>
    <meta property="og:description"
          content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما"/>

    <meta property=twitter:title content="{{$ads->shortTitle}} | QiQoo سایت">
    <meta property=twitter:description
          content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">
    <meta property=twitter:image content="{{asset('assets/dashboard/img/logo.png')}}">
    <meta property=twitter:site content="{{route('ads.show', ['id' => $ads->id, 'title' => $ads->urlTitle])}}">

    <link rel="canonical" href="{{route('ads.show', ['id' => $ads->id, 'title' => $ads->urlTitle])}}">
@endsection
@section('custom_head')
    <link rel="stylesheet" href="{{ asset('assets/index/plugins/leaflet/leaflet.css') }}"/>
@endsection

@section('content')
    <section class="header-breadcrumb bgimage overlay overlay--dark">
        @include('v1.site.includes.top-menu')
        <div class="bg_image_holder"><img src="{{ asset('assets/index/img/breadcrumb1.jpg')}}" alt=""></div>
        <div class="listing-info content_above">
            <div class="container">

                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <ul class="list-unstyled listing-info--badges">
                        </ul>
                        <ul class="list-unstyled listing-info--meta">

                            <li>
                                <div class="average-ratings">
                                    <span class="atbd_meta atbd_listing_rating">{{ $ads->scoreAverage }}<i
                                            class="la la-star"></i></span>
                                    <span class="atbd_meta ">{{ $ads->publishedCommentCount }} دیدگاه</span>
                                </div>
                            </li>
                            <li>
                                <div class="atbd_listing_category">
                                    <a href="{{ route('ads.category', $ads->category->id) }}"><img
                                            src="{{ $ads->logo['tiny'] }}" alt="{{$ads->category->title}}"
                                            title="{{ $ads->category->title }}"> {{ $ads->category->shortTitle }}</a>
                                </div>
                            </li>
                        </ul><!-- ends: .listing-info-meta -->

                        <h1>{{ $ads->shortTitle }}</h1>
                    </div>

                    @auth
                        <div
                            class="col-lg-4 col-md-5 d-flex align-items-end justify-content-start justify-content-md-end">
                            <div class="atbd_listing_action_area">
                                @if($ads->user_id == auth()->user()->id)
                                    <div class="atbd_action atbd_save">
                                        <div class="action_button">
                                            <a href="{{ route('ads.edit', $ads->id) }}" class="atbdp-favourites"><span
                                                    class="la la-pencil"></span>
                                                ویرایش</a>
                                        </div>
                                    </div>
                                @endif

                                {{--                                @if(!auth()->check() || $ads->user_id != auth()->user()->id)--}}
                                <div class="atbd_action atbd_report">
                                    <div class="action_button">
                                        <a href="#" data-toggle="modal"
                                           data-target="#atbdp-report-abuse-modal"><span
                                                class="la la-flag-o"></span> گزارش</a>
                                    </div>
                                </div>
                                {{--                                @endif--}}
                            </div>
                        </div>
                    @endauth

                </div>
            </div>


            {{--                                @if(!auth()->check() || $ads->user_id != auth()->user()->id)--}}
            <div class="modal fade" id="atbdp-report-abuse-modal" tabindex="-1" role="dialog" aria-hidden="true"
                 aria-labelledby="atbdp-report-abuse-modal-label">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form method="post" action="{{ route('report.store', $ads->id) }}"
                              id="atbdp-report-abuse-form" class="form-vertical">
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <h3 class="modal-title" id="atbdp-report-abuse-modal-label">گزارش سوءاستفاده</h3>
                                <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                @if(!empty($reportTypes->count()))
                                    <div class="form-group">
                                        <label for="report_type" class="not_empty">نوع گزارش<span
                                                class="atbdp-star">*</span></label>
                                        <select required class="form-control" id="report_type" name="report_type_id">
                                            <option selected disabled>انتخاب کنید</option>
                                            @foreach($reportTypes as $row)
                                                <option
                                                    value="{{ $row->id }}" {{ (old('report_type_id')  == $row->id ? "selected": "") }}>{{ $row->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="name" class="not_empty">نام شما<span
                                            class="atbdp-star">*</span></label>
                                    <input type="text" required class="form-control" id="name" name="name"
                                              placeholder="نام" {{ old('name') }}>
                                </div>
                                <div class="form-group">
                                    <label for="mobile" class="not_empty">موبایل<span
                                            class="atbdp-star">*</span></label>
                                    <input type="text" required class="form-control" id="mobile" name="mobile"
                                              placeholder="موبایل" value="{{ old('mobile') }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">ایمیل</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="ایمیل" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="report_text" class="not_empty">شکایت شما<span
                                            class="atbdp-star">*</span></label>
                                    <textarea required class="form-control" id="report_text" name="text" rows="4"
                                              placeholder="پیام...">{{ old('text') }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">بستن</button>
                                <button type="submit" class="btn btn-secondary btn-sm">تایید</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{--            @endif--}}

        </div><!-- ends: .listing-info -->

    </section>

    <section class="directory_listiing_detail_area single_area section-bg section-padding-strict">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if(count($errors))
                        <div class="alert alert-danger">
                            <p>لطفا قبل از ادامه ی کار خطاهای زیر را اصلاح کنید:</p>
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="atbd_content_module atbd_listing_details">
                        <div class="atbd_content_module__tittle_area">
                            <div class="atbd_area_title">
                                <h4><span class="la la-file-text-o"></span>جزئیات آگهی</h4>
                            </div>
                        </div>
                        @if(auth()->check() && $ads->user_id == auth()->user()->id)
                            <div class="atbdb_content_module_contents">
                                <p>وضعیت:
                                    @if(!empty($ads->published_at))
                                        <span style="color: green">منتشر شده در تاریخ
                                        {{ $ads->jalaliUserPublishedAt }}
                                        </span>
                                    @else <span style="color: red">در حال بررسی آگهی</span>
                                @endif
                            </div>
                        @endif
                        <div class="atbdb_content_module_contents">
                            <p>{{ $ads->description }}</p>
                            <p>{{ $ads->en_description }}</p>
                        </div>
                    </div><!-- ends: .atbd_content_module -->

                    <div class="atbd_content_module atbd_listing_gallery">
                        <div class="atbd_content_module__tittle_area">
                            <div class="atbd_area_title">
                                <h4><span class="la la-image"></span>گالری</h4>
                            </div>
                        </div>
                        @if(count($ads->contentImages))
                            <div class="atbdb_content_module_contents">
                                <div class="gallery-wrapper">
                                    <div class="gallery-images">
                                        @foreach($ads->contentImages as $row)
                                            <div class="single-image">
                                                <img src="{{ $row['large'] }}" alt="{{ $ads->title }}">
                                            </div>
                                        @endforeach
                                    </div><!-- ends: .gallery-images -->
                                    <div class="gallery-thumbs">
                                        <div class="single-thumb">
                                            <img src="{{ $ads->logo['large'] }}" alt="">
                                        </div>
                                    </div><!-- ends: .gallery-thumbs -->
                                </div><!-- ends: .gallery-wrapper -->
                            </div>
                        @else
                            <div class="atbdb_content_module_contents">
                                <div class="gallery-wrapper">
                                    <div class="gallery-images">
                                        <div class="single-image">
                                            <img src="{{ $ads->logo['large']  }}"
                                                 alt="{{ $ads->title }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if(count($ads->attributes))
                        <div class="atbd_content_module atbd_listing_features">
                            <div class="atbd_content_module__tittle_area">
                                <div class="atbd_area_title">
                                    <h4><span class="la la-list-alt"></span>ویژگی ها</h4>
                                </div>
                            </div>
                            <div class="atbdb_content_module_contents">
                                <ul class="atbd_custom_fields features-table">
                                    <!--  get data from custom field-->
                                    @foreach($ads->attributes as $row)
                                        <li>
                                            <div class="atbd_custom_field_title">
                                                <p>{{$row->description->title}}: </p>
                                            </div>
                                            <div class="atbd_custom_field_content">
                                                <p>{{ $row->value }} {{ $row->description->unit ? $row->description->unit->title : ''}}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!-- ends: .atbd_content_module -->
                    @endif

                    <div class="atbd_content_module atbd_contact_information_module">
                        <div class="atbd_content_module__tittle_area">
                            <div class="atbd_area_title">
                                <h4><span class="la la-headphones"></span>اطلاعات تماس</h4>
                            </div>
                        </div>
                        <div class="atbdb_content_module_contents">
                            <div class="atbd_contact_info">
                                <ul>
                                    @if($ads->address)
                                        <li>
                                            <div class="atbd_info_title"><span class="la la-map-marker"></span>آدرس:
                                            </div>
                                            <div class="atbd_info">{{ $ads->address }}</div>
                                        </li>
                                    @endif

                                    @if($ads->phone)
                                        <li>
                                            <div class="atbd_info_title"><span class="la la-phone"></span>شماره تلفن:
                                            </div>
                                            <div class="atbd_info">{{ $ads->phone }}</div>
                                        </li>
                                    @endif

                                    @if($ads->mobile)
                                        <li>
                                            <div class="atbd_info_title"><span class="la la-mobile"></span>شماره تلفن:
                                            </div>
                                            <div class="atbd_info">{{ $ads->mobile }}</div>
                                        </li>
                                    @endif

                                    @if($ads->email)
                                        <li>
                                            <div class="atbd_info_title"><span class="la la-envelope"></span>ایمیل:
                                            </div>
                                            <span class="atbd_info">{{ $ads->email }}</span>
                                        </li>
                                    @endif

                                    @if($ads->website)
                                        <li>
                                            <div class="atbd_info_title"><span class="la la-globe"></span>وبسایت:</div>
                                            <a href="#" class="atbd_info">{{ $ads->website }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="atbd_director_social_wrap">
                                @if($ads->facebook)<a target="_blank" href="{{ $ads->facebook }}"><span
                                        class="fab fa-facebook-f"></span></a>@endif
                                @if($ads->instagram)<a target="_blank" href="{{ $ads->instagram }}"><span
                                        class="fab fa-instagram"></span></a>@endif
                                @if($ads->twitter)<a target="_blank" href="{{ $ads->twitter }}"><span
                                        class="fab fa-twitter"></span></a>@endif
                                @if($ads->youtube)<a target="_blank" href="{{ $ads->youtube }}"><span
                                        class="fab fa-youtube"></span></a>@endif
                            </div>
                        </div>
                    </div><!-- ends: .atbd_content_module -->

                    @if(!empty($ads->video_link))
                        <div class="atbd_content_module atbd_custom_fields_contents">
                            <div class="atbd_content_module__tittle_area">
                                <div class="atbd_area_title">
                                    <h4><span class="la la-youtube-play"></span>ویدئو</h4>
                                </div>
                            </div>
                            <div class="atbdb_content_module_contents">
                                <div class="video-wrapper">
                                    <figure>
                                        <img src="{{ asset('uploads/ads/large_' . $ads->logo->first->path) }}"
                                             alt="{{ $ads->title }}">
                                        <figcaption>
                                            <a href="{{ $ads->video_link }}" class="video-iframe play-btn">
                                                <span class="la la-youtube-play"></span>
                                            </a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div><!-- ends: .atbd_content_module -->
                    @endif

                    <div class="atbd_content_module">
                        <div class="atbd_content_module__tittle_area">
                            <div class="atbd_area_title">
                                <h4><span class="la la-map-o"></span>مکان</h4>
                            </div>
                        </div>
                        <div class="atbdb_content_module_contents">
                            <div class="map" id="map" style="height: 440px; border: 1px solid #AAA;">
                            </div>
                        </div>
                    </div><!-- ends: .atbd_content_module -->

                    @if(empty($ads->publishedCommentCount))
                        <div class="atbd_content_module atbd_review_module">
                            <div class="atbd_content_module__tittle_area">
                                <div class="atbd_area_title">
                                    <h4>درباره این آگهی هنوز دیدگاهی ثبت نگردیده است</h4>
                                </div>
                            </div>
                        </div>
                    @else

                        <div class="atbd_content_module atbd_review_module">
                            <div class="atbd_content_module__tittle_area">
                                <div class="atbd_area_title">
                                    <h4><span class="la la-star-o"></span>{{ $ads->publishedCommentCount }}
                                        دیدگاه</h4>
                                </div>
                            </div>
                            <div class="atbdb_content_module_contents">
                                @foreach($ads->publishedComments as $row)
                                    <div id="client_review_list">
                                        <div class="atbd_single_review atbdp_static">
                                            <div class="atbd_review_top">
                                                <div class="atbd_avatar_wrapper">
                                                    <div class="atbd_review_avatar"><img alt="" src=""
                                                                                         class="avatar avatar-32 photo">
                                                    </div>
                                                    <div class="atbd_name_time">
                                                        <p>{{ $row->user->fullName ?? $row->name }}</p>
                                                        <span
                                                            class="review_time">{{ $row->jalaliCreatedAt }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review_content">
                                                <p>{{ $row->text }}</p>
                                            </div>
                                        </div><!-- ends: .atbd_single_review -->
                                    </div><!-- ends: .client_review_list -->
                                @endforeach
                            </div>
                        </div><!-- ends: .atbd_content_module -->
                    @endif

                    @if(!(auth()->check() && $ads->user_id == auth()->user()->id))
                        <div class="atbd_content_module atbd_review_form">
                            <div class="atbd_content_module__tittle_area">
                                <div class="atbd_area_title">
                                    <h4><span class="la la-star"></span>افزودن دیدگاه</h4>
                                    <label for="text" class="btn btn-secondary btn-icon-left btn-sm not_empty"><span
                                            class="la la-star-o"></span> افزودن دیدگاه</label>
                                </div>
                            </div>
                            <div class="atbdb_content_module_contents atbd_give_review_area" id="app">
                                <div class="atbd_notice alert alert-info" role="alert">
                                    <span class="la la-info" aria-hidden="true"></span>
                                    شماره همراه شما منتشر نخواهد شد و ایمیل اختیاری است.
                                </div><!-- ends: .atbd_notice -->

                                <form id="form" method="post"
                                      action="{{ route('comment.store', ['id' => $ads->id, 'type' => 'ads']) }}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        @if(count($errors))
                                            @foreach($errors->all() as $error)
                                                <p class="color-danger">{{ $error }}</p>
                                            @endforeach
                                        @endif
                                        @guest()
                                            <div class="col-md-12">
                                                <input name="name" value="{{ old('name') ?? '' }}" type="text"
                                                       placeholder="نام*" class="form-control m-bottom-30">
                                            </div>
                                            <div class="col-md-6">
                                                <input name="mobile" value="{{ old('mobile') ?? '' }}" type="number"
                                                       placeholder="موبایل*" class="form-control m-bottom-30">
                                            </div>
                                            <div class="col-md-6">
                                                <input name="email" type="email" value="{{ old('email') ?? '' }}"
                                                       placeholder="ایمیل" class="form-control m-bottom-30">
                                            </div>
                                        @endguest
                                        <div class="col-md-12">
                                                <textarea id="text" name="text" placeholder="متن شما"
                                                          class="form-control m-bottom-30">{{ old('text') }}</textarea>
                                            <button class="btn btn-gradient btn-gradient-one" type="submit"
                                                    id="atbdp_review_form_submit">ارسال دیدگاه
                                            </button> <!-- submit button -->
                                        </div>
                                    </div>
                                </form>
                            </div><!-- ends: .atbd_give_review_area -->
                        </div><!-- ends: .atbd_content_module -->
                    @endif
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0">

                    <div class="widget atbd_widget widget-card">
                        <div class="atbd_widget_title">
                            <h4><span class="la la-user"></span>اطلاعات کاربر</h4>
                        </div><!-- ends: .atbd_widget_title -->
                        <div class="widget-body atbd_author_info_widget">
                            <div class="atbd_avatar_wrapper">
                                <div class="atbd_review_avatar">
                                    <a href="{{ route('user.profile', [$ads->user->id, $ads->user->fullName]) }}"
                                       title="{{ $ads->user->fullName }}">
                                        <img src="{{ $ads->user->avatar['x-small'] }}"
                                             alt="{{ $ads->user->fullName ?? '' }}"
                                             class="media-object rounded-circle">
                                    </a>
                                </div>
                                <div class="atbd_name_time">
                                    <h4>{{ !empty($ads->user->profile->company) ? $ads->user->profile->company : $ads->user->fullName ?? '' }}
                                        <span class="verified" data-toggle="tooltip" data-placement="top"
                                              title="Verified"></span></h4>
                                    <span
                                        class="review_time">ارسال شده: {{ $ads->jalali_dif_created_at }}</span>
                                </div>
                            </div><!-- ends: .atbd_avatar_wrapper -->


                            <div class="atbd_widget_contact_info">
                                <ul>
                                    @if($ads->user->profile->address)
                                        <li>
                                            <span class="la la-map-marker"></span>
                                            <span
                                                class="atbd_info">{{ $ads->user->profile->address ?? '' }}</span>
                                        </li>
                                    @endif
                                    @if($ads->user->profile->phone)
                                        <li>
                                            <span class="la la-phone"></span>
                                            <span
                                                class="atbd_info">{{ $ads->user->profile->phone ?? '' }}</span>
                                        </li>
                                    @endif
                                    @if($ads->user->profile->email)
                                        <li>
                                            <span class="la la-envelope"></span>
                                            <span class="atbd_info">{{ $ads->user->profile->email ?? ''}}</span>
                                        </li>
                                    @endif
                                    @if($ads->user->profile->website)
                                        <li>
                                            <span class="la la-globe"></span>
                                            <a href="#"
                                               class="atbd_info">{{ $ads->user->profile->website ?? '' }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div><!-- ends: .atbd_widget_contact_info -->

                            <a href="{{ route('user.profile', [$ads->user->id, $ads->user->fullName]) }}"
                               class="btn btn-outline-primary btn-block">نمایش مشخصات کاربر</a>
                        </div><!-- ends: .widget-body -->
                    </div><!-- ends: .widget -->

                    <div class="widget atbd_widget widget-card">
                        <div class="atbd_widget_title">
                            <h4><span class="la la-bookmark"></span>دسته بندی ها</h4>
                        </div><!-- ends: /.atbd_widget_title -->
                        <div class="widget-body atbdp-widget-categories">
                            <ul class="atbdp_parent_category">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{route('ads.all-index',[$category->id, 'Category', $category->urlTitle])}}"><span
                                                class="la la-eject"></span>{{ $category->shortTitle }}
                                        </a>
                                        @if(count($category->childs))
                                            @include('v1.site.includes.hirechical-structure',['childs' => $category->childs])
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div><!-- ends: .atbdp -->
                    </div><!-- ends: .widget -->

                    <div class="widget atbd_widget widget-card">
                        <div class="atbd_widget_title">
                            <h4><span class="la la-list-alt"></span> آگهی های این دسته</h4>
                            <a href="{{route('ads.all-index',[$ads->category->id, 'Category', $category->urlTitle])}}">نمایش
                                همه</a>
                        </div><!-- ends: .atbd_widget_title -->
                        <div class="atbd_categorized_listings atbd_similar_listings">
                            @if(!empty($relatedAds->count()))
                                <ul class="listings">
                                    @foreach($relatedAds as $row)
                                        <li>
                                            <div class="atbd_left_img">
                                                <a href="{{ route('ads.show', ['id' => $row->id, 'title' => $row->urlTitle]) }}">
                                                    <img src="{{ $row->logo['tiny'] }}"
                                                         alt="{{$row->title}}" title="{{ $row->title }}">
                                                </a>
                                            </div>
                                            <div class="atbd_right_content">
                                                <div class="cate_title ">
                                                    <h4>
                                                        <a href="{{ route('ads.show', ['id' => $row->id, 'title' => $row->urlTitle]) }}">{{ $row->shortTitle }}</a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div> <!-- ends .atbd_similar_listings -->
                    </div><!-- ends: .widget -->


                    <div class="widget atbd_widget widget-card">
                        <div class="atbd_widget_title">
                            <h4><span class="la la-list-alt"></span> آگهی های محبوب</h4>
                            <a href="{{ route('ads.grid-index') }}">نمایش همه</a>
                        </div><!-- ends: .atbd_widget_title -->
                        <div class="atbd_categorized_listings atbd_popular_listings">
                            @if(!empty($topLikeAds->count()))
                                <ul class="listings">
                                    @foreach($topLikeAds as $row)
                                        <li>
                                            <div class="atbd_left_img">
                                                <a href="{{ route('ads.show',  ['id' => $row->id, 'title' => $row->urlTitle]) }}">
                                                    <img src="{{$row->logo['tiny'] }}" alt="{{$row->title}}"
                                                         title="{{ $row->shortTitle }}">
                                                </a>
                                            </div>
                                            <div class="atbd_right_content">
                                                <div class="cate_title">
                                                    <h4>
                                                        <a href="{{ route('ads.show',  ['id' => $row->id, 'title' => $row->urlTitle]) }}">{{ $row->shortTitle }}</a>
                                                    </h4>
                                                </div>
                                                <p class="directory_tag">
                                                    <span class="la la-glass" aria-hidden="true"></span>
                                                    <span><a
                                                            href="{{route('ads.all-index',[$row->category->id, 'Category', $row->category->urlTitle])}}">{{ $row->category->shortTitle }}</a></span>
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div> <!-- ends .atbd_similar_listings -->
                    </div><!-- ends: .widget -->

                </div>
            </div>
        </div>
    </section><!-- ends: .directory_listiing_detail_area -->

@endsection

@section('custom_script')
    <script src="{{ asset('assets/index/plugins/leaflet/leaflet.js') }}"></script>
    <script>
        var lat = {!! $ads->lat !!};
        var lon = {!! $ads->long !!};
        var map = L.map('map', {
            center: [lat, lon],
            minZoom: 15,
            zoom: 15
        });

        //Add a marker to show where you clicked.
        theMarker = L.marker([lat, lon]).addTo(map);
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            subdomains: ['a', 'b', 'c']
        }).addTo(map);

    </script>
@endsection
