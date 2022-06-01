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
					<h2>شرایط و قوانین</h2>
					<p>شرایط استفاده از سامانه</p>
				</div>
			</div><!-- ends: .col-lg-12 -->
			<div class="col-lg-12">
				<div class="faq-contents">
					<div class="atbd_content_module atbd_faqs_module">
						<div class="atbd_content_module__tittle_area">
							<div class="atbd_area_title">
								<h4><span class="la la-question-circle"></span>شرایط و قوانین</h4>
                                <p style="text-align: justify">
                                    با ارسال یک آگهی در سایت qiqoo، مسئولیت حقوقی کامل مضمون آن و بررسی صحت و مطابقت آن با قوانین و یا اخلاق حسنه و عرف اسلامی به عهده شما خواهد بود، و در ضمن، شما پیشاپیش موافقت خود را با شرایط عنوان شده در زیر اعلام کرده‏ اید: هنگامی که یک آیتم را در سایت qiqoo وارد می‏کنید، فهرست‏ های شما به سایت‏ qiqoo ارسال می‏شود. فهرست شما ممکن است بر اساس حروف کلیدی یا دسته‏ بندی برای چند ساعت قابل جستجو نباشد (یا بعضی مواقع تا 24 ساعت)، بنابراین qiqoo نمی‏تواند مدت زمان دقیق فهرست‏ بندی را تعیین و تضمین کند. فهرست‏ بندی شما در نتایج جستجو نمایش داده می‏شود و نتایج آن، بستگی به فاکتورهای مشخص شامل فرمت فهرست ‏بندی، عنوان، زمان، کلمات کلیدی، قیمت و غیره دارد.
                                </p>
							</div>
						</div>
					</div><!-- ends: .atbd_content_module -->
				</div><!-- ends: .faq-contents -->
			</div><!-- ends: .col-lg-12 -->
		</div>
	</div>
</section><!-- ends: .faq-wrapper -->
@endsection
