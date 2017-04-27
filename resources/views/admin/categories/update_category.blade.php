@extends('admin.app')

@section('content_header')
<h1>Dashboard<small>Control panel</small></h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>
@endsection
@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="row">   
      <div class="col-sm-12">
        <div class="box box-solid box-success">
          <div class="box-header with-border">
            <h3 class="box-title">CATEGORY UPDATING FORM</h3>
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
            <form class="form-horizontal" action="{{ url('admin/categories/updatecategory') }}" method="POST" style="padding:10px;" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="form-group  " >
                <label for="ipt" class=" control-label col-md-2 text-right">Title</label>
                <div class="col-md-10">
                  <input type="hidden" name="id" id="id" value="{{ $category->id }}" /> 
                  <input type="text" name="title" id="title" value="{{ $category->title}}" class="form-control" placeholder="Enter your category title"/> 
                </div> 
              </div>   
              <div class="form-group">
                <label for="ipt" class=" control-label col-md-2 text-right">Parent Category</label>
                <div class="col-md-10">
                  <select name='parent_id' rows='5' id='module'  class='form-control fontawesome-select'    >
                    <option value="">-- Select Parent Category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @if($category->parent_id==$cat->id) selected @endif>
                          @for($i=0;$i<$cat->level;$i++)
                            &#xf054;&#xf054;
                          @endfor
                          {{ $cat->title}}
                        </option>
                      @endforeach
                  </select>     
                </div> 
              </div>
              <div class="form-group" style="display:none;">
                <label class="col-sm-2 text-right">Description</label>
                  <div class="col-sm-10">  
                    <textarea id="description" name="description">{{ $category->description }}</textarea>
                  </div>    
              </div>
              <div class="form-group   " >
                <label for="ipt" class=" control-label col-md-2 text-right"> Ordering</label> 
                <div class="col-md-10">
                  <input type="text" name="ordering" id="ordering" value="{{ $category->ordering ?:old('ordering')?: 1 }}" class="form-control" placeholder="1, 2, 3..."/>    
                </div> 
              </div> 
              <div class="form-group">
                <label class="col-sm-2 text-right">Image</label>
                  <div class="col-sm-10">  
                    <!--<input type="hidden" readonly="readonly"   class="form-control" id="txtImage" name="image" onchange="changeImage()" value="{{$category->image}}">
                    <a type="button" class="btn btn-default btn-file" data-target="#myModal" href="javascript:;" data-toggle="modal">Choose Image </a>-->
                    <!--<input type="file" name="image" id="image" class="btn btn-default btn-file"/>
                    <img src="{{$category->image}}" style="width:520px; height:240px;" class="thumbnail" id="sample_image" title=""/>-->
                    <input type="hidden" readonly="readonly"   class="form-control" id="txtImage" name="image" value="{{$category->image}}">
                    <a type="button" class="btn btn-default btn-file" data-target="#myModal" href="#" data-toggle="modal">Choose Image </a>
                    <!--<input type="file" name="image" id="image" class="btn btn-default btn-file"/>-->
                    <img src="{{$category->image}}" style="width:520px; height:240px;" class="thumbnail" id="sample_image"/>
                  </div>    
              </div>
              <div class="form-group   " >
                <label for="ipt" class=" control-label col-md-2 text-right"> Status</label> 
                <div class="col-md-10 menutype">
                  <label class="radio-inline  ">             
                    <input type="radio" name="status" class="status"value="1" @if($category->status==1) checked="checked" @endif/>Active
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="status" class="status" value="0" @if($category->status==0) checked="checked" @endif/> Inactive
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
@include('admin.includes.upload')
@endsection

@section('script')
<script type="text/javascript" src="{{ url('') }}/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="{{ url('') }}/tinymce/tinymce_editor.js"></script>
<script type="text/javascript">
  $(document).ajaxStart(function() { Pace.restart(); }); 
  tinymce.init({
    selector: "textarea",theme: "modern", width: "99.5%",height: 300,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak code",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   toolbar3: "| fontselect | fontsizeselect ",
   image_advtab: true ,
   
   external_filemanager_path:"/filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
 });
</script>
<script>
  function changeImage(){
    $("#sample_image").show();
    $("#sample_image").attr('src',$("#txtImage").val());
  }
</script>
@endsection
@section('image')
  <script>
  	$(function(){
  		$('#upload').on('submit', function(e) {
            e.preventDefault(); // prevent native submit
            $(this).ajaxSubmit({
                success: function(responseText, statusText, xhr) {
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