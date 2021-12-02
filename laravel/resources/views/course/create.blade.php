<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <title>Add New Course</title>
</head>

<body>
    <div class="new-course">
        <h2>Add new course</h2>
        <form action="{{ route('course-create') }}" method="POST">
            {{ csrf_field() }}
            <div class="text">
                <label for="title">Title</label><br><input type="text" name="title" required>
            </div>
            <div class="text">
                <label for="category">Category</label><br><input type="text" name="category" required>
            </div>
            <div class="text">
                <label for="description">Description</label><br><textarea name="description" rows="3" cols="50"
                    required></textarea>
            </div>
            <div class="text">
                <label for="requiredCourses">Required Courses</label><br>
                
                <select class="course-select" name="requiredCourses">
                    <option value="0">None</option>
                    @foreach ($courseList as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
            </select>
            </div>
            <button type="submit" class="register-btn">Create Course</button>
        </form>
    </div>
</body>

</html>
