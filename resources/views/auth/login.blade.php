<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>

            </div>



            <div class="card-body">

                <p class="login-box-msg">{{__('Login in to start your session')}}</p>

                <div class="card-body">

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif


                    <form action="{{ route('login' ) }}" method="post">
                        @csrf
                        <div class="form-group has-feedback">

                            <input type="email" class="form-control @error('email') is-invalid @enderror" name='email' placeholder="{{ __('Email') }}">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder=" {{ __('Password') }} ">

                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">{{ __('LogIn') }}</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>



                </div>
                <!-- /.card-body -->

                <div class="row">
                    <P style="margin: 6px;">{{__('Chage Language:')}}</P><br>
                    @if(session()->get('locale') == "np" )
                    <a href="locale/en" class="nav-link"><img src="{{asset('extra/English.png')}}" style="margin: -20px; width:30px; height:30px"></a>
                    @endif

                    @if(session()->get('locale') == "en" || app()->getLocale()=='en' )
                    <a href="locale/np" class="nav-link"><img src="{{asset('extra/Nepali.png')}}" style="margin: -20px; width:30px; height:30px"></a>
                    @endif

                </div>

            </div>

            <!-- /.card -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>

</html>