<div class="box-body table-responsive">
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th width="20%">Title</th>
        <th width="20%">Content</th>
        <th>category</th>
        <th>Homepage</th>
        <th>Status</th>
        <th>Author</th>
        <th>Created Date</th>
<!--                  <th>Updated By</th>-->
        <th>Updated Date</th>
        <!--<th>Views</th>-->
        <th width="15%" style="text-align:center;">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($contents as $content)
      <tr>
        <td id="CONTENT_ID">{{ $content->id }}</td>
        <td>{{ str_limit($content->title, $limit = 50, $end = '...') }}</td>
        <td>{{ str_limit($content->content, $limit = 70, $end = '...') }}</td>
        <td>{{ $content->category->title }}</td>
        <td style="text-align:center;">
          @if ($content->show_home_page=='1') 
            <span class="label label-success">YES</span>
          @elseif($content->show_home_page=='0')
            <span class="label label-danger">NO</span>
          @endif
        </td>
        <td>
          @if ($content->status=='1') 
            <span class="label label-success">Active</span>
          @elseif($content->status=='0')
            <span class="label label-danger">Inactive</span>
          @endif
        </td>
        <td>{{ $content->createdBy->email }}</td>
        <td>{{ $content->created_at }}</td>
        <td>{{ $content->updated_at }}</td>
        <td style="text-align:center;">
          <a href="{{ URL('admin/contents/'.$content->id.'/edit') }}" id="btnEdit">
            <i class="fa fa-edit"></i> &nbsp;| &nbsp;
          </a>
          <a href="javascript:;" id="btnRemove">
            <i class="fa fa-trash-o"></i> &nbsp;| &nbsp;
          </a>
          <a href="{{ URL('admin/contents/'.$content->id)}}" id="btnTranslate">
            <!--<i class="fa fa-spinner fa-pulse"></i>-->
            <i class="fa fa-language"><span class="badge" style="background-color:#e74c3c;">{{ $content->translationCount->count() }}</span></i>
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
      <div class="dataTables_info">Showing 1 to {{ $contents->perPage() * $contents->currentPage()}} of {{ $contents->total()}} entries</div>
    </div>
    <div class="col-sm-7">
        <?php echo $contents->appends(['sorts'=>'title'])->render(); ?>
    </div>
  </div>
</div><!-- box-footer -->