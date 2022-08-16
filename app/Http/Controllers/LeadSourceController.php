<?php

namespace App\Http\Controllers;

use App\LeadSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\SystemFunctionController;

class LeadSourceController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Lead Source";    
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
        $leadsources = LeadSource::all();
        return view('leadsource.index',compact('leadsources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('leadsource.new');
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
            $leadsource = new LeadSource;
            $leadsource->code = $request->txtcode;
            $leadsource->description = $request->txtdescription;
            $leadsource->note = $request->txtnote;
            $leadsource->save();

            $transid = $leadsource->id;

            $translinks = new SystemFunctionController;

            $translinks->StoreTransLink($transid,$this->DocTransName);
        
        return redirect()->to('/leadsource');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeadSource  $leadSource
     * @return \Illuminate\Http\Response
     */
    public function show(LeadSource $leadSource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeadSource  $leadSource
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // var_dump($id);
        // $reasons =Reason::find(1)->get();
        $leadsources = DB::table('lead_sources')->where('id',$id)->get();
        // var_dump($reasons);
        return view('leadsource.edit',compact('leadsources'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeadSource  $leadSource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $leadsource = LeadSource::find($request->id);
        $leadsource->code = $request->txtcode;
        $leadsource->description = $request->txtdescription;
        $leadsource->note = $request->txtnote;
        $leadsource->save();

        $translinks = new SystemFunctionController;

        $translinks->UpdateTransLink($request->id,$this->DocTransName);

        return redirect()->to('/leadsource');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeadSource  $leadSource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $leadsource = LeadSource::destroy($request->del_id);
        return redirect()->to('/leadsource');
    }
}
