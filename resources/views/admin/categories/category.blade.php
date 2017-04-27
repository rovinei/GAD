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
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">LIST All CATEGORIES</h3>
            <div class="box-tools">
              <div class="input-group">
                <input type="text" style="width: 50%;" name="search" id="txtSearch" class="form-control input-sm pull-right" placeholder="Search" >
                <div class="input-group-btn">
                  <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
          </div><!-- /.box-header -->
          <div id="CATEGORY">
          <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th width="15%">Title</th>
<!--                  <th width="15%">ENGLISH Title</th>
                  <th width="15%">CHINESE Title</th>-->
                  <!--<th width="20%">Description</th>-->
                  <th>Parent</th>
                  <th>Ordering</th>
                  <th>Status</th>
                  <th>Author</th>
                  <th>Created Date</th>
                  <!--<th>Updated By</th>-->
                  <th>Updated Date</th>
                  <th width="15%" style="text-align:center;">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $key=>$category)
                <tr>
                  <td id="CATEGORY_ID" style="display:none">{{$category->id}}</td>
                  <td>{{ ++$key }}</td>
<!--                  <td>
                    {!! $category->translation('kh')->first() ? $category->translation('kh')->first()->title: '<span class="label label-info">NOT YET TRANSLATE</span>' !!}
                  </td>
                  <td>
                    {!! $category->translation('ch')->first() ? $category->translation('kh')->first()->title: '<span class="label label-info">NOT YET TRANSLATE</span>' !!}
                  </td>-->
                  <td>
                  {{ str_limit($category->title, $limit = 50, $end = '...') }}</td>
                  
                  <!--<td>{{ str_limit($category->description, $limit = 70, $end = '...') }}</td>-->
                  <td>{{ $category->parentCategory()->first() ? $category->parentCategory()->first()->title : '' }}</td>
                  <td align="center">{{ $category->ordering }}</td>
                  <td align="center">
                    @if ($category->status=='1') 
                      <span class="label label-success">Active</span>
                    @elseif($category->status=='0')
                      <span class="label label-danger">Inactive</span>
                    @endif
                  </td>
                  <td>{{ $category->createdBy->email }}</td>
                  <td>{{ $category->created_at }}</td>
                  <!--<td>{{ $category->updatedBy->email }}</td>-->
                  <td>{{ $category->updated_at }}</td>
                  <td style="text-align:center;">
                    <a href="{{ URL('admin/categories/'.$category->id.'/edit') }}" id="btnEdit">
                      <i class="fa fa-edit"></i> &nbsp;| &nbsp;
                    </a>
                    <a href="javascript:;" id="btnRemove">
                      <i class="fa fa-trash-o"></i> &nbsp;| &nbsp;
                    </a>
                    <a href="{{ URL('admin/categories/'.$category->id)}}" id="btnTranslate">
                      <!--<i class="fa fa-spinner fa-pulse"></i>-->
                      <i class="fa fa-language"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
            </tbody>
            </table>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <div class="row">
              <div class="col-sm-5">
                <div class="dataTables_info">Showing 1 to {{ $categories->perPage() * $categories->currentPage()}} of {{ $categories->total()}} entries</div>
              </div>
              <div class="col-sm-7">
                 {!! $categories->render()!!}
              </div>
            </div>
          </div><!-- box-footer -->
          </div>
          <select class="form-control" style="width:100px;" id="perPage">
            <option value="15">15</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        </div><!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
@endsection
@section('script')
<script>
  $(document).ajaxStart(function() { Pace.restart(); }); 
  $(document).on('click','.pagination a', function(e){
      e.preventDefault();
      var pageId = $(this).attr('href').split('page=')[1];
      var data = {
            page: pageId,
            limit: $("#perPage").val(),
            search : $('#txtSearch').val()
    };
    categories.getAllCategories(data);
  });
  
  $("#txtSearch, #btnSearch").keyup(function(){
    var data = {
            limit: $("#perPage").val(),
            search : $('#txtSearch').val()
    };
    categories.getAllCategories(data);
  });
  $("#perPage").change(function(){
    var data = {
            limit: $("#perPage").val(),
            search : $('#txtSearch').val()
    };
    categories.getAllCategories(data);
  });
  
  $(document).on('click', '#btnEdit', function(){
    
  });
  
  $(document).on('click', '#btnRemove', function(){ 
    var options = {
    	bg: '#e74c3c',
    
    	// leave target blank for global nanobar
    	target: document.getElementById('myDivId'),
    
    	// id for new nanobar
    	id: 'mynano'
    };
    
    var nanobar = new Nanobar( options );
    var id = $(this).parents('tr').find("#CATEGORY_ID").html();
    var url = "{{URL::to('admin/categories/')}}";
    $.ajax({
          url: url+"/"+id,
          dataType: "JSON",
          type: "DELETE",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          beforeSend: function(){
            // move bar
            nanobar.go( 30 ); // size bar 30%
          
          },
          success: function(data){
            if(data.STATUS){
                var pageId = $(".pagination .active span").html();
                var data = {
                      page: pageId,
                      limit: $("#perPage").val(),
                      search : $('#txtSearch').val()
                };
                categories.getAllCategories(data);
            }else{
              
            }
            // Finish progress bar
            nanobar.go(100);
          }
      });  
  });
  
  $(document).on('click', '#btnTranslate', function(){ 
    
  });
  
  var categories = {};
  categories.getAllCategories = function(data){
    var options = {
    	bg: '#e74c3c',
    
    	// leave target blank for global nanobar
    	target: document.getElementById('myDivId'),
    
    	// id for new nanobar
    	id: 'mynano'
    };
    
    var nanobar = new Nanobar( options );
    $.ajax({
          url: "{{URL::to('rest/admin/categories')}}",
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
            $('#CATEGORY').html(data);
            // Finish progress bar
            nanobar.go(100);
          }
      });
  }
</script>
@endsection