<!--responsive menu-->
<div class="toggle-menu">
     <div class="cd-dropdown-wrapper">
        <a class="cd-dropdown-trigger" href="#0">MENU<i class="fa fa-bars"></i></a>
        <nav class="cd-dropdown">
            <h2> <i class="fa fa-bars"></i> MENU </h2>
            <a href="#0" class="cd-close">Close</a>
            <ul class="cd-dropdown-content"> 
                <li>
                    <form action="{{URL::to('categories/projects/search/')}}" id="SEARCH" class="cd-search" method="GET">
                        <div class="input-group stylish-input-group">
                            <input type="text" class="form-control" placeholder="@lang('application.search')" id="txtSearch" name="search">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>  
                            </span>
                        </div>
                    </form>
                </li>
                @foreach($menus as $key=> $menu)
                <li class="@if($menu->category()->first())
                            has-children
                           @endif">
                    <a href="{!!$menu->category()->first() ? url('menu/'.$menu->id.'/categories/'.$menu->category()->first()->id.'/projects') : $menu->external_url ?:'#'!!}">{!! $menu->translation(Lang::locale())->first() ? $menu->translation(Lang::locale())->first()->title: $menu->title !!}</a>
                    <ul class="cd-secondary-dropdown is-hidden">
                    @if($menu->category()->first())
                        <li class="go-back"><a href="#0">{{$menu->title}}</a></li>
                        <li class="see-all"><a href="{!!$menu->category()->first() ? url('menu/'.$menu->id.'/categories/'.$menu->category()->first()->id.'/projects') : $menu->external_url ?:'#'!!}">All {{$menu->title}}</a></li>
                        @foreach($menu->category()->first()->categories()->orderBy('ordering')->get()  as $category)
                        <li class="@if($category->categories()->count()>0) has-children @endif">
                            <a href="{{url('menu/'.$menu->id.'/categories/'.$category->id.'/projects')}}">
                                <span>{!! $category->translation(Lang::locale())->first() ? $category->translation(Lang::locale())->first()->title: $category->title !!}</span>
                            </a>
                            @if($category->categories()->count()>0)
                            <ul class="is-hidden">
                                <li class="go-back"><a href="#0">{{$category->title}}</a></li>
                                <li class="see-all"><a href="{{url('menu/'.$menu->id.'/categories/'.$category->id.'/projects')}}">All {{$category->title}}</a></li>
                                @foreach($category->categories()->orderBy('ordering')->get() as $subCategory)
                                <li><a href="{{url('menu/'.$menu->id.'/categories/'.$subCategory->id.'/projects')}}"><span>{{$subCategory->translation(Lang::locale())->first() ? $subCategory->translation(Lang::locale())->first()->title: $subCategory->title }}</span></a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    @endif
                    </ul> <!-- .cd-secondary-dropdown -->
                </li>
                @endforeach
                <li class="cd-divider">&nbsp&nbsp&nbsp&nbsp @lang('application.language'):</li>
                <li><a href="{{url('locale/kh')}}" title="KHMER"><img src="{{asset('/images/kh_lan.gif')}}" /> KHMER</a>
                <li><a href="{{url('locale/en')}}" title="ENGLISH"><img src="{{asset('/images/en_lan.gif')}}" /> ENGLISH</a></li>
                <li><a href="{{url('locale/ch')}}" title="CHINESE"><img src="{{asset('/images/ch_lan.gif')}}" /> CHINESE</a></li></li>
            </ul> <!-- .cd-dropdown-content -->
        </nav> <!-- .cd-dropdown -->
    </div> <!-- .cd-dropdown-wrapper -->
</div><!-- / Responsive menu-->