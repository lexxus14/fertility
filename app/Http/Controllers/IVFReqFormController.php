<?php

namespace App\Http\Controllers;

use App\IVFReqForms;
use App\Staff;
use App\Medicine;
use App\MedicineUnit;
use App\Procedure;
use App\IVFReqFormMed;
use App\IVFProcOrd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IVFReqFormController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "IVF Requisition Form";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function OVFReqForm($PatientId)
    {
     $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select IVFRequisistionForms.*,p.name StaffName from IVFRequisistionForms 
                    left join staff as p on p.id = IVFRequisistionForms.PhysicianId
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('ivfreqform.patientindex',compact('docresult','patients'));  
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

        $Medicines = Medicine::all();
        $MedicineUnits = MedicineUnit::all();
        $Procedures = Procedure::all();
        $Staffs = Staff::all();

        return view('ivfreqform.new',compact('patients','Medicines','MedicineUnits','Procedures','Staffs'));
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

        $docfiles = new IVFReqForms;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->PhysicianId= $request->PhysicianId;
        $docfiles->IsFemalePartner= $this->CheckCheckBox($request->IsFemalePartner);
        $docfiles->BaselineFSH= $request->BaselineFSH;
        $docfiles->UTLining= $request->UTLining;
        $docfiles->AMH= $request->AMH;
        $docfiles->OocyteSoureValid= $request->OocyteSoureValid;
        $docfiles->IsMalePartner= $this->CheckCheckBox($request->IsMalePartner);
        $docfiles->IsFresh= $this->CheckCheckBox($request->IsFresh);
        $docfiles->IsFrozen= $this->CheckCheckBox($request->IsFrozen);
        $docfiles->IsTESE= $this->CheckCheckBox($request->IsTESE);
        $docfiles->IsICSI= $this->CheckCheckBox($request->IsICSI);
        $docfiles->IsAssHatching= $this->CheckCheckBox($request->IsAssHatching);
        $docfiles->IsEmbBxFSH= $this->CheckCheckBox($request->IsEmbBxFSH);
        $docfiles->IsEmbBxAcgh= $this->CheckCheckBox($request->IsEmbBxAcgh);
        $docfiles->SpermSourceValid= $request->SpermSourceValid;
        $docfiles->Dx= $request->Dx;
        $docfiles->G= $request->G;
        $docfiles->P= $request->P;
        $docfiles->T= $request->T;
        $docfiles->A= $request->A;
        $docfiles->L= $request->L;
        $docfiles->Protocol= $request->Protocol;
        $docfiles->Cycle= $request->Cycle; 
        $docfiles->PeakE2= $request->PeakE2;
        $docfiles->StimDays= $request->StimDays;

        $date = date_create($request->CycleStartDate);
        $docfiles->CycleStartDate= $date->format('Y-m-d');

        $docfiles->NoFollHcgInjDays= $request->NoFollHcgInjDays;
        $docfiles->PatientCoastedDays= $request->PatientCoastedDays;
        $docfiles->IsPGTA= $this->CheckCheckBox($request->IsPGTA);
        $docfiles->IsGenderSel= $this->CheckCheckBox($request->IsGenderSel);
        $docfiles->IsPGTM= $this->CheckCheckBox($request->IsPGTM);

        $date = date_create($request->HcgDate);
        $docfiles->HcgDate= $date->format('Y-m-d');

        $docfiles->HcgTime= $request->HcgTime;

        $date = date_create($request->ErDate);
        $docfiles->ErDate= $date->format('Y-m-d');

        $docfiles->ErTime= $request->ErTime;
        $docfiles->IsBryoTransYes= $this->CheckCheckBox($request->IsBryoTransYes);
        $docfiles->IsBryoTransNo= $this->CheckCheckBox($request->IsBryoTransNo);
        $docfiles->Notes= $request->Notes;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $MedId=$request->MedId;
        $MedDosage=$request->MedDosage;
        $MedUnitId=$request->MedUnitId;

        $N = count($MedId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new IVFReqFormMed;
            $pricelistsub->IVFRequisistionFormsId = $doclab_id; 
            $pricelistsub->MedId = $MedId[$i];
            $pricelistsub->MedDosage = $MedDosage[$i];
            $pricelistsub->MedUnitId = $MedUnitId[$i];
            $pricelistsub->save();
            
        }

        $ProcedureId=$request->ProcedureId;

        $N = count($ProcedureId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new IVFProcOrd;
            $pricelistsub->IVFRequisistionFormsId = $doclab_id; 
            $pricelistsub->ProcedureId = $ProcedureId[$i];
            $pricelistsub->save();
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/ivfreqform/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IVFReqForms  $iVFReqForms
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join IVFRequisistionForms as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select IVFRequisistionForms.*,p.name StaffName from IVFRequisistionForms 
                    left join staff as p on p.id = IVFRequisistionForms.PhysicianId
                  where IVFRequisistionForms.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dd.id,dd.description,MedDosage,MedUnitId from IVFReqFormMeds 
                    inner join medicines dd on dd.id = IVFReqFormMeds.MedId
                    inner join MedicineUnits mu on mu.id = IVFReqFormMeds.MedUnitId
                    where IVFReqFormMeds.IVFRequisistionFormsId=".$docId;
        $IVFReqFormMeds = DB::select($strsql);

        $strsql ="select dd.id,dd.description from IVFProcOrds 
                    inner join procedures dd on dd.id = IVFProcOrds.ProcedureId
                    where IVFProcOrds.IVFRequisistionFormsId=".$docId;
        $IVFProcOrds = DB::select($strsql);


        $Medicines = Medicine::all();
        $MedicineUnits = MedicineUnit::all();
        $Procedures = Procedure::all();
        $Staffs = Staff::all();

        return view('ivfreqform.view',compact('patients','Medicines','MedicineUnits','Procedures','Staffs','docresults','IVFReqFormMeds','IVFProcOrds','docId'));
    }

    public function PrintIVFReqForm($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join IVFRequisistionForms as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select IVFRequisistionForms.*,p.name StaffName from IVFRequisistionForms 
                    inner join staff as p on p.id = IVFRequisistionForms.PhysicianId
                  where IVFRequisistionForms.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dd.id,dd.description,mu.ShortSymbol,MedDosage,MedUnitId from IVFReqFormMeds 
                    inner join medicines dd on dd.id = IVFReqFormMeds.MedId
                    inner join MedicineUnits mu on mu.id = IVFReqFormMeds.MedUnitId
                    where IVFReqFormMeds.IVFRequisistionFormsId=".$docId;
        $IVFReqFormMeds = DB::select($strsql);

        $strsql ="select dd.id,dd.description from IVFProcOrds 
                    inner join procedures dd on dd.id = IVFProcOrds.ProcedureId
                    where IVFProcOrds.IVFRequisistionFormsId=".$docId;
        $IVFProcOrds = DB::select($strsql);


        $Medicines = Medicine::all();
        $MedicineUnits = MedicineUnit::all();
        $Procedures = Procedure::all();
        $Staffs = Staff::all();

        return view('ivfreqform.print',compact('patients','Medicines','MedicineUnits','Procedures','Staffs','docresults','IVFReqFormMeds','IVFProcOrds','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IVFReqForms  $iVFReqForms
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join IVFRequisistionForms as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select IVFRequisistionForms.*,p.name StaffName from IVFRequisistionForms 
                    left join staff as p on p.id = IVFRequisistionForms.PhysicianId
                  where IVFRequisistionForms.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dd.id,dd.description,MedDosage,MedUnitId from IVFReqFormMeds 
                    inner join medicines dd on dd.id = IVFReqFormMeds.MedId
                    inner join MedicineUnits mu on mu.id = IVFReqFormMeds.MedUnitId
                    where IVFReqFormMeds.IVFRequisistionFormsId=".$docId;
        $IVFReqFormMeds = DB::select($strsql);

        $strsql ="select dd.id,dd.description from IVFProcOrds 
                    inner join procedures dd on dd.id = IVFProcOrds.ProcedureId
                    where IVFProcOrds.IVFRequisistionFormsId=".$docId;
        $IVFProcOrds = DB::select($strsql);


        $Medicines = Medicine::all();
        $MedicineUnits = MedicineUnit::all();
        $Procedures = Procedure::all();
        $Staffs = Staff::all();

        return view('ivfreqform.edit',compact('patients','Medicines','MedicineUnits','Procedures','Staffs','docresults','IVFReqFormMeds','IVFProcOrds','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IVFReqForms  $iVFReqForms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from IVFRequisistionForms where id=".$request->docId;
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

        $docfiles = IVFReqForms::find($request->docId);
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = $imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->PhysicianId= $request->PhysicianId;
        $docfiles->IsFemalePartner= $this->CheckCheckBox($request->IsFemalePartner);
        $docfiles->BaselineFSH= $request->BaselineFSH;
        $docfiles->UTLining= $request->UTLining;
        $docfiles->AMH= $request->AMH;
        $docfiles->OocyteSoureValid= $request->OocyteSoureValid;
        $docfiles->IsMalePartner= $this->CheckCheckBox($request->IsMalePartner);
        $docfiles->IsFresh= $this->CheckCheckBox($request->IsFresh);
        $docfiles->IsFrozen= $this->CheckCheckBox($request->IsFrozen);
        $docfiles->IsTESE= $this->CheckCheckBox($request->IsTESE);
        $docfiles->IsICSI= $this->CheckCheckBox($request->IsICSI);
        $docfiles->IsAssHatching= $this->CheckCheckBox($request->IsAssHatching);
        $docfiles->IsEmbBxFSH= $this->CheckCheckBox($request->IsEmbBxFSH);
        $docfiles->IsEmbBxAcgh= $this->CheckCheckBox($request->IsEmbBxAcgh);
        $docfiles->SpermSourceValid= $request->SpermSourceValid;
        $docfiles->Dx= $request->Dx;
        $docfiles->G= $request->G;
        $docfiles->P= $request->P;
        $docfiles->T= $request->T;
        $docfiles->A= $request->A;
        $docfiles->L= $request->L;
        $docfiles->Protocol= $request->Protocol;
        $docfiles->Cycle= $request->Cycle; 
        $docfiles->PeakE2= $request->PeakE2;
        $docfiles->StimDays= $request->StimDays;

        $date = date_create($request->CycleStartDate);
        $docfiles->CycleStartDate= $date->format('Y-m-d');

        $docfiles->NoFollHcgInjDays= $request->NoFollHcgInjDays;
        $docfiles->PatientCoastedDays= $request->PatientCoastedDays;
        $docfiles->IsPGTA= $this->CheckCheckBox($request->IsPGTA);
        $docfiles->IsGenderSel= $this->CheckCheckBox($request->IsGenderSel);
        $docfiles->IsPGTM= $this->CheckCheckBox($request->IsPGTM);

        $date = date_create($request->HcgDate);
        $docfiles->HcgDate= $date->format('Y-m-d');

        $docfiles->HcgTime= $request->HcgTime;

        $date = date_create($request->ErDate);
        $docfiles->ErDate= $date->format('Y-m-d');

        $docfiles->ErTime= $request->ErTime;
        $docfiles->IsBryoTransYes= $this->CheckCheckBox($request->IsBryoTransYes);
        $docfiles->IsBryoTransNo= $this->CheckCheckBox($request->IsBryoTransNo);
        $docfiles->Notes= $request->Notes;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('IVFReqFormMeds')->where('IVFRequisistionFormsId', $request->docId)->delete();
        $MedId=$request->MedId;
        $MedDosage=$request->MedDosage;
        $MedUnitId=$request->MedUnitId;

        $N = count($MedId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new IVFReqFormMed;
            $pricelistsub->IVFRequisistionFormsId = $doclab_id; 
            $pricelistsub->MedId = $MedId[$i];
            $pricelistsub->MedDosage = $MedDosage[$i];
            $pricelistsub->MedUnitId = $MedUnitId[$i];
            $pricelistsub->save();
            
        }

        $sub = DB::table('IVFProcOrds')->where('IVFRequisistionFormsId', $request->docId)->delete();

        $ProcedureId=$request->ProcedureId;

        $N = count($ProcedureId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new IVFProcOrd;
            $pricelistsub->IVFRequisistionFormsId = $doclab_id; 
            $pricelistsub->ProcedureId = $ProcedureId[$i];
            $pricelistsub->save();
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/ivfreqform/'.$request->txtpatientId);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IVFReqForms  $iVFReqForms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from IVFRequisistionForms where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = IVFReqForms::destroy($request->del_id);

        return redirect()->to('/ivfreqform/'.$request->txtpatientId);
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
