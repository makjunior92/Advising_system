<!-- app/views/nerds/show.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Look! I'm CRUDding</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('courses') }}">Course Page</a>
    </div>

    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('courses') }}">View All courses</a></li>
        <li><a href="{{ route('courses.create')}}">Create a Course</a>
        <li><a href="{{ URL::to('offeredcourses')}}">Course Offer Page</a>
        <li><a href="{{ URL::to('/') }}"><b>Admin Panel</b></a></li>
    </ul>
</nav>


<h1>Showing {{ $data->code }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $data->code }}</h2>
        <p>
            <strong>Course Name:</strong> {{ $data->name }}<br>
            <strong>Credits:</strong> {{ $data->credits }}<br>            
            <strong>Department:</strong> {{ $data->department->dept_code }}<br>

        </p>
    </div>

</div>
</body>
</html>