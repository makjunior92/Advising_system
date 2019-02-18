@extends('layouts.admin-layout')

@section('title', 'Add Student')

@section('page_heading', 'Add new Student')



<style type="text/css">
    .card{
        padding: 10px;
    }

    .card-header{
          padding: 20px; 
          margin-bottom: 20px;   
    }

    .form-control{
        padding-bottom: 0px !important;  
        padding-top: 0px;

    }

</style>   


@section('content')

 @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    

    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('students') }}">Students Resource</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('students') }}">View All Students</a></li>
            <li><a href="{{ route('students.create')}}">Add a Student</a> </li>     
        </ul>
    </nav>



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


   <div class="card">
        <div class="card-header primary-color-dark white-text">
          <strong>Add Student</strong>
        </div>
    

         <div class="card-block">


{{ Form::open(array('route' => array('students.store'))) }}

  

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name','', array('class' => 'form-control')) }}
    </div>


<div class="form-group">
        {{ Form::label('course', 'Department') }}
       {{ Form::select('department_id', $data,0, array('class' => 'form-control')) }}
    </div>
    
<div class="form-group">
        {{ Form::label('name', 'Grade') }}
        {{ Form::text('grade','', array('class' => 'form-control')) }}
    </div>
    

    
    
    <div>{{ Form::submit('Create!', array('class' => 'btn btn-primary')) }}</div>


{{ Form::close() }}


</div>
</div>


@endsection