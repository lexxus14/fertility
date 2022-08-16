<?php

namespace App\Http\Controllers;

use App\PatientDoctorsPlan;
use App\PatientDoctorsPlanSub;
use App\DoctorsPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientDoctorsPlanController extends Controller
{
     private $DocTransName = "Patient Doctors Plan";
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
        return view('patientdoctorsplan.index');
    }

    public function PatientDoctorsPlanSign($PatientId){
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from patientdoctorsplan 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('patientdoctorsplan.patientindex',compact('docresult','patients'));
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

        $doctorsplans = DoctorsPlan::all();

        return view('patientdoctorsplan.new',compact('patients','doctorsplans'));
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

        $docfiles = new PatientDoctorsPlan;

        $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->description = $request->txtdescription;

        $docfiles->filelink = '/file/'.$imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $doctorsPlanId=$request->txtDoctorsPlanId;
        $doctorsPlanNote=$request->txtnote;

        $N = count($doctorsPlanId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PatientDoctorsPlanSub;
            $pricelistsub->patientdoctorplanId = $doclab_id; 
            $pricelistsub->doctorplanId = $doctorsPlanId[$i];
            $pricelistsub->notes = $doctorsPlanNote[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/patientdoctorsplan/'.$request->txtpatientId);

        
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
                    inner join patientdoctorsplan as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patientdoctorsplan 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select pdps.*,dp.description from patientdoctorsplansub pdps
                    INNER JOIN patientdoctorsplan pdd on pdd.id=pdps.patientdoctorplanId
                    INNER JOIN doctorsplans dp on dp.id = pdps.doctorplanId 
                    WHERE pdd.id = ".$docId." ORDER BY dp.description ASC";   

        $patientdoctorsplansubs = DB::select($strsql);


        return view('patientdoctorsplan.view',compact('docresults','patients','patientdoctorsplansubs'));
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
                    inner join patientdoctorsplan as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patientdoctorsplan 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select pdps.*,dp.description from patientdoctorsplansub pdps
                    INNER JOIN patientdoctorsplan pdd on pdd.id=pdps.patientdoctorplanId
                    INNER JOIN doctorsplans dp on dp.id = pdps.doctorplanId 
                    WHERE pdd.id = ".$docId." ORDER BY dp.description ASC"; 

        $patientdoctorsplansubs = DB::select($strsql);

        $doctorsPlans = DoctorsPlan::all();

        return view('patientdoctorsplan.edit',compact('docresults','patients','doctorsPlans','patientdoctorsplansubs'));
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

        $strsql ="SELECT * from patientdoctorsplan where id=".$request->txtPatientDoctorPlanId;
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

       $docfiles = PatientDoctorsPlan::find($request->txtPatientDoctorPlanId);
       $docfiles->patientid = $request->txtpatientId;

       $date = date_create($request->txtDocDate);
       $docfiles->docdate= $date->format('Y-m-d');

       $docfiles->description = $request->txtdescription;
       $docfiles->filelink = $imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;

       $docfiles->save();

       $sub = DB::table('patientdoctorsplansub')->where('patientdoctorplanId', $request->txtPatientDoctorPlanId)->delete();

       $doclab_id = $docfiles->id;

        $doctorplanId=$request->txtDoctorsPlanId;
        $doctorsPlanNote=$request->txtnote;

        $N = count($doctorplanId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PatientDoctorsPlanSub;
            $pricelistsub->patientdoctorplanId = $doclab_id; 
            $pricelistsub->doctorplanId = $doctorplanId[$i];
            $pricelistsub->notes = $doctorsPlanNote[$i];
            $pricelistsub->save();
            
        }

        return redirect()->to('/patientdoctorsplan/'.$request->txtpatientId);       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LabInvestigation  $labInvestigation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from patientdoctorsplan where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = PatientDoctorsPlan::destroy($request->del_id);
        $sub = DB::table('patientdoctorsplansub')->where('patientdoctorplanId', $request->del_id)->delete();

        return redirect()->to('/patientdoctorsplan/'.$request->txtpatientId);
    }
}