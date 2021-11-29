<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <title>Add New Assignment</title>
</head>

<body>
    <div class="assignment-pnl">
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
        <h2>Add New Assignment</h2>
        <form action="{{ route('assignment.add.submit') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="text">
              <label for="course_id">Course ID</label><br>
              <input type="text" name="course_id" value="{{$assignment_id}}" readonly>
            </div>
            <div class="text">
                <label for="title">Name</label><br>
                <input type="text" name="name">
            </div>
            <div class="text">
                <label for="description">Description</label><br>
                <textarea name="description" rows="3" cols="50"></textarea>
            </div>
            <div class="text">
              <label for="duration">Duration</label><br>
              <input type="text" name="duration">
            </div>
            <div class="text">
              <label for="file">File</label><br>
              <input type="file" name="file" class="default-file-input file-input"/>
            </div>
            <button type="submit" class="register-btn">Add Assignment</button>
        </form>
    </div>
</body>

</html>
