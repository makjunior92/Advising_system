<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;
use App\Department;
use Session;

class FacultyController extends Controller
{
  



    //======================
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $facs = Faculty::all();

        return view('Faculty.index')->with('data', $facs);




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

        
        return view('Faculty.create')->with('data', $dep);
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
            'initial' => 'required|max:10',
            'salary' => 'required',
            'fac_type' => 'required',
            'degree' => 'required',
            'designation' => 'required',
            'dept_id' => 'required',

            ]);


        $f = new Faculty;

        $f->name = $request->name;
        $f->initial = $request->initial;
        $f->salary = $request->salary;
        $f->fac_type = $request->fac_type;
        $f->degree = $request->degree;
        $f->designation = $request->designation;
        $f->dept_id = $request->dept_id;


        $f->save();

        Session::flash('message', 'New Faculty Created');
        return redirect('faculties');






    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fac = Faculty::find($id);

        return view('Faculty.show')->with('data', $fac);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $fac = Faculty::find($id);
          $dep = Department::pluck('dept_code', 'id');


        return view('Faculty.edit')->with('data', $fac)->with('dept',$dep);

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
            'initial' => 'required|max:10',
            'salary' => 'required',
            'fac_type' => 'required',
            'degree' => 'required',
            'designation' => 'required',
            'dept_id' => 'required',

            ]);


        $f = Faculty::find($id);

        $f->name = $request->name;
        $f->initial = $request->initial;
        $f->salary = $request->salary;
        $f->fac_type = $request->fac_type;
        $f->degree = $request->degree;
        $f->designation = $request->designation;
        $f->dept_id = $request->dept_id;


        $f->save();

        Session::flash('message', 'Faculty Updated');
        return redirect('faculties');


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

        $fac = Faculty::find($id);
        $fac->delete();

        Session::flash('message', 'Deleted');
        return redirect('faculties');


    }
}
