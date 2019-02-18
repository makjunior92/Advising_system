<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\OfferedCourse;
use App\Department;
use App\Course;
use App\Faculty;
use Session;

class OffCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $offc = OfferedCourse::all();

        return view('OfferedCourse.index')->with('data', $offc);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $deps = Department::pluck('dept_code', 'id');
        $ofcs = Course::pluck('code', 'id');
        $facs = Faculty::pluck('initial', 'id');
        //return view('OfferedCourse.create')->with('data', $deps);

        return view('OfferedCourse.create', ['data' => $deps, 'course' => $ofcs, 'faculty' => $facs]);
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

        $this->validate($request, [
            'dept_id' => 'required',
            'course_id' => 'required|max:6',
            'faculty_id' => 'required',
            'section' => 'required',
            'capacity' => 'required',
            ]);


        $ofc = new OfferedCourse;

        $ofc->dept_id = $request->dept_id;
        $ofc->course_id = $request->course_id;
        $ofc->faculty_id = $request->faculty_id;
        $ofc->section = $request->section;
        $ofc->capacity = $request->capacity;
        $ofc->save();


        Session::flash('message', 'Successfully Created');
        return redirect('offeredcourses');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ofc = OfferedCourse::find($id);

        return view('OfferedCourse.show')->with('data', $ofc);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ofc = OfferedCourse::find($id);
        $deps = Department::pluck('dept_code', 'id');
        $ofcs = Course::pluck('code', 'id');
        $facs = Faculty::pluck('initial', 'id');

        return view('OfferedCourse.edit',['data' => $ofc, 'course' => $ofcs, 'faculty' => $facs, 'dept'=>$deps]);
       
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
          $this->validate($request, [
            'dept_id' => 'required',
            'course_id' => 'required|max:6',
            'faculty_id' => 'required',
            'section' => 'required',
            'capacity' => 'required',
            ]);


        $ofc = OfferedCourse::find($id);

        $ofc->dept_id = $request->dept_id;
        $ofc->course_id = $request->course_id;
        $ofc->faculty_id = $request->faculty_id;
        $ofc->section = $request->section;
        $ofc->capacity = $request->capacity;
        $ofc->save();


        Session::flash('message', 'Successfully Edited');
        return redirect('offeredcourses');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ofc = OfferedCourse::find($id);
        $info = $ofc->course->code.".".$ofc->section;
        $ofc->delete();

        Session::flash('message', 'Successfully Deleted '.$info);
        return redirect('offeredcourses');
    }



    //=============== Resource Controller End ========================

    //dd(DB::getQueryLog()) to see query log

    public function offers_autocomplete($query="") {
        $ofc_array = DB::table('offered_courses')
                                ->join('courses','courses.id','=','offered_courses.course_id')
                                ->join('faculties','faculties.id','=','offered_courses.faculty_id')
                                ->select('offered_courses.id as offer_id','courses.code','faculties.initial','section')
                                ->where('courses.code','like','%'.$query.'%')->get();

        //print_r($ofc_array);

       return $ofc_array->toJson();

    }

    
}
