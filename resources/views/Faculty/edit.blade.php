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
        <a class="navbar-brand" href="{{ URL::to('faculties') }}">Faculty Page</a>
    </div>

    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('faculties') }}">View All faculties</a></li>
        <li><a href="{{ route('faculties.create')}}">Create a faculty</a>
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

<h1>Edit {{ $data->name }}</h1>

<!-- if there are creation errors, they will show here -->


{{ Form::model($data, array('route' => array('faculties.update', $data->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('initial', 'Initial') }}
        {{ Form::text('initial', null, array('class' => 'form-control')) }}
    </div>
  <div class="form-group">
        {{ Form::label('dept_name', 'Department Name') }}
         {{Form::select('dept_id', $dept, $data->department->id, array('class' => 'form-control'))}} 
    </div>



    <div class="form-group">
        {{ Form::label('salary', 'Salary') }}
        {{ Form::text('salary',null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
    {{ Form::label('fac_type', 'Faculty Type') }}
    {{Form::select('fac_type', ['full' => 'Full Time', 'part' => 'Part Time', 'visiting' => 'Visiting'], $data->fac_type,  array('class' => 'form-control'))}}        
    </div>

    <div class="form-group">
    {{ Form::label('degree', 'Degree') }}
    {{Form::select('degree', ['bsc' => 'BSc', 'msc' => 'MSc', 'phd' => 'Phd'],$data->degree,  array('class' => 'form-control'))}}        
    </div>

    <div class="form-group">
    {{ Form::label('designation', 'Designation') }}
    {{Form::select('designation', ['L' => 'Lecturer', 'SL' => 'Sr. Lecturer', 'Asst. Prof.' => 'Assistant Professor', 'Assoc. Prof.' => 'Associate Professor', 'Prof.' => 'Professor'], $data->designation, array('class' => 'form-control'))}}        
    </div>


    {{ Form::submit('Edit Entry!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>