<div class="box-body table-responsive">
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th width="15%">Title</th>
        <!--<th width="15%">ENGLISH Title</th>
        <th width="15%">CHINESE Title</th>-->
        <!--<th width="20%">Description</th>-->
        <th>Parent</th>
        <th>Ordering</th>
        <th>Status</th>
        <th>Author</th>
        <th>Created Date</th>
        <!--<th>Updated By</th>-->
        <th>Updated Date</th>
        <th width="10%" style="text-align:center;">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $key=>$category)
      <tr>
        <td id="CATEGORY_ID" style="display:none">{{$category->id}}</td>
        <td>{{ ++$key }}</td>
<!--        <td>
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