
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


   <a href="{{url('execute_algorithm')}}"><button><i class="fa fa-bolt" aria-hidden="true"></i> Execute Algorithm</button></a>







@endsection

