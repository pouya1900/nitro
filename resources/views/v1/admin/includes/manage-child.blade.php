
<ul>
    @foreach($childs as $child)
    <li>
        @if(count($child->childs))<i class="indicator fa fa-plus-circle"></i> @endif
        {{ $child->shortTitle }}
        @if(count($child->childs))
            @include('v1.admin.includes.manage-child',['childs' => $child->childs])
        @endif
    </li>
    @endforeach
</ul>
