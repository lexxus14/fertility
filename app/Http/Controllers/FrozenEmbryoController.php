<?php

namespace App\Http\Controllers;

use App\FrozenEmbryo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Staff;
use App\Reason;
use App\Medicine;

use App\Http\Controllers\SystemFunctionController;

class FrozenEmbryoController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Frozen Embryos";      

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
        return view('frozenembryo.index');
    }

    public function PatientFrozenEmbryo($PatientId){
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="SELECT frozen_embryos.*,staff.name as Doctor,SN.name as Nurse from frozen_embryos 
                left join staff on staff.id = frozen_embryos.DoctorId
                left join staff as SN on SN.id = frozen_embryos.NurseId
                WHERE PatientId=".$PatientId;
        $frozenembryos = DB::select($strsql);

        $staffs = Staff::all();

        return view('frozenembryo.patientindex',compact('patients','staffs','frozenembryos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('frozenembryo.new');
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

        $frozenembryo = new FrozenEmbryo;
        // $lead->FileNo = $
        $frozenembryo->PatientId = $request->txtpatientId;

        $date = date_create($request->txtLeadDate);
        $frozenembryo->Date= $date->format('Y-m-d');

        $frozenembryo->DoctorId= $request->cmbDoctor;
        $frozenembryo->NurseId= $request->cmbNurse;
        $frozenembryo->FrozenEmbryo= $request->txtEggsCollected;
        $frozenembryo->Notes= $request->txtnoteassessment;    
        $frozenembryo->FileLink= '/file/'.$imagepath;
        $frozenembryo->createdbyid= Auth::user()->id;
        $frozenembryo->save();

        $transid = $frozenembryo->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($transid,$this->DocTransName);

        return redirect()->to('/frozenembryo/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FrozenEmbryo  $frozenEmbryo
     * @return \Illuminate\Http\Response
     */
    public function show($Id)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join frozen_embryos as ec on ec.patientid = p.id
                    WHERE ec.id =".$Id;
        $patients = DB::select($strsql);

        $strsql ="SELECT frozen_embryos.*,staff.id as DoctorId,SN.id as NurseId from frozen_embryos 
                left join staff on staff.id = frozen_embryos.DoctorId
                left join staff as SN on SN.id = frozen_embryos.NurseId
                WHERE frozen_embryos.id=".$Id;
        $frozenembryo = DB::select($strsql);

        $staffs = Staff::all();

        // return view('pricelist.edit');
        return view('frozenembryo.view',compact('frozenembryo','patients','staffs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FrozenEmbryo  $frozenEmbryo
     * @return \Illuminate\Http\Response
     */
    public function edit($Id)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join frozen_embryos as ec on ec.patientid = p.id
                    WHERE ec.id =".$Id;
        $patients = DB::select($strsql);

        $strsql ="SELECT frozen_embryos.*,staff.id as DoctorId,SN.id as NurseId from frozen_embryos 
                left join staff on staff.id = frozen_embryos.DoctorId
                left join staff as SN on SN.id = frozen_embryos.NurseId
                WHERE frozen_embryos.id=".$Id;
        $frozenembryos = DB::select($strsql);

        $staffs = Staff::all();

        // return view('pricelist.edit');
        return view('frozenembryo.edit',compact('frozenembryos','patients','staffs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FrozenEmbryo  $frozenEmbryo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from frozen_embryos where id=".$request->Id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->FileLink;
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
           $frozenembryo = FrozenEmbryo::find($request->Id);
            // $lead->FileNo = $
            $frozenembryo->PatientId = $request->txtpatientId;

            $date = date_create($request->txtLeadDate);
            $frozenembryo->Date= $date->format('Y-m-d');

            $frozenembryo->DoctorId= $request->cmbDoctor;
            $frozenembryo->NurseId= $request->cmbNurse;
            $frozenembryo->FrozenEmbryo= $request->txtEggsCollected;
            $frozenembryo->Notes= $request->txtnoteassessment;    
            $frozenembryo->FileLink= $imagepath;
            $frozenembryo->createdbyid= Auth::user()->id;
            $frozenembryo->save();

       }
       else{
            $imagepath = $laLinkFile;
            $frozenembryo = FrozenEmbryo::find($request->Id);
            // $lead->FileNo = $
            $frozenembryo->PatientId = $request->txtpatientId;

            $date = date_create($request->txtLeadDate);
            $frozenembryo->Date= $date->format('Y-m-d');

            $frozenembryo->DoctorId= $request->cmbDoctor;
            $frozenembryo->NurseId= $request->cmbNurse;
            $frozenembryo->FrozenEmbryo= $request->txtEggsCollected;
            $frozenembryo->Notes= $request->txtnoteassessment;    
            $frozenembryo->FileLink= $laLinkFile;
            $frozenembryo->createdbyid= Auth::user()->id;
            $frozenembryo->save();
       }

       
        return redirect()->to('/frozenembryo/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FrozenEmbryo  $frozenEmbryo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from frozen_embryos where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->FileLink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = FrozenEmbryo::destroy($request->del_id);

        return redirect()->to('/frozenembryo/'.$request->txtpatientId);
    }
}
