<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Department;
use App\Student;
use Session;
use App\Course;
use App\OfferedCourse;
use App\User;
use App\Role;
use App\EnrollCourse;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stu = Student::all();



        return view('Student.index')->with('data', $stu);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $dept = Department::pluck('name', 'id');

        return view('Student.create')->with('data', $dept);


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
            'department_id' => 'required',
            'grade' => 'required',

            ]);

        $s = new Student;

        $s->name = $request->name;
        $s->department_id = $request->department_id;
        $s->grade = $request->grade;

        $s->save();


    Session::flash('message', 'inserted successfully');
    return redirect('students');










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
    }



    public function show_my_allocations_func($id) {
        $std = Student::where('user_id',$id)->first();

        $my_allocs = EnrollCourse::where('student_id',$std->id)->paginate(5);

        return view('student.view_my_allocations')->with('data',$my_allocs);
    }


    public function top_10_courses() {
        
    }
}
