<?php

namespace App\Http\Controllers;

use App\DiagnosticHyste;
use Illuminate\Http\Request;
use App\DoctorDiagnosis;
use App\DiagHysDiags;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiagnosticHysteController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Diagnostic Hysteroscopy";
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

    public function DiagHysteroscopy($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from DiagnosticyHysteroscopy 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('diagnostichysteroscopy.patientindex',compact('docresult','patients'));

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
        $doctorDiagnosis = DoctorDiagnosis::all();

        return view('diagnostichysteroscopy.new',compact('patients','doctorDiagnosis'));
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

        $docfiles = new DiagnosticHyste;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;

        $docfiles->filelink = '/file/'.$imagepath;
        $docfiles->createdbyid=Auth::user()->id;

        $docfiles->DiagHsyNote=$request->DiagHsyNote;
        $docfiles->LtOvary=$request->LtOvary;
        $docfiles->RtOvary=$request->RtOvary;
        $docfiles->EndoStripe=$request->EndoStripe;
        $docfiles->Fibroids=$request->Fibroids;
        $docfiles->Polyps=$request->Polyps;
        $docfiles->FreeFluid=$request->FreeFluid;
        $docfiles->Hydrosalpinx=$request->Hydrosalpinx;
        $docfiles->Comments=$request->Comments;
        $docfiles->IsVFok= $this->CheckCheckBox($request->IsVFok);
        $docfiles->NoWhy=$request->NoWhy;
        $docfiles->save();

        $doclab_id = $docfiles->id;

        $DiagnosisID=$request->DiagnosisID;

        $N = count($DiagnosisID);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new DiagHysDiags;
            $pricelistsub->DiagnHysId = $doclab_id; 
            $pricelistsub->DiagnosisId = $DiagnosisID[$i];
            $pricelistsub->save();
            
        }
       
        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/diaghyste/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DiagnosticHyste  $diagnosticHyste
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join DiagnosticyHysteroscopy as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from DiagnosticyHysteroscopy 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="SELECT doctordiagnosis.id,doctordiagnosis.description from DiagHysDiags
                    INNER JOIN doctordiagnosis on doctordiagnosis.id = DiagHysDiags.DiagnosisId
                    WHERE DiagnHysId =".$docId;
        $DiagnosisSubs = DB::select($strsql);

        return view('diagnostichysteroscopy.view',compact('patients','docresults','DiagnosisSubs','docId'));
    }

    public function PrintDiagHysteroscopy($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join DiagnosticyHysteroscopy as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from DiagnosticyHysteroscopy 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="SELECT doctordiagnosis.id,doctordiagnosis.description from DiagHysDiags
                    INNER JOIN doctordiagnosis on doctordiagnosis.id = DiagHysDiags.DiagnosisId
                    WHERE DiagnHysId =".$docId;
        $DiagnosisSubs = DB::select($strsql);

        return view('diagnostichysteroscopy.print',compact('patients','docresults','DiagnosisSubs','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DiagnosticHyste  $diagnosticHyste
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join DiagnosticyHysteroscopy as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from DiagnosticyHysteroscopy 
                  where id =".$docId;;
        $docresults = DB::select($strsql);

        $strsql ="SELECT doctordiagnosis.id,doctordiagnosis.description from DiagHysDiags
                    INNER JOIN doctordiagnosis on doctordiagnosis.id = DiagHysDiags.DiagnosisID
                    WHERE DiagnHysId =".$docId;
        $DiagnosisSubs = DB::select($strsql);

        $doctorDiagnosis = DoctorDiagnosis::all();

        return view('diagnostichysteroscopy.edit',compact('patients','docresults','DiagnosisSubs','doctorDiagnosis','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DiagnosticHyste  $diagnosticHyste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from DiagnosticyHysteroscopy where id=".$request->docId;
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

       $docfiles = DiagnosticHyste::find($request->docId);

       $date = date_create($request->txtDocDate);
       $docfiles->docdate= $date->format('Y-m-d');
       $docfiles->filelink=$imagepath;
        $docfiles->DiagHsyNote=$request->DiagHsyNote;
        $docfiles->LtOvary=$request->LtOvary;
        $docfiles->RtOvary=$request->RtOvary;
        $docfiles->EndoStripe=$request->EndoStripe;
        $docfiles->Fibroids=$request->Fibroids;
        $docfiles->Polyps=$request->Polyps;
        $docfiles->FreeFluid=$request->FreeFluid;
        $docfiles->Hydrosalpinx=$request->Hydrosalpinx;
        $docfiles->Comments=$request->Comments;
        $docfiles->IsVFok= $this->CheckCheckBox($request->IsVFok);
        $docfiles->NoWhy=$request->NoWhy;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('DiagHysDiags')->where('DiagnHysId', $request->docId)->delete();
        $DiagnosisID=$request->DiagnosisID;

        $N = count($DiagnosisID);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new DiagHysDiags;
            $pricelistsub->DiagnHysId = $doclab_id; 
            $pricelistsub->DiagnosisId = $DiagnosisID[$i];
            $pricelistsub->save();
            
        }

        return redirect()->to('/diaghyste/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DiagnosticHyste  $diagnosticHyste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from DiagnosticyHysteroscopy where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = DiagnosticHyste::destroy($request->del_id);

        return redirect()->to('/diaghyste/'.$request->txtpatientId);
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
