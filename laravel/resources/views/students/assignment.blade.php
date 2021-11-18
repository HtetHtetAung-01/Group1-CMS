
@extends('layouts.app')

@section('content')

  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/student-assignment.css') }}">
  <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
  <script src="{{ asset('js/common.js') }}"></script>
  <title>Assignments</title>
  <div class="assignment-panel">
    <div class="tab-pnl">
      <ul class="tab-nav course-tab clearFix">
        @foreach ($courses as $item)
          <li>{{$item->title}}</li>
        @endforeach
      </ul>
      <div class="tab-body">
        @foreach ($courses as $course)
          @if (count($course->assignments) > 0)
          <div class="tab-cnt">
            <table class="tbl-assignment">
              <thead>
                <tr>
                  <td>Date</td>
                  <td>Assignments</td>
                  <td>Grade</td>
                </tr>
              </thead>
              <tbody>
                    @foreach ($course->assignments as $assignment)
                      <div class="tab-cnt">
                        <tr class="tr-record">
                          <td>{{$assignment->uploaded_date}}</td>
                          <td>{{basename($assignment->file_path)}}</td>
                          <td>{{$assignment->grade}}</td>
                        </tr>
                        <tr>
                          <td colspan="3">
                            <dl class="accd">
                              <div class="accd-li">
                                <dt class="accd-dt accd-dt-margin">
                                  <p class="cmt-toggle">Show Comments<i>&#xf078;</i></p>
                                </dt>
                                <!-- /.accd-dt -->
                                <dd class="accd-dd cmt-msg">
                                  @foreach ($assignment->comments as $item)
                                  <p class="cmt-text">
                                    <b>{{$item->name}}:&nbsp;</b>
                                    {{$item->message;}}
                                  </p>
                                  @endforeach
                                </dd>
                                <!-- /.accd-dd -->
                              </div>
                              <!-- /.accd-dt -->
                            </dl>
                            <!-- /.accd -->
                          </td>
                        </tr>
                      </div>
                    @endforeach
                  </tbody>
                </table>
              </div>
          @endif
        @endforeach
      </div>
  </div>

@endsection