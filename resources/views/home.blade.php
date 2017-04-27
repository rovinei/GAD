@extends('app')
@section('content')
	<div class="site-slider">
		<div class="container">
			<div class="row">
		        <ul class="bxslider">
		        @foreach($sliders as $slider)
		        	@if($slider->image)
						<li>
			                <img src="{{$slider->image}}" alt="{{$slider->title}}">
			                <div class="container">
			                    <div class="row">
			                        <div class="col-md-12 text-right">
			                            <div class="slider-caption">
			                                <h2>{{$slider->translation(Lang::locale())->first() ? $slider->translation(Lang::locale())->first()->title: $slider->title}}</h2>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </li>
					@else
				       <li>
		                <img src="{{ asset('/images/slider/slide1.jpg') }}" alt="slider image 1">
		                <div class="container">
		                    <div class="row">
		                        <div class="col-md-12 text-right">
		                            <div class="slider-caption">
		                                <h2>Green Achitecture and Design</h2>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </li>
					@endif
		         @endforeach
		            
		        </ul> <!-- /.bxslider -->
			</div><!--row-->
		</div><!-- container -->
	</div> <!-- /.site-slider -->


<div class="bx-thumbnail-wrapper">
    <div class="container">
        <div class="row">
         	<div id="bx-pager">
         	@foreach($sliders as $key => $slider)
		        @if($slider->thumb_image)	
                	<a data-slide-index="{{$key}}" href=""><img src="{{ $slider->thumb_image }}" alt="{{$slider->title}}" style="width:170px; height:80px;"/></a>
                @endif
           	@endforeach
            </div>
        </div>
        <div class="row">
       
            <div class="intro_content">
            	{!! $settings->translationCompanyInformation(Lang::locale()) !!}
            </div>
        	
        </div>
    </div>
</div><!-- / thumbnail-wrapper -->

<div class="box_intro_services">
	<div class="container intro_box_color">
    	 <div class="row">
    	 	@foreach($services as $service)
        	<div class="col-md-2 col-sm-4 col-xs-6">
    			<img src="{{ $service->image }}" style="width:74px; height:82px;">
				<h3>{{$service->translation(Lang::locale())->first() ? $service->translation(Lang::locale())->first()->title: $service->title}}</h3>
        	</div>
        	@endforeach
<!--        	<div class="col-md-2">
    			<img src="{{ asset('/images/lanscape_services_icon.png') }}">
				<h3>Exterior Design</h3>
        	</div>
        	<div class="col-md-2">
    			<img src="{{ asset('/images/interior_design_services_icon.png') }}">
				<h3>Interior Decoration</h3>
        	</div>
        	<div class="col-md-2">
    			<img src="{{ asset('/images/furniture_design_services_icon.png') }}">
				<h3>Furniture Design</h3>
        	</div>
        	<div class="col-md-2">
    			<img src="{{ asset('/images/water_services_icon.png') }}">
				<h3>M&E Water Supply</h3>
        	</div>
        	<div class="col-md-2">
    			<img src="{{ asset('/images/consultant_icon.png') }}">
				<h3>Consultant & Management </h3>
        	</div>-->
        </div><!--row-->	
    </div><!--container-->	
</div> <!--/ box info services -->

<div class="box_recently_project">
	<div class="container">
        <div class="page-section text-center">
            <div class="row">
                 <h3 style="padding:0 0 20px 0">@lang('application.recently_project')</h3>
                <div class="owl-carousel">
                	@foreach($projects as $project)
                		@if(is_array(json_decode($project->thumb_images,true)))
							@if(count(json_decode($project->thumb_images,true))>0)
                			<div class="service-item">
		                        <div class="img-project">
		                             <a href="{{url('menu/'.$menu->id.'/categories/'.$project->category_id.'/projects/'.$project->id)}}"> <img src="{{json_decode($project->thumb_images,true)[0]}}" /></a>
		                         </div>
		                         <div class="project-title"><a href="{{url('menu/'.$menu->id.'/categories/'.$project->category_id.'/projects/'.$project->id)}}"> {{str_limit($project->translation(Lang::locale())->first() ? $project->translation(Lang::locale())->first()->title: $project->title, $limit = 32, $end = '...')}}</a></div>
		                    </div>
		                    @endif
		                @else
		                	<div class="service-item">
		                        <div class="img-project">
		                             <a href="{{url('menu/'.$menu->id.'/categories/'.$project->category_id.'/projects/'.$project->id)}}"> <img src="{{ asset('/images/sample_img.jpg') }}" /></a>
		                         </div>
		                         <div class="project-title"><a href="{{url('menu/'.$menu->id.'/categories/'.$project->category_id.'/projects/'.$project->id)}}"> str_limit($project->translation(Lang::locale())->first() ? $project->translation(Lang::locale())->first()->title: $project->title, $limit = 27, $end = '...')}}</a></div>
		                    </div>
                		@endif
                	@endforeach
                	
                    
                    <!--<div class="service-item">
                        <div class="img-project">
                             <a href="#"> <img src="{{ asset('/images/sample_img.jpg') }}" /></a>
                         </div>
                         <div class="project-title"><a href="#"> Read Documents</a></div>
                    </div>
                    <div class="service-item">
                        <div class="img-project">
                             <a href="#"> <img src="{{ asset('/images/sample_img.jpg') }}" /></a>
                         </div>
                         <div class="project-title"><a href="#"> Read Documents</a></div>
                    </div>
                    <div class="service-item">
                        <div class="img-project">
                             <a href="#"> <img src="{{ asset('/images/sample_img.jpg') }}" /></a>
                         </div>
                         <div class="project-title"><a href="#"> Read Documents</a></div>
                    </div>                  -->
                </div>
            </div>
        </div><!-- ./ page section -->
    </div><!-- ./ container -->
</div><!--/ recently project -->

<div class="client_reference">
    <div class="container">
        <div class="row">
            <h3 style="padding:0 0 20px 0; margin:0px; text-align:center;">@lang('application.our_customers')</h3>
            @foreach($clients as $client)
            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="img_client_box"><img src="{{ $client->image }}"></div>
            </div>
        	@endforeach
             <!--<div class="col-md-2">
                 <div class="img_client_box"><img src="{{ asset('/images/client_logo_2.jpg') }}"></div>
            </div>
             <div class="col-md-2">
                  <div class="img_client_box"><img src="{{ asset('/images/client_logo_3.jpg') }}"></div>
            </div>
             <div class="col-md-2">
                  <div class="img_client_box"><img src="{{ asset('/images/client_logo_4.jpg') }}"></div>
            </div>
             <div class="col-md-2">
                  <div class="img_client_box"><img src="{{ asset('/images/client_logo_5.jpg') }}"></div>
            </div>
             <div class="col-md-2">
                  <div class="img_client_box"><img src="{{ asset('/images/client_logo_6.jpg') }}"></div>
            </div>-->

        </div>
    </div>
</div>
@endsection