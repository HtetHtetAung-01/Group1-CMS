<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="login-root">
        <!-- add narvar -->
        <div class="box-root">
            <div class="formbg">
                <span class="login-title">Login</span>
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <form class="login-form" form action="{{ route('login-custom') }}" method="POST">
                    @csrf
                    <div class="text">
                        <label for="email">E-mail</label>
                        <input type="email" name="email">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="text">
                        <label for="password">Password</label>
                        <input type="password" name="password">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="text">
                        <div class="reset-pass">
                            <a href="{{ route('forget.password.get') }}">Forgot your password?</a>
                        </div>
                    </div>
                    <div class="text">
                        <button class="login-btn">Login</button>
                    </div>
                    <p>Don't have an account?<a href="{{ route('register-user') }}"> Register Now</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
