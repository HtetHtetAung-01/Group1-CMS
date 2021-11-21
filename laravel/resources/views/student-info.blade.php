@extends ('layouts.app')
 
@section('content')

<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/student-info.css') }}">
@foreach($teacherCourse as $key => $value)

<div class="table-view">
  <h2 class="title"> Students Enrolled {{$teacherCourse[$key]->title}} </h2>
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
</div>
@endforeach
@endsection