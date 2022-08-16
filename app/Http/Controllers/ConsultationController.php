<?php

namespace App\Http\Controllers;

use App\Consultation;
use Illuminate\Http\Request;

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

use App\Http\Controllers\SystemFunctionController;

class ConsultationController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Reason"; 
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
        return view('consultation.index');
    }
    public function PatientConsultation($PatientId){
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from consultations 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('consultation.patientindex',compact('docresult','patients'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('consultation.new');
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

        $docfiles = new Consultation;

        $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->description = $request->txtdescription;
        $docfiles->incycle = $request->intInCycle;

        $docfiles->filelink = 'file/'.$imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();

        $transid = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($transid,$this->DocTransName);


        return redirect()->to('/consultation/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join consultations as px on px.patientid = p.id
                    WHERE px.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from consultations 
                  where id =".$docId;
        $docresult = DB::select($strsql);

        return view('consultation.view',compact('docresult','patients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join consultations as px on px.patientid = p.id
                    WHERE px.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from consultations 
                  where id =".$docId;;
        $docresult = DB::select($strsql);

        return view('consultation.edit',compact('docresult','patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from consultations where id=".$request->txtDocId;
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

           $docfiles = Consultation::find($request->txtDocId);
           $docfiles->patientid = $request->txtpatientId;

           $date = date_create($request->txtDocDate);
           $docfiles->docdate= $date->format('Y-m-d');

           $docfiles->description = $request->txtdescription;
           $docfiles->incycle = $request->intInCycle;
           $docfiles->filelink = $imagepath;

            $docfiles->notes = $request->txtnotes;
            $docfiles->createdbyid=Auth::user()->id;

           $docfiles->save();

            
       }
       else{
            $imagepath = $laLinkFile;

            $docfiles = Consultation::find($request->txtDocId);
           $docfiles->patientid = $request->txtpatientId;

           $date = date_create($request->txtDocDate);
           $docfiles->docdate= $date->format('Y-m-d');

           $docfiles->description = $request->txtdescription;
           $docfiles->incycle = $request->intInCycle;
           $docfiles->filelink = $imagepath;

            $docfiles->notes = $request->txtnotes;
            $docfiles->createdbyid=Auth::user()->id;

           $docfiles->save();
       }

       
       return redirect()->to('/consultation/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from consultations where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = Consultation::destroy($request->del_id);

        return redirect()->to('/consultation/'.$request->txtpatientId);
    }
}
