@extends('layouts.app')

@section('title', "Course Details")

@section('assets')
<link rel="stylesheet" href="{{ asset('css/courseDetails.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('js/library/jquery.min.js') }}"></script>
<script src="{{ asset('js/library/accordian.js') }}"></script>
<script src="{{ asset('js/library/confirm_modal.js') }}"></script>

<!-- To open the modal form after clicking the start button of assignment -->
<script>
  function openForm($route) {
    document.getElementById("myForm").style.display = "block";
    document.getElementById("submitForm").action = $route;
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }
</script>
@endsection

@section('content')

@php
$first = true;
$requiredCourses = "";
foreach($requiredCourse as $course) {
if($first == true) {
$requiredCourses .="'" .$course->title."' ";
$first = false;
}
else {
$requiredCourses .= ", '".$course->title."' ";
}
}
@endphp

<div class="course-details">
  <div class="course-content">
    <div class="title-btn">
      <h2 class="course-title">
        {{ $courseDetails[0]->course_title }}
      </h2>
      <button data-modal="modal-enroll" class="btn-show-modal default-enroll-btn {{ $isEnrolled? 'start-btn' : 'disabled-btn'}}">{{ $isEnrolled? 'Get Started' : 'Enrolled'}}</button>
      @if($isCompleteRequiredCourse == true)
      <div id="modal-enroll" class="modal">
        <div class="modalContent">
          <span class="modal-close">×</span>
          <div class="mdl-inner">
            <p>Are you sure you want to enroll to this {{ $courseDetails[0]->course_title }} course?</p>
            <div class="mdl-btns">
              <button class="cancel-btn modal-close">Cancel</button>
              <a href="{{route('student.course.enroll', ['id' => Auth::user()->id, 'course_id'=> $courseDetails[0]->course_id])}}" class="confirm-btn">
                Confirm
              </a>
            </div><!-- /.mdl-btns -->
          </div><!-- /.mdl-inner -->
        </div><!-- /.modal-content -->
      </div><!-- /#modal-enroll -->
      @else
      <div id="modal-enroll" class="modal">
        <div class="modalContent">
          <span class="modal-close">×</span>
          <div class="mdl-inner">
            <p>You can't enroll this course. You need to complete {{ $requiredCourses }} first!</p>
            <div class="mdl-btns">
              <button class="cancel-btn modal-close">Close</button>
            </div>
          </div><!-- /.mdl-inner -->
        </div><!-- /.modal-content -->
      </div><!-- /#modal-enroll -->
      @endif
    </div><!-- /.title-btn -->
    <div class="course-description">
      {{ $courseDetails[0]->course_description }}
    </div><!-- /.course-description -->
  </div><!-- /.course-content -->
  <div class="assignment-list">
    <dl class="accd-lists">
      @foreach ($courseDetails as $key => $value)
      <div class="accd-li course">
        <dt class="accd-dt d-flex">
          <div class="d-flex">
            @if($isEnrolled==false)
              @if($assignmentStatus != NULL && $key < (count($assignmentStatus)) && $assignmentStatus[$key]=='completed' ) <img src="/img/completed_icon.png" alt="progress-icon">
              @else
                @if ($started[$key]==false)
                <img src="/img/started_icon.png" alt="started-icon">
                @else
                <img src="/img/progress_icon.png" alt="progress-icon">
                @endif
              @endif
            @elseif ($isEnrolled==true) <img src="/img/lock_icon.png" alt="lock-icon">
            @endif
              <span class="assign-name">
                {{ $courseDetails[$key]->name }}
              </span>
          </div>
          <i class="d-left accd-arrow">&#xf078;</i>
        </dt><!-- /.accd-dt -->
        <dd class="accd-dd">
          <div class="accd-content">
            @if($started[$key]==false)
            <button class="btn-show-modal start-assign-btn {{ $isEnrolled ? 'disabled-btn' : 'start-assignment'}}" onclick="openForm('{{route('student.course.addAssignment', ['id' => Auth::user()->id, 'course_id' => $courseDetails[0]->course_id, 'assignment_id' => $courseDetails[$key]->id])}}')">Start</button>
            @endif
            <p class="assignment-duration">Duration :
              <strong>{{ $courseDetails[$key]->duration }}</strong> Days
            </p>
            <p class="assignment-description">
              {{ $courseDetails[$key]->description }}
            </p>
            <div class="resources-blk">
              @if($started[$key]==false)
              <h3 class="resources-lbl disabled-lbl">Resources</h3>
              @else
              <h3 class="resources-lbl {{ $isEnrolled? 'disabled-lbl' : ''}}">Resources</h3>
              @endif
              <div class="resources d-flex">
                @if($started[$key]==false)
                <p class="file-name disabled-lbl">
                  {{ $courseDetails[$key]->file_path }}
                </p>
                @else
                <p class="file-name {{ $isEnrolled? 'disabled-lbl' : ''}}">
                  {{ $courseDetails[$key]->file_path }}
                </p>
                @endif
                @if($started[$key]==false)
                <a href="{{route('student.course.assignment.download', ['id' => Auth::user()->id, 'course_id' => $courseDetails[0]->course_id, 'assignment_id' => $courseDetails[$key]->id])}}" class="default-download-btn disabled-btn">
                  Download File
                </a>
                @else
                <a href="{{route('student.course.assignment.download', ['id' => Auth::user()->id, 'course_id' => $courseDetails[0]->course_id, 'assignment_id' => $courseDetails[$key]->id])}}" class="default-download-btn {{ $isEnrolled? 'disabled-btn' : 'download-btn'}}">
                  Download File
                </a>
                @endif
              </div><!-- /.resources -->
            </div><!-- /.resources-blk -->
            <div class="homework-blk">
              @if($started[$key]==false)
              <h3 class="homework-lbl disabled-lbl">Homework</h3>
              @else
              <h3 class="homework-lbl {{ $isEnrolled? 'disabled-lbl' : ''}}">Homework</h3>
              @endif
              <form action="{{route('student.course.assignment.update', ['id' => Auth::user()->id,'course_id' => $courseDetails[0]->course_id, 'assignment_id' => $courseDetails[$key]->id])}}" enctype="multipart/form-data" method="POST">
                <div class="homework d-flex">
                  @if($started[$key]==false)
                  <div class="disabled-input">
                    @else
                    <div class="{{ $isEnrolled? 'disabled-input' : 'upload-hw'}}">
                      @endif
                      {{ csrf_field() }}
                      @if($started[$key]==false)
                      <input type="file" name="inputFile" id="input-file-name" class="default-file-input disabled-file-input" disabled />
                      @else
                      <input type="file" name="inputFile" id="input-file-name" class="default-file-input {{ $isEnrolled? 'disabled-file-input' : 'file-input'}}" {{ $isEnrolled? 'disabled' : ''}} />
                      @endif
                    </div>
                    <div class="d-flex">
                      @if($started[$key]==false)
                      <a href="javascript:void(0)" onclick="document.getElementById('input-file-name').value='';" class="default-clear-btn disabled-clear-btn">
                        Clear
                      </a>
                      @else
                      <a href="javascript:void(0)" onclick="document.getElementById('input-file-name').value='';" class="default-clear-btn {{ $isEnrolled? 'disabled-clear-btn' : 'clear-btn'}}">
                        Clear
                      </a>
                      @endif
                      @if($started[$key]==false)
                      <button type="submit" class="default-submit-btn disabled-btn">
                        Submit
                      </button>
                      @else
                      <button type="submit" class="default-submit-btn {{ $isEnrolled? 'disabled-btn' : 'submit-btn'}}">
                        Submit
                      </button>
                      @endif
                    </div>
                  </div>
              </form>
            </div><!-- /.homework-blk -->
          </div><!-- /.accd-content -->
        </dd><!-- /.accd-dd -->
      </div><!-- /.accd-li -->
      @endforeach
    </dl><!-- /.accd-lists -->
  </div><!-- /.assignment-list -->
</div><!-- /.course-details -->
<div class="form-popup" id="myForm">
  <form class="form-container" method="POST" id="submitForm">
    {{ csrf_field() }}
    <p class="mdl-title">Are you sure you want to start to do this?</p>
    <button type="button" class="popup-btn cancel" onclick="closeForm()">Cancel</button>
    <button type="submit" class="popup-btn">Confirm</button>
  </form>
</div><!-- /.form-popup -->
@endsection