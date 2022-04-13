@extends('errors.layout')
@section('backgroundImage')
    background: #F3EBF6 url({{ asset('assets/dashboard/img/403.jpg') }});
@endsection

@section('content')
    <p class="sign" align="center">خطای 403</p>
    <h3  class="sign" align="center" style="padding-bottom: 20px">عدم دسترسی لازم</h3>
@endsection