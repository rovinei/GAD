<!DOCTYPE html>
<html lang="{{Lang::locale()}}">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>{{{$settings->meta_title}}}</title>
    <meta name="keywords" content="{{{ $settings->meta_keyword}}}">
	<meta name="description" content="{{{ $settings->meta_description}}}">
    <meta name="author" content="{{{ $settings->translationCompanyName(Lang::locale()) }}}">
    @yield('facebook')

    <!-- JQuery -->
    <script type="text/javascript" src="{{asset('/plugins/fancybox/lib/jquery-1.10.1.min.js')}}"></script>

	<!--Plugin and default Stylesheets -->
	 <link href="{{ asset('/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
	 <link href="{{ asset('/bootstrap/css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
	 <link href="{{ asset('/dist/css/style.css')}}" rel="stylesheet" type="text/css" />
	
     <!-- select -->
     <link href="{{ asset('/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
     <!-- slider -->
     <link href="{{ asset('/dist/css/owl-carousel.css')}}" rel="stylesheet" type="text/css" />

	 <!-- Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' 
type='text/css'>
	<link href="http://fonts.googleapis.com/css?family=Raleway:400,900,800,700,500,200,100,600" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />

    <script src="{{ asset('/dist/js/vendor/modernizr-2.6.2.min.js')}}"></script>
	<!-- favicon -->
	<link rel="shortcut icon" href="{{ asset('/images/favicon.ico')}}" type="image/x-icon" />

    <!-- dropdown menu thumnail -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/dropdown-menu/css/default.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/dropdown-menu/css/component.css')}}" />
    <script src="{{ asset('/plugins/dropdown-menu/js/modernizr.custom.js')}}"></script>

    <!-- popup master -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/bpopup-master/style-popup.css')}}" />
    

    <!--fancybox -->
     
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/fancybox/source/jquery.fancybox.css?v=2.1.5')}}" media="screen" />
    <!-- Add Button helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5')}}" />
    <!-- Add Thumbnail helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7')}}" />
    <style>
        .pagination>.active>a, 
        .pagination>.active>a:focus, 
        .pagination>.active>a:hover, 
        .pagination>.active>span, 
        .pagination>.active>span:focus, 
        .pagination>.active>span:hover {
            background-color: #00A65A;
            border-color: #00A65A;
        }
        .btn{
            border-radius: 0;
        }
    </style>

    <link rel="stylesheet" href="{{asset ('plugins/mega-dropdown/css/style.css')}}"> <!-- Resource style -->

    <!--icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('/images/favicon/apple-icon-57x57.png')}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{asset('/images/favicon/apple-icon-60x60.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('/images/favicon/apple-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{asset('/images/favicon/apple-icon-76x76.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('/images/favicon/apple-icon-114x114.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{asset('/images/favicon/apple-icon-120x120.png')}}">
<link rel="apple-touch-icon" sizes="144x144" href="{{asset('/images/favicon/apple-icon-144x144.png')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{asset('/images/favicon/apple-icon-152x152.png')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('/images/favicon/apple-icon-180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('/images/favicon/android-icon-192x192.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('/images/favicon/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{asset('/images/favicon/favicon-96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('/images/favicon/favicon-16x16.png')}}">
<link rel="manifest" href="{{asset('/images/favicon/manifest.json')}}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{asset('/images/favicon/ms-icon-144x144.png')}}">
<meta name="theme-color" content="#ffffff">
    
	

</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
   

    <div id="front">
        <div class="site-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-5 col-xs-7 bg-adjust">
                        <div id="greenad_logo">
                           <a href="{{ url()}}"><img src="{{ $settings->company_logo}}" alt="logo"></a>
                        </div> <!-- /.logo -->
                    </div> <!-- /.col-md-4 -->
                    <div class="col-md-10 col-sm-7 col-xs-5 bg-adjust main-menu-bg">
                        <!-- responsive menu-->
                        @include('includes.responsive')
                        <!-- responsive menu-->
                        

                        <!--<a href="#" class="toggle-menu"><span class="responesive-text-menu">MENU</span> <i class="fa fa-bars"></i></a>     -->
                        <div class="top_bar top-toggle-bar">
                             <div id="LANGUAGES">
                                <i class="glyphicon glyphicon-earphone"> </i> <b>@lang('application.telephone')</b>
                               
                                <span class="lan-bar">
                                 &nbsp&nbsp&nbsp&nbsp @lang('application.language'): 
                                <a href="{{url('locale/kh')}}" title="KHMER"><img src="{{asset('/images/kh_lan.gif')}}" /></a>
                                <a href="{{url('locale/en')}}" title="ENGLISH"><img src="{{asset('/images/en_lan.gif')}}" /></a>
                                <a href="{{url('locale/ch')}}" title="CHINESE"><img src="{{asset('/images/ch_lan.gif')}}" /></a>
                                </span>
                             </div>
                        </div>

                        <div class="top_bar  main-menu">
                    		<div class="row">
                                <div class="col-md-7">
                                    <h1 lang="{{Lang::locale()}}"> <!--@lang('application.company_name')-->
                                        {!! $settings->translationCompanyName(Lang::locale()) !!}
                                    </h1>
                                </div>
                                 <div class="col-md-5 col-sm-12" id="LANGUAGES">
                                    <i class="glyphicon glyphicon-earphone"> </i> <b>@lang('application.telephone')</b>
                                    &nbsp&nbsp&nbsp&nbsp @lang('application.language'): 
                                    <a href="{{url('locale/kh')}}" title="KHMER"><img src="{{asset('/images/kh_lan.gif')}}" /></a>
                                    <a href="{{url('locale/en')}}" title="ENGLISH"><img src="{{asset('/images/en_lan.gif')}}" /></a>
                                    <a href="{{url('locale/ch')}}" title="CHINESE"><img src="{{asset('/images/ch_lan.gif')}}" /></a>
                                 </div>
                            </div>
                        	
                         </div>
                    </div> <!-- /.col-md-8 -->
                </div> <!-- /.row -->
                 
                @include('includes.header')
                <!--
                <div class="row">
                    <div class="col-md-12">
                        <div class="responsive">
                            <div class="main-menu">
                                <ul>
                                    @foreach($menus as $key=> $menu)
                                    <li>
                                        <a href="{!!$menu->category()->first() ? url('categories/'.$menu->category()->first()->id.'/projects') : $menu->external_url ?:'#'!!}">{!! $menu->translation(Lang::locale())->first() ? $menu->translation(Lang::locale())->first()->title: $menu->title !!}</a> 
                                    </li>
                                    @endforeach
                                    <li>
                                     <!--search box--><!--
                                    <div class="responsive-search_box"> 
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
                                     <!--search box--><!--
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div> -->
            </div> <!-- /.container -->
        </div> <!-- /.site-header -->
    </div> <!-- /#front -->
	
	@yield('content')
	
	@include('includes.footer')

    <!-- script -->

    <script>window.jQuery || document.write('<script src="dist/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
    <script src="{{ asset('/dist/js/jquery.easing-1.3.js')}}"></script>
    <script src="{{ asset('/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{ asset('/dist/js/plugins.js')}}"></script>
    <script src="{{ asset('/dist/js/main.js')}}"></script>
    <script src="{{ asset('/dist/js/plugins_carousel.js')}}"></script>
    <script src="{{ asset('/dist/js/main_carousel.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/plugins/bpopup-master/jquery.bpopup.js') }}"></script>

    <!--select -->
    <script src="{{ asset('/dist/js/bootstrap-select.min.js')}}"></script>
    
    <!-- drop down -->
    <script src="{{ asset('/plugins/dropdown-menu/js/cbpHorizontalSlideOutMenu.js')}}"></script>
    <script>
        var menu = new cbpHorizontalSlideOutMenu( document.getElementById( 'cbp-hsmenu-wrapper' ) );
    </script>

   
    <script src="{{asset('/plugins/mega-dropdown/js/jquery.menu-aim.js')}}"></script> <!-- menu aim -->
    
    

<script type="text/javascript">
 (function($){
     $(function() {
        $(document).ready(function(){
    
              $('#popup').bPopup(
                {content:'iframe'},
                function(){
                    $('#skip').click(function(){$('.b-close').click();})
          var count=10;
           $('.timer').text(count);
           var counter= setInterval( timer, 700);
            $('#pause').bind( "click", function(ev){
                ev.preventDefault();
                if($(this).attr('data-click') == 0) {
                    $(this).attr('data-click', 1)
                   clearInterval(counter);
                $(this).css('background-color', 'red');
                 } else {
                 $(this).attr('data-click', 0);
                    counter= setInterval( timer, 700);
                    $(this).css('background-color', '');
                }
            });
          function timer(){
            count=count-1;
          
            if(count<=0){
                clearInterval(counter);
                return;
            }
            if(count===1){
                $('.b-close').click();
            }
            $('.timer').text(count);
          }
        })
     });
    });

 })(jQuery);
 $("#LANGUAGES img").click(function(){
    location.href= $(this).parent('a').attr('href');
 });
</script>

<!--fancybox-->   

    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="{{asset('/plugins/fancybox/lib/jquery.mousewheel-3.0.6.pack.js')}}"></script>

    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="{{asset('/plugins/fancybox/source/jquery.fancybox.js?v=2.1.5')}}"></script>
    

    <!-- Add Button helper (this is optional) -->
    <script type="text/javascript" src="{{asset('/plugins/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5')}}"></script>

    <!-- Add Thumbnail helper (this is optional) -->
    <script type="text/javascript" src="{{asset('/plugins/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7')}}"></script>

    <!-- Add Media helper (this is optional) -->
    <script type="text/javascript" src="{{asset('plugins/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6')}}"></script>
    
    <script src="{{ asset('/bower_components/nanobar/nanobar.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            /*
             *  Simple image gallery. Uses default settings
             */

            $('.fancybox').fancybox();

            /*
             *  Different effects
             */

            // Change title type, overlay closing speed
            $(".fancybox-effects-a").fancybox({
                helpers: {
                    title : {
                        type : 'outside'
                    },
                    overlay : {
                        speedOut : 0
                    }
                }
            });

            // Disable opening and closing animations, change title type
            $(".fancybox-effects-b").fancybox({
                openEffect  : 'none',
                closeEffect : 'none',

                helpers : {
                    title : {
                        type : 'over'
                    }
                }
            });

            // Set custom style, close if clicked, change title type and overlay color
            $(".fancybox-effects-c").fancybox({
                wrapCSS    : 'fancybox-custom',
                closeClick : true,

                openEffect : 'none',

                helpers : {
                    title : {
                        type : 'inside'
                    },
                    overlay : {
                        css : {
                            'background' : 'rgba(238,238,238,0.85)'
                        }
                    }
                }
            });

            // Remove padding, set opening and closing animations, close if clicked and disable overlay
            $(".fancybox-effects-d").fancybox({
                padding: 0,

                openEffect : 'elastic',
                openSpeed  : 150,

                closeEffect : 'elastic',
                closeSpeed  : 150,

                closeClick : true,

                helpers : {
                    overlay : null
                }
            });

            /*
             *  Button helper. Disable animations, hide close button, change title type and content
             */

            $('.fancybox-buttons').fancybox({
                openEffect  : 'none',
                closeEffect : 'none',

                prevEffect : 'none',
                nextEffect : 'none',

                closeBtn  : false,

                helpers : {
                    title : {
                        type : 'inside'
                    },
                    buttons : {}
                },

                afterLoad : function() {
                    this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
                }
            });


            /*
             *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
             */

            $('.fancybox-thumbs').fancybox({
                prevEffect : 'none',
                nextEffect : 'none',

                closeBtn  : false,
                arrows    : false,
                nextClick : true,

                helpers : {
                    thumbs : {
                        width  : 50,
                        height : 50
                    }
                }
            });

            /*
             *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
            */
            $('.fancybox-media')
                .attr('rel', 'media-gallery')
                .fancybox({
                    openEffect : 'none',
                    closeEffect : 'none',
                    prevEffect : 'none',
                    nextEffect : 'none',

                    arrows : false,
                    helpers : {
                        media : {},
                        buttons : {}
                    }
                });

            /*
             *  Open manually
             */

            $("#fancybox-manual-a").click(function() {
                $.fancybox.open('1_b.jpg');
            });

            $("#fancybox-manual-b").click(function() {
                $.fancybox.open({
                    href : 'iframe.html',
                    type : 'iframe',
                    padding : 5
                });
            });

            $("#fancybox-manual-c").click(function() {
                $.fancybox.open([
                    {
                        href : '1_b.jpg',
                        title : 'My title'
                    }, {
                        href : '2_b.jpg',
                        title : '2nd title'
                    }, {
                        href : '3_b.jpg'
                    }
                ], {
                    helpers : {
                        thumbs : {
                            width: 75,
                            height: 50
                        }
                    }
                });
            });


        });
    </script>
	<script>
		$(function(){
    		var options = {
        		bg: '#85c91c',
        
        		// leave target blank for global nanobar
        		target: document.getElementById('myDivId'),
        
        		// id for new nanobar
        		id: 'mynano'
          	};
        
	        var nanobar = new Nanobar( options );
	        nanobar.go( 30 ); // size bar 30%
	        nanobar.go(100);
		});
	</script>
    @yield('script')
    <script src="{{asset('/plugins/mega-dropdown/js/main.js')}}"></script> <!-- Resource jQuery -->
</body>
</html>