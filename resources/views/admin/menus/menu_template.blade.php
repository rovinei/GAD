<div class="box-body table-responsive">
<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th width="20%">Title</th>
      <!--<th width="20%">Content</th>-->
      <th>Parent</th>
      <th align="center">Ordering</th>
      <th>Author</th>
      <th>Created Date</th>
      <!--<th>Updated By</th>
      <th>Updated Date</th>-->
      <th style="text-align:center;">Status</th>
      <!--<th>Views</th>-->
      <th width="10%" style="text-align:center;">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($menus as $key=>$menu)
    <tr>
      <td id="MENU_ID" style="display:none;">{{$menu->id}}</td>
      <td>{{ ++$key }}</td>
      <td>
        @for($i=0;$i<$menu->level;$i++)
          <i class='glyphicon glyphicon-chevron-right'></i>
        @endfor
        {{ str_limit($menu->title, $limit = 50, $end = '...') }}
      </td>
      <td>{{ $menu->parent_title }}</td>
      <td align="center">{{ $menu->ordering }}</td>
      <!--<td>{!! str_limit($menu->content, $limit = 70, $end = '...') !!}</td>-->
      <td>{{ $menu->author  }}</td>
      <td>{{ $menu->created_at }}</td>
      <!--<td>{{ $menu->editor }}</td>
      <td>{{ $menu->updated_at }}</td>-->
      <td style="text-align:center;">
        @if ($menu->status=='1') 
          <span class="label label-success">Active</span>
        @elseif($menu->status=='0')
          <span class="label label-danger">Inactive</span>
        @endif
      </td>
      <td style="text-align:center;">
        <a href="{{ URL('admin/menus/'.$menu->id.'/edit')}}" id="btnEdit">
          <i class="fa fa-edit"></i> &nbsp;| &nbsp;
        </a>
        <a href="javascript:;" id="btnRemove">
          <i class="fa fa-trash-o"></i> &nbsp;| &nbsp;
        </a>
        <a href="{{ URL('admin/menus/'.$menu->id)}}" id="btnTranslate">
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
    <div class="dataTables_info">Showing 1 to {{ $menus->perPage() * $menus->currentPage()}} of {{ $menus->total()}} entries</div>
  </div>
  <div class="col-sm-7">
      <?php echo $menus->render(); ?>
  </div>
</div>
</div><!-- box-footer -->