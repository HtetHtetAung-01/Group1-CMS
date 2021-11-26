@extends ('layouts.app')
 
@section('title', "Student Lists")

@section('assets')
<link rel="stylesheet" href="{{ asset('css/student-info.css') }}">
@endsection

@section('content')

@if (count($teacherCourse) > 0)
@foreach($teacherCourse as $key => $value)
<div class="table-view">
  <h2 class="title"> Students Enrolled {{$teacherCourse[$key]->title}} </h2>
  @if (count($studentList[$key]) > 0)
  <table class="student-info">
    <tr class="student-info-header">
      <th>Student ID</th>
      <th>Name</th>
      <th>Gender</th>
      <th>Date of Birth</th>
      <th>Email</th>
      <th>Phone Number</th>
      <th>Address</th>
    </tr>
    <tbody>
      @foreach($studentList[$key] as $student)
      <tr class="student-info-content">
        <td>{{ $student->id }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->gender }}</td>
        <td>{{ $student->dob }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->phone }}</td>
        <td>{{ $student->address }}</td>
      </tr>
      @endforeach
  </table>
  @else
    <div class="msg-box-empty"><p>Results not found</p></div>
  @endif
</div>
@endforeach
@else
  <div class="msg-box-empty"><p>Results not found</p></div>
@endif
@endsection