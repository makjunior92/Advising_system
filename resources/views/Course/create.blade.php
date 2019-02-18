@extends('layouts.admin-layout')

@section('title', 'Add Course')

@section('page_heading', 'Add new Course')



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
            <a class="navbar-brand" href="{{ URL::to('courses') }}">Courses Resource</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('courses') }}">View All Courses</a></li>
            <li><a href="{{ route('courses.create')}}">Add a Course</a> </li>     
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
          <strong>Add new Course</strong>
        </div>
    

         <div class="card-block">



{{ Form::open(array('route' => array('courses.store'))) }}

  <div class="form-group">
        {{ Form::label('name', 'Course Name') }}
        {{ Form::text('name','', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('code', 'Code') }}
        {{ Form::text('code','', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('credits', 'Credit Hours') }}
         {{Form::text('credits','', array('class' => 'form-control'))}} 
    </div>



    <div class="form-group">
        {{ Form::label('dept', 'Department') }}
        {{ Form::select('dept_id', $data,0, array('class' => 'form-control')) }}
    </div>

    

    
    
    <div>{{ Form::submit('Create!', array('class' => 'btn btn-primary')) }}</div>


{{ Form::close() }}


</div>
</div>

@endsection