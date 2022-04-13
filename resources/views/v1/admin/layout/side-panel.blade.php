<!-- side panel -->
<section id="side_panel" class="b#efefe9">
    <div class="board">
        <div class="board-inner">
            <ul class="nav nav-tabs">
                <div class="liner b#ddd"></div>
                <li class="active">
                    <a href="#options" data-toggle="tab">
                        <span class="fa fa-lg fa-cogs round-tabs" tooltip title="تنظیمات"></span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <!-- options tab -->
            <div class="tab-pane fade in active" id="options">
                <ul class="list-group">
                    <li class="list-group-item b#eee">
                        <h4 class="list-group-item-heading">تنظیمات پوسته</h4>
                    </li>


                    <!-- font size -->
                    <li class="list-group-item fs-btn">
                        <p class="list-group-item-heading">اندازه فونت</p>
                        <i class="fa fa-plus fontsize" id="larger"></i>
                        <i class="fa fa-minus fontsize" id="smaller"></i>
                    </li>


                    <!-- top bar color -->
                    <li class="list-group-item top-color-changer">
                        <p class="list-group-item-heading">رنگ نوار بالا</p>
                        <button class="btn btn-primary btn-block">تغییر رنگ نوار بالا به تیره و روشن</button>
                    </li>


                    <!-- menu color -->
                    <li class="list-group-item menu-color-changer">
                        <p class="list-group-item-heading">رنگ منو</p>
                        <button class="b#333333"></button>
                        <button class="b#428bca"></button>
                        <button class="b#232D65"></button>
                        <button class="b#5cb85c"></button>
                        <button class="b#006400"></button>
                        <button class="b#d9534f"></button>
                        <button class="b#921616"></button>
                        <button class="b#800000"></button>
                        <button class="b#deb887"></button>
                        <button class="b#67809F"></button>
                        <button class="b#5f9ea0"></button>
                        <button class="b#d2691e"></button>
                        <button class="b#ff7f50"></button>
                        <button class="b#dc143c"></button>
                        <button class="b#008b8b"></button>
                        <button class="b#b8860b"></button>
                        <button class="b#a9a9a9"></button>
                        <button class="b#bdb76b"></button>
                        <button class="b#daa520"></button>
                        <button class="b#4b0082"></button>
                        <button class="b#ba55d3"></button>
                        <button class="b#dda0dd"></button>
                        <button class="b#2e8b57"></button>
                        <button class="b#ff4500"></button>
                        <button class="b#cd853f"></button>
                        <button class="b#008080"></button>
                        <button class="b#9acd32"></button>
                    </li>


                    <!-- background image -->
                    <li class="list-group-item">
                        <p class="list-group-item-heading">تصویر پس زمینه:</p>
                        <button id="patt_btn" class="btn btn-primary btn-block" data-toggle="modal"
                                data-target="#PatternsModal">
                            نمایش الگوها
                        </button>
                    </li>


                    <!-- menu position -->
                    <li class="list-group-item">
                        موقعیت منو
                        <select id="menu_orient" class="option-select pull-right">
                            <option value="ver" selected>عمودی</option>
                            <option value="hor">افقی</option>
                        </select>
                    </li>


                    <!-- fixed top bar -->
                    <li class="list-group-item">
                        ثابت بودن نوار بالا
                        <div class="material-switch pull-right">
                            <input id="topfix" type="checkbox" checked/>
                            <label for="topfix" class="label-primary"></label>
                        </div>
                    </li>


                    <!-- sticky side bar -->
                    <li class="list-group-item">
                        ستون کناری چسبان
                        <div class="material-switch pull-right">
                            <input id="sidefix" type="checkbox" checked/>
                            <label for="sidefix" class="label-warning"></label>
                        </div>
                    </li>


                    <!-- night mode -->
                    <li class="list-group-item">
                        حالت شب
                        <div class="material-switch pull-right">
                            <input id="nightmode" type="checkbox"/>
                            <label for="nightmode" class="label-default"></label>
                        </div>
                    </li>


                    <!-- boxed layout -->
                    <li class="list-group-item">
                        طرح جعبه ای
                        <div class="material-switch pull-right">
                            <input id="box_option" type="checkbox"/>
                            <label for="box_option" class="label-success"></label>
                        </div>
                    </li>


                    <!-- save btns -->
                    <li class="list-group-item b#eee">
                        <button id="sidepaneltoggle" class="btn btn-info">ذخیره در این زمان</button>
                        <button class="btn btn-primary">ذخیره در کوکی ها</button>
                    </li>
                </ul>
            </div>
            <!-- /End options tab -->

            <div class="clearfix"></div>
        </div>
    </div>
</section>
<!-- /End side panel -->

<!-- sidebar -->
<aside id="sidebar"><!-- This id(=sidebar) is important -->
    <div id="menu_ver" class="theiaStickySidebar t#fff b#428bca">

        <!-- admin details -->
        <div class="well-sm administrator">
            <div class="clearfix">
                <div class="admin-pic col-xs-5">
                    <img alt="Image load error" class="img-rounded" src="{{ asset('assets/dashboard/img/logo.png') }}"
                         data-lity>
                </div>
                <div class="admin-name col-xs-7">
                    <h4 style="margin-top: 26%;">پنل مدیریت</h4>
                </div>
            </div>
            <div class="clearfix">
                <div class="col-xs-4 text-center">
                    <a href="{{route('admin.logout')}}"><i class="fa fa-sign-out fa-2x" tooltip title="خروج"></i></a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="{{--{{route('admin.users.show', Auth::user()->id)}}--}}"><i class="fa fa-user fa-2x"
                                                                                         tooltip title="پروفایل من"></i></a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="{{route('admin.dashboard')}}"><i class="fa fa-home fa-2x" tooltip title="داشبورد"></i></a>
                </div>
            </div>
            <span id="admin_close" class="fa fa-times fa-2x"></span>
        </div>
        <!-- /End admin details -->


        <!-- accordion menu -->
        <div id="cssmenu">
            <ul>
                <!-- Dashboard -->




                @if(Auth::user()->hasPermission(['product.*', '*']))
                    <li class="has-sub">
                        <a>
                            <i class="fa fa-book"></i>
                            مدیریت محصولات
                        </a>
                        <ul>
                            <li><a href="{{ route('admin.product.index') }}">مدیریت محصولات</a></li>
                            <li><a href="{{ route('admin.product-category.index') }}">دسته بندی محصولات</a></li>
                        </ul>
                    </li>
                @endif


                @if(Auth::user()->hasPermission(['payment.*', '*']))
                    <li class="has-sub">
                        <a>
                            <i class="fa fa-credit-card"></i>
                            پرداخت ها
                        </a>
                        <ul>
                            <li><a href="{{ route('admin.payment.index') }}">مدیریت پرداخت ها</a></li>
                        </ul>
                    </li>
                @endif


                @if(Auth::user()->hasPermission(['user.*', '*']))
                <!-- Users -->
                    <li class="has-sub">
                        <a>
                            <i class="fa fa-users"></i>
                            مدیریت کاربران
                        </a>
                        <ul>
                            <li><a href="{{route('admin.user.all')}}">همه کاربران</a></li>
                            <li><a href="{{route('admin.user.all', 'standardUser')}}">کاربران عضو</a></li>
                            <li><a href="{{route('admin.user.all', 'adminUser')}}">مدیرها</a></li>
                            <li><a href="{{route('admin.user.create')}}">افزودن کاربر</a></li>
                        </ul>
                    </li>
                @endif


                <li class="has-sub">
                    <a>
                        <i class="fa fa-cogs"></i>
                        امکانات دیگر
                    </a>
                    <ul>
                        <li><a href="{{route('admin.profile', Auth::user()->id)}}">پروفایل من</a></li>
                    </ul>
                </li>
                <li>

                </li>
                <!-- sign-out -->
                <li>
                    <a href="{{route('admin.logout')}}">
                        <i class="fa fa-sign-out"></i>
                        خروج
                    </a>
                </li>
            </ul>

            <ul id="user_btn" class="pull-right">
                <li><i class="fa fa-user fa-2x"></i></li>
            </ul>
        </div>
        <!-- /End accordion menu -->
    </div>
</aside>
<!-- /End sidebar -->

