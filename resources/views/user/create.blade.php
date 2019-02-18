@extends('layouts.admin-layout')

@section('title', 'Create User')

@section('page_heading', 'Add new User')



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
            <a class="navbar-brand" href="{{ URL::to('users') }}">User Resource</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('users') }}">View All User</a></li>
            <li><a href="{{ route('users.create')}}">Add a User</a> </li>     
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
          <strong>Add new User</strong>
        </div>
    
<div class="card-block">



{{ Form::open(array('route' => array('users.store'))) }}

  <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name','', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('username', 'Username') }}
        {{ Form::text('username','', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
         {{ Form::label('type', 'Type of User') }}
        {{Form::select('type', [''=>'Select One','S' => 'Student', 'F' => 'Faculty', 'A' => 'Admin'],0,  array('class' => 'form-control'))}}    
    </div>
   

    
    
    <div>{{ Form::submit('Create!', array('class' => 'btn btn-primary btn-sm')) }}</div>


{{ Form::close() }}


</div>
</div>

@endsection