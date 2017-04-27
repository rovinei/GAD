@extends('app')
@section('content')
<div id="navigation">
	<div class="container">
		<div class="row">
		@if($category)
		<input type="hidden" value="{{URL::to('menu/'.$menu->id.'/categories/'.$category->id.'/projects')}}" id="URL"/>
		@endif
			
			<ol class="breadcrumb" style="text-transform: uppercase;">
			  <li><a href="{{url()}}">@lang('application.home')</a></li>
			  @if($category)
				  @if($category->parent_id)
				  	@if($category->parentCategory->parent_id)
				  	<li><a href="{{ url('menu/'.$menu->id.'/categories/'.$category->parentCategory->parentCategory->id.'/projects') }}">{{ $category->parentCategory->parentCategory->title }}</a></li>
				  	<li><a href="{{ url('menu/'.$menu->id.'/categories/'.$category->parentCategory->id.'/projects')}}">{{ $category->parentCategory->title }}</a></li>
				  	@else
				  		<li><a href="{{ url('menu/'.$menu->id.'/categories/'.$category->parentCategory->id.'/projects')}}">{{ $category->parentCategory->title }}</a></li>
				  	@endif
				  @endif
				  <li class="active"><strong>{{$category->title}}</strong></li>
				@else
					<li class="active"><strong>SEARCH</strong></li>
			  @endif
			</ol>
		</div>
		
	</div>
</div>
<div id="data-projecct">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<div id="resposive-side-cat">
				<!-- Single button -->
				@if($categories->count()>0)
				<div class="btn-group" style="width:100%;" >
				  <button style="width:100%;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Categories <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu scrollable-menu"  style="width:100%;">
				  @foreach($categories as $category)
				    <li><a href="{{url('menu/'.$menu->id.'/categories/'.$category->id.'/projects')}}" style="color:green;"><b>{{$category->translation(Lang::locale())->first() ? $category->translation(Lang::locale())->first()->title: $category->title}}</b></a></li>
				    @foreach($category->categories()->orderBy('ordering')->get() as $subCategory)
							<li> <a class="m_link" href="{{url('menu/'.$menu->id.'/categories/'.$subCategory->id.'/projects')}}"><span style="padding-left:20px;">{{$subCategory->translation(Lang::locale())->first() ? $subCategory->translation(Lang::locale())->first()->title: $subCategory->title}} <strong>({{$subCategory->contents->count()}})</strong><span></span></a></li>
						@endforeach
				 	@endforeach
				  </ul>
				 @endif
				</div>
		  	</div>
			@include('includes.categories')
			</div>
			<div class="col-md-10">
				<div class="project-item">
					<div class="row">
						<div class="col-md-12"></div>
					</div>
					<div id="CONTENTS">
					<div class="row">
						@foreach($contents as $content)
						  <div class="col-sm-6 col-md-4">
						    <div class="thumbnail">
						  @if(is_array(json_decode($content->thumb_images,true)))
						    @if(count(json_decode($content->thumb_images,true))>0)
									<a href="{{url('menu/'.$menu->id.'/categories/'.$content->category_id.'/projects/'.$content->id)}}"><img src="{{json_decode($content->thumb_images,true)[0]}}"></a>
								@else
									<img src="{{ asset('/images/sample_img.jpg')}}" />	
								@endif
							@else
						       <img src="{{ asset('/images/sample_img.jpg')}}" />
							@endif
						      <div class="caption">
						        <h3><a href="{{url('menu/'.$menu->id.'/categories/'.$content->category_id.'/projects/'.$content->id)}}">{{str_limit($content->translation(Lang::locale())->first() ? $content->translation(Lang::locale())->first()->title: $content->title, $limit = 27, $end = '...')}}</a></h3> 
						      </div>
						    </div><!--/ thumbnail-->
						  </div><!--/ col -->
						@endforeach
						@if(count($contents)==0)
							<center><h4>PROJECTS NOT FOUND...</h4></center>
						@endif 
					</div><!--/row-->
					<div class="row">
						<div class="col-md-12">
							<div id="main_pagging"> 
								{!! $contents->render() !!}
							</div>	
						</div>
					</div>
					</div>
				 </div><!-- project-item -->
			</div><!--/ col-md-10-->
		</div><!-- / row -->
	</div><!--/ container -->
</div><!--/ data project-->
@endsection
@section('script')
	<script>
			$(function(){
				$(document).on('click','.pagination a', function(e){
          e.preventDefault();
          var pageId = $(this).attr('href').split('page=')[1];
          var data = {
                page: pageId
          };
          var options = {
        	bg: '#85c91c',
        
        	// leave target blank for global nanobar
        	target: document.getElementById('myDivId'),
        
        	// id for new nanobar
        	id: 'mynano'
          };
        
        var nanobar = new Nanobar( options );
        $.ajax({
              url: $("#URL").val(),
              data: data,
              dataType: "JSON",
              type: "POST",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              beforeSend: function(){
                // move bar
                nanobar.go( 30 ); // size bar 30%
              
              },
              success: function(data){
              	console.log(data);
                $('#CONTENTS').html(data);
                // Finish progress bar
                nanobar.go(100);
              }
          });
        });
			})
        
    </script>
@endsection