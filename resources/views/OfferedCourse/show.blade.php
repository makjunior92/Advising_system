
@extends('layouts.admin-layout')

@section('title', 'Offer Info')

@section('page_heading', 'Offer Details')
@section('content')
   


@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<!-- Instead of defining the navbar again, I used components -->

@component('components.global-navbar')
   
    @slot('resource_url')
       {{URL::to('offeredcourses')}}
    @endslot
    @slot('resource_name')
      Offers Resource
    @endslot

    @slot('create_url')
       {{URL::to('offeredcourses.create')}}
    @endslot


@endcomponent

    

    
    <div class="card card-danger text-center z-depth-2 col-md-10">
        <div class="card-block">
             <h2>{{ $data->course->code }}.{{ $data->section }}</h2>
            <p>
                <strong>Course Name:</strong> {{ $data->course->name }}<br>
                <strong>Section:</strong> {{ $data->section }}<br>            
                <strong>Faculty:</strong> {{ $data->faculty->initial }}<br>                        
                            
                <strong>Capacity:</strong> {{ $data->capacity }}<br>
                                       
                
                <strong>Department:</strong> {{ $data->department->dept_code }}<br>


        </p>
    </div>

</div>



@endsection