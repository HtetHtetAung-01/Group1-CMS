<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta routeName="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <nav class="nav clearfix">
    <h1 class="cms">CMS</h1>
    <div class="profile-blk">
      <button class="profile-btn">
        <p>{{ $user->name }} ({{ $role }})</p>
      </button>
      <div class="dropdown">
        <a href="#">Profile</a>
        <a href="#">Logout</a>
        <a href="#">Setting</a>
      </div>
    </div>
  </nav>
  @php
    $route = Route::currentRouteName();
    $roleName = strtolower($role);
  @endphp
  <div class="container clearfix">
    <aside class="sidebar">
      <ul>
        <li class="@if($route == $roleName.'dashboard') ? active : ''; @endif"><a href="<?php echo '/'.$roleName.'/'.$user->id.'/dashboard' ?>">Dashboard</a></li>
        <li class="@if($route == $roleName.'.course') ? active : ''; @endif">
          <a  class="menu-btn">Course
          <span class="fa fa-caret-down first"></span>
          </a>
          
          <ul class="menu-show">
            @foreach($enrolledCourse as $course)
              <li class="list"><a href="{{ route("student.course", ['id' => Auth::user()->id, 'course_id'=>$course->id ]) }}">{{ $course->title }}</a></li>
            @endforeach
          </ul>
        </li>

        <li class="@if($route == $roleName.'.assignment') ? active : ''; @endif">

        @if(Auth::user()->role_id == 1)
          <a href="{{ route("student.assignment", ['id' => Auth::user()->id])}}">Assignment</a>
        @elseif(Auth::user()->role_id == 2)
          <a href="{{ route("teacher.assignment", ['id' => Auth::user()->id])}}">Assignment</a>        
        @endif
        </li>

        @if($roleName == 'teacher')
          <li class="@if($route == 'studentList') ? active : ''; @endif">
            <a href="{{route ('studentList', ['id' => Auth::user()->id]) }} ">Students</a>
          </li>
        @endif
        
      </ul>
    </aside>
    <div class="content">
    {{ Auth::user()->name }}
    @yield('content')
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="{{ asset('js/common/app.js') }}"></script>
  <script src="{{ asset('js/library/jquery-3.4.1.min.js') }}"></script>
</body>
</html>