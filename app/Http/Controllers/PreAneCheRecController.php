<?php

namespace App\Http\Controllers;

use App\PreAneRecs;
use App\PreAneGenInfVitSigns;
use App\PreAnePreopDiags;
use App\PreAneProProcs;
use App\Procedure;
use App\DoctorDiagnosis;
use App\VitalSign;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PreAneCheRecController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Preoperative Checklist";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function PreAneCheRecs($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select PreAneCheRecs.*,p.name StaffName from PreAneCheRecs 
                    inner join staff as p on p.id = PreAneCheRecs.AnesthetistStaffId
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('preanecherecs.patientindex',compact('docresult','patients'));
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

        $VitalSigns = VitalSign::all();
        $Procedures = Procedure::all();
        $DoctorDiagnosis = DoctorDiagnosis::all();
        $Staffs = Staff::all();

        return view('preanecherecs.new',compact('patients','VitalSigns','Procedures','Staffs','DoctorDiagnosis'));
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

        $docfiles = new PreAneRecs;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;       

        $docfiles->PreAneSurHis=$request->PreAneSurHis; 
        $docfiles->CurTheraphy=$request->CurTheraphy;                 
        $docfiles->IsSpeRisHypertension=$this->CheckCheckBox($request->IsSpeRisHypertension); 
        $docfiles->IsSpeRiBronchialAsthma=$this->CheckCheckBox($request->IsSpeRiBronchialAsthma); 
        $docfiles->IsSpeRiCOPD=$this->CheckCheckBox($request->IsSpeRiCOPD); 
        $docfiles->IsSpeRiObesity=$this->CheckCheckBox($request->IsSpeRiObesity); 
        $docfiles->IsSpeRiDiaMellitus=$this->CheckCheckBox($request->IsSpeRiDiaMellitus); 
        $docfiles->IsSpeRiIscHeaDisease=$this->CheckCheckBox($request->IsSpeRiIscHeaDisease); 
        $docfiles->IsSpeRiAlcHistory=$this->CheckCheckBox($request->IsSpeRiAlcHistory); 
        $docfiles->IsSpeRiSmoHistory=$this->CheckCheckBox($request->IsSpeRiSmoHistory); 
        $docfiles->Others=$request->Others; 
        $docfiles->AirwayScore=$request->AirwayScore; 
        $docfiles->AsaScore=$request->AsaScore; 
        $docfiles->PreMedDruInsNote=$request->PreMedDruInsNote; 
        $docfiles->AnesthesiaPlan=$request->AnesthesiaPlan; 
        $docfiles->AnesthetistStaffId=$request->AnesthetistStaffId; 
        
        $date = date_create($request->AnesthetistDate);
        $docfiles->AnesthetistDate= $date->format('Y-m-d');

        $docfiles->AnesthetistTime=$request->AnesthetistTime; 
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $DiagnosisId=$request->DiagnosisId;

        $N = count($DiagnosisId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreAnePreopDiags;
            $pricelistsub->PreAneCheRecsId = $doclab_id; 
            $pricelistsub->DiagnosisId = $DiagnosisId[$i];
            $pricelistsub->save();
            
        }

        $ProcedureId=$request->ProcedureId;

        $N = count($ProcedureId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreAneProProcs;
            $pricelistsub->PreAneCheRecsId = $doclab_id; 
            $pricelistsub->ProcedureId = $ProcedureId[$i];
            $pricelistsub->save();
            
        }     

        $VitalSignId=$request->VitalSignId;
        $VitalSignRes=$request->VitalSignRes;

        $N = count($VitalSignRes);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreAneGenInfVitSigns;
            $pricelistsub->PreAneCheRecsId = $doclab_id; 
            $pricelistsub->VitalSignId = $VitalSignId[$i];
            $pricelistsub->VSResult = $VitalSignRes[$i];
            $pricelistsub->save();
            
        } 


        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/preanecherecs/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PreAneRecs  $preAneRecs
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join PreAneCheRecs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select PreAneCheRecs.*,p.name StaffName from PreAneCheRecs 
                    inner join staff as p on p.id = PreAneCheRecs.AnesthetistStaffId
                  where PreAneCheRecs.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dd.id,dd.description,VSResult from PreAneGenInfVitSigns 
            inner join VitalSigns dd on dd.id = PreAneGenInfVitSigns.VitalSignId
            where PreAneGenInfVitSigns.PreAneCheRecsId=".$docId;

        $PreAneGenInfVitSigns = DB::select($strsql);


        $strsql ="select dd.id,dd.description from PreAneProProcs 
                    inner join procedures dd on dd.id = PreAneProProcs.ProcedureId
                    where PreAneProProcs.PreAneCheRecsId=".$docId;

        $PreAneProProcs = DB::select($strsql);

        $strsql ="select dd.id,dd.description from PreAnePreopDiags 
                    inner join DoctorDiagnosis dd on dd.id = PreAnePreopDiags.DiagnosisId
                    where PreAnePreopDiags.PreAneCheRecsId=".$docId;

        $PreAnePreopDiags = DB::select($strsql);

        $VitalSigns = VitalSign::all();
        $Procedures = Procedure::all();
        $DoctorDiagnosis = DoctorDiagnosis::all();
        $Staffs = Staff::all();

        return view('preanecherecs.view',compact('docresults','patients','VitalSigns','Procedures','PreAneGenInfVitSigns','Staffs','PreAneProProcs','docId','PreAnePreopDiags','DoctorDiagnosis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PreAneRecs  $preAneRecs
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join PreAneCheRecs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select PreAneCheRecs.*,p.name StaffName from PreAneCheRecs 
                    inner join staff as p on p.id = PreAneCheRecs.AnesthetistStaffId
                  where PreAneCheRecs.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dd.id,dd.description,VSResult from PreAneGenInfVitSigns 
            inner join VitalSigns dd on dd.id = PreAneGenInfVitSigns.VitalSignId
            where PreAneGenInfVitSigns.PreAneCheRecsId=".$docId;

        $PreAneGenInfVitSigns = DB::select($strsql);


        $strsql ="select dd.id,dd.description from PreAneProProcs 
                    inner join procedures dd on dd.id = PreAneProProcs.ProcedureId
                    where PreAneProProcs.PreAneCheRecsId=".$docId;

        $PreAneProProcs = DB::select($strsql);

        $strsql ="select dd.id,dd.description from PreAnePreopDiags 
                    inner join DoctorDiagnosis dd on dd.id = PreAnePreopDiags.DiagnosisId
                    where PreAnePreopDiags.PreAneCheRecsId=".$docId;

        $PreAnePreopDiags = DB::select($strsql);

        $VitalSigns = VitalSign::all();
        $Procedures = Procedure::all();
        $DoctorDiagnosis = DoctorDiagnosis::all();
        $Staffs = Staff::all();

        return view('preanecherecs.edit',compact('docresults','patients','VitalSigns','Procedures','PreAneGenInfVitSigns','Staffs','PreAneProProcs','docId','PreAnePreopDiags','DoctorDiagnosis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PreAneRecs  $preAneRecs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from PreOperaChecklists where id=".$request->docId;
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

       $docfiles = PreAneRecs::find($request->docId);
        $docfiles->filelink = $imagepath;        
        $docfiles->createdbyid=Auth::user()->id;       

        $docfiles->PreAneSurHis=$request->PreAneSurHis; 
        $docfiles->CurTheraphy=$request->CurTheraphy;                 
        $docfiles->IsSpeRisHypertension=$this->CheckCheckBox($request->IsSpeRisHypertension); 
        $docfiles->IsSpeRiBronchialAsthma=$this->CheckCheckBox($request->IsSpeRiBronchialAsthma); 
        $docfiles->IsSpeRiCOPD=$this->CheckCheckBox($request->IsSpeRiCOPD); 
        $docfiles->IsSpeRiObesity=$this->CheckCheckBox($request->IsSpeRiObesity); 
        $docfiles->IsSpeRiDiaMellitus=$this->CheckCheckBox($request->IsSpeRiDiaMellitus); 
        $docfiles->IsSpeRiIscHeaDisease=$this->CheckCheckBox($request->IsSpeRiIscHeaDisease); 
        $docfiles->IsSpeRiAlcHistory=$this->CheckCheckBox($request->IsSpeRiAlcHistory); 
        $docfiles->IsSpeRiSmoHistory=$this->CheckCheckBox($request->IsSpeRiSmoHistory); 
        $docfiles->Others=$request->Others; 
        $docfiles->AirwayScore=$request->AirwayScore; 
        $docfiles->AsaScore=$request->AsaScore; 
        $docfiles->PreMedDruInsNote=$request->PreMedDruInsNote; 
        $docfiles->AnesthesiaPlan=$request->AnesthesiaPlan; 
        $docfiles->AnesthetistStaffId=$request->AnesthetistStaffId; 
        
        $date = date_create($request->AnesthetistDate);
        $docfiles->AnesthetistDate= $date->format('Y-m-d');

        $docfiles->AnesthetistTime=$request->AnesthetistTime; 
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('PreAnePreopDiags')->where('PreAneCheRecsId', $request->docId)->delete();
        $DiagnosisId=$request->DiagnosisId;

        $N = count($DiagnosisId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreAnePreopDiags;
            $pricelistsub->PreAneCheRecsId = $doclab_id; 
            $pricelistsub->DiagnosisId = $DiagnosisId[$i];
            $pricelistsub->save();
            
        }

        $sub = DB::table('PreAneProProcs')->where('PreAneCheRecsId', $request->docId)->delete();

        $ProcedureId=$request->ProcedureId;

        $N = count($ProcedureId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreAneProProcs;
            $pricelistsub->PreAneCheRecsId = $doclab_id; 
            $pricelistsub->ProcedureId = $ProcedureId[$i];
            $pricelistsub->save();
            
        }     

        $sub = DB::table('PreAneGenInfVitSigns')->where('PreAneCheRecsId', $request->docId)->delete();
        $VitalSignId=$request->VitalSignId;
        $VitalSignRes=$request->VitalSignRes;

        $N = count($VitalSignRes);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PreAneGenInfVitSigns;
            $pricelistsub->PreAneCheRecsId = $doclab_id; 
            $pricelistsub->VitalSignId = $VitalSignId[$i];
            $pricelistsub->VSResult = $VitalSignRes[$i];
            $pricelistsub->save();
            
        } 


        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/preanecherecs/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PreAneRecs  $preAneRecs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from PreAneCheRecs where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = PreAneRecs::destroy($request->del_id);

        return redirect()->to('/preanecherecs/'.$request->txtpatientId);
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
