
@extends('layouts.admin-layout')

@section('title', 'Faculty Home')

@section('page_heading', 'Faculty Dashboard')

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
            <a class="navbar-brand" href="{{ URL::to('faculties') }}">Faculty Resource</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('faculties') }}">View All faculties</a></li>
            <li><a href="{{ route('faculties.create')}}">Create a faculty</a>       
        </ul>
    </nav>

    <div class="card">
        
        <div class="card-header primary-color-dark white-text">
          <strong>All the Faculties</strong>
        </div>
    

         <div class="card-block">



            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Initial</td>
                        <td>Designation</td>
                        <td>Department</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                
                <tbody>

                  <?php $count=0; ?>
               @foreach($data as $value)
               <?php $count++; ?>
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->initial }}</td>
                        <td>{{ $value->designation }}</td>
                        <td>{{ $value->department->name }}</td>
                        
                        

                        <!-- we will also add show, edit, and delete buttons -->
                        <td>

                            <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                            <!-- we will add this later since its a little more complicated than the other two buttons -->
                            {{ Form::open(array('url' => 'faculties/' . $value->id, 'class' => 'pull-right','method' => 'DELETE')) }}
                               {{ Form::hidden('_method', 'DELETE') }}
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            {{ Form::close() }}

                            <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                            <a class="btn btn-sm btn-info"  href="{{ URL::to('faculties/' . $value->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>

                            <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                            <a class="btn btn-sm btn-warning" href="{{ route('faculties.edit', $value->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>






          
        </div>
    </div>






@endsection

