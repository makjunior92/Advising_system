<!-- app/views/enrollcourses/create.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Look! I'm CRUDding</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('enrollcourses') }}">enrollcourses</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('enrollcourses') }}">View All enrollcourses</a></li>
        <li><a href="{{ URL::to('enrollcourses/create') }}">Create a department</a>
    </ul>
</nav>

<h1>Create a Nerd</h1>

<!-- if there are creation errors, they will show here -->
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



{{ Form::open(array('route' => array('enrollcourses.store'))) }}

  <div class="form-group">
        {{ Form::label('name', 'Student ID') }}
        {{ Form::text('student_id','', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('name', 'Select Course') }}


        
        <select name="offcourse_id">
         @foreach($data as $d)
            <option value="{{$d->id}}">{{$d->course->name}}</option>
            @endforeach
        </select>       
        
        
   </div>


    
    {{ Form::submit('Create!', array('class' => 'btn btn-primary')) }}


{{ Form::close() }}


</div>
</body>
</html>