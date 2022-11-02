<?php

namespace App\Http\Controllers;

use App\Staff;
use App\SpermFreezing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SpermFreezingController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Sperm Freezing";

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

    public function SpermFreezing($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select SpermFreezings.*,p.name StaffName from SpermFreezings 
                    inner join staff as p on p.id = SpermFreezings.CompByStaffId
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('spermfreezing.patientindex',compact('docresult','patients'));
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

        return view('spermfreezing.new',compact('patients','Staffs'));
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

        $docfiles = new SpermFreezing;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->Notes=$request->Notes;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->FileNo=$request->FileNo;
        $docfiles->FreezingNo=$request->FreezingNo;
        $docfiles->AccnNo=$request->AccnNo;
        $docfiles->CollectionTime=$request->CollectionTime;
        $docfiles->DaysOfAbstinence=$request->DaysOfAbstinence;
        $docfiles->IsEjaculateComplete=$this->CheckCheckBox($request->IsEjaculateComplete);
        $docfiles->IsEjaculateIncomplete=$this->CheckCheckBox($request->IsEjaculateIncomplete);
        $docfiles->IsEjaculateSpilled=$this->CheckCheckBox($request->IsEjaculateSpilled);
        $docfiles->IsCollectedOnSite=$this->CheckCheckBox($request->IsCollectedOnSite);
        $docfiles->IsCollectedOffSite=$this->CheckCheckBox($request->IsCollectedOffSite);
        $docfiles->IsFreshEja=$this->CheckCheckBox($request->IsFreshEja);
        $docfiles->IsMESA=$this->CheckCheckBox($request->IsMESA);
        $docfiles->IsTESE=$this->CheckCheckBox($request->IsTESE);
        $docfiles->IsPESA=$this->CheckCheckBox($request->IsPESA);
        $docfiles->IsReFreeze=$this->CheckCheckBox($request->IsReFreeze);
        $docfiles->Volume=$request->Volume;
        $docfiles->Liquefaction=$request->Liquefaction;
        $docfiles->Color=$request->Color;
        $docfiles->Viscosity=$request->Viscosity;
        $docfiles->pH=$request->pH;
        $docfiles->OfVialsNo=$request->OfVialsNo;
        $docfiles->Tank=$request->Tank;
        $docfiles->Canister=$request->Canister;
        $docfiles->Cane=$request->Cane;
        $docfiles->SpermVolume=$request->SpermVolume;
        $docfiles->Conc=$request->Conc;
        $docfiles->Motility=$request->Motility;

        $date = date_create($request->DateRecovered);
        $docfiles->DateRecovered= $date->format('Y-m-d');

        $docfiles->Office=$request->Office;
        $docfiles->IsSpecTypeFresh=$this->CheckCheckBox($request->IsSpecTypeFresh);
        $docfiles->IsSpecTESAPESAMESA=$this->CheckCheckBox($request->IsSpecTESAPESAMESA);
        $docfiles->IsSpecPrevFroz=$this->CheckCheckBox($request->IsSpecPrevFroz);
        $docfiles->CompByStaffId=$request->CompByStaffId;

        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/spermfreezing/'.$request->txtpatientId);
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
                    inner join SpermFreezings as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select SpermFreezings.*,p.name StaffName from SpermFreezings 
                    inner join staff as p on p.id = SpermFreezings.CompByStaffId
                  where SpermFreezings.id =".$docId;
        $docresults = DB::select($strsql);

        
        $Staffs = Staff::all();

        return view('spermfreezing.edit',compact('docresults','patients','Staffs','docId'));
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

        $strsql ="SELECT * from SpermFreezings where id=".$request->docId;
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

       $docfiles = SpermFreezing::find($request->docId);

        $docfiles->filelink = '/file/'.$imagepath;
        $docfiles->Notes=$request->Notes;

       $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');
        $docfiles->FileNo=$request->FileNo;
        $docfiles->FreezingNo=$request->FreezingNo;
        $docfiles->AccnNo=$request->AccnNo;
        $docfiles->CollectionTime=$request->CollectionTime;
        $docfiles->DaysOfAbstinence=$request->DaysOfAbstinence;
        $docfiles->IsEjaculateComplete=$this->CheckCheckBox($request->IsEjaculateComplete);
        $docfiles->IsEjaculateIncomplete=$this->CheckCheckBox($request->IsEjaculateIncomplete);
        $docfiles->IsEjaculateSpilled=$this->CheckCheckBox($request->IsEjaculateSpilled);
        $docfiles->IsCollectedOnSite=$this->CheckCheckBox($request->IsCollectedOnSite);
        $docfiles->IsCollectedOffSite=$this->CheckCheckBox($request->IsCollectedOffSite);
        $docfiles->IsFreshEja=$this->CheckCheckBox($request->IsFreshEja);
        $docfiles->IsMESA=$this->CheckCheckBox($request->IsMESA);
        $docfiles->IsTESE=$this->CheckCheckBox($request->IsTESE);
        $docfiles->IsPESA=$this->CheckCheckBox($request->IsPESA);
        $docfiles->IsReFreeze=$this->CheckCheckBox($request->IsReFreeze);
        $docfiles->Volume=$request->Volume;
        $docfiles->Liquefaction=$request->Liquefaction;
        $docfiles->Color=$request->Color;
        $docfiles->Viscosity=$request->Viscosity;
        $docfiles->pH=$request->pH;
        $docfiles->OfVialsNo=$request->OfVialsNo;
        $docfiles->Tank=$request->Tank;
        $docfiles->Canister=$request->Canister;
        $docfiles->Cane=$request->Cane;
        $docfiles->SpermVolume=$request->SpermVolume;
        $docfiles->Conc=$request->Conc;
        $docfiles->Motility=$request->Motility;

        $date = date_create($request->DateRecovered);
        $docfiles->DateRecovered= $date->format('Y-m-d');

        $docfiles->Office=$request->Office;
        $docfiles->IsSpecTypeFresh=$this->CheckCheckBox($request->IsSpecTypeFresh);
        $docfiles->IsSpecTESAPESAMESA=$this->CheckCheckBox($request->IsSpecTESAPESAMESA);
        $docfiles->IsSpecPrevFroz=$this->CheckCheckBox($request->IsSpecPrevFroz);
        $docfiles->CompByStaffId=$request->CompByStaffId;

        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/spermfreezing/'.$request->txtpatientId);
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
        $strsql ="SELECT * from SpermFreezings where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = SpermFreezing::destroy($request->del_id);

        return redirect()->to('/spermfreezing/'.$request->txtpatientId);
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
