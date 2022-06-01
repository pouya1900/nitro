@extends('v1.site.layout.default')
@section('og-twitter-html-tags')
    @include('v1.site.includes.custom-og-twitter-html-meta')
    <title>ویرایش آگهی | QiQoo سایت</title>
    <meta name="description" content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">

    <meta property="og:title" content="ویرایش آگهی | QiQoo سایت"/>
    <meta property="og:url" content="{{route('ads.edit', $ads->id)}}"/>
    <meta property="og:image" content="{{asset('assets/dashboard/img/logo.png')}}"/>
    <meta property="og:description"
          content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما"/>

    <meta property=twitter:title content="ویرایش آگهی | QiQoo سایت">
    <meta property=twitter:description
          content="اخبار مربوط به نیازمندی ها و آگهی های جدید برای آشنایی با کسب و کارهای مختلف و پیدا کردن مناسب ترین کسب و کار مطابق با نیازمندی شما">
    <meta property=twitter:image content="{{asset('assets/dashboard/img/logo.png')}}">
    <meta property=twitter:site content="{{route('ads.edit', $ads->id)}}">

    <link rel="canonical" href="{{route('ads.edit', $ads->id)}}">
@endsection
@section('custom_head')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/index/plugins/dropify/css/dropify.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/index/plugins/leaflet/leaflet.css') }}"/>
    <script src="{{ asset('assets/index/plugins/leaflet/leaflet.js') }}"></script>
    <style>
        #mapid {
            height: 180px;
        }
    </style>
@endsection
@section('content')
    <section class="header-breadcrumb bgimage overlay overlay--dark">
        <div class="bg_image_holder"><img src="{{ asset('assets/index/img/breadcrumb1.jpg')}}" alt=""></div>
        <div class="breadcrumb-wrapper content_above">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="page-title">ویرایش آگهی</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">خانه</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ویرایش آگهی</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div><!-- ends: .breadcrumb-wrapper -->

    </section>

    <section class="add-listing-wrapper border-bottom section-bg section-padding-strict">
        <div class="container">
            <form method="post" action="{{ route('ads.store', $adsCategory->id) }}">
                {{ csrf_field() }}
                <div id="app" class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="atbd_content_module">
                            <div class="atbd_content_module__tittle_area">
                                <div class="atbd_area_title">
                                    <h4><span class="la la-user"></span>اطلاعات عمومی</h4>
                                </div>
                            </div>
                            <div class="atbdb_content_module_contents">
                                @include('v1.admin.includes.validation-error')
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <p class="color-danger">لطفا خطاهای زیر را اصلاح نمایید</p>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <span class="field-force">*</span>
                                    <label for="title" class="form-label">عنوان</label>
                                    <input value="{{ old('title') ?? $ads->title }}" name="title" type="text" class="form-control"
                                           id="title" placeholder="عنوان را وارد کنید">
                                    @if ($errors->has('title'))
                                        <div class="alert alert-danger " role="alert">
                                            <strong>{{$errors->first('title')}}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <span class="field-force">*</span>
                                    <label for="description" class="form-label">توضیحات</label>
                                    <textarea name="description" id="description" rows="8" class="form-control"
                                              placeholder="توضیحات">{{ old('description') ?? $ads->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <strong>{{$errors->first('description')}}</strong>
                                        </div>
                                    @endif
                                </div>

                            </div><!-- ends: .atbdb_content_module_contents -->
                        </div><!-- ends: .atbd_content_module -->
                    </div><!-- ends: .col-lg-10 -->

                    @if(!empty($adsCategory->adsAttributeDescriptions->count()))
                        <div id="app" class="col-lg-10 offset-lg-1">
                            <div class="atbd_content_module">
                                <div class="atbd_content_module__tittle_area">
                                    <div class="atbd_area_title">
                                        <h4><span class="la la-folder"></span>ویژگی های آگهی</h4>
                                    </div>
                                </div>
                                <div class="atbdb_content_module_contents">
                                    <div class="form-group">
                                        <div id="social_info_sortable_container">
                                            <div class="directorist atbdp_social_field_wrapper">
                                                <div class="row m-bottom-20" id="social-form-fields">
                                                    <div class="col-sm-4">
                                                        @foreach($adsCategory->adsAttributeDescriptions as $row)
                                                            <div class="form-group">
                                                                <label for="{{ $row->field_name }}"
                                                                       class="form-control directory_field ">{{ $row->title }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="col-sm-6">
                                                        @foreach($adsCategory->adsAttributeDescriptions as $row)
                                                            <div class="form-group">
                                                                <input value="{{ old($row->field_name) }}"
                                                                       id="{{ $row->field_name }}"
                                                                       name="attributes[{{ $row->field_name }}]"
                                                                       value="{{ old($row->field_name) }}"
                                                                       class="form-control directory_field atbdp_social_input"
                                                                       @if($row->adsAttributeDescriptionValueType->input_type == 'boolean')
                                                                       type="checkbox"
                                                                       @else
                                                                       type="{{$row->adsAttributeDescriptionValueType->input_type}}"
                                                                    @endif
                                                                >
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- ends: .atbdb_content_module_contents -->
                            </div><!-- ends: .atbd_content_module -->
                        </div><!-- ends: .col-lg-10 -->
                    @endif

                    <div class="col-lg-10 offset-lg-1">
                        <div class="atbd_content_module">
                            <div class="atbd_content_module__tittle_area">
                                <div class="atbd_area_title">
                                    <h4><span class="la la-user"></span>اطلاعات تماس</h4>
                                </div>
                            </div>

                            <div class="atbdb_content_module_contents">
                                <div class="form-group">
                                    <span class="field-force">*</span>
                                    <label for="country_id" class="form-label">کشور</label>
                                    <select id="country_id" name="country_id" class="form-control">
                                        @foreach($countries as $row)
                                            <option
                                                value="{{ $row->id }}" {{ (old('country_id') == $row->id ? "selected": "") }}>{{ $row->en_title }}</option>
                                        @endforeach()
                                    </select>
                                    @if ($errors->has('country_id'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <strong>{{$errors->first('country_id')}}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <span class="field-force">*</span>
                                    <label for="city_id" class="form-label">شهر</label>
                                    <select id="city_id" name="city_id" class="form-control">
                                        <option disabled selected>انتخاب</option>
                                        @foreach($countries->first()->cities as $city)
                                            <option
                                                value="{{ $city->id }}" {{ (old('city_id') ?? $ads->city_id  == $city->id ? "selected": "") }}>{{ $city->title }}</option>
                                        @endforeach()
                                    </select>
                                    @if ($errors->has('city_id'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <strong>{{$errors->first('city_id')}}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <span class="field-force">*</span>
                                    <label for="address" class="form-label">آدرس</label>
                                    <input value="{{ old('address') ?? $ads->address }}" name="address" type="text"
                                           placeholder="آدرس مانند لندن خیابان 1 کوچه 5"
                                           id="address" class="form-control">
                                    @if ($errors->has('address'))
                                        <div class="alert alert-danger " role="alert">
                                            <strong>{{$errors->first('address')}}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <span class="field-force">*</span>
                                    <label for="postal_code" class="form-label">کد پستی</label>
                                    <input value="{{ old('postal_code') ?? $ads->postal_code }}" name="postal_code" type="text"
                                           placeholder="کد پستی را وارد نمایید"
                                           id="postal_code" class="form-control">
                                    @if ($errors->has('postal_code'))
                                        <div class="alert alert-danger " role="alert">
                                            <strong>{{$errors->first('postal_code')}}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <span class="field-force">*</span>
                                    <label for="phone" class="form-label">شماره تلفن</label>
                                    <input value="{{ old('phone') ?? $ads->phone }}" name="phone" type="number"
                                           placeholder="شماره تلفن" id="phone" class="form-control">
                                    @if ($errors->has('phone'))
                                        <div class="alert alert-danger " role="alert">
                                            <strong>{{$errors->first('phone')}}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <span class="field-force">*</span>
                                    <label for="mobile" class="form-label">موبایل</label>
                                    <input value="{{ old('mobile') ?? $ads->mobile }}" name="mobile" type="number"
                                           placeholder="شماره تلفن" id="mobile" class="form-control">
                                    @if ($errors->has('mobile'))
                                        <div class="alert alert-danger " role="alert">
                                            <strong>{{$errors->first('mobile')}}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">ایمیل</label>
                                    <input value="{{ old('email') ?? $ads->email }}" name="email" type="email" id="email"
                                           class="form-control" placeholder="ایمیل را وارد کنید">
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger " role="alert">
                                            <strong>{{$errors->first('email')}}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">اطلاعات شبکه های اجتماعی</label>

                                    <div id="social_info_sortable_container">
                                        <div class="directorist atbdp_social_field_wrapper">
                                            <div class="row m-bottom-20" id="social-form-fields">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="facebook"
                                                               class="form-control directory_field atbdp_social_input">فیسبوک</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="instagram"
                                                               class="form-control directory_field atbdp_social_input">اینستاگرام</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="twitter"
                                                               class="form-control directory_field atbdp_social_input">توییتر</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="youtube"
                                                               class="form-control directory_field atbdp_social_input">یوتیوب</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input value="{{ old('facebook') ?? $ads->facebook }}" id="facebook"
                                                               name="facebook" type="url"
                                                               class="form-control directory_field atbdp_social_input"
                                                               placeholder="مثال. http://example.com">
                                                        @if ($errors->has('facebook'))
                                                            <div class="alert alert-danger " role="alert">
                                                                <strong>{{$errors->first('facebook')}}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <input value="{{ old('instagram') ?? $ads->instagram }}" id="instagram"
                                                               name="instagram" type="url"
                                                               class="form-control directory_field atbdp_social_input"
                                                               placeholder="مثال. http://example.com">
                                                        @if ($errors->has('instagram'))
                                                            <div class="alert alert-danger " role="alert">
                                                                <strong>{{$errors->first('instagram')}}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <input value="{{ old('twitter') ?? $ads->twitter }}" id="twitter" name="twitter"
                                                               type="url"
                                                               class="form-control directory_field atbdp_social_input"
                                                               placeholder="مثال. http://example.com">
                                                        @if ($errors->has('twitter'))
                                                            <div class="alert alert-danger " role="alert">
                                                                <strong>{{$errors->first('twitter')}}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <input value="{{ old('youtube') ?? $ads->youtube }}" id="youtube" name="youtube"
                                                               type="url"
                                                               class="form-control directory_field atbdp_social_input"
                                                               placeholder="مثال. http://example.com">
                                                        @if ($errors->has('youtube'))
                                                            <div class="alert alert-danger " role="alert">
                                                                <strong>{{$errors->first('youtube')}}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- ends: .atbdb_content_module_contents -->
                        </div><!-- ends: .atbd_content_module -->
                    </div><!-- ends: .col-lg-10 -->

                    <div class="col-lg-10 offset-lg-1">
                        <div class="atbd_content_module">
                            <div class="atbd_content_module__tittle_area">
                                <div class="atbd_area_title">
                                    <h4><span class="la la-calendar-check-o"></span> مکان (نقشه)</h4>
                                </div>
                            </div>
                            <div class="atbdb_content_module_contents">
                                <label class="not_empty form-label">نشانگر را با کلیک کردن در هر نقطه روی نقشه تنظیم
                                    کنید</label>
                                {{--<div class="map" id="map-one"></div>--}}
                                <div class="mapouter">
                                    <div id="map" style="width: 800px; height: 440px; border: 1px solid #AAA;"></div>
                                </div>
                                <div class="cor-wrap form-group">
                                    <div
                                        class="atbd_mark_as_closed custom-control custom-checkbox checkbox-outline checkbox-outline-primary">
                                        <input type="checkbox" class="custom-control-input" name="manual_coordinate"
                                               value="1" id="manual_coordinate">
                                        <label for="manual_coordinate" class="not_empty custom-control-label">یا مختصات
                                            (طول و عرض جغرافیایی) را به صورت دستی وارد کنید. </label>
                                    </div>
                                </div>
                                <div class="cor-form">
                                    <div id="hide_if_no_manual_cor" class="clearfix row m-bottom-30">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="lat" class="not_empty"> عرض جغرافیایی </label>
                                                <input value="{{ old('lat') ?? $ads->lat }}" type="text" name="lat" id="lat"
                                                       class="form-control directory_field"
                                                       placeholder="عرض جغرافیایی را وارد کنید مثل. 24.89904">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-3 mt-sm-0">
                                            <div class="form-group">
                                                <label for="long" class="not_empty"> طول جغرافیایی </label>
                                                <input value="{{ old('long') ?? $ads->long }}" type="text" name="long" id="long"
                                                       class="form-control directory_field"
                                                       placeholder="طول جغرافیایی را وارد کنید مثل. 24.89904">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- ends: .atbdb_content_module_contents -->
                        </div><!-- ends: .atbd_content_module -->
                    </div><!-- ends: .col-lg-10 -->

                    <div class="col-lg-10 offset-lg-1">
                        <div class="atbd_content_module">
                            <div class="atbd_content_module__tittle_area">
                                <div class="atbd_area_title">
                                    <h4><span class="la la-calendar-check-o"></span> تصاویر و ویدیو</h4>
                                </div>
                            </div>

                            <div class="atbdb_content_module_contents">
                                <div class="form-group">
                                    <span class="field-force">*</span>
                                    <label for="logo">تصویر لوگو آگهی</label>
                                    <p>لوگو آگهی تصویری است که در صفحات مختلف برای آگهی نمایش داده میشود.</p>
                                    <div class="input-group image-preview m-b-15">
                                        <input name="logo_image" type="file" class="dropify"/>
                                    </div><!-- /input-group file-preview -->
                                    @if ($errors->has('logo_image'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <strong>{{$error('logo_image')}}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <span class="field-force">*</span>
                                    <label for="logo">تصویر محتوا</label>
                                    <p>تصاویر آگهی در صفحه جزییات آگهی قابل مشاهده است.</p>
                                    <div class="input-group image-preview m-b-15">
                                        <input name="content_image[]" type="file" class="dropify"/>
                                    </div><!-- /input-group file-preview -->
                                    @if ($errors->has('content_image'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <strong>{{$error('content_image')}}</strong>
                                        </div>
                                    @endif
                                </div>
                                <p id="load-content-image" class="hide-if-no-js">
                                    <a style="cursor: hand" id="delete-custom-img" class="btn btn-outline-danger hidden"
                                       onclick="loadContentImage()">ویرایش تصویر آگهی</a><br>
                                </p>

                                <div class="form-group m-top-30">
                                    <label for="video_link" class="not_empty form-label">آدرس ویدئو</label>
                                    <input type="text" id="video_link" name="video_link" value="{{ old('video_link') }}"
                                           class="form-control directory_field"
                                           placeholder="فقط آدرس های یوتیوب و ویمئو.">
                                    @if ($errors->has('video_link'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <strong>{{$error('video_link')}}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div><!-- ends: .atbdb_content_module_contents -->
                        </div><!-- ends: .atbd_content_module -->
                    </div><!-- ends: .col-lg-10 -->

                    <div class="col-lg-10 offset-lg-1 text-center">
                        <div
                            class="atbd_term_and_condition_area custom-control custom-checkbox checkbox-outline checkbox-outline-primary">
                            <span class="field-force">*</span>
                            <input value="1" @if(old('term') == 1) checked @endif type="checkbox"
                                   class="custom-control-input" name="term" id="term">
                            <label for="term" class="not_empty custom-control-label">من با تمام شرایط و <a href="#"
                                                                                                           id="term">ضوابط
                                    موافقم</a></label>
                        </div>

                        <div class="btn_wrap list_submit m-top-25">
                            <button type="submit" class="btn btn-primary btn-lg listing_submit_btn">ارسال آگهی</button>
                        </div>
                    </div><!-- ends: .col-lg-10 -->
                </div>
            </form>

        </div>
    </section><!-- ends: .add-listing-wrapper -->
@endsection

@section('custom_script')
    <script src="{{asset('assets/index/plugins/dropify/js/dropify.js')}}"></script>
    <script>
        function loadContentImage() {
            var text = '<div class="form-group">' +
                '<div class="input-group image-preview m-b-15">' +
                '<input name="content_image[]" type="file" class="dropify" />' +
                '</div>' +
                '@if ($errors->has('content_image'))' +
                '<div class="alert alert-danger alert-dismissible" role="alert">' +
                '<strong>{{$error('content_image')}}</strong>' +
                '</div>' +
                '@endif' +
                '</div>';
            $('#load-content-image').before(text)
            $(".dropify").dropify({
                messages: {
                    'default': 'با کشیدن و رها کردن فایل خود در این قسمت یا با کلیک کردن می توانید فایل خود را انتخاب کنید',
                    'replace': 'برای تعویض تصویر خود کلیک کنید',
                    'remove': 'حذف',
                    'error': 'متاسفانه مشکلی پیش آمده است.'
                },
                error: {
                    'fileSize': 'اندازه فایل خیلی زیاد است (حداکثر 2MB).',
                    'minWidth': 'The image width is too small (400px min).',
                    'maxWidth': 'The image width is too big (1080px max).',
                    'minHeight': 'The image height is too small (50px min).',
                    'maxHeight': 'The image height is too big (10px max).',
                    'imageFormat': 'The image format is not allowed (10 only).'
                }
            });
        }
    </script>
    <script>
        $(document).ready(function () {
            $(".dropify").dropify({
                messages: {
                    'default': 'با کشیدن و رها کردن فایل خود در این قسمت یا با کلیک کردن می توانید فایل خود را انتخاب کنید',
                    'replace': 'برای تعویض تصویر خود کلیک کنید',
                    'remove': 'حذف',
                    'error': 'متاسفانه مشکلی پیش آمده است.'
                },
                error: {
                    'fileSize': 'اندازه فایل خیلی زیاد است (حداکثر 2MB).',
                    'minWidth': 'The image width is too small (400px min).',
                    'maxWidth': 'The image width is too big (1080px max).',
                    'minHeight': 'The image height is too small (50px min).',
                    'maxHeight': 'The image height is too big (10px max).',
                    'imageFormat': 'The image format is not allowed (10 only).'
                }
            });
        });
    </script>
    <script>
        var map = L.map('map', {
            center: [51.5071, -0.1273],
            minZoom: 10,
            zoom: 15
        });
        var theMarker = {};
        map.on('click', function (e) {
            lat = e.latlng.lat;
            lon = e.latlng.lng;

            console.log("You clicked the map at LAT: " + lat + " and LONG: " + lon);
            $('#lat').val(lat);
            $('#long').val(lon);
            //Clear existing marker,

            if (theMarker != undefined) {
                map.removeLayer(theMarker);
            }
            //Add a marker to show where you clicked.
            theMarker = L.marker([lat, lon]).addTo(map);
        });
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            subdomains: ['a', 'b', 'c']
        }).addTo(map);

    </script>
@endsection
