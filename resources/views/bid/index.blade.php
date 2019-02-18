
@extends('layouts.admin-layout')

@section('title', 'Bid Home')

@section('page_heading', 'Bids Dashboard')

@section('content')
<style type="text/css">
.card{
    padding: 10px;
}

.card-header{
      padding: 20px;    
}
</style>   


<!--Panel-->

<!--/.Panel-->


   @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    

    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('offeredcourses') }}">Bids Resource</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('offeredcourses') }}">View All Bids</a></li>              
        </ul>
    </nav>


<!-- will be used to show any messages -->


    <div class="card">
        <div class="card-header primary-color-dark white-text">
          <strong>Bids</strong>
        </div>
    

         <div class="card-block">

            <table id="datatable" class="table table-striped table-bordered">
           
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Course</td>
                        <td>Section</td>
                        <td>Student</td>                        
                        <td>Bid</td>  
                        <td>Action</td>                 
                      
                    </tr>
                </thead>
                
                <tbody>

               <?php $count=0; ?>
               
                @foreach($data as $value)
               <?php $count++; ?>
                    <tr>
                    <td>{{$count}}</td>
                      <td>{{ $value->offeredcourse->course->code }}</td>
                        <td>{{ $value->offeredcourse->section }}</td>
                        <td>{{ $value->student->name }}</td>                        
                        <td>{{ $value->bid }}</td>
                        
                        
                        

                        <!-- we will also add show, edit, and delete buttons -->
                        <td style="width: 260px;">

                                {{ Form::open(array('url' => 'bids/' . $value->id, 'class' => 'pull-right','method' => 'DELETE')) }}
                               {{ Form::hidden('_method', 'DELETE') }}
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            {{ Form::close() }}

                             <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                            <a class="btn btn-sm btn-info"  href="{{ URL::to('bids/' . $value->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>

                            <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                            <a class="btn btn-sm btn-warning" href="{{ route('bids.edit', $value->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
         
     </div>
    </div>






@endsection

