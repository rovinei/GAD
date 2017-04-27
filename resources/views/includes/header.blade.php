<div class="main-menu-w hide-main-m">
    <div class="">
    <nav class="container cbp-hsmenu-wrapper" id="cbp-hsmenu-wrapper">
        <div class="cbp-hsinner">
            <ul class="cbp-hsmenu">
                <li>  <a href="{{ url()}}"><i class="glyphicon glyphicon-home"></i></a></li>
                @foreach($menus as $key=> $menu)
                <li data-open="" class="">
                    <a href="{!!$menu->category()->first() ? url('menu/'.$menu->id.'/categories/'.$menu->category()->first()->id.'/projects') : $menu->external_url ?:'#'!!}">{!! $menu->translation(Lang::locale())->first() ? $menu->translation(Lang::locale())->first()->title: $menu->title !!}</a>
                    @if($menu->category()->first())
                    <div id ="cbp-container">
                    <ul class="cbp-hssubmenu">
                        @foreach($menu->category()->first()->categories()->orderBy('ordering')->get()  as $category)
                        <li>
                            <a href="{{url('menu/'.$menu->id.'/categories/'.$category->id.'/projects')}}"><img src="{{$category->image}}" alt="img02">
                                <span>{!! $category->translation(Lang::locale())->first() ? $category->translation(Lang::locale())->first()->title: $category->title !!}</span>
                            </a>
                            @if($category->categories()->count()>0)
                             <ul class="chil-sub-cat">
                                @foreach($category->categories()->orderBy('ordering')->get() as $subCategory)
                                <li><a href="{{url('menu/'.$menu->id.'/categories/'.$subCategory->id.'/projects')}}"><span>{{$subCategory->translation(Lang::locale())->first() ? $subCategory->translation(Lang::locale())->first()->title: $subCategory->title }}</span></a></li>
                                @endforeach
                             </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    </div>
                    @endif
                </li>
            @endforeach
            <!--search box-->
            <div class="search_box"> 
                <form action="{{URL::to('categories/projects/search/')}}" id="SEARCH" method="GET">
                    <div class="input-group stylish-input-group">
                        <input type="text" class="form-control" placeholder="@lang('application.search')" id="txtSearch" name="search">
                        <span class="input-group-addon">
                            <button type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>  
                        </span>
                    </div>
                </form>
             </div>
             <!--search box-->
            </ul>
        </div>
    <div class="cbp-hsmenubg" style="height: 0px;"></div></nav>
    </div>
</div>
