<?php

namespace App\Http\Controllers;

use App\EggsCollected;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Staff;
use App\Reason;
use App\Medicine;

use App\Http\Controllers\SystemFunctionController;

class EggsCollectedController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Eggs Collecteds";  
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
        return view('eggscollected.EggsCollectedIndex');
    }

    public function PatientEggCollected($PatientId){
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="SELECT eggs_collecteds.*,staff.name as Doctor,SN.name as Nurse from eggs_collecteds 
                left join staff on staff.id = eggs_collecteds.DoctorId
                left join staff as SN on SN.id = eggs_collecteds.NurseId
                WHERE PatientId=".$PatientId;
        $eggscollecteds = DB::select($strsql);

        $staffs = Staff::all();

        return view('eggscollected.patientindex',compact('patients','staffs','eggscollecteds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('eggscollected.new');
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

        $eggsCollected = new EggsCollected;
        // $lead->FileNo = $
        $eggsCollected->PatientId = $request->txtpatientId;

        $date = date_create($request->txtLeadDate);
        $eggsCollected->Date= $date->format('Y-m-d');

        $eggsCollected->DoctorId= $request->cmbDoctor;
        $eggsCollected->NurseId= $request->cmbNurse;
        $eggsCollected->EggsCollected= $request->txtEggsCollected;
        $eggsCollected->Notes= $request->txtnoteassessment;    
        $eggsCollected->FileLink= '/file/'.$imagepath;
        $eggsCollected->createdbyid= Auth::user()->id;
        $eggsCollected->save();

        $transid = $eggsCollected->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($transid,$this->DocTransName);

        return redirect()->to('/eggscollected/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EggsCollected  $eggsCollected
     * @return \Illuminate\Http\Response
     */
    public function show($Id)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join eggs_collecteds as ec on ec.patientid = p.id
                    WHERE ec.id =".$Id;
        $patients = DB::select($strsql);

        $strsql ="SELECT eggs_collecteds.*,staff.id as DoctorId,SN.id as NurseId from eggs_collecteds 
                left join staff on staff.id = eggs_collecteds.DoctorId
                left join staff as SN on SN.id = eggs_collecteds.NurseId
                WHERE eggs_collecteds.id=".$Id;
        $eggscollecteds = DB::select($strsql);

        $staffs = Staff::all();

        // return view('pricelist.edit');
        return view('eggscollected.view',compact('eggscollecteds','patients','staffs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EggsCollected  $eggsCollected
     * @return \Illuminate\Http\Response
     */
    public function edit($Id)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join eggs_collecteds as ec on ec.patientid = p.id
                    WHERE ec.id =".$Id;
        $patients = DB::select($strsql);

        $strsql ="SELECT eggs_collecteds.*,staff.id as DoctorId,SN.id as NurseId from eggs_collecteds 
                left join staff on staff.id = eggs_collecteds.DoctorId
                left join staff as SN on SN.id = eggs_collecteds.NurseId
                WHERE eggs_collecteds.id=".$Id;
        $eggscollecteds = DB::select($strsql);

        $staffs = Staff::all();

        // return view('pricelist.edit');
        return view('eggscollected.edit',compact('eggscollecteds','patients','staffs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EggsCollected  $eggsCollected
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from eggs_collecteds where id=".$request->Id;
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
           $eggsCollected = EggsCollected::find($request->Id);
            // $lead->FileNo = $
            $eggsCollected->PatientId = $request->txtpatientId;

            $date = date_create($request->txtLeadDate);
            $eggsCollected->Date= $date->format('Y-m-d');

            $eggsCollected->DoctorId= $request->cmbDoctor;
            $eggsCollected->NurseId= $request->cmbNurse;
            $eggsCollected->EggsCollected= $request->txtEggsCollected;
            $eggsCollected->Notes= $request->txtnoteassessment;    
            $eggsCollected->FileLink= $imagepath;
            $eggsCollected->createdbyid= Auth::user()->id;
            $eggsCollected->save();

       }
       else{
            $imagepath = $laLinkFile;
            $eggsCollected = EggsCollected::find($request->Id);
            // $lead->FileNo = $
            $eggsCollected->PatientId = $request->txtpatientId;

            $date = date_create($request->txtLeadDate);
            $eggsCollected->Date= $date->format('Y-m-d');

            $eggsCollected->DoctorId= $request->cmbDoctor;
            $eggsCollected->NurseId= $request->cmbNurse;
            $eggsCollected->EggsCollected= $request->txtEggsCollected;
            $eggsCollected->Notes= $request->txtnoteassessment;    
            $eggsCollected->FileLink= $laLinkFile;
            $eggsCollected->createdbyid= Auth::user()->id;
            $eggsCollected->save();
       }

       
        return redirect()->to('/eggscollected/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EggsCollected  $eggsCollected
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from eggs_collecteds where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->FileLink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = EggsCollected::destroy($request->del_id);

        return redirect()->to('/eggscollected/'.$request->txtpatientId);
    }
}
