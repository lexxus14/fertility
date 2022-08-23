<?php

namespace App\Http\Controllers;

use App\FETPhase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FETPhaseController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "FET Phase";
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

    public function FETPhase($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from fetphases 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('fetphase.patientindex',compact('docresult','patients'));
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
        $imagepath = "";

        if ($files = $request->file('inputFile')) {
        // Define upload path
           $destinationPath = public_path('/file/'); // upload path
        // Upload Orginal Image           
           $imagepath = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $imagepath);
       }

        $docfiles = new FETPhase;

        $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->FedSched = $request->FETSched;
        $docfiles->Months = $request->Month;

        $docfiles->Notes = $request->txtnotes;

        $docfiles->filelink = '/file/'.$imagepath;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);

        return redirect()->to('/fetphase/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FETPhase  $fETPhase
     * @return \Illuminate\Http\Response
     */
    public function show(FETPhase $fETPhase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FETPhase  $fETPhase
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join fetphases as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from fetphases 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        return view('fetphase.edit',compact('docresults','patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FETPhase  $fETPhase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from fetphases where id=".$request->txtDocId;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }

        if ($files = $request->file('inputFile')) {
            
            if(is_file(public_path($laLinkFile))){
                unlink(public_path($laLinkFile));
            }

        // Define upload path
           $destinationPath = public_path('/file/'); // upload path
        // Upload Orginal Image           
           $imagepath = rand().date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $imagepath);

           $imagepath = 'file/'.$imagepath;
       }
       else{
            $imagepath = $laLinkFile;
       }

       $docfiles = FETPhase::find($request->txtDocId);
       $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->FedSched = $request->FETSched;
        $docfiles->Months = $request->Month;

        $docfiles->Notes = $request->txtnotes;

        $docfiles->filelink = '/file/'.$imagepath;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        
        return redirect()->to('/fetphase/'.$request->txtpatientId);     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FETPhase  $fETPhase
     * @return \Illuminate\Http\Response
     */
    public function destroy(FETPhase $fETPhase)
    {
        //
    }
}
