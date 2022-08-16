<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\leadAssessment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Staff;
use App\Reason;

use App\Http\Controllers\SystemFunctionController;

class LeadAssessmentController extends Controller
{
    private $DocTransName = "Lead Assessment"; 
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
        return view('leadassessment.index');
    }
    public function PatientLeadAssessment($PatientId){
        return view('leadassessment.patientindex');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('leadassessment.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $imagepath = "";

        if ($files = $request->file('inputFileAssessment')) {
        // Define upload path
           $destinationPath = public_path('/file/'); // upload path
        // Upload Orginal Image           
           $imagepath = rand().date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $imagepath);
           $imagepath = 'file/'.$imagepath;
       }

        LeadAssessment::where('iscurrent','=','1')->
                        where('patientid','=',$request->txtpatientId)->update(['iscurrent' => 0]);

        $leadassessment = new LeadAssessment;
        $leadassessment->patientid = $request->txtpatientId;

        $date = date_create($request->txtLeadDate);
        $leadassessment->date= $date->format('Y-m-d');


        $leadassessment->staffid = $request->cmbStaff;
        $leadassessment->reasonid = $request->cmbReason;
        $leadassessment->createdbyid = Auth::user()->id;
        $leadassessment->assessmentrate = $request->txtRating;
        $leadassessment->FileLink = $imagepath;
        $leadassessment->notes = $request->txtnoteassessment;
        $leadassessment->iscurrent = 1;
        
        $leadassessment->save();
        $transid = $leadassessment->id;
        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($transid,$this->DocTransName);

        return redirect()->to('/lead/view/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HistoryAssessment  $historyAssessment
     * @return \Illuminate\Http\Response
     */
    public function show($leadAssessmentid)
    {
        //
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join lead_assessments as la on la.patientid = p.id
                    WHERE la.id =".$leadAssessmentid;
        $patients = DB::select($strsql);

        $strsql ="select la.*,r.description from lead_assessments la 
                    inner join reasons r on r.id = la.reasonid
                    where la.id=".$leadAssessmentid;
        $leadassessments = DB::select($strsql);


        $staffs = Staff::all();
        $reasons = Reason::all();

        return view('leadassessment.view',compact('patients','leadassessments','staffs','reasons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HistoryAssessment  $historyAssessment
     * @return \Illuminate\Http\Response
     */
    public function edit($leadAssessmentid)
    {
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join lead_assessments as la on la.patientid = p.id
                    WHERE la.id =".$leadAssessmentid;
        $patients = DB::select($strsql);

        $strsql ="select la.*,r.description from lead_assessments la 
                    inner join reasons r on r.id = la.reasonid
                    where la.id=".$leadAssessmentid;
        $leadassessments = DB::select($strsql);

        $staffs = Staff::all();
        $reasons = Reason::all();

        return view('leadassessment.edit',compact('patients','leadassessments','staffs','reasons'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HistoryAssessment  $historyAssessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from lead_assessments where id=".$request->id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->FileLink;
        }


        if ($files = $request->file('inputFileAssessment')) {
            
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
      
        $leadassessment = LeadAssessment::find($request->id);
        $leadassessment->patientid = $request->txtpatientId;

        $date = date_create($request->txtLeadDate);
        $leadassessment->date= $date->format('Y-m-d');


        $leadassessment->staffid = $request->cmbStaff;
        $leadassessment->reasonid = $request->cmbReason;
        $leadassessment->createdbyid = Auth::user()->id;
        $leadassessment->assessmentrate = $request->txtRating;
        $leadassessment->FileLink = $imagepath;
        $leadassessment->notes = $request->txtnoteassessment;
        
        $leadassessment->save();

        $translinks = new SystemFunctionController;

        $translinks->UpdateTransLink($request->id,$this->DocTransName);
        return redirect()->to('/lead/view/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HistoryAssessment  $historyAssessment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $strsql ="SELECT * from lead_assessments where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->FileLink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = LeadAssessment::destroy($request->del_id);
        return redirect()->to('/lead/view/'.$request->txtpatientId);
    }
}
