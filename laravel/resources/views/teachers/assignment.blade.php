@extends('layouts.app')

@section('title', 'Assignments')

@section('assets')
<link rel="stylesheet" href="{{ asset('css/teacher-assignment.css') }}">
@endsection

@section('scripts')
<script>
  
  var student_id,assignment_id ="";
  function openForm(sid,said) {
    document.getElementById("myForm").style.display = "block";
    student_id = sid;
    assignment_id = said;
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }

  $("#submitForm").submit(function(e){
    e.preventDefault();
    const grade=$('#student_grade').val();
    $.ajax({
      type:'get',
      url:'/setGrade',
      data:{id:student_id,assignment_id:assignment_id,grade:grade},
      success:function(response){
        if(response.success){
          $('#student_grade'+assignment_id).html(grade+'%');
          closeForm();
          $('#student_grade').val('');
        }
      }
    })
  });

  //commentForm
  $("form.cmt-msg").submit(function(e){
    e.preventDefault();
    
    cmtMsg = $(this).find('input[name = "comment"]');
    cmtList = $(this).prev().find('dd.cmt-msg');

    const url = $(this).attr('action');
    const form_data = $(this).serialize();
    const commentor = "{{Auth::user()->name}}";
    const commentBody =  cmtMsg.val();

    $.ajax({
      type:'post',
      url:url,
      data:form_data,
      success:function(response){
        console.log(response);
        if(response.success){
          const messageRow = '<p class="cmt-text"><b>'+commentor+':&nbsp;</b>'+commentBody+'</p>';
          cmtList.append(messageRow);
          cmtMsg.val('');
        }
      }
    })
  });

</script>
@endsection

@section('content')
<div class="assignment-panel">
  <div class="tab-pnl course-pnl">
    @if (count($courseTitles) > 0)
    <ul class="tab-nav course-tab clearFix">
      @foreach ($courseTitles as $item)
      <li>{{ $item->title }}</li>
      @endforeach
    </ul>
    <div class="tab-body">
      @foreach ($courseTitles as $title)
      <div class="tab-cnt">
        <div class="tab-pnl">
          <ul class="assignment-tab tab-nav clearFix">
            @foreach ($title->assignments as $assignment)
            <li>
              {{$assignment->name}}
              {{$assignment->numOfUngradedAssignment > 0 ? '(' . $assignment->numOfUngradedAssignment . ')' : "" }}
            </li>
            @endforeach
          </ul>
          <div class="tab-body">
            @foreach ($title->assignments as $course)
            <div class="tab-cnt">
              @if ($course->assignmentList != null)
              <table class="tbl-assignment">
                <thead>
                  <tr>
                    <td>Name</td>
                    <td>Date</td>
                    <td>Assignments</td>
                    <td>Grade</td>
                    <td>&nbsp;</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($course->assignmentList as $item)
                  <tr class="tr-record">
                    <td>{{$item->name}}</td>
                    <td>{{$item->uploaded_date}}</td>
                    <td class="file-path">
                      <a href="{{ route('teacher.assignment.download', ['id'=>Auth::user()->id, 'assignment_id'=>$item->id]) }}">
                        {{basename($item->file_path)}}
                      </a>
                    </td>
                    <td id="student_grade{{$item->id}}">{{($item->grade != null)?$item->grade."%":""}}</td>
                    <td>
                      <button class="open-button" onclick="openForm({{Auth::user()->id}},{{$item->id}})">Submit Grade</button>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4">
                      <dl class="accd">
                        <div class="accd-li comment">
                          <dt class="accd-dt">
                            <p class="cmt-toggle">Show Comments<i>&#xf078;</i></p>
                          </dt>
                          <!-- /.accd-dt -->
                          <dd class="accd-dd cmt-msg" id="commentList">

                            @foreach ($item->comments as $comment)
                            <p class="cmt-text">
                              <b>{{$comment->name}}:&nbsp;</b>
                              {{$comment->message}}
                            </p>
                            @endforeach
                          </dd>
                          <!-- /.accd-dd -->
                        </div>
                        <!-- /.accd-dt -->
                      </dl>
                      <!-- /.accd -->
                      <form class="cmt-msg" action="{{ route('teacher.assignment.comment', ['id'=> Auth::user()->id, 'assignment_id' => $item->id]) }}" method="post">
                        @csrf
                        <label for="comment" hidden>Comment</label>
                        <input type="text" name="comment" placeholder="Add a comment ...">
                        <input type="submit" value="&#xf1d8;">
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @else
              <div class="msg-box-empty">
                <p>No Assignment Submitted Yet. Check back later.</p>
              </div>
              @endif
            </div>
            <!-- /.tab-cnt -->
            @endforeach
          </div>
          <!-- /.tab-body -->
        </div>
        <!-- /.tab-pnl -->
      </div>
      <!-- /.tab-cnt -->
      @endforeach

    </div>
    <!-- /.tab-body -->
    @else
      <div class="msg-box-empty"><p>No Results Found.</p></div>
    @endif
  </div>
  <!-- /.tab-pnl -->
</div>
<div class="form-popup" id="myForm">
  <form class="form-container" method="POST" id="submitForm">
    {{ csrf_field() }}
    <label for="grade"><b>Grade : </b></label>
    <input type="text" placeholder="1-100" id="student_grade" name="grade" required>
    <button type="submit" class="popup-btn">Confirm</button>
    <button type="button" class="popup-btn cancel" onclick="closeForm()">Cancel</button>
  </form>
</div>
@endsection