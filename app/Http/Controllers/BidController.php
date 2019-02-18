<?php

namespace App\Http\Controllers;
use App\Bid;
use App\Student;
use App\Truepreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth;

use Session;

class Stat{
    public $y;
    public $a;
}

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$bids = Bid::orderBy('bid','desc')->paginate(10);
        $bids = Bid::orderBy('student_id')->orderBy('offer_id')->get();

       return view('bid.index')->with('data',$bids);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        echo "Hi";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $bid = Bid::find($id);       
        $bid->delete();

        Session::flash('message', 'Successfully Deleted ');
        return redirect('bids');

    }


    public function save_preference_func(Request $request) {
        $data = json_decode($request->getContent(), true);
        //return view(student.demo)->with('datas',$data);
        $user_id =  $data['user_id'];
        $pref_array = $data['prefs'];
        $true_pref_str = $data['true_pref'];


      /*  array:3 [▼
          "_token" => "eBPCvVAw0waSzWpriqPShm7LifOX3BcLImuVXilN"
          "prefs" => array:2 [▼
            0 => array:4 [▼
              "offer_id" => 1
              "code" => "CSE327"
              "initial" => "SZZ"
              "section" => "1"
            ]
            1 => array:5 [▼
              "offer_id" => 2
              "code" => "CSE482"
              "initial" => "SZZ"
              "section" => "1"
              "bid" => "290"
            ]
          ]
          "user_id" => "2"
        ]*/
       

        $std = Student::where('user_id',$user_id)->first();


        $tf = new Truepreference;
        $tf->student_id = $std->id;
        $tf->preference = $true_pref_str;
        $tf->save();
        
        foreach($pref_array as $pa) {
           $b = new Bid;
           $b->offer_id = $pa['offer_id'];
           $b->student_id = $std->id;          
           $b->bid = $pa['bid'];
           $b->save();
        }

        echo "Success";
    }



    //================Data Generation=========================


/*
SELECT courses.code,offered_courses.section,COUNT(bids.offer_id),MAX(bid),MIN(bid) FROM bids JOIN offered_courses ON bids.offer_id=offered_courses.id JOIN courses ON courses.id=offered_courses.course_id GROUP BY courses.code,offered_courses.section ORDER by COUNT(bids.offer_id) DESC*/

    public function most_popular_courses_func() {
        $bids = DB::table('bids')
                                ->join('offered_courses','bids.offer_id','=','offered_courses.id')
                                ->join('courses','courses.id','=','offered_courses.course_id')                              
                                ->select(DB::raw('bids.offer_id,courses.code,offered_courses.section,count(bids.offer_id) as total_bids,max(bid) as MAX_BID, MIN(bid) as MIN_BID'))
                                ->groupBy('bids.offer_id')
                                ->orderBy('total_bids','desc')->get();


        return view('bid.most_popular_courses')->with('data',$bids);

    }


    public function view_all_bids_func($id) {
        $total = DB::table('bids')->where('offer_id',$id)->count();
        $max = DB::table('bids')->where('offer_id',$id)->max('bid');
        $min = DB::table('bids')->where('offer_id',$id)->min('bid');

         $bids = DB::table('bids')
                                ->join('offered_courses','bids.offer_id','=','offered_courses.id')
                                ->join('courses','courses.id','=','offered_courses.course_id')
                                ->join('students','students.id','=','bids.student_id')
                                ->join('faculties','offered_courses.faculty_id','=','faculties.id')                          
                                ->select('courses.code','offered_courses.section','faculties.initial','students.name','students.id','bids.bid')
                                ->where('bids.offer_id',$id)                                    
                                ->orderBy('bid','desc')->get();
       // echo $total;
        //dd($bids);
        return view('bid.view_course_bid_details',['data' => $bids, 'total' => $total, 'max' => $max, 'min' => $min]);

    }


    public function show_my_bids_func($id) {
        $std = Student::where('user_id',$id)->first();

        $std_bids = Bid::where('student_id',$std->id)->get();

  
        
        return view('bid.view_my_bids')->with('data',$std_bids);

    }


    public function save_preference_successful_func() {
        Session::flash('message','Thanks! Your bid has been placed');
        return redirect('/');
    }

    public function top_10_courses() {
        if(Auth::user()->isAdmin)
            return view('admin.dashboard');

        $bids = DB::table('bids')
                        ->join('offered_courses','bids.offer_id','=','offered_courses.id')
                        ->join('courses','courses.id','=','offered_courses.course_id')
                        ->join('faculties','faculties.id','=','offered_courses.faculty_id')                              
                        ->select(DB::raw('bids.offer_id,courses.code,initial,capacity,offered_courses.section,count(bids.offer_id) as total_bids,max(bid) as MAX_BID, MIN(bid) as MIN_BID'))
                        ->groupBy('bids.offer_id')
                        ->orderBy('total_bids','desc')->paginate(10);


        return view('admin.index')->with('data',$bids);
    }


    public function bidding_window() {
         return view('student_public.student_pref');
    }


    public function admin_bid_bellchart() {
         $bids = Bid::orderBy('bid')->get();

        $total_bids = count($bids);
         $stat_array = array(
                0=>0,
                1=>0,
                2=>0,
                3=>0,
                4=>0,
                5=>0,
                6=>0,
                7=>0,
                8=>0,
                9=>0,               
                
            );

         foreach ($bids as $bid) {
            $amount = $bid->bid;
            if($amount>=90)
                $stat_array[9] += 1;
            else if($amount>=80)
                $stat_array[8] +=1;
            else if($amount>=70)
                $stat_array[7] +=1;
            else if($amount>=60)
                $stat_array[6] +=1;
            else if($amount>=50)
                $stat_array[5] +=1;
            else if($amount>=40)
                $stat_array[4] +=1;
            else if($amount>=30)
                $stat_array[3] +=1;
            else if($amount>=20)
                $stat_array[2] +=1;
            else if($amount>=10)
                $stat_array[1] +=1;
            else if($amount>=0)
                $stat_array[0] +=1;    
            

         }

        /* foreach ($stat_array as $key => $value) {
             $stat_array[$key] = ($value/$total_bids)*100;
         }*/

         $ret = array();
         $interval = 0;
         foreach ($stat_array as $key=>$value) {
             $st = new Stat;
             $st->y = (int)(($value/$total_bids)*100);
             $st->a = $interval;//(int)($bid->bid/10)*10;
             array_push($ret, $st);
             $interval+=10;
         }
        return json_encode($ret);

     }

     public function admin_bid_top_ten() {
        $bids = DB::table('bids')
                        ->join('offered_courses','bids.offer_id','=','offered_courses.id')
                        ->join('courses','courses.id','=','offered_courses.course_id')
                        ->join('faculties','faculties.id','=','offered_courses.faculty_id')                              
                        ->select(DB::raw('bids.offer_id,courses.code,initial,capacity,offered_courses.section,count(bids.offer_id) as total_bids,max(bid) as MAX_BID, MIN(bid) as MIN_BID'))
                        ->groupBy('bids.offer_id')
                        ->orderBy('total_bids','desc')->take(10)->get();


        return $bids->toJson();
     }



     public function execute_algorithm(){
        
        $couldnt = "<div class=\"alert alert-danger\">Could not execute script</div>";
        $done = "<div class=\"alert alert-success\">Algorithm Completed Successfully</div>";

        $failed = " <div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span></button><h4 class='modal-title w-100' id='myModalLabel'><strong><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Error</strong></h4></div><!--Body--><div class='modal-body'>$couldnt 
            </div><!--Footer--><div class='modal-footer'><button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button></div>";

         $success = " <div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span></button><h4 class='modal-title w-100' id='myModalLabel'><strong><i class='fa fa-check' aria-hidden='true'></i> Success </strong></h4></div><!--Body--><div class='modal-body'>$done 
            </div><!--Footer--><div class='modal-footer'><button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button></div>";

         $result= shell_exec('C:\Python27\python.exe F:\test.py') or die($failed);
    
        // echo "$result";
         /*Session::flash('message','Algorithm completed successfully!!');
         return redirect('/');*/
         if($result)
            echo $success;
     }



  
}
