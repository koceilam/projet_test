@extends('default')
@section('content')
  <body class="hold-transition skin-blue">
    <div class="content">
      <div class="login-logo">
        <a href="/"> BO</a>
      </div><!-- /.login-logo -->
       <section class="content">
          <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i>Page not found.</h3>
                <p>Our server cannot find any page for this URL.<p>
                <p>We are definitely sorry for the inconvenience.</p>
                <p>If you think this page must exist, please contact administrator.</p>
              </p>
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
        </section><!-- /.content -->
    </div>
  </body>
@endsection
