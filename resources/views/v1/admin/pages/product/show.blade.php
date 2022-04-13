@extends('v1.admin.layout.default')
@section('content')
    <!-- title and breadcrumb -->
    <div class="clearfix">
        <div class="col-sm-6">
            <h2>محصولات</h2>
        </div>
        <div class="col-sm-6 breadcrumb-col">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">پیشخوان</a></li>
                <li><span><a href="{{route('admin.product.index')}}">مدیریت محصولات</a></span></li>
                <li><span>جزئیات محصولات</span></li>
            </ol>
        </div>

    </div>
    <!-- /End title and breadcrumb -->

    <table id="content_table">
        <tr class="row1">
            <td id="column0" class="connectcolumn" colspan="2">

                <!-- Basic table -->
                <div class="panel" id="basic">
                    <div class="panel-heading b#ffe7ff">
                        <i class="fa fa-book sort-hand"></i>{{$product->name}}
                        <div class="pan-btn expand"></div>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12 user-profile-content">
                            <div class="tab-content">

                                <!-- profile -->
                                <div class="panel">
                                    <div class="tab-pane fade in active" id="prof">
                                        <h3 class="t#05a" style="padding-right: 20px;color: rgb(0, 85, 170);">عنوان: <span>{{$product->name}}</span></h3>

                                        <div class="panel-body">
                                            <table class="table">
                                                <tbody>

                                                <tr class="first-table-row">
                                                    <td>دسته بندی:</td>
                                                    <td>{{ $product->category->title }}</td>
                                                </tr>

                                                <tr class="first-table-row">
                                                    <td>دسته بندی:</td>
                                                    <td>{{ $product->category_type }}</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>وضعیت موجودی:</td>
                                                    <td>@if($product->available)<span style="color: green">موجود</span>@else<span style="color: red">ناموجود</span>@endif</td>
                                                </tr>

                                                <tr class="first-table-row">
                                                    <td>برگزیده:</td>
                                                    <td>@if($product->is_fav)<span style="color: green">بله</span>@else<span style="color: red">خیر</span>@endif</td>
                                                </tr>

                                                <tr class="first-table-row">
                                                    <td>قیمت:</td>
                                                    <td>{{ $product->rate }}</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>حداقل:</td>
                                                    <td>{{ $product->min}}</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>حداکثر:</td>
                                                    <td>{{ $product->max }}</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>توضیحات:</td>
                                                    <td>{{ $product->description }}</td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <a href="{{route('admin.product.index')}}" class="btn btn-warning" d title="بازگشت" tooltip><i class="fa fa-home"></i></a>
                                        <a href="{{route('admin.product.edit', $product->id)}}" class="btn btn-success" title="ویرایش" tooltip><i class="fa fa-pencil"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
@endsection

@section('custom_script')
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
