<?php

namespace App\Http\Controllers;

use App\PostOpPostNotes;
use App\Procedure;
use App\DoctorDiagnosis;
use App\PreOpDiagnosis;
use App\PreOpFindingsPostOpDiag;
use App\PreOpProcedure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PostOpPostProcNotesController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Post Op Pro Notes";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function PostOpPostProcNotes($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from PostOpPostProcNotes 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('postoppostprocnotes.patientindex',compact('docresult','patients'));
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
    public function create($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $DoctorDiagnosis = DoctorDiagnosis::all();
        $Procedures = Procedure::all();

        return view('postoppostprocnotes.new',compact('patients','DoctorDiagnosis','Procedures'));
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

        $docfiles = new PostOpPostNotes;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->docTime= $request->docTime;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $docfiles->SurgeonPerformingMD= $request->SurgeonPerformingMD;
        $docfiles->Anesthesiologist= $request->Anesthesiologist;
        $docfiles->AnesthesiaUsed= $request->AnesthesiaUsed;
        $docfiles->Specimens= $request->Specimens;
        $docfiles->Drains= $request->Drains;
        $docfiles->EstBloodLoss= $request->EstBloodLoss;
        $docfiles->Complications= $request->Complications;
        $docfiles->IsConStable= $this->CheckCheckBox($request->IsConStable);
        $docfiles->IsConGuarded= $this->CheckCheckBox($request->IsConGuarded);
        $docfiles->IsConCritical= $this->CheckCheckBox($request->IsConCritical);
        $docfiles->ConOthers= $request->ConOthers;
        $docfiles->Notes= $request->Notes;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $PreDiagnosisId=$request->PreDiagnosisId;

        $N = count($PreDiagnosisId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreOpDiagnosis;
            $pricelistsub->PostOpPostProcNotesId = $doclab_id; 
            $pricelistsub->PreDiagnosisId = $PreDiagnosisId[$i];
            $pricelistsub->save();
            
        }

        $ProcedureId=$request->ProcedureId;

        $N = count($ProcedureId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreOpProcedure;
            $pricelistsub->PostOpPostProcNotesId = $doclab_id; 
            $pricelistsub->ProcedureId = $ProcedureId[$i];
            $pricelistsub->save();
            
        }

        $FindingDiagnosisId=$request->FindingDiagnosisId;

        $N = count($FindingDiagnosisId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreOpFindingsPostOpDiag;
            $pricelistsub->PostOpPostProcNotesId = $doclab_id; 
            $pricelistsub->DiagnosisId = $FindingDiagnosisId[$i];
            $pricelistsub->save();
            
        }


        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/poppnotes/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostOpPostNotes  $postOpPostNotes
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join PostOpPostProcNotes as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from PostOpPostProcNotes 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select dd.id,dd.description from PreOpDiagnosis 
                    inner join DoctorDiagnosis dd on dd.id = PreOpDiagnosis.PreDiagnosisId
                    where PreOpDiagnosis.PostOpPostProcNotesId=".$docId;

        $PreOpDiagnosis = DB::select($strsql);

        $strsql ="select dd.id,dd.description from PreOpProcedures 
                    inner join procedures dd on dd.id = PreOpProcedures.ProcedureId
                    where PreOpProcedures.PostOpPostProcNotesId=".$docId;

        $PreOpProcedures = DB::select($strsql);

        $strsql ="select dd.id,dd.description from FindingPostOpDiags 
                    inner join DoctorDiagnosis dd on dd.id = FindingPostOpDiags.DiagnosisId
                    where FindingPostOpDiags.PostOpPostProcNotesId=".$docId;

        $FindingPostOpDiags = DB::select($strsql);

        $DoctorDiagnosis = DoctorDiagnosis::all();
        $Procedures = Procedure::all();

        return view('postoppostprocnotes.view',compact('docresults','patients','DoctorDiagnosis','Procedures','PreOpDiagnosis','PreOpProcedures','FindingPostOpDiags','docId'));
    }

    public function PrintPostOpPostProcNotes($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join PostOpPostProcNotes as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from PostOpPostProcNotes 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select dd.id,dd.description from PreOpDiagnosis 
                    inner join DoctorDiagnosis dd on dd.id = PreOpDiagnosis.PreDiagnosisId
                    where PreOpDiagnosis.PostOpPostProcNotesId=".$docId;

        $PreOpDiagnosis = DB::select($strsql);

        $strsql ="select dd.id,dd.description from PreOpProcedures 
                    inner join procedures dd on dd.id = PreOpProcedures.ProcedureId
                    where PreOpProcedures.PostOpPostProcNotesId=".$docId;

        $PreOpProcedures = DB::select($strsql);

        $strsql ="select dd.id,dd.description from FindingPostOpDiags 
                    inner join DoctorDiagnosis dd on dd.id = FindingPostOpDiags.DiagnosisId
                    where FindingPostOpDiags.PostOpPostProcNotesId=".$docId;

        $FindingPostOpDiags = DB::select($strsql);

        return view('postoppostprocnotes.print',compact('docresults','patients','DoctorDiagnosis','Procedures','PreOpDiagnosis','PreOpProcedures','FindingPostOpDiags','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostOpPostNotes  $postOpPostNotes
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join PostOpPostProcNotes as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from PostOpPostProcNotes 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="select dd.id,dd.description from PreOpDiagnosis 
                    inner join DoctorDiagnosis dd on dd.id = PreOpDiagnosis.PreDiagnosisId
                    where PreOpDiagnosis.PostOpPostProcNotesId=".$docId;

        $PreOpDiagnosis = DB::select($strsql);

        $strsql ="select dd.id,dd.description from PreOpProcedures 
                    inner join procedures dd on dd.id = PreOpProcedures.ProcedureId
                    where PreOpProcedures.PostOpPostProcNotesId=".$docId;

        $PreOpProcedures = DB::select($strsql);

        $strsql ="select dd.id,dd.description from FindingPostOpDiags 
                    inner join DoctorDiagnosis dd on dd.id = FindingPostOpDiags.DiagnosisId
                    where FindingPostOpDiags.PostOpPostProcNotesId=".$docId;

        $FindingPostOpDiags = DB::select($strsql);

        $DoctorDiagnosis = DoctorDiagnosis::all();
        $Procedures = Procedure::all();

        return view('postoppostprocnotes.edit',compact('docresults','patients','DoctorDiagnosis','Procedures','PreOpDiagnosis','PreOpProcedures','FindingPostOpDiags','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostOpPostNotes  $postOpPostNotes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from PostOpPostProcNotes where id=".$request->DocId;
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

       $docfiles = PostOpPostNotes::find($request->DocId);
       $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->docTime= $request->docTime;
        $docfiles->filelink =$imagepath;        
        $docfiles->SurgeonPerformingMD= $request->SurgeonPerformingMD;
        $docfiles->Anesthesiologist= $request->Anesthesiologist;
        $docfiles->AnesthesiaUsed= $request->AnesthesiaUsed;
        $docfiles->Specimens= $request->Specimens;
        $docfiles->Drains= $request->Drains;
        $docfiles->EstBloodLoss= $request->EstBloodLoss;
        $docfiles->Complications= $request->Complications;
        $docfiles->IsConStable= $this->CheckCheckBox($request->IsConStable);
        $docfiles->IsConGuarded= $this->CheckCheckBox($request->IsConGuarded);
        $docfiles->IsConCritical= $this->CheckCheckBox($request->IsConCritical);
        $docfiles->ConOthers= $request->ConOthers;
        $docfiles->Notes= $request->Notes;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('PreOpDiagnosis')->where('PostOpPostProcNotesId', $request->DocId)->delete();
        $PreDiagnosisId=$request->PreDiagnosisId;

        $N = count($PreDiagnosisId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreOpDiagnosis;
            $pricelistsub->PostOpPostProcNotesId = $doclab_id; 
            $pricelistsub->PreDiagnosisId = $PreDiagnosisId[$i];
            $pricelistsub->save();
            
        }

        $sub = DB::table('PreOpProcedures')->where('PostOpPostProcNotesId', $request->DocId)->delete();

        $ProcedureId=$request->ProcedureId;

        $N = count($ProcedureId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreOpProcedure;
            $pricelistsub->PostOpPostProcNotesId = $doclab_id; 
            $pricelistsub->ProcedureId = $ProcedureId[$i];
            $pricelistsub->save();
            
        }

        $sub = DB::table('FindingPostOpDiags')->where('PostOpPostProcNotesId', $request->DocId)->delete();

        $FindingDiagnosisId=$request->FindingDiagnosisId;

        $N = count($FindingDiagnosisId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreOpFindingsPostOpDiag;
            $pricelistsub->PostOpPostProcNotesId = $doclab_id; 
            $pricelistsub->DiagnosisId = $FindingDiagnosisId[$i];
            $pricelistsub->save();
            
        }

       
       return redirect()->to('/poppnotes/'.$request->txtpatientId); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostOpPostNotes  $postOpPostNotes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         $strsql ="SELECT * from PostOpPostProcNotes where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = PostOpPostNotes::destroy($request->del_id);

        return redirect()->to('/poppnotes/'.$request->txtpatientId);
    }
    public function CheckCheckBox($CheckBox)
    {
        //
        if($CheckBox=='on')
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
}
