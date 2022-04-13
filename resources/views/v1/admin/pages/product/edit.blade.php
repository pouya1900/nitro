@extends('v1.admin.layout.default')
@section('custom_style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/css/mail-profile.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/assets/summernote/summernote.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/assets/image-preview/image-preview.css')}}"/>

    <link href="{{asset('assets/dashboard/assets/dz/dropzone.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('assets/dashboard/assets/dz/basic.css')}}" type="text/css" rel="stylesheet">

@endsection
@section('content')

    <!-- title and breadcrumb -->
    <div class="row clearfix">
        <div class="col-sm-6">
            <h2>ویرایش محصولات</h2>
        </div>
        <div class="col-sm-6 breadcrumb-col">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">پیشخوان</a></li>
                <li><span><a href="{{route('admin.product.index')}}">محصولات</a></span></li>
                <li><span>ویرایش</span></li>
            </ol>
        </div>
    </div>
    <!-- /End title and breadcrumb -->

    <!-- Basic form -->
    <div class="panel" id="basic">
        <div class="panel-heading b#c6f9ff">
            <i class="fa fa-pencil-square-o sort-hand"></i>{{ $product->name }}
            <div class="pan-btn expand"></div>
        </div>
        <div class="panel-body">@include('v1.admin.includes.validation-error')
            <form action="{{route('admin.product.update', $product->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('put') }}
                {{ csrf_field() }}

                <div id="image_id_div"></div>


                @if(count($errors))
                    <div class="alert alert-danger">
                        <p>لطفا قبل از ادامه ی کار خطاهای زیر را اصلاح کنید:</p>
                        @foreach($errors->all() as $error)
                            <p class="danger">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="name">عنوان</label>
                    <span popover="" data-placement="top" data-trigger="hover"
                          data-content="عنوان خبر که اجباری است و در سایت نمایش داده می شود" data-original-title=""
                          title=""><i class="fa fa-question-circle"></i></span>
                    <input id="name" name="name" value="{{ old('name') ?: $product->name }}" tabindex="1"
                           placeholder="عنوان" type="text" class="form-control">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('name')}}</strong>
                        </div>
                    @endif
                </div>
                <br/>

                @if(isset($categories) && $categories->count() > 0)
                    <div class="form-group">
                        <span class="field-force">*</span>
                        <label for="category_id">دسته بندی</label>
                        <span popover="" data-placement="top" data-trigger="hover" data-content="دسته بندی محصول"
                              data-original-title="" title=""><i class="fa fa-question-circle"></i></span>
                        <select id="category_id" name="category_id" class="form-control" tabindex="2">
                            <option disabled selected>انتخاب</option>
                            @foreach($categories as $cat)
                                <option
                                    value="{{ $cat->id }}" {{ ($product->category_id  == $cat->id ? "selected": "") }}>{{ $cat->title }}</option>
                            @endforeach()
                        </select>
                        @if ($errors->has('category_id'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <strong>{{$errors->first('category_id')}}</strong>
                            </div>
                        @endif
                    </div> <br/>
                @endif

                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="category_type">نوع</label>
                    <span popover="" data-placement="top" data-trigger="hover"
                          data-content="نوع محصول باید به صورت category_type باشد مثل : instagram_like , tiktok_follower" data-original-title=""
                          title=""><i class="fa fa-question-circle"></i></span>
                    <input id="category_type" name="category_type" value="{{ old('category_type') ?: $product->category_type }}" tabindex="1" placeholder="نوع"
                           type="text" class="form-control">
                    @if ($errors->has('category_type'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('category_type')}}</strong>
                        </div>
                    @endif
                </div>


                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="available">محصول موجود است؟</label>
                    <span popover="" data-placement="top" data-trigger="hover"
                          data-content="در صورتی که خیر را انتخاب کنید، محصول برای کاربران نمایش داده نخواهد شد"
                          data-original-title="" title=""><i class="fa fa-question-circle"></i></span>
                    <div class="btn-group" id="available" data-toggle="buttons">
                        <label class="btn btn-default btn-on {{ $product->available ? 'active' : '' }}">
                            <input type="radio" value="1"
                                   name="available" {{ $product->available ? 'checked' : '' }}>بله</label>
                        <label class="btn btn-default btn-off {{ !$product->available ? 'active' : '' }}">
                            <input type="radio" value="0"
                                   name="available" {{ !$product->available ? 'checked' : '' }}>خیر</label>
                    </div>
                    @if ($errors->has('available'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('available')}}</strong>
                        </div>
                    @endif
                </div>
                <br/>


                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="rate">قیمت</label>
                    <span popover="" data-placement="top" data-trigger="hover"
                          data-content="قیمت محصول" data-original-title=""
                          title=""><i class="fa fa-question-circle"></i></span>
                    <input id="rate" name="rate" value="{{ old('rate') ?: $product->rate }}" tabindex="1"
                           placeholder="قیمت"
                           type="text" class="form-control">
                    @if ($errors->has('rate'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('rate')}}</strong>
                        </div>
                    @endif
                </div>
                <br/>

                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="min">حداقل</label>
                    <span popover="" data-placement="top" data-trigger="hover"
                          data-content="حداقل" data-original-title=""
                          title=""><i class="fa fa-question-circle"></i></span>
                    <input id="min" name="min" value="{{ old('min') ?: $product->min }}" tabindex="1"
                           placeholder="حداقل"
                           type="text" class="form-control">
                    @if ($errors->has('min'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('min')}}</strong>
                        </div>
                    @endif
                </div>
                <br/>

                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="max">حداکثر</label>
                    <span popover="" data-placement="top" data-trigger="hover"
                          data-content="حداکثر" data-original-title=""
                          title=""><i class="fa fa-question-circle"></i></span>
                    <input id="max" name="max" value="{{ old('max') ?: $product->max }}" tabindex="1"
                           placeholder="حداکثر"
                           type="text" class="form-control">
                    @if ($errors->has('max'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('max')}}</strong>
                        </div>
                    @endif
                </div>
                <br/>

                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="is_fav">محصول برگزیده است؟</label>
                    <span popover="" data-placement="top" data-trigger="hover"
                          data-content=""
                          data-original-title="" title=""><i class="fa fa-question-circle"></i></span>
                    <div class="btn-group" id="is_fav" data-toggle="buttons">
                        <label class="btn btn-default btn-on {{  $product->is_fav ? 'active' : '' }}">
                            <input type="radio" value="1"
                                   name="is_fav" {{ $product->is_fav ? 'checked' : '' }}>بله</label>
                        <label class="btn btn-default btn-off {{ !$product->is_fav ? 'active' : '' }}">
                            <input type="radio" value="0"
                                   name="is_fav" {{ !$product->is_fav ? 'checked' : '' }}>خیر</label>
                    </div>
                    @if ($errors->has('is_fav'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('is_fav')}}</strong>
                        </div>
                    @endif
                </div>
                <br/>


                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="description">توضیحات</label>
                    <input id="description" name="description" value="{{ old('description') ?: $product->description }}"
                           tabindex="1" placeholder="توضیحات"
                           type="text" class="form-control">
                    @if ($errors->has('description'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('description')}}</strong>
                        </div>
                    @endif
                </div>


                <div class="panel-body">
                    @include('v1.admin.includes.page-table-buttons', ['register'=>true, 'cancel' => ['route' => 'admin.product.index']])
                </div>
            </form>
        </div>
    </div>

    <!-- /End Basic form -->
@endsection
@section('custom_script')
    <script src="//cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>
    <script type="text/javascript" src="{{asset('assets/dashboard/assets/dz/dropzone.js')}}"></script>


    <script>

        Dropzone.autoDiscover = false;
        // or disable for specific dropzone:
        // Dropzone.options.myDropzone = false;


        $(function () {
            // Now that the DOM is fully loaded, create the dropzone, and setup the
            // event listeners
            var myDropzone = new Dropzone("div#content_image", {url: "{{route('admin.upload_image')}}"});

            myDropzone.on("sending", function (file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("model", "blogContent");
                formData.append("type", "image");

            });

            myDropzone.on("success", function (file, response) {

                let c = $('#image_id_div').html();

                c = c + "<input type='hidden' name='content_image_id[]' value=" + response + ">";

                $('#image_id_div').html(c);
            });
        });

        $(function () {
            // Now that the DOM is fully loaded, create the dropzone, and setup the
            // event listeners
            var myDropzone2 = new Dropzone("div#content_video", {url: "{{route('admin.upload_image')}}"});

            myDropzone2.on("sending", function (file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("model", "blogContentVideo");
                formData.append("type", "video");

                // manual duration set , will be delete in developed app

                let duration = parseFloat($('#video_manual_duration').val()) * 1000;

                formData.append("duration", duration);


                // manual duration set , will be delete in developed app

            });

            myDropzone2.on("success", function (file, response) {

                let c = $('#image_id_div').html();

                c = c + "<input type='hidden' name='content_video_id[]' value=" + response + ">";

                $('#image_id_div').html(c);
            });
        });


    </script>


    <script>
        CKEDITOR.replace('blog_text', {
            contentsLangDirection: 'rtl',
            // Define the toolbar groups as it is a more accessible solution.
            toolbarGroups: [{
                "name": "basicstyles",
                "groups": ["basicstyles"]
            },
                {
                    "name": "links",
                    "groups": ["links"]
                },
                {
                    "name": "paragraph",
                    "groups": ["align", "list", "blocks"]
                },
                {
                    "name": "document",
                    "groups": ["mode"]
                },
                {
                    "name": "insert",
                    "groups": ["insert"]
                },
                {
                    "name": "styles",
                    "groups": ["styles"]
                }
            ],
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,Font,FontSize|Find,SelectAll,Scayt,Source,Save,Templates,NewPage,Preview,Print,About,Flash,Table,HorizontalRule,SpecialChar,PageBreak,Iframe,FontSize,Outdent,Indent,RemoveFormat,CopyFormatting,Strike,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Cut,Copy,Paste,PasteText,PasteFromWord'
        });

        var editor2 = CKEDITOR.replace('blog_en_text', {
            // Define the toolbar groups as it is a more accessible solution.
            toolbarGroups: [{
                "name": "basicstyles",
                "groups": ["basicstyles"]
            },
                {
                    "name": "links",
                    "groups": ["links"]
                },
                {
                    "name": "paragraph",
                    "groups": ["align", "list", "blocks"]
                },
                {
                    "name": "document",
                    "groups": ["mode"]
                },
                {
                    "name": "insert",
                    "groups": ["insert"]
                },
                {
                    "name": "styles",
                    "groups": ["styles"]
                }
            ],
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,Font,FontSize|Find,SelectAll,Scayt,Source,Save,Templates,NewPage,Preview,Print,About,Flash,Table,HorizontalRule,SpecialChar,PageBreak,Iframe,FontSize,Outdent,Indent,RemoveFormat,CopyFormatting,Strike,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Cut,Copy,Paste,PasteText,PasteFromWord'
        });
    </script>
    <script>
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
