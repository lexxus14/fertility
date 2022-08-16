<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SystemUserController extends Controller
{
    protected $redirectTo = '/home'; 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $strsql = "select * from users";
        $systemusers = DB::select($strsql);
       
         
        return view('sysuser.index',compact('systemusers'));
    }

    public function UserProfileEdit($id)
    {
        $users = User::find($id);
        return view('sysuser.editprofile',compact('users'));
    }

    public function UpdateProfile(Request $request)
    {
        if($request->txtpassword!=''){
            
        }

        return redirect()->to('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    public function GetUserEmail($email)
    {
        $strsql = "select email from users where email = '".$email."'";
        $systemusers = DB::select($strsql);
        return response()->json($systemusers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // Save In Database
            $user = new User;
            $user->name = $request->txtname;
            $user->last_name = $request->txtlastname;
            $user->email = $request->txtemail;
            $user->password = bcrypt($request->txtpassword);
            $user->save();
        
        return redirect()->to('/sysuser');
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
}
