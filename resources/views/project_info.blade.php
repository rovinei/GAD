@extends('app')
@section('facebook')
	<!--facebook meta tag--> 
    <meta property="og:image" content="@if(is_array(json_decode($content->images,true)))
							    	@if(count(json_decode($content->images,true))>0)
										{{{json_decode($content->images,true)[0]}}}
									@else
										{{{ asset('/images/uploads/sample_img.jpg') }}}
									@endif
								@else
								   {{{ asset('/images/uploads/sample_img.jpg') }}}
								@endif">
    <meta property="og:url" content="{{{ URL::current()}}}">
    <meta property="og:title" content="{{{ $content->translation(Lang::locale())->first() ? strip_tags ($content->translation(Lang::locale())->first()->title): strip_tags ($content->title) }}}">
    <meta property="og:description" content="{{{ strip_tags ($content->content) }}}">
@endsection
@section('content')
<div id="navigation">
	<div class="container">
		<div class="row">	
			<ol class="breadcrumb" style="text-transform: uppercase;">
			  <li><a href="{{url()}}">@lang('application.home')</a></li>
			  @if($category->parent_id)
			  	@if($category->parentCategory->parent_id)
			  	<li><a href="{{ url('menu/'.$menu->id.'/categories/'.$category->parentCategory->parentCategory->id.'/projects') }}">{{ $category->parentCategory->parentCategory->title }}</a></li>
			  	<li><a href="{{ url('menu/'.$menu->id.'/categories/'.$category->parentCategory->id.'/projects')}}">{{ $category->parentCategory->title }}</a></li>
			  	@else
			  		<li><a href="{{ url('menu/'.$menu->id.'/categories/'.$category->parentCategory->id.'/projects')}}">{{ $category->parentCategory->title }}</a></li>
			  	@endif
			  @endif
			  <li><a href="{{ url('menu/'.$menu->id.'/categories/'.$category->id.'/projects')}}">{{ $category->title }}</a></li>
			  <li class="active"><strong>{{$content->title}}</strong></li>
			</ol>
		</div>
	</div>
</div>
<div id="data-projecct">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				@include('includes.categories')
			</div>
			<div class="col-md-10">
				<div class="project-item">
					<div class="row">
						<div class="col-md-12">
							<h1> {!! $content->translation(Lang::locale())->first() ? $content->translation(Lang::locale())->first()->title: $content->title !!}</h1>
							
						</div>
					</div>
					<div class="row">
						
						<div class="col-md-6">
							<p> Posted: {{$content->createdBy ? $content->createdBy->lastname : ''}} {{ $content->createdBy ? $content->createdBy->firstname : ''}} | Date: {{$content->created_at->format('d-F-Y')}} </p>
						</div>
						<div class="col-md-6">
				
							<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50bee8c15741ef8d" async="async"></script>
							<!-- Go to www.addthis.com/dashboard to customize your tools -->
							<div class="addthis_sharing_toolbox" style="float:left; margin-right:100px"></div>
							<div class="fb-like" style="float:left; padding-top:5px;" data-href="{{URL::current()}}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
						</div>
					</div>
					@if(strtolower($category->title)!="furniture" || strlower($category->parentCategory->title)!="furniture")
					<div class="row">
						<div class="col-md-12">
							<div class="image_view">
								@if(is_array(json_decode($content->images,true)))
							    	@if(count(json_decode($content->images,true))>0)
										<img src="{{json_decode($content->images,true)[0]}}"></a>
									@else
										<img src="{{ asset('/images/uploads/sample_img.jpg') }}" />
									@endif
								@else
								   <img src="{{ asset('/images/uploads/sample_img.jpg') }}" />
								@endif
							</div>
							<div class="d_img_thumbnail">
							@if(is_array(json_decode($content->thumb_images,true)))
								@foreach(json_decode($content->thumb_images,true) as $image)
									<a class="fancybox" href="{{-- */ $data = str_replace('thumbs', 'source', $image); /* --}} {{$data}}" data-fancybox-group="gallery">
										<img src="{{$image}}" alt="" />
									</a>
								@endforeach
							@endif
							</div>
						</div>
					</div><!--/row-->
					@else
					<div class="row">
						<div class="col-md-12">
							@if(is_array(json_decode($content->images,true)))
						    	@if(count(json_decode($content->images,true))>0)
						    		@foreach(json_decode($content->images,true) as $image)
										<div class="image_view">
											<img src="{{$image}}">
										</div>
									@endforeach
								@else
									<div class="image_view">
										<img src="{{ asset('/images/uploads/sample_img.jpg') }}" />
									</div>
								@endif
							@else
							<div class="image_view">
							   <img src="{{ asset('/images/uploads/sample_img.jpg') }}" />
							</div>
							@endif
							
						</div>
					</div><!--/row-->
					@endif
					
					
					<div class="row">
							<div class="col-md-8">
								<div class="project_description">
									<h2>Description</h2>
									{!! $content->content !!}
								</div>	
							</div>
							<div class="col-md-4">
							
								<form action="{{URL::to('emails')}}" method="POST">
									<input type="hidden" name="_token" value="{!! csrf_token() !!}">
									<div class="company_contact_info">
									<h4>Contact us</h4>
									<p>For more details contact:</p>
									<p>
										<i class="glyphicon glyphicon-earphone"></i><b>  (+855) 93 411 676</b><br/>
										<i class="glyphicon glyphicon-envelope"></i><b>   info@green-globale.com</b>
									</p>
									<p>
									Or give us your best contact 
details and we will follow up 
with you.
									</p>
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
								</form>
							</div>
					</div>
				</div>
			</div><!--/ col-md-10-->
		</div><!-- / row -->
	</div><!--/ container -->
</div><!--/ data project-->
@endsection