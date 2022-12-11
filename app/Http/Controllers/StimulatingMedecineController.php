<?php

namespace App\Http\Controllers;

use App\StimulatingMedication;
use App\Medicine;
use App\MedicineUnit;
use App\StimulatingMedicationOthersMedSub;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StimulatingMedecineController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Stimulating Medicine";
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

    public function StimulatingMedicine($StiPhaseId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join stimulatingphases as st on st.patientid = p.id
                    WHERE st.id =".$StiPhaseId;
        $patients = DB::select($strsql);

        $strsql ="select StiMeds.*,mu.ShortSymbol as 'MuAMSymbol',mupm.ShortSymbol as 'MuPMSymbol', 
                    m_am.description as 'MedAm',m_pm.description as 'MedPm'
                    from StiMeds 
                    INNER JOIN MedicineUnits mu on mu.id = StiMeds.UnitIdAM
                    INNER JOIN MedicineUnits mupm on mupm.id = StiMeds.UnitIdPM
                    LEFT JOIN medicines m_am on m_am.id = StiMeds.MedIdAM
                    LEFT JOIN medicines m_pm on m_pm.id = StiMeds.MedIdPM
                  where  StimulatingPhasesId =".$StiPhaseId;
        $docresult = DB::select($strsql);

        $medicines = Medicine::all(); 
        $medicinesunits = MedicineUnit::all(); 
        return view('stimulatingmedicine.patientindex',compact('docresult','patients','StiPhaseId','medicines','medicinesunits'));
    }

    public function PrintStimulatingMedicine($StiPhaseId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join stimulatingphases as st on st.patientid = p.id
                    WHERE st.id =".$StiPhaseId;
        $patients = DB::select($strsql);

        $strsql ="select StiMeds.*,mu.ShortSymbol as 'MuAMSymbol',mupm.ShortSymbol as 'MuPMSymbol', 
                    m_am.description as 'MedAm',m_pm.description as 'MedPm'
                    from StiMeds 
                    INNER JOIN MedicineUnits mu on mu.id = StiMeds.UnitIdAM
                    INNER JOIN MedicineUnits mupm on mupm.id = StiMeds.UnitIdPM
                    LEFT JOIN medicines m_am on m_am.id = StiMeds.MedIdAM
                    LEFT JOIN medicines m_pm on m_pm.id = StiMeds.MedIdPM
                  where  StimulatingPhasesId =".$StiPhaseId;
        $docresults = DB::select($strsql);

        $medicines = Medicine::all(); 
        $medicinesunits = MedicineUnit::all(); 
        return view('stimulatingmedicine.print',compact('docresults','patients','StiPhaseId','medicines','medicinesunits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
       $AddDate = 0;
       $date = date_create($request->txtDocDate);
       for($ctrloop = intval($request->CycleFrom);$ctrloop<=intval($request->CycleTo);$ctrloop++)
       {

            $docfiles = new StimulatingMedication;
            
            if($AddDate>0){                
                date_add($date,date_interval_create_from_date_string("1 days"));
            } 
            $AddDate++;
            $Newdate = date_format($date,"Y-m-d");;
            $docfiles->docdate= $Newdate;

            $docfiles->patientid = $request->txtpatientId;
            $docfiles->StimulatingPhasesId = $request->StimulatingMedicationsid;
            $docfiles->CycleNo = $ctrloop;

            $docfiles->Notes = $request->Notes;

            $docfiles->filelink = '/file/'.$imagepath;

            $docfiles->MedIdAM = $request->MedIdAM;
            $docfiles->UnitIdAM = $request->UnitIdAM;
            $docfiles->MedIdPM = $request->MedIdPM;
            $docfiles->UnitIdPM = $request->UnitIdPM;
            $docfiles->MedDoseAM = $request->MedDoseAM;
            $docfiles->MedDosePM = $request->MedDosePM;
            $docfiles->StimulatingDate = $request->StimulatingDate;
            $docfiles->Breakfast = $request->Breakfast;
            $docfiles->Lunch = $request->Lunch;
            $docfiles->Dinner = $request->Dinner;


            $docfiles->createdbyid=Auth::user()->id;
            $docfiles->save();
            $doclab_id = $docfiles->id;

            
            $MedId=$request->MedId;
            $dose=$request->dose;
            $UnitId=$request->UnitId;

            $N = count($MedId);

            for($i=0; $i < $N; $i++)
            {
                $pricelistsub = new StimulatingMedicationOthersMedSub;
                $pricelistsub->StimulatingMedicationsid = $doclab_id; 
                $pricelistsub->MedId = $MedId[$i];
                $pricelistsub->UnitId = $UnitId[$i];
                $pricelistsub->dose = $dose[$i];
                $pricelistsub->save();
                
            }

            $translinks = new SystemFunctionController;

            $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        }

       
        
        return redirect()->to('/stimulatingmedicine/'.$request->StimulatingMedicationsid);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($StiPhaseId,$docId)
    {
       $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join StiMeds as st on st.patientid = p.id
                    WHERE st.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select StiMeds.*,mu.ShortSymbol as 'MuAMSymbol',mupm.ShortSymbol as 'MuPMSymbol', 
                    m_am.description as 'MedAm',m_pm.description as 'MedPm'
                    from StiMeds 
                    INNER JOIN MedicineUnits mu on mu.id = StiMeds.UnitIdAM
                    INNER JOIN MedicineUnits mupm on mupm.id = StiMeds.UnitIdPM
                    LEFT JOIN medicines m_am on m_am.id = StiMeds.MedIdAM
                    LEFT JOIN medicines m_pm on m_pm.id = StiMeds.MedIdPM
                  where  StiMeds.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT smomsub.dose,mu.ShortSymbol,m.description as Medicine,m.id as MedId,mu.id as UnitId FROM stimedothmedsubs as smomsub
                    INNER JOIN stimeds as s on s.id = smomsub.StimulatingMedicationsid
                    INNER JOIN medicineunits as mu on mu.id = smomsub.UnitId
                    INNER JOIN medicines as m on m.id = smomsub.MedId
                    WHERE StimulatingMedicationsid=".$docId;
        $subdocresults = DB::select($strsql);

        $medicines = Medicine::all(); 
        $medicinesunits = MedicineUnit::all(); 
        return view('stimulatingmedicine.view',compact('StiPhaseId','docId','docresults','patients','medicines','medicinesunits','subdocresults'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StimulatingMedOthMedSub  $stimulatingMedOthMedSub
     * @return \Illuminate\Http\Response
     */
    public function edit($StiPhaseId,$docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join StiMeds as st on st.patientid = p.id
                    WHERE st.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select StiMeds.*,mu.ShortSymbol as 'MuAMSymbol',mupm.ShortSymbol as 'MuPMSymbol', 
                    m_am.description as 'MedAm',m_pm.description as 'MedPm'
                    from StiMeds 
                    INNER JOIN MedicineUnits mu on mu.id = StiMeds.UnitIdAM
                    INNER JOIN MedicineUnits mupm on mupm.id = StiMeds.UnitIdPM
                    LEFT JOIN medicines m_am on m_am.id = StiMeds.MedIdAM
                    LEFT JOIN medicines m_pm on m_pm.id = StiMeds.MedIdPM
                  where  StiMeds.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT smomsub.dose,mu.ShortSymbol,m.description as Medicine,m.id as MedId,mu.id as UnitId FROM stimedothmedsubs as smomsub
                    INNER JOIN stimeds as s on s.id = smomsub.StimulatingMedicationsid
                    INNER JOIN medicineunits as mu on mu.id = smomsub.UnitId
                    INNER JOIN medicines as m on m.id = smomsub.MedId
                    WHERE StimulatingMedicationsid=".$docId;
        $subdocresults = DB::select($strsql);

        $medicines = Medicine::all(); 
        $medicinesunits = MedicineUnit::all(); 
        return view('stimulatingmedicine.edit',compact('StiPhaseId','docId','docresults','patients','medicines','medicinesunits','subdocresults'));
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
        
        $docfiles =  StimulatingMedication::find($request->txtDocId);
        $date = date_create($request->txtDocDate);
        $Newdate = date_format($date,"Y-m-d");
        $docfiles->docdate= $Newdate;


        $docfiles->CycleNo = $request->CycleNo;

        $docfiles->Notes = $request->Notes;

        $docfiles->MedIdAM = $request->MedIdAM;
        $docfiles->UnitIdAM = $request->UnitIdAM;
        $docfiles->MedIdPM = $request->MedIdPM;
        $docfiles->UnitIdPM = $request->UnitIdPM;
        $docfiles->MedDoseAM = $request->MedDoseAM;
        $docfiles->MedDosePM = $request->MedDosePM;
        $docfiles->StimulatingDate = $request->StimulatingDate;
        $docfiles->Breakfast = $request->Breakfast;
        $docfiles->Lunch = $request->Lunch;
        $docfiles->Dinner = $request->Dinner;

        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();

        $sub = DB::table('StiMedOthMedSubs')->where('StimulatingMedicationsid', $request->txtDocId)->delete();


        $doclab_id = $docfiles->id;

        
        $MedId=$request->MedId;
        $dose=$request->dose;
        $UnitId=$request->UnitId;

        $N = count($MedId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new StimulatingMedicationOthersMedSub;
            $pricelistsub->StimulatingMedicationsid = $doclab_id; 
            $pricelistsub->MedId = $MedId[$i];
            $pricelistsub->UnitId = $UnitId[$i];
            $pricelistsub->dose = $dose[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
  
        return redirect()->to('/stimulatingmedicine/'.$request->txtStiPhaseId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {       
        $strsql = "select id from StiMeds where id =".$request->del_id; 
        $docresults = DB::select($strsql);

        foreach($docresults as $docresult){
            $intId = $docresult->id;
            $sub = DB::table('StiMedOthMedSubs')->where('StimulatingMedicationsid', $intId )->delete();
        }

        $leadassessment = StimulatingMedication::destroy($request->del_id);       

        return redirect()->to('/stimulatingmedicine/'.$request->txtDocId);        
    }
}
