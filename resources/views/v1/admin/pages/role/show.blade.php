@extends('v1.admin.layout.default')
@section('content')
    <!-- title and breadcrumb -->
    <div class="clearfix">
        <div class="col-sm-6">
            <h2>دسترسی</h2>
        </div>
        <div class="col-sm-6 breadcrumb-col">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">پیشخوان</a></li>
                <li><span><a href="{{route('admin.role.index')}}">مدیریت دسترسی ها</a></span></li>
                <li><span>جزئیات دسترسی</span></li>
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
                        <i class="fa fa-book sort-hand"></i>{{$role->title}}
                        <div class="pan-btn expand"></div>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12 user-profile-content">
                            <div class="tab-content">

                                <!-- profile -->
                                <div class="panel">
                                    <div class="tab-pane fade in active" id="prof">
                                        <h3 class="t#05a" style="padding-right: 20px; color: rgb(0, 85, 170);">عنوان: <span>{{$role->title}}</span></h3>

                                        <div class="panel-body">
                                            <table class="table">
                                                <tbody>
                                                <tr class="first-table-row">
                                                    <td>عنوان</td>
                                                    <td>{{ $role->title }}</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>نام</td>
                                                    <td>{{ $role->name }}</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>دسترسی ها:</td>
                                                    <td>@if(count($role->permissions))
                                                            <span style="color: green">
                                                                @foreach($role->permissions as $row)
                                                                    <span style="padding-left: 20px;"> {{ $row->short_title }}</span>
                                                                @endforeach
                                                             </span>
                                                        @else<span style="color: red">بدون دسترسی</span>@endif</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>تاریخ ایجاد:</td>
                                                    <td>{{ $role->jalali_admin_created_at }}</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>تاریخ ویرایش:</td>
                                                    <td>{{ $role->jalali_admin_updated_at }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <a href="{{route('admin.role.index')}}" class="btn btn-warning" d title="بازگشت" tooltip><i class="fa fa-forward"></i></a>
                                        <a href="{{route('admin.role.edit', $role->id)}}" class="btn btn-success" title="ویرایش" tooltip><i class="fa fa-pencil"></i></a>
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
