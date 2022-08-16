<?php

namespace App\Http\Controllers;

use App\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\SystemFunctionController;

class TreatmentController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Treatments";  
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
        $treatments = Treatment::all();
        return view('treatment.index',compact('treatments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('treatment.new');
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
            $treatment = new Treatment;
            $treatment->code = $request->txtcode;
            $treatment->description = $request->txtdescription;
            $treatment->note = $request->txtnote;
            $treatment->save();

            $transid = $treatment->id;

            $translinks = new SystemFunctionController;

            $translinks->StoreTransLink($transid,$this->DocTransName);
        
        return redirect()->to('/treatement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         //
        // var_dump($id);
        // $reasons =Reason::find(1)->get();
        $treatments = DB::table('treatments')->where('id',$id)->get();
        // var_dump($reasons);
        return view('treatment.edit',compact('treatments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $treatment = Treatment::find($request->id);
        $treatment->code = $request->txtcode;
        $treatment->description = $request->txtdescription;
        $treatment->note = $request->txtnote;
        $treatment->save();
        return redirect()->to('/treatement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $treatment = Treatment::destroy($request->del_id);
        return redirect()->to('/treatement');
    }
}
