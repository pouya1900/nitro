<!-- Header and top nav -->
<header class="top-navbar row dark">

	<!-- Header top help panel -->
	<div id="top_panel">
		<div class="help-text b#fff clearfix">
			<div class="col-sm-3 shortcut-help">
				<h4>کلیدهای میانبر</h4>
				<p>M - منو</p>
				<p>R - پنل سمت چپ</p>
				<p>T - پنل بالا</p>
				<p>N - حالت شب</p>
				<p>B - حالت جعبه ای</p>
				<p>V - منوی عمودی</p>
				<p>H - منوی افقی</p>
			</div>

			<div class="col-sm-9 b#89c4f4 b%5">
				<h4>راهنمای پنل</h4>
				کلید های میانبر برای دسترسی سریعتر به تنظیمات پنل به کار میروند که در سمت راست مشاهده می کنید.<br/>
				همچنین می توانید از قسمت پنل سریع که در گوشه سمت چپ قسمت بالای پنل تعبیه شده است برای <br/>دسترسی به تنظیماتی از جمله رنگ منو، تصاویر پس زمینه و ... استفاده کنید.<br/>

			</div>
		</div>
	</div>
	<!-- /End Header top help panel -->


	<!-- Header buttons and navbar -->
	<nav id="first-navbar" class="navbar-inverse">

	    <div class="navbar-header">
			<button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav_1">
				<span class="fa fa-bars fa-2x"></span>
			</button>

			<!-- Sidebar toggle button -->
			<i id="sidebar_toggle" class="fa fa-outdent pull-left" tooltip title="تغییر وضعیت منو" data-placement="left"></i>
	    </div>

	    <div class="collapse navbar-collapse" id="nav_1">

		    <ul class="nav navbar-nav">

				<!-- Creat new -->
				<li>
					<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-plus"></i> افزودن <span class="caret"></span>
					</a>
					<ul id="panels_to_scroll" class="dropdown-menu">
						<li><a href="{{route('admin.product.create')}}"><i class="fa fa-music"></i>محصول</a></li>
					</ul>
				</li>
				<!-- /End Creat new -->

				<!-- Panel manager -->
				<li id="find_panels">
					<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						مدیریت پنل <span class="caret"></span>
					</a>
					<ul id="all_panels" class="dropdown-menu">
						<!-- Fill with jQuery -->
					</ul>
				</li>
				<!-- /End Panel manager -->
      		</ul>

			<ul class="nav navbar-right">

				<!-- side panel toggle -->
				<i id="side_panel_toggle" class="fa fa-bolt t#4EAEFF" data-placement="right" tooltip title="پنل سریع"></i>

				<!-- top hidden panel -->
				<i id="top_panel_slide" class="fa fa-question-circle-o" data-placement="right" tooltip title="پنل راهنمایی"></i>

			</ul>
	    </div>
    </nav>
    <!-- End header buttons and navbar -->
</header>
<!-- /End header and top nav -->
