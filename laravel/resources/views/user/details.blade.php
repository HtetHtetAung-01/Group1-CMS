<html>

<head>
    <meta charset="utf-8">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="login-root">
        <!-- add narvar -->
        <div class="box-root">
            <div class="formbg">
                <div class="formbg-inner">
                    <span class="login-title">User Profile</span>
                    <form class="login-form" action="{{ url('/useredit/' . $detail->id) }}" method="GET">
                        <div class="text">
                            <img src="{{ asset($detail->profile_path) }}" alt="" width="100px" height="100px">
                        </div>
                        <div class="text">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ $detail->name }}" disabled>
                        </div>
                        <div class="text">
                            <label for="date_of_birth">Date_of_Birth</label>
                            <input type="date" id="date-of-birth" name="dob" value="{{ $detail->dob }}" disabled>
                        </div>
                        <label for="gender">Gender</label><br>
                        <input type="radio" name="gender" value="M" {{ $detail->gender == 'M' ? 'checked' : '' }} disabled>Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" value="F" {{ $detail->gender == 'F' ? 'checked' : '' }} disabled>Female
                        <hr />
                        <div class="text">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" value="{{ $detail->email }}" disabled>
                        </div>
                        <div class="text">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone" value="{{ $detail->phone }}" disabled>
                        </div>
                        <div class="text">
                            <label for="address">Address</label>
                            <input type="text" name="address" value="{{ $detail->address }}" disabled>
                        </div>
                        <div class="text edit">
                            <button class="edit-btn">Edit Profile</button>
                        </div>
                    </form>
                    <div class="text cancel">
                        <button class="back-btn" onclick="goBack()">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function goBack() {
        window.history.back();
    }
</script>

</html>