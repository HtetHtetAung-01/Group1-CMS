<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <title>Document</title>
</head>
<body>
<form action="{{url('/useredit/'.$detail->id)}}" method="GET" enctype="multipart/form-data">
@csrf
<div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <h1><a href="http://blog.stackfindover.com/" rel="dofollow">Stackfindover</a></h1>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">UserDetail</span>
              <div class="field padding-bottom--24">
              <div><img src="{{asset($detail->photo)}}" alt="" width="100px" height="100px"></div>
                </div>
                <div class="field padding-bottom--24">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $detail->name }}" disabled>
                </div>
                <!-- <div class="field padding-bottom--24">
                <label for="Profile Picture">Profile Picture</label>
                <input type="file" id="photo" name="photo" accept="image/png, image/jpeg">
                </div> -->
               <div class="field padding-bottom--24">
                <label for="date_of_birth">Date of Birth</label>
                  <input type="date" id="date-of-birth" name="date_of_birth" value="{{ $detail->date_of_birth }}" disabled>
                </div>
                <label for="gender">Gender</label><br><br>
                <input type="radio" name="gender" value="male" {{ $detail->gender == 'male' ? 'checked' : '' }} required disabled>Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="gender" value="female" {{ $detail->gender == 'female' ? 'checked' : '' }} required disabled>Female
                <hr/>
                
                <div class="field padding-bottom--24">
                <label for="role_type">Role Type</label><br><br>
                  <select name="role_type" id="role-select" disabled>
                      <option value="" >--Please choose a type--</option>
                      <option value="student" {{($detail->role_type === 'student') ? 'Selected' : ''}} >Student</option>
                      <option value="teacher" {{($detail->role_type === 'teacher') ? 'Selected' : ''}} >Teacher</option>
                  </select>
                </div>
                <hr/>
                <div class="field padding-bottom--24">
                <label for="email">Email</label>
                  <input type="email" name="email" value="{{ $detail->email }}" disabled>
                </div>
                <!-- <div class="field padding-bottom--24">
                <label for="password">password</label>
                  <input type="password" name="password">
                </div>
                <div class="field padding-bottom--24">
                <label for="confirm_password">Confirm Password</label>
                  <input type="password" name="confirm_password">
                </div> -->
                <hr/>
                <div class="field padding-bottom--24">
                <label for="phone_number">Phone Number</label>
                  <input type="text" name="phone_number" value="{{ $detail->phone_number }}" disabled>
                </div>
                <div class="field padding-bottom--24">
                <label for="address">Address</label>
                  <input type="text" name="address" value="{{ $detail->address }}" disabled>
                </div>
                <div class="field padding-bottom--24">
                  <input type="submit" name="submit" value="Edit Profile">
                </div>
                <div class="field">
                  <a class="ssolink" href="#">Use single sign-on (Google) instead</a>
          </div>
            </div>
          </div>
          <div class="footer-link padding-top--24">
            <span>Don't have an account? <a href="">Sign up</a></span>
            <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
              <span><a href="#">© Stackfindover</a></span>
              <span><a href="#">Contact</a></span>
              <span><a href="#">Privacy & terms</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
</body>
</html>