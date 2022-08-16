<?php

namespace App\Http\Controllers;

use App\EggsFertilized;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Staff;
use App\Reason;
use App\Medicine;

use App\Http\Controllers\SystemFunctionController;

class EggsFertilizedController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Eggs Fertilized";
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
        return view('eggsfertilized.index');
    }

    public function PatientEggFertilized($PatientId){
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="SELECT eggs_fertilizeds.*,staff.name as Doctor,SN.name as Nurse from eggs_fertilizeds 
                left join staff on staff.id = eggs_fertilizeds.DoctorId
                left join staff as SN on SN.id = eggs_fertilizeds.NurseId
                WHERE PatientId=".$PatientId;
        $eggsfertilizeds = DB::select($strsql);

        $staffs = Staff::all();

        return view('eggsfertilized.patientindex',compact('patients','staffs','eggsfertilizeds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('eggsfertilized.new');
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

        $eggsCollected = new EggsFertilized;
        // $lead->FileNo = $
        $eggsCollected->PatientId = $request->txtpatientId;

        $date = date_create($request->txtLeadDate);
        $eggsCollected->Date= $date->format('Y-m-d');

        $eggsCollected->DoctorId= $request->cmbDoctor;
        $eggsCollected->NurseId= $request->cmbNurse;
        $eggsCollected->EggsFertilized= $request->txtEggsCollected;
        $eggsCollected->Notes= $request->txtnoteassessment;    
        $eggsCollected->FileLink= '/file/'.$imagepath;
        $eggsCollected->createdbyid= Auth::user()->id;
        $eggsCollected->save();

        $transid = $eggsCollected->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($transid,$this->DocTransName);
        return redirect()->to('/eggsfertilized/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EggsFertilized  $eggsFertilized
     * @return \Illuminate\Http\Response
     */
    public function show($Id)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join eggs_fertilizeds as ec on ec.patientid = p.id
                    WHERE ec.id =".$Id;
        $patients = DB::select($strsql);

        $strsql ="SELECT eggs_fertilizeds.*,staff.id as DoctorId,SN.id as NurseId from eggs_fertilizeds 
                left join staff on staff.id = eggs_fertilizeds.DoctorId
                left join staff as SN on SN.id = eggs_fertilizeds.NurseId
                WHERE eggs_fertilizeds.id=".$Id;
        $eggsfertilizeds = DB::select($strsql);

        $staffs = Staff::all();

        // return view('pricelist.edit');
        return view('eggsfertilized.view',compact('eggsfertilizeds','patients','staffs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EggsFertilized  $eggsFertilized
     * @return \Illuminate\Http\Response
     */
    public function edit($Id)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join eggs_fertilizeds as ec on ec.patientid = p.id
                    WHERE ec.id =".$Id;
        $patients = DB::select($strsql);

        $strsql ="SELECT eggs_fertilizeds.*,staff.id as DoctorId,SN.id as NurseId from eggs_fertilizeds 
                left join staff on staff.id = eggs_fertilizeds.DoctorId
                left join staff as SN on SN.id = eggs_fertilizeds.NurseId
                WHERE eggs_fertilizeds.id=".$Id;
        $eggsfertilizeds = DB::select($strsql);

        $staffs = Staff::all();

        // return view('pricelist.edit');
        return view('eggsfertilized.edit',compact('eggsfertilizeds','patients','staffs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EggsFertilized  $eggsFertilized
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from eggs_fertilizeds where id=".$request->Id;
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

           $imagepath = $imagepath;

           $eggsCollected = EggsFertilized::find($request->Id);
            // $lead->FileNo = $
            $eggsCollected->PatientId = $request->txtpatientId;

            $date = date_create($request->txtLeadDate);
            $eggsCollected->Date= $date->format('Y-m-d');

            $eggsCollected->DoctorId= $request->cmbDoctor;
            $eggsCollected->NurseId= $request->cmbNurse;
            $eggsCollected->EggsFertilized= $request->txtEggsCollected;
            $eggsCollected->Notes= $request->txtnoteassessment;    
            $eggsCollected->FileLink= '/file/'.$imagepath;
            $eggsCollected->createdbyid= Auth::user()->id;
            $eggsCollected->save();
       }
       else{
            $imagepath = $laLinkFile;
            $eggsCollected = EggsFertilized::find($request->Id);
            // $lead->FileNo = $
            $eggsCollected->PatientId = $request->txtpatientId;

            $date = date_create($request->txtLeadDate);
            $eggsCollected->Date= $date->format('Y-m-d');

            $eggsCollected->DoctorId= $request->cmbDoctor;
            $eggsCollected->NurseId= $request->cmbNurse;
            $eggsCollected->EggsFertilized= $request->txtEggsCollected;
            $eggsCollected->Notes= $request->txtnoteassessment;    
            $eggsCollected->FileLink= $laLinkFile;
            $eggsCollected->createdbyid= Auth::user()->id;
            $eggsCollected->save();
       }

       
        return redirect()->to('/eggsfertilized/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EggsFertilized  $eggsFertilized
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from eggs_fertilizeds where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->FileLink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = EggsFertilized::destroy($request->del_id);

        return redirect()->to('/eggsfertilized/'.$request->txtpatientId);
    }
}
