<?php

namespace App\Http\Controllers;

use App\Reason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\SystemFunctionController;

class ReasonController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Reason";
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
        $reasons = Reason::all();
        return view('reason.index',compact('reasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('reason.new');
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
            $reason = new Reason;
            $reason->code = $request->txtcode;
            $reason->description = $request->txtdescription;
            $reason->note = $request->txtnote;
            $reason->save();

            $reasonId = $reason->id;

            $translinks = new SystemFunctionController;

            $translinks->StoreTransLink($reasonId,$this->DocTransName);


        return redirect()->to('/reason');
        
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
        $reasons = DB::table('reasons')->where('id',$id)->get();
        // var_dump($reasons);
        return view('reason.edit',compact('reasons'));
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
        $reason = Reason::find($request->id);
        $reason->code = $request->txtcode;
        $reason->description = $request->txtdescription;
        $reason->note = $request->txtnote;
        $reason->save();
        
        $translinks = new SystemFunctionController;

        $translinks->UpdateTransLink($request->id,$this->DocTransName);
        return redirect()->to('/reason');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $reason = Reason::destroy($request->del_id);
        return redirect()->to('/reason');
    }
}
