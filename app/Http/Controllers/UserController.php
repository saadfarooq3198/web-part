<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    public function get_user_to_edit($id){
        $user = User::find($id);
        return response()->json([
            'status'=>200,
            'user'=>$user
        ]);
    }

    public function update_user(Request $request, $id)
        {
        // dd($request->all());
        $file = $request->file('img');
        if($file==''){
            $img = User::find($id)->value('image');
            $pic=$img;
        }
        else{
            $pic = $request->file('img');
            $pic=$request->file('img')->getClientOriginalName();
            $destinationPath = public_path().'/images';
            $file->move($destinationPath,$pic);
        }
        $data = User::where('id',$id)->update(['first_name'=>$request->first_name,'last_name'=>$request->last_name, 'email' => $request->email,'image'=>$pic,'password'=>$request->password]);
        // return redirect('users');
        return response()->json([
            'status'=>200,
            'message'=>'successfully updated'
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
    public function store(Request $request)
    {

        $user = new User;
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->email=$request->email;
        $file = $request->file('img');
        if($file=='') {
            $user->image='user.jpg';
        }
        else{
            $user->image=$request->file('img')->getClientOriginalName();
            $destinationPath = public_path().'/images';
            $file->move($destinationPath,$user->image);
        }
        $user->password=$request->password;
        $user->save();
        return response()->json([
            'status'=>200,
            'message'=>'student Added Successfully'
        ]);
        // return redirect('users');
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

        $file = $request->file('img');
        if($file==''){
            $img = User::find($id)->value('image');
            $pic=$img;
        }
        else{
            $pic=$request->file('img')->getClientOriginalName();
            $destinationPath = public_path().'/images';
            $file->move($destinationPath,$pic);
        }
        $data = User::where('id',$id)->update(['first_name'=>$request->first_name,'last_name'=>$request->last_name, 'email' => $request->email,'image'=>$pic,'password'=>$request->password]);
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
        dd($id);
        $user = User::find($id);
        $user->delete();
        return redirect('users');
    }

    public function deleteuser($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}