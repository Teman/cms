<li class="{{cms_menu($item['route'])}}">
  <a href="{{ route($item['route']) }}">
    @if(isset($item['iconClass']))
      <i class="{{$item['iconClass']}}"></i>
    @endif
    {{$item['title']}}
  </a>
</li>