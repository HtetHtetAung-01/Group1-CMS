<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course_Details</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/courseDetails.css') }}">

</head>

<body>

  <div class="course-details">
    <div class="course-content">
      <div class="title-btn">
        <h2 class="course-title">
          {{ $courseDetails[0]->course_title }}
        </h2>
        <button data-modal="modal-enroll" class="btn-show-modal default-enroll-btn {{ $isEnrolled? 'start-btn' : 'disabled-btn'}}">{{ $isEnrolled? 'Get Started' : 'Enrolled'}}</button>
        <div id="modal-enroll" class="modal">
          <div class="modalContent">
            <span class="modal-close">×</span>
            <div class="mdl-inner">
              <p>Are you sure you want to enroll to this {{ $courseDetails[0]->course_title }} course?</p>
              <div class="mdl-btns">
                <button class="cancel-btn modal-close">Cancel</button>
                <a href="/course/{course_id}/student/{student_id}/enroll" class="confirm-btn">
                  Confirm
                </a>
              </div><!-- /.mdl-btns -->
            </div><!-- /.mdl-inner -->
          </div><!-- /.modal-content -->
        </div><!-- /#modal-enroll -->
      </div><!-- /.title-btn -->
      <div class="course-description">
        {{ $courseDetails[0]->course_description }}
      </div><!-- /.course-description -->
    </div><!-- /.course-content -->
    <div class="assignment-list">
      <dl class="accd-lists">
        @foreach ($courseDetails as $key => $value)
        <div class="accd-li">
          <dt class="accd-dt d-flex">
            <div class="d-flex">
              @if($isEnrolled==false)
              @if($assignmentStatus != NULL && $key < (count($assignmentStatus)) && $assignmentStatus[$key]=='completed' ) <img src="/img/completed.png" alt="progress-icon">
                @else
                <img src="/img/progress.png" alt="progress-icon">
                @endif
                @elseif ($isEnrolled==true) <img src="/img/lock_icon.png" alt="progress-icon">
                @endif
                <span class="assign-name">
                  {{ $courseDetails[$key]->name }}
                </span>
            </div>
            <i class="fas fa-chevron-down d-left"></i>
          </dt><!-- /.accd-dt -->
          <dd class="accd-dd">
            <div class="accd-content">
              <button data-modal="modal-start" class="btn-show-modal start-assign-btn {{ $isEnrolled? 'disabled-btn' : 'start-assignment'}}">Start</button>
              <div id="modal-start" class="modal">
                <div class="modalContent">
                  <span class="modal-close">×</span>
                  <div class="mdl-inner">
                    <p>Are you sure you want to start this {{ $courseDetails[$key]->name }}?</p>
                    <div class="mdl-btns">
                      <button class="cancel-btn modal-close">Cancel</button>
                      <a href="/course/{course_id}/student/{student_id}/add/assignment/{{ $courseDetails[$key]->id }}" class="confirm-btn">
                        Confirm
                      </a>
                    </div>
                  </div>
                </div>
              </div><!-- /#modal-start -->
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
                  <a href="/course/{course_id}/student/{student_id}/download/{{ $courseDetails[$key]->file_path }}" class="default-download-btn disabled-btn">
                    Download File
                  </a>
                  @else
                  <a href="/course/{course_id}/student/{student_id}/download/{{ $courseDetails[$key]->file_path }}" class="default-download-btn {{ $isEnrolled? 'disabled-btn' : 'download-btn'}}">
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
                <form action="/course/{course_id}/student/{student_id}/update/assignment/{{ $courseDetails[$key]->id }}" enctype="multipart/form-data" method="POST">
                  <div class="homework d-flex">
                    @if($started[$key]==false)
                    <div class="disabled-input">
                      @else
                      <div class="{{ $isEnrolled? 'disabled-input' : 'upload-hw'}}">
                        @endif
                        {{ csrf_field() }}
                        @if($started[$key]==false)
                        <input type="file" name="inputfile" id="input-file-name" class="default-file-input disabled-file-input" disabled />
                        @else
                        <input type="file" name="inputfile" id="input-file-name" class="default-file-input {{ $isEnrolled? 'disabled-file-input' : 'file-input'}}" {{ $isEnrolled? 'disabled' : ''}} />
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

</body>

</html>

</body>

<script src="{{ asset('js/library/jquery.min.js') }}"></script>
<script src="{{ asset('js/library/common.js') }}"></script>
<script src="{{ asset('js/library/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/library/confirm_modal.js') }}"></script>

</html>