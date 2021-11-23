<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <title>Create Course</title>
</head>

<body>
    <div class="new-course">
        <h2>Add new course</h2>
        <form action="{{ route('add.new.course') }}" method="POST">
            {{ csrf_field() }}
            <div class="text">
                <label for="title">Title</label><br><input type="text" name="title" required>
            </div>
            <div class="text">
                <label for="category">Category</label><br><input type="text" name="category" required>
            </div>
            <div class="text">
                <label for="description">Description</label><br><textarea name="description" rows="3" cols="50" required></textarea>
            </div>
            <div class="text">
                <label for="requiredCourses">Required Courses</label><br><input type="text" placeholder="eg.,[1,2]" name="requiredCourses" required><br>
            </div>
            <button type="submit" class="register-btn">Create Course</button>
        </form>
    </div>
</body>

</html>