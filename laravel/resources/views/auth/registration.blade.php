<html>

<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="login-root">
        {{-- @if (count($errors) > 0)
            <!-- Form Error List -->
            <div class="error-alert">
                <i class="error-icon">&#xf06a;</i><strong>Whoops! Something went wrong!</strong>
                <br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <!-- add narvar -->
        <div class="box-root">
            <div class="formbg">
                <span class="login-title">Registration</span>
                <form class="login-form" action="{{ route('register-custom') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="text">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif<br>
                        <label for="name">Name</label><br>
                        <input type="text" name="name" value="{{old('name')}}">
                    </div>
                    <div class="text">
                        <label for="profile_path">Profile Picture</label>
                        <input type="file" id="profile-picture" name="profile_path" accept="image/png, image/jpeg">
                    </div>
                    <div class="text">
                        @if ($errors->has('dob'))
                            <span class="text-danger">{{ $errors->first('dob') }}</span>
                        @endif<br>
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="date-of-birth" name="dob" value="{{old('dob')}}">
                    </div>
                    @if ($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif<br>
                    <label for="gender">Gender</label><br>
                    <input type="radio" name="gender" value="M">Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="gender" value="F">Female
                    <hr />
                    <div class="text">
                        @if ($errors->has('role'))
                            <span class="text-danger">{{ $errors->first('role') }}</span>
                        @endif<br>
                        <label for="role">Role Type</label><br><br>
                        <select name="role_id" id="role-select">
                            <option value="">--Please choose a type--</option>
                            <option value="1">Student</option>
                            <option value="2">Teacher</option>
                        </select>
                    </div>
                    <hr />
                    <div class="text">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif<br>
                        <label for="email">E-mail</label>
                        <input type="email" name="email" value="{{old('email')}}">
                    </div>
                    <div class="text">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif<br>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="showPassword">
                    </div>
                    <input type="checkbox" onclick="showPasswordFunction()">Show Password
                    <div class="text">
                        @if ($errors->has('confirm_password'))
                            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                        @endif<br>
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirmPassword">
                    </div>
                    <hr />
                    <div class="text">
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif<br>
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone" value="{{old('phone')}}">
                    </div>
                    <div class="text">
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif<br>
                        <label for="address">Address</label>
                        <input type="text" name="address" value="{{old('address')}}">
                    </div>
                    <div class="text">
                        <button class="register-btn">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function showPasswordFunction() {
            var showPass = document.getElementById("showPassword");
            if (showPass.type === "password" || showPass.type === "confirm_password") {
                showPass.type = "text";
            } else {
                showPass.type = "password";
            }
        }
    </script>
</body>

</html>
