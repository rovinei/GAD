@extends('admin.app')

@section('content_header')
<h1>Dashboard<small>Control panel</small></h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-primary">
				<div class="panel-heading">Register A New User</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					@if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
					<form class="form-horizontal" role="form" method="POST" action="{{route('admin.users.store')}}">
						<!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
						{!! csrf_field() !!}

						<div class="form-group">
							<label class="col-md-4 control-label">First Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Last Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>
        				<div class="form-group" >
                            <label for="ipt" class=" control-label col-md-4 text-right"> Is Admin</label> 
                            <div class="col-md-6">
                              <label class="radio-inline  ">             
                                <input type="radio" name="is_admin" class="is_amin"value="1"/>Yes
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="is_admin" class="is_admin" value="0" checked="checked"/> No
                              </label>    
                            </div> 
                          </div>
          				<div class="form-group   " >
                            <label for="ipt" class=" control-label col-md-4 text-right"> Status</label> 
                            <div class="col-md-6">
                              <label class="radio-inline  ">             
                                <input type="radio" name="status" class="status"value="1" checked="checked"/>Active
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="status" class="status" value="0"/> Inactive
                              </label>    
                            </div> 
                          </div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-success">
									Register
								</button>
								<button class="btn btn-default">
									cancel
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	$(document).ajaxStart(function() { Pace.restart(); }); 
@endsection