<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Department;

use Session;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $cor = Course::all();

         return view('Course.index')->with('data', $cor);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $dep = Department::pluck('dept_code', 'id');

        return view('Course.create')->with('data', $dep);

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
            'name' => 'required',
            'code' => 'required|max:6',
            'credits' => 'required',
            'dept_id' => 'required',

            ]);


        $cor = new Course;

        $cor->name = $request->name;
        $cor->code = $request->code;
        $cor->credits = $request->credits;
        $cor->dept_id = $request->dept_id;

        $cor->save();


        Session::flash('message', 'Successfully Created');
        return redirect('courses');




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);

        return view('course.show')->with('data',$course); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $course = Course::find($id);
         $dep = Department::pluck('dept_code', 'id');

        return view('course.edit')->with('data',$course)->with('dept',$dep); 
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
            'name' => 'required',
            'code' => 'required|max:10',
            'credits' => 'required',
            'dept_id' => 'required',

            ]);


        $cor = Course::find($id);


        $cor->name = $request->name;
        $cor->code = $request->code;
        $cor->credits = $request->credits;
        $cor->dept_id = $request->dept_id;

        $cor->save();


        Session::flash('message', 'Successfully Updated');
        return redirect('courses');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $info = $course->code." ".$course->name;
        $course->delete();

         Session::flash('message', 'Successfully Deleted '.$info);
        return redirect('courses');
    }
}
