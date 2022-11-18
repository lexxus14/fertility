<?php

namespace App\Http\Controllers;
use App\Staff;
use App\EmbTraEmbFroEmb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EmbTraFroEmbController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Embryo Transfer with Frozen Embryos";

    public function EmbTraFroEmb($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from EmbTraEmbFroEmbs 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('embtrafroemb.patientindex',compact('docresult','patients'));
    }

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
    public function create($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $Staffs = Staff::all();

        return view('embtrafroemb.new',compact('patients','Staffs'));
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

        $docfiles = new EmbTraEmbFroEmb;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');


        $docfiles->Notes=$request->Notes;
        $docfiles->FrozenEmb=$request->FrozenEmb;

        $date = date_create($request->FrozenDate);
        $docfiles->FrozenDate= $date->format('Y-m-d');

        $docfiles->ThaEmby=$request->ThaEmby;

        $date = date_create($request->EmbyDate);
        $docfiles->EmbyDate= $date->format('Y-m-d');

        $docfiles->EmbyRem=$request->EmbyRem;
        $docfiles->EmbyTran=$request->EmbyTran;

        $date = date_create($request->TranDate);
        $docfiles->TranDate= $date->format('Y-m-d');

        $docfiles->IsAssHatchYes=$this->CheckCheckBox($request->IsAssHatchYes);
        $docfiles->IsAssHatchNo=$this->CheckCheckBox($request->IsAssHatchNo);
        $docfiles->PatientInit=$request->PatientInit;
        $docfiles->ET3=$request->ET3;
        $docfiles->ET5=$request->ET5;
        $docfiles->EmbryologistStaffId=$request->EmbryologistStaffId;
        $docfiles->MDStaffId=$request->MDStaffId;
        $docfiles->NurseStaffId=$request->NurseStaffId;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/embtrafroemb/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmbTraEmbFroEmb  $embTraEmbFroEmb
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join EmbTraEmbFroEmbs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select EmbTraEmbFroEmbs.*,p.name EmbryologistName,p1.name MDName,p2.name NurseName from EmbTraEmbFroEmbs 
                    left join staff as p on p.id = EmbTraEmbFroEmbs.EmbryologistStaffId
                    left join staff as p1 on p1.id = EmbTraEmbFroEmbs.MDStaffId
                    left join staff as p2 on p2.id = EmbTraEmbFroEmbs.NurseStaffId
                  where EmbTraEmbFroEmbs.id =".$docId;
        $docresults = DB::select($strsql);

        $Staffs = Staff::all();

        return view('embtrafroemb.view',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmbTraEmbFroEmb  $embTraEmbFroEmb
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join EmbTraEmbFroEmbs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select EmbTraEmbFroEmbs.*,p.name EmbryologistName,p1.name MDName,p2.name NurseName from EmbTraEmbFroEmbs 
                    left join staff as p on p.id = EmbTraEmbFroEmbs.EmbryologistStaffId
                    left join staff as p1 on p1.id = EmbTraEmbFroEmbs.MDStaffId
                    left join staff as p2 on p2.id = EmbTraEmbFroEmbs.NurseStaffId
                  where EmbTraEmbFroEmbs.id =".$docId;
        $docresults = DB::select($strsql);

        $Staffs = Staff::all();

        return view('embtrafroemb.edit',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmbTraEmbFroEmb  $embTraEmbFroEmb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from EmbTraEmbFroEmbs where id=".$request->docId;
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

       $docfiles = EmbTraEmbFroEmb::find($request->docId);
        $docfiles->filelink = $imagepath;   

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');


        $docfiles->Notes=$request->Notes;
        $docfiles->FrozenEmb=$request->FrozenEmb;

        $date = date_create($request->FrozenDate);
        $docfiles->FrozenDate= $date->format('Y-m-d');

        $docfiles->ThaEmby=$request->ThaEmby;

        $date = date_create($request->EmbyDate);
        $docfiles->EmbyDate= $date->format('Y-m-d');

        $docfiles->EmbyRem=$request->EmbyRem;
        $docfiles->EmbyTran=$request->EmbyTran;

        $date = date_create($request->TranDate);
        $docfiles->TranDate= $date->format('Y-m-d');

        $docfiles->IsAssHatchYes=$this->CheckCheckBox($request->IsAssHatchYes);
        $docfiles->IsAssHatchNo=$this->CheckCheckBox($request->IsAssHatchNo);
        $docfiles->PatientInit=$request->PatientInit;
        $docfiles->ET3=$request->ET3;
        $docfiles->ET5=$request->ET5;
        $docfiles->EmbryologistStaffId=$request->EmbryologistStaffId;
        $docfiles->MDStaffId=$request->MDStaffId;
        $docfiles->NurseStaffId=$request->NurseStaffId;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/embtrafroemb/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmbTraEmbFroEmb  $embTraEmbFroEmb
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from EmbTraEmbFroEmbs where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = EmbTraEmbFroEmb::destroy($request->del_id);

        return redirect()->to('/embtrafroemb/'.$request->txtpatientId);
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
