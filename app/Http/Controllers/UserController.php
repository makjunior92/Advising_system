<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
       
        return view('user.index')->with('data',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.create');
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
            'name' => 'required|max:255',           
            'username' => 'required|min:3|unique:users',
            'type' =>'required'
            ]);
        $user = new User;

        $user->name = $request->name;
        $user->username = $request->username;

        if($request->type=='F'){
            $user->isFaculty = 1;
            $user->isAdmin = 0;            
            $user->isStudent = 0;
        }
        else if($request->type=='S'){
            $user->isStudent = 1;
            $user->isAdmin = 0;
            $user->isFaculty = 0;
        }
        
        else if($request->type=='A'){
            $user->isAdmin = 1;
            $user->isFaculty = 0;
            $user->isStudent = 0;
        }

        $user->password = Hash::make('123456');
        $user->email = 'Not Provided';

        $user->save();

        Session::flash('message', 'User Successfully Created');
        return redirect('users');
        
       

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
        $user = User::find($id);

        return view('user.edit')->with('data',$user);
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
            'name' => 'required|max:255',           
            'username' => 'required|min:3',
            'type' =>'required'
            ]);
            $user = User::find($id);

            $user->name = $request->name;
            $user->username = $request->username;

            if($request->type=='F'){
                $user->isFaculty = 1;
                $user->isAdmin = 0;            
                $user->isStudent = 0;
            }
            else if($request->type=='S'){
                $user->isStudent = 1;
                $user->isAdmin = 0;
                $user->isFaculty = 0;
            }
            
            else if($request->type=='A'){
                $user->isAdmin = 1;
                $user->isFaculty = 0;
                $user->isStudent = 0;
            }

            $user->save();

            Session::flash('message', 'User Successfully Updated');
            return redirect('users');
        
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
        $user = User::find($id);
        $user->delete();

        Session::flash('message', 'Successfully Deleted ');
        return redirect('users');
    }
}
