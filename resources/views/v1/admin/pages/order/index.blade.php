@extends('v1.admin.layout.default')
@section('custom_style')
    @include('v1.admin.includes.datatable-styles')
@endsection
@section('content')
    <!-- title and breadcrumb -->
    <div class="clearfix">
        <div class="col-sm-6">
            <h2>مدیریت سفارش ها</h2>
        </div>
        <div class="col-sm-6 breadcrumb-col">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">پیشخوان</a></li>
                <li><a href="{{route('admin.order.index')}}">سفارش های کاربران</a></li>
                <li>{{$subSequence['title']}}</li>
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
                        <i class="fa fa-book sort-hand"></i>{{$subSequence['title']}}
                        <div class="pan-btn expand"></div>
                    </div>
                    <div class="panel-body">
                        @if(count($orders))
                            <div class="panel-body">
                                <h2>{{$subSequence['title']}}</h2><br/>
                                <table id="example" class="table table-condensed table-hover table-striped table-responsive data-table">
                                    <thead>
                                    <tr>
                                        <th data-column-id="id" >شناسه</th>
                                        <th data-column-id="order_number" >شماره سفارش</th>
                                        <th data-column-id="mobile">موبایل</th>
                                        <th data-column-id="user">کاربر</th>
                                        <th data-column-id="is_gift">هدیه به کاربر</th>
                                        <th data-column-id="order">بسته موسیقی</th>
                                        <th data-column-id="total_price">قیمت کل</th>
                                        <th data-column-id="descount_price">تخفیف</th>
                                        <th data-column-id="issuccess">وضعیت</th>
                                        <th data-column-id="createdat">زمان ایجاد</th>
                                        <th class="my_commands" data-column-id="commands" data-sortable="false" style="text-align: center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $row)
                                        <tr class="clickable-row" data-url="{{route('admin.order.show', $row->id)}}">
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $row->order_number }}</td>
                                            <td>@if(!empty($row->user))<a href="{{ route('admin.user.show', $row->user->id) }}">{{ $row->user->mobile }}</a>@else حذف شده @endif</td>
                                            <td>@if(!empty($row->user))<a href="{{ route('admin.user.show', $row->user->id) }}">{{ $row->user->full_name }}</a>@else حذف شده @endif</td>
                                            <td>@if(!empty($row->giftUser))<a href="{{ route('admin.user.show', $row->giftUser->id) }}">{{ $row->giftUser->mobile }}</a>@else عدم هدیه @endif</td>
                                            <td>@if(!empty($row->package))<a href="{{ route('admin.package.show', $row->package->id) }}">{{ $row->package->short_title }}</a>@else حذف شده @endif</td>
                                            <td>{{ $row->total_price_toman}}</td>
                                            <td>{{ $row->discount_price_toman }}</td>
                                            <td>@if($row->status->name == 'completed')<span style="color: green">{{$row->status->title}}</span>@else<span style="color: RED">{{ $row->status->title }}</span>@endif</td>
                                            <td>{{ $row->jalali_admin_created_at}}</td>
                                            <td>
                                                @include('v1.admin.includes.page-table-buttons', [
                                                'table_show'=>['route' => 'admin.order.show', 'id' => $row->id]])
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                                {!! $orders->render() !!}

                                @else
                                    <p>در حال حاضر اطلاعاتی وجود ندارد!</p>
                                @endif
                            </div>
                    </div>
                </div>
                <!-- /End Basic table -->
            </td>
        </tr>
    </table>
@endsection
@section('custom_script')
    @include('v1.admin.includes.datatable-scripts')
    <script type="text/javascript">
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
            @endif
            {{session()->forget('notifications')}}

        });
    </script>
@endsection
