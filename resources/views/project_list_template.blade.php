<div class="row">
	@foreach($contents as $content)
	  <div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	    @if(is_array(json_decode($content->thumb_images,true)))
	    	@if(count(json_decode($content->thumb_images,true))>0)
				<img src="{{json_decode($content->thumb_images,true)[0]}}"></a>
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
</div><!--/row-->
<div class="row">
	<div class="col-md-12">
		<div id="main_pagging"> 
			{!! $contents->render() !!}
		</div>	
	</div>
</div>