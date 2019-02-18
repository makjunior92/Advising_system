
@extends('layouts.admin-layout')

@section('title', 'Course Home')

@section('page_heading', 'Course Dashboard')

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

 @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    

    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('courses') }}">Courses Resource</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('courses') }}">View All Courses</a></li>
            <li><a href="{{ route('courses.create')}}">Add a Course</a> </li>     
        </ul>
    </nav>

  <div class="card">
        <div class="card-header primary-color-dark white-text">
          <strong>Courses</strong>
        </div>
    

         <div class="card-block">

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Course Code</td>
                        <td>Course Name</td>
                        <td>Deapartment</td>
                        <td>Credit</td>
                        <td>Action</td>                        
                    </tr>
                </thead>
                
                <tbody>
  <?php $count=0; ?>
               @foreach($data as $value)
               <?php $count++; ?>
                    <tr>
                       <td>{{$count}}</td>
                        <td>{{ $value->code }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->department->dept_code }}</td>
                        <td>{{ $value->credits }}</td>             
                        
                        
                     <td>

                       {{ Form::open(array('url' => 'courses/' . $value->id, 'class' => 'pull-right','method' => 'DELETE')) }}
                               {{ Form::hidden('_method', 'DELETE') }}
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            {{ Form::close() }}
                               <a class="btn btn-sm btn-info"  href="{{ URL::to('courses/' . $value->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                              <a class="btn btn-sm btn-warning" href="{{ route('courses.edit', $value->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
       </div>
    </div>




@endsection

