<?php

namespace App\Http\Controllers;

use App\PatientVitalSign;
use App\PatientVitalSignSub;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\VitalSign;

use App\Http\Controllers\SystemFunctionController;

class PatientVitalSignController extends Controller
{
    private $DocTransName = "Patient Vital Sign";
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
        return view('patientvitalsign.index');
    }

    public function PatientVitalSign($PatientId){
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from patientvitalsigns 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('patientvitalsign.patientindex',compact('docresult','patients'));
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

        $vitalSigns = VitalSign::all();

        return view('patientvitalsign.new',compact('patients','vitalSigns'));
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

        $docfiles = new PatientVitalSign;

        $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->description = $request->txtdescription;

        $docfiles->filelink = '/file/'.$imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $vitalsignId=$request->txtvitalsignId;
        $vitalsignNote=$request->txtnote;

        $N = count($vitalsignId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PatientVitalSignSub;
            $pricelistsub->patientvitalsignId = $doclab_id; 
            $pricelistsub->vitalsignId = $vitalsignId[$i];
            $pricelistsub->notes = $vitalsignNote[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/patientvitalsign/'.$request->txtpatientId);

        
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
                    inner join patientvitalsigns as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patientvitalsigns 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select pvss.*,vs.description from patientvitalsignsub pvss
                    inner join patientvitalsigns pvs on pvs.id = pvss.patientvitalsignId
                    inner join vitalsigns vs on vs.id = pvss.vitalsignId
                    where pvs.id = ".$docId." order by vs.description ASC";                   

        $patientvitalsignssubs = DB::select($strsql);


        return view('patientvitalsign.view',compact('docresults','patients','patientvitalsignssubs'));
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
                    inner join patientvitalsigns as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patientvitalsigns 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select pvss.*,vs.description from patientvitalsignsub pvss
                    inner join patientvitalsigns pvs on pvs.id = pvss.patientvitalsignId
                    inner join vitalsigns vs on vs.id = pvss.vitalsignId
                    where pvs.id = ".$docId." order by vs.description ASC";

        $patientvitalssubs = DB::select($strsql);

        $vitalSigns = VitalSign::all();

        return view('patientvitalsign.edit',compact('docresults','patients','vitalSigns','patientvitalssubs'));
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

        $strsql ="SELECT * from patientvitalsigns where id=".$request->txtPatientVitalSignId;
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

       $docfiles = PatientVitalSign::find($request->txtPatientVitalSignId);
       $docfiles->patientid = $request->txtpatientId;

       $date = date_create($request->txtDocDate);
       $docfiles->docdate= $date->format('Y-m-d');

       $docfiles->description = $request->txtdescription;
       $docfiles->filelink = $imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;

       $docfiles->save();

       $sub = DB::table('patientvitalsignsub')->where('patientvitalsignId', $request->txtPatientVitalSignId)->delete();

       $doclab_id = $docfiles->id;

        $VitalSignId=$request->txtvitalsignId;
        $vitalSignNote=$request->txtnote;

        $N = count($VitalSignId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PatientVitalSignSub;
            $pricelistsub->patientvitalsignId = $doclab_id; 
            $pricelistsub->vitalsignId = $VitalSignId[$i];
            $pricelistsub->notes = $vitalSignNote[$i];
            $pricelistsub->save();
            
        }

        return redirect()->to('/patientvitalsign/'.$request->txtpatientId);       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LabInvestigation  $labInvestigation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from patientvitalsigns where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = PatientVitalSign::destroy($request->del_id);
        $sub = DB::table('patientvitalsignsub')->where('patientvitalsignId', $request->del_id)->delete();

        return redirect()->to('/patientvitalsign/'.$request->txtpatientId);
    }
}