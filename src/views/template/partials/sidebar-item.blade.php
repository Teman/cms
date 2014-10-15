<li class="{{cms_menu($item['route'])}}">
  <a href="{{ route($item['route']) }}">
    @if(isset($item['icon']))
      <i class="fa fa-{{$item['icon']}}"></i>
    @endif
    {{$item['title']}}
  </a>
</li>