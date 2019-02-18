<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Course allocation System">
    <meta name="author" content="Kibria">

    <title>NSU | @yield('title')</title>



    <link href="{{ URL::asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ URL::asset('vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

   
    <!-- Morris Charts CSS -->
    <link href="{{ URL::asset('vendor/morrisjs/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ URL::asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- MTD CSS -->
    <link href="{{ URL::asset('vendor/mdb/css/mdb.min.css') }}" rel="stylesheet" type="text/css">

     <!-- Custom CSS -->
    <link href="{{ URL::asset('admin/css/admin-home.css') }}" rel="stylesheet">

     <!-- Select2 -->
    <link href="{{ URL::asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" >






<link rel="stylesheet" type="text/css" href="{{URL::asset('vendor/DataTables-1.10.13/media/css/dataTables.bootstrap.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{URL::asset('vendor/datatables-responsive/dataTables.responsive.css')}}">




    <style type="text/css">
        .navbar-default {
            background-color: #090638;
        }

        .sidebar {
             background-color:white;
        }
       

        #layout-nav li a {
            color: white;
        } 
        #layout-nav li a:hover {
            color:#090638 !important;
        } 

        .sidebar-nav ul li a {
             color:#090638 !important; 
        }

        

        .navbar a:hover {
            color: #201b73;
        }


        #app-name {
            color: white;
        }

        #layout-nav .dropdown-menu {
            background-color: #201b73; 
        }

        #layout-nav .nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
            color: white !important;
            background-color: #201b73; 
        }

        #datatable_length label {
            padding-top: 10px;
        }

        #datatable_length label .form-control {
            padding-bottom:  0px !important;
            padding-top:  1px !important;
            margin-bottom: 3px;
        }

         #datatable_filter label .form-control {
            padding-bottom:  0px !important;
            padding-top:  2px !important;
            margin-bottom: 6px;
            padding-right: 15px !important;;
      
        }

        #navbar-brand{
            position: relative;
        }

        #logo{
            position: absolute;
            bottom:10px;
        }

        #app_title{
            position: absolute;
            padding-left: 35px;
            font-weight: bold;
        }






    </style>

    @yield('css')

    @yield('javascript')

  

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav id="layout-nav" class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="app-name" class="navbar-brand" href="{{url('/')}}"><img id="logo" src="{{URL::asset('nsu-logo.ico')}}"> <span id="app_title">{{ config('app.name') }}</span></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               <!--  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                       
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    
                </li>
               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                     
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    
                </li>
                 --><!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                       <!--  <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li> -->
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>{{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> My Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-key fa-fw"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                             <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw"></i> Logout</a>

                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                             </form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

  
        <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       <!--  <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            
                        </li> -->
                    <!--   <div class="alert alert-info"><marquee behavior="scroll" direction="left"><strong>Top 10 Popular Courses: 1.</strong></marquee></div>
 -->

                        <li>
                            <a href="{{url('/')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                       
                        <li>
                            <a href="{{ url('bids/bidding_window') }}"><i class="fa fa-money fa-fw"></i> Bidding Window</a>
                        </li>
                        @if(Auth::user()->isStudent)
                         <li>
                            <a href="#"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Student Options<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('bids/show_my_bids/'. Auth::user()->id ) }}">My Bids</a>
                                </li>
                                <li>
                                    <a href="{{  url('bids/show_my_allocations/'. Auth::user()->id )  }}"> My Allocations</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        @endif


                       @if(Auth::user()->isAdmin)
                         <li>
                            <a data-toggle="modal" data-target="#loadingModal" href="{{url('execute_algorithm')}}"><i class="fa fa-bolt" aria-hidden="true"></i> Execute Algorithm</a>
                        </li>   

                        <li>
                            <a href="#"><i class="fa fa-area-chart" aria-hidden="true"></i> Bid Statistics<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('bids.index') }}">All bids</a>
                                </li>
                                <li>
                                    <a href="{{ url('bids/most_popular_courses') }}">Most Popular Courses</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-pie-chart" aria-hidden="true"></i> Bidding Results<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('allocations.index') }}">All Allocations</a>
                                </li>
                                  <li>
                                    <a href="{{ url('allocations/market_clearing_prices') }}">Market Clearing Prices</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> CRUD<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                             
                                <li>
                                    <a href="#">Course Resource<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{route('courses.create')}}">Create</a>
                                        </li>
                                        <li>
                                            <a href="{{url('courses')}}">View All</a>
                                        </li>                                      
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>

                                 <li>
                                    <a href="#">Student Resource<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{route('students.create')}}">Create</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('students')}}">View All</a>
                                        </li>                                      
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>

                                 <li>
                                    <a href="#">Faculty Resource<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ route('faculties.create')}}">Create</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('faculties')}}">View All</a>
                                        </li>                                      
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>

                                 <li>
                                    <a href="{{ url('offeredcourses')}}">Offers Resource<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ route('offeredcourses.create')}}">Create</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('offeredcourses')}}">View All</a>
                                        </li>                                      
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>

                                 <li>
                                    <a href="{{ URL::to('departments') }}">Department Resource<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="{{ route('departments.create') }}">Create</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('departments') }}">View All</a>
                                        </li>                                      
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>



                        <li>
                            <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> System Tasks<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('users.index') }}">All Users</a>
                                </li>
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
 
    

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                    
                </div>
                <!-- /.col-lg-12 -->

            </div>
            <!-- /.row -->
            <div class="row">
                    @yield('content')
           </div>
               
        </div>
        <!-- /#page-wrapper -->


    </div>
    <!-- /#wrapper -->



<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title w-100" id="myModalLabel"><strong><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
<span class="sr-only">Loading...</span> Course allocation algorithm on progress </strong></h4>
            </div>
            <!--Body-->
            <div class="modal-body">
               Close this window when done 
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>               
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>




     <!-- tether -->
    <script src="{{ URL::asset('vendor/tether-1.3.3/dist/js/tether.min.js')}}"></script>


    <!-- jQuery -->
    <script src="{{ URL::asset('vendor/jquery/jquery.min.js')}}"></script>
     <script> $ = jQuery.noConflict();</script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

   <!--  <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ URL::asset('vendor/metisMenu/metisMenu.min.js')}}"></script>

      <!-- MTD JavaScript -->
    <script src="{{ URL::asset('vendor/mdb/js/mdb.min.js')}}"></script>


    <!-- Morris Charts JavaScript -->
    <!-- 
    <script src="{{ URL::asset('vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{ URL::asset('vendor/morrisjs/morris.min.js')}}"></script>
    <script src="{{ URL::asset('data/morris-data.js')}}"></script>
 -->
    <!-- Custom Theme JavaScript -->
    <script src="{{URL::asset('admin/js/admin-home.js')}}"></script>

     <!-- Select2 -->
    <script src="{{URL::asset('vendor/select2/dist/js/select2.min.js')}}"></script>


    <!--Datatable -->


<script type="text/javascript" src="{{URL::asset('vendor/DataTables-1.10.13/media/js/jquery.dataTables.min.js')}}"></script> 
<script type="text/javascript" src="{{URL::asset('vendor/DataTables-1.10.13/media/js/dataTables.bootstrap.min.js')}}"></script>  
<script type="text/javascript" src="{{URL::asset('vendor/datatables-responsive/dataTables.responsive.js')}}"></script>  




<script type="text/javascript">
  $(document).ready(function() {
    $('#datatable').DataTable();
} );

$('#datatable').dataTable( {
  "lengthMenu": [ 5,10, 25, 50, 75, 100 ],
  responsive: true
} );

</script>


</body>

</html>
