@extends('v1.admin.layout.default')
@section('custom_style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/assets/dropify/css/dropify.css')}}" />

    <link href="{{asset('assets/dashboard/assets/dz/dropzone.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('assets/dashboard/assets/dz/basic.css')}}" type="text/css" rel="stylesheet">


@endsection
@section('content')
    <!-- title and breadcrumb -->
    <div class="row clearfix">
        <div class="col-sm-6">
            <h2>کاربر جدید</h2>
        </div>
        <div class="col-sm-6 breadcrumb-col">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">پیشخوان</a></li>
                <li><span><a href="{{route('admin.user.all')}}">مدیریت کاربران</a></span></li>
                <li><span>کاربر جدید</span></li>
            </ol>
        </div>
    </div>
    <!-- /End title and breadcrumb -->

    <!-- Basic form -->
    <div class="panel" id="basic">
        <div class="panel-heading b#c6f9ff">
            <i class="fa fa-plus-square-o  sort-hand"></i>کاربر جدید
            <div class="pan-btn expand"></div>
        </div>
        <div class="panel-body">
            @include('v1.admin.includes.validation-error')
            <form action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div id="image_id_div"></div>


            @if(count($errors))
                    <div class="alert alert-danger alert-dismissible">
                        <p>لطفا قبل از ادامه ی کار خطاهای زیر را اصلاح کنید:</p>
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="mobile">موبایل</label>
                    <span  popover=""  data-placement="top" data-trigger="hover" data-content="شماره موبایل را بدون صفر وارد نمایید. جهت ورود به سایت و اپ مورد استفاده قرار می گیرد." data-original-title="" title=""><i class="fa fa-question-circle"></i></span>
                    <input required id="mobile" name="mobile" value="{{ old('mobile') }}"  placeholder="موبایل" type="text" class="form-control">
                    @if ($errors->has('mobile'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('mobile')}}</strong>
                        </div>
                    @endif
                </div><br/>

                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="first_name">نام</label>
                    <input required id="first_name" name="first_name" value="{{ old('first_name') }}"  placeholder="نام" type="text" class="form-control">
                    @if ($errors->has('first_name'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('first_name')}}</strong>
                        </div>
                    @endif
                </div><br/>

                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="last_name">نام خانوادگی</label>
                    <input required id="last_name" name="last_name" value="{{ old('last_name') }}"  placeholder="نام خانوادگی" type="text" class="form-control">
                    @if ($errors->has('last_name'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('last_name')}}</strong>
                        </div>
                    @endif
                </div><br/>

                 @if(count($roles))
                    <div class="form-group">
                        <span class="field-force">*</span>
                        <label for="role">نقش</label>
                        <span  popover=""  data-placement="top" data-trigger="hover" data-content="کاربر عادی یا کاربر کاربر مدیر را تعیین کنید" data-original-title="" title=""><i class="fa fa-question-circle"></i></span>
                        <select  id="role" name="role" class="form-control" >
                            <option disabled selected>انتخاب</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ (old('role')  == $role->id ? "selected" :  "") }}>{{ $role->title }} ({{$role->name}})</option>
                            @endforeach()
                        </select>
                        @if ($errors->has('role'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>{{$errors->first('role')}}</strong>
                            </div>
                        @endif
                    </div> <br/>
                @endif

                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="password">گذرواژه</label>
                    <span  popover=""  data-placement="top" data-trigger="hover" data-content="گذرواژه باید حداقل 8 حرف و شامل حروف کوچک، حروف بزرگ و اعداد و کاراکترهای خاص باشد" data-original-title="" title=""><i class="fa fa-question-circle"></i></span>

                    <input required id="password" name="password" value="{{ old('password') }}"  placeholder="گذرواژه" type="password" class="form-control">
                    @if ($errors->has('password'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('password')}}</strong>
                        </div>
                    @endif
                </div><br/>

                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="password_confirmation">تکرار گذرواژه</label>
                    <span  popover=""  data-placement="top" data-trigger="hover" data-content="گذرواژه باید حداقل 8 حرف و شامل حروف کوچک، حروف بزرگ و اعداد و کاراکترهای خاص باشد" data-original-title="" title=""><i class="fa fa-question-circle"></i></span>

                    <input required id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"  placeholder="گذرواژه" type="password" class="form-control">
                    @if ($errors->has('password_confirmation'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('password_confirmation')}}</strong>
                        </div>
                    @endif
                </div><br/>

                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="avatar">تصویر آواتار</label>

                    <div  id="avatar" class="dropzone">
                    </div>


                @if ($errors->has('avatar'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('avatar')}}</strong>
                        </div>
                    @endif
                </div>



                <div class="panel-body">
                    @include('v1.admin.includes.page-table-buttons', ['register'=>TRUE, 'cancel' => ['route' => 'admin.user.all']])
                </div>
            </form>


        </div>
    </div>

<!-- /End Basic form -->
@endsection
@section('custom_script')
    <!-- script files (for this page) -->
    <script>
        $(document).ready(function() {
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
            switch(type){
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

    <script type="text/javascript" src="{{asset('assets/dashboard/assets/dz/dropzone.js')}}"></script>

    <script>

        Dropzone.autoDiscover = false;
        // or disable for specific dropzone:
        // Dropzone.options.myDropzone = false;



        $(function () {
            // Now that the DOM is fully loaded, create the dropzone, and setup the
            // event listeners
            var myDropzone = new Dropzone("div#avatar", { url: "{{route('admin.upload_image')}}" , maxFiles:1});

            myDropzone.on("sending", function (file, xhr,formData) {
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("model", "userAvatar");
                formData.append("type", "image");

            });

            myDropzone.on("success", function (file, response) {

                let c=$('#image_id_div').html();

                c=c+"<input type='hidden' name='avatar_id[]' value="+response+">";

                $('#image_id_div').html(c);
            });
        });



    </script>

@endsection
