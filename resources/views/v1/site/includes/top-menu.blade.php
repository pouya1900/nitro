<div class="mainmenu-wrapper">
    <div class="menu-area menu1 menu--light">
        <div class="top-menu-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="menu-fullwidth">
                            <div class="logo-wrapper order-lg-0 order-sm-1">
                                <div class="logo logo-top">
                                    <a href="{{ route('index') }}"><img
                                            src="{{ asset('assets/index/img/logo-white.png') }}" alt="qiqoo logo"
                                            class="img-fluid"></a>
                                </div>
                            </div><!-- ends: .logo-wrapper -->


                            <div class="menu-container order-lg-1 order-sm-0">
                                <div class="d_menu">
                                    <nav class="navbar navbar-expand-lg mainmenu__menu">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                                data-target="#direo-navbar-collapse"
                                                aria-controls="direo-navbar-collapse"
                                                aria-expanded="false" aria-label="Toggle navigation">
                                                <span class="navbar-toggler-icon icon-menu"><i
                                                        class="la la-reorder"></i></span>
                                        </button>
                                        <!-- Collect the nav links, forms, and other content for toggling -->
                                        <div class="collapse navbar-collapse" id="direo-navbar-collapse">
                                            <ul class="navbar-nav">

                                                <li class="navbar-nav">
                                                    <a href="{{ route('index') }}">خانه</a>
                                                </li>
                                                <li class="dropdown has_dropdown">
                                                    <a href="{{ route('ads.grid-index') }}" class="dropdown-toggle"
                                                       id="drop1" role="button"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">آگهی ها</a>
                                                    <ul class="dropdown-menu" aria-labelledby="drop1">
                                                        <li><a href="{{ route('ads.grid-index') }}">همه آگهی ها</a></li>
                                                        <li><a href="{{ route('ads.category') }}">دسته بندی ها</a></li>
                                                        <li><a href="{{ route('ads.city') }}">مکان ها</a></li>
                                                    </ul>
                                                </li>

                                                <li class="navbar-nav">
                                                    <a href="{{route('blog.index')}}">اخبار</a>
                                                </li>
                                                <li class="navbar-nav">
                                                    <a href="{{route('contact-us')}}">تماس با ما</a>
                                                </li>
                                                <li class="navbar-nav">
                                                    <a href="{{route('about-us')}}">درباره ما</a>
                                                </li>
                                                <li class="navbar-nav">
                                                    <a href="{{route('faq')}}">سوالات متداول</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <!-- /.navbar-collapse -->
                                    </nav>
                                </div>
                            </div>


                            <div class="menu-right order-lg-2 order-sm-2">
                                <div class="search-wrapper">
                                    <div class="nav_right_module search_module">
                                            <span class="icon-left" id="basic-addon9"><i
                                                    class="la la-search"></i></span>
                                        <div class="search_area">
                                            <form>
                                                <div class="input-group input-group-light">
                                                    <input type="text"
                                                           class="form-control search_field top-search-field"
                                                           placeholder="پیدا کنید" autocomplete="off"
                                                           onkeyup="topMenuSearch()" id="topMenuSearchValue">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="search-categories">
                                        <ul style=" max-height: 16em; overflow: auto;" id="topMenuSearchOutput"
                                            class="list-unstyled">
                                        </ul>
                                    </div>
                                </div><!-- ends: .search-wrapper -->
                                <!-- start .author-area -->
                                <div class="author-area">
                                    <div class="author__access_area">
                                        <ul class="d-flex list-unstyled align-items-center">
                                            <li>
                                                <a href="{{ route('ads.create') }}"
                                                   class="btn btn-xs btn-gradient btn-gradient-two">
                                                    <span class="la la-plus"></span> افزودن آگهی
                                                </a>
                                            </li>
                                            @guest
                                                <li>
                                                    <a href="{{ route('login') }}" class="access-link">ورود</a>
                                                    <span>یا</span>
                                                    <a href="{{ route('login') }}" class="access-link">ثبت نام</a>
                                                </li>
                                            @endguest
                                        </ul>
                                    </div>
                                </div>
                                <!-- end .author-area -->

                                @auth
                                    <div class="offcanvas-menu">
                                        <a href="#" class="offcanvas-menu__user">
                                            <img src="{{ Auth::user()->avatar['tiny'] }}" alt="{{ Auth::user()->fullName }}" class="rounded-circle">
                                        </a>
{{--                                        <a href="#" class="offcanvas-menu__user">--}}
{{--                                            <img src="{{ Auth::user()->avatar['tiny'] }}">--}}
{{--                                        </a>--}}
                                        <div class="offcanvas-menu__contents">
                                            <a href="#" class="offcanvas-menu__close"><i class="la la-times-circle"></i></a>
                                            <div class="author-avatar">
                                                <img src="{{ Auth::user()->avatar['small'] }}" alt="{{ Auth::user()->fullName }}" class="rounded-circle">
                                            </div>
                                            <ul class="list-unstyled">
                                                <li><a href="{{ route('user.dashboard') }}">داشبورد</a></li>
                                                <li>
                                                    <a href="{{ route('user.profile', ['id' => Auth::user()->id, 'name' => Auth::user()->url_name]) }}">پروفایل
                                                        من</a></li>
                                                <li><a href="{{ route('ads.create')}}">افزودن آگهی</a></li>
                                                <li><a href="{{ route('logout') }}">خروج</a></li>
                                            </ul>
                                        </div><!-- ends: .author-info -->
                                    </div><!-- ends: .offcanvas-menu -->
                                @endauth
                            </div><!-- ends: .menu-right -->
                        </div>
                    </div>
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end  -->
    </div>
</div><!-- ends: .mainmenu-wrapper -->
