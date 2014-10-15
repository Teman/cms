<div class="col-sm-3 col-md-2" role="navigation">
    @foreach( $adminMenuItems as $adminMenuItem)
        @if(isset($adminMenuItem['permission']))
            @if($currentUser->can($adminMenuItem['permission']))
                 <h4>{{ $adminMenuItem['title'] }}</h4>
                 <ul class="nav nav-pills nav-stacked">
                  @foreach($adminMenuItem['adminMenuItems_subCategory'] as $subCat)
                    @if(isset($subCat['permission']))
                        @if($currentUser->can($subCat['permission']))
                            @include('cms::template.partials.sidebar-item',['item'=>$subCat])
                        @endif
                    @else
                        @include('cms::template.partials.sidebar-item',['item'=>$subCat])
                    @endif
                @endforeach
                   </ul>
            @endif
        @else
            <h4>{{ $adminMenuItem['title'] }}</h4>
            <ul class="nav nav-pills nav-stacked">
                @foreach($adminMenuItem['adminMenuItems_subCategory'] as $subCat)
                    @if(isset($subCat['permission']))
                        @include('cms::template.partials.sidebar-item',['item'=>$subCat])
                    @else
                        @include('cms::template.partials.sidebar-item',['item'=>$subCat])
                    @endif
                @endforeach
            </ul>
        @endif
    @endforeach
</div>