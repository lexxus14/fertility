<?php

namespace App\Http\Controllers;

use App\Procedure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\SystemFunctionController;

class ProcedureController extends Controller
{
    protected $redirectTo = '/home'; 

    private $DocTransName = "Procedure";
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
        $procedures = Procedure::all();
        return view('procedure.index',compact('procedures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('procedure.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $procedure = new Procedure;
        $procedure->code = $request->txtcode;
        $procedure->description = $request->txtdescription;
        $procedure->note = $request->txtnote;
        $procedure->save();

        $transid = $procedure->id;
        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($transid,$this->DocTransName);

        return redirect()->to('/procedure');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function show(Procedure $procedure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $procedures = DB::table('procedures')->where('id',$id)->get();
        // var_dump($reasons);
        return view('procedure.edit',compact('procedures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $procedure = Procedure::find($request->id);
        $procedure->code = $request->txtcode;
        $procedure->description = $request->txtdescription;
        $procedure->note = $request->txtnote;
        $procedure->save();
        return redirect()->to('/procedure');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $procedure = Procedure::destroy($request->del_id);
        return redirect()->to('/procedure');
    }
}
