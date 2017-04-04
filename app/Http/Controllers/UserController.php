<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users=User::search($request->scope)->paginate(5);
        if($request->ajax()){
            return response()->json(view('users.table',compact('users'))->render());
        }

        return view('users.index')->with(['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,[ 'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6']);

            User::create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>$request->password
            ]);
            return response()->json(["Proceso exitoso"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
       $this->validate($request,[ 'name' => 'required|max:255',
            'email' => "required|email|max:255|unique:users,email,{$user->id},id",
            'password' => 'required|min:6']);
       $user->password=bcrypt($request->password);
       $user->name=$request->name;
       $user->email=$request->email;
       $user->save();
        return response()->json(["Proceso exitoso"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function select(){
        return response()->json(User::select('name','id')->get());
    }
}
