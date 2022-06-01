@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.custom-og-twitter-html-meta')
<title>{{$blog->meta_title}} | QiQoo سایت</title>
<meta name="description" content="{{ $blog->meta_description }}">

<meta property="og:title" content="{{$blog->meta_title}} | QiQoo سایت"/>
<meta property="og:url" content="{{route('blog.show', [$blog->id, $blog->urlTitle])}}"/>
<meta property="og:image" content="{{asset('assets/dashboard/img/logo.png')}}"/>
<meta property="og:description" content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما"/>

<meta property=twitter:title content="{{$blog->meta_title}} | QiQoo سایت">
<meta property=twitter:description content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">
<meta property=twitter:image content="{{asset('assets/dashboard/img/logo.png')}}">
<meta property=twitter:site content="{{route('blog.show', [$blog->id, $blog->urlTitle])}}">

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
					<h1 class="page-title">{{ $blog->shortTitle }}</h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('index') }}">خانه</a></li>
							<li class="breadcrumb-item"><a href="{{ route('blog.index') }}">اخبار</a></li>
							<li class="breadcrumb-item active" aria-current="page">{{ $blog->shortTitle }}</li>
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
				<div class="post-details">
					<div class="post-head">
						<img style="width: 730px; height: 412px;" src="{{ $blog->logo['large'] }}" alt="{{ $blog->title }}" title="{{ $blog->title }}">
					</div>
					<div class="post-content">
						<div class="post-header">
							<h3>{{ $blog->shortTitle }}</h3>
							<ul class="list-unstyled">
								<li>{{ $blog->jalaliPublishedAt }}</li>
								<li>توسط: <a href="#">{{ Str::limit($blog->admin->fullName, 30, '(...)') }}</a></li>
								<li>در دسته: <a href="{{ route('blog.category-blog', ['category' => $blog->category->id, 'title' => $blog->category->urlTitle]) }}">{{ $blog->category->shortTitle }}</a></li>
								<li><a href="#">{{ $blog->publishedCommentCount }} دیدگاه</a></li>
								<li><a href="#">{{ $blog->viewCount }} بازدید</a></li>
							</ul>
						</div>
						<div class="post-body">
							{!! $blog->text !!}

						</div>
						<div class="post-body">
							{!! $blog->en_text !!}

						</div>
					</div>
				</div><!-- ends: .post-details -->
				<br>

                @if(!empty($relatedBlogs->count()))
				<div class="related-post m-top-60">
					<div class="related-post--title">
						<h3>پست های مرتبط</h3>
					</div>
					<div class="row">
						@foreach($relatedBlogs as $row)
							<div class="col-lg-4 col-sm-6">
								<div class="single-post">
									<img src="{{ $row->logo['large'] }}" alt="{{$row->title}}" title="{{ $row->shortTitle }}">
									<h6><a href="#">$row->shortTitle</a></h6>
									<p><span>{{ $row->jalaliPublishedAt }}</span> - در دسته:  <a href="{{ route('blog.category-blog', ['category' => $row->category->id, 'title' => $row->category->urlTitle]) }}">{{ $row->category->shortTitle }}</a></p>
								</div>
							</div>
						@endforeach
					</div>
				</div><!-- ends: .related-post -->
				@endif

                @if(empty($blog->publishedCommentCount))
                    <div class="comments-area m-top-60">
                        <div class="comment-title">
                            <h4>درباره این خبر هنوز دیدگاهی ثبت نگردیده است</h4>
                        </div>
                    </div>
                @else
				<div class="comments-area m-top-60">
					<div class="comment-title">
						<h3>{{ $blog->publishedCommentCount }} دیدگاه</h3>
					</div>

						<div class="comment-lists">
						<ul class="media-list list-unstyled">
							@foreach($blog->publishedComments as $comment)
								<li class="depth-1">
								<div class="media">
									<div>
										<a href="#" class="cmnt_avatar">
											<img src="{{ $comment->user->avatar['x-small'] }}" class="media-object rounded-circle">
										</a>
									</div>
									<div class="media-body">
										<div class="media_top">
											<div class="heading_left">
												<a href="#">
													<h6 class="media-heading">@if($comment->user) {{ $comment->user->full_name }} @else {{$comment->name}} @endif</h6>
												</a>
												<span>{{ $comment->jalaliCreatedAt }}</span>
											</div>
										</div>
										<p>{{$comment->text}}</p>
									</div>
								</div><!-- ends: .media -->
							</li><!-- ends: .depth-1 -->
							@endforeach
						</ul><!-- ends: .media-list -->
					</div><!-- ends: .comment-lists -->
				</div><!-- ends: .comment-area -->
                @endif

                @if(!(auth()->check() && $blog->admin_id == auth()->user()->id))
                    <div class="comment-form cardify m-top-60 margin-md-60 border">
					<div class="comment-title">
						<h3>ارسال دیدگاه</h3>
						<div class="atbd_notice alert alert-info" role="alert">
							<span class="la la-info" aria-hidden="true"></span>
							شماره همراه شما منتشر نخواهد شد و ایمیل اختیاری است.
						</div><!-- ends: .atbd_notice -->
					</div>

					<div class="comment_form_wrapper m-top-40">
						<form id="form" method="post" action="{{ route('comment.store', ['id' => $blog->id, 'type' => 'blog']) }}">
							{{ csrf_field() }}
							<div class="row">
								@if(count($errors))
									@foreach($errors->all() as $error)
										<p class="color-danger">{{ $error }}</p>
									@endforeach
								@endif
                                @guest()
								<div class="col-md-12">
									<input name="name" value="{{ old('name') ?? '' }}"  type="text" placeholder="نام*" class="form-control m-bottom-30">
									<p></p>
								</div>
								<div class="col-md-6">
									<input name="mobile" value="{{ old('mobile') ?? '' }}" type="number" placeholder="موبایل*" class="form-control m-bottom-30" required >
								</div>
								<div class="col-md-6">
									<input name="email" value="{{ old('email') ?? '' }}" type="email" placeholder="ایمیل" class="form-control m-bottom-30" >
								</div>
								@endguest
								<div class="col-md-12">
									<textarea id="text" name="text"  placeholder="دیدگاه شما" class="form-control m-bottom-30">{{ old('text') }}</textarea>
									<button class="btn btn-gradient btn-gradient-one" type="submit" id="atbdp_review_form_submit">ارسال دیدگاه</button> <!-- submit button -->
								</div>
							</div>
						</form>
					</div>
				</div><!-- ends: .comment-form -->
                @endif
			</div><!-- ends: .col-lg-8 -->

			@include('v1.site.includes.blog-left-side')

		</div>
	</div>
</section><!-- ends: .blog-area -->
@endsection

