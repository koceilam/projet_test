<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Test Grand Luxury Hotel</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{ url('/css/style.css')}}" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{ url("/adminlte/bootstrap/css/bootstrap.min.css") }}">
        <link rel="stylesheet" href="{{ url("/adminlte/plugins/jQueryUI/smoothness/jquery-ui.css")}}">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ url("/adminlte/plugins/datepicker/datepicker3.css")}}"/>
        <link rel="stylesheet" href="{{ url("/adminlte/plugins/bootstrap-editable/bootstrap-editable.css")}}"/>
        <link rel="stylesheet" href="{{ url("/adminlte/plugins/datatables/dataTables.bootstrap.css")}}">
        <link rel="stylesheet" href="{{ url("/adminlte/plugins/iCheck/all.css")}}">

        <link rel="stylesheet" href="{{ url("/adminlte/plugins/select2/select2.min.css")}}">
        <link rel="stylesheet" href="{{ url("/adminlte/plugins/daterangepicker/daterangepicker-bs3.css")}}">
        <link rel="stylesheet" href="{{ url("/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.css")}}">
        <link rel="stylesheet" href="{{ url("/adminlte/plugins/monthpicker/MonthPicker.css")}}">

        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ url("/adminlte/dist/css/AdminLTE.min.css")}}">
        <link rel="stylesheet" href="{{ url("/adminlte/dist/css/skins/skin-red.min.css")}}">
        <link rel="stylesheet" href="{{ url("/css/style.css")}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="{{ url("/adminlte/plugins/jQuery/jQuery-2.1.4.min.js") }}" type="text/javascript"></script>
    </head>
    <body>
        @yield('content')
    <script src="{{ url("/js/holidays.js") }}" type="text/javascript"></script>
    </body>
</html>
