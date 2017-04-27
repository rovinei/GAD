@extends('app')
@section('content')
<div id="navigation">
	<div class="container">
		<div class="row">	
			<ol class="breadcrumb" style="text-transform: uppercase;">
			  <li><a href="{{url()}}">@lang('application.home')</a></li>
			  <li class="active"><strong>{{$menu->title}}</strong></li>
			</ol>
		</div>
	</div>
</div>
<div id="data-projecct">
	<div class="container">
		<div class="row">
	       {!!$menu->content!!}
	      	
	    </div>
	    <div class="row">
	    	<!--@if(Session::has('flash_message'))
		        <div class="alert alert-success">
		            {{ Session::get('flash_message') }}
		        </div>
		    @endif
		    @if($errors->any())
		        <div class="alert alert-danger">
		            @foreach($errors->all() as $error)
		                <p>{{ $error }}</p>
		            @endforeach
		        </div>
		    @endif-->
			<form action="{{URL::to('emails')}}" method="POST">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
		    	<div class="col-md-5 contact_info">
		    		<h1>Send Massage</h1>
		    		<!--contact form-->
						<div class="contact_message">
							<div class="form-group">
								<input type="text" class="form-control" id="name" 
								name="name" placeholder="First & Last Name" value="">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="email" 
								name="email" placeholder="your e-mail address" value="">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="telephone" 
								name="telephone" placeholder="best telephone number" value="">
							</div>
							<div class="form-group">
						        
						            <textarea class="form-control" rows="4" name="description"></textarea>
						        
						    </div>
						    <div class="form-group">
						        <label for="human" class="control-label">2 + 3 = ?</label>
						     
						            <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer" required>
						       
						    </div>
						    <div class="form-group">
						      
						            <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
						       
							 </div>
							 <div class="form-group">
						      
					             @if(Session::has('flash_message'))
					                <div class="alert alert-success">
					                    {{ Session::get('flash_message') }}
					                </div>
					            @endif
					            @if($errors->any())
					                <div class="alert alert-danger">
					                    @foreach($errors->all() as $error)
					                        <p>{{ $error }}</p>
					                    @endforeach
					                </div>
					            @endif
						      
						    </div>
						</div>
		    		<!--end contact form-->
		    	</div>
		    </form>
	    	<div class="col-md-7 contact_info">
	    		<h1>Location: Find me here</h1>
		    	<div class="office_loaction">
	    		  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false">
	    		  </script><div style="height:450px;width:100%;">
	    		  	<div id="gmap_canvas" style="height:450px;width:100%;"></div>
	    		  	<script type="text/javascript"> function init_map(){var myOptions = {zoom:15,center:new google.maps.LatLng(11.555904927487001,104.92888122485351),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(11.555904927487001, 104.92888122485351)});infowindow = new google.maps.InfoWindow({content:"<b>Green Global Architecture Design &amp; Construction Co., Ltd.</b><br/>Preah Shihanuk Blv, Sangkat Tunle Basak, Khan Chhomkamon<br/> Phnom Penh" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
	    		</div>
	    	</div>

	    </div>
	</div>
</div>
@endsection