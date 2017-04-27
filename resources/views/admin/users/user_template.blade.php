<div class="box-body table-responsive">
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th id="USER_ID">ID</th>
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