<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/skin-blue.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <style>
        .content-wrapper, .right-side {
            background-color: #fff;
        }
        .addButton{
            margin: 0 4px 9px 40px;
        }
        .addButton span {
            margin-left: 10px;
        }
    </style>
</head>
<body class="skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- include header -->
        @include('includes.header')
        <!-- Left side column. contains the logo and sidebar -->
        @include('includes.sidebar')
        
        @yield('content')
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/adminApp.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                $("#success-alert").slideUp(500);
            });
        });
    </script>
     @stack('scripts')
</body>
</html>