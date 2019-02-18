
<!-- This was a test -->


@extends('layouts.admin-layout')

@section('title', 'True Preference')
@section('page_heading', 'Submit true preference')
<style type="text/css">
     .list-group {
        list-style: decimal inside !important
    }

    .list-group-item {
        display: list-item !important
    }
</style>
<script src="{{URL::asset('vendor/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('vendor/html5sortable-master/dist/html.sortable.js')}}"></script>


<script type="text/javascript">
    function addElement() {
        var li = document.createElement('li');
        li.setAttribute('class',"list-group-item");
    
        text = document.createTextNode('HI');


        //document.getElementById("pref_list").appendChild(li);
        var container = document.getElementById("pref_list");
        container.appendChild(li);
        sortable(container);

       
 
    }
</script>


@section('content')

<button class="button" onclick="addElement()">Add</button>

<ol class="list-group" id="pref_list">
    <li class="list-group-item">Item 1</li>
    <li class="list-group-item">Item 2</li>
    <li class="list-group-item">Item 3</li>
    <li class="list-group-item">Item 4</li>
</ol>





<script>
    sortable('.list-group');
</script>


   
@endsection