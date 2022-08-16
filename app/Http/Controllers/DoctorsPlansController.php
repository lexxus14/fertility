<?php

namespace App\Http\Controllers;

use App\DoctorsPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorsPlansController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "DoctorsPlan";
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
        $doctorsplans = DoctorsPlan::all();
        return view('doctorsplan.index',compact('doctorsplans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('doctorsplan.new');
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
            $doctorsplans = new DoctorsPlan;
            $doctorsplans->code = $request->txtcode;
            $doctorsplans->description = $request->txtdescription;
            $doctorsplans->note = $request->txtnote;
            $doctorsplans->save();

            $doctorsplansId = $doctorsplans->id;

            $translinks = new SystemFunctionController;

            $translinks->StoreTransLink($doctorsplansId,$this->DocTransName);


        return redirect()->to('/doctorsplan');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function show(Reason $reason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // var_dump($id);
        // $reasons =Reason::find(1)->get();
        $doctorsplans = DB::table('doctorsplans')->where('id',$id)->get();
        // var_dump($reasons);
        return view('doctorsplan.edit',compact('doctorsplans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $doctorsplans = DoctorsPlan::find($request->id);
        $doctorsplans->code = $request->txtcode;
        $doctorsplans->description = $request->txtdescription;
        $doctorsplans->note = $request->txtnote;
        $doctorsplans->save();
        
        $translinks = new SystemFunctionController;

        $translinks->UpdateTransLink($request->id,$this->DocTransName);
        return redirect()->to('/doctorsplan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $doctorsplans = DoctorsPlan::destroy($request->del_id);
        return redirect()->to('/doctorsplan');
    }
    public function DoctorsPlanInfo($id)
    {
        $task = DoctorsPlan::find($id);

        return response()->json($task);

    }
}
