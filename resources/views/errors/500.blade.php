@extends('errors.layout')
@section('backgroundImage')
    background: #F3EBF6 url({{ asset('assets/dashboard/img/500.jpg') }});
@endsection

@section('content')
    <p class="sign" align="center">خطای 500</p>
    <h3  class="sign" align="center" style="padding-bottom: 20px">بروز خطا در سرور</h3>
@endsection