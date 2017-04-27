@extends('admin.app')

@section('content_header')
<h1>SLIDER<small>CREATE NEW SLIDER</small></h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Create New Slider</li>
</ol>
@endsection
@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="row">   
      <div class="col-sm-12">
        <div class="box box-solid box-success">
          <div class="box-header with-border">
            <h3 class="box-title">SLIDER REGISTRATION FORM</h3>
            <div class="box-tools pull-right">
              <!-- Buttons, labels, and many other things can be placed here! -->
              <!-- Here is a label for example -->
              <!-- <span class="label label-primary">Label</span> -->
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
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
            <form class="form-horizontal" action="{{ route('admin.sliders.store') }}" method="post" style="padding:10px;" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="form-group  " >
                <label for="ipt" class=" control-label col-md-2 text-right">Title</label>
                <div class="col-md-10">
                  <input type="text" name="title" id="title" value="" class="form-control" placeholder="Enter your category title" required/> 
                </div> 
              </div>   
              <div class="form-group" style="display:none;">
                <label for="ipt" class=" control-label col-md-2 text-right">Type</label>
                <div class="col-md-10">
                  <select name='category_id' rows='5' id='module'  class='form-control ' required>
                    <option value="">-- Select Type --</option>
                    <option value="1" selected>SLIDE SHOW AT HOME PAGE</option>
                  </select>     
                </div> 
              </div>
              <div class="form-group">
                <label for="ipt" class=" control-label col-md-2 text-right">Type</label>
                <div class="col-md-10">
                  <select name='type' rows='5' id='type'  class='form-control '    >
                    <option value="SLIDE SHOW">SLIDE SHOW</option>
                    <option value="SERVICE SHOW">SERVICE SHOW</option>
                    <option value="CLIENT SHOW">CLIENT SHOW</option>
                  </select>     
                </div> 
              </div>
              <div class="form-group">
                <label class="col-sm-2 text-right">Image</label>
                  <div class="col-sm-10">  
                    <input type="hidden" readonly="readonly"   class="form-control" id="txtImage" name="image">
                    <a type="button" class="btn btn-default btn-file" data-target="#myModal" href="#" data-toggle="modal">Choose Image </a>
                    <!--<input type="file" name="image" id="image" class="btn btn-default btn-file"/>-->
                    <img style="display:none; width:520px; height:240px;" class="thumbnail" id="sample_image"/>
                  </div>    
              </div>
              <div class="form-group   " >
                <label for="ipt" class=" control-label col-md-2 text-right"> Ordering</label> 
                <div class="col-md-10">
                  <input type="text" name="ordering" id="ordering" value="{{ old('ordering')?: 1 }}" class="form-control" placeholder="1, 2, 3..."/>    
                </div> 
              </div>
              <div class="form-group   " >
                <label for="ipt" class=" control-label col-md-2 text-right"> Status</label> 
                <div class="col-md-10 menutype">
                  <label class="radio-inline  ">             
                    <input type="radio" name="status" class="status"value="1" checked="checked"/>Active
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="status" class="status" value="0"/> Inactive
                  </label>    
                </div> 
              </div>        
              <div class="form-group">
                <label class="col-sm-2 text-right"> </label>
                  <div class="col-sm-10">  
                    <button type="submit" class="btn btn-success ">Save</button>
                    <button type="button" class="btn">Cancel</button>
                  </div>    
              </div>    
            </form>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <!-- The footer of the box -->
          </div><!-- box-footer -->
        </div><!-- /.box -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
@include('admin.includes.upload')
@endsection

@section('script')
<script type="text/javascript">
  $(document).ajaxStart(function() { Pace.restart(); }); 
</script>
@endsection
@section('image')
  <script>
  	$(function(){
  		$('#upload').on('submit', function(e) {
  		    var options = {
          	bg: '#e74c3c',
          	target: document.getElementById('myDivId'),
          	id: 'mynano'
          };
          var nanobar = new Nanobar( options );
          e.preventDefault(); // prevent native submit
          $(this).ajaxSubmit({
              success: function(responseText, statusText, xhr) {
                 nanobar.go(100);
                 console.log(responseText);
                 $("#sample_image").attr('src', responseText.IMAGE);
                 $("#txtImage").val(responseText.IMAGE);
                 $("#sample_image").show();
                 $("#myModal").modal('hide');
              }
          });
        });
  	});
  </script>
@endsection
