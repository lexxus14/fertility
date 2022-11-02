<?php

namespace App\Http\Controllers;

use App\Staff;
use App\SemenAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SemenAnalysisController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Semen Analysis";

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

    public function SemenAnalysis($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select SemenAnalysis.*,p.name StaffName from SemenAnalysis 
                    inner join staff as p on p.id = SemenAnalysis.PhysicianStaffID
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('semenanalysis.patientindex',compact('docresult','patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($PatientId)
    {
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $Staffs = Staff::all();

        return view('semenanalysis.new',compact('patients','Staffs'));
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

        $docfiles = new SemenAnalysis;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->Notes=$request->Notes;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->CollectionTime=$request->CollectionTime;
        $docfiles->DeliveryTime=$request->DeliveryTime;
        $docfiles->DaysOfAbstinence=$request->DaysOfAbstinence;
        $docfiles->PhysicianStaffID=$request->PhysicianStaffID;
        $docfiles->IsEjaComplete=$this->CheckCheckBox($request->IsEjaComplete);
        $docfiles->IsEjaSpilled=$this->CheckCheckBox($request->IsEjaSpilled);
        $docfiles->IsCollHome=$this->CheckCheckBox($request->IsCollHome);
        $docfiles->IsCollOffice=$this->CheckCheckBox($request->IsCollOffice);
        $docfiles->Liquefaction=$request->Liquefaction;
        $docfiles->Color=$request->Color;
        $docfiles->Viscosity=$request->Viscosity;
        $docfiles->pH=$request->pH;
        $docfiles->Volume=$request->Volume;
        $docfiles->SpermCount=$request->SpermCount;
        $docfiles->TotalSpermCount=$request->TotalSpermCount;
        $docfiles->Cryptozoospermia=$request->Cryptozoospermia;
        $docfiles->ProgMotility=$request->ProgMotility;
        $docfiles->ProgRapid=$request->ProgRapid;
        $docfiles->ProgSlow=$request->ProgSlow;
        $docfiles->ProgNonProg=$request->ProgNonProg;
        $docfiles->ProgNonMotile=$request->ProgNonMotile;
        $docfiles->NonSpermCells=$request->NonSpermCells;
        $docfiles->NorForm=$request->NorForm;
        $docfiles->AbHead=$request->AbHead;
        $docfiles->AbMid=$request->AbMid;
        $docfiles->AbTail=$request->AbTail;
        $docfiles->TimeAnalyzed=$request->TimeAnalyzed;
        $docfiles->EmbryologistStaffId=$request->EmbryologistStaffId;

        

        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/semenanalysis/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SpermFreezing  $spermFreezing
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join SpermFreezings as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select SpermFreezings.*,p.name StaffName from SpermFreezings 
                    inner join staff as p on p.id = SpermFreezings.CompByStaffId
                  where SpermFreezings.id =".$docId;
        $docresults = DB::select($strsql);

        
        $Staffs = Staff::all();

        return view('spermfreezing.view',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpermFreezing  $spermFreezing
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join SemenAnalysis as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select SemenAnalysis.*,p.name PhysicianStaffName,p1.name EmbryologistStaffName from SemenAnalysis 
                    left join staff as p on p.id = SemenAnalysis.PhysicianStaffID
                    left join staff as p1 on p1.id = SemenAnalysis.EmbryologistStaffId
                  where SemenAnalysis.id =".$docId;
        $docresults = DB::select($strsql);

        
        $Staffs = Staff::all();

        return view('semenanalysis.edit',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpermFreezing  $spermFreezing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from SemenAnalysis where id=".$request->docId;
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

       $docfiles = SemenAnalysis::find($request->docId);
        $docfiles->filelink=$imagepath;
        $docfiles->Notes=$request->Notes;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->CollectionTime=$request->CollectionTime;
        $docfiles->DeliveryTime=$request->DeliveryTime;
        $docfiles->DaysOfAbstinence=$request->DaysOfAbstinence;
        $docfiles->PhysicianStaffID=$request->PhysicianStaffID;
        $docfiles->IsEjaComplete=$this->CheckCheckBox($request->IsEjaComplete);
        $docfiles->IsEjaSpilled=$this->CheckCheckBox($request->IsEjaSpilled);
        $docfiles->IsCollHome=$this->CheckCheckBox($request->IsCollHome);
        $docfiles->IsCollOffice=$this->CheckCheckBox($request->IsCollOffice);
        $docfiles->Liquefaction=$request->Liquefaction;
        $docfiles->Color=$request->Color;
        $docfiles->Viscosity=$request->Viscosity;
        $docfiles->pH=$request->pH;
        $docfiles->Volume=$request->Volume;
        $docfiles->SpermCount=$request->SpermCount;
        $docfiles->TotalSpermCount=$request->TotalSpermCount;
        $docfiles->Cryptozoospermia=$request->Cryptozoospermia;
        $docfiles->ProgMotility=$request->ProgMotility;
        $docfiles->ProgRapid=$request->ProgRapid;
        $docfiles->ProgSlow=$request->ProgSlow;
        $docfiles->ProgNonProg=$request->ProgNonProg;
        $docfiles->ProgNonMotile=$request->ProgNonMotile;
        $docfiles->NonSpermCells=$request->NonSpermCells;
        $docfiles->NorForm=$request->NorForm;
        $docfiles->AbHead=$request->AbHead;
        $docfiles->AbMid=$request->AbMid;
        $docfiles->AbTail=$request->AbTail;
        $docfiles->TimeAnalyzed=$request->TimeAnalyzed;
        $docfiles->EmbryologistStaffId=$request->EmbryologistStaffId;

        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/semenanalysis/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpermFreezing  $spermFreezing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $strsql ="SELECT * from SemenAnalysis where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = SemenAnalysis::destroy($request->del_id);

        return redirect()->to('/semenanalysis/'.$request->txtpatientId);
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
