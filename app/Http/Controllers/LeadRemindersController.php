<?php

namespace App\Http\Controllers;

use App\LeadReminder;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Staff;
use App\Reason;

use App\Http\Controllers\SystemFunctionController;

class LeadRemindersController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Lead Reminder";      
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
        

        $leadreminder = new LeadReminder;
        $leadreminder->patientid = $request->txtpatientId;

        $date = date_create($request->txtLeadDateReminder);
        $leadreminder->date_reminder= $date->format('Y-m-d');


        $leadreminder->time_reminder = $request->txtLeadTimeReminder;
        $leadreminder->staffid = $request->cmbStaffReminder;
        $leadreminder->reasonid = $request->cmbReasonReminder;
        $leadreminder->createdbyid = Auth::user()->id;
        $leadreminder->notes = $request->txtnotereminder;
        
        $leadreminder->save();
        
        $transid = $leadreminder->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($transid,$this->DocTransName);

        return redirect()->to('/lead/view/'.$request->txtpatientId);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeadReminder  $leadReminder
     * @return \Illuminate\Http\Response
     */
    public function show($leadReminderid)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join lead_reminders as lr on lr.patientid = p.id
                    WHERE lr.id =".$leadReminderid;
        $patients = DB::select($strsql);

        $strsql ="select lr.*,r.description from lead_reminders lr 
                    inner join reasons r on r.id = lr.reasonid
                    where lr.id=".$leadReminderid;
        $leadreminders = DB::select($strsql);      

        $staffs = Staff::all();
        $reasons = Reason::all();

        $leadreminder = leadReminder::find($leadReminderid);
        $leadreminder->is_read = 1;
        $leadreminder->save();


        return view('leadreminder.view',compact('patients','leadreminders','staffs','reasons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeadReminder  $leadReminder
     * @return \Illuminate\Http\Response
     */
    public function edit($leadReminderid)
    {
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join lead_reminders as lr on lr.patientid = p.id
                    WHERE lr.id =".$leadReminderid;
        $patients = DB::select($strsql);

        $strsql ="select lr.*,r.description from lead_reminders lr 
                    inner join reasons r on r.id = lr.reasonid
                    where lr.id=".$leadReminderid;
        $leadreminders = DB::select($strsql);


        $staffs = Staff::all();
        $reasons = Reason::all();

        return view('leadreminder.edit',compact('patients','leadreminders','staffs','reasons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeadReminder  $leadReminder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $leadreminder = leadReminder::find($request->id);
        $leadreminder->patientid = $request->txtpatientId;

        $date = date_create($request->txtLeadDateReminder);
        $leadreminder->date_reminder= $date->format('Y-m-d');


        $leadreminder->time_reminder = $request->txtLeadTimeReminder;
        $leadreminder->staffid = $request->cmbStaffReminder;
        $leadreminder->reasonid = $request->cmbReasonReminder;
        $leadreminder->createdbyid = Auth::user()->id;
        $leadreminder->notes = $request->txtnotereminder;
        
        $leadreminder->save();

        $translinks = new SystemFunctionController;

        $translinks->UpdateTransLink($request->id,$this->DocTransName);
        
        return redirect()->to('/lead/view/'.$request->txtpatientId);
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeadReminder  $leadReminder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {        

        $leadreminder = leadReminder::destroy($request->del_id);

        $strsql ="SELECT * from patients
            WHERE id =".$request->txtpatientId;
        $patients = DB::select($strsql);

        $is_inpatient = 0;
        foreach($patients as $patientid){
            $is_inpatient =    $patientid->IsPatient;
        }
        

        return redirect()->to('/lead/view/'.$request->txtpatientId);

    }
}
