@extends('layouts.admin-layout')

@section('title', 'Faculty Info')

@section('page_heading', 'Student Preference')

@section('content')



  
 
	<script type="text/javascript" src="{{URL::asset('ajax_library/ajaxRequestLib.js')}}"></script>
	


  <script type="text/javascript">



	function lookup() {
		var dataList = document.getElementById('json-datalist');
		
    dataList.innerHTML = "";
		
    ajaxCallBack = doSomething;
		
    var query=document.getElementById("course_name").value;
		   
		ajaxRequest('course-autocomplete/'+query);


	}

	

	function doSomething() {
		var dataList = document.getElementById('json-datalist');
	
		var jsonOptions = JSON.parse(ajaxReq.responseText);
  
      // Loop over the JSON array.
    	jsonOptions.forEach(function(item) {
        // Create a new <option> element.
        var option = document.createElement('option');
        // Set the value using the item in the JSON array.
        option.value = item.code;
        // Add the <option> element to the <datalist>.
        dataList.appendChild(option);
      });
      
       
		//console.log(jsonOptions);
		//document.getElementById("id").innerHTML = jsonObj[0];
	}


</script>

<link rel="stylesheet" href="{{URL::asset('vendor/rangeslider/rangeslider.css')}}" />


  <style type="text/css">
        .card-header{
          padding-top: 10px;
          padding-bottom: 10px;
        }

        .card-block{
          padding-top: 20px;
          padding-bottom: 20px;
        }

        .card-block h2 {
            margin-top: 0px;
            margin-bottom: 0px;
        }


   
  </style>
  <script src="{{URL::asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{URL::asset('vendor/rangeslider/rangeslider.min.js')}}"></script>

<script type="text/javascript" src="{{URL::asset('vendor/bootstrap-slider-master/dist/bootstrap-slider.min.js')}}"></script>
<link rel="stylesheet" href="{{URL::asset('vendor/bootstrap-slider-master/dist/css/bootstrap-slider.min.css')}}" />


    <script type="text/javascript">
      var courseArray = new Array();
      var budget = 1000;




      function addCourseDiv() {
           var ct = document.getElementById("course_name").value;
          

           var pass = "#"+ct;

           var inp = "<input id='"+ct+"'' data-slider-id='"+ct+"Slider"+"' type='text' data-slider-min='0' data-slider-max='1000' data-slider-step='1' data-slider-value=\"0\" onchange='updateIndvPanels(this)' />";


           var panel = "<div class=\"card card-inverse card-primary mb-3 text-center\"><div class=\"card-header default-color-dark white-text\">"+ct+"</div><div class=\"card-block\"><div class=\"row\"><div class=\"slider col-md-8\">"+inp+"</div><div id=\"bid"+ct+"Slider\" class= \"col-md-4\"><h2>0</h2></div></div></div></div>";
             document.getElementById("course-container").innerHTML += panel;

            
             //Here I initialized a slider for the above input field. pffffffffffff......

            var slider = new Slider(pass, {
               formatter: function(value) {
                  return 'Your bid: ' + value;
            }
            });

           

            

          //  console.log(slider.getAttribute('id'));

/////===================Points to be noted ===========================

          /*    Heck of a job done :D
              Some Notes:
              1. Direct slider with api bellow
              <input type='text' id='somename' data-provide='slider' data-slider-min='1' data-slider-max='100' data-slider-step='1' data-slider-value='3' data-slider-tooltip='show' onchange='seeDemo()' >

              2. we can execute scripts in this way too:

                $.getScript( "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.2/bootstrap-slider.min.js", function( data, textStatus, jqxhr ) {
              console.log( data ); // Data returned
              console.log( textStatus ); // Success
              console.log( jqxhr.status ); // 200
              console.log( "Load was performed." );
            });

*/
           
        }

       

     




     

     

       
    </script>
       
  
</head>
<body>


<!--
<div class="card card-inverse card-primary mb-3 text-center">
<div class="card-header default-color-dark white-text">Hello</div>
<div class="card-block">
<div class="row">
<div class="col-md-8">Total valueeeeweeeeeeeeeeeeeeeeeee</div>
<div class="col-md-4">100</div>
</div>
</div>
</div>

-->

<!--
	<wrapper>
     <input type="range" min="1" max="30" step="1" value="10" unit="❤"/>
  </wrapper>
-->
  <div id="course-container" class="col-md-7">
    

  </div>



<div class="col-md-4" >

   
    <!--Card Danger-->
  <div class="card card-primary text-center z-depth-2">
   <div class="card-header default-color-dark white-text">
      Select Course
  </div>
  <div class="card-block">    
    <input type="text" id="course_name" list="json-datalist" placeholder="Search Here" onkeyup="lookup()">
  <datalist id="json-datalist">
    
  </datalist>
  </div>

  <button type="button" onclick="addCourseDiv()" class="btn btn-primary">ADD</button> 
   <button type="button" onclick="activateAll()" class="btn btn-primary">reset</button> 
    <!--/.Card Danger-->

</div>
</div>



    <!--Card Danger-->





        
   
 	 

@endsection