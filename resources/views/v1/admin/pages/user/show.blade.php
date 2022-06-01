@extends('v1.admin.layout.default')
@section('custom_style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/css/mail-profile.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/assets/summernote/summernote.css')}}"/>

    <link href="{{asset('assets/dashboard/assets/dz/dropzone.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('assets/dashboard/assets/dz/basic.css')}}" type="text/css" rel="stylesheet">


@endsection
@section('content')
    <!-- content -->
    <section class="row clearfix">
        <div class="col-lg-12 col-xs-12 column b#f9f9f9" id="content">

            <!-- title and breadcrumb -->
            <div class="row clearfix">
                <div class="col-sm-6">
                    <h2>پروفایل</h2>
                </div>
                <div class="col-sm-6 breadcrumb-col">
                    <ol class="breadcrumb">
                        <li><a href="{{route('admin.dashboard')}}">پیشخوان</a></li>
                        <li><span>پروفایل</span></li>
                    </ol>
                </div>
            </div>
            <!-- /End title and breadcrumb -->

            <div class="row">
                <!-- navigation -->
                <div class="col-sm-3">

                    <!-- image and nav -->
                    <div class="panel nav-sidebar-tab">
                        <div class="profie-avatar b#27d">
                            <img src="{{$user->avatar}}" class="i#000000=010000" data-lity/>
                            <div class="t#fff Ubuntu-font">
                                {{$user->full_name}}
                            </div>
                        </div>
                        <ul class="nav tabs">
                            <li class="active"><a href="#prof" data-toggle="tab">پروفایل</a></li>
                            <li class=""><a href="#edit" data-toggle="tab">ویرایش پروفایل</a></li>
                        </ul>
                    </div>

                    <!-- friends -->
                    <div class="panel second-nav">
                        <div class="panel-body">
                            اطلاعات کاربران موجود در سایت فقط قابل ویرایش توسط مدیر کل سامانه
                        </div>
                    </div>
                </div>

                <!-- content -->
                <div class="col-sm-9 user-profile-content">
                    <div class="tab-content panel panel-body">

                        <!-- profile -->
                        <div class="tab-pane fade in active" id="prof">
                            <h2 class="t#05a">پروفایل</h2>
                            @if(count($errors))
                                <div class="alert alert-danger alert-dismissible">
                                    <p>لطفا قبل از ادامه ی کار خطاهای زیر را اصلاح کنید:</p>
                                    @foreach($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <div class="panel">

                                <div class="panel-heading Montserrat-font">
                                    <h3 class="panel-title">{{$user->full_name}}</h3>
                                </div>

                                <div class="panel-body">
                                    <table class="table">
                                        <tr class="first-table-row">
                                            <td>موبایل:</td>
                                            <td>{{$user->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <td>نقش:</td>
                                            <td>{{$user->role->title}}</td>
                                        </tr>
                                        <tr>
                                            <td>تعداد سفارش:</td>
                                            <td>
                                                <a href="{{route('admin.order.user',$user->id)}}">{{ $user->orders ? $user->orders->count() : 0}}</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="panel-footer">
                                    <a href="#edit" class="btn btn-warning" data-toggle="tab" title="ویرایش پروفایل"
                                       tooltip><i class="fa fa-edit"></i></a>
                                    <a href="{{route('admin.order.user',$user->id)}}" class="btn btn-warning" title="سفارشات"
                                       tooltip><i class="fa fa-list"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- edit user -->
                        <div class="tab-pane fade in" id="edit">
                            <h2 class="t#05a">ویرایش پروفایل</h2>
                            <form action="{{route('admin.user.update', $user->id)}}" id="user-form" method="post"
                                  enctype="multipart/form-data">
                                {{ method_field('put') }}
                                {{ csrf_field() }}
                                <div id="image_id_div"></div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{$user->avatar}}" class="img-circle" width="100%"
                                             data-lity/>
                                    </div>
                                    <div class="col-md-8">
                                        <h3 class="margin">{{$user->full_name}}</h3>
                                        <address>
                                            <p><strong>{{$user->role->title}}</strong> در <strong><a
                                                            href="{{route('admin.index')}}"> nitro</a></strong></p>
                                        </address>
                                    </div>
                                </div>

                                <div class="m-t-20">
                                </div>
                                @include('v1.admin.includes.validation-error')
                                <fieldset>
                                    <legend class="t#064 m-t-20">اطلاعات شخصی</legend>
                                    <!-- image-preview-filename input -->
                                    <label for="prefix" class="control-label">تصویر کاربر</label>

                                    <div id="avatar" class="dropzone">
                                    </div>

                                    <div class="m-b-15">
                                        <label for="first_name" class="control-label">نام </label>
                                        <input value="{{old('first_name') ?: $user->first_name}}"
                                               class="form-control parsley-validated" name="first_name" id="first_name"
                                               type="text">
                                        @if ($errors->has('first_name'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <strong>{{$errors->first('first_name')}}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="m-b-15">
                                        <label for="last_name" class="control-label">نام خانوادگی</label>
                                        <input placeholder="نام خانوادگی"
                                               value="{{ old('last_name') ?: $user->last_name}}"
                                               class="form-control parsley-validated" name="last_name" id="last_name"
                                               type="text">
                                        @if ($errors->has('last_name'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <strong>{{$errors->first('last_name')}}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    @if(count($roles) && ($user->id != Auth::user()->id))
                                        <div class="m-b-15">
                                            <label for="role" class="control-label">نقش</label>
                                            <select id="role" name="role" class="form-control parsley-validated">
                                                @foreach($roles as $role)
                                                    <option
                                                            value="{{ $role->id }}" {{ (old('role')  == $role->id ? "selected" : ($user->role->id == $role->id ? "selected" : "")) }}>{{ $role->title }}
                                                        ({{$role->name}})
                                                    </option>
                                                @endforeach()
                                            </select>
                                            @if ($errors->has('role'))
                                                <div class="alert alert-danger alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <strong>{{$errors->first('role')}}</strong>
                                                </div>
                                            @endif
                                        </div> <br/>
                                    @endif


                                    <div class="form-group">
                                        <label for="password">گذرواژه</label>
                                        <span popover="" data-placement="top" data-trigger="hover"
                                              data-content="گذرواژه باید حداقل 8 حرف و شامل حروف کوچک، حروف بزرگ و اعداد و کاراکترهای خاص باشد"
                                              data-original-title="" title=""><i
                                                    class="fa fa-question-circle"></i></span>

                                        <input id="password" name="password" value="{{ old('password') }}"
                                               placeholder="گذرواژه" type="password" class="form-control">
                                        @if ($errors->has('password'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <strong>{{$errors->first('password')}}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <br/>

                                    <div class="form-group">
                                        <label for="password_confirmation">تکرار گذرواژه</label>
                                        <span popover="" data-placement="top" data-trigger="hover"
                                              data-content="گذرواژه باید حداقل 8 حرف و شامل حروف کوچک، حروف بزرگ و اعداد و کاراکترهای خاص باشد"
                                              data-original-title="" title=""><i
                                                    class="fa fa-question-circle"></i></span>

                                        <input id="password_confirmation" name="password_confirmation"
                                               value="{{ old('password_confirmation') }}" placeholder="گذرواژه"
                                               type="password" class="form-control">
                                        @if ($errors->has('password_confirmation'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <strong>{{$errors->first('password_confirmation')}}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <br/>
                                </fieldset>

                                <fieldset>
                                    <legend class="t#064 m-t-20">اطلاعات تماس</legend>
                                    <div class="form-group multiple-form-group input-group">
                                        <div class="input-group-btn input-group-select btn-group dropup">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <span class="concept">موبایل</span>
                                            </button>
                                        </div>

                                        <input disabled value="{{$user->mobile}}" type="number" name="mobile"
                                               class="form-control">
                                        @if ($errors->has('mobile'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <strong>{{$errors->first('mobile')}}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <button class="btn btn-primary green" type="submit">ذخیره کردن</button>
                                    <a tabindex="11" href="{{route('admin.index')}}" class="btn btn-default"
                                       type="button">لغو</a>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /End content -->

    </section>
    <!-- /End main content -->
@endsection()
@section('custom_script')
    <!-- script files (for this page) -->
    <script type="text/javascript" src="{{asset('assets/dashboard/js/mailbox.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/assets/summernote/summernote.js')}}"></script>


    <script type="text/javascript" src="{{asset('assets/dashboard/assets/dz/dropzone.js')}}"></script>

    <script>

        Dropzone.autoDiscover = false;
        // or disable for specific dropzone:
        // Dropzone.options.myDropzone = false;


        $(function () {
            // Now that the DOM is fully loaded, create the dropzone, and setup the
            // event listeners
            var myDropzone = new Dropzone("div#avatar", {url: "{{route('admin.upload_image')}}", maxFiles: 1});

            myDropzone.on("sending", function (file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("model", "userAvatar");
                formData.append("type", "image");

            });

            myDropzone.on("success", function (file, response) {

                let c = $('#image_id_div').html();

                c = c + "<input type='hidden' name='avatar_id[]' value=" + response + ">";

                $('#image_id_div').html(c);
            });
        });


    </script>

    <!-- inline custom script (for this page) -->
    <script type="text/javascript">
        $(document).ready(function () {

            $('.statuse-editor').summernote({
                toolbar: [
                    ['Paragraph style', ['style']],
                    ['style', ['bold', 'italic', 'underline']],
                    ['fontsize', ['fontsize', 'color']],
                    ['misc', ['undo', 'redo']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['picture', 'link', 'video', 'hr']],
                    ['table', ['table']],
                    ['font', ['fontname']],
                ],
                height: 70,
            });

        });

        $(document).ready(function () {
            @if(session()->has('notifications.message'))
            $('#toast-container').remove();
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-full-width",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            var type = "{{ session()->get('notifications.alert_type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ session()->get('notifications.message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ session()->get('notifications.message') }}");
                    break;

                case 'success':
                    toastr.success("{{ session()->get('notifications.message') }}");
                    break;

                case 'error':
                    toastr.error("{{ session()->get('notifications.message') }}");
                    break;
            }
            {{session()->forget('notifications')}}
                    @endif
        });
    </script>
@endsection
