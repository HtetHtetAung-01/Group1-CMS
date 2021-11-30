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
                    @if (Session::has('message'))
                        <div>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <form class="login-form" action="{{ route('forget.password.post') }}" method="POST">
                        @csrf
                        <div class="text">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <label for="email">E-mail</label>
                            <input type="email" id="email_address" class="form-control" name="email" required
                                autofocus>
                        </div>
                        <div class="text">
                            <button type="submit" class="login-btn">Send Password Reset Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
