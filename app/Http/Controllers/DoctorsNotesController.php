<?php

namespace App\Http\Controllers;

use App\DoctorsNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Staff;
use App\Reason;
use App\Medicine;
use App\LabTest;
use App\DoctorsNotesSub;

use App\Http\Controllers\SystemFunctionController;

class DoctorsNotesController extends Controller
{
    protected $redirectTo = '/home'; 

    private $DocTransName = "Doctors Notes"; 
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
        return view('doctorsnotes.index');
    }

    public function PatientDoctorNotes($PatientId){
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from doctors_notes 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('doctorsnotes.patientindex',compact('docresult','patients'));
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

        $strsql ="select la.*,r.description from lead_assessments la 
                    inner join reasons r on r.id = la.reasonid
                    where la.id=".$PatientId;
        $leadassessments = DB::select($strsql);


        $labtests = LabTest::all();
        $staffs = Staff::all();
        $reasons = Reason::all();

        return view('doctorsnotes.new',compact('patients','leadassessments','staffs','reasons','labtests'));
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

        $docfiles = new DoctorsNotes;

        $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->description = $request->txtdescription;

        $docfiles->filelink = '/file/'.$imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $docnote_id = $docfiles->id;

        $LabTestId=$request->txtlabtestId;
        $labTestNote=$request->txtnote;

        $N = count($LabTestId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new DoctorsNotesSub;
            $pricelistsub->doctorsnotesid = $docnote_id; 
            $pricelistsub->labtestid = $LabTestId[$i];
            $pricelistsub->notes = $labTestNote[$i];
            $pricelistsub->save();
            
        }
    
        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($docnote_id,$this->DocTransName);
        
        return redirect()->to('/doctorsnotes/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DoctorsNotes  $doctorsNotes
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join doctors_notes as dn on dn.patientid = p.id
                    WHERE dn.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from doctors_notes 
                  where id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dns.*,lt.description from doctors_notes_subs dns
                    inner join doctors_notes dn on dn.id = dns.doctorsnotesid
                    inner join lab_tests lt on lt.id = dns.labtestid                  
                    where dn.id=".$docId." order by dns.id asc";
        $doctornotessubs = DB::select($strsql);

        $labtests = LabTest::all();
        $staffs = Staff::all();
        $reasons = Reason::all();

        return view('doctorsnotes.view',compact('docresults','patients','labtests','doctornotessubs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DoctorsNotes  $doctorsNotes
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join doctors_notes as dn on dn.patientid = p.id
                    WHERE dn.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from doctors_notes 
                  where id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dns.*,lt.description from doctors_notes_subs dns
                    inner join doctors_notes dn on dn.id = dns.doctorsnotesid
                    inner join lab_tests lt on lt.id = dns.labtestid                  
                    where dn.id=".$docId." order by dns.id asc";
        $doctornotessubs = DB::select($strsql);

        $labtests = LabTest::all();
        $staffs = Staff::all();
        $reasons = Reason::all();

        return view('doctorsnotes.edit',compact('docresults','patients','labtests','doctornotessubs'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DoctorsNotes  $doctorsNotes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorsNotes $doctorsNotes)
    {
        $imagepath = "";

        $strsql ="SELECT * from doctors_notes where id=".$request->txtDoctorNotesId;
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

       $docfiles = DoctorsNotes::find($request->txtDoctorNotesId);
       $docfiles->patientid = $request->txtpatientId;

       $date = date_create($request->txtDocDate);
       $docfiles->docdate= $date->format('Y-m-d');

       $docfiles->description = $request->txtdescription;
       $docfiles->filelink = $imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;

       $docfiles->save();

       $sub = DB::table('doctors_notes_subs')->where('doctorsnotesid', $request->txtDoctorNotesId)->delete();

        $LabTestId=$request->txtlabtestId;
        $labTestNote=$request->txtnote;

        $N = count($LabTestId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new DoctorsNotesSub;
            $pricelistsub->doctorsnotesid = $request->txtDoctorNotesId; 
            $pricelistsub->labtestid = $LabTestId[$i];
            $pricelistsub->notes = $labTestNote[$i];
            $pricelistsub->save();
            
        }

        return redirect()->to('/doctorsnotes/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DoctorsNotes  $doctorsNotes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $strsql ="SELECT * from doctors_notes where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = DoctorsNotes::destroy($request->del_id);
        $sub = DB::table('doctors_notes_subs')->where('doctorsnotesid', $request->del_id)->delete();

        return redirect()->to('/doctorsnotes/'.$request->txtpatientId);
    }

    
}
