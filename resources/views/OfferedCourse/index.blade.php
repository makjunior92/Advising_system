
@extends('layouts.admin-layout')

@section('title', 'Offers Home')

@section('page_heading', 'Offers Dashboard')

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
            <a class="navbar-brand" href="{{ URL::to('offeredcourses') }}">Offers Resource</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('offeredcourses') }}">View All Offers</a></li>
            <li><a href="{{ route('offeredcourses.create')}}">Offer a Course</a> </li>      
        </ul>
    </nav>


<!-- will be used to show any messages -->


    <div class="card">
        <div class="card-header primary-color-dark white-text">
          <strong>Offered Courses</strong>
        </div>
    

         <div class="card-block">

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Course Code</td>
                        <td>Department</td>
                        <td>Faculty</td>
                        <td>Section</td>
                        <td>Capacity</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                
                <tbody>
                <?php $count=0; ?>
               @foreach($data as $value)
               <?php $count++; ?>
                    <tr>
                       <td>{{$count}}</td>
                        <td>{{ $value->course->code }}</td>
                        <td>{{ $value->department->dept_code }}</td>
                        <td>{{ $value->faculty->initial }}</td>
                        <td>{{ $value->section }}</td>
                        <td>{{ $value->capacity }}</td>
                        
                        

                        <!-- we will also add show, edit, and delete buttons -->
                        <td>

                            <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                            <!-- we will add this later since its a little more complicated than the other two buttons -->
                            {{ Form::open(array('url' => 'offeredcourses/' . $value->id, 'class' => 'pull-right','method' => 'DELETE')) }}
                               {{ Form::hidden('_method', 'DELETE') }}
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            {{ Form::close() }}

                             <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                            <a class="btn btn-sm btn-info"  href="{{ URL::to('offeredcourses/' . $value->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>

                            <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                            <a class="btn btn-sm btn-warning" href="{{ route('offeredcourses.edit', $value->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
       </div>
    </div>




@endsection

