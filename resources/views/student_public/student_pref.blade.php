@extends('layouts.admin-layout')

@section('title', 'Bidding window')

@section('page_heading', 'Student Bidding Window')

@section('content')



  
 
	<script type="text/javascript" src="{{URL::asset('ajax_library/ajaxRequestLib.js')}}"></script>

  <script src="{{URL::asset('vendor/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('vendor/html5sortable-master/dist/html.sortable.js')}}"></script>


	


  <script type="text/javascript">

      var jsonOptions;

    	function lookup() {
        document.getElementById("error").innerHTML = "";
    		var dataList = document.getElementById('json-datalist');
    		
        dataList.innerHTML = "";
    		
        ajaxCallBack = doSomething;
    		
        var query=document.getElementById("course_name").value;
    		   
    		ajaxRequest('course-autocomplete/'+query);

        //=============Show info========
        var option = document.createElement('option');            
        option.value = "Searching.. Please wait..";
        dataList.appendChild(option);

    	}

    	

    	function doSomething() {
          var dataList = document.getElementById('json-datalist');
        
          dataList.innerHTML = "";


    		var dataList = document.getElementById('json-datalist');
    	
    		jsonOptions = JSON.parse(ajaxReq.responseText);

        if(jsonOptions.length==0) {
            var option = document.createElement('option');            
            option.value = "Sorry couldn't find any matches";
            dataList.appendChild(option);
           // console.log("th f");
        }else{

          // Loop over the JSON array.
            jsonOptions.forEach(function(item) {
            // Create a new <option> element.
            var option = document.createElement('option');
            // Set the value using the item in the JSON array.
            option.value = item.code+"-"+item.section+"-"+item.initial;
            // Add the <option> element to the <datalist>.
            dataList.appendChild(option);
          });
        }
       
        console.log(jsonOptions);
     
          
           
    		//console.log(jsonOptions);
    		//document.getElementById("id").innerHTML = jsonObj[0];
    	}


      function submitSuccessful () {
         console.log(ajaxReq.responseText);

         window.location.href = "{{url('bids/save_preference_successful')}}";
      }

      function sendFormAsJson(jsonData,pref_str) {
          ajaxCallBack = submitSuccessful;
          var d = {
              "_token": "{{ csrf_token() }}",
              'prefs' : jsonData,
              'user_id':"{{ Auth::user()->id }}",
              'true_pref': pref_str,
          };
          var data = JSON.stringify(d);
          console.log(data);
          ajaxPOST('save_preference',data);

         /* $.ajax({
          method: 'POST', // Type of response and matches what we said in the route
          url: 'hadi', // This is the url we gave in the route
          data: {'id' : 2}, // a JSON object to send back
          success: function(response){ // What to do if we succeed
              console.log(response); 
          },
          error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
              console.log(JSON.stringify(jqXHR));
              console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
          }
      });*/


      }

      function validateInput(input) {
          var size = jsonOptions.length;
          for (var i=0; i<size; i++) {
             if(jsonOptions[i].code==input)
                return true;
          }
          return false;
      }



  //========================Page Scipts =====================
    var courseArray = new Array();
    var budget = 100;
    var selection = new Array();

    function getCourseObject (code,section) {
       var size = jsonOptions.length;

       for(var i=0; i<size; i++) {
          var obj = jsonOptions[i];
          if(obj.code==code && obj.section==section)
              return obj;
       }
    }


   /* function isDuplicate(newCourse) {
          var str = newCourse+"Slider";
          var size = courseArray.length;
          for (var i=0; i<size; i++) {
             if(courseArray[i].getAttribute('id')==str)
                return true;
          }
          return false;
          
      }*/

      //============Replacing isDuplicate by a better version ===============


      function isDuplicate(cname,section) {
          for(var i=0; i<selection.length; i++) {
              if(selection[i].code==cname && selection[i].section==section)
                 return true;
          }
          return false;
      }

         function hasLimitExceeded() {
              var total=0;
              var size = courseArray.length;
              if(size==0)
                return false;
              for (var i=0; i<size; i++) {
                 // console.log(courseArray[i].getValue());
                 total += courseArray[i].getValue();
               //  console.log(i+" Total= "+total);
                    if(total>=budget)
                        return true;
              }
              return false;
        }


        function deleteCourseDiv(divName,section) {
            var parent = document.getElementById(divName+"Parent");
            var grandParent = parent.parentNode;        

            var size = courseArray.length;
              
              for (var i=0; i<size; i++) {
                 if(courseArray[i].getAttribute('id')==divName+"Slider") {               
                     courseArray[i].destroy();
                     courseArray.splice(i,1); 
                     break;          //Delete 1 element from the specified index
                   }
              }
            grandParent.removeChild(parent);      

            //=============Redundant code===============

             var total=0;
             var size = courseArray.length;
              
              for (var i=0; i<size; i++) {
                
                 total += courseArray[i].getValue();


              }      
              document.getElementById("capital").innerHTML = budget-total;

              //==========Remove from selection Array==============

             var size = selection.length;

             for (var i=0; i<size; i++) {
                if(selection[i].code==divName && selection[i].section == section){
                    selection.splice(i,1);
                    break;
                }

             }


             //==========Reenabling disabled inputs=========
             var size = courseArray.length;
              if(!hasLimitExceeded()){
                for(var i=0; i<size; i++) {
                  if(!courseArray[i].isEnabled())
                    courseArray[i].enable();
                }
              }


              //==============Delete the course from preference list===========

              var ol = document.getElementById("pref_list");
              var li = document.getElementById(divName+"PrefList");
              ol.removeChild(li);



             document.getElementById("error").innerHTML = "<span style=\"color:#ff961f;\">Course Deleted!</span>";

        }



   



      function addCourseDiv() {
          var txtCourseDesc = document.getElementById("course_name").value;
          var splt = txtCourseDesc.split("-");
          var ct = splt[0];
          if(ct==""){
              document.getElementById("error").innerHTML = "Please select a course";          
              return;
          }
              
          if(!validateInput(ct)){
             document.getElementById("error").innerHTML = "Invalid course indentifier";          
             return;
          }

          if(isDuplicate(splt[0],splt[1])){
              document.getElementById("course_name").value = "";
              document.getElementById("error").innerHTML = "This course is added already";
              return; 
           }


           //===========Adding course Object to selection Array
           var obj = getCourseObject(splt[0],splt[1]);         
           selection.push(obj);

           var pass = "#"+ct;

           var inp = "<input id='"+ct+"' data-section='"+splt[1]+"' data-offer_id='"+obj.offer_id+"' name='selected_courses' data-slider-id='"+ct+"Slider"+"' type='text' data-slider-min='0' data-slider-max='100' data-slider-step='1' data-slider-value=\"0\" onchange='updateIndvPanels(this)' />";


           var panel = "<div class=\"card card-inverse card-primary mb-3 text-center\"><div class=\"card-header primary-color-dark white-text\">"+ct+" <div class=\"pull-right\"><a name='"+ct+"' style=\"color: red;\" onclick=\"deleteCourseDiv(this.name,"+splt[1]+")\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a></div></div><div class=\"card-block\"><div class=\"row course_info\"><div class=\"col-md-9\">Course Code: <strong>"+ct+"</strong> | Section: <strong>"+splt[1]+"</strong> | Faculty: <strong>"+splt[2]+"</strong> | Previous MCP: <strong>NA</strong></div><div class=\"col-md-3\">Your Bid</div></div><div class=\"row\"><div class=\"slider col-md-9\">"+inp+"</div><div id=\"bid"+ct+"Slider\" class= \"col-md-3 bidAmount\"><h2>0</h2></div></div></div></div>";
             var div = document.createElement('div');
             div.id = ct+"Parent";
             div.innerHTML = panel;
             document.getElementById("course-container").appendChild(div);
                        
             //Here I initialized a slider for the above input field. pffffffffffff......

            var slider = new Slider(pass, {
               formatter: function(value) {
                  return 'Your bid: ' + value;
            }
            });

           
           // console.log(hasLimitExceeded());
            if(hasLimitExceeded()){
                slider.disable();
            }
            courseArray.push(slider);

            document.getElementById("course_name").value = "";



            //=========Add course to Preference List

            var li = document.createElement('li');
            li.setAttribute('class',"list-group-item");
            li.setAttribute('name','pref-li-items');
            li.setAttribute('id',ct+"PrefList");
            li.setAttribute('data-offer_id',obj.offer_id);
            li.innerHTML = splt[0]+"-"+splt[1];
            document.getElementById("pref_list").appendChild(li);
            sortable('.list-group');                                //Alhamdulillah this worked
                

          //  console.log(slider.getAttribute('id'));

/////===================Points to be noted ===========================
          //Alhamdulillah
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
           document.getElementById("error").innerHTML = "<span style=\"color:green;\">Course added!</span>";

        }



        function getSlider(slider){
          var str = slider.getAttribute('id')+"Slider";
          var size = courseArray.length;
          for (var i=0; i<size; i++) {
            console.log(courseArray[i].getAttribute('id')+"=="+str);
             if(courseArray[i].getAttribute('id')==str)
                return courseArray[i];
          }
          return null;
       }


         function getCutoffValue(slider) {
              var total=0;
              var size = courseArray.length;
             
              
              for (var i=0; i<size; i++) {
                 if(slider.getAttribute('id')+"Slider"==courseArray[i].getAttribute('id')){
                     console.log(slider.getAttribute('id')+"=="+courseArray[i].getAttribute('id'));
                     continue;
                  }                 
                 total += courseArray[i].getValue();
                 
              }
            return budget-total;
            
        }




     
        function updateCapital(slider) {
              var total=0;
              var size = courseArray.length;
              
              for (var i=0; i<size; i++) {
                
                 total += courseArray[i].getValue();


              }
              var cap = parseInt(document.getElementById("capital").innerHTML);
              var balance = budget - total;
              if(balance < 0){
                 document.getElementById("capital").innerHTML = 0;
                 var cutoff = getCutoffValue(slider);
                 console.log("cutoff= "+cutoff);
                 getSlider(slider).setValue(cutoff);
                 document.getElementById("bid"+slider.getAttribute('id')+"Slider").innerHTML = "<h2>"+cutoff+"</h2>";
                 return true;
              }

              document.getElementById("capital").innerHTML = balance;
             
        }

       

        function updateIndvPanels(slider) {


            var value = parseInt(slider.getAttribute('value'));

            var size = courseArray.length;

            if(!hasLimitExceeded()){
                for(var i=0; i<size; i++) {
                  if(!courseArray[i].isEnabled())
                    courseArray[i].enable();

                  document.getElementById("error").innerHTML = " ";
                }
            }else{
              for(var i=0; i<size; i++) {
                  if(slider.getAttribute('id')+"Slider"==courseArray[i].getAttribute('id')){
                     console.log(slider.getAttribute('id')+"=="+courseArray[i].getAttribute('id'));
                   //  slider.setValue(getCutoffValue(slider));
                    // slider.relayout();
                     continue;
                  }
                     
                  if(courseArray[i].isEnabled())
                    courseArray[i].disable();
                }
                 document.getElementById("error").innerHTML = "Budget limit reached!!!";
           
            }


            //console.log("bid"+slider.getAttribute('id'));
            if(!updateCapital(slider))
                 document.getElementById("bid"+slider.getAttribute('id')+"Slider").innerHTML = "<h2>"+value+"</h2>";
            

        }

        function resetAll() {

              var size = courseArray.length;
              
              for (var i=0; i<size; i++) {
                
                 courseArray[i].destroy();


              }
              document.getElementById("course_name").value = "";
              document.getElementById("course-container").innerHTML = "";
              courseArray.length = 0;
              selection.length = 0;

            //=============Redundant code===============

             var total=0;
             var size = courseArray.length;
              
              for (var i=0; i<size; i++) {
                
                 total += courseArray[i].getValue();


              }      
              document.getElementById("capital").innerHTML = budget-total;

              //===========Clear Preference List============
              document.getElementById("pref_list").innerHTML ="";
        }


        function addBidToSelectedCourse(name,section,bid) {
          var size = selection.length;

          for(var i=0; i<size; i++) {
              if(selection[i].code==name && selection[i].section==section){
                  selection[i].bid = bid;
              }
               
          }
         
        }
        

        function processPreferenceList() {
          var el = document.getElementsByName("pref-li-items");
          if(el.length==0)
            return;
         // var pArray = new Array();
          var pref_str = "";
          for(var i=0; i<el.length; i++) {
             pref_str += el[i].dataset.offer_id+"-";
          }

          var retValue = pref_str.substring(0,pref_str.length-1);       //Here I am removing the last '-'
          return retValue;
        }


        function submitPreference() {
            
            if(selection.length==0){
              document.getElementById("error").innerHTML = "You have not placed any bids";
              $('#myModal').modal('hide');                
              return;
            }
            var isAdmin = '{{Auth::user()->isAdmin}}';
            if(isAdmin==1) {
               document.getElementById("error").innerHTML = "You are an Admin";
                $('#myModal').modal('hide');                
                return;
            }



            var inputs = document.getElementsByName('selected_courses');
            var size = inputs.length;


            for (var i=0; i<size; i++) {
               if(inputs[i].value==0){
                  document.getElementById("error").innerHTML = "None of the bids can be Zero";
                  $('#myModal').modal('hide');
                  return;
               }
               addBidToSelectedCourse(inputs[i].id,inputs[i].dataset.section,inputs[i].value);                           
              // obj.bid = inputs[i].value;
             //  inputs[i].dataset.offer_id = obj.offer_id;      //for using input as submission
               console.log(inputs[i]);
               // console.log(obj);
            }
          

         //  console.log(selection);

          var p_str = processPreferenceList();
          sendFormAsJson(selection,p_str);
          
           // document.getElementById("course_selection").submit();

        }





     



</script>

<link rel="stylesheet" href="{{URL::asset('vendor/rangeslider/rangeslider.css')}}" />


  <style type="text/css">
        .card-header{
          padding-top: 10px;
          padding-bottom: 10px;
          padding-left: 5px;
          padding-right: 10px;
        }

        .card-block{
          padding-top: 20px;
          padding-bottom: 10px;
          margin-left: 5px;
          margin-right: 5px;
        }

        .card-block h2 {
            margin-top: 0px;
            margin-bottom: 0px;

        }

         .list-group {
        list-style: decimal inside !important
         }

        .list-group-item {
            display: list-item !important
        }

        #pref_list{
          padding-right: 0px;
          font-weight: bold;
        }

        #pref_list li { background: #e3f2fd; }
        #pref_list li:nth-child(odd) { background: white; }

        .pref_div {
          padding-top: 15px;
        }

        #error {
          font-weight: bold;
          color: red;
        }

        .course_info, .bidAmount{
          color: #090638;
          padding-bottom:10px;
        }

        #capital{
          margin-top: 0px;
          color:red;
          font-weight: bold;
        }



   
  </style>


<!--
  <script src="{{URL::asset('vendor/jquery/jquery.min.js')}}"></script>



<script type="text/javascript" src="{{URL::asset('vendor/bootstrap-slider-master/dist/bootstrap-slider.min.js')}}"></script>


-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.2/bootstrap-slider.min.js"></script>
<link rel="stylesheet" href="{{URL::asset('vendor/bootstrap-slider-master/dist/css/bootstrap-slider.min.css')}}" />

 

    
       
  
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

 <form id="course_selection" action="{{ route( 'bids.store' )}}" method="POST">
  {{ csrf_field() }}
  <div id="course-container" class="col-md-8">
      
     

  </div>

 </form>


<div class="col-md-4 course-field" >

   
    <!--Card Danger-->
  <div class="card card-primary text-center z-depth-2">
   <div class="card-header primary-color-dark white-text">
      Select Course
  </div>
  <div class="row">
    <h5>BUDGET</h5>
  </div>
  <label><h2 id="capital">100</h2></label>
  <div class="card-block">
    <label id="error"></label>    
    <input type="text" id="course_name" list="json-datalist" placeholder="Search Here" onkeydown="lookup()">
  <datalist id="json-datalist">
    
  </datalist>
  </div>

  <button type="button" onclick="addCourseDiv()" class="btn btn-primary btn-sm">ADD</button> 
  <button type="button" onclick="resetAll()" class="btn btn-warning btn-sm">RESET</button> 
    <!--/.Card Danger-->
      
  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">SAVE</button>     
  

</div>



   <div class="card card-primary text-center z-depth-2 pref_div">
   <div class="card-header primary-color-dark white-text">
     Sort Preference
  </div>  
  <div class="card-block">    
    <ol class="list-group col-md-8 col-md-offset-2" id="pref_list">
     
    </ol>

   

  </div>



  
  <button type="button" class="btn btn-success btn-sm btn-block" disabled="true" >Sort Your Preference</button>     


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
                <h4 class="modal-title w-100" id="myModalLabel"><strong>Confirmation</strong></h4>
            </div>
            <!--Body-->
            <div class="modal-body">
               Submit your preference?
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" onclick="submitPreference()" class="btn btn-success">Submit</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>







    <!--Card Danger-->

<script type="text/javascript">
    sortable('.list-group');
</script>



        
   
 	 

@endsection