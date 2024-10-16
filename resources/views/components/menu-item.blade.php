
<li>
    @if(isset($items) && count($items) > 0)




        @php($uniqueId = uniqid())
    <li>
        <a href="#{{$uniqueId}}" data-bs-toggle="collapse">
            <i  class="{{$icon}}" ></i>
            <span>  {{ __($title) }} </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="{{$uniqueId}}">
            <ul class="nav-second-level">
                @foreach ($items as $item)
                    <li>
                        <a href="{{ isset($item['link']) ? $item['link'] : route($item['route']) }}"> {{ __($item['title']) }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </li>

    @else

        <li>
            <a href="{{ isset($link) ? $link : route($route) }}">
                <i class="{{$icon}}" ></i>
                <span> {{ __($title) }} </span>
            </a>
        </li>
   @endif
</li>
