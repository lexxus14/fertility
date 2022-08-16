<?php

namespace App\Http\Controllers;

use App\Procedure;
use App\PatientProcedure;
use App\PatientProcedureSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SystemFunctionController;

class PatientProcedureController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Patient Procedure";   
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
    public function PatientProcedure($PatientId){
       $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select patient_procedures.* from patient_procedures 
                where patient_procedures.patientid = ".$PatientId;
        $docresult = DB::select($strsql);

        $procedures = DB::select("select * from procedures order by description asc");

        return view('patientprocedure.patientindex',compact('docresult','patients','procedures'));
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

        $procedures = Procedure::all();

        return view('patientprocedure.new',compact('patients','procedures'));
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

        $docfiles = new PatientProcedure;

        $date = date_create($request->txtDocDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->description = $request->txtdescription;

        $docfiles->filelink = 'file/'.$imagepath;

        $docfiles->notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $procedureId=$request->txtProcedureId;
        $procedureNote=$request->txtnote;

        $N = count($procedureId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PatientProcedureSub;
            $pricelistsub->patientprocedureid = $doclab_id;
            $pricelistsub->procedureId = $procedureId[$i];
            $pricelistsub->notes = $procedureNote[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);

        return redirect()->to('/patientprocedure/'.$request->txtpatientId);
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
                    inner join patient_procedures as px on px.patientid = p.id
                    WHERE px.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patient_procedures 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select pps.*,p.description as procedures from patient_procedures pp 
                inner join patient_procedure_subs pps on pps.patientprocedureid = pp.id
                inner join procedures p on p.id = pps.procedureId
            where pp.id=".$docId." order by pps.id asc";
        $patientproceduresubs = DB::select($strsql);

        $procedures = DB::select("select * from procedures order by description asc");

        return view('patientprocedure.view',compact('docresults','patients','procedures','patientproceduresubs'));
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
                    inner join patient_procedures as px on px.patientid = p.id
                    WHERE px.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from patient_procedures 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select pps.*,p.description as procedures from patient_procedures pp 
                inner join patient_procedure_subs pps on pps.patientprocedureid = pp.id
                inner join procedures p on p.id = pps.procedureId
            where pp.id=".$docId." order by pps.id asc";
        $patientproceduresubs = DB::select($strsql);

        $procedures = DB::select("select * from procedures order by description asc");

        return view('patientprocedure.edit',compact('docresults','patients','procedures','patientproceduresubs'));
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

        $strsql ="SELECT * from patient_procedures where id=".$request->txtDocId;
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

           $docfiles = PatientProcedure::find($request->txtDocId);
           $docfiles->patientid = $request->txtpatientId;

           $date = date_create($request->txtDocDate);
           $docfiles->docdate= $date->format('Y-m-d');
           $docfiles->description = $request->txtdescription;
           $docfiles->filelink = $imagepath;

            $docfiles->notes = $request->txtnotes;
            $docfiles->createdbyid=Auth::user()->id;

           $docfiles->save();
           $doclab_id = $docfiles->id;
           
           $sub = DB::table('patient_procedure_subs')->where('patientprocedureid', $request->txtDocId)->delete();

            $procedureId=$request->txtProcedureId;
            $procedureNote=$request->txtnote;

            $N = count($procedureId);

            for($i=0; $i < $N; $i++)
            {
                $pricelistsub = new PatientProcedureSub;
                $pricelistsub->patientprocedureid = $doclab_id;
                $pricelistsub->procedureId = $procedureId[$i];
                $pricelistsub->notes = $procedureNote[$i];
                $pricelistsub->save();
                
            }

            
       }
       else{
            $imagepath = $laLinkFile;

            $docfiles = PatientProcedure::find($request->txtDocId);
           $docfiles->patientid = $request->txtpatientId;

           $date = date_create($request->txtDocDate);
           $docfiles->docdate= $date->format('Y-m-d');

           $docfiles->description = $request->txtdescription;
           $docfiles->filelink = $imagepath;

            $docfiles->notes = $request->txtnotes;
            $docfiles->createdbyid=Auth::user()->id;

           $docfiles->save();
           $doclab_id = $docfiles->id;

           $sub = DB::table('patient_procedure_subs')->where('patientprocedureid', $request->txtDocId)->delete();

            $procedureId=$request->txtProcedureId;
            $procedureNote=$request->txtnote;

            $N = count($procedureId);

            for($i=0; $i < $N; $i++)
            {
                $pricelistsub = new PatientProcedureSub;
                $pricelistsub->patientprocedureid = $doclab_id;
                $pricelistsub->procedureId = $procedureId[$i];
                $pricelistsub->notes = $procedureNote[$i];
                $pricelistsub->save();
                
            }
       }

       
       return redirect()->to('/patientprocedure/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy(Request $request)
    {
         $strsql ="SELECT * from patient_procedures where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = PatientProcedure::destroy($request->del_id);
        $sub = DB::table('patient_procedure_subs')->where('patientprocedureid', $request->del_id)->delete();

        return redirect()->to('/patientprocedure/'.$request->txtpatientId);
    }
    public function GetProcedureInfo($id)
    {
        $task = Procedure::find($id);

        return response()->json($task);

    }
}
