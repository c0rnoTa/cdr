<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FBX nano</title>

    <!-- Bootstrap -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="/vendors/switchery/dist/switchery.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/css/custom.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>

<body class="login">
<div>

    <div class="login_wrapper">
        <div class="form login_form">
            <section class="login_content">
                <form role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <h1>Вход</h1>
                    @if ($errors->has('password') || $errors->has('login'))
                        <div class="alert alert-warning alert-dismissible fade in" role="alert">
                            <strong>Ошибка авторизации!</strong>
                            @if ($errors->has('login'))
                                {{ $errors->first('login') }}
                            @else
                                {{ $errors->first('password') }}
                            @endif
                        </div>
                    @endif
                    <div>
                        <input type="text" name="login" class="form-control" placeholder="Логин" value="{{ old('login') }}" required="required" />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Пароль" required="required" />
                    </div>
                    <div class="col-md-6 col-xs-6 col-sm-6">
                        <label>
                            <input type="checkbox" class="js-switch" name="remember" /> Запомнить меня
                        </label>
                    </div>
                    <div class="col-md-3 col-md-offset-3 col-xs-3 col-sm-3 col-xs-offset-3 col-sm-offset-3">
                        <button type="submit" class="btn btn-success">Войти</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-phone"></i> FBX nano</h1>
                            <p>©2016-2017 Все права защищены. Антон.</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Switchery -->
<script src="/vendors/switchery/dist/switchery.min.js"></script>
<!-- validator -->
<script src="/vendors/validator/validator.js"></script>
<!-- Custom Theme Scripts -->
<script src="/js/custom.js"></script>

</body>
</html>