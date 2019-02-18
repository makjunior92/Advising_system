@extends('layouts.admin-layout')

@section('title', 'Edit Offer')

@section('page_heading', 'Edit Offer')



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


   <div class="card col-md-8 col-md-offset-2">
        <div class="card-header primary-color-dark white-text">
          <strong>Edit Offer</strong>
        </div>
    
<div class="card-block">

<h1>Edit {{ $data->course->code }}.{{ $data->section }}</h1>

<!-- if there are creation errors, they will show here -->


{{ Form::model($data, array('route' => array('offeredcourses.update', $data->id), 'method' => 'PUT')) }}

   <div class="form-group">
        {{ Form::label('dept', 'Department') }}
        {{ Form::select('dept_id', $dept, $data->dept_id, array('class' => 'form-control')) }}
    </div>

    

    <div class="form-group">
        {{ Form::label('course', 'Course Name') }}
       {{ Form::select('course_id', $course,$data->course_id, array('class' => 'form-control')) }}
    </div>

<div class="form-group">
        {{ Form::label('course', 'Faculty Name') }}
       {{ Form::select('faculty_id', $faculty,$data->faculty_id, array('class' => 'form-control')) }}
    </div>
    
<div class="form-group">
        {{ Form::label('section', 'Section') }}
        {{ Form::text('section',$data->section, array('class' => 'form-control')) }}
    </div>
    
<div class="form-group">
        {{ Form::label('capacity', 'Capacity') }}
        {{ Form::text('capacity',$data->capacity, array('class' => 'form-control')) }}
    </div>
    


    {{ Form::submit('Edit Entry!', array('class' => 'btn btn-primary btn-sm')) }}

{{ Form::close() }}
</div>
</div>

@endsection
