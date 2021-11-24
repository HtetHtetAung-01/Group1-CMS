<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/courseDetails.css') }}">
</head>
<body>
  <div class="enroll-box">
    <p>Choose the course to enroll for teacher '{{ $teacher_name }}'</p>
    <form action="/enroll/{{ $teacher_id }}/course" method="POST">
      {{ csrf_field() }}
        <select class="course-select" name="course_id">
          @foreach($courseList as $course)                    
            <option  value="{{ $course->id }}">{{ $course->title }}</option> 
          @endforeach
        </select>
      <!-- </div> -->
      <div class="mdl-btns">
        <!-- <input type="button" class="cancel-btn modal-close" value="Close"> -->
        <input data-modal="modal-enroll" type="submit" class="confirm-enroll" value="Enroll">
          
      </div><!-- /.mdl-btns -->
    </form>
  </div>
  
  <div id="modal-enroll" class="modal">
    <div class="modalContent">
      <span class="modal-close">×</span>
      <div class="mdl-inner">
        <p>The teacher {{ $teacher_name }} has already enrolled this course!!! </p>
        <button class="cancel-btn modal-close">Cancel</button>
      </div><!-- /.mdl-inner -->
    </div><!-- /.modal-content -->
  </div><!-- /#modal-enroll -->
</body>

<script src="{{ asset('js/library/jquery.min.js') }}"></script>
<script src="{{ asset('js/library/accordian.js') }}"></script>
<script src="{{ asset('js/library/confirm_modal.js') }}"></script>
</html>