@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.og-twitter-html-meta')
@endsection

@section('content')
    <section class="intro-wrapper bgimage overlay overlay--dark">
        @include('v1.site.includes.top-menu')
        <div class="bg_image_holder"><img src="{{asset('assets/index/img/intro.png')}}" alt="QIQOO"></div>
        <div class="directory_content_area">
            <div class="container">
                <div class="modal-content col-lg-8" style="margin: auto">
                    <div class="modal-header">
                        <h5 class="modal-title" id="signup_modal_label">
                            لطفا شماره موبایل خود را جهت دریافت کد فعالسازی وارد نمایید
                        </h5>
                    </div>
                    <div class="modal-body">
                        @if(count($errors))
                            @foreach($errors->all() as $error)
                                <p class="color-danger">{{ $error }}</p>
                            @endforeach
                        @endif
                        <form action="{{ route('login') }}" method="post" id="signup-form">
                            {{csrf_field()}}
                            <div style="width: 18%; float: left" class="form-group">
                                <select class="form-control" name="countryCode">
                                    @foreach($codes as $code)
                                        <option {{ $code == old('countryCode') ? 'selected' : '' }}>{{ $code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="width: 80%" class="form-group">
                                <input style="direction: ltr" type="number" name="mobile" value="{{ old('mobile') }}" class="form-control"
                                       placeholder="" required>
                            </div>
                            <button type="submit"
                                    class="form-control btn btn-block btn-lg btn-gradient btn-gradient-two">ورود
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
