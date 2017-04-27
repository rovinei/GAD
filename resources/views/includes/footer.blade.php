<div class="footer_site">
    <div class="footer_content">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h1 class="footer_headline">@lang('application.contactus')</h1>
                    <p>
                        <i class="glyphicon glyphicon-earphone"></i>  @lang('application.telephone')<br />
                        <i class="glyphicon glyphicon-envelope"></i>  info@green-globale.com
                    </p>
                    <p>
                        @lang('application.contactaddress')
                    </p>
                </div>

                 <div class="col-md-3"><h1 class="footer_headline">@lang('application.menu')</h1>
                    <ul>
                        <li><a href="{{url()}}">HOME</a></li>
                    @foreach($menus as $key=> $menu)
                        <li><a href="{!!$menu->category()->first() ? url('menu/'. $menu->id .'/categories/'.$menu->category()->first()->id.'/projects') : $menu->external_url ?:'#'!!}">{!! $menu->translation(Lang::locale())->first() ? $menu->translation(Lang::locale())->first()->title: $menu->title !!}</a></li>
                    @endforeach
                    </ul>
                 </div>
                <div class="col-md-4">
                    <div class="fb-page" data-href="https://www.facebook.com/greenglobal855" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/greenglobal855"><a href="https://www.facebook.com/greenglobal855">Green Global Architecture Design &amp; Construction Co., Ltd</a></blockquote></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="box_copy_right">
        <!--@lang('application.copyright')-->
        {!! $settings->translationCopyright(Lang::locale())!!}
    </div>
</div>