@extends('layouts.app')

@section('content')
    
<link rel="stylesheet" href="{{ asset('css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/teacher-assignment.css') }}">
<script src="{{ asset('js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
<title>Assignments</title>

    <div class="assignment-panel">
        <div class="tab-pnl course-pnl">
            <ul class="tab-nav course-tab clearFix">
                @foreach ($courseTitles as $item)
                <li>{{$item->title}}</li>
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
                                                <a href="{{ route('teacher.assignment.download', ['id'=>3, 'assignment_id'=>$item->id]) }}">
                                                    {{basename($item->file_path)}}
                                                </a>
                                            </td>
                                            <td>{{($item->grade != null)?$item->grade."%":""}}</td>
                                            <td>
                                                <button class="open-button" onclick="openForm('{{route('teacher.assignment.grade.submit', ['id'=>4, 'assignment_id' => $item->id])}}')">Submit Grade</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <dl class="accd">
                                                    <div class="accd-li">
                                                        <dt class="accd-dt">
                                                            <p class="cmt-toggle">Show Comments<i>&#xf078;</i></p>
                                                        </dt>
                                                        <!-- /.accd-dt -->
                                                        <dd class="accd-dd cmt-msg">

                                                            @foreach ($item->comments as $comment)
                                                            <p class="cmt-text">
                                                                <b>{{$comment->name}}:&nbsp;</b>
                                                                {{$comment->message;}}
                                                            </p>
                                                            @endforeach
                                                            
                                                            <form action="{{ route('teacher.assignment.comment', ['id'=>4, 'assignment_id' => $item->id]) }}" method="post">
                                                                @csrf
                                                                <label for="comment" hidden>Comment</label>
                                                                <input type="text" name="comment">
                                                                <input type="submit" value="&#xf1d8;">
                                                            </form>

                                                        </dd>
                                                        <!-- /.accd-dd -->
                                                    </div>
                                                    <!-- /.accd-dt -->
                                                </dl>
                                                <!-- /.accd -->
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
        </div>
        <!-- /.tab-pnl -->
    </div>
    <div class="form-popup" id="myForm">
        <form class="form-container" method="POST" id="submitForm">
            {{ csrf_field() }}
            <label for="grade"><b>Grade : </b></label>
            <input type="text" placeholder="1-100" name="grade" required>
            <button type="submit" class="popup-btn">Confirm</button>
            <button type="button" class="popup-btn cancel" onclick="closeForm()">Cancel</button>
        </form>
    </div>
    
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

