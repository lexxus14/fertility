<?php

namespace App\Http\Controllers;

use App\ConOfAnesthesia;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConOfAnesthesiaController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Consent of Anesthesia";

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

    public function ConOfAnesthesia($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select ConOfAnesthesia.*,p.name StaffName from ConOfAnesthesia 
                    left join staff as p on p.id = ConOfAnesthesia.AnesthetistStaffId
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('conofanesthesia.patientindex',compact('docresult','patients'));
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

        return view('conofanesthesia.new',compact('patients','Staffs'));
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

        $docfiles = new ConOfAnesthesia;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->OperationName= $request->OperationName;
        $docfiles->AnesthetistStaffId= $request->AnesthetistStaffId;
        $docfiles->SurgicalProcedure= $request->SurgicalProcedure;
        $docfiles->AneOfChoice= $request->AneOfChoice;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/conofanesthesia/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConOfAnesthesia  $conOfAnesthesia
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join ConOfAnesthesia as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select ConOfAnesthesia.*,p.name StaffName from ConOfAnesthesia 
                    left join staff as p on p.id = ConOfAnesthesia.AnesthetistStaffId
                  where ConOfAnesthesia.id =".$docId;
        $docresults = DB::select($strsql);

        $Staffs = Staff::all();

        return view('conofanesthesia.view',compact('docresults','patients','Staffs','docId'));
    }

    public function PrintConOfAnesthesia($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join ConOfAnesthesia as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select ConOfAnesthesia.*,p.name StaffName from ConOfAnesthesia 
                    left join staff as p on p.id = ConOfAnesthesia.AnesthetistStaffId
                  where ConOfAnesthesia.id =".$docId;
        $docresults = DB::select($strsql);

        $Staffs = Staff::all();

        return view('conofanesthesia.print',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConOfAnesthesia  $conOfAnesthesia
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join ConOfAnesthesia as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select ConOfAnesthesia.*,p.name StaffName from ConOfAnesthesia 
                    left join staff as p on p.id = ConOfAnesthesia.AnesthetistStaffId
                  where ConOfAnesthesia.id =".$docId;
        $docresults = DB::select($strsql);

        $Staffs = Staff::all();

        return view('conofanesthesia.edit',compact('docresults','patients','Staffs','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConOfAnesthesia  $conOfAnesthesia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from ConOfAnesthesia where id=".$request->docId;
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

       $docfiles = ConOfAnesthesia::find($request->docId);
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = $imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->OperationName= $request->OperationName;
        $docfiles->AnesthetistStaffId= $request->AnesthetistStaffId;
        $docfiles->SurgicalProcedure= $request->SurgicalProcedure;
        $docfiles->AneOfChoice= $request->AneOfChoice;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/conofanesthesia/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConOfAnesthesia  $conOfAnesthesia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from ConOfAnesthesia where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = ConOfAnesthesia::destroy($request->del_id);

        return redirect()->to('/conofanesthesia/'.$request->txtpatientId);
    }
}
