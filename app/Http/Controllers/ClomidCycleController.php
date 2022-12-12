<?php

namespace App\Http\Controllers;

use App\ClomidCyle;
use App\DoctorDiagnosis;
use App\ClomidCycleDiags;
use App\ClomidCycleNo;
use App\ClomidCycleObus;
use App\ClomidCycleSub;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClomidCycleController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Clomid Cycle";

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

    public function ClomidCycle($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from ClomidCycles 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('clomidcycle.patientindex',compact('docresult','patients','PatientId'));

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

        $doctorDiagnosis = DoctorDiagnosis::all();

        return view('clomidcycle.new',compact('patients','doctorDiagnosis','PatientId'));
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
        $docfiles = new ClomidCyle;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->LMPDAte = $request->LMPDAte;
        $docfiles->AMH= $request->AMH;
        $docfiles->FSH= $request->FSH;
        $docfiles->E2= $request->E2;

        $date = date_create($request->DateStartClomid);
        $docfiles->DateStartClomid= $date->format('Y-m-d');

        $docfiles->Clomidmg= $request->Clomidmg;
        $docfiles->ClomidXDays= $request->ClomidXDays;
        $docfiles->IsHCGInj= $this->CheckCheckBox($request->IsHCGInj);
        $docfiles->IsIntercourseIUI= $this->CheckCheckBox($request->IsIntercourseIUI);
        
        $date = date_create($request->ClomidConsendDate);            
        $docfiles->ClomidConsendDate= $date->format('Y-m-d');
        
        $date = date_create($request->HCGDate);            
        $docfiles->HCGDate= $date->format('Y-m-d');
        
        $docfiles->HCGTime= $request->HCGTime;
        $docfiles->BetaHCG1= $request->BetaHCG1;

        $date = date_create($request->Beta1HCGDate);            
        $docfiles->Beta1HCGDate= $date->format('Y-m-d');
        
        $docfiles->BetaHCG2= $request->BetaHCG2;
        
        $date = date_create($request->BetaHCG2Date);            
        $docfiles->BetaHCG2Date= $date->format('Y-m-d');

        $docfiles->Notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $ClomidNo = $request->ClomidNo;

        $N = count($ClomidNo);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new ClomidCycleNo;
            $pricelistsub->ClomidCyclesiD = $doclab_id; 
            $pricelistsub->ClomidNo = $ClomidNo[$i];
            $pricelistsub->save();
            
        }
        
        $DiagnosisID=$request->DiagnosisID;

        $N = count($DiagnosisID);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new ClomidCycleDiags;
            $pricelistsub->ClomidCyclesiD = $doclab_id; 
            $pricelistsub->DiagnosisId = $DiagnosisID[$i];
            $pricelistsub->save();
            
        }

        $CycleNo=$request->CDNo;
        $CycleDate=$request->CDDate;
        $RT=$request->RT;
        $LT=$request->LT;
        $Lining=$request->Lining;

        $N = count($CycleNo);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new ClomidCycleSub;
            $pricelistsub->ClomidCyclesiD = $doclab_id; 
            $pricelistsub->CycleNo = $CycleNo[$i];

            $date = date_create($request->CycleDate[$i]);            
            $pricelistsub->CycleDate= $date->format('Y-m-d');

            $pricelistsub->RT = $RT[$i];
            $pricelistsub->LT = $LT[$i];
            $pricelistsub->Lining = $Lining[$i];
            $pricelistsub->save();
            
        }

        $OBUSWeeksSac=$request->OBUSWeeksSac;
        $FHT=$request->FHT;
        $P4=$request->P4;
        $ClomidCycleDate=$request->ClomidCycleDate;

        $N = count($OBUSWeeksSac);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new ClomidCycleObus;
            $pricelistsub->ClomidCyclesiD = $doclab_id; 
            $pricelistsub->OBUSWeeksSac = $OBUSWeeksSac[$i];

            $date = date_create($request->ClomidCycleDate[$i]);            
            $pricelistsub->ClomidCycleDate= $date->format('Y-m-d');

            $pricelistsub->FHT = $FHT[$i];
            $pricelistsub->P4 = $P4[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/clomidcycle/'.$request->txtpatientId);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClomidCyle  $clomidCyle
     * @return \Illuminate\Http\Response
     */
    public function show($DocId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join ClomidCycles as cc on cc.patientid = p.id
                    WHERE cc.id =".$DocId;
        $patients = DB::select($strsql);

        $doctorDiagnosis = DoctorDiagnosis::all();

        $strsql ="SELECT * from ClomidCycles
                    WHERE id =".$DocId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT doctordiagnosis.id,doctordiagnosis.description from ClomidCyleDiags
                    INNER JOIN doctordiagnosis on doctordiagnosis.id = ClomidCyleDiags.DiagnosisId
                    WHERE ClomidCyclesiD =".$DocId;
        $DiagnosisSubs = DB::select($strsql);

        $strsql ="SELECT * from ClomidCycleNo
                    WHERE ClomidCyclesiD =".$DocId;
        $ClomidCycleNos = DB::select($strsql);

        $strsql ="SELECT * from ClomidCycleSubs
                    WHERE ClomidCyclesiD =".$DocId;
        $ClomidCycleSubs = DB::select($strsql);

        $strsql ="SELECT * from ClomidCycleObus
                    WHERE ClomidCyclesiD =".$DocId;
        $ClomidCycleObus = DB::select($strsql);

        return view('clomidcycle.view',compact('patients','docresults','doctorDiagnosis','DocId','DiagnosisSubs','ClomidCycleNos','ClomidCycleSubs','ClomidCycleObus'));
    }

    public function PrintClomidCycle($DocId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join ClomidCycles as cc on cc.patientid = p.id
                    WHERE cc.id =".$DocId;
        $patients = DB::select($strsql);

        $doctorDiagnosis = DoctorDiagnosis::all();

        $strsql ="SELECT * from ClomidCycles
                    WHERE id =".$DocId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT doctordiagnosis.id,doctordiagnosis.description from ClomidCyleDiags
                    INNER JOIN doctordiagnosis on doctordiagnosis.id = ClomidCyleDiags.DiagnosisId
                    WHERE ClomidCyclesiD =".$DocId;
        $DiagnosisSubs = DB::select($strsql);

        $strsql ="SELECT * from ClomidCycleNo
                    WHERE ClomidCyclesiD =".$DocId;
        $ClomidCycleNos = DB::select($strsql);

        $strsql ="SELECT * from ClomidCycleSubs
                    WHERE ClomidCyclesiD =".$DocId;
        $ClomidCycleSubs = DB::select($strsql);

        $strsql ="SELECT * from ClomidCycleObus
                    WHERE ClomidCyclesiD =".$DocId;
        $ClomidCycleObus = DB::select($strsql);

        return view('clomidcycle.print',compact('patients','docresults','doctorDiagnosis','DocId','DiagnosisSubs','ClomidCycleNos','ClomidCycleSubs','ClomidCycleObus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClomidCyle  $clomidCyle
     * @return \Illuminate\Http\Response
     */
    public function edit($DocId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join ClomidCycles as cc on cc.patientid = p.id
                    WHERE cc.id =".$DocId;
        $patients = DB::select($strsql);

        $doctorDiagnosis = DoctorDiagnosis::all();

        $strsql ="SELECT * from ClomidCycles
                    WHERE id =".$DocId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT doctordiagnosis.id,doctordiagnosis.description from ClomidCyleDiags
                    INNER JOIN doctordiagnosis on doctordiagnosis.id = ClomidCyleDiags.DiagnosisId
                    WHERE ClomidCyclesiD =".$DocId;
        $DiagnosisSubs = DB::select($strsql);

        $strsql ="SELECT * from ClomidCycleNo
                    WHERE ClomidCyclesiD =".$DocId;
        $ClomidCycleNos = DB::select($strsql);

        $strsql ="SELECT * from ClomidCycleSubs
                    WHERE ClomidCyclesiD =".$DocId;
        $ClomidCycleSubs = DB::select($strsql);

        $strsql ="SELECT * from ClomidCycleObus
                    WHERE ClomidCyclesiD =".$DocId;
        $ClomidCycleObus = DB::select($strsql);

        return view('clomidcycle.edit',compact('patients','docresults','doctorDiagnosis','DocId','DiagnosisSubs','ClomidCycleNos','ClomidCycleSubs','ClomidCycleObus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClomidCyle  $clomidCyle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $docfiles = ClomidCyle::find($request->DocId);
        $docfiles->LMPDAte = $request->LMPDAte;
        $docfiles->AMH= $request->AMH;
        $docfiles->FSH= $request->FSH;
        $docfiles->E2= $request->E2;

        $date = date_create($request->DateStartClomid);
        $docfiles->DateStartClomid= $date->format('Y-m-d');

        $docfiles->Clomidmg= $request->Clomidmg;
        $docfiles->ClomidXDays= $request->ClomidXDays;
        $docfiles->IsHCGInj= $this->CheckCheckBox($request->IsHCGInj);
        $docfiles->IsIntercourseIUI= $this->CheckCheckBox($request->IsIntercourseIUI);
        
        $date = date_create($request->ClomidConsendDate);            
        $docfiles->ClomidConsendDate= $date->format('Y-m-d');
        
        $date = date_create($request->HCGDate);            
        $docfiles->HCGDate= $date->format('Y-m-d');
        
        $docfiles->HCGTime= $request->HCGTime;
        $docfiles->BetaHCG1= $request->BetaHCG1;

        $date = date_create($request->Beta1HCGDate);            
        $docfiles->Beta1HCGDate= $date->format('Y-m-d');
        
        $docfiles->BetaHCG2= $request->BetaHCG2;
        
        $date = date_create($request->BetaHCG2Date);            
        $docfiles->BetaHCG2Date= $date->format('Y-m-d');

        $docfiles->Notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('ClomidCycleNo')->where('ClomidCyclesiD', $request->DocId)->delete();

        $ClomidNo = $request->ClomidNo;

        $N = count($ClomidNo);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new ClomidCycleNo;
            $pricelistsub->ClomidCyclesiD = $doclab_id; 
            $pricelistsub->ClomidNo = $ClomidNo[$i];
            $pricelistsub->save();
            
        }
        

        $sub = DB::table('ClomidCyleDiags')->where('ClomidCyclesiD', $request->DocId)->delete();

        $DiagnosisID=$request->DiagnosisID;

        $N = count($DiagnosisID);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new ClomidCycleDiags;
            $pricelistsub->ClomidCyclesiD = $doclab_id; 
            $pricelistsub->DiagnosisId = $DiagnosisID[$i];
            $pricelistsub->save();
            
        }

        $sub = DB::table('ClomidCycleSubs')->where('ClomidCyclesiD', $request->DocId)->delete();

        $CycleNo=$request->CDNo;
        $CycleDate=$request->CDDate;
        $RT=$request->RT;
        $LT=$request->LT;
        $Lining=$request->Lining;

        $N = count($CycleNo);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new ClomidCycleSub;
            $pricelistsub->ClomidCyclesiD = $doclab_id; 
            $pricelistsub->CycleNo = $CycleNo[$i];

            $date = date_create($request->CycleDate[$i]);            
            $pricelistsub->CycleDate= $date->format('Y-m-d');

            $pricelistsub->RT = $RT[$i];
            $pricelistsub->LT = $LT[$i];
            $pricelistsub->Lining = $Lining[$i];
            $pricelistsub->save();
            
        }


        $sub = DB::table('ClomidCycleObus')->where('ClomidCyclesiD', $request->DocId)->delete();


        $OBUSWeeksSac=$request->OBUSWeeksSac;
        $FHT=$request->FHT;
        $P4=$request->P4;
        $ClomidCycleDate=$request->ClomidCycleDate;

        $N = count($OBUSWeeksSac);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new ClomidCycleObus;
            $pricelistsub->ClomidCyclesiD = $doclab_id; 
            $pricelistsub->OBUSWeeksSac = $OBUSWeeksSac[$i];

            $date = date_create($request->ClomidCycleDate[$i]);            
            $pricelistsub->ClomidCycleDate= $date->format('Y-m-d');

            $pricelistsub->FHT = $FHT[$i];
            $pricelistsub->P4 = $P4[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/clomidcycle/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClomidCyle  $clomidCyle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $leadassessment = ClomidCyle::destroy($request->del_id);

        return redirect()->to('/clomidcycle/'.$request->intPatientId);
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
