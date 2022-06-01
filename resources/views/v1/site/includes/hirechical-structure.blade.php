    <span class="cat-trigger"></span>
    <ul class="atbdp_child_category">
        @foreach($childs as $child)
        <li>
            <a href="{{route('ads.all-index',[$child->id, 'Category', $child->urlTitle ])}}">{{ $child->shortTitle }}</a>
            @if(count($child->childs))
                @include('v1.site.includes.hirechical-structure',['childs' => $child->childs])
            @endif
        </li>
        @endforeach
    </ul>
