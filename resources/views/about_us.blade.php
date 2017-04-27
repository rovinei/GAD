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
	      	<div class="col-md-3">
	      		<ul style="font-size:16px; line-height:24px;" id="SIDEBAR_MENU" class="about_menu">
	      			@foreach($menu->sidebar_menus as $sidebar_menu)
					<li><a href="javascript:;" id="{{$sidebar_menu->id}}">{{$sidebar_menu->title}}</a></li>
					@endforeach
					<!--<li><a href="#">Our Partner</a></li> 
					<li><a href="#">Mission Statement</a></li>-->
				</ul>

	      	</div>
	      	<div class="col-md-9" id="CONTENT">
	        		{!!$menu->content!!}
	        </div>
	    </div>
	</div>
</div>
@endsection
@section('script')
<script>
	$(function(){
        $(document).on('click','#SIDEBAR_MENU a', function(e){
          var id = $(this).attr("id");
          var options = {
        	bg: '#85c91c',
        
        	// leave target blank for global nanobar
        	target: document.getElementById('myDivId'),
        
        	// id for new nanobar
        	id: 'mynano'
          };
        var URL = "{{url('/menu/')}}";
        URL = URL + "/" + id;
        var nanobar = new Nanobar( options );
        $.ajax({
              url: URL,
              dataType: "JSON",
              type: "GET",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              beforeSend: function(){
                // move bar
                nanobar.go( 30 ); // size bar 30%
              
              },
              success: function(data){
              	console.log(data);
                $('#CONTENT').html(data.sidebar_menu.content);
                // Finish progress bar
                nanobar.go(100);
              }
          });
        });
	})
    
</script>
@endsection