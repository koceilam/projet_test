@extends('default')
@section('content')
  <body class="hold-transition skin-blue">
    <div class="content">
      <div class="login-logo">
        <a href="/"> BO</a>
      </div><!-- /.login-logo -->
       <section class="content">
          <div class="error-page">
            <h2 class="headline text-yellow"> 409</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i>Conflict!</h3>
                <p><b>{!!$msg!!}</b><p>
              </p>
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
        </section><!-- /.content -->
    </div>
  </body>
@endsection
