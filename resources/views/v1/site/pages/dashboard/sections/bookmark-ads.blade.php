<div class="tab-pane fade p-bottom-30" id="favorite" role="tabpanel" aria-labelledby="faborite-listings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="atbd_saved_items_wrapper">
                    <div class="atbd_content_module">
                        <div class="atbd_content_module__tittle_area">
                            <div class="atbd_area_title">
                                <h4><span class="la la-list"></span>آگهی های موردعلاقه</h4>
                            </div>
                        </div>
                        <div class="atbdb_content_module_contents">
                            <div class="table-responsive">
                                @if(count($user->bookmarks))
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">تصویر</th>
                                            <th scope="col">نام آگهی</th>
                                            <th scope="col">دسته</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->bookmarks as $row)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('ads.show', [$row->id, $row->urlTitle]) }}">
                                                        <img src="{{ $row->logo['large'] }}" alt="{{$row->title}}"
                                                             title="{{ $row->shortTitle }}">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ads.show', [$row->id, $row->urlTitle]) }}">{{ $row->category->shortTitle }}</a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ads.all-index', [$row->category->id, 'Category', $row->category->urlTitle]) }}"><span class="la la-list"></span>{{ $row->category->shortTitle }}
                                                    </a></td>
                                                <td><a href="#" class="remove-favorite"><span class="la la-times"></span></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div>
                                        <p style="padding: 1em;">در حال حاضر آگهی انتخاب نکرده اید</p>
                                    </div>
                                @endif
                            </div>
                        </div><!-- ends: .atbdb_content_module_contents -->
                    </div>
                </div><!--  ends: .atbd_saved_items_wrapper -->
            </div><!-- ends: .col-lg-12 -->
        </div>
    </div>
</div><!-- ends: .tab-pane -->
