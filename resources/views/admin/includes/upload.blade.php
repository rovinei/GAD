<!-- code for popup file manager -->		
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	      <h4 class="modal-title">File Manager</h4>
	    </div>
	    <div class="modal-body">
            <form action="{{ url('admin/images')}}" id="upload" method="POST" enctype="multipart/form-data">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="file" name="image" id="image" class="form-control"/>
                <input type="submit" name="submit"class="form-control" id="submit" value="UPLOAD" />
            </form>	          
	    </div>
	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->