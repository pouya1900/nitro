@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.custom-og-twitter-html-meta')
    <title>اخبار | QiQoo سایت</title>
    <meta name="description" content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">

    <meta property="og:title" content="اخبار | QiQoo سایت"/>
    <meta property="og:url" content="{{route('blog.index')}}"/>
    <meta property="og:image" content="{{asset('assets/dashboard/img/logo.png')}}"/>
    <meta property="og:description" content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما"/>

    <meta property=twitter:title content="اخبار | QiQoo سایت">
    <meta property=twitter:description content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">
    <meta property=twitter:image content="{{asset('assets/dashboard/img/logo.png')}}">
    <meta property=twitter:site content="{{route('blog.index')}}">

    <link rel="canonical" href="{{route('blog.index')}}">
@endsection
@section('content')

<section class="header-breadcrumb bgimage overlay overlay--dark">
	@include('v1.site.includes.top-menu')
	<div class="bg_image_holder"><img src="{{ asset('assets/index/img/breadcrumb1.jpg')}}" alt=""></div>
	<div class="breadcrumb-wrapper content_above">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h1 class="page-title">اخبار</h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('index') }}">خانه</a></li>
							<li class="breadcrumb-item active" aria-current="page">اخبار</li>
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
			<div class="col-md-8">
				<div class="blog-posts">
					@if(!empty($blogs->count()))
					@foreach($blogs as $blog)
						<div class="blog-single">
							<div class="card post--card post--card2 ">
								<figure>
                                    <a href="{{ route('blog.show', ['id' => $blog->id, 'title' => $blog->urlTitle]) }}"><img style="width: 730px; height: 420px" src="{{ $blog->logo['large'] }}"
                                         alt="{{$blog->title}}" title="{{ $blog->shortTitle }}"></a>
									<figcaption>
										<a href="#"><i class="la la-image"></i></a>
									</figcaption>
								</figure>
								<div class="card-body">
									<h3><a href="{{ route('blog.show', ['id' => $blog->id, 'title' => $blog->urlTitle]) }}">{{ $blog->shortTitle }}</a></h3>
									<ul class="post-meta list-unstyled">
										<li>{{ $blog->jalali_published_at }}</li>
										<li>توسط: <a href="#">{{ Str::limit($blog->admin->full_name, 30, '(...)') }}</a></li>
										<li>در دسته: <a href="{{ route('blog.category-blog', ['category' => $blog->category->id, 'title' => $blog->category->urlTitle]) }}">{{ $blog->category->shortTitle }}</a></li>
										<li><a href="#">{{$blog->publishedCommentCount}} نظر</a></li>
										<li><a href="#">{{$blog->viewCount}} بازدید</a></li>
									</ul>
									<p ><a class="blog-description-link" href="{{ route('blog.show', ['id' => $blog->id, 'title' => $blog->url_title]) }}" title="{{ $blog->title }}">{{ $blog->short_description }}</a></p>
								</div>
							</div><!-- End: .card -->

					</div><!-- ends: .blog-single -->
					@endforeach
						@else
						<div class="card-body">
							<p>در حال حاضر اطلاعاتی وجود ندارد</p>
						</div>
					@endif
				</div>

				<div class="m-top-50">

					<nav class="navigation pagination d-flex justify-content-center" role="navigation">
						<div class="nav-links">
							{{ $blogs->render() }}
						</div>
					</nav>

				</div>
			</div><!-- ends: .col-lg-8 -->

			@include('v1.site.includes.blog-left-side')

		</div>
	</div>
</section><!-- ends: .blog-area -->

@endsection
