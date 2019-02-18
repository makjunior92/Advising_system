
@extends('layouts.admin-layout')

@section('title', 'Allocations Home')

@section('page_heading', 'Allocations Dashboard')

@section('content')
<style type="text/css">
.card{
    padding: 10px;
}

.card-header{
      padding: 20px;    
}
</style>   


 @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    

    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('courses') }}">Allocations Resource</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('courses') }}">View All Allocations</a></li>          
        </ul>
    </nav>





<!-- will be used to show any messages -->


    <div class="card">
        <div class="card-header primary-color-dark white-text">
          <strong>All Enrollments</strong>
        </div>
    

         <div class="card-block">

            <table id="datatable" class="table table-striped table-bordered">
                   
                <thead>
                    <tr>
                        <td>#No</td>
                        <td>Student</td>
                        <td>Course Name</td>
                        <td>Course Code</td>
                        <td>Section</td>
                        <td>Successful Bid</td>
                        <td>Delete</td>             
                        
                    </tr>
                </thead>
                
                <tbody>
                <?php $count=0; ?>
               
                @foreach($data as $value)
               <?php $count++; ?>
                    <tr>
                       <td>{{$count}}</td>
                        <td>{{ $value->student->name }}</td>
                        <td>{{ $value->offeredcourse->course->name }}</td>
                        <td>{{ $value->offeredcourse->course->code }}</td>
                        <td>{{ $value->offeredcourse->section }}</td>
                        <td>{{ $value->bid->bid }}</td>                    
                 
                        <td>

                       {{ Form::open(array('url' => 'enrollcourses/' . $value->id, 'class' => 'pull-right','method' => 'DELETE')) }}
                               {{ Form::hidden('_method', 'DELETE') }}
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            {{ Form::close() }}
                            

                        </td>
                        



                    </tr>
                @endforeach
                </tbody>
            </table>
           
       </div>
    </div>





@endsection

