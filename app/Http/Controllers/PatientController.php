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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\SystemFunctionController;


class PatientController extends Controller
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
        //
        $leads =DB::table('patients')
            ->select('patients.*')
            ->where('IsPatient','=','1')            
            ->orderBy('id','desc')
            ->orderBy('created_at','desc')
            ->paginate();

        return view('patient.index',compact('leads'));
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
        return redirect()->to('/patientsearch/'.$search);
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
            ->where('IsPatient','=','1')
            ->Where(function ($query) use ($search) {
                $query->orwhere('MainContactNo','like','%'.$search.'%')
                      ->orwhere('WifeContactNo','like','%'.$search.'%')
                      ->orwhere('HusbandContactNo','like','%'.$search.'%')
                      ->orwhere('MainEmail','like','%'.$search.'%');
            })
            ->paginate();
            return view('patient.index',compact('leads'));
        }
        else{
            return redirect()->to('/patient');   
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
        $lead->createdbyid= Auth::user()->id;
        $lead->save();

        $lead_id = $lead->id;

         $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($lead_id,$this->DocTransName);

        return redirect()->to('/lead/view/'.$lead_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($PatientId)
    {
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
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

        $staffs = Staff::all();
        $reasons = Reason::all();

        return view('patient.view',compact('pricelists','leadreminders','patients','leadassessments','staffs','reasons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
       //
        $nationalities = Nationality::all();
        $leadsources = LeadSource::all();

        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$id;
        $patients = DB::select($strsql);

        return view('lead.edit',compact('patients','nationalities','leadsources'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
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
            return redirect('lead/edit/'.$request->txtpatientId)
                        ->withErrors($validator)
                        ->withInput();
        }

        $imagepath = "";

        $strsql ="SELECT * from patients where id=".$request->txtpatientId;
        $patients = DB::select($strsql);

        $patientLinkFile ="";

        foreach($patients as $patient){
            $patientLinkFile = $patient->FileLink;
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
       if($request->chkIsPatient=='on'){
            $isPatient=1;
       }

       

        $lead = Patient::find($request->txtpatientId);
        // $lead->FileNo = $
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
        $lead->save();

        $lead_id = $lead->id;

        $translinks = new SystemFunctionController;

        $translinks->UpdateTransLink($lead_id,$this->DocTransName);

        return redirect()->to('/lead/view/'.$lead_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
