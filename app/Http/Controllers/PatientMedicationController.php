<?php

namespace App\Http\Controllers;

use App\PatientMedication;
use App\PatientMedicationSub;
use Illuminate\Http\Request;

use Validator;
use App\Patient;
use App\Nationality;
use App\LeadSource;
use App\LeadAssessment;
use App\Staff;
use App\Reason;
use App\LeadReminder;
use App\Medicine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\SystemFunctionController;

class PatientMedicationController extends Controller
{
    
    protected $redirectTo = '/home'; 
    private $DocTransName = "Patient Medication";   
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
        return view('patientmedication.index');
    }

    public function PatientMedication($PatientId){
       $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select patient_medications.* from patient_medications 
                  where patientid =".$PatientId;

        $docresult = DB::select($strsql);

        $medicines = DB::select("select * from medicines order by description asc");

        return view('patientmedication.patientindex',compact('docresult','patients','medicines'));
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

        $medicines = Medicine::all();

        return view('patientmedication.new',compact('patients','medicines'));
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

        $docfiles = new PatientMedication;

        $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->description = $request->txtdescription;

        $docfiles->filelink = 'file/'.$imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
         $doclab_id = $docfiles->id;

        $medId=$request->txtmedId;
        $medTime=$request->txtMedicineTime;
        $medNote=$request->txtnote;

        $N = count($medId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PatientMedicationSub;
            $pricelistsub->patientmedicationid = $doclab_id; 
            $pricelistsub->med_time = $medTime[$i];
            $pricelistsub->medicineid = $medId[$i];
            $pricelistsub->notes = $medNote[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);

        return redirect()->to('/patientmedication/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientMedication  $patientMedication
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join patient_medications as px on px.patientid = p.id
                    WHERE px.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patient_medications 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select pms.*,m.description from patient_medication_subs pms
            inner join medicines m on m.id = pms.medicineid
            inner join patient_medications pm on pm.id = pms.patientmedicationid
            where pm.id=".$docId." order by pms.id asc";
        $patientmedicationsubs = DB::select($strsql);

        $medicines = DB::select("select * from medicines order by description asc");

        return view('patientmedication.view',compact('docresults','patients','patientmedicationsubs','medicines'));
    }

    public function PrintPatientMedication($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join patient_medications as px on px.patientid = p.id
                    WHERE px.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patient_medications 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select pms.*,m.description from patient_medication_subs pms
            inner join medicines m on m.id = pms.medicineid
            inner join patient_medications pm on pm.id = pms.patientmedicationid
            where pm.id=".$docId." order by pms.id asc";
        $patientmedicationsubs = DB::select($strsql);


        return view('patientmedication.print',compact('docresults','patients','patientmedicationsubs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientMedication  $patientMedication
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join patient_medications as px on px.patientid = p.id
                    WHERE px.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patient_medications 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select pms.*,m.description from patient_medication_subs pms
            inner join medicines m on m.id = pms.medicineid
            inner join patient_medications pm on pm.id = pms.patientmedicationid
            where pm.id=".$docId." order by pms.id asc";
        $patientmedicationsubs = DB::select($strsql);

        $medicines = DB::select("select * from medicines order by description asc");

        return view('patientmedication.edit',compact('docresults','patients','medicines','patientmedicationsubs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientMedication  $patientMedication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from patient_medications where id=".$request->txtDocId;
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

           $docfiles = PatientMedication::find($request->txtDocId);
           $docfiles->patientid = $request->txtpatientId;

           $date = date_create($request->txtDocDate);
           $docfiles->docdate= $date->format('Y-m-d');
           $docfiles->description = $request->txtdescription;
           $docfiles->filelink = $imagepath;

            $docfiles->notes = $request->txtnotes;
            $docfiles->createdbyid=Auth::user()->id;

           $docfiles->save();
           $doclab_id = $docfiles->id;

           $sub = DB::table('patient_medication_subs')->where('patientmedicationid', $request->txtDocId)->delete();

            $medId=$request->txtmedId;
            $medTime=$request->txtMedicineTime;
            $medNote=$request->txtnote;

            $N = count($medId);

            for($i=0; $i < $N; $i++)
            {
                $pricelistsub = new PatientMedicationSub;
                $pricelistsub->patientmedicationid = $doclab_id; 
                $pricelistsub->med_time = $medTime[$i];
                $pricelistsub->medicineid = $medId[$i];
                $pricelistsub->notes = $medNote[$i];
                $pricelistsub->save();
                
            }

            
       }
       else{
            $imagepath = $laLinkFile;

            $docfiles = PatientMedication::find($request->txtDocId);
           $docfiles->patientid = $request->txtpatientId;

           $date = date_create($request->txtDocDate);
           $docfiles->docdate= $date->format('Y-m-d');

           $docfiles->description = $request->txtdescription;
           $docfiles->filelink = $imagepath;

            $docfiles->notes = $request->txtnotes;
            $docfiles->createdbyid=Auth::user()->id;

           $docfiles->save();
           $doclab_id = $docfiles->id;

           $sub = DB::table('patient_medication_subs')->where('patientmedicationid', $request->txtDocId)->delete();

            $medId=$request->txtmedId;
            $medTime=$request->txtMedicineTime;
            $medNote=$request->txtnote;

            $N = count($medId);

            for($i=0; $i < $N; $i++)
            {
                $pricelistsub = new PatientMedicationSub;
                $pricelistsub->patientmedicationid = $doclab_id; 
                $pricelistsub->med_time = $medTime[$i];
                $pricelistsub->medicineid = $medId[$i];
                $pricelistsub->notes = $medNote[$i];
                $pricelistsub->save();
                
            }
       }

       
       return redirect()->to('/patientmedication/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientMedication  $patientMedication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         $strsql ="SELECT * from patient_medications where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = PatientMedication::destroy($request->del_id);
        $sub = DB::table('patient_medication_subs')->where('patientmedicationid', $request->del_id)->delete();

        return redirect()->to('/patientmedication/'.$request->txtpatientId);
    }

    public function GetMedInfo($id)
    {
        $task = Medicine::find($id);

        return response()->json($task);

    }
}
