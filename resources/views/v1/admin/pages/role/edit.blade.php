@extends('v1.admin.layout.default')
@section('custom_style')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/bootstrap-multiselect.css') }}">
@endsection
@section('content')

    <!-- title and breadcrumb -->
    <div class="row clearfix">
        <div class="col-sm-6">
            <h2>ویرایش دسترسی</h2>
        </div>
        <div class="col-sm-6 breadcrumb-col">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">پیشخوان</a></li>
                <li><span><a href="{{route('admin.role.index')}}">دسترسی ها</a></span></li>
                <li><span>ویرایش</span></li>
            </ol>
        </div>
    </div>
    <!-- /End title and breadcrumb -->

    <!-- Basic form -->
    <div class="panel" id="basic">
        <div class="panel-heading b#c6f9ff">
            <i class="fa fa-pencil-square-o sort-hand"></i>{{ $role->shortTitle }}
            <div class="pan-btn expand"></div>
        </div>
        <div class="panel-body">@include('v1.admin.includes.validation-error')
            <form action="{{route('admin.role.update', $role->id)}}" method="post" enctype="multipart/form-data">
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
                    <label for="title">عنوان(فارسی)</label>
                    <input id="title" name="title" value="{{ old('title') ?: $role->title }}"  placeholder="عنوان" type="text" class="form-control">
                    @if ($errors->has('title'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('title')}}</strong>
                        </div>
                    @endif
                </div><br/>

                <div class="form-group">
                    <span class="field-force">*</span>
                    <label for="name">نام</label>
                    <span popover=""  data-placement="top" data-trigger="hover" data-content="تنها حروف انگلیسی مجاز می باشد. بدون اعداد" data-original-title="" title=""><i class="fa fa-question-circle"></i></span>
                    <span></span>
                    <input id="name" name="name" value="{{ old('name') ?: $role->name }}"  placeholder="نام" type="text" class="form-control">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{$errors->first('name')}}</strong>
                        </div>
                    @endif
                </div><br/>

                @if(count($permissions))
                    <div class="form-group">
                        <span class="field-force">*</span>
                        <label for="permissions">دسترسی ها</label>
                        <span popover=""  data-placement="top" data-trigger="hover" data-content="تعیین دسترسی های مختلف" data-original-title="" title=""><i class="fa fa-question-circle"></i></span>
                        <select id="permissions" multiple="multiple" name="permissions[]" class="form-control">
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}" {{ ($role->permissions->contains($permission->id)  ? "selected": "") }}>{{ $permission->shortTitle }}</option>
                            @endforeach()
                        </select>
                        @if ($errors->has('permissions'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>{{$errors->first('permissions')}}</strong>
                            </div>
                        @endif
                    </div> <br/>
                @endif


                <div class="panel-body">
                    @include('v1.admin.includes.page-table-buttons', ['register'=>TRUE, 'cancel' => ['route' => 'admin.role.index']])
                </div>
            </form>
        </div>
    </div>

    <!-- /End Basic form -->
@endsection
@section('custom_script')
    <script type="text/javascript" src="{{ asset('assets/dashboard/js/bootstrap-multiselect.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#permissions').multiselect({
                enableCaseInsensitiveFiltering: true,
                includeSelectAllOption: true
            });
        });
    </script>
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
@endsection