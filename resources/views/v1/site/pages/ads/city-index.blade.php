@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.custom-og-twitter-html-meta')
<title>دسته بندی شهرها | QiQoo سایت</title>
<meta name="description" content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">

<meta property="og:title" content="دسته بندی شهرها | QiQoo سایت"/>
<meta property="og:url" content="{{route('ads.city')}}"/>
<meta property="og:image" content="{{asset('assets/dashboard/img/logo.png')}}"/>
<meta property="og:description"
      content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما"/>

<meta property=twitter:title content="دسته بندی شهرها | QiQoo سایت">
<meta property=twitter:description
      content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">
<meta property=twitter:image content="{{asset('assets/dashboard/img/logo.png')}}">
<meta property=twitter:site content="{{route('ads.city')}}">

<link rel="canonical" href="{{route('ads.city')}}">
@endsection
@section('content')

<section class="header-breadcrumb bgimage overlay overlay--dark">
	@include('v1.site.includes.top-menu')
	<div class="bg_image_holder"><img src="{{ asset('assets/index/img/breadcrumb1.jpg')}}" alt=""></div>
	<div class="breadcrumb-wrapper content_above">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h1 class="page-title">انتخاب شهر</h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('index') }}">خانه</a></li>
							<li class="breadcrumb-item"><a href="{{ route('ads.grid-index') }}">آگهی ها</a></li>
							<li class="breadcrumb-item active" aria-current="page">مکان ها</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div><!-- ends: .breadcrumb-wrapper -->

</section>

<section class="section-padding-strict section-bg">
	<div class="atbd_location_grid_wrap">
		<div class="container">
			<div class="row">
				@if(count($cities))
					@foreach($cities as $row)
						<div class="col-lg-3 col-md-4 col-sm-6">
							<a href="{{ route('ads.all-index', [$row->id, 'City', str_replace(' ', '-', $row->title)])}}" class="atbd_location_grid">{{ $row->title }}</a>
						</div><!-- ends: .col-lg-3 -->
					@endforeach
				@endif
			</div>
		</div>
	</div><!-- ends: .atbd_location_grid_wrap -->
</section><!-- ends: section -->

@endsection
