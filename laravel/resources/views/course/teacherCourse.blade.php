@extends('layouts.app')  
      
@section('content') 
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/course.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  @foreach($teacherCourseList as $key => $value)
    @php 
      $course = $teacherCourseList[$key];
    @endphp
  <div class="card">
    <h2 class="course-ttl">{{ $course->title}} &ensp; <span class="course-category">({{ $course->category }})</span></h2>
    
    <div class="bottom-box clearfix">
      <p class="no-of-ass"> {{ $T_assignmentNoList[$key] }} Assignments </p>
      <a href="" class="course-detail">See details > </a>
    </div>
    
  </div>
  @endforeach

@endsection