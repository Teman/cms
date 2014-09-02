
<div class="col-sm-3 col-md-2 sidebar" role="navigation">

    @if(isset($categorieItems))
         @foreach($categorieItems as $categorieItem)
           @if($categorieItem['permission'] == 'acces_cms')
             <h4>{{$categorieItem['title']}}</h4>
                <ul class="nav nav-sidebar">
                    @foreach($categorieItem['subCategorieItems'] as $subCat)
                        @if($subCat['permission'] == 'acces_cms')
                            <li>
                                   <a href="{{ route($subCat['route']) }}" class="clearfix listItem">
                                            <i class="{{$subCat['Iclass']}}"></i>
                                            <div>{{$subCat['itemText'] }}</div>
                                   </a>
                           </li>
                        @endif
                    @endforeach
                </ul>
           @endif
         @endforeach
    @endif

</div>
