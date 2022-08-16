<?php

namespace App\Http\Controllers;

use App\LabTest;
use App\PatientDoctorsLab;
use App\PatientDoctorsLabSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientDoctrosLabController extends Controller
{
    
    private $DocTransName = "Patient Doctors Lab";
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

    public function PatientDoctorsLab($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from patientdoctorslabs 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('patientdoctorslab.patientindex',compact('docresult','patients'));
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

        $labtests = LabTest::all();

        return view('patientdoctorslab.new',compact('patients','labtests'));
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

        $docfiles = new PatientDoctorsLab;

        $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->description = $request->txtdescription;

        $docfiles->filelink = '/file/'.$imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $doctorsLabId=$request->txtDoctorsLabId;
        $doctorsPlanNote=$request->txtnote;

        $N = count($doctorsLabId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PatientDoctorsLabSub;
            $pricelistsub->patientdoctorlabId = $doclab_id; 
            $pricelistsub->labTestId = $doctorsLabId[$i];
            $pricelistsub->notes = $doctorsPlanNote[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/patientdoctorslab/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
       $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join patientdoctorslabs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patientdoctorslabs 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select pdps.*,dp.description from patientdoctorslabssubs pdps
                    INNER JOIN patientdoctorslabs pdd on pdd.id=pdps.patientdoctorlabId
                    INNER JOIN lab_tests dp on dp.id = pdps.labTestId 
                    WHERE pdd.id = ".$docId." ORDER BY dp.description ASC";   

        $patientdoctorlabsubs = DB::select($strsql);


        return view('patientdoctorslab.view',compact('docresults','patients','patientdoctorlabsubs')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join patientdoctorslabs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patientdoctorslabs 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select pdps.*,dp.description from patientdoctorslabssubs pdps
                    INNER JOIN patientdoctorslabs pdd on pdd.id=pdps.patientdoctorlabId
                    INNER JOIN lab_tests dp on dp.id = pdps.labTestId 
                    WHERE pdd.id = ".$docId." ORDER BY dp.description ASC"; 

        $patientdoctorlabsubs = DB::select($strsql);

        $labtests = LabTest::all();

        return view('patientdoctorslab.edit',compact('docresults','patients','labtests','patientdoctorlabsubs'));
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
        $imagepath = "";

        $strsql ="SELECT * from patientdoctorslabs where id=".$request->txtPatientDoctorLabId;
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

       $docfiles = PatientDoctorsLab::find($request->txtPatientDoctorLabId);
       $docfiles->patientid = $request->txtpatientId;

       $date = date_create($request->txtDocDate);
       $docfiles->docdate= $date->format('Y-m-d');

       $docfiles->description = $request->txtdescription;
       $docfiles->filelink = $imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;

       $docfiles->save();

       $sub = DB::table('patientdoctorslabssubs')->where('patientdoctorlabId', $request->txtPatientDoctorLabId)->delete();

       $doclab_id = $docfiles->id;

        $doctorLabId=$request->txtDoctorsLabId;
        $doctorsLabNote=$request->txtnote;

        $N = count($doctorLabId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PatientDoctorsLabSub;
            $pricelistsub->patientdoctorlabId = $doclab_id; 
            $pricelistsub->labTestId = $doctorLabId[$i];
            $pricelistsub->notes = $doctorsLabNote[$i];
            $pricelistsub->save();
            
        }

        return redirect()->to('/patientdoctorslab/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from patientdoctorslabs where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = PatientDoctorsLab::destroy($request->del_id);
        $sub = DB::table('patientdoctorslabssubs')->where('patientdoctorlabId', $request->del_id)->delete();

        return redirect()->to('/patientdoctorslab/'.$request->txtpatientId);
    }
}
