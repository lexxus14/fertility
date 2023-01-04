<?php

namespace App\Http\Controllers;

use App\Staff;
use App\IVFEmbryoTransDataSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IVFEmbryoTransDataSheetController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "IVF Embryo Transfer Data Sheet";

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

    public function IVFEmbryoTransDataSheet($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select IVFEmbryoTransDataSheet.*,p.name MDStaffName from IVFEmbryoTransDataSheet 
                    left join staff as p on p.id = IVFEmbryoTransDataSheet.MDStaffId
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('ivfembratransdatasheet.patientindex',compact('docresult','patients'));
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

        $Staffs = Staff::all();

        return view('ivfembratransdatasheet.new',compact('patients','Staffs'));
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

        $docfiles = new IVFEmbryoTransDataSheet;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->Notes=$request->Notes;


        $docfiles->EggsRetrieved=$request->EggsRetrieved;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $date = date_create($request->EggsRetrievedDate);
        $docfiles->EggsRetrievedDate= $date->format('Y-m-d');

        $docfiles->EggsFertilized=$request->EggsFertilized;

        $date = date_create($request->EggsFertilizedDate);
        $docfiles->EggsFertilizedDate=$date->format('Y-m-d');

        $docfiles->EmbryosTransd=$request->EmbryosTransd;

        $date = date_create($request->EmbryosTransdDate);
        $docfiles->EmbryosTransdDate=$date->format('Y-m-d');


        $docfiles->IsDay3=$this->CheckCheckBox($request->IsDay3);
        $docfiles->IsDay5=$this->CheckCheckBox($request->IsDay5);
        $docfiles->EmbryosDis=$request->EmbryosDis;
        $docfiles->IsICSI=$this->CheckCheckBox($request->IsICSI);
        $docfiles->ICSIPatientInitials=$request->ICSIPatientInitials;
        $docfiles->IsAssistedHatch=$this->CheckCheckBox($request->IsAssistedHatch);
        $docfiles->AssistedHatchPatientInitials=$request->AssistedHatchPatientInitials;

        $date = date_create($request->EmbryosTransDate);
        $docfiles->EmbryosTransDate=$date->format('Y-m-d');


        $docfiles->IsVerifiedCorrectName=$this->CheckCheckBox($request->IsVerifiedCorrectName);
        $docfiles->VerifiedCorrectNamePatientInitials=$request->VerifiedCorrectNamePatientInitials;
        $docfiles->NurseStaffId=$request->NurseStaffId;
        $docfiles->EmbryologistStaffId=$request->EmbryologistStaffId;
        $docfiles->MDStaffId=$request->MDStaffId;

        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/ivfembratransdatasheet/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IVFEmbryoTransDataSheet  $iVFEmbryoTransDataSheet
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join IVFEmbryoTransDataSheet as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select IVFEmbryoTransDataSheet.*,p.name NurseName,p1.name EmbryologistName,p2.name MDName from IVFEmbryoTransDataSheet 
                    left join staff as p on p.id = IVFEmbryoTransDataSheet.NurseStaffId
                    left join staff as p1 on p1.id = IVFEmbryoTransDataSheet.EmbryologistStaffId
                    left join staff as p2 on p2.id = IVFEmbryoTransDataSheet.MDStaffId
                  where IVFEmbryoTransDataSheet.id =".$docId;
        $docresults = DB::select($strsql);


        $Staffs = Staff::all();

        return view('ivfembratransdatasheet.view',compact('docresults','patients','Staffs','docId'));
    }

    public function PrintIVFEmbryoTransDataSheet($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join IVFEmbryoTransDataSheet as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select IVFEmbryoTransDataSheet.*,p.name NurseName,p1.name EmbryologistName,p2.name MDName from IVFEmbryoTransDataSheet 
                    left join staff as p on p.id = IVFEmbryoTransDataSheet.NurseStaffId
                    left join staff as p1 on p1.id = IVFEmbryoTransDataSheet.EmbryologistStaffId
                    left join staff as p2 on p2.id = IVFEmbryoTransDataSheet.MDStaffId
                  where IVFEmbryoTransDataSheet.id =".$docId;
        $docresults = DB::select($strsql);


        $Staffs = Staff::all();

        return view('ivfembratransdatasheet.print',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IVFEmbryoTransDataSheet  $iVFEmbryoTransDataSheet
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join IVFEmbryoTransDataSheet as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select IVFEmbryoTransDataSheet.*,p.name NurseName,p1.name EmbryologistName,p2.name MDName from IVFEmbryoTransDataSheet 
                    left join staff as p on p.id = IVFEmbryoTransDataSheet.NurseStaffId
                    left join staff as p1 on p1.id = IVFEmbryoTransDataSheet.EmbryologistStaffId
                    left join staff as p2 on p2.id = IVFEmbryoTransDataSheet.MDStaffId
                  where IVFEmbryoTransDataSheet.id =".$docId;
        $docresults = DB::select($strsql);


        $Staffs = Staff::all();

        return view('ivfembratransdatasheet.edit',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IVFEmbryoTransDataSheet  $iVFEmbryoTransDataSheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from IVFEmbryoTransDataSheet where id=".$request->docId;
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

       $docfiles = IVFEmbryoTransDataSheet::find($request->docId);
        $docfiles->filelink = $imagepath;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->Notes=$request->Notes;


        $docfiles->EggsRetrieved=$request->EggsRetrieved;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $date = date_create($request->EggsRetrievedDate);
        $docfiles->EggsRetrievedDate= $date->format('Y-m-d');

        $docfiles->EggsFertilized=$request->EggsFertilized;

        $date = date_create($request->EggsFertilizedDate);
        $docfiles->EggsFertilizedDate=$date->format('Y-m-d');

        $docfiles->EmbryosTransd=$request->EmbryosTransd;

        $date = date_create($request->EmbryosTransdDate);
        $docfiles->EmbryosTransdDate=$date->format('Y-m-d');


        $docfiles->IsDay3=$this->CheckCheckBox($request->IsDay3);
        $docfiles->IsDay5=$this->CheckCheckBox($request->IsDay5);
        $docfiles->EmbryosDis=$request->EmbryosDis;
        $docfiles->IsICSI=$this->CheckCheckBox($request->IsICSI);
        $docfiles->ICSIPatientInitials=$request->ICSIPatientInitials;
        $docfiles->IsAssistedHatch=$this->CheckCheckBox($request->IsAssistedHatch);
        $docfiles->AssistedHatchPatientInitials=$request->AssistedHatchPatientInitials;

        $date = date_create($request->EmbryosTransDate);
        $docfiles->EmbryosTransDate=$date->format('Y-m-d');


        $docfiles->IsVerifiedCorrectName=$this->CheckCheckBox($request->IsVerifiedCorrectName);
        $docfiles->VerifiedCorrectNamePatientInitials=$request->VerifiedCorrectNamePatientInitials;
        $docfiles->NurseStaffId=$request->NurseStaffId;
        $docfiles->EmbryologistStaffId=$request->EmbryologistStaffId;
        $docfiles->MDStaffId=$request->MDStaffId;

        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/ivfembratransdatasheet/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IVFEmbryoTransDataSheet  $iVFEmbryoTransDataSheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from IVFEmbryoTransDataSheet where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = IVFEmbryoTransDataSheet::destroy($request->del_id);

        return redirect()->to('/ivfembratransdatasheet/'.$request->txtpatientId);
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
