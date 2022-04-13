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
                            لطفا کد موقت دریافتی را وارد نمایید
                        </h5>
                    </div>
                    <div class="modal-body">
                        @if(count($errors))
                            @foreach($errors->all() as $error)
                                <p class="color-danger">{{ $error }}</p>
                            @endforeach
                        @endif
                        <form action="{{ route('postLoginCode', $mobile) }}" method="post" id="signup-form">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="number" name="activationCode" value="{{ old('activationCode') }}" class="form-control" placeholder="کد یکبارمصرف" required>
                            </div>
                            <button type="submit" class="form-control btn btn-block btn-lg btn-gradient btn-gradient-two">ورود</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

