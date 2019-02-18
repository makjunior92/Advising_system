@extends('layouts.admin-layout')

@section('title', 'Dashboard')
@section('page_heading', 'Welcome, '.Auth::user()->name )
	<script type="text/javascript" src="{{URL::asset('ajax_library/ajaxRequestLib.js')}}"></script>

  <!-- jQuery -->
    <script src="{{ URL::asset('vendor/jquery/jquery.min.js')}}"></script>
    <!-- Morris Charts JavaScript -->
    <script src="{{ URL::asset('vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{ URL::asset('vendor/morrisjs/morris.min.js')}}"></script>
    <script src="{{ URL::asset('data/morris-data.js')}}"></script>


    <script type="text/javascript">
    			 var distribution = [];
    			 var top_ten = [];



    			function lookup_again() {
    				ajaxCallBack = doSomethingElse;

    				ajaxRequest('bids/admin_bid_top_ten');
    			}

    			function doSomethingElse() {
    				jsonOptions = JSON.parse(ajaxReq.responseText);
		       		console.log(jsonOptions);
		         
		          var interval = 0;
				  for (var i = 0; i <jsonOptions.length; i ++) {				   

				    top_ten.push({				     
				      y: jsonOptions[i].code+'-'+jsonOptions[i].section,
				      a: jsonOptions[i].total_bids				     
				    });
				  }
				  console.log(top_ten);
				  return top_ten;
    			}

	    		function lookup() {
			       		
			        ajaxCallBack = doSomething;
			    		
			     	ajaxRequest('bids/admin_bid_bellchart');
			    }

    	

		    	function doSomething() {
		    	jsonOptions = JSON.parse(ajaxReq.responseText);
		        console.log(jsonOptions);
		         
		          var interval = 0;
				  for (var i = 0; i <jsonOptions.length; i ++) {				   

				    distribution.push({				     
				      label: "Range: "+jsonOptions[i].a+"-"+(jsonOptions[i].a+9),
				      value: jsonOptions[i].y				     
				    });
				  }
				  console.log(distribution);
				  lookup_again();
				  return distribution;
	    	}

	    	lookup();


    </script>

 


@section('content')

    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif




	<div class="row">
		<div class="col-md-6">
	    	<div id="bar"></div>
	    	<div><p align="center"><strong id="bar-desc"></strong></p></div>
	    </div>
	    <div class="col-md-6">
	   		 <div id="donut"></div>
	   		 <div><p align="center"><strong id="donut-desc"></strong></p></div>
	    </div>
	</div>
    
     <script type="text/javascript">
    	 

    function drawBar() {

    	 $(document).ready(function() {
			  var graph = Morris.Bar({
			  element: 'bar',
			  data: top_ten,//[{y:'10',a:20}],
			  xkey: 'y',
			  ykeys: ['a'],
			  labels: ['Total Bids'],
			  barColors: ['#0b62a4', '#7a92a3', '#4da74d'],
			  parseTime:false,		  
			});
			});
    	 	document.getElementById("bar-desc").innerHTML = "Figure: Top 10 Popular courses";
			}

		    function drawDonut() {

		    	 $(document).ready(function() {
				  var graph = Morris.Donut({
				  element: 'donut',
				  data: distribution,//[{y:'10',a:20}],
				  colors:[	"#003366","#000033","#2F2F4F","#191970","#00009C","#63B8FF","#4F94CD","#36648B","#4682B4","#32127A"],
				  formatter:function (y, data) { return '% of Bids: ' + y }
				});
				});
		    	 document.getElementById("donut-desc").innerHTML = "Figure: Bid distribution stats";
			}




		setTimeout(function() { drawBar(); }, 2000);

		setTimeout(function() { drawDonut(); }, 2000);
		
    </script>



  

@endsection


