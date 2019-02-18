@extends('layouts.admin-layout')

@section('title', 'Dashboard')
@section('page_heading', 'Welcome, '.Auth::user()->name )


<style type="text/css">
    #top_ten{
        height: 60%;
        padding-left:2px;
        padding-right: 0px;
    }

    #top_ten .card{
        padding: 5px;
        margin-bottom: 15px;  
        width: inherit;       
        white-space: nowrap;
        overflow: hidden;
        box-sizing: border-box;   
        background-color: #f5f8fa;     
      
    }


    .card #scroll{ 
         
        display: inline-block;  
        padding-left: 100%; 
        animation: marquee 25s linear infinite;
    }
     .card #scroll:hover{ 
          animation-play-state: paused;
    }



   .marquee {
        width: inherit;       
        white-space: nowrap;
        overflow: hidden;
        box-sizing: border-box;

    }

    .marquee #banner {
        display: inline-block;
        padding-left: 100%;
        animation: marquee 25s linear infinite;
    }

    .marquee #banner:hover {
     animation-play-state: paused;
    }


    @keyframes marquee {
        0%   { transform: translate(0, 0); }
        100% { transform: translate(-100%, 0); }
    }









    .profile-user-info {
        display: table;
        width: 98%;
        width: calc(100% - 24px);
        margin: 0 auto
    }
    
    .profile-info-row {
        display: table-row
    }
    
    .profile-info-name,
    .profile-info-value {
        display: table-cell;
        border-top: 1px dotted #D5E4F1
    }
    
    .profile-info-name {
        text-align: right;
        padding: 6px 10px 6px 4px;
        font-weight: 400;
        color: #667E99;
        background-color: transparent;
        min-width: 120px;
        vertical-align: middle
    }
    .faculty-main .pf-details{
        max-width:360px;
    }
    
    .profile-info-value {
        padding: 6px 4px 6px 6px
    }
    
    .profile-info-value>span+span:before {
        display: inline;
        content: ",";
        margin-left: 1px;
        margin-right: 3px;
        color: #666;
        border-bottom: 1px solid #FFF
    }
    
    .profile-info-value>span+span.editable-container:before {
        display: none
    }
    
    .profile-info-row:first-child .profile-info-name,
    .profile-info-row:first-child .profile-info-value {
        border-top: none
    }
    
    .profile-user-info-striped {
        border: 1px solid #DCEBF7
    }
    
    .profile-user-info-striped .profile-info-name {
        color: #336199;
        background-color: #EDF3F4;
        border-top: 1px solid #F7FBFF
    }
    
    .profile-user-info-striped .profile-info-value {
        border-top: 1px dotted #DCEBF7;
        padding-left: 12px
    }
    
    .profile-picture {
        border: 1px solid #CCC;
        background-color: #FFF;
        padding: 4px;
        display: inline-block;
        max-width: 100%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, .15)
    }
    



</style>



{{-- 
@section('sidebar')
    @parent

    <li>
      <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Student Response<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li>
                <a href="#">Ascending</a>
            </li>
            <li>
                <a href="#">Descending</a>
            </li>
        </ul>
       
    </li>  
@endsection
--}}
@section('content')

    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

 <div class="marquee alert alert-warning"><span><strong id="banner">Instructions: Click on the "Bidding Window" link in the sidebar for course Bidding. Caution: Submit your Actual Preference List. Otherwise you might end up with courses you prefer the least</strong></span></div>

 <div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-pic">
                    <img id="avatar" class="editable img-responsive" alt="Avatar" src="{{URL::asset('images/grad.png')}}" width="160">

                </div>
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-sm btn-block">Change</button> 
            </div>

            <div class="col-md-9">
                <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name" style="width: 20%"> Name</div>
                            <div class="profile-info-value">
                                <span class="editable" id="username">
                                    {{Auth::user()->name}}                                        
                                </span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> ID: </div>
                            <div class="profile-info-value">
                                <span class="editable" id="signup">
                                {{Auth::user()->id}}                                        </span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> Email:</div>
                            <div class="profile-info-value">
                                <span class="editable" id="signup">
                                    {{Auth::user()->email}}
                                </span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> CGPA:</div>
                            <div class="profile-info-value">
                                <span class="editable" id="signup">
                                    &infin;
                                </span>
                            </div>
                        </div>
                          <div class="profile-info-row">
                            <div class="profile-info-name"> Credit Passed:</div>
                            <div class="profile-info-value">
                                <span class="editable" id="signup">
                                    &infin;
                                </span>
                            </div>
                        </div>
                 </div>
            </div>
            </div>

        </div>


     <div class="col-md-4">
        <div class="alert alert-info" id="top_ten">
            <p align="center"><strong>Top 10 Popular Courses</strong></p>
                  <?php $count=1; ?>          
                @foreach($data as $value)
                <div class="row">
                    <div class="col-md-1">
                    <strong>{{$count++}}. </strong>
                </div>
                <div class="col-md-11">
                   <div class="card" >
                    <span id="scroll"> 
                        
                          Course: <strong>{{ $value->code }}-{{ $value->section }}</strong> |                   
                          Faculty:  <strong>{{ $value->initial }}</strong> | 
                          Capacity:  <strong>{{ $value->capacity }}</strong> |
                          Total Bids:<strong>{{ $value->total_bids }}</strong> |                
                          Max Bid:  <strong>{{ $value->MAX_BID }}</strong> |
                          Min Bid:  <strong>{{ $value->MIN_BID }}</strong>  

                      </span>
                   </div>
                   </div>
                   </div>
                @endforeach
             
      

        </div>

    </div>

 </div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title w-100" id="myModalLabel"><strong>Change Profile Picture</strong></h4>
            </div>
            <!--Body-->
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                   <input type="file" name="propic">         
    
                </form>
                
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" onclick="submitPreference()" class="btn btn-success">Confirm</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>


   
@endsection