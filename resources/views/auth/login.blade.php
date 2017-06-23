<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form  role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} has-feedback" >
                    <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" value="bpnptl24@gmail.com" required autofocus> 
                    <span class="fa fa-user form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span> 
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                    <input id="password" type="password" value="123456" placeholder="Password" class="form-control" name="password" required> 
                    <span class="fa fa-user form-control-feedback"></span>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span> 
                        @endif
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </form>
            <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
            });
        });
    </script>
</body>

</html>
