
@extends('layouts.admin-layout')

@section('title', 'Department Home')

@section('page_heading', 'Department Dashboard')

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

<table id="datatable" class="table table-striped table-bordered">
    
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Code</th>
            <th>Actions</th>            
        </tr>
    </thead>
    
    <tbody>
  <?php $count=0; ?>
               @foreach($data as $value)
               <?php $count++; ?>
        <tr>
           <td>{{$count}}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->dept_code }}</td>
            
            
            
           <td>

                       {{ Form::open(array('url' => 'departments/' . $value->id, 'class' => 'pull-right','method' => 'DELETE')) }}
                               {{ Form::hidden('_method', 'DELETE') }}
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            {{ Form::close() }}
                               <a class="btn btn-sm btn-info"  href="{{ URL::to('departments/' . $value->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                              <a class="btn btn-sm btn-warning" href="{{ route('departments.edit', $value->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

            </td>
                    
        </tr>
    @endforeach
    </tbody>
</table>
</div>
</div>


@endsection