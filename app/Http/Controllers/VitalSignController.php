<?php

namespace App\Http\Controllers;

use App\VitalSign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VitalSignController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "VitalSign";
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
        $vitalsigns = VitalSign::all();
        return view('vitalsign.index',compact('vitalsigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('vitalsign.new');
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
            $vitalsigns = new VitalSign;
            $vitalsigns->code = $request->txtcode;
            $vitalsigns->description = $request->txtdescription;
            $vitalsigns->note = $request->txtnote;
            $vitalsigns->save();

            $vitalsignsId = $vitalsigns->id;

            $translinks = new SystemFunctionController;

            $translinks->StoreTransLink($vitalsignsId,$this->DocTransName);


        return redirect()->to('/vitalsign');
        
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
        $vitalsigns = DB::table('vitalsigns')->where('id',$id)->get();
        // var_dump($reasons);
        return view('vitalsign.edit',compact('vitalsigns'));
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
        $vitalsigns = VitalSign::find($request->id);
        $vitalsigns->code = $request->txtcode;
        $vitalsigns->description = $request->txtdescription;
        $vitalsigns->note = $request->txtnote;
        $vitalsigns->save();
        
        $translinks = new SystemFunctionController;

        $translinks->UpdateTransLink($request->id,$this->DocTransName);
        return redirect()->to('/vitalsign');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $vitalsigns = VitalSign::destroy($request->del_id);
        return redirect()->to('/vitalsign');
    }
    public function GetVitalSignInfo($id)
    {
        $task = VitalSign::find($id);

        return response()->json($task);

    }
}