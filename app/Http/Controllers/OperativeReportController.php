<?php

namespace App\Http\Controllers;

use App\OperativeReport;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperativeReportController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Operative Report";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function PreOperaCheckList($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select OperativeReports.*,s.name as StaffName from OperativeReports
                    inner join staff as s on s.id = OperativeReports.SurgeonId
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('operativereport.patientindex',compact('docresult','patients'));
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
    public function create($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $Staffs = Staff::all();

        return view('operativereport.new',compact('patients','Staffs'));
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

        $docfiles = new OperativeReport;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');
        $docfiles->PreOpDiagnosis=$request->PreOpDiagnosis;
        $docfiles->PostOpDiagnosis=$request->PostOpDiagnosis;
        $docfiles->Procedure=$request->Procedure;
        $docfiles->SurgeonId=$request->SurgeonId;
        $docfiles->OperativeNote=$request->OperativeNote;
        $docfiles->Anesthesia=$request->Anesthesia;
        $docfiles->NumOfOocytes=$request->NumOfOocytes;
        $docfiles->RetrievalTime=$request->RetrievalTime;
        $docfiles->AddNotes=$request->AddNotes;
        $docfiles->Complication=$request->Complication;
        
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/opreport/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OperativeReport  $operativeReport
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join OperativeReports as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select OperativeReports.*,s.name as StaffName from OperativeReports
                    inner join staff as s on s.id = OperativeReports.SurgeonId
                  where OperativeReports.id =".$docId;
        $docresults = DB::select($strsql);

        $Staffs = Staff::all();

        return view('operativereport.view',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OperativeReport  $operativeReport
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join OperativeReports as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select OperativeReports.*,s.name as StaffName from OperativeReports
                    inner join staff as s on s.id = OperativeReports.SurgeonId
                  where OperativeReports.id =".$docId;
        $docresults = DB::select($strsql);

        $Staffs = Staff::all();

        return view('operativereport.edit',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OperativeReport  $operativeReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       $imagepath = "";

        $strsql ="SELECT * from OperativeReports where id=".$request->docId;
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

        $docfiles = OperativeReport::find($request->docId);
        $docfiles->filelink = $imagepath;   
        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->PreOpDiagnosis=$request->PreOpDiagnosis;
        $docfiles->PostOpDiagnosis=$request->PostOpDiagnosis;
        $docfiles->Procedure=$request->Procedure;
        $docfiles->SurgeonId=$request->SurgeonId;
        $docfiles->OperativeNote=$request->OperativeNote;
        $docfiles->Anesthesia=$request->Anesthesia;
        $docfiles->NumOfOocytes=$request->NumOfOocytes;
        $docfiles->RetrievalTime=$request->RetrievalTime;
        $docfiles->AddNotes=$request->AddNotes;
        $docfiles->Complication=$request->Complication;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        return redirect()->to('/opreport/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OperativeReport  $operativeReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from OperativeReports where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = OperativeReport::destroy($request->del_id);

        return redirect()->to('/opreport/'.$request->txtpatientId);
    }
}
