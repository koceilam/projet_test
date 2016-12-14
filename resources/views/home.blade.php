@extends('default')
@section('content')
  <body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">
      <!-- Main Header -->
      <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>BO</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>{{ ltrans( "globals.title_app")}}</b></span>
        </a>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel"  style="height:75px;">
            <div class="pull-left info">
              <p>{{ $user_name  }} <br/> est connécté</p>
              <!-- Status -->
            </div>
          </div>
        </section>
        <!-- /.sidebar -->
      </aside>
      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            {{$content_header}}
            <small>{!!$content_header_detail!!}</small>
          </h1>
        </section>
        <section class="content">{!!$content!!}</section>
      </div>
      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <!-- Default to the left -->
        <strong>Copyright &copy; Koceila.M 2015-2016 <a href="#"></a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
    {!!$footer!!}
  </body>
@endsection
