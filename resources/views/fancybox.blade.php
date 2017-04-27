<!DOCTYPE html>
<html>
<head>
	<title>fancyBox - Fancy jQuery Lightbox Alternative | Demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- Add jQuery library 
	<script type="text/javascript" src="../lib/jquery-1.10.1.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) 
	<script type="text/javascript" src="../lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files
	<script type="text/javascript" src="../source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="../source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) 
	<link rel="stylesheet" type="text/css" href="../source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="../source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) 
	<link rel="stylesheet" type="text/css" href="../source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="../source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) 
	<script type="text/javascript" src="../source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
-->
	<!-- JQuery -->
 	<script type="text/javascript" src="{{asset('/plugins/fancybox/lib/jquery-1.10.1.min.js')}}"></script>


	<!--fancybox -->
     
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/fancybox/source/jquery.fancybox.css?v=2.1.5')}}" media="screen" />
    <!-- Add Button helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5')}}" />
    <!-- Add Thumbnail helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7')}}" />
	

</head>
<body>
	<h1>fancyBox</h1>

	<p>This is a demonstration. More information and examples: <a href="http://fancyapps.com/fancybox/">www.fancyapps.com/fancybox/</a></p>

	
	<h3>Simple image gallery</h3>
	<p>
		<a class="fancybox" href="{{ asset('/images/slider/thumb1.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet"><img src="{{ asset('/images/slider/thumb1.jpg') }}" alt="" /></a>

		<a class="fancybox" href="{{ asset('/images/slider/thumb1.jpg') }}" data-fancybox-group="gallery" title="Etiam quis mi eu elit temp"><img src="{{ asset('/images/slider/thumb1.jpg') }}" alt="" /></a>

		<a class="fancybox" href="{{ asset('/images/slider/thumb1.jpg') }}" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="{{ asset('/images/slider/thumb1.jpg') }}" alt="" /></a>

		<a class="fancybox" href="{{ asset('/images/slider/thumb1.jpg') }}" data-fancybox-group="gallery" title="Sed vel sapien vel sem uno"><img src="{{ asset('/images/slider/thumb1.jpg') }}" alt="" /></a>
	</p>

	

	


	<!--fancybox-->
<!-- Add jQuery library -->
   

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
				closeEffect	: 'none',

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
					buttons	: {}
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
</body>
</html>