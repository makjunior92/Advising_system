
@extends('layouts.admin-layout')

@section('title', 'Faculty Info')

@section('page_heading', 'Faculty Details')
@section('content')
   


@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<!-- Instead of defining the navbar again, I used components -->

@component('components.global-navbar')
   
    @slot('resource_url')
       {{URL::to('faculties')}}
    @endslot
    @slot('resource_name')
      Faculty Resource
    @endslot

    @slot('create_url')
       {{URL::to('faculties.create')}}
    @endslot


@endcomponent

    
<br>
    


    <div class="card card-danger text-center z-depth-2 col-md-8 col-md-offset-2">
        <div class="card-block">
            <h2>{{ $data->name }}</h2>
            <p>
            <strong>Initial:</strong> {{ $data->initial }}<br>
            <strong>Designation:</strong> {{ $data->designation }}<br>            
            <strong>Faculty Type:</strong> {{ $data->fac_type }}<br>                        
                        
            <strong>Degree:</strong> {{ $data->degree }}<br>
            <strong>Salary:</strong> {{ $data->salary }}<br>                        
            
            <strong>Department:</strong> {{ $data->department->dept_code }}<br>


        </p>
        </div>
    </div>




      






@endsection