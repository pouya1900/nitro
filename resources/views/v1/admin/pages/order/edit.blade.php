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
            <h2>ویرایش سفارش</h2>
        </div>
        <div class="col-sm-6 breadcrumb-col">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">پیشخوان</a></li>
                <li><span><a href="{{route('admin.order.index')}}">سفارشات</a></span></li>
                <li><span>ویرایش</span></li>
            </ol>
        </div>
    </div>
    <!-- /End title and breadcrumb -->

    <!-- Basic form -->
    <div class="panel" id="basic">
        <div class="panel-heading b#c6f9ff">
            <i class="fa fa-pencil-square-o sort-hand"></i>{{ $order->tracking_number }}
            <div class="pan-btn expand"></div>
        </div>
        <div class="panel-body">@include('v1.admin.includes.validation-error')
            <form action="{{route('admin.order.update', $order->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('put') }}
                {{ csrf_field() }}


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
                    <label for="link">لینک</label>
                    <span popover="" data-placement="top" data-trigger="hover"
                           data-original-title=""
                          title=""><i class="fa fa-question-circle"></i></span>
                    <input id="link" name="link" value="{{ old('link') ?: $order->link }}" tabindex="1"
                           placeholder="لینک" type="text" class="form-control">
                    @if ($errors->has('link'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('link')}}</strong>
                        </div>
                    @endif
                </div>
                <br/>

                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="count">تعداد</label>
                    <span popover="" data-placement="top" data-trigger="hover"
                          data-original-title=""
                          title=""><i class="fa fa-question-circle"></i></span>
                    <input id="count" name="count" value="{{ old('count') ?: $order->count }}" tabindex="1"
                           placeholder="تعداد" type="number" class="form-control">
                    @if ($errors->has('count'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('count')}}</strong>
                        </div>
                    @endif
                </div>
                <br/>



                <div class="panel-body">
                    @include('v1.admin.includes.page-table-buttons', ['register'=>true, 'cancel' => ['route' => 'admin.order.index']])
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
