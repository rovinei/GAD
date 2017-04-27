<div class="box-body table-responsive">
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th width="20%">Title</th>
        <th>image</th>
        <th>Ordering</th>
        <th>Author</th>
        <th>Status</th>
        <th>Created Date</th>
        <th>Type</th>
        <th width="15%" style="text-align:center;">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($sliders as $slider)
        <tr>
          <td id="SLIDER_ID">{{$slider->id}}</td>
          <td>{{$slider->title}}</td>
          <td><img src="{{$slider->thumb_image}}" title="{{$slider->title}}" style="width:240px; height:140px;" class="thumbnail"/></td>
          <td style="text-align:center;">{{$slider->ordering}}</td>
          <td>{{$slider->createdBy->email}}</td>
          <td>
          @if ($slider->status=='1') 
            <span class="label label-success">Active</span>
          @elseif($slider->status=='0')
            <span class="label label-danger">Inactive</span>
          @endif
          </td>
          <td>{{$slider->created_at}}</td>
          <td>{{$slider->type}}</td>
          <td style="text-align:center;">
          <a href="{{ URL('admin/sliders/'.$slider->id.'/edit') }}" id="btnEdit">
            <i class="fa fa-edit"></i> &nbsp;| &nbsp;
          </a>
          <a href="javascript:;" id="btnRemove">
            <i class="fa fa-trash-o"></i>
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
      <div class="dataTables_info">Showing 1 to {{ $sliders->perPage() * $sliders->currentPage()}} of {{ $sliders->total()}} entries</div>
    </div>
    <div class="col-sm-7">
        <?php echo $sliders->render(); ?>
    </div>
  </div>
</div><!-- box-footer -->