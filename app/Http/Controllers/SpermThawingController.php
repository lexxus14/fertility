<?php

namespace App\Http\Controllers;

use App\Staff;
use App\SpermThawing;
use App\SpermThawingProcSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SpermThawingController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Sperm Thawing";

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

    public function SpermThawing($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select SpermThawings.*,p.name StaffName from SpermThawings 
                    left join staff as p on p.id = SpermThawings.CompByStaffId
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('spermthawing.patientindex',compact('docresult','patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($PatientId)
    {
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $Staffs = Staff::all();

        return view('spermthawing.new',compact('patients','Staffs'));
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
        //
        $imagepath = "";

        if ($files = $request->file('inputFile')) {
        // Define upload path
           $destinationPath = public_path('/file/'); // upload path
        // Upload Orginal Image           
           $imagepath = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $imagepath);
       }

        $docfiles = new SpermThawing;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->CompByStaffId=$request->CompByStaffId;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');
        
        $docfiles->Notes=$request->Notes;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $NoOfVials=$request->NoOfVials;
        $DateRecovered=$request->DateRecovered;
        $Office=$request->Office;
        $IsFresh=$request->IsFresh;
        $IsTESEPESAMESA=$request->IsTESEPESAMESA;
        $IsPrevFroz=$request->IsPrevFroz;

        $N = count($NoOfVials);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new SpermThawingProcSub;
            $pricelistsub->SpermThawingsId=$doclab_id;
            $pricelistsub->NoOfVials=$NoOfVials[$i];

            $date = date_create($DateRecovered[$i]);
            $pricelistsub->DateRecovered= $date->format('Y-m-d');

            $pricelistsub->Office=$Office[$i];


            $pricelistsub->IsFresh= $IsFresh[$i];


            $pricelistsub->IsTESEPESAMESA=$IsTESEPESAMESA[$i];


            $pricelistsub->IsPrevFroz=$IsPrevFroz[$i];

            $pricelistsub->save();
            
        }     

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/spermthawing/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SpermThawing  $spermThawing
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join SpermThawings as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select SpermThawings.*,p.name StaffName from SpermThawings 
                    left join staff as p on p.id = SpermThawings.CompByStaffId
                  where SpermThawings.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select SpermThawingProcSubs.* from SpermThawingProcSubs 
            inner join SpermThawings dd on dd.id = SpermThawingProcSubs.SpermThawingsId
            where dd.id=".$docId;

        $SpermThawingProcSubs = DB::select($strsql);

        $Staffs = Staff::all();

        return view('spermthawing.view',compact('docresults','patients','SpermThawingProcSubs','Staffs','docId'));
    }
    public function PrintSpermThawing($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join SpermThawings as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select SpermThawings.*,p.name StaffName from SpermThawings 
                    inner join staff as p on p.id = SpermThawings.CompByStaffId
                  where SpermThawings.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select SpermThawingProcSubs.* from SpermThawingProcSubs 
            inner join SpermThawings dd on dd.id = SpermThawingProcSubs.SpermThawingsId
            where dd.id=".$docId;

        $SpermThawingProcSubs = DB::select($strsql);

        $Staffs = Staff::all();

        return view('spermthawing.print',compact('docresults','patients','SpermThawingProcSubs','Staffs','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpermThawing  $spermThawing
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join SpermThawings as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select SpermThawings.*,p.name StaffName from SpermThawings 
                    left join staff as p on p.id = SpermThawings.CompByStaffId
                  where SpermThawings.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select SpermThawingProcSubs.* from SpermThawingProcSubs 
            inner join SpermThawings dd on dd.id = SpermThawingProcSubs.SpermThawingsId
            where dd.id=".$docId;

        $SpermThawingProcSubs = DB::select($strsql);

        $Staffs = Staff::all();

        return view('spermthawing.edit',compact('docresults','patients','SpermThawingProcSubs','Staffs','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpermThawing  $spermThawing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from SpermThawings where id=".$request->docId;
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

       $docfiles = SpermThawing::find($request->docId);
        $docfiles->filelink = '/file/'.$imagepath;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');
        
        $docfiles->Notes=$request->Notes;
        $docfiles->CompByStaffId=$request->CompByStaffId;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('SpermThawingProcSubs')->where('SpermThawingsId', $request->docId)->delete();
        
        $NoOfVials=$request->NoOfVials;
        $DateRecovered=$request->DateRecovered;
        $Office=$request->Office;
        $IsFresh=$request->IsFresh;
        $IsTESEPESAMESA=$request->IsTESEPESAMESA;
        $IsPrevFroz=$request->IsPrevFroz;


        $N = count($NoOfVials);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new SpermThawingProcSub;
            $pricelistsub->SpermThawingsId=$doclab_id;
            $pricelistsub->NoOfVials=$NoOfVials[$i];

            $date = date_create($DateRecovered[$i]);
            $pricelistsub->DateRecovered= $date->format('Y-m-d');

            $pricelistsub->Office=$Office[$i];


            $pricelistsub->IsFresh= $IsFresh[$i];


            $pricelistsub->IsTESEPESAMESA=$IsTESEPESAMESA[$i];


            $pricelistsub->IsPrevFroz=$IsPrevFroz[$i];

            $pricelistsub->save();
            
        }     

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/spermthawing/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpermThawing  $spermThawing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from SpermThawings where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = SpermThawing::destroy($request->del_id);

        return redirect()->to('/spermthawing/'.$request->txtpatientId);
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
