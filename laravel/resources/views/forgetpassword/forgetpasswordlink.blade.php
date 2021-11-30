<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="login-root">
        <div class="box-root">
            <div class="formbg">
                <div class="formbg-inner">
                    <span class="login-title">Reset Password</span>
                    <form class="login-form" action="{{ route('reset.password.post') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="text">
                            <label for="email">E-mail</label>
                            <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="text">
                            <label for="password">New Password</label>
                            <input type="password" id="password" class="form-control" name="password" required
                                autofocus>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="text">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" id="password-confirm" class="form-control"
                                name="password_confirmation" required autofocus>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                        <div class="text">
                            <button class="login-btn" type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
