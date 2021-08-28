@php $breadcrumbs = Breadcrumb::$breadcrumb; $count = count($breadcrumbs)-1; @endphp
@if(!empty($breadcrumbs) && is_array($breadcrumbs) && count($breadcrumbs) > 1)
    <ul class="breadcrumb clearfix">
        @foreach($breadcrumbs as $key => $value)
            <li>
                @if($key !== $count)
                <a href="{{$value['link']}}">
                    {{ summary($value["name"],55) }}
                </a>
                @else
                    <span> {{ summary($value["name"],55) }}</span>
                @endif
            </li>
        @endforeach
    </ul>
@endif