@extends('layouts.app')

@section('title', 'Student Assignments')

@section('content')
    <div class="assignment-panel">
        <div class="tab-pnl">
            @if (count($courses) > 0)
                <ul class="tab-nav course-tab clearFix">
                    @foreach ($courses as $item)
                        <li>{{ $item->title }}</li>
                    @endforeach
                </ul>
                <div class="tab-body">
                    @foreach ($courses as $course)
                        <div class="tab-cnt">
                            @if (count($course->assignments) > 0)
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
                                                    <td>{{ $assignment->uploaded_date }}</td>
                                                    <td>{{ basename($assignment->file_path) }}</td>
                                                    <td>{{ $assignment->grade }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <dl class="accd">
                                                            <div class="accd-li comment">
                                                                <dt class="accd-dt accd-dt-margin">
                                                                    <p class="cmt-toggle">Show Comments<i>&#xf078;</i>
                                                                    </p>
                                                                </dt>
                                                                <!-- /.accd-dt -->
                                                                <dd class="accd-dd cmt-msg">
                                                                    @foreach ($assignment->comments as $item)
                                                                        <p class="cmt-text">
                                                                            <b>{{ $item->name }}:&nbsp;</b>
                                                                            {{ $item->message }}
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
                            @else
                                <div class="msg-box-empty">
                                    <p>No Assignment Submitted Yet.</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="msg-box-empty">
                    <p>No Results Found.</p>
                </div>
            @endif
        </div>
    @endsection
