@extends('errors.layout')
@section('backgroundImage')
    background: #F3EBF6 url({{ asset('assets/dashboard/img/400.jpg') }});
@endsection

@section('content')
    <p class="sign" align="center">خطای 400</p>
    <h3  class="sign" align="center" style="padding-bottom: 20px">ورود داده نامعتبر</h3>
@endsection