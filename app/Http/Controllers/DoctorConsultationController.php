<?php

namespace App\Http\Controllers;

use App\FemaleDoctorConsulatation;
use App\MaleDoctorConsultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DoctorConsultationController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Doctor Consulatation";
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

    public function DoctorConsultation($PatientId){
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from femaledoctorsconsultation 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        $strsql ="select * from maledoctorconsultations 
                  where patientid =".$PatientId;
        $docresultmale = DB::select($strsql);

        return view('doctorconsultation.patientindex',compact('docresult','patients','docresultmale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createfemale($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        return view('doctorconsultation.new_female',compact('patients'));
    }

    public function createmale($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        return view('doctorconsultation.new_male',compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storefemale(Request $request)
    {
        //
        //
        $imagepath = "";

        if ($files = $request->file('inputFile')) {
        // Define upload path
           $destinationPath = public_path('/file/'); // upload path
        // Upload Orginal Image           
           $imagepath = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $imagepath);
       }

        $docfiles = new FemaleDoctorConsulatation;

        $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->IsSingle = $this->CheckCheckBox($request->IsSingle);
        $docfiles->IsMarried = $this->CheckCheckBox($request->IsMarried);
        $docfiles->IsDivorced = $this->CheckCheckBox($request->IsDivorced);
        $docfiles->IsWidow = $this->CheckCheckBox($request->IsWidow);
        $docfiles->NoOfChildren = $request->NoOfChildren;
        $docfiles->WorkStatusYes = $this->CheckCheckBox($request->WorkStatusYes);
        $docfiles->WorkStatusNo = $this->CheckCheckBox($request->WorkStatusNo);
        $docfiles->WorkStatusSpecify = $request->WorkStatusSpecify;
        $docfiles->AlcoholIntakeYes = $this->CheckCheckBox($request->AlcoholIntakeYes);
        $docfiles->AlcoholIntakeNo = $this->CheckCheckBox($request->AlcoholIntakeNo);
        $docfiles->AlcoholIntakeSpecify = $request->AlcoholIntakeSpecify;
        $docfiles->SmokingYes = $this->CheckCheckBox($request->SmokingYes);
        $docfiles->SmokingNo = $this->CheckCheckBox($request->SmokingNo);
        $docfiles->SmokingSpecify = $request->SmokingSpecify;
        $docfiles->SubstanceYes = $this->CheckCheckBox($request->SubstanceYes);
        $docfiles->SubstanceNo = $this->CheckCheckBox($request->SubstanceNo);
        $docfiles->SubstanceSpecify = $request->SubstanceSpecify;

        $date = date_create($request->LastMenstualPeriod);
        $docfiles->LastMenstualPeriod= $date->format('Y-m-d');

        $docfiles->LastMenstualPeriodSpecify = $request->LastMenstualPeriodSpecify;
        $docfiles->PregnantYes = $this->CheckCheckBox($request->PregnantYes);
        $docfiles->PregnantNo = $this->CheckCheckBox($request->PregnantNo);
        $docfiles->PregnantSpecify = $request->PregnantSpecify;
        $docfiles->BreastFeedingYes = $this->CheckCheckBox($request->BreastFeedingYes);
        $docfiles->BreastFeedingNo = $this->CheckCheckBox($request->BreastFeedingNo);
        $docfiles->AgeStartPeriod = $request->AgeStartPeriod;
        $docfiles->PeriodAbsent = $this->CheckCheckBox($request->PeriodAbsent);
        $docfiles->PeriodRegular = $this->CheckCheckBox($request->PeriodRegular);
        $docfiles->PeriodLight = $this->CheckCheckBox($request->PeriodLight);
        $docfiles->PeriodHeavy = $this->CheckCheckBox($request->PeriodHeavy);
        $docfiles->PeriodSpottingBefore = $this->CheckCheckBox($request->PeriodSpottingBefore);
        $docfiles->PeriodSpottingBetween = $this->CheckCheckBox($request->PeriodSpottingBetween);
        $docfiles->PeriodIrregular = $this->CheckCheckBox($request->PeriodIrregular);
        $docfiles->PeriodIrregularSpecify = $request->PeriodIrregularSpecify;
        $docfiles->SevereCrampingYes = $this->CheckCheckBox($request->SevereCrampingYes);
        $docfiles->SevereCrampingNo = $this->CheckCheckBox($request->SevereCrampingNo);
        $docfiles->SevereCrampingSpecify = $request->SevereCrampingSpecify;
        $docfiles->PainScaleScore = $request->PainScaleScore;
        $docfiles->PreHisConceivedYear = $request->PreHisConceivedYear;
        $docfiles->PreHisLongConceived = $request->PreHisLongConceived;
        $docfiles->PreHisNorDelCSecMisc = $request->PreHisNorDelCSecMisc;
        $docfiles->PreHisFerTreaUsed = $request->PreHisFerTreaUsed;

        $docfiles->SexHisCountOvuKitYes = $this->CheckCheckBox($request->SexHisCountOvuKitYes);
        $docfiles->SexHisCountOvuKitNo = $this->CheckCheckBox($request->SexHisCountOvuKitNo);
        $docfiles->SexHisPainInterYes = $this->CheckCheckBox($request->SexHisPainInterYes);
        $docfiles->SexHisPainInterNo = $this->CheckCheckBox($request->SexHisPainInterNo);
        $docfiles->SexHisUseContraceptiveYes = $this->CheckCheckBox($request->SexHisUseContraceptiveYes);
        $docfiles->SexHisUseContraceptiveNo = $this->CheckCheckBox($request->SexHisUseContraceptiveNo);  
        $docfiles->SexHisUseContraceptiveSpecify = $request->SexHisUseContraceptiveSpecify;
        $docfiles->SexHisChlamydia = $this->CheckCheckBox($request->SexHisChlamydia);  
        $docfiles->SexHisGonorrhea = $this->CheckCheckBox($request->SexHisGonorrhea);  
        $docfiles->SexHisSyphilis = $this->CheckCheckBox($request->SexHisSyphilis);  
        $docfiles->SexHisGenitalWartsHPV = $this->CheckCheckBox($request->SexHisGenitalWartsHPV);   
        $docfiles->SexHisHepatitis = $this->CheckCheckBox($request->SexHisHepatitis);   
        $docfiles->SexHisHerpes = $this->CheckCheckBox($request->SexHisHerpes);   
        $docfiles->SexHisHIVAIDS = $this->CheckCheckBox($request->SexHisHIVAIDS);   
        $docfiles->SexHisPID = $this->CheckCheckBox($request->SexHisPID);   
        $docfiles->SexHisUTI = $this->CheckCheckBox($request->SexHisUTI);   
        $docfiles->SexHiTransmittedDeasesSpecify = $request->SexHiTransmittedDeasesSpecify;
        $docfiles->MedHisChroMedConYes = $this->CheckCheckBox($request->MedHisChroMedConYes);
        $docfiles->MedHisChroMedConNo = $this->CheckCheckBox($request->MedHisChroMedConNo);
        $docfiles->MedHisChroMedConSpecify = $request->MedHisChroMedConSpecify;
        $docfiles->InMedicationYes = $this->CheckCheckBox($request->InMedicationYes);
        $docfiles->InMedicationNo = $this->CheckCheckBox($request->InMedicationNo);
        $docfiles->InMedicationSpecify = $request->InMedicationSpecify;
        $docfiles->IntakeAspirinYes = $this->CheckCheckBox($request->IntakeAspirinYes);
        $docfiles->IntakeAspirinNo = $this->CheckCheckBox($request->IntakeAspirinNo);
        $docfiles->IntakeAspirinSpecify = $request->IntakeAspirinSpecify;
        $docfiles->FoodAllergyYes = $this->CheckCheckBox($request->FoodAllergyYes);
        $docfiles->FoodAllergyNo = $this->CheckCheckBox($request->FoodAllergyNo);
        $docfiles->FoodAllergySpecify = $request->FoodAllergySpecify;
        $docfiles->MedAllergyYes = $this->CheckCheckBox($request->MedAllergyYes);
        $docfiles->MedAllergyNo = $this->CheckCheckBox($request->MedAllergyNo);
        $docfiles->MedAllergySpecify = $request->MedAllergySpecify;
        $docfiles->SurHisSurgery = $request->SurHisSurgery;

        $date = date_create($request->SurHisSurgeryDate);
        $docfiles->SurHisSurgeryDate= $date->format('Y-m-d');

        $docfiles->SurHisComplication = $request->SurHisComplication;
        $docfiles->SurHisProbAnesthesiaYes = $this->CheckCheckBox($request->SurHisProbAnesthesiaYes);
        $docfiles->SurHisProbAnesthesiaNo = $this->CheckCheckBox($request->SurHisProbAnesthesiaNo);
        $docfiles->SurHisProbAnesthesiaSpecify = $request->SurHisProbAnesthesiaSpecify;

        $docfiles->FamHisFamMedConDiabetesMellitus = $this->CheckCheckBox($request->FamHisFamMedConDiabetesMellitus);
        $docfiles->FamHisFamMedConHighBlood = $this->CheckCheckBox($request->FamHisFamMedConHighBlood);
        $docfiles->FamHisFamMedConCancer = $this->CheckCheckBox($request->FamHisFamMedConCancer);
        $docfiles->FamHisFamMedConHighOthers =$request->FamHisFamMedConHighOthers;

        $docfiles->PriorFerTreatYes = $this->CheckCheckBox($request->PriorFerTreatYes);
        $docfiles->PriorFerTreatNo = $this->CheckCheckBox($request->PriorFerTreatNo);

        $docfiles->PriorFerTreatCioNatInter = $this->CheckCheckBox($request->PriorFerTreatCioNatInter);
        $docfiles->PriorFerTreatCioInse = $this->CheckCheckBox($request->PriorFerTreatCioInse);
        $docfiles->PriorFerTreatVitFer = $this->CheckCheckBox($request->PriorFerTreatVitFer);
        $docfiles->PriorFerTreatInjMedNatInt = $this->CheckCheckBox($request->PriorFerTreatInjMedNatInt);
        $docfiles->PriorFerTreatInjMedIns = $this->CheckCheckBox($request->PriorFerTreatInjMedIns);
        $docfiles->PriorFerTreatFroEmbrTran = $this->CheckCheckBox($request->PriorFerTreatFroEmbrTran);
        $docfiles->PriorFerTreatHSG = $this->CheckCheckBox($request->PriorFerTreatHSG);
        $docfiles->PriorFerTreatOthers = $request->PriorFerTreatOthers;

        $docfiles->Notes = $request->Notes;

        $docfiles->filelink = '/file/'.$imagepath;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);

        return redirect()->to('/doctorconsultation/'.$request->txtpatientId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storemale(Request $request)
    {
        //
        //
        $imagepath = "";

        if ($files = $request->file('inputFile')) {
        // Define upload path
           $destinationPath = public_path('/file/'); // upload path
        // Upload Orginal Image           
           $imagepath = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $imagepath);
       }

        $docfiles = new MaleDoctorConsultation;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->SocHisSingle = $this->CheckCheckBox($request->SocHisSingle);
        $docfiles->SocHisMarried = $this->CheckCheckBox($request->SocHisMarried);
        $docfiles->SocHisDivorced = $this->CheckCheckBox($request->SocHisDivorced);
        $docfiles->SocHisWidow = $this->CheckCheckBox($request->SocHisWidow);
        $docfiles->SocHisNoOfChildren = $request->SocHisNoOfChildren;
        $docfiles->SocHisWorkingStatusYes = $this->CheckCheckBox($request->SocHisWorkingStatusYes);
        $docfiles->SocHisWorkingStatusNo = $this->CheckCheckBox($request->SocHisWorkingStatusNo);
        $docfiles->SocHisWorkingSpecify = $request->SocHisWorkingSpecify;
        $docfiles->SocHisAlcoholIntakeYes = $this->CheckCheckBox($request->SocHisAlcoholIntakeYes);
        $docfiles->SocHisAlcoholIntakeNo = $this->CheckCheckBox($request->SocHisAlcoholIntakeNo);
        $docfiles->SocHisSmokingYes = $this->CheckCheckBox($request->SocHisSmokingYes);
        $docfiles->SocHisSmokingNo = $this->CheckCheckBox($request->SocHisSmokingNo);
        $docfiles->SocHisSubsAbuseYes = $this->CheckCheckBox($request->SocHisSubsAbuseYes);
        $docfiles->SocHisSubsAbuseNo = $this->CheckCheckBox($request->SocHisSubsAbuseNo);
        $docfiles->FamHisMedConDiaMille = $this->CheckCheckBox($request->FamHisMedConDiaMille);
        $docfiles->FamHisMedConHigbBlood = $this->CheckCheckBox($request->FamHisMedConHigbBlood);
        $docfiles->FamHisMedConCancer = $this->CheckCheckBox($request->FamHisMedConCancer);
        $docfiles->FamHisMedConOthers = $request->FamHisMedConOthers;
        $docfiles->MedHisSemAnaYes = $this->CheckCheckBox($request->MedHisSemAnaYes);
        $docfiles->MedHisSemAnaNo = $this->CheckCheckBox($request->MedHisSemAnaNo);
        $docfiles->MedHisRetroEjaYes = $this->CheckCheckBox($request->MedHisRetroEjaYes);
        $docfiles->MedHisRetroEjaNo = $this->CheckCheckBox($request->MedHisRetroEjaNo);
        $docfiles->MedHisExpRadHarChemYes = $this->CheckCheckBox($request->MedHisExpRadHarChemYes);
        $docfiles->MedHisExpRadHarChemNo = $this->CheckCheckBox($request->MedHisExpRadHarChemNo);
        $docfiles->MedHisExpRadHarChemSpecify = $request->MedHisExpRadHarChemSpecify;
        $docfiles->MedHisChroMedConYes = $this->CheckCheckBox($request->MedHisChroMedConYes);
        $docfiles->MedHisChroMedConNo = $this->CheckCheckBox($request->MedHisChroMedConNo);
        $docfiles->MedHisChroMedConSpecify = $request->MedHisChroMedConSpecify;
        $docfiles->MedHisCurMed = $request->MedHisCurMed;
        $docfiles->MedHisOvCouHerMedYes = $this->CheckCheckBox($request->MedHisOvCouHerMedYes);
        $docfiles->MedHisOvCouHerMedNo = $this->CheckCheckBox($request->MedHisOvCouHerMedNo);
        $docfiles->MedHisOvCouHerMedSpecify = $request->MedHisOvCouHerMedSpecify;
        $docfiles->MedHisAllerFoodNonKnown = $this->CheckCheckBox($request->MedHisAllerFoodNonKnown);
        $docfiles->MedHisAllerFoodYes = $this->CheckCheckBox($request->MedHisAllerFoodYes);
        $docfiles->MedHisAllerFoodSpecify = $request->MedHisAllerFoodSpecify;
        $docfiles->MedHisAllerMedNonKnown = $this->CheckCheckBox($request->MedHisAllerMedNonKnown);
        $docfiles->MedHisAllerMedYes = $this->CheckCheckBox($request->MedHisAllerMedYes);
        $docfiles->MedHisAllerMedSpecify = $request->MedHisAllerMedSpecify;
        $docfiles->SexHisChlamydi = $this->CheckCheckBox($request->SexHisChlamydi);
        $docfiles->SexHisGonorrhea = $this->CheckCheckBox($request->SexHisGonorrhea);
        $docfiles->SexHisSyphilis = $this->CheckCheckBox($request->SexHisSyphilis);
        $docfiles->SexHisGenWartsHPV = $this->CheckCheckBox($request->SexHisGenWartsHPV);
        $docfiles->SexHisHepatitis = $this->CheckCheckBox($request->SexHisHepatitis);
        $docfiles->SexHisHerpes = $this->CheckCheckBox($request->SexHisHerpes);
        $docfiles->SexHisHIVAIDS = $this->CheckCheckBox($request->SexHisHIVAIDS);
        $docfiles->SexHisPIV = $this->CheckCheckBox($request->SexHisPIV);
        $docfiles->SexHisOthers = $request->SexHisOthers;
        $docfiles->SurHisTypeSurgery = $request->SurHisTypeSurgery;
        $docfiles->SurHisWhen = $request->SurHisWhen;
        $docfiles->SurHisComplication = $request->SurHisComplication;

        $docfiles->Notes = $request->Notes;

        $docfiles->filelink = '/file/'.$imagepath;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);

        return redirect()->to('/doctorconsultation/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showfemale($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join femaledoctorsconsultation as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients  = DB::select($strsql);

        $strsql ="select * from femaledoctorsconsultation 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        return view('doctorconsultation.view_female',compact('patients','docresults'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showmale($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join maledoctorconsultations as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients  = DB::select($strsql);

        $strsql ="select * from maledoctorconsultations 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        return view('doctorconsultation.view_male',compact('patients','docresults'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editfemale($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join femaledoctorsconsultation as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from femaledoctorsconsultation 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        return view('doctorconsultation.edit_female',compact('docresults','patients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editmale($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join maledoctorconsultations as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from maledoctorconsultations 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        return view('doctorconsultation.edit_male',compact('docresults','patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatefemale(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from femaledoctorsconsultation where id=".$request->txtFemaleDoctorConsultationId;
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

       $docfiles = FemaleDoctorConsulatation::find($request->txtMaleDoctorConsultationId);
       $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->IsSingle = $this->CheckCheckBox($request->IsSingle);
        $docfiles->IsMarried = $this->CheckCheckBox($request->IsMarried);
        $docfiles->IsDivorced = $this->CheckCheckBox($request->IsDivorced);
        $docfiles->IsWidow = $this->CheckCheckBox($request->IsWidow);
        $docfiles->NoOfChildren = $request->NoOfChildren;
        $docfiles->WorkStatusYes = $this->CheckCheckBox($request->WorkStatusYes);
        $docfiles->WorkStatusNo = $this->CheckCheckBox($request->WorkStatusNo);
        $docfiles->WorkStatusSpecify = $request->WorkStatusSpecify;
        $docfiles->AlcoholIntakeYes = $this->CheckCheckBox($request->AlcoholIntakeYes);
        $docfiles->AlcoholIntakeNo = $this->CheckCheckBox($request->AlcoholIntakeNo);
        $docfiles->AlcoholIntakeSpecify = $request->AlcoholIntakeSpecify;
        $docfiles->SmokingYes = $this->CheckCheckBox($request->SmokingYes);
        $docfiles->SmokingNo = $this->CheckCheckBox($request->SmokingNo);
        $docfiles->SmokingSpecify = $request->SmokingSpecify;
        $docfiles->SubstanceYes = $this->CheckCheckBox($request->SubstanceYes);
        $docfiles->SubstanceNo = $this->CheckCheckBox($request->SubstanceNo);
        $docfiles->SubstanceSpecify = $request->SubstanceSpecify;

        $date = date_create($request->LastMenstualPeriod);
        $docfiles->LastMenstualPeriod= $date->format('Y-m-d');

        $docfiles->LastMenstualPeriodSpecify = $request->LastMenstualPeriodSpecify;
        $docfiles->PregnantYes = $this->CheckCheckBox($request->PregnantYes);
        $docfiles->PregnantNo = $this->CheckCheckBox($request->PregnantNo);
        $docfiles->PregnantSpecify = $request->PregnantSpecify;
        $docfiles->BreastFeedingYes = $this->CheckCheckBox($request->BreastFeedingYes);
        $docfiles->BreastFeedingNo = $this->CheckCheckBox($request->BreastFeedingNo);
        $docfiles->AgeStartPeriod = $request->AgeStartPeriod;
        $docfiles->PeriodAbsent = $this->CheckCheckBox($request->PeriodAbsent);
        $docfiles->PeriodRegular = $this->CheckCheckBox($request->PeriodRegular);
        $docfiles->PeriodLight = $this->CheckCheckBox($request->PeriodLight);
        $docfiles->PeriodHeavy = $this->CheckCheckBox($request->PeriodHeavy);
        $docfiles->PeriodSpottingBefore = $this->CheckCheckBox($request->PeriodSpottingBefore);
        $docfiles->PeriodSpottingBetween = $this->CheckCheckBox($request->PeriodSpottingBetween);
        $docfiles->PeriodIrregular = $this->CheckCheckBox($request->PeriodIrregular);
        $docfiles->PeriodIrregularSpecify = $request->PeriodIrregularSpecify;
        $docfiles->SevereCrampingYes = $this->CheckCheckBox($request->SevereCrampingYes);
        $docfiles->SevereCrampingNo = $this->CheckCheckBox($request->SevereCrampingNo);
        $docfiles->SevereCrampingSpecify = $request->SevereCrampingSpecify;
        $docfiles->PainScaleScore = $request->PainScaleScore;
        $docfiles->PreHisConceivedYear = $request->PreHisConceivedYear;
        $docfiles->PreHisLongConceived = $request->PreHisLongConceived;
        $docfiles->PreHisNorDelCSecMisc = $request->PreHisNorDelCSecMisc;
        $docfiles->PreHisFerTreaUsed = $request->PreHisFerTreaUsed;

        $docfiles->SexHisCountOvuKitYes = $this->CheckCheckBox($request->SexHisCountOvuKitYes);
        $docfiles->SexHisCountOvuKitNo = $this->CheckCheckBox($request->SexHisCountOvuKitNo);
        $docfiles->SexHisPainInterYes = $this->CheckCheckBox($request->SexHisPainInterYes);
        $docfiles->SexHisPainInterNo = $this->CheckCheckBox($request->SexHisPainInterNo);
        $docfiles->SexHisUseContraceptiveYes = $this->CheckCheckBox($request->SexHisUseContraceptiveYes);
        $docfiles->SexHisUseContraceptiveNo = $this->CheckCheckBox($request->SexHisUseContraceptiveNo);  
        $docfiles->SexHisUseContraceptiveSpecify = $request->SexHisUseContraceptiveSpecify;
        $docfiles->SexHisChlamydia = $this->CheckCheckBox($request->SexHisChlamydia);  
        $docfiles->SexHisGonorrhea = $this->CheckCheckBox($request->SexHisGonorrhea);  
        $docfiles->SexHisSyphilis = $this->CheckCheckBox($request->SexHisSyphilis);  
        $docfiles->SexHisGenitalWartsHPV = $this->CheckCheckBox($request->SexHisGenitalWartsHPV);   
        $docfiles->SexHisHepatitis = $this->CheckCheckBox($request->SexHisHepatitis);   
        $docfiles->SexHisHerpes = $this->CheckCheckBox($request->SexHisHerpes);   
        $docfiles->SexHisHIVAIDS = $this->CheckCheckBox($request->SexHisHIVAIDS);   
        $docfiles->SexHisPID = $this->CheckCheckBox($request->SexHisPID);   
        $docfiles->SexHisUTI = $this->CheckCheckBox($request->SexHisUTI);   
        $docfiles->SexHiTransmittedDeasesSpecify = $request->SexHiTransmittedDeasesSpecify;
        $docfiles->MedHisChroMedConYes = $this->CheckCheckBox($request->MedHisChroMedConYes);
        $docfiles->MedHisChroMedConNo = $this->CheckCheckBox($request->MedHisChroMedConNo);
        $docfiles->MedHisChroMedConSpecify = $request->MedHisChroMedConSpecify;
        $docfiles->InMedicationYes = $this->CheckCheckBox($request->InMedicationYes);
        $docfiles->InMedicationNo = $this->CheckCheckBox($request->InMedicationNo);
        $docfiles->InMedicationSpecify = $request->InMedicationSpecify;
        $docfiles->IntakeAspirinYes = $this->CheckCheckBox($request->IntakeAspirinYes);
        $docfiles->IntakeAspirinNo = $this->CheckCheckBox($request->IntakeAspirinNo);
        $docfiles->IntakeAspirinSpecify = $request->IntakeAspirinSpecify;
        $docfiles->FoodAllergyYes = $this->CheckCheckBox($request->FoodAllergyYes);
        $docfiles->FoodAllergyNo = $this->CheckCheckBox($request->FoodAllergyNo);
        $docfiles->FoodAllergySpecify = $request->FoodAllergySpecify;
        $docfiles->MedAllergyYes = $this->CheckCheckBox($request->MedAllergyYes);
        $docfiles->MedAllergyNo = $this->CheckCheckBox($request->MedAllergyNo);
        $docfiles->MedAllergySpecify = $request->MedAllergySpecify;
        $docfiles->SurHisSurgery = $request->SurHisSurgery;

        $date = date_create($request->SurHisSurgeryDate);
        $docfiles->SurHisSurgeryDate= $date->format('Y-m-d');

        $docfiles->SurHisComplication = $request->SurHisComplication;
        $docfiles->SurHisProbAnesthesiaYes = $this->CheckCheckBox($request->SurHisProbAnesthesiaYes);
        $docfiles->SurHisProbAnesthesiaNo = $this->CheckCheckBox($request->SurHisProbAnesthesiaNo);
        $docfiles->SurHisProbAnesthesiaSpecify = $request->SurHisProbAnesthesiaSpecify;

        $docfiles->FamHisFamMedConDiabetesMellitus = $this->CheckCheckBox($request->FamHisFamMedConDiabetesMellitus);
        $docfiles->FamHisFamMedConHighBlood = $this->CheckCheckBox($request->FamHisFamMedConHighBlood);
        $docfiles->FamHisFamMedConCancer = $this->CheckCheckBox($request->FamHisFamMedConCancer);
        $docfiles->FamHisFamMedConHighOthers =$request->FamHisFamMedConHighOthers;

        $docfiles->PriorFerTreatYes = $this->CheckCheckBox($request->PriorFerTreatYes);
        $docfiles->PriorFerTreatNo = $this->CheckCheckBox($request->PriorFerTreatNo);

        $docfiles->PriorFerTreatCioNatInter = $this->CheckCheckBox($request->PriorFerTreatCioNatInter);
        $docfiles->PriorFerTreatCioInse = $this->CheckCheckBox($request->PriorFerTreatCioInse);
        $docfiles->PriorFerTreatVitFer = $this->CheckCheckBox($request->PriorFerTreatVitFer);
        $docfiles->PriorFerTreatInjMedNatInt = $this->CheckCheckBox($request->PriorFerTreatInjMedNatInt);
        $docfiles->PriorFerTreatInjMedIns = $this->CheckCheckBox($request->PriorFerTreatInjMedIns);
        $docfiles->PriorFerTreatFroEmbrTran = $this->CheckCheckBox($request->PriorFerTreatFroEmbrTran);
        $docfiles->PriorFerTreatHSG = $this->CheckCheckBox($request->PriorFerTreatHSG);
        $docfiles->PriorFerTreatOthers = $request->PriorFerTreatOthers;

        $docfiles->Notes = $request->Notes;

        $docfiles->filelink = '/file/'.$imagepath;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        return redirect()->to('/doctorconsultation/'.$request->txtpatientId); 
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatemale(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from maledoctorconsultations where id=".$request->txtMaleDoctorConsultationId;
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

       $docfiles = MaleDoctorConsultation::find($request->txtMaleDoctorConsultationId);
       $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->SocHisSingle = $this->CheckCheckBox($request->SocHisSingle);
        $docfiles->SocHisMarried = $this->CheckCheckBox($request->SocHisMarried);
        $docfiles->SocHisDivorced = $this->CheckCheckBox($request->SocHisDivorced);
        $docfiles->SocHisWidow = $this->CheckCheckBox($request->SocHisWidow);
        $docfiles->SocHisNoOfChildren = $request->SocHisNoOfChildren;
        $docfiles->SocHisWorkingStatusYes = $this->CheckCheckBox($request->SocHisWorkingStatusYes);
        $docfiles->SocHisWorkingStatusNo = $this->CheckCheckBox($request->SocHisWorkingStatusNo);
        $docfiles->SocHisWorkingSpecify = $request->SocHisWorkingSpecify;
        $docfiles->SocHisAlcoholIntakeYes = $this->CheckCheckBox($request->SocHisAlcoholIntakeYes);
        $docfiles->SocHisAlcoholIntakeNo = $this->CheckCheckBox($request->SocHisAlcoholIntakeNo);
        $docfiles->SocHisSmokingYes = $this->CheckCheckBox($request->SocHisSmokingYes);
        $docfiles->SocHisSmokingNo = $this->CheckCheckBox($request->SocHisSmokingNo);
        $docfiles->SocHisSubsAbuseYes = $this->CheckCheckBox($request->SocHisSubsAbuseYes);
        $docfiles->SocHisSubsAbuseNo = $this->CheckCheckBox($request->SocHisSubsAbuseNo);
        $docfiles->FamHisMedConDiaMille = $this->CheckCheckBox($request->FamHisMedConDiaMille);
        $docfiles->FamHisMedConHigbBlood = $this->CheckCheckBox($request->FamHisMedConHigbBlood);
        $docfiles->FamHisMedConCancer = $this->CheckCheckBox($request->FamHisMedConCancer);
        $docfiles->FamHisMedConOthers = $request->FamHisMedConOthers;
        $docfiles->MedHisSemAnaYes = $this->CheckCheckBox($request->MedHisSemAnaYes);
        $docfiles->MedHisSemAnaNo = $this->CheckCheckBox($request->MedHisSemAnaNo);
        $docfiles->MedHisRetroEjaYes = $this->CheckCheckBox($request->MedHisRetroEjaYes);
        $docfiles->MedHisRetroEjaNo = $this->CheckCheckBox($request->MedHisRetroEjaNo);
        $docfiles->MedHisExpRadHarChemYes = $this->CheckCheckBox($request->MedHisExpRadHarChemYes);
        $docfiles->MedHisExpRadHarChemNo = $this->CheckCheckBox($request->MedHisExpRadHarChemNo);
        $docfiles->MedHisExpRadHarChemSpecify = $request->MedHisExpRadHarChemSpecify;
        $docfiles->MedHisChroMedConYes = $this->CheckCheckBox($request->MedHisChroMedConYes);
        $docfiles->MedHisChroMedConNo = $this->CheckCheckBox($request->MedHisChroMedConNo);
        $docfiles->MedHisChroMedConSpecify = $request->MedHisChroMedConSpecify;
        $docfiles->MedHisCurMed = $request->MedHisCurMed;
        $docfiles->MedHisOvCouHerMedYes = $this->CheckCheckBox($request->MedHisOvCouHerMedYes);
        $docfiles->MedHisOvCouHerMedNo = $this->CheckCheckBox($request->MedHisOvCouHerMedNo);
        $docfiles->MedHisOvCouHerMedSpecify = $request->MedHisOvCouHerMedSpecify;
        $docfiles->MedHisAllerFoodNonKnown = $this->CheckCheckBox($request->MedHisAllerFoodNonKnown);
        $docfiles->MedHisAllerFoodYes = $this->CheckCheckBox($request->MedHisAllerFoodYes);
        $docfiles->MedHisAllerFoodSpecify = $request->MedHisAllerFoodSpecify;
        $docfiles->MedHisAllerMedNonKnown = $this->CheckCheckBox($request->MedHisAllerMedNonKnown);
        $docfiles->MedHisAllerMedYes = $this->CheckCheckBox($request->MedHisAllerMedYes);
        $docfiles->MedHisAllerMedSpecify = $request->MedHisAllerMedSpecify;
        $docfiles->SexHisChlamydi = $this->CheckCheckBox($request->SexHisChlamydi);
        $docfiles->SexHisGonorrhea = $this->CheckCheckBox($request->SexHisGonorrhea);
        $docfiles->SexHisSyphilis = $this->CheckCheckBox($request->SexHisSyphilis);
        $docfiles->SexHisGenWartsHPV = $this->CheckCheckBox($request->SexHisGenWartsHPV);
        $docfiles->SexHisHepatitis = $this->CheckCheckBox($request->SexHisHepatitis);
        $docfiles->SexHisHerpes = $this->CheckCheckBox($request->SexHisHerpes);
        $docfiles->SexHisHIVAIDS = $this->CheckCheckBox($request->SexHisHIVAIDS);
        $docfiles->SexHisPIV = $this->CheckCheckBox($request->SexHisPIV);
        $docfiles->SexHisOthers = $request->SexHisOthers;
        $docfiles->SurHisTypeSurgery = $request->SurHisTypeSurgery;
        $docfiles->SurHisWhen = $request->SurHisWhen;
        $docfiles->SurHisComplication = $request->SurHisComplication;

        $docfiles->Notes = $request->Notes;

        $docfiles->filelink = '/file/'.$imagepath;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        return redirect()->to('/doctorconsultation/'.$request->txtpatientId); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyfemale(Request $request)
    {
        $strsql ="SELECT * from femaledoctorsconsultation where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = FemaleDoctorConsulatation::destroy($request->del_id);
        

        return redirect()->to('/doctorconsultation/'.$request->txtpatientId);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroymale(Request $request)
    {
        $strsql ="SELECT * from maledoctorconsultations where id=".$request->del_id_male;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = MaleDoctorConsultation::destroy($request->del_id_male);
        

        return redirect()->to('/doctorconsultation/'.$request->txtpatientId);
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
