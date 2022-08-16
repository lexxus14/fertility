<?php

namespace App\Http\Controllers;

use App\LabInvestigation;
use App\LabInvestigationSub;
use Illuminate\Http\Request;

use App\PriceList;
use App\PriceListSub;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Staff;
use App\Reason;
use App\Medicine;
use App\LabTest;

use App\Http\Controllers\SystemFunctionController;

class LabInvestigationController extends Controller
{
    private $DocTransName = "Lab Investigation";
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
        return view('labinvestigation.index');
    }

    public function PatientLab($PatientId){
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from lab_investigations 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('labinvestigation.patientindex',compact('docresult','patients'));
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

        return view('labinvestigation.new',compact('patients','leadassessments','staffs','reasons','labtests'));
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

        $docfiles = new labInvestigation;

        $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->description = $request->txtdescription;

        $docfiles->filelink = '/file/'.$imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $LabTestId=$request->txtlabtestId;
        $labTestNote=$request->txtnote;

        $N = count($LabTestId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new LabInvestigationSub;
            $pricelistsub->labinvestigationid = $doclab_id; 
            $pricelistsub->labtestid = $LabTestId[$i];
            $pricelistsub->notes = $labTestNote[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/labinv/'.$request->txtpatientId);

        
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
                    inner join lab_investigations as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from lab_investigations 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select lis.*,lt.description from lab_investigation_subs lis 
                    inner join lab_investigations li on li.id = lis.labinvestigationid
                    inner join lab_tests lt on lt.id = lis.labtestid                
                    where li.id=".$docId." order by lis.id asc";
        $labinvsubs = DB::select($strsql);

        $labtests = LabTest::all();
        $staffs = Staff::all();
        $reasons = Reason::all();

        return view('labinvestigation.view',compact('docresults','patients','labtests','labinvsubs'));
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
                    inner join lab_investigations as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from lab_investigations 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select lis.*,lt.description from lab_investigation_subs lis 
                    inner join lab_investigations li on li.id = lis.labinvestigationid
                    inner join lab_tests lt on lt.id = lis.labtestid                
                    where li.id=".$docId." order by lis.id asc";
        $labinvsubs = DB::select($strsql);

        $labtests = LabTest::all();
        $staffs = Staff::all();
        $reasons = Reason::all();

        return view('labinvestigation.edit',compact('docresults','patients','labtests','labinvsubs'));
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

        $strsql ="SELECT * from lab_investigations where id=".$request->txtLabInvestigationId;
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

       $docfiles = LabInvestigation::find($request->txtLabInvestigationId);
       $docfiles->patientid = $request->txtpatientId;

       $date = date_create($request->txtDocDate);
       $docfiles->docdate= $date->format('Y-m-d');

       $docfiles->description = $request->txtdescription;
       $docfiles->filelink = $imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;

       $docfiles->save();

       $sub = DB::table('lab_investigation_subs')->where('labinvestigationid', $request->txtLabInvestigationId)->delete();

       $doclab_id = $docfiles->id;

        $LabTestId=$request->txtlabtestId;
        $labTestNote=$request->txtnote;

        $N = count($LabTestId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new LabInvestigationSub;
            $pricelistsub->labinvestigationid = $doclab_id; 
            $pricelistsub->labtestid = $LabTestId[$i];
            $pricelistsub->notes = $labTestNote[$i];
            $pricelistsub->save();
            
        }

        return redirect()->to('/labinv/'.$request->txtpatientId);       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LabInvestigation  $labInvestigation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from lab_investigations where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = LabInvestigation::destroy($request->del_id);
        $sub = DB::table('lab_investigation_subs')->where('labinvestigationid', $request->del_id)->delete();

        return redirect()->to('/labinv/'.$request->txtpatientId);
    }
}
