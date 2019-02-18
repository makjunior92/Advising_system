
@extends('layouts.admin-layout')

@section('title', 'All bids')

@section('page_heading', 'All Bids')

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

    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('offeredcourses') }}">Bids Resource</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('offeredcourses') }}">View All Bids</a></li>              
        </ul>
    </nav>

    <div class="alert alert-success">
    @foreach($data as $value)
        <strong>Course:</strong> {{$value->code}} |
        <strong>Section:</strong> {{$value->section}} |
        <strong>Faculty:</strong> {{$value->initial}} |
        @break;
    @endforeach
        <strong>Total Bids:</strong> {{$total}} |
        <strong>Max Bid:</strong> {{$max}} |
        <strong>Min Bid:</strong> {{$min}} 
    </div>





<!-- will be used to show any messages -->


    <div class="card">
        <div class="card-header primary-color-dark white-text">
          <strong>Bids</strong>
        </div>
    

         <div class="card-block">

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>#No</td>
                        <td>Student Name</td>
                        <td>Student ID</td>
                        <td>Bid</td>                      
                        <td>View All Bids</td>
                    </tr>
                </thead>
                
                <tbody>
                <?php $count=0; ?>
               
                @foreach($data as $value)
               <?php $count++; ?>
                    <tr>
                       <td>{{ $count}}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->bid }}</td>                        
                 
                        
                        <td>                         
                           
                            <a class="btn btn-sm btn-info"  href="{{ URL::to('bids/view_all_bids/' . $value->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>

                        </td>
                        
                        



                    </tr>
                @endforeach
                </tbody>
            </table>
        
       </div>
    </div>





@endsection

