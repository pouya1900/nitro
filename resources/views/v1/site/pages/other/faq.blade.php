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
					<h1 class="page-title">سوالات متداول</h1>
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

<section class="faq-wrapper section-padding border-bottom">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2>سوالات متداول شما</h2>
					<p>راهنمایی استفاده از امکانات سامانه</p>
				</div>
			</div><!-- ends: .col-lg-12 -->
			<div class="col-lg-12">
				<div class="faq-contents">
					<div class="atbd_content_module atbd_faqs_module">
						<div class="atbd_content_module__tittle_area">
							<div class="atbd_area_title">
								<h4><span class="la la-question-circle"></span>لیست سوالات متداول</h4>
							</div>
						</div>
						@if(count($faqs))
						<div class="atbdb_content_module_contents">
							<div class="atbdp-accordion">
								@foreach($faqs as $row)
									<div class="accordion-single selected">
										<h3 class="faq-title"><a href="#">{{ $row['q']}}</a></h3>
										<p class="ac-body" style="display: none;">{{ $row['a'] }}</p>
									</div>
								@endforeach
							</div>
						</div>
						@else
							<div class="atbdb_content_module_contents">
								<p>در حال حاضر اطلاعاتی وجود ندارد</p>
							</div>
						@endif
					</div><!-- ends: .atbd_content_module -->
				</div><!-- ends: .faq-contents -->
			</div><!-- ends: .col-lg-12 -->
		</div>
	</div>
</section><!-- ends: .faq-wrapper -->
@endsection
