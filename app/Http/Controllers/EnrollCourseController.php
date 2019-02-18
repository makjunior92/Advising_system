<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OfferedCourse;
use App\EnrollCourse;
use Session;
use Illuminate\Support\Facades\DB;

class EnrollCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $enrolls = EnrollCourse::orderBy('student_id')->paginate(10);
        return view('EnrollCourse.index')->with('data',$enrolls);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $ofc = OfferedCourse::all();
        
        return view('EnrollCourse.create')->with('data', $ofc);





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

        $enroll = EnrollCourse::find($id);       
        $enroll->delete();

        Session::flash('message', 'Successfully Deleted!!');
        return redirect('enrollcourses');
    }


    public function market_clearing_prices() {
        $mcps = DB::table('enroll_courses')
                                ->join('bids','bids.id','=','enroll_courses.bid_id')
                                ->join('offered_courses','offered_courses.id','=','bids.offer_id')
                                ->join('courses','courses.id','=','offered_courses.course_id')
                                ->select(DB::raw('courses.code,offered_courses.section,offered_courses.capacity,IF(COUNT(enroll_courses.bid_id)=offered_courses.capacity,MIN(bids.bid),0) as MCP,COUNT(enroll_courses.id) as total'))
                                ->groupBy('offered_courses.id')
                                ->get();
        return view('bid.market_clearing_prices')->with('data',$mcps);

    }
}
