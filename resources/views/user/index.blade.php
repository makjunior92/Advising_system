
@extends('layouts.admin-layout')

@section('title', 'Users Home')

@section('page_heading', 'Users Dashboard')

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
            <a class="navbar-brand" href="{{ URL::to('users') }}">Users Resource</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('users') }}">View All Users</a></li>      
             <li><a href="{{ route('users.create')}}">Add a User</a> </li>           
        </ul>
    </nav>


<!-- will be used to show any messages -->


    <div class="card">
        <div class="card-header primary-color-dark white-text">
          <strong>All Users</strong>
        </div>
    

         <div class="card-block">

            <table id="datatable" class="table table-striped table-bordered">
          
                <thead>
                    <tr>
                        <td>#No.</td>
                        <td>Username</td>
                        <td>Name</td>                                              
                        <td>Email</td>                   
                        <td>Type</td>
                        <td>Action</td>
                    </tr>
                </thead>
                
                <tbody>

               <?php $count=0; ?>
               
                @foreach($data as $value)
               <?php $count++; ?>
                    <tr>
                       <td>{{ $count}}</td>
                        <td>{{ $value->username }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>  
                        @if($value->isStudent)                      
                        <td><i class="fa fa-graduation-cap" aria-hidden="true"></i>Student</td>                       
                        @elseif($value->isFaculty)                      
                        <td><button type="button" class="btn btn-primary btn-sm" disabled="true">Faculty</button></td>
                        @else
                         <td><i class="fa fa-bolt" aria-hidden="true"></i>  Admin</td>
                        @endif
                        
                        

                       
                        <td>

                               {{ Form::open(array('url' => 'users/' . $value->id, 'class' => 'pull-right','method' => 'DELETE')) }}
                               {{ Form::hidden('_method', 'DELETE') }}
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            {{ Form::close() }}
                         <a class="btn btn-sm btn-info"  href="{{ URL::to('users/' . $value->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                         <a class="btn btn-sm btn-warning" href="{{ route('users.edit', $value->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        
       </div>
    </div>





@endsection

