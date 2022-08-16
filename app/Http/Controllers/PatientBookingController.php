<?php

namespace App\Http\Controllers;

use App\PatientBooking;
use App\Staff;
use App\BookedStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientBookingController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Patient Booking";
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

    public function PatientBookingIndex($PatientId){
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select patientbooked.*,staff.name,bookedstatus.description from patientbooked
                    inner join staff on staff.id = patientbooked.staffid
                    inner join bookedstatus on bookedstatus.id = patientbooked.bookstatusid
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('patientbooking.patientindex',compact('docresult','patients'));
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

        $staffs = Staff::all();
        $bookedstatus = BookedStatus::all();

        return view('patientbooking.new',compact('patients','staffs','bookedstatus'));
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

        $docfiles = new PatientBooking;

        $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->bookedtime = $request->txtBookedTime;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->staffid = $request->cmbStaffId;
        $docfiles->bookstatusid = $request->cmbBookedStatusId;
        $docfiles->notes = $request->txtnotes;

        $docfiles->filelink = '/file/'.$imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/patientbooking/'.$request->txtpatientId);
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
                    inner join patientbooked as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select pb.*,s.name,bs.description from patientbooked as pb
                    inner join staff s on s.id = pb.StaffId
                    inner join bookedstatus bs on bs.id = pb.bookstatusid
                  where pb.id =".$docId;;
        $docresults = DB::select($strsql);

        return view('patientbooking.view',compact('docresults','patients'));
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
                    inner join patientbooked as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patientbooked 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $staffs = Staff::all();
        $bookedstatus = BookedStatus::all();

        return view('patientbooking.edit',compact('docresults','patients','staffs','bookedstatus'));
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

        $strsql ="SELECT * from patientbooked where id=".$request->txtPatientBookId;
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

       $docfiles = PatientBooking::find($request->txtPatientBookId);
       $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->bookedtime = $request->txtBookedTime;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->staffid = $request->cmbStaffId;
        $docfiles->bookstatusid = $request->cmbBookedStatusId;
        $docfiles->notes = $request->txtnotes;

        $docfiles->filelink = $imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();

        return redirect()->to('/patientbooking/'.$request->txtpatientId);       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from patientbooked where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = PatientBooking::destroy($request->del_id);

        return redirect()->to('/patientbooking/'.$request->txtpatientId);
    }
}
