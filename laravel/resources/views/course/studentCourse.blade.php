@extends('layouts.app')

@section('title', "Course")

@section('assets')
<link rel="stylesheet" href="{{ asset('css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/course.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')

@php
$key = 1;
$roleName = strtolower($role);
@endphp

@foreach($studentCourseList as $course)
@php
$status = $courseStatusList[$key];
$key++;
@endphp
<div class="card">
  <h2 class="course-ttl">{{ $course->title }}</h2>
  <h3 class="course-category">{{ $course->category }}</h3>
  <div class="status-blk @if($status == 'completed')complete-status-blk @elseif($status=='progress') progress-status-blk @elseif($status == 'lock')lock-status-blk @elseif($status == 'unlock next')unlock-status-blk @endif">
    @if($status == 'completed')
    <p><span class="status complete-status ">{{ $status }}</span>&emsp;Well Done! You completed {{ $course->title }} course.</p>
    @elseif($status == 'progress')
    <p><span class="status progress-status">{{ $status }}</span>&emsp;Let's learn more about {{ $course->title }}.</p>
    @else
    <p></i><span class="status lock-status"><i class="fa fa-lock"></i>&ensp;{{ $status }}</span>&emsp;Lock will open when you complete above course.</p>
    @endif
  </div>
  <div class="clearfix">
    <p class="no-of-ass"> {{ $S_AssignmentNoList[$course->id] }} Assignments </p>
    <a href="{{ route("course-detail", ['id' => Auth::user()->id, 'course_id'=>$course->id ]) }}" class="course-detail">See Details > </a>
  </div>
</div>
@endforeach

@endsection