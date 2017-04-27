<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ADMIN GREEN ARCHITECTURE DESIGN | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- FontAwesome 4.3.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons 2.0.0 -->
        <link href="https://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ asset('/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link href="{{ asset('/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="{{ asset('/plugins/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="{{ asset('/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="{{ asset('/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="{{ asset('/plugins/pace/pace.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/bower_components/alertify/themes/alertify.core.css') }}" />
        <link rel="stylesheet" href="{{ asset('/bower_components/alertify/themes/alertify.bootstrap.css') }}" />
        <link href="{{ asset('/dist/css/dropzone.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <style>
            .fontawesome-select {
                font-family: 'FontAwesome', 'Helvetica';
            }
            .pagination>.active>a, 
            .pagination>.active>a:focus, 
            .pagination>.active>a:hover, 
            .pagination>.active>span, 
            .pagination>.active>span:focus, 
            .pagination>.active>span:hover {
                background-color: #00A65A;
                border-color: #00A65A;
            }
            .btn{
                border-radius: 0;
            }
            
            .element {
                position: relative;
                background:#fff;
                width:100%;
                height:100%;
            }
 
            /*replace the content value with the
            corresponding value from the list below*/
             
            .element{
                /*content: "\f000";*/
                font-family: FontAwesome;
                font-style: normal;
                font-weight: normal;
                text-decoration: inherit;
            /*--adjust as necessary--*/
                color: #000;
                font-size: 18px;
                padding-right: 0.5em;
                position: absolute;
                top: 0;
                left: 50%;
                z-index: 999;
            }
            .block {
                 background-color: blue;
                 width: 100%;
                 height: 100%;
                 margin: 10px;
              }
        </style>
    </head>
    <body class="skin-green">
    <!--<body class="skin-green sidebar-collapse">-->
        <div class="wrapper">
            @include('admin.includes.header')
            @include('admin.includes.sidebar')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
<!--                    <h1>
                    Dashboard
                    <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>-->
                    @yield('content_header')
                </section>
                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <!--<b>Version</b> 2.0-->
                </div>
                <center><strong>Copyright &copy; 2015 <a href="javascript:;">GREEN ARCHITECTURE DESIGN</a>.</strong> All rights reserved.</center>
            </footer>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.3 -->
        <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
        <!-- jQuery UI 1.11.2 -->
        <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
        <script src="//oss.maxcdn.com/jquery.form/3.50/jquery.form.min.js"></script>
        @yield('image')
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
        <!--<script src="{{ asset('/plugins/morris/morris.min.js') }}" type="text/javascript"></script>-->
        <!-- Sparkline -->
        <!--<script src="{{ asset('/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>-->
        <!-- jvectormap -->
        <!--<script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>-->
        <!--<script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>-->
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('/plugins/knob/jquery.knob.js') }}" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
        <!-- Slimscroll -->
        <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <!-- FastClick -->
        <script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('/dist/js/app.min.js') }}" type="text/javascript"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!--<script src="{{ asset('/dist/js/pages/dashboard.js') }}" type="text/javascript"></script>-->
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('/dist/js/demo.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/bower_components/nanobar/nanobar.js') }}"></script>
        <script src="{{ asset('/bower_components/alertify/lib/alertify.min.js') }}"></script>
        <script src="{{ asset('/plugins/pace/pace.min.js') }}"></script>
        @yield('script')
    </body>
</html>