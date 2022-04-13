@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.custom-og-twitter-html-meta')
    <title>{{$user->fullName}} | QiQoo سایت</title>
    <meta name="description" content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">

    <meta name="canonical" content="{{route('user.profile', [$user->id, $user->fullName])}}">
    <meta property="og:title" content="{{$user->fullName}} | QiQoo سایت"/>
    <meta property="og:url" content="{{route('user.profile', [$user->id, $user->fullName])}}"/>
    <meta property="og:image" content="{{asset('assets/dashboard/img/logo.png')}}"/>
    <meta property="og:description" content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما"/>

    <meta property=twitter:title content="{{$user->fullName}} | QiQoo سایت">
    <meta property=twitter:description content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">
    <meta property=twitter:image content="{{asset('assets/dashboard/img/logo.png')}}">
    <meta property=twitter:site content="{{route('user.profile', [$user->id, $user->fullName])}}">

    <link rel="canonical" href="{{route('user.profile', [$user->id, $user->fullName])}}">
@endsection
@section('custom_head')
	<style>
		.atbdb_content_module_contents div{
			margin-bottom: 3em;
		}
		.atbdb_content_module_contents div p {
			margin: 1em;
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
					<h1 class="page-title">پروفایل {{$user->fullName}}</h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('index') }}">خانه</a></li>
							<li class="breadcrumb-item active" aria-current="page">پروفایل کاربر</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div><!-- ends: .breadcrumb-wrapper -->

</section>


<section class="author-info-area section-padding-strict section-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="atbd_auhor_profile_area">
					<div class="atbd_author_avatar">
						<img src="{{ $user->avatar['large'] }}" alt="{{ $user->fullName }}">
						<div class="atbd_auth_nd">
							<h2>{{ $user->fullName }}</h2>
						</div>
					</div><!-- ends: .atbd_author_avatar -->

					<div class="atbd_author_meta">
						<div class="atbd_listing_meta">
							{{--<span class="atbd_meta atbd_listing_rating">4.5 <i class="la la-star"></i></span>--}}
							<p class="meta-info"><span>0{{--{{ count($user->adsComments()) }}--}}</span>بررسی</p>
						</div>
						<p class="meta-info"><span>{{ count($user->ads) }}</span>آگهی</p>
					</div><!-- ends: .atbd_author_meta -->
				</div><!-- ends: .atbd_auhor_profile_area -->
			</div><!-- ends: .col-lg-12 -->

			<div class="col-lg-8 col-md-7 m-bottom-30">
				<div class="atbd_author_module">
					<div class="atbd_content_module">
						<div class="atbd_content_module__tittle_area">
							<div class="atbd_area_title">
								<h4><span class="la la-user"></span>مشخصات</h4>
							</div>
						</div>
						<div class="atbdb_content_module_contents">
							<div>
								<h5>درباره کاربر:</h5>
								<p>{{$user->profile->about  ?: 'اطلاعاتی وارد نشده'}}</p>
								<p>{{$user->profile->en_about }}</p>
							</div>

							<div>
								<h5>اطلاعات شرکت:</h5>
								<p>{{$user->profile->company  ?: 'اطلاعاتی وارد نشده'}}</p>
								<p>{{$user->profile->en_company}}</p>
							</div>

							<div>
								<h5>پیشه و تخصص:</h5>
								<p>{{$user->profile->specialist  ?: 'اطلاعاتی وارد نشده'}}</p>
								<p>{{$user->profile->en_specialist}}</p>
							</div>
						</div>
					</div>
				</div><!-- ends: .atbd_author_module -->
			</div><!-- ends: .col-md-8 -->

			<div class="col-lg-4 col-md-5 m-bottom-30">
				<div class="widget atbd_widget widget-card">
					<div class="atbd_widget_title">
						<h4><span class="la la-phone"></span>اطلاعات تماس</h4>
					</div><!-- ends: .atbd_widget_title -->
					<div class="widget-body atbd_author_info_widget">


						<div class="atbd_widget_contact_info">
							<ul>
								<li>
									<span class="la la-map-marker"></span>
									<span class="atbd_info">{{ $user->profile->address ?: 'اطلاعاتی وارد نشده' }}</span>
								</li>
								<li>
									<span class="la la-phone"></span>
									<span class="atbd_info">{{ $user->profile->phone  ?: 'اطلاعاتی وارد نشده' }}</span>
								</li>
								<li>
									<span class="la la-envelope"></span>
									<span class="atbd_info">{{ $user->profile->email  ?: 'اطلاعاتی وارد نشده' }}</span>
								</li>
								<li>
									<span class="la la-globe"></span>
									<a href="#" class="atbd_info">{{ $user->profile->website  ?: 'اطلاعاتی وارد نشده' }}</a>
								</li>
							</ul>
						</div><!-- ends: .atbd_widget_contact_info -->


						<div class="atbd_social_wrap">
							@if($user->profile->facebook)
								<p><a href="{{ $user->profile->facebook }}"><span class="fab fa-facebook-f"></span></a></p>
							@endif

							@if($user->profile->twitter)
								<p><a href="{{ $user->profile->twitter }}"><span class="fab fa-twitter"></span></a></p>
							@endif

							@if($user->profile->linkedin)
								<p><a href="{{ $user->profile->linkedin }}"><span class="fab fa-linkedin-in"></span></a></p>
							@endif

							@if($user->profile->instagram)
								<p><a href="{{ $user->profile->instagram }}"><span class="fab fa-instagram"></span></a></p>
							@endif
						</div><!-- ends: .atbd_social_wrap -->
					</div><!-- ends: .widget-body -->
				</div><!-- ends: .widget -->
			</div><!-- ends: .col-lg-4 -->

			<div class="col-lg-12">
				<div class="atbd_author_listings_area m-bottom-30">
					<h1>آگهی های کاربر</h1>
{{--					<div class="atbd_author_filter_area">
						<div class="dropdown">
							--}}{{--<a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								فیلتر با دسته <span class="caret"></span>
							</a>--}}{{--

							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="#">رستوران</a>
								<a class="dropdown-item" href="#">آموزش</a>
								<a class="dropdown-item" href="#">رویداد</a>
								<a class="dropdown-item" href="#">غذا</a>
								<a class="dropdown-item" href="#">خدمات</a>
								<a class="dropdown-item" href="#">سفر</a>
								<a class="dropdown-item" href="#">سایر</a>
							</div>
						</div>
					</div>
				</div><!-- ends: .atbd_author_listings_area -->--}}
			</div>

				<div class="col-lg-12 order-lg-1 order-0">
					<div class="row">
						@if(count($user->activeAndPublishedAds))
							@foreach($user->activeAndPublishedAds as $row)
								<div class="col-sm-4">
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
	</div>
</section><!-- ends: .author-info-area -->

@endsection
