
@extends('layouts.admin-layout')

@section('title', 'Faculty Info')

@section('page_heading', 'Add new Faculty')


@section('content')
   

<style type="text/css">
    .card{
        padding: 10px;
    }

    .card-header{
          padding: 20px;    
    }

    .form-control{
        padding-bottom: 0px;
        padding-top: 0px;

    }

</style>   


<script type="text/javascript">
    $(document).ready(function() {
        $('.mdb-select').material_select();
     });
</script>



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






<!--Form with header-->
<div class="card">
    <!-- if there are creation errors, they will show here -->
 <!--   @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    -->

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="card-block">

        {{ Form::open(array('route' => array('faculties.store'))) }}

            <div class="md-form">  
                <div class="col-md-2">          
                    {{ Form::label('name', 'Name') }}
                </div>   

                <div class="col-md-10"> 
                    {{ Form::text('name','', array('class' => 'form-control')) }}
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>



            <div class="md-form">

                <div class="col-md-2">          
                    {{ Form::label('init', 'Initial') }}
                </div> 

                <div class="col-md-10"> 
                {{ Form::text('initial','', array('class' => 'form-control')) }}
                @if ($errors->has('initial'))
                    <span class="help-block">
                        <strong>{{ $errors->first('initial') }}</strong>
                    </span>
                @endif
                </div>
            </div>

            <div class="md-form">
                <div class="col-md-2">          
                     {{ Form::label('dept_name', 'Department Name') }}
                </div> 

                <div class="col-md-10"> 
                   
                     {{Form::select('dept_id', $data, 0,  array('class' => 'form-control'))}} 
                </div>

            </div>


          

            <div class="md-form">
                <div class="col-md-2">          
                     {{ Form::label('fac_type', 'Faculty Type') }}
                </div>
                <div class="col-md-10"> 
                     {{Form::select('fac_type', ['null'=>'Select One','full' => 'Full Time', 'part' => 'Part Time', 'visiting' => 'Visiting'],  0,array('class' => 'form-control'))}}        
                </div>
            </div>

            <div class="md-form">
                <div class="col-md-2">          
                    {{ Form::label('degree', 'Degree') }}
                </div>
               <div class="col-md-10">
                    {{Form::select('degree', ['null'=>'Select One','bsc' => 'BSc', 'msc' => 'MSc', 'phd' => 'Phd'],  0, array('class' => 'form-control'))}}        
                </div>
            </div>

            <div class="md-form">
              <div class="col-md-2">          
                   {{ Form::label('designation', 'Designation') }}
                </div>
                <div class="col-md-10">  
                    {{Form::select('designation', ['null'=>'Select One','L' => 'Lecturer', 'SL' => 'Sr. Lecturer', 'Asst. Prof.' => 'Assistant Professor', 'Assoc. Prof.' => 'Associate Professor', 'Prof.' => 'Professor'],0,  array('class' => 'form-control'))}}        
                </div>
             </div>


            <div class="md-form">
                <div class="col-md-2">          
                    {{ Form::label('salary', 'Salary') }}
                </div> 
                <div class="col-md-10"> 
                    {{ Form::text('salary','', array('class' => 'form-control')) }}
                     @if ($errors->has('salary'))
                        <span class="help-block">
                            <strong>{{ $errors->first('salary') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-deep-purple" type="submit">Create!</button>
            </div>

            
            
           

        {{ Form::close() }}
     

        

    </div>
</div>

{{-- 





        {{ Form::open(array('route' => array('faculties.store'))) }}

          <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name','', array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('init', 'Initial') }}
                {{ Form::text('initial','', array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('dept_name', 'Department Name') }}
                 {{Form::select('dept_id', $data,  array('class' => 'form-control'))}} 
            </div>



            <div class="form-group">
                {{ Form::label('salary', 'Salary') }}
                {{ Form::text('salary','', array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('fac_type', 'Faculty Type') }}
                {{Form::select('fac_type', ['full' => 'Full Time', 'part' => 'Part Time', 'visiting' => 'Visiting'],  array('class' => 'form-control'))}}        
            </div>

            <div class="form-group">
                {{ Form::label('degree', 'Degree') }}
                {{Form::select('degree', ['bsc' => 'BSc', 'msc' => 'MSc', 'phd' => 'Phd'],  array('class' => 'form-control'))}}        
            </div>

            <div class="form-group">
                {{ Form::label('designation', 'Designation') }}
                {{Form::select('designation', ['L' => 'Lecturer', 'SL' => 'Sr. Lecturer', 'Asst. Prof.' => 'Assistant Professor', 'Assoc. Prof.' => 'Associate Professor', 'Prof.' => 'Professor'],  array('class' => 'form-control'))}}        
             </div>

            
            
            <div>{{ Form::submit('Create!', array('class' => 'btn btn-primary')) }}</div>


        {{ Form::close() }}



        --}}



@endsection