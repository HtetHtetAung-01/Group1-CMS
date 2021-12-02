<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta routeName="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('assets')
</head>

<body>
    @php
        $route = Route::currentRouteName();
        if (Auth::user()->role_id == 1) {
            $role = 'student';
        } elseif (Auth::user()->role_id == 2) {
            $role = 'teacher';
        } else {
            $role = 'admin';
        }
        if (File::exists(public_path(Auth::user()->profile_path)))
            $image = Auth::user()->profile_path;
        else  
            $image = "";
    @endphp

    <nav class="top-nav">

      <h1>
        <a href="{{ route('login') }}" class="logo-link">
          <img src="/img/logo.png" class="logo" alt="logo">
        </a>
      </h1>

      <div class="btn-nav">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <!-- /.btn-nav -->

      <ul>
        <li class="profile">
          <a href="{{ route('user.detail', ['id' => Auth::user()->id]) }}" class="">
            <div class="profile-btn clearfix">
                @if($image == "")
                    <img class="profile-picture" src="/img/profile-default.png">
                @else
                    <img class="profile-picture" src="{{ asset($image) }}" alt="profile-picture">
                @endif
                <p class="profile-name">{{ Auth::user()->name }} ({{ $role }})</p>
            </div>
          </a>
        </li>

        <li class="@if ($route == $role . '.dashboard') ? active : ''; @endif">
            <a href="{{ route($role . '.dashboard', ['id' => Auth::user()->id]) }}">
                <i class="db-icon">&#xf201;</i>
                <p class="tb-sidebar-txt">Dashboard</p>
            </a>
        </li>
        @if ($role == 'student')
        <li class="@if (str_contains($route, 'course')) ? active : ''; @endif">
            <a href="{{ route($role. '.course' ,['id' => Auth::user()->id]) }}">
                <i class="db-icon">&#xf07b;</i>
                <p class="tb-sidebar-txt">Course</p>
            </a>
        </li>
        @endif
        <li class="@if ($route == $role . '.assignment') ? active : ''; @endif">
            @if (Auth::user()->role_id == 1)
                <a href="{{ route('student.assignment', ['id' => Auth::user()->id]) }}">
                    <i class="db-icon">&#xf518;</i>
                    <p class="tb-sidebar-txt">Assignment</p>
                </a>
            @elseif(Auth::user()->role_id == 2)
                <a href="{{ route('teacher.assignment', ['id' => Auth::user()->id]) }}">
                    <i class="db-icon">&#xf518;</i>
                    <p class="tb-sidebar-txt">Assignment</p>
                </a>
            @endif
        </li>
        @if ($role == 'teacher')
            <li class="@if ($route == 'studentList') ? active : ''; @endif">
                <a href="{{ route('studentList', ['id' => Auth::user()->id]) }} ">
                    <i class="db-icon">&#xf0c0;</i>
                    <p class="tb-sidebar-txt">Students</p>
                </a>
            </li>
        @endif
        <li>
          <a href="{{ route('logout') }}">
              <i class="db-icon">&#xf52b;</i>
              <p class="tb-sidebar-txt">Logout</p>
          </a>
      </li>
      </ul>
    </nav>
    <!-- /.top-nav -->

    <div class="container clearfix">
        <aside class="sidebar">
            <h1 class="logo">
                <a href="{{ route('login') }}" class="logo-link">
                    <img src="/img/logo.png" alt="logo" class="pc_logo">
                    <img src="/img/tb_logo.png" alt="tb_logo" class="tb_logo">
            </h1>
            </a>
            <ul>
                <li class="@if ($route == $role . '.dashboard') ? active : ''; @endif">
                    <a href="{{ route($role . '.dashboard', ['id' => Auth::user()->id]) }}">
                        <i class="db-icon">&#xf201;</i>
                        <p class="tb-sidebar-txt">Dashboard</p>
                    </a>
                </li>
                @if ($role == 'student')
                <li class="@if (str_contains($route, 'course')) ? active : ''; @endif">
                    <a href="{{ route($role. '.course' ,['id' => Auth::user()->id]) }}">
                        <i class="db-icon">&#xf07b;</i>
                        <p class="tb-sidebar-txt">Course</p>
                    </a>
                </li>
                @endif

                <li class="@if ($route == $role . '.assignment') ? active : ''; @endif">

                    @if (Auth::user()->role_id == 1)
                        <a href="{{ route('student.assignment', ['id' => Auth::user()->id]) }}">
                            <i class="db-icon">&#xf518;</i>
                            <p class="tb-sidebar-txt">Assignment</p>
                        </a>
                    @elseif(Auth::user()->role_id == 2)
                        <a href="{{ route('teacher.assignment', ['id' => Auth::user()->id]) }}">
                            <i class="db-icon">&#xf518;</i>
                            <p class="tb-sidebar-txt">Assignment</p>
                        </a>
                    @endif
                </li>

                @if ($role == 'teacher')
                    <li class="@if ($route == 'studentList') ? active : ''; @endif">
                        <a href="{{ route('studentList', ['id' => Auth::user()->id]) }} ">
                            <i class="db-icon">&#xf0c0;</i>
                            <p class="tb-sidebar-txt">Students</p>
                        </a>
                    </li>
                @endif

            </ul>
            <div class="scm-link">
                <p class="scm-txt">Seattle Consulting Myanmar Co., Ltd.</p>
                <a href="http://seattleconsultingmyanmar.com/" target="_blank">
                    <span>
                        <i class="globe-icon">&#xf0ac;</i>
                        <p class="tb-sidebar-txt">SCM</p> 
                    </span>
                </a>
            </div>
        </aside>
        <div class="content">
          <nav class="nav clearfix">
            <p class="text">Hello, Let's Learn Together!</p>
            <div class="profile-blk">
                <button class="profile-btn clearfix">
                    @if($image == "")
                        <img class="profile-picture" src="/img/profile-default.png">
                    @else
                        <img class="profile-picture" src="{{ asset($image) }}" alt="profile-picture">
                    @endif
                    <p class="profile-name">{{ Auth::user()->name }} ({{ $role }})</p>
                </button>
                <div class="dropdown">
                    <a href="{{ route('user.detail', ['id' => Auth::user()->id]) }}">
                        Profile</a>
                    <a href="{{ route('logout') }}">Logout</a>
                </div>
            </nav>
            <div class="main-visual">
                @if (count($errors) > 0)
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
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('js/library/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/common/app.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    @yield('scripts')

</body>

</html>
