<?php

namespace App\Http\Controllers;

use App\FreshFormCyclePage2;
use App\DoctorDiagnosis;
use App\FreshFormCycleFerDias;
use App\FreshFormCyclePage2Subs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FreshFormPage2Controller extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Short Protocol";

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

    public function FreshFormPage2($DocId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join FreshPhases as st on st.patientid = p.id
                    WHERE st.id =".$DocId;
        $patients = DB::select($strsql);

        $strsql ="select * from FreshFormCyclePage2s 
                  where FreshFormsiD =".$DocId;
        $docresult = DB::select($strsql);

        return view('freshpage2.patientindex',compact('docresult','patients','DocId'));
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

        return view('freshpage2.new',compact('patients','doctorDiagnosis','DocId'));
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

        $docfiles = new FreshFormCyclePage2;

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->FreshFormsiD = $request->FreshFormId;
        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');
        $docfiles->ICSI = $request->ICSI;
        $docfiles->EggFreezing = $request->EggFreezing;
        $docfiles->CD2 = $request->CD2;
        $docfiles->IsConsent = $this->CheckCheckBox($request->IsConsent);
        $docfiles->Protocol = $request->Protocol;
        $docfiles->FSH = $request->FSH;
        $docfiles->Estradiol = $request->txtEstradiol;
        $docfiles->UterinePosition = $request->UterinePosition;
        $docfiles->AMH = $request->AMH;

        $docfiles->IsCBC = $this->CheckCheckBox($request->IsCBC);

        $date = date_create($request->CBCDate);
        $docfiles->CBCDate= $date->format('Y-m-d');

        $docfiles->Measurement = $request->Measurement;

        $docfiles->WallaceYesNo = $this->CheckCheckBox($request->WallaceYesNo);

        $docfiles->Notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $DiagnosisID=$request->DiagnosisID;

        $N = count($DiagnosisID);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new FreshFormCycleFerDias;
            $pricelistsub->FreshFormCyclePage2siD = $doclab_id; 
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
            $pricelistsub = new FreshFormCyclePage2Subs;
            $pricelistsub->FreshFormCyclePage2siD = $doclab_id; 
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

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/freshshortprotocol/'.$request->FreshFormId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FreshFormCyclePage2  $freshFormCyclePage2
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

        $strsql ="SELECT * from FreshFormCyclePage2s
                    WHERE id =".$DocId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT doctordiagnosis.id,doctordiagnosis.description from FreshFormCycleFerDias
                    INNER JOIN doctordiagnosis on doctordiagnosis.id = FreshFormCycleFerDias.FertilityDiagnosisId
                    WHERE FreshFormCyclePage2siD =".$DocId;
        $FETPage2DiagnosisSubs = DB::select($strsql);

        $strsql ="SELECT * from FreshFormCyclePage2Subs
                    WHERE FreshFormCyclePage2siD =".$DocId;
        $FETPage2CDSubs = DB::select($strsql);


        $doctorDiagnosis = DoctorDiagnosis::all();

        return view('freshpage2.view',compact('patients','doctorDiagnosis','DocId','PhaseId','docresults','FETPage2DiagnosisSubs','FETPage2CDSubs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FreshFormCyclePage2  $freshFormCyclePage2
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

        $strsql ="SELECT * from FreshFormCyclePage2s
                    WHERE id =".$DocId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT doctordiagnosis.id,doctordiagnosis.description from FreshFormCycleFerDias
                    INNER JOIN doctordiagnosis on doctordiagnosis.id = FreshFormCycleFerDias.FertilityDiagnosisId
                    WHERE FreshFormCyclePage2siD =".$DocId;
        $FETPage2DiagnosisSubs = DB::select($strsql);

        $strsql ="SELECT * from FreshFormCyclePage2Subs
                    WHERE FreshFormCyclePage2siD =".$DocId;
        $FETPage2CDSubs = DB::select($strsql);


        $doctorDiagnosis = DoctorDiagnosis::all();

        return view('freshpage2.edit',compact('patients','doctorDiagnosis','DocId','PhaseId','docresults','FETPage2DiagnosisSubs','FETPage2CDSubs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FreshFormCyclePage2  $freshFormCyclePage2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $docfiles = FreshFormCyclePage2::find($request->FreshFormId);

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');
        $docfiles->ICSI = $request->ICSI;
        $docfiles->EggFreezing = $request->EggFreezing;
        $docfiles->CD2 = $request->CD2;
        $docfiles->IsConsent = $this->CheckCheckBox($request->IsConsent);
        $docfiles->Protocol = $request->Protocol;
        $docfiles->FSH = $request->FSH;
        $docfiles->Estradiol = $request->txtEstradiol;
        $docfiles->UterinePosition = $request->UterinePosition;
        $docfiles->AMH = $request->AMH;

        $docfiles->IsCBC = $this->CheckCheckBox($request->IsCBC);

        $date = date_create($request->CBCDate);
        $docfiles->CBCDate= $date->format('Y-m-d');

        $docfiles->Measurement = $request->Measurement;

        $docfiles->WallaceYesNo = $this->CheckCheckBox($request->WallaceYesNo);

        $docfiles->Notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('FreshFormCycleFerDias')->where('FreshFormCyclePage2siD', $request->FreshFormId)->delete();

        $DiagnosisID=$request->DiagnosisID;

        $N = count($DiagnosisID);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new FreshFormCycleFerDias;
            $pricelistsub->FreshFormCyclePage2siD = $doclab_id; 
            $pricelistsub->FertilityDiagnosisId = $DiagnosisID[$i];
            $pricelistsub->save();
            
        }

        $sub = DB::table('FreshFormCyclePage2Subs')->where('FreshFormCyclePage2siD', $request->FreshFormId)->delete();

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
            $pricelistsub = new FreshFormCyclePage2Subs;
            $pricelistsub->FreshFormCyclePage2siD = $doclab_id; 
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

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/freshshortprotocol/'.$request->FreshFormId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FreshFormCyclePage2  $freshFormCyclePage2
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $leadassessment = FreshFormCyclePage2::destroy($request->del_id);

        return redirect()->to('/freshshortprotocol/'.$request->DocId);
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
