<?php

namespace App\Http\Controllers;

use App\FertilityResult;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Reason;
use App\Medicine;
use App\Staff;

use App\Http\Controllers\SystemFunctionController;

class FertilityResultController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Fertility Result";   
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

    public function PatientFertilityResult($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="SELECT fertility_results.*,staff.name as Doctor,SN.name as Nurse from fertility_results 
                left join staff on staff.id = fertility_results.DoctorId
                left join staff as SN on SN.id = fertility_results.NurseId
                WHERE PatientId=".$PatientId;
        $patientresults = DB::select($strsql);

        $staffs = Staff::all();

        return view('result.patientindex',compact('patientresults','staffs','patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('result.new');
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

        $goodembryo = new FertilityResult;
        // $lead->FileNo = $
        $goodembryo->PatientId = $request->txtpatientId;

        $date = date_create($request->txtLeadDate);
        $goodembryo->Date= $date->format('Y-m-d');

        $goodembryo->DoctorId= $request->cmbDoctor;
        $goodembryo->NurseId= $request->cmbNurse;
        $goodembryo->Result= $request->customRadio;
        $goodembryo->Notes= $request->txtnoteassessment;    
        $goodembryo->FileLink= '/file/'.$imagepath;
        $goodembryo->createdbyid= Auth::user()->id;
        $goodembryo->save();

        $transid = $goodembryo->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($transid,$this->DocTransName);

        return redirect()->to('/result/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FertilityResult  $fertilityResult
     * @return \Illuminate\Http\Response
     */
    public function show($Id)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join fertility_results as ec on ec.patientid = p.id
                    WHERE ec.id =".$Id;
        $patients = DB::select($strsql);

        $strsql ="SELECT fertility_results.*,staff.id as DoctorId,SN.id as NurseId from fertility_results 
                left join staff on staff.id = fertility_results.DoctorId
                left join staff as SN on SN.id = fertility_results.NurseId
                WHERE fertility_results.id=".$Id;
        $patientresults = DB::select($strsql);

        $staffs = Staff::all();

        // return view('pricelist.edit');
        return view('result.view',compact('patientresults','patients','staffs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FertilityResult  $fertilityResult
     * @return \Illuminate\Http\Response
     */
    public function edit($Id)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join fertility_results as ec on ec.patientid = p.id
                    WHERE ec.id =".$Id;
        $patients = DB::select($strsql);

        $strsql ="SELECT fertility_results.*,staff.id as DoctorId,SN.id as NurseId from fertility_results 
                left join staff on staff.id = fertility_results.DoctorId
                left join staff as SN on SN.id = fertility_results.NurseId
                WHERE fertility_results.id=".$Id;
        $patientresults = DB::select($strsql);

        $staffs = Staff::all();

        // return view('pricelist.edit');
        return view('result.edit',compact('patientresults','patients','staffs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FertilityResult  $fertilityResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from fertility_results where id=".$request->Id;
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
           $eggsCollected = FertilityResult::find($request->Id);
            // $lead->FileNo = $
            $eggsCollected->PatientId = $request->txtpatientId;

            $date = date_create($request->txtLeadDate);
            $eggsCollected->Date= $date->format('Y-m-d');

            $eggsCollected->DoctorId= $request->cmbDoctor;
            $eggsCollected->NurseId= $request->cmbNurse;
            $eggsCollected->Result= $request->customRadio;
            $eggsCollected->Notes= $request->txtnoteassessment;    
            $eggsCollected->FileLink= $imagepath;
            $eggsCollected->createdbyid= Auth::user()->id;
            $eggsCollected->save();

       }
       else{
            $imagepath = $laLinkFile;
            $eggsCollected = FertilityResult::find($request->Id);
            // $lead->FileNo = $
            $eggsCollected->PatientId = $request->txtpatientId;

            $date = date_create($request->txtLeadDate);
            $eggsCollected->Date= $date->format('Y-m-d');

            $eggsCollected->DoctorId= $request->cmbDoctor;
            $eggsCollected->NurseId= $request->cmbNurse;
            $eggsCollected->Result= $request->customRadio;
            $eggsCollected->Notes= $request->txtnoteassessment;    
            $eggsCollected->FileLink= $laLinkFile;
            $eggsCollected->createdbyid= Auth::user()->id;
            $eggsCollected->save();
       }

       
        return redirect()->to('/result/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FertilityResult  $fertilityResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from fertility_results where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->FileLink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = FertilityResult::destroy($request->del_id);

        return redirect()->to('/result/'.$request->txtpatientId);
    }
}
