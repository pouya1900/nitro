@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.custom-og-twitter-html-meta')
    <title>دسته بندی {{$blogCategory->shortTitle}} | QiQoo سایت</title>
    <meta name="description" content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">

    <meta name="canonical" content="{{route('blog.category-blog', [$blogCategory->id, $blogCategory->title])}}">
    <meta property="og:title" content="اخبار | QiQoo سایت"/>
    <meta property="og:url" content="{{route('blog.category-blog', [$blogCategory->id, $blogCategory->title])}}"/>
    <meta property="og:image" content="{{asset('assets/dashboard/img/logo.png')}}"/>
    <meta property="og:description" content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما"/>

    <meta property=twitter:title content="اخبار | QiQoo سایت">
    <meta property=twitter:description content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">
    <meta property=twitter:image content="{{asset('assets/dashboard/img/logo.png')}}">
    <meta property=twitter:site content="{{route('blog.category-blog', [$blogCategory->id, $blogCategory->title])}}">

    <link rel="canonical" href="{{route('blog.category-blog', [$blogCategory->id, $blogCategory->title])}}">
@endsection
@section('content')

<section class="header-breadcrumb bgimage overlay overlay--dark">
	@include('v1.site.includes.top-menu')
	<div class="bg_image_holder"><img src="{{ asset('assets/index/img/breadcrumb1.jpg')}}" alt=""></div>
	<div class="breadcrumb-wrapper content_above">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h1 class="page-title">دسته {{ $blogCategory->shortTitle }}</h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('index') }}">خانه</a></li>
							<li class="breadcrumb-item active" aria-current="page">دسته بندی اخبار</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div><!-- ends: .breadcrumb-wrapper -->
</section>

<section class="blog-area blog-grid section-padding-strict section-bg">
	<div class="container">
		<div class="row">
			@if(!empty($blogs->count()))
			@foreach($blogs as $blog)
				<div class="col-lg-4 col-md-6">
				<div class="grid-single">
					<div class="card post--card shadow-sm">
						<figure>
							<a href="{{ route('blog.show', ['id' => $blog->id, 'title' => $blog->urlTitle]) }}"><img src="{{ $blog->logo['medium'] }}" alt="{{$blog->title}}" title="{{ $blog->title }}"></a>
						</figure>
						<div class="card-body">
							<h6><a href="{{ route('blog.show', ['id' => $blog->id, 'title' => $blog->urlTitle]) }}">{{ $blog->shortTitle }}</a></h6>
							<ul class="post-meta d-flex list-unstyled">
								<li>{{ $blog->jalali_published_at }}</li>
								<li>در دسته: <a href="{{ route('blog.category-blog', ['blogCategory' => $blogCategory->id, 'title' => $blogCategory->urlTitle]) }}">{{ $blogCategory->shortTitle }}</a></li>
							</ul>
							<p class="text-justify"><a class="blog-description-link" href="{{ route('blog.show', ['id' => $blog->id, 'title' => $blog->urlTitle]) }}" title="{{ $blog->title }}">{{ Str::limit($blog->short_description, 100, '(...)') }}</a></p>
						</div>
					</div><!-- End: .card -->

				</div>
			</div><!-- ends: .col-lg-4 -->
			@endforeach
			@else
			<div class="panel-body">
				<p>در حال حاضر اطلاعاتی وجود ندارد</p>
			</div>
			@endif
		</div>

		<div class="m-top-20">

			<nav class="navigation pagination d-flex justify-content-center" role="navigation">
				<div class="nav-links">
					{{ $blogs->render() }}
					{{--<a class="prev page-numbers" href="#"><span class="la la-long-arrow-right"></span></a>
					<a class="page-numbers" href="#">1</a>
					<span aria-current="page" class="page-numbers current">2</span>
					<a class="page-numbers" href="#">3</a>
					<a class="next page-numbers" href="#"><span class="la la-long-arrow-left"></span></a>--}}
				</div>
			</nav>

		</div>
	</div>
</section><!-- ends: .blog-area -->

@endsection
