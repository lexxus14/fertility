<?php

namespace App\Http\Controllers;

use App\OOcyteRetReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OOcyteRetrievalReportController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "OOCyte Retrieval Report";

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

    public function OOcyteRetReport($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select OOcyteRetReports.* from OOcyteRetReports 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('oocyteretreport.patientindex',compact('docresult','patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        return view('oocyteretreport.new',compact('patients'));
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

        $docfiles = new OOcyteRetReport;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->TotalNumberOfEggs=$request->TotalNumberOfEggs;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');


        $docfiles->Notes=$request->Notes;
        
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/oocyteretreport/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OOcyteRetReport  $oOcyteRetReport
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
       $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join OOcyteRetReports as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select OOcyteRetReports.* from OOcyteRetReports 
                  where OOcyteRetReports.id =".$docId;
        $docresults = DB::select($strsql);

        return view('oocyteretreport.view',compact('docresults','patients','docId'));
    }

    public function OOcyteRetReportPrint($docId)
    {
       $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join OOcyteRetReports as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select OOcyteRetReports.* from OOcyteRetReports 
                  where OOcyteRetReports.id =".$docId;
        $docresults = DB::select($strsql);

        return view('oocyteretreport.print',compact('docresults','patients','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OOcyteRetReport  $oOcyteRetReport
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join OOcyteRetReports as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select OOcyteRetReports.* from OOcyteRetReports 
                  where OOcyteRetReports.id =".$docId;
        $docresults = DB::select($strsql);

        return view('oocyteretreport.edit',compact('docresults','patients','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OOcyteRetReport  $oOcyteRetReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from OOcyteRetReports where id=".$request->docId;
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

       $docfiles = OOcyteRetReport::find($request->docId);
        $docfiles->filelink = $imagepath;   
        $docfiles->TotalNumberOfEggs=$request->TotalNumberOfEggs;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');


        $docfiles->Notes=$request->Notes;
        
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/oocyteretreport/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OOcyteRetReport  $oOcyteRetReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from OOcyteRetReports where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = OOcyteRetReport::destroy($request->del_id);

        return redirect()->to('/oocyteretreport/'.$request->txtpatientId);
    }
}
