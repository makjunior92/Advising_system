
@extends('layouts.admin-layout')

@section('title', 'Most Popular')

@section('page_heading', 'Most Popular Course')

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
            <a class="navbar-brand" href="{{ URL::to('offeredcourses') }}">Bids Resource</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('offeredcourses') }}">View All Bids</a></li>              
        </ul>
    </nav>
    <div class="card">
        <div class="card-header primary-color-dark white-text">
          <strong>Bids</strong>
        </div>
    

         <div class="card-block">

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>#No</td>
                        <td>Course</td>
                        <td>Section</td>
                        <td>Total Bids</td>                        
                        <td>Max Bid</td>                   
                        <td>Min Bid</td>
                        <td>View All Bids</td>
                    </tr>
                </thead>
                
                <tbody>
                <?php $count=0; ?>
               
                @foreach($data as $value)
               <?php $count++; ?>
                    <tr>
                       <td>{{ $count}}</td>
                        <td>{{ $value->code }}</td>
                        <td>{{ $value->section }}</td>
                        <td>{{ $value->total_bids }}</td>                        
                        <td>{{ $value->MAX_BID }}</td>
                        <td>{{ $value->MIN_BID }}</td>
                        
                        <td>                         
                           
                            <a class="btn btn-sm btn-info"  href="{{ URL::to('bids/view_all_bids/' . $value->offer_id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>

                        </td>
                        
                        



                    </tr>
                @endforeach
                </tbody>
            </table>
         
       </div>
    </div>




@endsection

