<div class="tab-pane fade show" id="listings" role="tabpanel" aria-labelledby="all-listings">
    <div class="container">
        <div class="row">
            @if(!empty($user->activeAds->count()))
                @foreach($user->activeAds as $row)
                    <div class="col-lg-4 col-sm-6">
                        <div class="atbd_single_listing ">
                            @include('v1.site.includes.ads-block')
                        </div>
                    </div><!-- ends: .col-lg-4 -->
                @endforeach
            @else
                <p>در حال حاضر آگهی ثبت نکرده اید</p>
            @endif
        </div>
    </div>
</div><!-- ends: .tab-pane -->
