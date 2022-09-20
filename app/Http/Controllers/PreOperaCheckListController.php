<?php

namespace App\Http\Controllers;

use App\PreOperativeChecklist;
use App\Procedure;
use App\VitalSign;
use App\Staff;
use App\PreOperaChkLstVitalSign;
use App\PreOperaChkLstProc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PreOperaCheckListController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Preoperative Checklist";

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

        $strsql ="select PreOperaChecklists.*,p.name StaffName from PreOperaChecklists 
                    inner join staff as p on p.id = PreOperaChecklists.GivenByStaffid
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('preperachklst.patientindex',compact('docresult','patients'));
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

        $VitalSigns = VitalSign::all();
        $Procedures = Procedure::all();
        $Staffs = Staff::all();

        return view('preperachklst.new',compact('patients','VitalSigns','Procedures','Staffs'));
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

        $docfiles = new PreOperativeChecklist;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->GivenByStaffid=$request->GivenByStaffid;

        $date = date_create($request->PreOperaDate);
        $docfiles->PreOperaDate= $date->format('Y-m-d');

        $docfiles->PreOperaTime=$request->PreOperaTime;

        $date = date_create($request->PSurgeryDate);
        $docfiles->PSurgeryDate= $date->format('Y-m-d');

        $docfiles->SurgeryTime=$request->SurgeryTime;
        $docfiles->ArrivalTime=$request->ArrivalTime;
        $docfiles->NPOInstruction=$request->NPOInstruction;

        $docfiles->IsNoJewelry=$this->CheckCheckBox($request->IsNoJewelry);
        $docfiles->IsNoMakeup=$this->CheckCheckBox($request->IsNoMakeup);
        $docfiles->IsNoNailPolish=$this->CheckCheckBox($request->IsNoNailPolish);
        $docfiles->Others=$request->Others;
        $docfiles->NpoStatus=$request->NpoStatus;
        $docfiles->Allergy=$request->Allergy;
        $docfiles->HisAndPhy=$request->HisAndPhy;
        $docfiles->InfoConforSur=$request->InfoConforSur;
        $docfiles->AnesCons=$request->AnesCons;
        $docfiles->LabReport=$request->LabReport;
        $docfiles->PreOpMed=$request->PreOpMed;
        $docfiles->VoidedFreely=$request->VoidedFreely;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $VitalSignId=$request->VitalSignId;
        $VitalSignRes=$request->VitalSignRes;

        $N = count($VitalSignRes);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreOperaChkLstVitalSign;
            $pricelistsub->PreOperaChecklistsId = $doclab_id; 
            $pricelistsub->VitalSignId = $VitalSignId[$i];
            $pricelistsub->VitalSignRes = $VitalSignRes[$i];
            $pricelistsub->save();
            
        }

        $ProcedureId=$request->ProcedureId;

        $N = count($ProcedureId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreOperaChkLstProc;
            $pricelistsub->PreOperaChecklistsId = $doclab_id; 
            $pricelistsub->ProcedureId = $ProcedureId[$i];
            $pricelistsub->save();
            
        }      


        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/popcklst/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PreOperativeChecklist  $preOperativeChecklist
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join PreOperaChecklists as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select PreOperaChecklists.*,p.name StaffName from PreOperaChecklists 
                    inner join staff as p on p.id = PreOperaChecklists.GivenByStaffid
                  where PreOperaChecklists.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dd.id,dd.description,VitalSignRes from PreOpeChkLstVitalSigns 
            inner join VitalSigns dd on dd.id = PreOpeChkLstVitalSigns.VitalSignId
            where PreOpeChkLstVitalSigns.PreOperaChecklistsId=".$docId;

        $PreOpeChkLstVitalSigns = DB::select($strsql);


        $strsql ="select dd.id,dd.description from PreOperaChkLstProcs 
                    inner join procedures dd on dd.id = PreOperaChkLstProcs.ProcedureId
                    where PreOperaChkLstProcs.PreOperaChecklistsId=".$docId;

        $PreOpProcedures = DB::select($strsql);

        $VitalSigns = VitalSign::all();
        $Procedures = Procedure::all();
        $Staffs = Staff::all();

        return view('preperachklst.view',compact('docresults','patients','VitalSigns','Procedures','PreOpeChkLstVitalSigns','Staffs','PreOpProcedures','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PreOperativeChecklist  $preOperativeChecklist
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join PreOperaChecklists as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select PreOperaChecklists.*,p.name StaffName from PreOperaChecklists 
                    inner join staff as p on p.id = PreOperaChecklists.GivenByStaffid
                  where PreOperaChecklists.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dd.id,dd.description,VitalSignRes from PreOpeChkLstVitalSigns 
            inner join VitalSigns dd on dd.id = PreOpeChkLstVitalSigns.VitalSignId
            where PreOpeChkLstVitalSigns.PreOperaChecklistsId=".$docId;

        $PreOpeChkLstVitalSigns = DB::select($strsql);


        $strsql ="select dd.id,dd.description from PreOperaChkLstProcs 
                    inner join procedures dd on dd.id = PreOperaChkLstProcs.ProcedureId
                    where PreOperaChkLstProcs.PreOperaChecklistsId=".$docId;

        $PreOpProcedures = DB::select($strsql);

        $VitalSigns = VitalSign::all();
        $Procedures = Procedure::all();
        $Staffs = Staff::all();

        return view('preperachklst.edit',compact('docresults','patients','VitalSigns','Procedures','PreOpeChkLstVitalSigns','Staffs','PreOpProcedures','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PreOperativeChecklist  $preOperativeChecklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $imagepath = "";

        $strsql ="SELECT * from PreOperaChecklists where id=".$request->docId;
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

       $docfiles = PreOperativeChecklist::find($request->docId);
        $docfiles->filelink = $imagepath;   
        $docfiles->GivenByStaffid=$request->GivenByStaffid;

        $date = date_create($request->PreOperaDate);
        $docfiles->PreOperaDate= $date->format('Y-m-d');

        $docfiles->PreOperaTime=$request->PreOperaTime;

        $date = date_create($request->PSurgeryDate);
        $docfiles->PSurgeryDate= $date->format('Y-m-d');

        $docfiles->SurgeryTime=$request->SurgeryTime;
        $docfiles->ArrivalTime=$request->ArrivalTime;
        $docfiles->NPOInstruction=$request->NPOInstruction;

        $docfiles->IsNoJewelry=$this->CheckCheckBox($request->IsNoJewelry);
        $docfiles->IsNoMakeup=$this->CheckCheckBox($request->IsNoMakeup);
        $docfiles->IsNoNailPolish=$this->CheckCheckBox($request->IsNoNailPolish);
        $docfiles->Others=$request->Others;
        $docfiles->NpoStatus=$request->NpoStatus;
        $docfiles->Allergy=$request->Allergy;
        $docfiles->HisAndPhy=$request->HisAndPhy;
        $docfiles->InfoConforSur=$request->InfoConforSur;
        $docfiles->AnesCons=$request->AnesCons;
        $docfiles->LabReport=$request->LabReport;
        $docfiles->PreOpMed=$request->PreOpMed;
        $docfiles->VoidedFreely=$request->VoidedFreely;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('PreOpeChkLstVitalSigns')->where('PreOperaChecklistsId', $request->docId)->delete();

        $VitalSignId=$request->VitalSignId;
        $VitalSignRes=$request->VitalSignRes;

        $N = count($VitalSignRes);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreOperaChkLstVitalSign;
            $pricelistsub->PreOperaChecklistsId = $doclab_id; 
            $pricelistsub->VitalSignId = $VitalSignId[$i];
            $pricelistsub->VitalSignRes = $VitalSignRes[$i];
            $pricelistsub->save();
            
        }

        $sub = DB::table('PreOperaChkLstProcs')->where('PreOperaChecklistsId', $request->docId)->delete();

        $ProcedureId=$request->ProcedureId;

        $N = count($ProcedureId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreOperaChkLstProc;
            $pricelistsub->PreOperaChecklistsId = $doclab_id; 
            $pricelistsub->ProcedureId = $ProcedureId[$i];
            $pricelistsub->save();
            
        }      


        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/popcklst/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PreOperativeChecklist  $preOperativeChecklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from PreOperaChecklists where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = PreOperativeChecklist::destroy($request->del_id);

        return redirect()->to('/popcklst/'.$request->txtpatientId);
    }

    public function CheckCheckBox($CheckBox)
    {
        //
        if($CheckBox=='on')
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
}
