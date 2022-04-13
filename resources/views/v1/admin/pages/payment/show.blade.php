@extends('v1.admin.layout.default')
@section('content')
    <!-- title and breadcrumb -->
    <div class="clearfix">
        <div class="col-sm-6">
            <h2>جزئیات پرداخت</h2>
        </div>
        <div class="col-sm-6 breadcrumb-col">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">پیشخوان</a></li>
                <li><span><a href="{{route('admin.payment.index')}}">مدیریت پرداخت ها</a></span></li>
                <li><span>جزئیات پرداخت</span></li>
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
                        <i class="fa fa-book sort-hand"></i>شماره {{$payment->id}}
                        <div class="pan-btn expand"></div>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12 user-profile-content">
                            <div class="tab-content">

                                <!-- profile -->
                                <div class="panel">
                                    <div class="tab-pane fade in active" id="prof">
                                        <h3 class="t#05a" style="padding-right: 20px; color: rgb(0, 85, 170);">شماره پرداخت: <span>{{$payment->id}}</span></h3>

                                        <div class="panel-body">
                                            <table class="table">
                                                <tbody>
                                                <tr class="first-table-row">
                                                    <td>شناسه پرداخت:</td>
                                                    <td>{{ $payment->id }}</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>سفارش:</td>
                                                    <td>@if(!empty($payment->order))<a href="{{ route('admin.order.show', $payment->order->id) }}">شماره {{ $payment->order->id }}</a>@else حذف شده @endif</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>کاربر:</td>
                                                    <td>@if(!empty($payment->user))<a href="{{ route('admin.user.show', $payment->user->id) }}">{{ $payment->user->full_name }}</a>@else حذف شده @endif</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>قیمت:</td>
                                                    <td>{{ $payment->price_toman }}</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>شماره پیگیری:</td>
                                                    <td>{{ $payment->trans_id }}</td>
                                                </tr>
                                                <tr>
                                                    <td>وضعیت پرداخت:</td>
                                                    <td>@if($payment->is_success)<span style="color: green">پرداخت موفق</span>@else<span style="color: red">پرداخت ناموفق</span>@endif</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>جزئیات پرداخت:</td>
                                                    <td>{{  $payment->description  }}</td>
                                                </tr>
                                                <tr class="first-table-row">
                                                    <td>تاریخ ایجاد:</td>
                                                    <td>{{ $payment->jalali_admin_created_at }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <a href="{{route('admin.payment.index')}}" class="btn btn-warning" title="بازگشت" tooltip><i class="fa fa-home"></i></a>
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
