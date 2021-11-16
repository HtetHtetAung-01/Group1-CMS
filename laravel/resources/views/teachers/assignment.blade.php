<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/teacher-assignment.css') }}">
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <title>Assignments</title>
</head>
<body>
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($course->assignmentList as $item)
                                                        <tr class="tr-record">
                                                            <td>{{$item->name}}</td>
                                                            <td>{{$item->uploaded_date}}</td>
                                                            <td class="file-path">
                                                                <a href="/teacher/3/assignment/{{$item->id}}/download/">
                                                                    {{basename($item->file_path)}}
                                                                </a>
                                                            </td>
                                                            <td>{{($item->grade != null)?$item->grade."%":""}}</td>
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
                                                                        
                                                                        <form action="/teacher/4/assignment/{{$item->id}}/comment" method="post">
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
</body>
</html>