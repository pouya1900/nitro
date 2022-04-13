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
						<h1 class="page-title">تماس با ما</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">خانه</a></li>
								<li class="breadcrumb-item active" aria-current="page">همه آگهی ها</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div><!-- ends: .breadcrumb-wrapper -->
	</section>

	<section class="contact-area section-bg p-top-100 p-bottom-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="widget atbd_widget widget-card contact-block">
						<div class="atbd_widget_title">
							<h4><span class="la la-envelope"></span> فرم تماس</h4>
						</div><!-- ends: .atbd_widget_title -->
						<div class="atbdp-widget-listing-contact contact-form">
							@guest
							<div class="comment-title">
								<div class="atbd_notice alert alert-info" role="alert">
									<span class="la la-info" aria-hidden="true"></span>
									شماره همراه شما منتشر نخواهد شد و ایمیل اختیاری است.
								</div><!-- ends: .atbd_notice -->
							</div>
							@endguest
							@if(count($errors))
								@foreach($errors->all() as $error)
									<p class="color-danger">{{ $error }}</p>
								@endforeach
							@endif
							<form method="post" action="{{ route('contact-us') }}" id="atbdp-contact-form" class="form-vertical" role="form">
								{{ csrf_field() }}
								@guest
								<div class="form-group">
									<input name="name" type="text" class="form-control" id="atbdp-contact-name" placeholder="نام" required="" value="{{ old('name') }}">
								</div>
								<div class="form-group">
									<input name="mobile" type="number" class="form-control" id="atbdp-contact-name" placeholder="شماره همراه" required="" value="{{ old('mobile') }}">
								</div>
								<div class="form-group">
									<input name="email" type="email" class="form-control" id="atbdp-contact-email" placeholder="ایمیل" value="{{ old('email') }}">
								</div>
								@endguest
								<div class="form-group">
									<input name="title" type="text" class="form-control" id="atbdp-contact-title" placeholder="عنوان پیام" required="" value="{{ old('title') }}">
								</div>
								<div class="form-group">
									<textarea name="text" class="form-control" id="atbdp-contact-message" rows="6" placeholder="پیام" required="">{{ old('text') }}</textarea>
								</div>
								<button type="submit" class="btn btn-gradient btn-gradient-one btn-block">ارسال پیام</button>
							</form>
						</div><!-- ends: .atbdp-widget-listing-contact -->
					</div><!-- ends: .widget -->
				</div><!-- ends: .col-lg-8 -->
				<div class="col-lg-4">
					<div class="widget atbd_widget widget-card">
						<div class="atbd_widget_title">
							<h4><span class="la la-phone"></span>اطلاعات تماس</h4>
						</div><!-- ends: .atbd_widget_title -->
						<div class="widget-body atbd_author_info_widget">
							<div class="atbd_widget_contact_info">
								<ul>
									<li>
										<span class="la la-map-marker"></span>
										<span class="atbd_info">25 شرق خیابان ریچارد، لندن</span>
									</li>
									<li>
										<span class="la la-phone"></span>
										<span class="atbd_info">(44) 995-7799</span>
									</li>
									<li>
										<span class="la la-envelope"></span>
										<span class="atbd_info">support@quqooapp.com</span>
									</li>
									<li>
										<span class="la la-globe"></span>
										<a href="#" class="atbd_info">www.qiqoo.com</a>
									</li>
								</ul>
							</div><!-- ends: .atbd_widget_contact_info -->


							<div class="atbd_social_wrap">
								<p><a href="#"><span class="fab fa-facebook-f"></span></a></p>
								<p><a href="#"><span class="fab fa-twitter"></span></a></p>
								<p><a href="#"><span class="fab fa-google-plus-g"></span></a></p>
								<p><a href="#"><span class="fab fa-linkedin-in"></span></a></p>
								<p><a href="#"><span class="fab fa-dribbble"></span></a></p>
							</div><!-- ends: .atbd_social_wrap -->
						</div><!-- ends: .widget-body -->
					</div><!-- ends: .widget -->
				</div><!-- ends: .col-lg-4 -->
			</div>
		</div>
	</section><!-- ends: .contact-area -->

@endsection
