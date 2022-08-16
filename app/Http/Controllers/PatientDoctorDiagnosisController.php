<?php

namespace App\Http\Controllers;

use App\PatientDoctorDiagnosis;
use App\PatientDoctorDiagnosisSub;
use App\DoctorDiagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\SystemFunctionController;

class PatientDoctorDiagnosisController extends Controller
{
    private $DocTransName = "Patient Doctor Diagnosis";
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
        return view('patientdoctordiagnosis.index');
    }

    public function PatientDoctorDiagnosisSign($PatientId){
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from patientdoctordiagnosis 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('patientdoctordiagnosis.patientindex',compact('docresult','patients'));
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

        $doctordiagnosis = DoctorDiagnosis::all();

        return view('patientdoctordiagnosis.new',compact('patients','doctordiagnosis'));
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

        $docfiles = new PatientDoctorDiagnosis;

        $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->description = $request->txtdescription;

        $docfiles->filelink = '/file/'.$imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $doctorDiagnosId=$request->txtDoctorDiagnosId;
        $doctorDiagnosNote=$request->txtnote;

        $N = count($doctorDiagnosId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PatientDoctorDiagnosisSub;
            $pricelistsub->patientdoctordiagnosisId = $doclab_id; 
            $pricelistsub->doctordiagnosisId = $doctorDiagnosId[$i];
            $pricelistsub->notes = $doctorDiagnosNote[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/patientdoctordiagnosis/'.$request->txtpatientId);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LabInvestigation  $labInvestigation
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join patientdoctordiagnosis as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patientdoctordiagnosis 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select pdds.*,dd.description from patientdoctordiagnosissub pdds
                    INNER JOIN patientdoctordiagnosis pdd on pdd.id=pdds.patientdoctordiagnosisId
                    INNER JOIN doctordiagnosis dd on dd.id = pdds.doctordiagnosisId
                    WHERE pdd.id = ".$docId." ORDER BY dd.description ASC";   

        $patientdoctorsdiagnosissubs = DB::select($strsql);

        $strsql ="select * from femaledoctorsconsultation 
                  where id =".$docId;;
        $docresults = DB::select($strsql);


        return view('patientdoctordiagnosis.view',compact('docresults','patients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LabInvestigation  $labInvestigation
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join patientdoctordiagnosis as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patientdoctordiagnosis 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select pdds.*,dd.description from patientdoctordiagnosissub pdds
                    INNER JOIN patientdoctordiagnosis pdd on pdd.id=pdds.patientdoctordiagnosisId
                    INNER JOIN doctordiagnosis dd on dd.id = pdds.doctordiagnosisId
                    WHERE pdd.id = ".$docId." ORDER BY dd.description ASC"; 

        $patientdoctordiagnosisssubs = DB::select($strsql);

        $doctorDiagnosis = DoctorDiagnosis::all();

        return view('patientdoctordiagnosis.edit',compact('docresults','patients','doctorDiagnosis','patientdoctordiagnosisssubs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LabInvestigation  $labInvestigation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from patientdoctordiagnosis where id=".$request->txtPatientDoctorDiagnosisId;
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

       $docfiles = PatientDoctorDiagnosis::find($request->txtPatientDoctorDiagnosisId);
       $docfiles->patientid = $request->txtpatientId;

       $date = date_create($request->txtDocDate);
       $docfiles->docdate= $date->format('Y-m-d');

       $docfiles->description = $request->txtdescription;
       $docfiles->filelink = $imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;

       $docfiles->save();

       $sub = DB::table('patientdoctordiagnosissub')->where('patientdoctordiagnosisId', $request->txtPatientDoctorDiagnosisId)->delete();

       $doclab_id = $docfiles->id;

        $doctorDiagnosisId=$request->txtdoctorsdiagnosisId;
        $doctorDiagnosisNote=$request->txtnote;

        $N = count($doctorDiagnosisId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PatientDoctorDiagnosisSub;
            $pricelistsub->patientdoctordiagnosisId = $doclab_id; 
            $pricelistsub->doctordiagnosisId = $doctorDiagnosisId[$i];
            $pricelistsub->notes = $doctorDiagnosisNote[$i];
            $pricelistsub->save();
            
        }

        return redirect()->to('/patientdoctordiagnosis/'.$request->txtpatientId);       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LabInvestigation  $labInvestigation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from patientdoctordiagnosis where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = PatientDoctorDiagnosis::destroy($request->del_id);
        $sub = DB::table('patientdoctordiagnosissub')->where('patientdoctordiagnosisId', $request->del_id)->delete();

        return redirect()->to('/patientdoctordiagnosis/'.$request->txtpatientId);
    }
}