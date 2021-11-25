<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta routeName="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/courseDetails.css') }}">
    
    @yield('assets')
</head>

<body class="admin-body">
    @php        
      $route = Route::currentRouteName();
      $name = Auth::user()->name;
      $userCount = count($userList);
      $studentCount = count($studentList);
      $teacherCount = count($teacherList);
      $courseCount = count($courseList);
      $assignmentCount = count($assignmentList);
    @endphp
    <div class="admin-container">
      <div class="admin-nav">
        <div class="right-nav clearfix">
          <div class="profile-blk">
              <button class="profile-btn">
                  <p> {{$name}} (Admin)</p>
              </button>
              <div class="dropdown">
                  <a href="{{ route('user.detail', ['id' => Auth::user()->id]) }}">
                      Profile</a>
                  <a href="{{ route('signout') }}">Logout</a>
              </div>
          </div>
        </div>
        <div class="tab clearfix">
          <button class="tab-btn active" onclick="showList(event,'user')">All Users <br> <span class="count">{{$userCount}} users</span></button>
          <button class="tab-btn" onclick="showList(event,'teacher')">Teachers <br> <span class="count">{{$teacherCount}} teachers</span></button>
          <button class="tab-btn" onclick="showList(event,'student')">Student <br> <span class="count">{{$studentCount}} students</span></button>
          <button class="tab-btn" onclick="showList(event,'course')">Courses <br> <span class="count">{{$courseCount}} courses</button>
          <button class="tab-btn" onclick="showList(event,'assignment')">Assignments <br> <span class="count">{{$assignmentCount}} assignments</button>
        </div>
      </div>

      <div class="admin-content">
        <div id="user" class="list-content show">
          <table class="list">
            <tr>
              <th>No</th>
              <th>User ID</th>
              <th>Name</th>
              <th>gender</th>
              <th>DOB</th>
              <th>Email</th>
              <th>Phone</th>              
            </tr>
            <tbody>
            <?php $index = 0; ?>
            @foreach($userList as $user)
              <tr class="row">
                <td class="number">{{ ++$index }}</td>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td ><p>{{ $user->gender }}</p></td>
                <td>{{ $user->dob }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <div id="teacher" class="list-content">
          <table class="list">
            <tr>
              <th>No</th>
              <th>Enroll Course</th>
              <th>User ID</th>
              <th>Name</th>
              <th>gender</th>
              <th>DOB</th>
              <th>Email</th>
              <th>Phone</th>
            </tr>
            <tbody>
            <?php $index = 0; ?>
            @foreach($teacherList as $teacher)
              <tr class="row">
                <td class="number">{{ ++$index }}</td>
                <td><a type="button" href="/enroll/{{ $teacher->id }}" data-modal="modal-enroll" 
                      class="btn-show-modal enroll-btn">Enroll</a></td>
                <td>{{ $teacher->id }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->gender }}</td>
                <td>{{ $teacher->dob }}</td>
                <td>{{ $teacher->email }}</td>
                <td>{{ $teacher->phone }}</td>
              </tr>
              
            @endforeach
            </tbody>
          </table>
         
        </div>

        <div id="student" class="list-content">
          <table class="list">
            <tr>
              <th>No</th>
              <th>User ID</th>
              <th>Name</th>
              <th>gender</th>
              <th>DOB</th>
              <th>Email</th>
              <th>Phone</th>
            </tr>
            <tbody>
            <?php $index = 0; ?>
            @foreach($studentList as $student)
              <tr class="row">
              <td class="number">{{ ++$index }}</td>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->gender }}</td>
                <td>{{ $student->dob }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->phone }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <div id="course" class="list-content">
        <a href="/course/create-view" class="add-course-btn">
          Add Course
        </a>
          <table class="list">
            <tr>
              <th>No</th>
              <th>Course ID</th>
              <th>Title</th>
              <th>Category</th>
              <th>Description</th>
              <th>Required Courses</th>
              <th>Assignment</th>
            </tr>
            <tbody>
            <?php $index = 0; ?>
            @foreach($courseList as $course)
              <tr class="row">
                <td class="number">{{ ++$index }}</td>
                <td>{{ $course->id }}</td>
                <td>{{ $course->title }}</td>
                <td>{{ $course->category }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->required_courses }}</td>
                <td>
                  <a href="{{route('assignment.add', ['assignment_id' => $course->id])}}" class="add-course-btn">Add</a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <div id="assignment" class="list-content">
            <table class="list">
              <tr>
                <th>No</th>
                <th>ID</th>
                <th>Name</th>
                <th>File Name</th>
                <th>Course ID</th>
              </tr>
              <tbody>
              <?php $index = 0; ?>
              @foreach($assignmentList as $item)
                <tr class="row">
                  <td class="number">{{ ++$index }}</td>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->name }}</td>
                  <td>{{ basename($item->file_path) }}</td>
                  <td>{{ $item->course_id }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <script src="{{ asset('js/common/app.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('js/tab.js') }}"></script>
    <script src="{{ asset('js/library/jquery.min.js') }}"></script>
    <script src="{{ asset('js/library/accordian.js') }}"></script>
    <script src="{{ asset('js/library/confirm_modal.js') }}"></script>
    @yield('scripts')
    
</body>

</html>