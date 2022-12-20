<?php

namespace App\Http\Controllers;
use App\Staff;
use App\IUI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IUIController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "IUI";

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

    public function IUI($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select IUIs.*,p.name StaffName from IUIs 
                    inner join staff as p on p.id = IUIs.PhysicianStaffId
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('iui.patientindex',compact('docresult','patients'));
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

        return view('iui.new',compact('patients','Staffs'));
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

        $docfiles = new IUI;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->Notes=$request->Notes;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->AccessionNo=$request->AccessionNo;
        $docfiles->IsComplete=$this->CheckCheckBox($request->IsComplete);
        $docfiles->IsSpilled=$this->CheckCheckBox($request->IsSpilled);
        $docfiles->IsHome=$this->CheckCheckBox($request->IsHome);
        $docfiles->IsOffice=$this->CheckCheckBox($request->IsOffice);
        $docfiles->DaysOfAbstinence=$request->DaysOfAbstinence;
        $docfiles->PhysicianStaffId=$request->PhysicianStaffId;
        $docfiles->CollectionTime=$request->CollectionTime;
        $docfiles->DeliveryTime=$request->DeliveryTime;    
        $docfiles->Liquefaction=$request->Liquefaction;
        $docfiles->Color=$request->Color;
        $docfiles->Viscosity=$request->Viscosity;
        $docfiles->Volume=$request->Volume;
        $docfiles->SpermConcentration=$request->SpermConcentration;
        $docfiles->TotalSpermCount=$request->TotalSpermCount;
        $docfiles->pH=$request->pH;
        $docfiles->ProgRapid=$request->ProgRapid;
        $docfiles->ProgSlow=$request->ProgSlow;
        $docfiles->ProgNonProg=$request->ProgNonProg;
        $docfiles->ProgNonMotile=$request->ProgNonMotile;
        $docfiles->NorForms=$request->NorForms;
        $docfiles->AbHead=$request->AbHead;
        $docfiles->AbMidpiece=$request->AbMidpiece;
        $docfiles->AbTail=$request->AbTail;

        $docfiles->AfPreVolume=$request->AfPreVolume;
        $docfiles->AfPreSpermConcentration=$request->AfPreSpermConcentration;
        $docfiles->AfPreTotalSpermCount=$request->AfPreTotalSpermCount;
        $docfiles->AfPreProgRapid=$request->AfPreProgRapid;
        $docfiles->AfPreProgSlow=$request->AfPreProgSlow;
        $docfiles->AfPreProgNonProg=$request->AfPreProgNonProg;
        $docfiles->AfPreProgNonMotile=$request->AfPreProgNonMotile;
        $docfiles->AfPreNorForms=$request->AfPreNorForms;
        $docfiles->AfPreAbHead=$request->AfPreAbHead;
        $docfiles->AfPreAbMidpiece=$request->AfPreAbMidpiece;
        $docfiles->AfPreAbTail=$request->AfPreAbTail;

        $docfiles->TimeAnalyzed=$request->TimeAnalyzed;
        $docfiles->EmbryologistStaffId=$request->EmbryologistStaffId;

        

        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/iui/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IUI  $iUI
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join IUIs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select IUIs.*,p.name PhysicianStaffName,p1.name EmbryologistStaffName from IUIs 
                    left join staff as p on p.id = IUIs.PhysicianStaffId
                    left join staff as p1 on p1.id = IUIs.EmbryologistStaffId
                  where IUIs.id =".$docId;
        $docresults = DB::select($strsql);

        
        $Staffs = Staff::all();

        return view('iui.view',compact('docresults','patients','Staffs','docId'));
    }

    public function PrintIUI($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join IUIs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select IUIs.*,p.name PhysicianStaffName,p1.name EmbryologistStaffName from IUIs 
                    left join staff as p on p.id = IUIs.PhysicianStaffId
                    left join staff as p1 on p1.id = IUIs.EmbryologistStaffId
                  where IUIs.id =".$docId;
        $docresults = DB::select($strsql);

        
        $Staffs = Staff::all();

        return view('iui.print',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IUI  $iUI
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join IUIs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select IUIs.*,p.name PhysicianStaffName,p1.name EmbryologistStaffName from IUIs 
                    left join staff as p on p.id = IUIs.PhysicianStaffId
                    left join staff as p1 on p1.id = IUIs.EmbryologistStaffId
                  where IUIs.id =".$docId;
        $docresults = DB::select($strsql);

        
        $Staffs = Staff::all();

        return view('iui.edit',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IUI  $iUI
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from IUIs where id=".$request->docId;
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

       $docfiles = IUI::find($request->docId);
        $docfiles->filelink = $imagepath;    
        $docfiles->Notes=$request->Notes;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->AccessionNo=$request->AccessionNo;
        $docfiles->IsComplete=$this->CheckCheckBox($request->IsComplete);
        $docfiles->IsSpilled=$this->CheckCheckBox($request->IsSpilled);
        $docfiles->IsHome=$this->CheckCheckBox($request->IsHome);
        $docfiles->IsOffice=$this->CheckCheckBox($request->IsOffice);
        $docfiles->DaysOfAbstinence=$request->DaysOfAbstinence;
        $docfiles->PhysicianStaffId=$request->PhysicianStaffId;
        $docfiles->CollectionTime=$request->CollectionTime;
        $docfiles->DeliveryTime=$request->DeliveryTime;    
        $docfiles->Liquefaction=$request->Liquefaction;
        $docfiles->Color=$request->Color;
        $docfiles->Viscosity=$request->Viscosity;
        $docfiles->Volume=$request->Volume;
        $docfiles->SpermConcentration=$request->SpermConcentration;
        $docfiles->TotalSpermCount=$request->TotalSpermCount;
        $docfiles->pH=$request->pH;
        $docfiles->ProgRapid=$request->ProgRapid;
        $docfiles->ProgSlow=$request->ProgSlow;
        $docfiles->ProgNonProg=$request->ProgNonProg;
        $docfiles->ProgNonMotile=$request->ProgNonMotile;
        $docfiles->NorForms=$request->NorForms;
        $docfiles->AbHead=$request->AbHead;
        $docfiles->AbMidpiece=$request->AbMidpiece;
        $docfiles->AbTail=$request->AbTail;

        $docfiles->AfPreVolume=$request->AfPreVolume;
        $docfiles->AfPreSpermConcentration=$request->AfPreSpermConcentration;
        $docfiles->AfPreTotalSpermCount=$request->AfPreTotalSpermCount;
        $docfiles->AfPreProgRapid=$request->AfPreProgRapid;
        $docfiles->AfPreProgSlow=$request->AfPreProgSlow;
        $docfiles->AfPreProgNonProg=$request->AfPreProgNonProg;
        $docfiles->AfPreProgNonMotile=$request->AfPreProgNonMotile;
        $docfiles->AfPreNorForms=$request->AfPreNorForms;
        $docfiles->AfPreAbHead=$request->AfPreAbHead;
        $docfiles->AfPreAbMidpiece=$request->AfPreAbMidpiece;
        $docfiles->AfPreAbTail=$request->AfPreAbTail;

        $docfiles->TimeAnalyzed=$request->TimeAnalyzed;
        $docfiles->EmbryologistStaffId=$request->EmbryologistStaffId;

        

        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/iui/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IUI  $iUI
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from IUIs where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = IUI::destroy($request->del_id);

        return redirect()->to('/iui/'.$request->txtpatientId);
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
