<?php

namespace App\Http\Controllers;

use App\Staff;
use App\EmbryologyRecordI;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmbryologyRecordController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Embryology Record I";

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

    public function EmbryologyRecordI($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select EmbryologyRecordIs.*,p.name StaffName from EmbryologyRecordIs 
                    inner join staff as p on p.id = EmbryologyRecordIs.RetPhysicianStaffId
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('embryoreci.patientindex',compact('docresult','patients'));
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

        return view('embryoreci.new',compact('patients','Staffs'));
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

        $docfiles = new EmbryologyRecordI;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');


        $docfiles->Notes= $request->Notes;
        $docfiles->RecordNo= $request->RecordNo;
        $docfiles->IsMssgYes= $this->CheckCheckBox($request->IsMssgYes);
        $docfiles->IsMssgNo= $this->CheckCheckBox($request->IsMssgNo);
        $docfiles->IsIVF= $this->CheckCheckBox($request->IsIVF);
        $docfiles->IsICSC= $this->CheckCheckBox($request->IsICSC);
        $docfiles->IsPGTA= $this->CheckCheckBox($request->IsPGTA);
        $docfiles->IsPGTAM= $this->CheckCheckBox($request->IsPGTAM);
        $docfiles->IsBabayGender= $this->CheckCheckBox($request->IsBabayGender);
        $docfiles->IsOOctye= $this->CheckCheckBox($request->IsOOctye);

        $date = date_create($request->hCGDate);
        $docfiles->hCGDate= $date->format('Y-m-d');

        $docfiles->hCGTime= $request->hCGTime;
        $docfiles->NoFoll= $request->NoFoll;
        $docfiles->MaxE2= $request->MaxE2;
        $docfiles->InfeDruAmount= $request->InfeDruAmount;
        $docfiles->CycleNo= $request->CycleNo;

        $date = date_create($request->CycleDate);
        $docfiles->CycleDate= $date->format('Y-m-d');

        $docfiles->IsLupronYes= $this->CheckCheckBox($request->IsLupronYes);
        $docfiles->IsLupronNo= $this->CheckCheckBox($request->IsLupronNo);
        $docfiles->G= $request->G;
        $docfiles->P= $request->P;
        $docfiles->A= $request->A;
        $docfiles->E= $request->E;
        $docfiles->dx1= $request->dx1;
        $docfiles->dx2= $request->dx2;
        $docfiles->Ethnicity= $request->Ethnicity;
        $docfiles->Town= $request->Town;

        $date = date_create($request->RetDate);
        $docfiles->RetDate= $date->format('Y-m-d');

        $docfiles->RetNoOfEggs= $request->RetNoOfEggs;
        $docfiles->RetStartTime= $request->RetStartTime;
        $docfiles->RetFinishTime= $request->RetFinishTime;
        $docfiles->RetAnesthesiologistStaffId= $request->RetAnesthesiologistStaffId;
        $docfiles->RetNurseStaffId= $request->RetNurseStaffId;
        $docfiles->RetEmbStaffId= $request->RetEmbStaffId;
        $docfiles->RetPhysicianStaffId= $request->RetPhysicianStaffId;
        $docfiles->RetWristCheckByStaffId= $request->RetWristCheckByStaffId;
        $docfiles->RetComments= $request->RetComments;
        $docfiles->IsFresh= $this->CheckCheckBox($request->IsFresh);
        $docfiles->IsFrozen= $this->CheckCheckBox($request->IsFrozen);
        $docfiles->IsTESE= $this->CheckCheckBox($request->IsTESE);
        $docfiles->IsMESA= $this->CheckCheckBox($request->IsMESA);
        $docfiles->PreWashVol= $request->PreWashVol;
        $docfiles->PreWashConc= $request->PreWashConc;
        $docfiles->PreWashMotility= $request->PreWashMotility;
        $docfiles->PreWashProg= $request->PreWashProg;
        $docfiles->PreWashTech= $request->PreWashTech;
        $docfiles->PosWashVol= $request->PosWashVol;
        $docfiles->PosWashConc= $request->PosWashConc;
        $docfiles->PosWashMotility= $request->PosWashMotility;
        $docfiles->PosWashProg= $request->PosWashProg;
        $docfiles->PosWashTech= $request->PosWashTech;
        $docfiles->IsPreMetIsolate= $this->CheckCheckBox($request->IsPreMetIsolate);
        $docfiles->IsPreMetWashOnly= $this->CheckCheckBox($request->IsPreMetWashOnly);
        $docfiles->IsPreMetPentoxifyline= $this->CheckCheckBox($request->IsPreMetPentoxifyline);
        $docfiles->SpermComments= $request->SpermComments;
        $docfiles->InsInsICSI= $request->InsInsICSI;
        $docfiles->InsInsConv= $request->InsInsConv;
        $docfiles->InsInsTime= $request->InsInsTime;
        $docfiles->InsInsEmbrStaffId= $request->InsInsEmbrStaffId;
        $docfiles->InsInsID= $request->InsInsID;
        $docfiles->FerRes2PN= $request->FerRes2PN;
        $docfiles->FerRes1PN= $request->FerRes1PN;
        $docfiles->FerRes3PN= $request->FerRes3PN;
        $docfiles->FerResEmbrStaffId= $request->FerResEmbrStaffId;
        $docfiles->HvaTime= $request->HvaTime;
        $docfiles->HvaTech= $request->HvaTech;
        $docfiles->HvaMII= $request->HvaMII;
        $docfiles->HvaMI= $request->HvaMI;
        $docfiles->HvaGV= $request->HvaGV;
        $docfiles->HvaOther= $request->HvaOther;
        $docfiles->ICSITotalInj= $request->ICSITotalInj;
        $docfiles->ICSIEmbStaffId= $request->ICSIEmbStaffId;
        $docfiles->ICSIComments= $request->ICSIComments;
        
        $date = date_create($request->EmbTranDate);
        $docfiles->EmbTranDate= $date->format('Y-m-d');

        $docfiles->EmbTranTime= $request->EmbTranTime;
        $docfiles->EmbTranPhysiStaffId= $request->EmbTranPhysiStaffId;
        $docfiles->EmbTranEmbrStaffId= $request->EmbTranEmbrStaffId;
        $docfiles->EmbTranNurseStaffId= $request->EmbTranNurseStaffId;
        $docfiles->EmbTranID= $request->EmbTranID;
        $docfiles->EmbTranCatheter= $request->EmbTranCatheter;
        $docfiles->IsEmbTranTenaYes= $this->CheckCheckBox($request->IsEmbTranTenaYes);
        $docfiles->IsEmbTranTeanNo= $this->CheckCheckBox($request->IsEmbTranTeanNo);
        $docfiles->IsEmbTranBleYes= $this->CheckCheckBox($request->IsEmbTranBleYes);
        $docfiles->IsEmbTranBleNo= $this->CheckCheckBox($request->IsEmbTranBleNo);
        $docfiles->IsEmbTranCramYes= $this->CheckCheckBox($request->IsEmbTranCramYes);
        $docfiles->IsEmbTranCramNo= $this->CheckCheckBox($request->IsEmbTranCramNo);
        $docfiles->EmbTranNoAttempts= $request->EmbTranNoAttempts;
        $docfiles->IsEmbTranEmbRetYes= $this->CheckCheckBox($request->IsEmbTranEmbRetYes);
        $docfiles->IsEmbTranEmbRetNo= $this->CheckCheckBox($request->IsEmbTranEmbRetNo);
        $docfiles->EmbTranNoRet= $request->EmbTranNoRet;
        $docfiles->EmbTranComments= $request->EmbTranComments;
        $docfiles->EmbTranNoEmbTran= $request->EmbTranNoEmbTran;
        $docfiles->IsEmbTranAHYes= $this->CheckCheckBox($request->IsEmbTranAHYes);
        $docfiles->IsEmbTranAHNo= $this->CheckCheckBox($request->IsEmbTranAHNo);
        $docfiles->EmbTranDayOfTran= $request->EmbTranDayOfTran;
        $docfiles->IsEmbTranACGHYes= $this->CheckCheckBox($request->IsEmbTranACGHYes);
        $docfiles->IsEmbTranACGHNo= $this->CheckCheckBox($request->IsEmbTranACGHNo);
        $docfiles->EmbTranQuaTrans= $request->EmbTranQuaTrans;
        $docfiles->OocCrvVitri= $request->OocCrvVitri;
        $docfiles->OocCrvLotNo= $request->OocCrvLotNo;

        $date = date_create($request->OocCrvExpDate);
        $docfiles->OocCrvExpDate= $date->format('Y-m-d');
        
        $docfiles->OocCrvDevice= $request->OocCrvDevice;

        $date = date_create($request->OocCrvDate);
        $docfiles->OocCrvDate= $date->format('Y-m-d');

        $docfiles->OocCrvEmbStaffId= $request->OocCrvEmbStaffId;
        $docfiles->OocCrvTankCanCan= $request->OocCrvTankCanCan;
        $docfiles->OocCrvTotalFroOoc= $request->OocCrvTotalFroOoc;
        $docfiles->OocCrvComments= $request->OocCrvComments;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/embryoreci/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmbryologyRecordI  $embryologyRecordI
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join EmbryologyRecordIs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select EmbryologyRecordIs.*,p.name RetAnesthesiologistName,p1.name RetNurseName, p2.name RetEmbName, p3.name RetPhysicianName, p4.name RetWristCheckByName, p5.name  InsInsEmbrName, p6.name FerResEmbrName,p7.name ICSIEmbName,p8.name EmbTranPhysiName,p9.name EmbTranEmbrName,p10.name EmbTranNurseName,p11.name OocCrvEmbName from EmbryologyRecordIs 
                    left join staff as p on p.id = EmbryologyRecordIs.RetAnesthesiologistStaffId
                    left join staff as p1 on p1.id = EmbryologyRecordIs.RetNurseStaffId
                    left join staff as p2 on p2.id = EmbryologyRecordIs.RetEmbStaffId
                    left join staff as p3 on p3.id = EmbryologyRecordIs.RetPhysicianStaffId
                    left join staff as p4 on p4.id = EmbryologyRecordIs.RetWristCheckByStaffId
                    left join staff as p5 on p5.id = EmbryologyRecordIs.InsInsEmbrStaffId
                    left join staff as p6 on p6.id = EmbryologyRecordIs.FerResEmbrStaffId
                    left join staff as p7 on p7.id = EmbryologyRecordIs.ICSIEmbStaffId
                    left join staff as p8 on p8.id = EmbryologyRecordIs.EmbTranPhysiStaffId
                    left join staff as p9 on p9.id = EmbryologyRecordIs.EmbTranEmbrStaffId
                    left join staff as p10 on p10.id = EmbryologyRecordIs.EmbTranNurseStaffId
                    left join staff as p11 on p11.id = EmbryologyRecordIs.OocCrvEmbStaffId
                  where EmbryologyRecordIs.id =".$docId;
        $docresults = DB::select($strsql);

        $Staffs = Staff::all();

        return view('embryoreci.view',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmbryologyRecordI  $embryologyRecordI
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
         $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join EmbryologyRecordIs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select EmbryologyRecordIs.*,p.name RetAnesthesiologistName,p1.name RetNurseName, p2.name RetEmbName, p3.name RetPhysicianName, p4.name RetWristCheckByName, p5.name  InsInsEmbrName, p6.name FerResEmbrName,p7.name ICSIEmbName,p8.name EmbTranPhysiName,p9.name EmbTranEmbrName,p10.name EmbTranNurseName,p11.name OocCrvEmbName from EmbryologyRecordIs 
                    left join staff as p on p.id = EmbryologyRecordIs.RetAnesthesiologistStaffId
                    left join staff as p1 on p1.id = EmbryologyRecordIs.RetNurseStaffId
                    left join staff as p2 on p2.id = EmbryologyRecordIs.RetEmbStaffId
                    left join staff as p3 on p3.id = EmbryologyRecordIs.RetPhysicianStaffId
                    left join staff as p4 on p4.id = EmbryologyRecordIs.RetWristCheckByStaffId
                    left join staff as p5 on p5.id = EmbryologyRecordIs.InsInsEmbrStaffId
                    left join staff as p6 on p6.id = EmbryologyRecordIs.FerResEmbrStaffId
                    left join staff as p7 on p7.id = EmbryologyRecordIs.ICSIEmbStaffId
                    left join staff as p8 on p8.id = EmbryologyRecordIs.EmbTranPhysiStaffId
                    left join staff as p9 on p9.id = EmbryologyRecordIs.EmbTranEmbrStaffId
                    left join staff as p10 on p10.id = EmbryologyRecordIs.EmbTranNurseStaffId
                    left join staff as p11 on p11.id = EmbryologyRecordIs.OocCrvEmbStaffId
                  where EmbryologyRecordIs.id =".$docId;
        $docresults = DB::select($strsql);

        $Staffs = Staff::all();

        return view('embryoreci.edit',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmbryologyRecordI  $embryologyRecordI
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from EmbryologyRecordIs where id=".$request->docId;
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

       $docfiles = EmbryologyRecordI::find($request->docId);
        $docfiles->filelink = $imagepath;   
        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');


        $docfiles->Notes= $request->Notes;
        $docfiles->RecordNo= $request->RecordNo;
        $docfiles->IsMssgYes= $this->CheckCheckBox($request->IsMssgYes);
        $docfiles->IsMssgNo= $this->CheckCheckBox($request->IsMssgNo);
        $docfiles->IsIVF= $this->CheckCheckBox($request->IsIVF);
        $docfiles->IsICSC= $this->CheckCheckBox($request->IsICSC);
        $docfiles->IsPGTA= $this->CheckCheckBox($request->IsPGTA);
        $docfiles->IsPGTAM= $this->CheckCheckBox($request->IsPGTAM);
        $docfiles->IsBabayGender= $this->CheckCheckBox($request->IsBabayGender);
        $docfiles->IsOOctye= $this->CheckCheckBox($request->IsOOctye);

        $date = date_create($request->hCGDate);
        $docfiles->hCGDate= $date->format('Y-m-d');

        $docfiles->hCGTime= $request->hCGTime;
        $docfiles->NoFoll= $request->NoFoll;
        $docfiles->MaxE2= $request->MaxE2;
        $docfiles->InfeDruAmount= $request->InfeDruAmount;
        $docfiles->CycleNo= $request->CycleNo;

        $date = date_create($request->CycleDate);
        $docfiles->CycleDate= $date->format('Y-m-d');

        $docfiles->IsLupronYes= $this->CheckCheckBox($request->IsLupronYes);
        $docfiles->IsLupronNo= $this->CheckCheckBox($request->IsLupronNo);
        $docfiles->G= $request->G;
        $docfiles->P= $request->P;
        $docfiles->A= $request->A;
        $docfiles->E= $request->E;
        $docfiles->dx1= $request->dx1;
        $docfiles->dx2= $request->dx2;
        $docfiles->Ethnicity= $request->Ethnicity;
        $docfiles->Town= $request->Town;

        $date = date_create($request->RetDate);
        $docfiles->RetDate= $date->format('Y-m-d');

        $docfiles->RetNoOfEggs= $request->RetNoOfEggs;
        $docfiles->RetStartTime= $request->RetStartTime;
        $docfiles->RetFinishTime= $request->RetFinishTime;
        $docfiles->RetAnesthesiologistStaffId= $request->RetAnesthesiologistStaffId;
        $docfiles->RetNurseStaffId= $request->RetNurseStaffId;
        $docfiles->RetEmbStaffId= $request->RetEmbStaffId;
        $docfiles->RetPhysicianStaffId= $request->RetPhysicianStaffId;
        $docfiles->RetWristCheckByStaffId= $request->RetWristCheckByStaffId;
        $docfiles->RetComments= $request->RetComments;
        $docfiles->IsFresh= $this->CheckCheckBox($request->IsFresh);
        $docfiles->IsFrozen= $this->CheckCheckBox($request->IsFrozen);
        $docfiles->IsTESE= $this->CheckCheckBox($request->IsTESE);
        $docfiles->IsMESA= $this->CheckCheckBox($request->IsMESA);
        $docfiles->PreWashVol= $request->PreWashVol;
        $docfiles->PreWashConc= $request->PreWashConc;
        $docfiles->PreWashMotility= $request->PreWashMotility;
        $docfiles->PreWashProg= $request->PreWashProg;
        $docfiles->PreWashTech= $request->PreWashTech;
        $docfiles->PosWashVol= $request->PosWashVol;
        $docfiles->PosWashConc= $request->PosWashConc;
        $docfiles->PosWashMotility= $request->PosWashMotility;
        $docfiles->PosWashProg= $request->PosWashProg;
        $docfiles->PosWashTech= $request->PosWashTech;
        $docfiles->IsPreMetIsolate= $this->CheckCheckBox($request->IsPreMetIsolate);
        $docfiles->IsPreMetWashOnly= $this->CheckCheckBox($request->IsPreMetWashOnly);
        $docfiles->IsPreMetPentoxifyline= $this->CheckCheckBox($request->IsPreMetPentoxifyline);
        $docfiles->SpermComments= $request->SpermComments;
        $docfiles->InsInsICSI= $request->InsInsICSI;
        $docfiles->InsInsConv= $request->InsInsConv;
        $docfiles->InsInsTime= $request->InsInsTime;
        $docfiles->InsInsEmbrStaffId= $request->InsInsEmbrStaffId;
        $docfiles->InsInsID= $request->InsInsID;
        $docfiles->FerRes2PN= $request->FerRes2PN;
        $docfiles->FerRes1PN= $request->FerRes1PN;
        $docfiles->FerRes3PN= $request->FerRes3PN;
        $docfiles->FerResEmbrStaffId= $request->FerResEmbrStaffId;
        $docfiles->HvaTime= $request->HvaTime;
        $docfiles->HvaTech= $request->HvaTech;
        $docfiles->HvaMII= $request->HvaMII;
        $docfiles->HvaMI= $request->HvaMI;
        $docfiles->HvaGV= $request->HvaGV;
        $docfiles->HvaOther= $request->HvaOther;
        $docfiles->ICSITotalInj= $request->ICSITotalInj;
        $docfiles->ICSIEmbStaffId= $request->ICSIEmbStaffId;
        $docfiles->ICSIComments= $request->ICSIComments;
        
        $date = date_create($request->EmbTranDate);
        $docfiles->EmbTranDate= $date->format('Y-m-d');

        $docfiles->EmbTranTime= $request->EmbTranTime;
        $docfiles->EmbTranPhysiStaffId= $request->EmbTranPhysiStaffId;
        $docfiles->EmbTranEmbrStaffId= $request->EmbTranEmbrStaffId;
        $docfiles->EmbTranNurseStaffId= $request->EmbTranNurseStaffId;
        $docfiles->EmbTranID= $request->EmbTranID;
        $docfiles->EmbTranCatheter= $request->EmbTranCatheter;
        $docfiles->IsEmbTranTenaYes= $this->CheckCheckBox($request->IsEmbTranTenaYes);
        $docfiles->IsEmbTranTeanNo= $this->CheckCheckBox($request->IsEmbTranTeanNo);
        $docfiles->IsEmbTranBleYes= $this->CheckCheckBox($request->IsEmbTranBleYes);
        $docfiles->IsEmbTranBleNo= $this->CheckCheckBox($request->IsEmbTranBleNo);
        $docfiles->IsEmbTranCramYes= $this->CheckCheckBox($request->IsEmbTranCramYes);
        $docfiles->IsEmbTranCramNo= $this->CheckCheckBox($request->IsEmbTranCramNo);
        $docfiles->EmbTranNoAttempts= $request->EmbTranNoAttempts;
        $docfiles->IsEmbTranEmbRetYes= $this->CheckCheckBox($request->IsEmbTranEmbRetYes);
        $docfiles->IsEmbTranEmbRetNo= $this->CheckCheckBox($request->IsEmbTranEmbRetNo);
        $docfiles->EmbTranNoRet= $request->EmbTranNoRet;
        $docfiles->EmbTranComments= $request->EmbTranComments;
        $docfiles->EmbTranNoEmbTran= $request->EmbTranNoEmbTran;
        $docfiles->IsEmbTranAHYes= $this->CheckCheckBox($request->IsEmbTranAHYes);
        $docfiles->IsEmbTranAHNo= $this->CheckCheckBox($request->IsEmbTranAHNo);
        $docfiles->EmbTranDayOfTran= $request->EmbTranDayOfTran;
        $docfiles->IsEmbTranACGHYes= $this->CheckCheckBox($request->IsEmbTranACGHYes);
        $docfiles->IsEmbTranACGHNo= $this->CheckCheckBox($request->IsEmbTranACGHNo);
        $docfiles->EmbTranQuaTrans= $request->EmbTranQuaTrans;
        $docfiles->OocCrvVitri= $request->OocCrvVitri;
        $docfiles->OocCrvLotNo= $request->OocCrvLotNo;

        $date = date_create($request->OocCrvExpDate);
        $docfiles->OocCrvExpDate= $date->format('Y-m-d');
        
        $docfiles->OocCrvDevice= $request->OocCrvDevice;

        $date = date_create($request->OocCrvDate);
        $docfiles->OocCrvDate= $date->format('Y-m-d');

        $docfiles->OocCrvEmbStaffId= $request->OocCrvEmbStaffId;
        $docfiles->OocCrvTankCanCan= $request->OocCrvTankCanCan;
        $docfiles->OocCrvTotalFroOoc= $request->OocCrvTotalFroOoc;
        $docfiles->OocCrvComments= $request->OocCrvComments;
        $docfiles->save();

        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/embryoreci/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmbryologyRecordI  $embryologyRecordI
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from EmbryologyRecordIs where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = EmbryologyRecordI::destroy($request->del_id);

        return redirect()->to('/embryoreci/'.$request->txtpatientId);
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
