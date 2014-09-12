<div class="col-sm-3 col-md-2 sidebar" role="navigation">

         @foreach( $adminMenuItems as $adminMenuItem)
           @if(isset($adminMenuItem['permission']))
                @if($currentUser->can($adminMenuItem['permission']))
                     <h4>{{ $adminMenuItem['title'] }}</h4>
                     <ul class="nav nav-sidebar">
                      @foreach($adminMenuItem['adminMenuItems_subCategory'] as $subCat)
                        @if(isset($subCat['permission']))
                            @if($currentUser->can($subCat['permission']))
                                <li>
                                       <a href="{{ route($subCat['route']) }}" class="clearfix listItem">
                                           @if(isset($subCat['iconClass']) AND $subCat['iconClass'])
                                                <i class="{{$subCat['iconClass']}}"></i>
                                                 <div class="sidebar_hasIcon">{{$subCat['title'] }}</div>
                                           @else
                                             <div class="sidebar_noIcon">{{$subCat['title'] }}</div>
                                           @endif

                                       </a>
                               </li>
                            @endif
                        @else
                             <li>
                                 <a href="{{ route($subCat['route']) }}" class="clearfix listItem">
                                     @if(isset($subCat['iconClass']) AND $subCat['iconClass'])
                                     <i class="{{$subCat['iconClass']}}"></i>
                                     <div class="sidebar_hasIcon">{{$subCat['title'] }}</div>
                                     @else
                                     <div class="sidebar_noIcon">{{$subCat['title'] }}</div>
                                     @endif
                                 </a>
                             </li>
                        @endif
                    @endforeach
                       </ul>
                @endif
           @else
                <h4>{{ $adminMenuItem['title'] }}</h4>
                <ul class="nav nav-sidebar">
                    @foreach($adminMenuItem['adminMenuItems_subCategory'] as $subCat)
                        @if(isset($subCat['permission']))
                            @if($currentUser->can($subCat['permission']))
                                <li>
                                    <a href="{{ route($subCat['route']) }}" class="clearfix listItem">
                                        @if(isset($subCat['iconClass']) AND $subCat['iconClass'])
                                        <i class="{{$subCat['iconClass']}}"></i>
                                        <div class="sidebar_hasIcon">{{$subCat['title'] }}</div>
                                        @else
                                        <div class="sidebar_noIcon">{{$subCat['title'] }}</div>
                                        @endif
                                    </a>
                                </li>
                            @endif
                        @else
                        <li>
                            <a href="{{ route($subCat['route']) }}" class="clearfix listItem">
                                @if(isset($subCat['iconClass']) AND $subCat['iconClass'])
                                <i class="{{$subCat['iconClass']}}"></i>
                                <div class="sidebar_hasIcon">{{$subCat['title'] }}</div>
                                @else
                                <div class="sidebar_noIcon">{{$subCat['title'] }}</div>
                                @endif
                            </a>
                        </li>
                        @endif
                    @endforeach
                </ul>
            @endif
         @endforeach
</div>
