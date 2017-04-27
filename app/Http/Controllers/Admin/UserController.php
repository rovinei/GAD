<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Mail;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*Mail::send('admin.users.change_password_user', ['user' => Auth::user()], function($message) {
            $message->to('darapenhchet@gmail.com', 'Jon Doe')->subject('Welcome to the Laravel 4 Auth App!');
        });*/
        $users = User::paginate(15);
        return View('admin.users.user')->with('users', $users);
    }
    
    public function json(Request $requests){
        $limit = $requests->input('limit') ? $requests->input('limit') : 15;
        if($limit>100 || $limit<=0){
            $limit = 15;
        }
        $users = User::Where('email', 'like','%'.$requests->input('search').'%')
                        ->whereNull('deleted_at')
                        ->paginate($limit);
        $data = View('admin.users.user_template')->with('users', $users)->render();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View('admin.users.create_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'status' => 'required',
            'is_admin' => 'required'
        ]);
        
        User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'status' => $request->input('status'),
            'is_admin' => $request->input('is_admin')
        ]);
        
        Session::flash('flash_message', 'User successfully registered!');
        
        return redirect()->back();
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
        $user = User::findOrFail($id);
        return View('admin.users.update_user')->with('user', $user);
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
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'STATUS' => true
        ]);
    }
    
    /*public function changePassword(){
        return View('admin.users.change_password_user');
    }*/
    
    public function updateUser(Request $request){
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'status' => 'required',
            'is_admin' => 'required'
        ]);
 
        $user = User::findOrFail($request->input('id'));
        
        // UPDATE TWO CHOICE
        // 1. CHOICE USING UPDATE METHOD DIRECT
        $user->update($request->all());
        // 2. CHOICE USIG THE FILL AND UPDATE
        //$user->fill($request->all())->update();//save($request->all());
        
        Session::flash('flash_message', 'User successfully updated!');
        
        return redirect()->back();
    }
    
    public function changePassword(Request $request){
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);
        
        $user = User::findOrFail($request->input('id'));
        
        $user->update($request->all());
        
        Session::flash('flash_message', 'User successfully changed the password!');
        
        return redirect()->back();
    }
}
