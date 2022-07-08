<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <meta name="description" content="">
    <meta name="theme-color" content="#000">
    <meta name="msapplication-navbutton-color" content="#000">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">
    <link rel="shortcut icon" href="{{ asset('favicon-16.png') }}" type="image/x-icon">
    <title>Вход</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
            integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
</head>

<body class="login" style="background-image:url({{ asset('img/background.jpg') }})">
<div class="container login-wrap">
    <div class="row">
        <div class="col-md-5 left-col" style="background-image:url({{ asset('img/form-background.jpg') }})">
            <h1>Fridge master</h1>
            <a class="logo" href="https://github.com/bromimo?tab=repositories" target="_blank"><img
                        src="{{ asset('img/logo_white.png') }}" alt="logo"></a>
        </div>
        <div class="col-md-7 right-col">
            <div class="form">
                <div class="logo-form"><img src="{{ asset('img/logo-anonymous.png') }}" alt="logo"></div>
                <h3>Авторизация</h3>
                <form id="login" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fas fa-user login-icon"></i>
                        </span>
                        <input class="form-control @error('email') is-invalid @enderror"
                                type="text" name="email" placeholder="E-mail" value="{{ old('email') }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fas fa-lock login-icon"></i>
                        </span>
                        <input class="form-control @error('password') is-invalid @enderror"
                                type="password" name="password" placeholder="Пароль" value="">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group">
                        <button class="btn btn-block disabled" id="submit">
                            <i class="fas fa-refresh fa-spin"></i>
                            Войти
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>