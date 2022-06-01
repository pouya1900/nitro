<!doctype html>
<html>
	<head>
		<title>nitroshop</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="description" content="ghooliof">
		<meta name="author" content="ghooliof">
		<meta name="keywords" content="ghooliof">
		<meta charset="utf-8">

		<!-- Bootstrap and styles -->
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/style.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/toastr.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/lity.css')}}" />
		{{--<link  rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"  integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">--}}

		{{--for clickable tr in tables--}}
		<style>
			tr.clickable-row {
				cursor: pointer;
			}
			span.field-force{
				color: #ff0000;
				padding-left: 0.5em;
			}
			span.field-description{
				padding-right: 0.5em;
			}
		</style>
		<!-- Fav and touch icons -->
		<link rel="shortcut icon" href="{{ asset('favicon.ico')}}">
		@yield('custom_style')
	</head>

	<body class="container-fluid">
		<!-- Main content -->
		<section class="main_content b#428bca">

			<!-- Header and top nav -->
			@include('v1.admin.layout.header')
			<!-- /End header and top nav -->

			<!-- side-panel and sidebar -->
			@include('v1.admin.layout.side-panel')
			<!-- end side-panel and sidebar -->

			<!-- content -->
			<section class="row clearfix">
				<div class="col-lg-12 col-xs-12 column b#f9f9f9" id="content">

					@yield('content')

				</div>
			</section>
			<!-- /End content -->

		</section>
		<!-- /End main content -->
		<!-- footer and loader -->
		@include('v1.admin.layout.footer-loader')
		<!-- end footer and loader -->
		@yield('custom_script')

	</body>
</html>
