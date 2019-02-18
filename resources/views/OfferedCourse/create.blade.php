
@extends('layouts.admin-layout')

@section('title', 'Faculty Info')

@section('page_heading', 'Offer a Course')



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
            <a class="navbar-brand" href="{{ URL::to('offeredcourses') }}">Offers Resource</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('offeredcourses') }}">View All Offers</a></li>
            <li><a href="{{ route('offeredcourses.create')}}">Offer a Course</a> </li>      
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
          <strong>Offered Courses</strong>
        </div>
    

         <div class="card-block">

{{ Form::open(array('route' => array('offeredcourses.store'))) }}

  

    <div class="form-group">
        {{ Form::label('dept', 'Department') }}
        {{ Form::select('dept_id', $data, 0, array('class' => 'form-control')) }}
    </div>

    

    <div class="form-group">
        {{ Form::label('course', 'Course Name') }}
       {{ Form::select('course_id', $course,0, array('class' => 'form-control')) }}
    </div>

<div class="form-group">
        {{ Form::label('course', 'Faculty Name') }}
       {{ Form::select('faculty_id', $faculty,0, array('class' => 'form-control')) }}
    </div>
    
<div class="form-group">
        {{ Form::label('name', 'Section') }}
        {{ Form::text('section','', array('class' => 'form-control')) }}
    </div>
    
<div class="form-group">
        {{ Form::label('name', 'Capacity') }}
        {{ Form::text('capacity','', array('class' => 'form-control')) }}
    </div>
    
    
    <div>{{ Form::submit('Create!', array('class' => 'btn btn-primary')) }}</div>


{{ Form::close() }}
</div>
</div>


@endsection