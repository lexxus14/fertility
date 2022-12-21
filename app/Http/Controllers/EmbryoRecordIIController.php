<?php

namespace App\Http\Controllers;
use App\Staff;
use App\EmbryologyRecordII;
use App\EmbryologyRecordIISub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EmbryoRecordIIController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Embryo Record II";

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function EmbryologyRecordII($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from EmbryologyRecordIIs 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('embryorecii.patientindex',compact('docresult','patients'));
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

        return view('embryorecii.new',compact('patients','Staffs'));
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

        $docfiles = new EmbryologyRecordII;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->Notes=$request->Notes;
        $docfiles->RecordNo=$request->RecordNo;
        $docfiles->CycleNo=$request->CycleNo;

        $date = date_create($request->Day0Date);
        $docfiles->Day0Date= $date->format('Y-m-d');


        $docfiles->Day0Time=$request->Day0Time;
        $docfiles->Day0EmbryologistStaffId=$request->Day0EmbryologistStaffId;

        $date = date_create($request->Day1Date);
        $docfiles->Day1Date= $date->format('Y-m-d');

        $docfiles->Day1Time=$request->Day1Time;
        $docfiles->Day1EmbryologistStaffId=$request->Day1EmbryologistStaffId;

        $date = date_create($request->Day3Date);
        $docfiles->Day3Date= $date->format('Y-m-d');

        $docfiles->Day3Time=$request->Day3Time;
        $docfiles->Day3EmbryologistStaffId=$request->Day3EmbryologistStaffId;
        $docfiles->Day3AhTime=$request->Day3AhTime;
        $docfiles->Day3AhTech=$request->Day3AhTech;

        $date = date_create($request->Day5Date);
        $docfiles->Day5Date= $date->format('Y-m-d');

        $docfiles->Day5Time=$request->Day5Time;
        $docfiles->Day5EmbryologistStaffId=$request->Day5EmbryologistStaffId;
        $docfiles->Day5AhTime=$request->Day5AhTime;
        $docfiles->Day5AhTech=$request->Day5AhTech;
        $date = date_create($request->Day6Date);
        $docfiles->Day6Date= $date->format('Y-m-d');
        $docfiles->Day6Time=$request->Day6Time;
        $docfiles->Day6EmbryologistStaffId=$request->Day6EmbryologistStaffId;
        $docfiles->Day6AhTime=$request->Day6AhTime;
        $docfiles->Day6AhTech=$request->Day6AhTech;
        $docfiles->Day1PtCall=$request->Day1PtCall;
        $docfiles->Day1Initial=$request->Day1Initial;
        $docfiles->Day3PtCall=$request->Day3PtCall;
        $docfiles->Day3Initial=$request->Day3Initial;
        $docfiles->Day5PtCall=$request->Day5PtCall;
        $docfiles->Day5Initial=$request->Day5Initial;
        $docfiles->Day6PtCall=$request->Day6PtCall;
        $docfiles->Day6Initial=$request->Day6Initial;
        $docfiles->AspLotNo=$request->AspLotNo;

        $date = date_create($request->AspExpDate);
        $docfiles->AspExpDate= $date->format('Y-m-d');

        $docfiles->ProteinSSSLot=$request->ProteinSSSLot;

        $date = date_create($request->ProteinSSSExpDate);
        $docfiles->ProteinSSSExpDate= $date->format('Y-m-d');

        $docfiles->AspOthers=$request->AspOthers;
        $docfiles->GlobalLotNo=$request->GlobalLotNo;

        $date = date_create($request->GlobalExpDate);
        $docfiles->GlobalExpDate= $date->format('Y-m-d');

        $docfiles->mHTFLotNo=$request->mHTFLotNo;

        $date = date_create($request->mHTFExpDate);
        $docfiles->mHTFExpDate= $date->format('Y-m-d');

        $docfiles->GlobalOther=$request->GlobalOther;
        $docfiles->HyluronidaseLogNo=$request->HyluronidaseLogNo;

        $date = date_create($request->HyluronidaseExpDate);
        $docfiles->HyluronidaseExpDate= $date->format('Y-m-d');

        $docfiles->OilLotNo=$request->OilLotNo;

        $date = date_create($request->OilExpDate);
        $docfiles->OilExpDate= $date->format('Y-m-d');

        $docfiles->GlobalOthers=$request->GlobalOthers;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $maturity=$request->maturity;
        $Day0remarks=$request->Day0remarks;
        $icsi=$request->icsi;
        $PB=$request->PB;
        $PN=$request->PN;
        $Day1remarks=$request->Day1remarks;
        $Day3remarks=$request->Day3remarks;
        $Day5remarks=$request->Day5remarks;
        $Day6remarks=$request->Day6remarks;
        $Dispositionremarks=$request->Dispositionremarks;

        $N = count($maturity);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new EmbryologyRecordIISub;
            $pricelistsub->EmbryologyRecordIIsId=$doclab_id;
            $pricelistsub->maturity=$maturity[$i];
            $pricelistsub->Day0remarks=$Day0remarks[$i];
            $pricelistsub->icsi=$icsi[$i];
            $pricelistsub->PB=$PB[$i];
            $pricelistsub->PN=$PN[$i];
            $pricelistsub->Day1remarks=$Day1remarks[$i];
            $pricelistsub->Day3remarks=$Day3remarks[$i];
            $pricelistsub->Day5remarks=$Day5remarks[$i];
            $pricelistsub->Day6remarks=$Day6remarks[$i];
            $pricelistsub->Dispositionremarks=$Dispositionremarks[$i];
            $pricelistsub->save();
            
        }         


        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/embryorecii/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmbryologyRecordII  $embryologyRecordII
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join EmbryologyRecordIIs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select EmbryologyRecordIIs.*,p.name Day0EmbryologistName,p1.name Day1EmbryologistName,p2.name Day3EmbryologistName,p3.name Day5EmbryologistName,p4.name Day6EmbryologistName from EmbryologyRecordIIs 
                    left join staff as p on p.id = EmbryologyRecordIIs.Day0EmbryologistStaffId
                    left join staff as p1 on p1.id = EmbryologyRecordIIs.Day1EmbryologistStaffId
                    left join staff as p2 on p2.id = EmbryologyRecordIIs.Day3EmbryologistStaffId
                    left join staff as p3 on p3.id = EmbryologyRecordIIs.Day5EmbryologistStaffId
                    left join staff as p4 on p4.id = EmbryologyRecordIIs.Day6EmbryologistStaffId
                  where EmbryologyRecordIIs.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select EmbryologyRecordIISubs.* from EmbryologyRecordIISubs 
            inner join EmbryologyRecordIIs dd on dd.id = EmbryologyRecordIISubs.EmbryologyRecordIIsId
            where EmbryologyRecordIISubs.EmbryologyRecordIIsId=".$docId;

        $EmbryologyRecordIISubs = DB::select($strsql);

        $Staffs = Staff::all();

        return view('embryorecii.view',compact('docresults','patients','EmbryologyRecordIISubs','Staffs','docId'));
    }

    public function PrintEmbryologyRecordII($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join EmbryologyRecordIIs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select EmbryologyRecordIIs.*,p.name Day0EmbryologistName,p1.name Day1EmbryologistName,p2.name Day3EmbryologistName,p3.name Day5EmbryologistName,p4.name Day6EmbryologistName from EmbryologyRecordIIs 
                    left join staff as p on p.id = EmbryologyRecordIIs.Day0EmbryologistStaffId
                    left join staff as p1 on p1.id = EmbryologyRecordIIs.Day1EmbryologistStaffId
                    left join staff as p2 on p2.id = EmbryologyRecordIIs.Day3EmbryologistStaffId
                    left join staff as p3 on p3.id = EmbryologyRecordIIs.Day5EmbryologistStaffId
                    left join staff as p4 on p4.id = EmbryologyRecordIIs.Day6EmbryologistStaffId
                  where EmbryologyRecordIIs.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select EmbryologyRecordIISubs.* from EmbryologyRecordIISubs 
            inner join EmbryologyRecordIIs dd on dd.id = EmbryologyRecordIISubs.EmbryologyRecordIIsId
            where EmbryologyRecordIISubs.EmbryologyRecordIIsId=".$docId;

        $EmbryologyRecordIISubs = DB::select($strsql);

        $Staffs = Staff::all();

        return view('embryorecii.print',compact('docresults','patients','EmbryologyRecordIISubs','Staffs','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmbryologyRecordII  $embryologyRecordII
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join EmbryologyRecordIIs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select EmbryologyRecordIIs.*,p.name Day0EmbryologistName,p1.name Day1EmbryologistName,p2.name Day3EmbryologistName,p3.name Day5EmbryologistName,p4.name Day6EmbryologistName from EmbryologyRecordIIs 
                    left join staff as p on p.id = EmbryologyRecordIIs.Day0EmbryologistStaffId
                    left join staff as p1 on p1.id = EmbryologyRecordIIs.Day1EmbryologistStaffId
                    left join staff as p2 on p2.id = EmbryologyRecordIIs.Day3EmbryologistStaffId
                    left join staff as p3 on p3.id = EmbryologyRecordIIs.Day5EmbryologistStaffId
                    left join staff as p4 on p4.id = EmbryologyRecordIIs.Day6EmbryologistStaffId
                  where EmbryologyRecordIIs.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select EmbryologyRecordIISubs.* from EmbryologyRecordIISubs 
            inner join EmbryologyRecordIIs dd on dd.id = EmbryologyRecordIISubs.EmbryologyRecordIIsId
            where EmbryologyRecordIISubs.EmbryologyRecordIIsId=".$docId;

        $EmbryologyRecordIISubs = DB::select($strsql);

        $Staffs = Staff::all();

        return view('embryorecii.edit',compact('docresults','patients','EmbryologyRecordIISubs','Staffs','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmbryologyRecordII  $embryologyRecordII
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from EmbryologyRecordIIs where id=".$request->docId;
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

       $docfiles = EmbryologyRecordII::find($request->docId);
        $docfiles->filelink = $imagepath;    

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->Notes=$request->Notes;
        $docfiles->RecordNo=$request->RecordNo;
        $docfiles->CycleNo=$request->CycleNo;

        $date = date_create($request->Day0Date);
        $docfiles->Day0Date= $date->format('Y-m-d');


        $docfiles->Day0Time=$request->Day0Time;
        $docfiles->Day0EmbryologistStaffId=$request->Day0EmbryologistStaffId;

        $date = date_create($request->Day1Date);
        $docfiles->Day1Date= $date->format('Y-m-d');

        $docfiles->Day1Time=$request->Day1Time;
        $docfiles->Day1EmbryologistStaffId=$request->Day1EmbryologistStaffId;

        $date = date_create($request->Day3Date);
        $docfiles->Day3Date= $date->format('Y-m-d');

        $docfiles->Day3Time=$request->Day3Time;
        $docfiles->Day3EmbryologistStaffId=$request->Day3EmbryologistStaffId;
        $docfiles->Day3AhTime=$request->Day3AhTime;
        $docfiles->Day3AhTech=$request->Day3AhTech;

        $date = date_create($request->Day5Date);
        $docfiles->Day5Date= $date->format('Y-m-d');

        $docfiles->Day5Time=$request->Day5Time;
        $docfiles->Day5EmbryologistStaffId=$request->Day5EmbryologistStaffId;
        $docfiles->Day5AhTime=$request->Day5AhTime;
        $docfiles->Day5AhTech=$request->Day5AhTech;
        $date = date_create($request->Day6Date);
        $docfiles->Day6Date= $date->format('Y-m-d');
        $docfiles->Day6Time=$request->Day6Time;
        $docfiles->Day6EmbryologistStaffId=$request->Day6EmbryologistStaffId;
        $docfiles->Day6AhTime=$request->Day6AhTime;
        $docfiles->Day6AhTech=$request->Day6AhTech;
        $docfiles->Day1PtCall=$request->Day1PtCall;
        $docfiles->Day1Initial=$request->Day1Initial;
        $docfiles->Day3PtCall=$request->Day3PtCall;
        $docfiles->Day3Initial=$request->Day3Initial;
        $docfiles->Day5PtCall=$request->Day5PtCall;
        $docfiles->Day5Initial=$request->Day5Initial;
        $docfiles->Day6PtCall=$request->Day6PtCall;
        $docfiles->Day6Initial=$request->Day6Initial;
        $docfiles->AspLotNo=$request->AspLotNo;

        $date = date_create($request->AspExpDate);
        $docfiles->AspExpDate= $date->format('Y-m-d');

        $docfiles->ProteinSSSLot=$request->ProteinSSSLot;

        $date = date_create($request->ProteinSSSExpDate);
        $docfiles->ProteinSSSExpDate= $date->format('Y-m-d');

        $docfiles->AspOthers=$request->AspOthers;
        $docfiles->GlobalLotNo=$request->GlobalLotNo;

        $date = date_create($request->GlobalExpDate);
        $docfiles->GlobalExpDate= $date->format('Y-m-d');

        $docfiles->mHTFLotNo=$request->mHTFLotNo;

        $date = date_create($request->mHTFExpDate);
        $docfiles->mHTFExpDate= $date->format('Y-m-d');

        $docfiles->GlobalOther=$request->GlobalOther;
        $docfiles->HyluronidaseLogNo=$request->HyluronidaseLogNo;

        $date = date_create($request->HyluronidaseExpDate);
        $docfiles->HyluronidaseExpDate= $date->format('Y-m-d');

        $docfiles->OilLotNo=$request->OilLotNo;

        $date = date_create($request->OilExpDate);
        $docfiles->OilExpDate= $date->format('Y-m-d');

        $docfiles->GlobalOthers=$request->GlobalOthers;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $maturity=$request->maturity;
        $Day0remarks=$request->Day0remarks;
        $icsi=$request->icsi;
        $PB=$request->PB;
        $PN=$request->PN;
        $Day1remarks=$request->Day1remarks;
        $Day3remarks=$request->Day3remarks;
        $Day5remarks=$request->Day5remarks;
        $Day6remarks=$request->Day6remarks;
        $Dispositionremarks=$request->Dispositionremarks;

        $N = count($maturity);

        $sub = DB::table('EmbryologyRecordIISubs')->where('EmbryologyRecordIIsId', $request->docId)->delete();

        $maturity=$request->maturity;
        $Day0remarks=$request->Day0remarks;
        $icsi=$request->icsi;
        $PB=$request->PB;
        $PN=$request->PN;
        $Day1remarks=$request->Day1remarks;
        $Day3remarks=$request->Day3remarks;
        $Day5remarks=$request->Day5remarks;
        $Day6remarks=$request->Day6remarks;
        $Dispositionremarks=$request->Dispositionremarks;

        $N = count($maturity);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new EmbryologyRecordIISub;
            $pricelistsub->EmbryologyRecordIIsId=$doclab_id;
            $pricelistsub->maturity=$maturity[$i];
            $pricelistsub->Day0remarks=$Day0remarks[$i];
            $pricelistsub->icsi=$icsi[$i];
            $pricelistsub->PB=$PB[$i];
            $pricelistsub->PN=$PN[$i];
            $pricelistsub->Day1remarks=$Day1remarks[$i];
            $pricelistsub->Day3remarks=$Day3remarks[$i];
            $pricelistsub->Day5remarks=$Day5remarks[$i];
            $pricelistsub->Day6remarks=$Day6remarks[$i];
            $pricelistsub->Dispositionremarks=$Dispositionremarks[$i];
            $pricelistsub->save();
            
        }         


        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/embryorecii/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmbryologyRecordII  $embryologyRecordII
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from EmbryologyRecordIIs where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = EmbryologyRecordII::destroy($request->del_id);

        return redirect()->to('/embryorecii/'.$request->txtpatientId);
    }
}
