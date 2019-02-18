<!-- app/views/nerds/edit.blade.php -->

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

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1>Edit {{ $data->code }}</h1>

<!-- if there are creation errors, they will show here -->


{{ Form::model($data, array('route' => array('courses.update', $data->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('code', 'Course Code') }}
        {{ Form::text('code', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('credits', 'Credit Hour') }}
         {{ Form::text('credits', null, array('class' => 'form-control')) }}
      </div>


    <div class="form-group">
        {{ Form::label('dept', 'Department') }}
        {{ Form::select('dept_id', $dept, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit Entry!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>