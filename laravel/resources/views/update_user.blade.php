<html>
<head>
  <meta charset="utf-8">
  <title>UserProfile</title>
  <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="login-root">
        <!-- add narvar -->
        <div class="box-root">
            <div class="formbg">
                <div class="formbg-inner">
                    <span class="login-title">User Profile</span>
                    <form class="login-form" action="{{url('/update/'.$userEdit->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="text">
                            <img src="C:\Users\Dell\Desktop\Design_auth\YQu5k.png" alt="">
                        </div>
                        <div class="text">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ $userEdit->name }}">
                        </div>
                        <div class="text">
                            <label for="Profile Picture">Profile Picture</label>
                            <input type="hidden" name="is_update" id="is_update" value="0">
                            <div><img src="{{asset($userEdit->photo)}}" id="photo" alt="" width="100px" height="100px" onclick="browseFile()"></div>
                            <input type="file" id="profile-picture" name="photo" onchange="showPreview(event);" accept="image/png, image/jpeg" style="display: none;">
                        </div>
                        <div class="text">
                            <label for="date_of_birth">Date_of_Birth</label>
                            <input type="date" id="date-of-birth" name="date_of_birth" value="{{ $userEdit->date_of_birth }}">
                        </div>
                        <label for="gender">Gender</label><br>
                        <input type="radio" name="gender" value="male" {{ $userEdit->gender == 'male' ? 'checked' : '' }} required>Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" value="female" {{ $userEdit->gender == 'female' ? 'checked' : '' }} required>Female
                        <hr/>
                        <div class="text">
                            <label for="role_type">Role Type</label><br><br>
                            <select name="role_type" id="role-select">
                                <option value="">--Please choose a type--</option>
                                <option value="student" {{($userEdit->role_type === 'student') ? 'Selected' : ''}}>Student</option>
                                <option value="teacher" {{($userEdit->role_type === 'teacher') ? 'Selected' : ''}}>Teacher</option>
                            </select>
                        </div>
                        <hr/>
                        <div class="text">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" value="{{ $userEdit->email }}">
                        </div>
                        <hr/>
                        <div class="text">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" value="{{ $userEdit->phone_number }}">
                        </div>
                        <div class="text">
                            <label for="address">Address</label>
                            <input type="text" name="address" value="{{ $userEdit->address }}">  
                        </div>
                        <div class="text">
                        <button class="edit-btn">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function browseFile(){
            document.getElementById('profile-picture').click();
        }
        function showPreview(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("photo");
            preview.src = src;
            preview.style.display = "block";
            document.getElementById('is_update').value = 1;
        }
        }
    </script>
</body>
</html>