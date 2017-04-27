@extends('admin.app')

@section('content_header')
<h1>
  USER MANAGEMENT
  <small>LIST All USERS</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">LIST ALL USERS</li>
</ol>
@endsection
@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="row">   
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">LIST All USERS</h3>
            <div class="box-tools">
              <div class="input-group">
                <input type="text" style="width: 50%;" name="search" id="txtSearch" class="form-control input-sm pull-right" placeholder="Search" >
                <div class="input-group-btn">
                  <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
          </div><!-- /.box-header -->
          <div id="USER">
          <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Last Name</th>
                  <th>First Name</th>
                  <th>Email</th>
                  <th style="text-align:center;">Role</th>
                  <th>Date</th>
                  <th style="text-align:center;">Status</th>
                  <th width="10%" style="text-align:center;">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td id="USER_ID">{{ $user->id }}</td>
                  <td>{{ $user->lastname }}</td>
                  <td>{{ $user->firstname }}</td>
                  <td>{{ $user->email }}</td>
                  <td style="text-align:center;">
                    @if ($user->is_admin=='1') 
                      <span class="label label-primary">Administrator</span>
                    @elseif($user->is_admin=='0')
                      <span class="label label-success">User</span>
                    @endif</td>
                  <td>{{ $user->created_at }}</td>
                  <td style="text-align:center;">
                    @if ($user->status=='1') 
                      <span class="label label-success">Active</span>
                    @elseif($user->status=='0')
                      <span class="label label-danger">Inactive</span>
                    @endif
                  </td>
                  <td style="text-align:center;">
                    <a href="{{ url('admin/users/'.$user->id.'/edit') }}" id="btnEdit">
                      <i class="fa fa-edit"></i> &nbsp;| &nbsp;
                    </a>
                    <a href="javascript:;" id="btnRemove">
                      <i class="fa fa-trash-o"></i> &nbsp;
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
                <!--<div>Showing of {{ $users->total()}} entries</div>-->
              </div>
              <div class="col-sm-7">
                {!! $users->render()!!}
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
    users.getAllUsers(data);
  });
  
  $("#txtSearch, #btnSearch").keyup(function(){
    var data = {
            limit: $("#perPage").val(),
            search : $('#txtSearch').val()
    };
    users.getAllUsers(data);
  });
  $("#perPage").change(function(){
    var data = {
            limit: $("#perPage").val(),
            search : $('#txtSearch').val()
    };
    users.getAllUsers(data);
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
    var id = $(this).parents('tr').find("#USER_ID").html();
    var url = "{{URL::to('admin/users/')}}";
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
                var json = {
                      page: pageId,
                      limit: $("#perPage").val(),
                      search : $('#txtSearch').val()
                };
                users.getAllUsers(json);
            }else{
              
            }
            // Finish progress bar
            nanobar.go(100);
          }
      });  
  });

  var users = {};
  users.getAllUsers = function(data){
    var options = {
    	bg: '#e74c3c',
    
    	// leave target blank for global nanobar
    	target: document.getElementById('myDivId'),
    
    	// id for new nanobar
    	id: 'mynano'
    };
    
    var nanobar = new Nanobar( options );
    $.ajax({
          url: "{{URL::to('rest/admin/users')}}",
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
            $('#USER').html(data);
            // Finish progress bar
            nanobar.go(100);
          }
      });
  }
</script>
@endsection

  