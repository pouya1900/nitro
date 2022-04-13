@extends('errors.layout')
@section('backgroundImage')
	background: #F3EBF6 url({{ asset('assets/dashboard/img/404.jpg') }});
@endsection

@section('content')
	<p class="sign" align="center">خطای 404</p>
	<h3  class="sign" align="center" style="padding-bottom: 20px">صفحه موردنظر وجود ندارد</h3>
@endsection