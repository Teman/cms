
<div class="col-sm-3 col-md-2 sidebar" role="navigation">

    @if(isset($categorieItems))
         @foreach($categorieItems as $categorieItem)
             <h4>{{$categorieItem['title']}}</h4>
                <ul class="nav nav-sidebar">
                    @foreach($categorieItem['subCategorieItems'] as $subCat)
                    <li>
                           <a href="{{ route($subCat['route']) }}" class="clearfix listItem">
                                    <i class="{{$subCat['Iclass']}}"></i>
                                    <div>{{$subCat['itemText'] }}</div>
                           </a>
                   </li>
                    @endforeach
                </ul>
            @endforeach
    @endif

</div>
