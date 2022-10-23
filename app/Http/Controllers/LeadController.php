<?php

namespace App\Http\Controllers;

use Validator;
use App\Patient;
use App\Nationality;
use App\LeadSource;
use App\LeadAssessment;
use App\Staff;
use App\Reason;
use App\LeadReminder;
use App\PatientProcedure;
use App\ImpTempTable;
use App\LeadToPatientList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\SystemFunctionController;

use Illuminate\Http\Request;

class LeadController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Patient";
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
         
        $leads =DB::table('patients')
            ->select('patients.*')
            // ->where('IsPatient','=','0')
            ->orderBy('id','desc')
            ->orderBy('created_at','desc')
            ->paginate();
        
            // $this->updateLeadToInpatient();
            // $this->InsertLeadAssessment();
            // $this->UpdateLeadAssessmentStaff();

       return view('lead.index',compact('leads'));
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function LeadSearch(Request $request)
    {      
        $search = 'AllLeads';
        if(isset($request->txtSearchLead)) 
        {
            $search=$request->txtSearchLead;
        }
        // $search = $request->txtSearchLead;
        // $leads =DB::table('patients')
        //     ->select('patients.*')
        //     ->where('IsPatient','=','0')
        //     ->Where(function ($query,) {
        //         $query->orwhere('MainContactNo','like','$search')
        //               ->orwhere('WifeContactNo','like','$search')
        //               ->orwhere('HusbandContactNo','like','$search')
        //               ->orwhere('MainEmail','like','$search');
        //     })
        //     ->paginate();
        return redirect()->to('/leadsearch/'.$search);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function LeadInfoSearch($search)
    {       
        if($search!='AllLeads'){

        $leads =DB::table('patients')
            ->select('patients.*')
            // ->where('IsPatient','=','0')
            ->Where(function ($query) use ($search) {
                $query->orwhere('MainContactPerson','like','%'.$search.'%')
                        ->orwhere('MainContactNo','like','%'.$search.'%')
                      ->orwhere('WifeContactNo','like','%'.$search.'%')
                      ->orwhere('HusbandContactNo','like','%'.$search.'%')
                      ->orwhere('MainEmail','like','%'.$search.'%');
            })
            ->paginate();
            return view('lead.index',compact('leads'));
        }
        else{
            return redirect()->to('/lead');   
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $nationalities = Nationality::all();
        $leadsources = LeadSource::all();
        return view('lead.new',compact('nationalities','leadsources'));
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
        $validator = Validator::make($request->all(), [
            'txtMainContactPerson' => 'required',
            'txtMainContactNo' => 'required'
        ],
        [
            'txtMainContactPerson.required' => 'Contact person is required',
            'txtMainContactNo.required' => 'Contact number is required'
        ]);
 
        if ($validator->fails()) {
            return redirect('lead/new')
                        ->withErrors($validator)
                        ->withInput();
        }

        $imagepath = "";

        if ($files = $request->file('inputFile')) {
        // Define upload path
           $destinationPath = public_path('/file/'); // upload path
        // Upload Orginal Image           
           $imagepath = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $imagepath);
       }

       $isPatient=0;
       if($request->chkIsPatient=='on'){
            $isPatient=1;
       }

       

        $lead = new Patient;
        // $lead->FileNo = $
        $lead->MainContactNo = $request->txtMainContactNo;
        $lead->MainEmail = $request->txtMainEmail;
        $lead->MainContactPerson= $request->txtMainContactPerson;
        $lead->WifeName= $request->txtWifeName;
        $lead->WifeLastName= $request->txtWifeLastName;

        $date = date_create($request->WifeDateofBirth);
        $lead->WifeBirthDate= $date->format('Y-m-d');

        $date = date_create($request->txtWifeMarriedSince);
        $lead->MarriedSince= $date->format('Y-m-d');

        $lead->WifeAddress= $request->txtWifeAddress;
        $lead->WifeEmailAddress= $request->WifeEmailAddress;
        $lead->WifeContactNo= $request->WifeContactNo;
        $lead->WifeNationalityId= $request->cmbWifeNationality;
        $lead->LeadSourceId= $request->cmbLeadSourceId;
        $lead->IsIVF= $request->chkIVFBefore;
        $lead->IsHasChildren= $request->chkHasChildren;
        $lead->IsMiscarriage= $request->chkMiscarriage;
        $lead->HusbandName= $request->txtHusbandName;
        $lead->HusbandLastName= $request->txtHusbandLastName;
        
        $date = date_create($request->txtHusbandBirthDate);
        $lead->HusbandBirthDate= $date->format('Y-m-d');

        $lead->HusbandNationalityId= $request->cmbHusbandNationality;
        $lead->HusbandAddress= $request->txtHusbandAddress;
        $lead->HusbandEmailAddress= $request->txtHusbandEmailAddress;
        $lead->HusbandContactNo= $request->txtHusbandContactNo;
        $lead->Notes= $request->txtnote;
        $lead->FileLink= '/file/'.$imagepath;
        $lead->IsPatient= $isPatient;
        $lead->IsWifePatient= $this->CheckCheckBox($request->IsWifePatient);
        $lead->IsHusbandPatient= $this->CheckCheckBox($request->IsHusbandPatient);
        $lead->createdbyid= Auth::user()->id;
        $lead->save();

        $lead_id = $lead->id;
        $date = date("Y-m-d H:i:s");
        if($isPatient==1){
            $leadToInPatient = new LeadToPatientList;
            $leadToInPatient->PatientId = $lead_id;
            $leadToInPatient->IsLeadInPatient = 1;
            $leadToInPatient->DateInPatient = $date;
            $leadToInPatient->save();
       }else{
            $leadToInPatient = new LeadToPatientList;
            $leadToInPatient->PatientId = $lead_id;
            $leadToInPatient->IsLeadInPatient = 0;
            $leadToInPatient->DateInPatient = $date;
            $leadToInPatient->save();
       }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($lead_id,$this->DocTransName);
        return redirect()->to('/lead/view/'.$lead_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($PatientId)
    {
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    LEFT JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    LEFT JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    LEFT join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select la.*,r.description from lead_assessments la 
                    inner join reasons r on r.id = la.reasonid
                    where la.patientid=".$PatientId;
        $leadassessments = DB::select($strsql);

        $strsql ="select lr.*,r.description from lead_reminders lr 
                    inner join reasons r on r.id = lr.reasonid
                    where lr.patientid=".$PatientId;
        $leadreminders = DB::select($strsql);

        $strsql ="select pl.* from price_lists as pl
                    where pl.patientid=".$PatientId;
        $pricelists = DB::select($strsql);

        $strsql ="select count(*) as TotalRecDoc from documents as d
                    where d.patientid=".$PatientId;
        $TotalRecDocs = DB::select($strsql);

        $strsql ="select count(*) as TotalRecDocNote from doctors_notes as d
                    where d.patientid=".$PatientId;
        $TotalRecDocNotes = DB::select($strsql);

        $strsql ="select count(*) as TotalRecLab from lab_investigations as d
                    where d.patientid=".$PatientId;
        $TotalRecLabs = DB::select($strsql);

        $strsql ="select count(*) as TotalRecHisAssessment from history_assessments as d
                    where d.patientid=".$PatientId;
        $TotalRecHisAssessments = DB::select($strsql);

        $strsql ="select count(*) as TotalPathXray from pathology_x_rays as d
                    where d.patientid=".$PatientId;
        $TotalPathXrays = DB::select($strsql);

        $strsql ="select count(*) as TotalEggCollected from eggs_collecteds as d
                    where d.patientid=".$PatientId;
        $TotalEggCollecteds = DB::select($strsql);

        $strsql ="select count(*) as TotalEggFertized from eggs_fertilizeds as d
                    where d.patientid=".$PatientId;
        $TotalEggFertizeds = DB::select($strsql);

        $strsql ="select count(*) as TotalGoodEmbryo from good_embryos as d
                    where d.patientid=".$PatientId;
        $TotalGoodEmbryos = DB::select($strsql);

        $strsql ="select count(*) as TotalFrozenEmbryo from frozen_embryos as d
                    where d.patientid=".$PatientId;
        $TotalFrozens = DB::select($strsql);

        $strsql ="select count(*) as TotalTransferredEmbryo from transferred_embryos as d
                    where d.patientid=".$PatientId;
        $TotalTransferredEmbryos = DB::select($strsql);

        $strsql ="select count(*) as TotalBiopsyStudy from biopsy_studies as d
                    where d.patientid=".$PatientId;
        $TotalBiopsyStudys = DB::select($strsql);

        $strsql ="select count(*) as TotalBiopsyResult from biopsy_results as d
                    where d.patientid=".$PatientId;
        $TotalBiopsyResults = DB::select($strsql);
        
        $strsql ="select count(*) as TotalPatientResult from fertility_results as d
                    where d.patientid=".$PatientId;
        $TotalPatientResults = DB::select($strsql);

        $strsql ="select count(*) as TotalPatientResult from patient_medications as d
                    where d.patientid=".$PatientId;
        $TotalPatientMedications = DB::select($strsql);

        $strsql ="select count(*) as TotalPatientResult from patient_treatments as d
                    where d.patientid=".$PatientId;
        $TotalPatientTreatments = DB::select($strsql);

        $strsql ="select count(*) as TotalPatientResult from consultations as d
                    where d.patientid=".$PatientId;
        $TotalPatientConsultations = DB::select($strsql);

        $strsql ="select count(*) as TotalDiagnosticyHysteroscopy from DiagnosticyHysteroscopy as d
                    where d.patientid=".$PatientId;
        $TotalDiagnosticyHysteroscopy = DB::select($strsql);

        $strsql ="select count(*) as TotalPostOpPostNotes from PostOpPostProcNotes as d
                    where d.patientid=".$PatientId;
        $TotalPostOpPostNotes = DB::select($strsql);

        $strsql ="select count(*) as TotalPreOperaChecklists from PreOperaChecklists as d
                    where d.patientid=".$PatientId;
        $TotalPreOperaChecklists = DB::select($strsql);

        $strsql ="select count(*) as TotalOperativeReports from OperativeReports as d
                    where d.patientid=".$PatientId;
        $TotalOperativeReports = DB::select($strsql);

        $strsql ="select count(*) as TotalIVFRequisistionForms from IVFRequisistionForms as d
                    where d.patientid=".$PatientId;
        $TotalIVFRequisistionForms = DB::select($strsql);

        $strsql ="select count(*) as TotalMocEmbTraMeas from MocEmbTraMeas as d
                    where d.patientid=".$PatientId;
        $TotalMocEmbTraMeas = DB::select($strsql);

        $strsql ="select count(*) as TotalPostAnesthesiaRecs from PostAnesthesiaRecs as d
                    where d.patientid=".$PatientId;
        $TotalPostAnesthesiaRecs = DB::select($strsql);

        $strsql ="select count(*) as TotalPreAneCheRecs from PreAneCheRecs as d
                    where d.patientid=".$PatientId;
        $TotalPreAneCheRecs = DB::select($strsql);

        $strsql ="select count(*) as TotalConOfAnesthesias from ConOfAnesthesia as d
                    where d.patientid=".$PatientId;
        $TotalConOfAnesthesias = DB::select($strsql);

        $strsql ="select count(*) as TotalIntraOperAnesRecs from IntraOperAnesRecs as d
                    where d.patientid=".$PatientId;
        $TotalIntraOperAnesRecs = DB::select($strsql);


        $staffs = Staff::all();
        $reasons = Reason::all();


        return view('lead.view',compact('TotalPatientConsultations','TotalPatientTreatments','TotalPatientMedications','TotalPatientResults','TotalBiopsyResults','TotalBiopsyStudys','TotalTransferredEmbryos','TotalFrozens','TotalGoodEmbryos','TotalEggFertizeds','TotalEggCollecteds','TotalPathXrays','TotalRecHisAssessments','TotalRecLabs','TotalRecDocNotes','TotalRecDocs','pricelists','leadreminders','patients','leadassessments','staffs','reasons','TotalDiagnosticyHysteroscopy','TotalPostOpPostNotes','TotalPreOperaChecklists','TotalOperativeReports','TotalIVFRequisistionForms','TotalMocEmbTraMeas','TotalPostAnesthesiaRecs','TotalPreAneCheRecs','TotalConOfAnesthesias','TotalIntraOperAnesRecs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $nationalities = Nationality::all();
        $leadsources = LeadSource::all();

        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    left JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    left JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    left join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$id;
        $patients = DB::select($strsql);

        return view('lead.edit',compact('patients','nationalities','leadsources'));
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
        //
        $validator = Validator::make($request->all(), [
            'txtMainContactPerson' => 'required',
            'txtMainContactNo' => 'required'
        ],
        [
            'txtMainContactPerson.required' => 'Contact person is required',
            'txtMainContactNo.required' => 'Contact number is required'
        ]);
 
        if ($validator->fails()) {
            return redirect('lead/edit/'.$request->txtpatientId)
                        ->withErrors($validator)
                        ->withInput();
        }

        $imagepath = "";

        $strsql ="SELECT * from patients where id=".$request->txtpatientId;
        $patients = DB::select($strsql);

        $patientLinkFile ="";
        $curFileNo = "";

        foreach($patients as $patient){
            $patientLinkFile = $patient->FileLink;
            $curFileNo = $patient->FileNo;
        }


        if ($files = $request->file('inputFile')) {
            
            if(is_file(public_path($patientLinkFile))){
                unlink(public_path($patientLinkFile));
            }

        // Define upload path
           $destinationPath = public_path('/file/'); // upload path
        // Upload Orginal Image           
           $imagepath = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $imagepath);

           $imagepath = 'file/'.$imagepath;
       }
       else{
            $imagepath = $patientLinkFile;
       }

       $isPatient=0;
       $FileNo = 0;
       if($request->chkIsPatient=='on'){
            $isPatient=1;
            $strsql ="SELECT concat(YEAR(CURRENT_DATE()),count(*)+ 1) as FileNo from patients where  FileNo Is Not Null and IsPatient='1'";
            $FileNos = DB::select($strsql);
            foreach($FileNos as $FileNum){
                $curFileNo = $FileNum->FileNo;
            }
       }

       

        $lead = Patient::find($request->txtpatientId);
        $lead->FileNo = $curFileNo;
        $lead->MainContactNo = $request->txtMainContactNo;
        $lead->MainEmail = $request->txtMainEmail;
        $lead->MainContactPerson = $request->txtMainContactPerson;
        $lead->WifeName = $request->txtWifeName;
        $lead->WifeLastName = $request->txtWifeLastName;

        $date = date_create($request->WifeDateofBirth);
        $lead->WifeBirthDate= $date->format('Y-m-d');

        $date = date_create($request->txtWifeMarriedSince);
        $lead->MarriedSince= $date->format('Y-m-d');

        $lead->WifeAddress= $request->txtWifeAddress;
        $lead->WifeEmailAddress= $request->WifeEmailAddress;
        $lead->WifeContactNo= $request->WifeContactNo;
        $lead->WifeNationalityId= $request->cmbWifeNationality;
        $lead->LeadSourceId= $request->cmbLeadSourceId;
        $lead->IsIVF= $request->chkIVFBefore;
        $lead->IsHasChildren= $request->chkHasChildren;
        $lead->IsMiscarriage= $request->chkMiscarriage;
        $lead->HusbandName= $request->txtHusbandName;
        $lead->HusbandLastName= $request->txtHusbandLastName;
        
        $date = date_create($request->txtHusbandBirthDate);
        $lead->HusbandBirthDate= $date->format('Y-m-d');

        $lead->HusbandNationalityId= $request->cmbHusbandNationality;
        $lead->HusbandAddress= $request->txtHusbandAddress;
        $lead->HusbandEmailAddress= $request->txtHusbandEmailAddress;
        $lead->HusbandContactNo= $request->txtHusbandContactNo;
        $lead->Notes= $request->txtnote;
        $lead->FileLink= $imagepath;
        $lead->IsPatient= $isPatient;
        $lead->IsWifePatient= $this->CheckCheckBox($request->IsWifePatient);
        $lead->IsHusbandPatient= $this->CheckCheckBox($request->IsHusbandPatient);
        $lead->save();

        $lead_id = $lead->id;
        $date = date("Y-m-d H:i:s");
        if($request->chkIsPatient=='on'){
            $leadToInPatient =DB::table('leadtopatientlist')
            ->where('PatientId', $lead_id)
            ->update(['IsLeadInPatient' => 1,'DateInPatient'=> $date]);
        }else{
            $leadToInPatient =DB::table('leadtopatientlist')
            ->where('PatientId', $lead_id)
            ->update(['IsLeadInPatient' => 0]);
        }

        $translinks = new SystemFunctionController;

        $translinks->UpdateTransLink($lead_id,$this->DocTransName);

        return redirect()->to('/lead/view/'.$lead_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $strsql ="SELECT * from patients where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->FileLink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = Patient::destroy($request->del_id);
        $res=LeadToPatientList::where('PatientId',$request->del_id)->delete();


        return redirect()->to('/lead');
    }

    public function ImportLead(Request $request){
        return view('lead.importlead');
    }

    public function updateLeadToInpatient()
    {
        $strsql ="SELECT * from imptemptable where id>=5106";
        $imptemptables = DB::select($strsql);

        foreach($imptemptables as $imptemptable){
            $search=$imptemptable->Field2;
            $search2=$imptemptable->Field3;
            $email=$imptemptable->Field5;
            $PatientMainContact = $imptemptable->Field1;
            // echo $search.'<br>';
            //  $strsql ="SELECT * from patients where MainContactNo  '".$search."'";

            // $p =DB::select($strsql);

            // SELECT * FROM imptemptable 
            // where 
            // (Field2  IN (select MainContactNo from patients) or Field2  IN (select wifeContactNo from patients))  
            // ORDER BY `imptemptable`.`id` ASC
            if(!empty($search)){
                $p =DB::table('patients')
                ->select('patients.*')
                ->where('IsPatient','=','0')
                ->Where(function ($query) use ($search) {
                    $query->orwhere('MainContactNo','like','%'.$search.'%')
                          ->orwhere('WifeContactNo','like','%'.$search.'%')
                          ->orwhere('HusbandContactNo','like','%'.$search.'%')
                          ->orwhere('MainEmail','like','%'.$search.'%');
                })->get();

                //  $strsql ="SELECT * from patients where MainContactNo  ='".$search."'";

                // $p =DB::select($strsql);

                $intctr=1;
                $intExist=0;
                foreach($p as $lead){
                    if($intctr==1)
                    {
                        // echo $search.'&nbsp'.$lead->id.'<br>';
                        $lea = Patient::find($lead->id);
                        $lea->IsPatient = '1';
                        $lea->MainContactPerson = $PatientMainContact;
                        $lea->MainEmail = $email;
                        $lea->save();
                    }
                    $intctr++;
                    $intExist++;
                }
                if($intExist==0){
                    echo $search.'<br>';
                }
            }

        }     
    }
    public function LeadAssessment()
    {
        $strsql ="SELECT * from imptemptable";
        foreach($imptemptables as $imptemptable){
        $imptemptables = DB::select($strsql);
            $lea = new LeadAssessment;
            $lea->assessmentrate = '3';
            $lea->date = $date;
            $lea->iscurrent = 1;
            $lea->reasonid = 1;
            $lea->staffid = 2;
            $lea->patientid = $lead->id;
            $lea->notes = $note;
            $lea->save();
        }

    }
    public function InsertLeadAssessment()
    {
        $strsql ="SELECT * from imptemptable where id > 596";
        $imptemptables = DB::select($strsql);

        foreach($imptemptables as $imptemptable){
            $search=$imptemptable->Field4;
            $note=$imptemptable->Field6;
            $date=$imptemptable->Field1;
            $leadname=$imptemptable->Field3;
            
            // echo $search.'<br>';
            //  $strsql ="SELECT * from patients where MainContactNo  '".$search."'";

            // $p =DB::select($strsql);

            // SELECT * FROM imptemptable 
            // where 
            // (Field2  IN (select MainContactNo from patients) or Field2  IN (select wifeContactNo from patients))  
            // ORDER BY `imptemptable`.`id` ASC
            if(!empty($search)){
                $p =DB::table('patients')
                ->select('patients.*')
                ->Where(function ($query) use ($search) {
                    $query->orwhere('MainContactNo','like','%'.$search.'%')
                          ->orwhere('WifeContactNo','like','%'.$search.'%')
                          ->orwhere('HusbandContactNo','like','%'.$search.'%')
                          ->orwhere('MainEmail','like','%'.$search.'%');
                })->get();

                //  $strsql ="SELECT * from patients where MainContactNo  ='".$search."'";

                // $p =DB::select($strsql);

                $intctr=1;
                $intExist=0;
                foreach($p as $lead){
                    if($intctr==1)
                    {
                        // echo $search.'&nbsp'.$lead->id.'<br>';
                        $lea = new LeadAssessment;
                        $lea->assessmentrate = '3';
                        $lea->date = $date;
                        $lea->iscurrent = 1;
                        $lea->reasonid = 1;
                        $lea->staffid = 2;
                        $lea->patientid = $lead->id;
                        $lea->notes = $note;
                        $lea->save();

                        $lea =  Patient::find($lead->id);
                        $lea->MainContactPerson= $leadname;
                        $lea->save();
                    }
                    $intctr++;
                    $intExist++;
                }
                if($intExist==0){
                    echo $search.'<br>';
                }
            }

        }     
    }

    public function UpdateLeadAssessmentStaff()
    {
        $strsql ="SELECT * from imptemptable where id > 596";
        $imptemptables = DB::select($strsql);

        foreach($imptemptables as $imptemptable){
            $search=$imptemptable->Field4;
            $StaffName=$imptemptable->Field2;
            
            // echo $search.'<br>';
            //  $strsql ="SELECT * from patients where MainContactNo  '".$search."'";

            // $p =DB::select($strsql);

            // SELECT * FROM imptemptable 
            // where 
            // (Field2  IN (select MainContactNo from patients) or Field2  IN (select wifeContactNo from patients))  
            // ORDER BY `imptemptable`.`id` ASC
            if(!empty($search)){
                $p =DB::table('patients')
                ->select('patients.*')
                ->Where(function ($query) use ($search) {
                    $query->orwhere('MainContactNo','like','%'.$search.'%')
                          ->orwhere('WifeContactNo','like','%'.$search.'%')
                          ->orwhere('HusbandContactNo','like','%'.$search.'%')
                          ->orwhere('MainEmail','like','%'.$search.'%');
                })->get();

                //  $strsql ="SELECT * from patients where MainContactNo  ='".$search."'";

                // $p =DB::select($strsql);

                $intctr=1;
                $intExist=0;
                foreach($p as $lead){
                    if($intctr==1)
                    {
                        $staffs =DB::select("select * from staff where name like '%".$StaffName."%'" );
                        foreach($staffs as $staff){
                            $le =  LeadAssessment::where('patientid','=', $lead->id)->first();
                            $le->staffid= $staff->id;
                            $le->save();
                        }
                    }
                    $intctr++;
                    $intExist++;
                }
                if($intExist==0){
                    echo $search.'<br>';
                }
            }

        }     
    }
    public function ImportLeadSave(Request $request){

        if ($files = $request->file('inputFile')) 
        {
            $file_open = fopen($files,"r");
             while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
                 {


                            $lead = new Patient;
                            $lead->MainContactPerson =$csv[0];
                            $lead->MainContactNo = $csv[1];
                          $lead->WifeContactNo = $csv[2];
                          If(strlen($csv[3])>7){
                          $lead->created_at = $csv[3];
                          }
                          $lead->Notes = $csv[4];
                          $lead->save();
                  // if($MaintConPerson[strlen($MaintConPerson)-1] != " "){
                  //       $lead->MainContactPerson =$csv[0];  
                  // }else{

                  //   $lead->MainContactPerson =substr($csv[0], 0, -1);
                  // }
                  
                  
                  echo $csv[0].' '.$csv[1].'<br/>';

                 }
            fclose($file_open);
            return redirect()->to('/lead');
           }
            else{

                echo 'Invalid File:Please Upload CSV File';
            }
            

        // return redirect()->to('/lead');   
        }

        public function ImportTempTable(Request $request){

        if ($files = $request->file('inputFile')) 
        {
            $file_open = fopen($files,"r");
             while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
                 {
                            $lead = new ImpTempTable;
                            $lead->Field1 = $csv[0];
                            $lead->Field2 = $csv[1];
                            $lead->Field3 = $csv[2];                          
                            $lead->Field4 = $csv[3];                          
                            $lead->Field5 = $csv[4];                          
                            // $lead->Field6 = $csv[5];                          
                            // $lead->Field7 = $csv[6];                          
                            // $lead->Field8 = $csv[7];                          
                            // $lead->Field9 = $csv[8];                          
                            // $lead->Field10 = $csv[9];                          
                          // $lead->Notes = $csv[4];
                          $lead->save();
                  // if($MaintConPerson[strlen($MaintConPerson)-1] != " "){
                  //       $lead->MainContactPerson =$csv[0];  
                  // }else{

                  //   $lead->MainContactPerson =substr($csv[0], 0, -1);
                  // }
                  
                  
                  echo $csv[0].' '.$csv[1].'<br/>';

                 }
            fclose($file_open);
            return redirect()->to('/lead');
           }
            else{

                echo 'Invalid File:Please Upload CSV File';
            }
            

        // return redirect()->to('/lead');   
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
