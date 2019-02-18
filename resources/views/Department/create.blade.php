
@extends('layouts.admin-layout')

@section('title', 'Add Department')

@section('page_heading', 'Add a Department')



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
            <a class="navbar-brand" href="{{ URL::to('departments') }}">Departments Resource</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('departments') }}">View All Departments</a></li>
            <li><a href="{{ route('departments.create')}}">Add a Department</a>  </li>     
        </ul>
    </nav>


<!-- will be used to show any messages -->


    <div class="card">
        <div class="card-header primary-color-dark white-text">
          <strong>Departments</strong>
        </div>
    

         <div class="card-block">

            {{ Form::open(array('route' => array('departments.store'))) }}

              <div class="form-group">
                    {{ Form::label('name', 'Department Name') }}
                    {{ Form::text('name','', array('class' => 'form-control')) }}
                </div>

               <div class="form-group">
                    {{ Form::label('code', 'Department Code') }}
                    {{ Form::text('code','', array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('hod', 'HOD Name') }}
                   {{ Form::select('hod_id', $faculty,0, array('class' => 'form-control')) }}
                </div>


                
                {{ Form::submit('Create!', array('class' => 'btn btn-primary')) }}


            {{ Form::close() }}

</div>
</div>



@endsection