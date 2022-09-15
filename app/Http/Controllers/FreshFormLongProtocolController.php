<?php

namespace App\Http\Controllers;

use App\DoctorDiagnosis;
use App\FreshFormLongProtocol;
use App\FreshFormLongDiag;
use App\FreshFormLongProSubs;
use App\FreshFormLongProgs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FreshFormLongProtocolController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Fresh Form Long Protocol";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function FreshFormLongPro($DocId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join FreshPhases as st on st.patientid = p.id
                    WHERE st.id =".$DocId;
        $patients = DB::select($strsql);

        $strsql ="select * from FreshFormLongPros 
                  where freshphasesiD =".$DocId;
        $docresult = DB::select($strsql);

        return view('freshlongpro.patientindex',compact('docresult','patients','DocId'));
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
    public function create($DocId)
    {
       //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join FreshPhases as st on st.patientid = p.id
                    WHERE st.id =".$DocId;
        $patients = DB::select($strsql);

        $doctorDiagnosis = DoctorDiagnosis::all();

        return view('freshlongpro.new',compact('patients','doctorDiagnosis','DocId'));
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
        $docfiles = new FreshFormLongProtocol;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->freshphasesiD = $request->FreshFormId;   
        $docfiles->Office= $request->Office;
        $docfiles->RetLoc= $request->RetLoc;
        $docfiles->CrySpermLoc= $request->CrySpermLoc;
        $docfiles->IVF= $request->IVF;
        $docfiles->OvDonor= $request->OvDonor;
        $docfiles->IVFwSur= $request->IVFwSur;

        $date = date_create($request->LupronStartDate);
        $docfiles->LupronStartDate= $date->format('Y-m-d');

        $docfiles->CD2= $request->CD2;
        $docfiles->IsConsent=$this->CheckCheckBox($request->IsConsent);
        $docfiles->CBC= $this->CheckCheckBox($request->CBC);
        $docfiles->FSH= $request->FSH;
        $docfiles->LongEstradiol= $request->LongEstradiol;
        $docfiles->AMH= $request->AMH;
        $docfiles->UterinePosition= $request->UterinePosition;
        $docfiles->Measurement= $request->Measurement;

        $date = date_create($request->LongProcDate);
        $docfiles->LongProcDate= $date->format('Y-m-d');

        $docfiles->IsWallace= $this->CheckCheckBox($request->IsWallace);
        $docfiles->Protocol= $request->Protocol;
        $docfiles->CD1Estradiol= $request->CD1Estradiol;
        $docfiles->CD1Prolactin= $request->CD1Prolactin;
        $docfiles->CD9Prolactin= $request->CD9Prolactin;
        $docfiles->Notes= $request->txtnotes;

        $date = date_create($request->HcgDate);
        $docfiles->HcgDate= $date->format('Y-m-d');

        $docfiles->HCGTime= $request->HCGTime;

        $date = date_create($request->ERDate);
        $docfiles->ERDate= $date->format('Y-m-d');

        $docfiles->ERTime= $request->ERTime;
        $docfiles->BloodType= $request->BloodType;

        $date = date_create($request->ETDate);
        $docfiles->ETDate= $date->format('Y-m-d');

        $docfiles->NoEmbryos= $request->NoEmbryos;
        $docfiles->NoTrans= $request->NoTrans;
        $docfiles->NoEggs= $request->NoEggs;
        $docfiles->NoCryo= $request->NoCryo;
        $docfiles->BetaNo1= $request->BetaNo1;

        $date = date_create($request->Beta1Date);
        $docfiles->Beta1Date= $date->format('Y-m-d');

        $docfiles->BetNo2= $request->BetNo2;

        $date = date_create($request->Beta2Date);
        $docfiles->Beta2Date= $date->format('Y-m-d');

        $docfiles->P4= $request->P4;
        $docfiles->ObGyn= $request->ObGyn;
        $docfiles->TelNo= $request->TelNo;
        $docfiles->Add= $request->Add; 

        $docfiles->createdbyid=Auth::user()->id;

        $docfiles->save();
        $doclab_id = $docfiles->id;

        $DiagnosisID=$request->DiagnosisID;

        $N = count($DiagnosisID);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new FreshFormLongDiag;
            $pricelistsub->FreshFormLongProsiD = $doclab_id; 
            $pricelistsub->FertilityDiagnosisId = $DiagnosisID[$i];
            $pricelistsub->save();
            
        }

        $CycleNo=$request->CDNo;
        $CycleDate=$request->CDDate;
        $RT=$request->RT;
        $LT=$request->LT;
        $Lining=$request->Lining;
        $Estradiol=$request->Estradiol;
        $Notes=$request->Notes;

        $N = count($CycleNo);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new FreshFormLongProSubs;
            $pricelistsub->FreshFormLongProsiD = $doclab_id; 
            $pricelistsub->CycleNo = $CycleNo[$i];

            $date = date_create($request->CycleDate[$i]);            
            $pricelistsub->CycleDate= $date->format('Y-m-d');

            $pricelistsub->UltrasoundRT = $RT[$i];
            $pricelistsub->UltrasoundLT = $LT[$i];
            $pricelistsub->Lining = $Lining[$i];
            $pricelistsub->Estradiol = $Estradiol[$i];
            $pricelistsub->Notes = $Notes[$i];
            $pricelistsub->save();
            
        }

        $OBUSNo=$request->OBUSNo;
        $OBUS=$request->OBUS;
        $Progesterone=$request->Progesterone;
        $NoSACS=$request->NoSACS;
        $NoFHT=$request->NoFHT;

        $N = count($OBUSNo);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new FreshFormLongProgs;
            $pricelistsub->FreshFormLongProsiD = $doclab_id; 
            $pricelistsub->OBUSNo = $OBUSNo[$i];
            $pricelistsub->OBUS = $OBUS[$i];
            $pricelistsub->Progesterone = $Progesterone[$i];
            $pricelistsub->NoSACS = $NoSACS[$i];
            $pricelistsub->NoFHT = $NoFHT[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/freshlongprotocol/'.$request->FreshFormId);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($PhaseId,$DocId)
    {
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join FreshPhases as st on st.patientid = p.id
                    WHERE st.id =".$PhaseId;
        $patients = DB::select($strsql);

        $strsql ="SELECT * from FreshFormLongPros
                    WHERE id =".$DocId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT doctordiagnosis.id,doctordiagnosis.description from FreshFormLongProDiags
                    INNER JOIN doctordiagnosis on doctordiagnosis.id = FreshFormLongProDiags.FertilityDiagnosisId
                    WHERE FreshFormLongProsiD =".$DocId;
        $DiagnosisSubs = DB::select($strsql);

        $strsql ="SELECT * from FreshFormLongProSubs
                    WHERE FreshFormLongProsiD =".$DocId;
        $FreshFormLongProSubs = DB::select($strsql);

        $strsql ="SELECT * from FreshFormLongProgs
                    WHERE FreshFormLongProsiD =".$DocId;
        $FreshFormLongProgs = DB::select($strsql);


        $doctorDiagnosis = DoctorDiagnosis::all();

        return view('freshlongpro.view',compact('patients','doctorDiagnosis','DocId','PhaseId','docresults','DiagnosisSubs','FreshFormLongProSubs','FreshFormLongProgs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($PhaseId,$DocId)
    {
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join FreshPhases as st on st.patientid = p.id
                    WHERE st.id =".$PhaseId;
        $patients = DB::select($strsql);

        $strsql ="SELECT * from FreshFormLongPros
                    WHERE id =".$DocId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT doctordiagnosis.id,doctordiagnosis.description from FreshFormLongProDiags
                    INNER JOIN doctordiagnosis on doctordiagnosis.id = FreshFormLongProDiags.FertilityDiagnosisId
                    WHERE FreshFormLongProsiD =".$DocId;
        $DiagnosisSubs = DB::select($strsql);

        $strsql ="SELECT * from FreshFormLongProSubs
                    WHERE FreshFormLongProsiD =".$DocId;
        $FreshFormLongProSubs = DB::select($strsql);

        $strsql ="SELECT * from FreshFormLongProgs
                    WHERE FreshFormLongProsiD =".$DocId;
        $FreshFormLongProgs = DB::select($strsql);


        $doctorDiagnosis = DoctorDiagnosis::all();

        return view('freshlongpro.edit',compact('patients','doctorDiagnosis','DocId','PhaseId','docresults','DiagnosisSubs','FreshFormLongProSubs','FreshFormLongProgs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $docfiles = FreshFormLongProtocol::find($request->DocId);
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->freshphasesiD = $request->FreshFormId;   
        $docfiles->Office= $request->Office;
        $docfiles->RetLoc= $request->RetLoc;
        $docfiles->CrySpermLoc= $request->CrySpermLoc;
        $docfiles->IVF= $request->IVF;
        $docfiles->OvDonor= $request->OvDonor;
        $docfiles->IVFwSur= $request->IVFwSur;

        $date = date_create($request->LupronStartDate);
        $docfiles->LupronStartDate= $date->format('Y-m-d');

        $docfiles->CD2= $request->CD2;
        $docfiles->IsConsent=$this->CheckCheckBox($request->IsConsent);
        $docfiles->CBC= $this->CheckCheckBox($request->CBC);
        $docfiles->FSH= $request->FSH;
        $docfiles->LongEstradiol= $request->LongEstradiol;
        $docfiles->AMH= $request->AMH;
        $docfiles->UterinePosition= $request->UterinePosition;
        $docfiles->Measurement= $request->Measurement;

        $date = date_create($request->LongProcDate);
        $docfiles->LongProcDate= $date->format('Y-m-d');

        $docfiles->IsWallace= $this->CheckCheckBox($request->IsWallace);
        $docfiles->Protocol= $request->Protocol;
        $docfiles->CD1Estradiol= $request->CD1Estradiol;
        $docfiles->CD1Prolactin= $request->CD1Prolactin;
        $docfiles->CD9Prolactin= $request->CD9Prolactin;
        $docfiles->Notes= $request->txtnotes;

        $date = date_create($request->HcgDate);
        $docfiles->HcgDate= $date->format('Y-m-d');

        $docfiles->HCGTime= $request->HCGTime;

        $date = date_create($request->ERDate);
        $docfiles->ERDate= $date->format('Y-m-d');

        $docfiles->ERTime= $request->ERTime;
        $docfiles->BloodType= $request->BloodType;

        $date = date_create($request->ETDate);
        $docfiles->ETDate= $date->format('Y-m-d');

        $docfiles->NoEmbryos= $request->NoEmbryos;
        $docfiles->NoTrans= $request->NoTrans;
        $docfiles->NoEggs= $request->NoEggs;
        $docfiles->NoCryo= $request->NoCryo;
        $docfiles->BetaNo1= $request->BetaNo1;

        $date = date_create($request->Beta1Date);
        $docfiles->Beta1Date= $date->format('Y-m-d');

        $docfiles->BetNo2= $request->BetNo2;

        $date = date_create($request->Beta2Date);
        $docfiles->Beta2Date= $date->format('Y-m-d');

        $docfiles->P4= $request->P4;
        $docfiles->ObGyn= $request->ObGyn;
        $docfiles->TelNo= $request->TelNo;
        $docfiles->Add= $request->Add; 

        $docfiles->createdbyid=Auth::user()->id;

        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('FreshFormLongProDiags')->where('FreshFormLongProsiD', $request->FreshFormId)->delete();

        $DiagnosisID=$request->DiagnosisID;

        $N = count($DiagnosisID);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new FreshFormLongDiag;
            $pricelistsub->FreshFormLongProsiD = $doclab_id; 
            $pricelistsub->FertilityDiagnosisId = $DiagnosisID[$i];
            $pricelistsub->save();
            
        }

        $sub = DB::table('FreshFormLongProSubs')->where('FreshFormLongProsiD', $request->FreshFormId)->delete();

        $CycleNo=$request->CDNo;
        $CycleDate=$request->CDDate;
        $RT=$request->RT;
        $LT=$request->LT;
        $Lining=$request->Lining;
        $Estradiol=$request->Estradiol;
        $Notes=$request->Notes;

        $N = count($CycleNo);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new FreshFormLongProSubs;
            $pricelistsub->FreshFormLongProsiD = $doclab_id; 
            $pricelistsub->CycleNo = $CycleNo[$i];

            $date = date_create($request->CycleDate[$i]);            
            $pricelistsub->CycleDate= $date->format('Y-m-d');

            $pricelistsub->UltrasoundRT = $RT[$i];
            $pricelistsub->UltrasoundLT = $LT[$i];
            $pricelistsub->Lining = $Lining[$i];
            $pricelistsub->Estradiol = $Estradiol[$i];
            $pricelistsub->Notes = $Notes[$i];
            $pricelistsub->save();
            
        }

        $sub = DB::table('FreshFormLongProgs')->where('FreshFormLongProsiD', $request->FreshFormId)->delete();
        
        $OBUSNo=$request->OBUSNo;
        $OBUS=$request->OBUS;
        $Progesterone=$request->Progesterone;
        $NoSACS=$request->NoSACS;
        $NoFHT=$request->NoFHT;

        $N = count($OBUSNo);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new FreshFormLongProgs;
            $pricelistsub->FreshFormLongProsiD = $doclab_id; 
            $pricelistsub->OBUSNo = $OBUSNo[$i];
            $pricelistsub->OBUS = $OBUS[$i];
            $pricelistsub->Progesterone = $Progesterone[$i];
            $pricelistsub->NoSACS = $NoSACS[$i];
            $pricelistsub->NoFHT = $NoFHT[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/freshlongprotocol/'.$request->FreshFormId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $leadassessment = FreshFormLongProtocol::destroy($request->del_id);

        return redirect()->to('/freshlongprotocol/'.$request->DocId);
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
