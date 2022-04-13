<div class="col-md-4 mt-5 mt-md-0">
    <div class="sidebar">
        <!-- search widget -->

       <div class="widget-wrapper">
            <div class="search-widget">
                <form action="#">
                    <div class="input-group">
                        <input  type="text"
                                class="fc--rounded"
                                placeholder="جستجو در اخبار" autocomplete="off" onkeyup="blogSideSearch()" id="blogSideSearchValue">
                        <button type="submit"><i class="la la-search"></i></button>
                    </div>
                </form>
            </div>
           <div class="search-categories" >
               <ul style=" max-height: 16em; overflow: auto;" id="blogSideSearchOutput" class="list-unstyled">
               </ul>
           </div>
        </div><!-- ends: .widget-wrapper -->

        <!-- category widget -->

        <div class="widget-wrapper">
            <div class="widget-default">
                <div class="widget-header">
                    <h6 class="widget-title">دسته بندی ها</h6>
                </div>
                <div class="widget-content">
                    <div class="category-widget">
                        <ul>
                            @foreach($blogCategories as $category)
                                <li class="arrow-list4"><a href="{{ route('blog.category-blog', ['category' => $category->id, 'title' => $category->urlTitle]) }}">{{ $category->shortTitle }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- ends: .widget-wrapper -->

        <!-- popular post -->

        @if(!empty($topLikes->count()))
            <div class="widget-wrapper">
                <div class="widget-default">
                    <div class="widget-header">
                        <h6 class="widget-title">پست های محبوب</h6>
                    </div>
                    <div class="widget-content">
                        <div class="sidebar-post">
                            @foreach($topLikes as $row)
                                <div class="post-single">
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('blog.show', ['id' => $row->id, 'title' => $row->urlTitle]) }}"><img src="{{ $row->logo['small'] }}" alt="{{$row->title}}" title="{{ $row->title }}"></a>
                                        <p><span>{{ $row->jalali_published_at }}</span> <span>توسط <a href="#">{{$row->admin->full_name}}</a></span></p>
                                    </div>
                                    <a href="{{ route('blog.show', ['id' => $row->id, 'title' => $row->urlTitle]) }}">{{ $row->shortTitle }}</a>
                                </div><!-- ends: .post-single -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div><!-- ends: .widget-wrapper -->
        @endif

        @if(!empty($topViews->count()))
            <div class="widget-wrapper">
                <div class="widget-default">
                    <div class="widget-header">
                        <h6 class="widget-title">پربازدیدترین پست ها</h6>
                    </div>
                    <div class="widget-content">
                        <div class="sidebar-post">
                            @foreach($topViews as $row)
                                <div class="post-single">
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('blog.show', ['id' => $row->id, 'title' => $row->urlTitle]) }}"><img src="{{ $row->logo['small'] }}" alt="{{$row->title}}" title="{{ $row->shortTitle }}"></a>
                                        <p><span>{{ $row->jalali_published_at }}</span> <span>توسط <a href="#">{{$row->admin->full_name}}</a></span></p>
                                    </div>
                                    <a href="{{ route('blog.show', ['id' => $row->id, 'title' =>$row->urlTitle]) }}">{{ $row->shortTitle }}</a>
                                </div><!-- ends: .post-single -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div><!-- ends: .widget-wrapper -->
        @endif
    <!-- popular post -->

            @if(!empty($newBlogs->count()))
            <div class="widget-wrapper">
                <div class="widget-default">
                    <div class="widget-header">
                        <h6 class="widget-title">پست های جدید</h6>
                    </div>
                    <div class="widget-content">
                        <div class="sidebar-post">
                            @foreach($newBlogs as $row)
                                <div class="post-single">
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('blog.show', ['id' => $row->id, 'title' => $row->urlTitle]) }}"><img src="{{ $row->logo['small'] }}" alt="{{$row->title}}" title="{{ $row->title }}"></a>
                                        <p><span>{{ $row->jalali_published_at }}</span> <span>توسط <a href="#">{{$row->admin->full_name}}</a></span></p>
                                    </div>
                                    <a href="{{ route('blog.show', ['id' => $row->id, 'title' => $row->urlTitle]) }}" >{{ $row->shortTitle }}</a>
                                </div><!-- ends: .post-single -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div><!-- ends: .widget-wrapper -->
    @endif
        <!-- Social Connect -->

        <div class="widget-wrapper">
            <div class="widget-default">
                <div class="widget-header">
                    <h6 class="widget-title">اتصال و فالو</h6>
                </div>
                <div class="widget-content">

                    <div class="social social--small">
                        <ul class="d-flex flex-wrap">
                            <li><a href="#" class="facebook"><span class="fab fa-facebook-f"></span></a></li>
                            <li><a href="#" class="twitter"><span class="fab fa-twitter"></span></a></li>
                            <li><a href="#" class="linkedin"><span class="fab fa-linkedin-in"></span></a></li>
                            <li><a href="#" class="gplus"><span class="fab fa-google-plus-g"></span></a></li>
                        </ul>
                    </div><!-- ends: .social -->

                </div>
            </div>
        </div><!-- ends: .widget-wrapper -->
    </div><!-- ends: .sidebar -->
</div><!-- ends: .col-lg-4 -->
