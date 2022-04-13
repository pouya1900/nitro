<article class="atbd_single_listing_wrapper">
    <figure class="atbd_listing_thumbnail_area">
        <div class="atbd_listing_image">
            <a href="{{ route('ads.show',  ['id' => $row->id, 'title' => $row->urlTitle]) }}">
                <img src="{{ $row->logo['large'] }}"
                     alt="{{$row->title}}" title="{{ $row->shortTitle }}">
            </a>
        </div><!-- ends: .atbd_listing_image -->
        <div class="atbd_author atbd_author--thumb">
            <a href="{{ route('user.profile', [$row->user->id, $row->user->fullName]) }}">
                <img src="{{ $row->user->avatar['tiny'] }}"
                     alt="{{ $row->user->fullName }}">
                <span class="custom-tooltip">{{ $row->user->fullName }}</span>
            </a>
        </div>
        <div class="atbd_thumbnail_overlay_content">
            <ul class="atbd_upper_badge">
                @if($row->is_vip)
                    <li><span class="atbd_badge atbd_badge_featured">ویژه</span>
                    </li>@endif
                @if($row->is_popular)
                    <li><span class="atbd_badge atbd_badge_popular">محبوب</span>
                    </li>@endif
                @if($row->is_new)
                    <li><span class="atbd_badge atbd_badge_new">جدید</span>
                    </li>@endif
            </ul><!-- ends .atbd_upper_badge -->
        </div><!-- ends: .atbd_thumbnail_overlay_content -->
    </figure><!-- ends: .atbd_listing_thumbnail_area -->

    <div class="atbd_listing_info">
        <div class="atbd_content_upper">
            <h4 class="atbd_listing_title">
                <a href="{{ route('ads.show', ['id' => $row->id, 'title' => $row->urlTitle]) }}">{{ $row->shortTitle }}</a>
            </h4>

            <div class="atbd_listing_meta">
                <span class="atbd_meta atbd_listing_rating">{{ $row->scoreAverage }}<i
                                                                class="la la-star"></i></span>

                <a href="{{ route('ads.show',  ['id' => $row->id, 'title' => $row->urlTitle]) }}" title="جزییات"><span class="atbd_meta atbd_listing_price">نمایش جزییات</span></a>

            </div><!-- End atbd listing meta -->
            <div class="atbd_listing_data_list">
                <ul>
                    <li>
                        <p>
                            <span class="la la-map-marker"></span>{{$row->city->title}}
                            ، {{ $row->country->title }}</p>
                    </li>
                    <li>
                        <p><span class="la la-phone"></span>{{ $row->phone }}
                        </p>
                    </li>
                    <li>
                        <p>
                            <span class="la la-calendar-check-o"></span>{{ $row->jalaliUserCreatedAt }}
                        </p>
                    </li>
                </ul>
            </div><!-- End atbd listing meta -->

        </div><!-- end .atbd_content_upper -->

        <div class="atbd_listing_bottom_content">
            <div class="atbd_content_left">
                <div class="atbd_listing_category">
                    <a href="{{route('ads.all-index',[$row->category->id, 'Category', $row->urlTitle])}}">
                        <span class="la la-list"></span>{{ $row->category->title }}
                    </a>
                </div>
            </div>
            <ul class="atbd_content_right">
                <li class="atbd_count"><span
                        class="la la-eye"></span>{{ $row->viewCount }}</li>


            </ul>
        </div><!-- end .atbd_listing_bottom_content -->
    </div><!-- ends: .atbd_listing_info -->
</article><!-- atbd_single_listing_wrapper -->
