<?php

namespace App\Http\Controllers;

use App\GoodEmbryo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Reason;
use App\Medicine;
use App\Staff;
use App\Http\Controllers\SystemFunctionController;
class GoodEmbryoController extends Controller
{
    private $DocTransName = "Good Embryo";      

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
        return view('goodembryo.index');
    }
    public function PatientGoodEmbryo($PatientId){
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="SELECT good_embryos.*,staff.name as Doctor,SN.name as Nurse from good_embryos 
                left join staff on staff.id = good_embryos.DoctorId
                left join staff as SN on SN.id = good_embryos.NurseId
                WHERE PatientId=".$PatientId;
        $goodembryos = DB::select($strsql);

        $staffs = Staff::all();

        return view('goodembryo.patientindex',compact('patients','staffs','goodembryos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('goodembryo.new');
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

        $goodembryo = new GoodEmbryo;
        // $lead->FileNo = $
        $goodembryo->PatientId = $request->txtpatientId;

        $date = date_create($request->txtLeadDate);
        $goodembryo->Date= $date->format('Y-m-d');

        $goodembryo->DoctorId= $request->cmbDoctor;
        $goodembryo->NurseId= $request->cmbNurse;
        $goodembryo->GoodEmbryo= $request->txtEggsCollected;
        $goodembryo->Notes= $request->txtnoteassessment;    
        $goodembryo->FileLink= '/file/'.$imagepath;
        $goodembryo->createdbyid= Auth::user()->id;
        $goodembryo->save();

        $transid = $goodembryo->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($transid,$this->DocTransName);

        return redirect()->to('/goodembryo/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GoodEmbryo  $goodEmbryo
     * @return \Illuminate\Http\Response
     */
    public function show($Id)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join good_embryos as ec on ec.patientid = p.id
                    WHERE ec.id =".$Id;
        $patients = DB::select($strsql);

        $strsql ="SELECT good_embryos.*,staff.id as DoctorId,SN.id as NurseId from good_embryos 
                left join staff on staff.id = good_embryos.DoctorId
                left join staff as SN on SN.id = good_embryos.NurseId
                WHERE good_embryos.id=".$Id;
        $goodembryos = DB::select($strsql);

        $staffs = Staff::all();

        // return view('pricelist.edit');
        return view('goodembryo.view',compact('goodembryos','patients','staffs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GoodEmbryo  $goodEmbryo
     * @return \Illuminate\Http\Response
     */
    public function edit($Id)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join good_embryos as ec on ec.patientid = p.id
                    WHERE ec.id =".$Id;
        $patients = DB::select($strsql);

        $strsql ="SELECT good_embryos.*,staff.id as DoctorId,SN.id as NurseId from good_embryos 
                left join staff on staff.id = good_embryos.DoctorId
                left join staff as SN on SN.id = good_embryos.NurseId
                WHERE good_embryos.id=".$Id;
        $goodembryos = DB::select($strsql);

        $staffs = Staff::all();

        // return view('pricelist.edit');
        return view('goodembryo.edit',compact('goodembryos','patients','staffs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GoodEmbryo  $goodEmbryo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoodEmbryo $goodEmbryo)
    {
        $imagepath = "";

        $strsql ="SELECT * from good_embryos where id=".$request->Id;
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
           $eggsCollected = GoodEmbryo::find($request->Id);
            // $lead->FileNo = $
            $eggsCollected->PatientId = $request->txtpatientId;

            $date = date_create($request->txtLeadDate);
            $eggsCollected->Date= $date->format('Y-m-d');

            $eggsCollected->DoctorId= $request->cmbDoctor;
            $eggsCollected->NurseId= $request->cmbNurse;
            $eggsCollected->GoodEmbryo= $request->txtEggsCollected;
            $eggsCollected->Notes= $request->txtnoteassessment;    
            $eggsCollected->FileLink= $imagepath;
            $eggsCollected->createdbyid= Auth::user()->id;
            $eggsCollected->save();

       }
       else{
            $imagepath = $laLinkFile;
            $eggsCollected = GoodEmbryo::find($request->Id);
            // $lead->FileNo = $
            $eggsCollected->PatientId = $request->txtpatientId;

            $date = date_create($request->txtLeadDate);
            $eggsCollected->Date= $date->format('Y-m-d');

            $eggsCollected->DoctorId= $request->cmbDoctor;
            $eggsCollected->NurseId= $request->cmbNurse;
            $eggsCollected->GoodEmbryo= $request->txtEggsCollected;
            $eggsCollected->Notes= $request->txtnoteassessment;    
            $eggsCollected->FileLink= $laLinkFile;
            $eggsCollected->createdbyid= Auth::user()->id;
            $eggsCollected->save();
       }

       
        return redirect()->to('/goodembryo/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GoodEmbryo  $goodEmbryo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from good_embryos where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->FileLink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = GoodEmbryo::destroy($request->del_id);

        return redirect()->to('/goodembryo/'.$request->txtpatientId);
    }
}
