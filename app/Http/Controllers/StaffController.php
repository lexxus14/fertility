<?php

namespace App\Http\Controllers;

use Validator;
use App\Staff;
use App\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\SystemFunctionController;

class StaffController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Staff";      
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

        // $users = DB::table('users')
        //     ->join('contacts', 'users.id', '=', 'contacts.user_id')
        //     ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'contacts.phone', 'orders.price')
        //     ->where('name', '=', 'John')
        //     ->get();

        $staff = DB::table('staff')
            ->join('designations', 'staff.designation_id', '=', 'designations.id')
            ->select('staff.*', 'designations.description')
            ->get();
        
        return view('staff.index',compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $designations = Designation::all();
        return view('staff.new',compact('designations'));
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


        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:staff',
            'txtname' => 'required'
        ],
        [
            'code.unique' => 'Code must be unique',
            'code.required' => 'Code is required',
            'txtname.required' => 'Name is required'
        ]);
 
        if ($validator->fails()) {
            return redirect('staff/new')
                        ->withErrors($validator)
                        ->withInput();
        }

        $staff = new Staff;
        $staff->code = $request->code;
        $staff->name = $request->txtname;
        $staff->designation_id = $request->cmbdesignation;
        $staff->note = $request->txtnote;
        $staff->save();

        $transid=$staff->id;
        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($transid,$this->DocTransName);


        return redirect()->to('/staff');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = DB::table('staff')->where('id',$id)->get();
        $designations = Designation::all();
        return view('staff.edit',compact('staff','designations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'txtname' => 'required'
        ],
        [
            'txtname.required' => 'Name is required'
        ]);
 
        if ($validator->fails()) {
            return redirect('staff/edit/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $staff = Staff::find($request->id);
        // $staff->code = $request->code;
        $staff->name = $request->txtname;
        $staff->designation_id = $request->cmbdesignation;
        $staff->note = $request->txtnote;
        $staff->save();
        
        $translinks = new SystemFunctionController;

        $translinks->UpdateTransLink($request->id,$this->DocTransName);
        return redirect()->to('/staff');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $staff = Staff::destroy($request->del_id);
        return redirect()->to('/staff');
    }

    public function GetStaffInfo($id)
    {
        $task = Staff::find($id);

        return response()->json($task);

    }
}
