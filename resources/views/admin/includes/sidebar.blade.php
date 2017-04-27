<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!--<div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->lastname}} {{Auth::user()->firstname }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>-->
      <!-- search form -->
      <!--<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="{{ url('/admin/dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>@lang('administrators.dashboard')</span> <!--<i class="fa fa-angle-left pull-right"></i>-->
          </a>
          <!--<ul class="treeview-menu">
            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>-->
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>@lang('administrators.contents')</span>
            <!--<span class="label label-primary pull-right">4</span>-->
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/admin/contents')}}"><i class="fa fa-circle-o"></i> List All Contents</a></li>
            <li><a href="{{ url('/admin/contents/create')}}"><i class="fa fa-circle-o"></i> Add New Content</a></li>
          </ul>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>@lang('administrators.categories')</span>
            <!--<span class="label label-primary pull-right">4</span>-->
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/admin/categories')}}"><i class="fa fa-circle-o"></i> List All Categories</a></li>
            <li><a href="{{ url('/admin/categories/create')}}"><i class="fa fa-circle-o"></i> Add New Category</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>@lang('administrators.menus')</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/admin/menus')}}"><i class="fa fa-circle-o"></i> List All Menus</a></li>
            <li><a href="{{ url('/admin/menus/create')}}"><i class="fa fa-circle-o"></i> Add New Menus</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="{{ url('/admin/languages')}}">
            <i class="fa fa-laptop"></i>
            <span>@lang('administrators.slideshow')</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/admin/sliders')}}"><i class="fa fa-circle-o"></i> List All Slides</a></li>
            <li><a href="{{ url('/admin/sliders/create')}}"><i class="fa fa-circle-o"></i> Add New Slide</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="{{ url('/admin/users')}}">
            <i class="fa fa-edit"></i> <span>@lang('administrators.users')</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ url('/admin/users')}}"><i class="fa fa-circle-o"></i> List All Users</a></li>
            <li><a href="{{ url('/admin/users/create')}}"><i class="fa fa-circle-o"></i> Add New User</a></li>
            <!--<li><a href="{{ url('/admin/users/change_password')}}"><i class="fa fa-circle-o"></i> Change Password</a></li>-->
          </ul>
        </li>
        <!--<li class="treeview active">-->
        <li class="treeview">
          <a href="{{ url('/admin/settings')}}">
            <i class="fa fa-edit"></i> <span>@lang('administrators.settings')</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <!--<ul class="treeview-menu">
            <li class="active"><a href="general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>-->
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>