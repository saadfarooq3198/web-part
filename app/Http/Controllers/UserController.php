<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    { 
        $admin=$this->middleware(['role:Admin','permission:view_user']);
    }
    public function index()
    {
        $users = User::all();
        return view('users',compact('users',$users));
    }

    public function get_users(){

        $allusers = User::all();
        return response()->json([
            'users'=>$allusers
        ]);
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
    public function store(StoreUser $request)
        { 
                $user = new User;
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $file = $request->file('img');
                if($file=='') {
                    $user->image='user.jpg';
                }
                else{
                    $user->image=$request->file('img')->getClientOriginalName();
                    $file->store('public/images');
                }
                $user->password=$request->password;
                $user->save();
                return response()->json([
                    'success'=>200,
                    'message'=>'User Added Successfully'
                ]);
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
        $user = User::find($id);
        return response()->json([
            'status'=>200,
            'user'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        $user = User::find($id);
        if($request->has('img')){
            $file = $request->file('img');
            $pic=$request->file('img')->getClientOriginalName();
            $file->store('public/images');
            // $destinationPath = public_path().'/images';
            // $file->move($destinationPath,$pic);
            $user->update(['image'=>$pic]);
        }
            if($request->password !=''){
                $pass=$request->password;
                $user->update(['password'=>$pass]); 
            }
                 $user->update([
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'email' => $request->email
                    ]);
                    return response()->json([
                        'status'=>200,
                        'message'=>'successfully updated'
                    ]);
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
            'status'=>200,
            'message'=>'User deleted Successfully'
        ]);
    }
}
