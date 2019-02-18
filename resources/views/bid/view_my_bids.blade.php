
@extends('layouts.admin-layout')

@section('title', 'My bids')

@section('page_heading', 'My Bids')

@section('content')
<style type="text/css">
.card{
    padding: 10px;
}

.card-header{
      padding: 20px;    
}
</style>   







<!-- will be used to show any messages -->


    <div class="card">
        <div class="card-header primary-color-dark white-text">
          <strong>My Bids</strong>
        </div>
    

         <div class="card-block">

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>#No</td>
                        <td>Course Name</td>
                        <td>Course Code</td>
                        <td>Bid</td>                    
                        
                    </tr>
                </thead>
                
                <tbody>
                <?php $count=0; ?>
               
                @foreach($data as $value)
               <?php $count++; ?>
                    <tr>
                       <td>{{ $count}}</td>
                        <td>{{ $value->offeredcourse->course->name }}</td>
                        <td>{{ $value->offeredcourse->course->code }}</td>
                        <td>{{ $value->bid }}</td>                    
                 
                       
                        



                    </tr>
                @endforeach
                </tbody>
            </table>
         
       </div>
    </div>





@endsection

