<?php

namespace App\Http\Controllers;

use App\Staff;
use App\OOctyeFreezeThawTransRec;
use App\OOctyeFreezeThawTransRecSub;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OOctyeFreezeThawTransRecController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "OOcyte Freeze Thawing Transfer Record";

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

    public function OOctyeFreezeThawTrans($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select OOcyteFreezeThawTransRecs.*,p.name StaffName from OOcyteFreezeThawTransRecs 
                    inner join staff as p on p.id = OOcyteFreezeThawTransRecs.PhysicianStaffId
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('oofrethatranrec.patientindex',compact('docresult','patients'));
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

        return view('oofrethatranrec.new',compact('patients','Staffs'));
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

        $docfiles = new OOctyeFreezeThawTransRec;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->Notes=$request->Notes;

        $date = date_create($request->FreezingDate);
        $docfiles->FreezingDate= $date->format('Y-m-d');

        $docfiles->FreezingTime=$request->FreezingTime;
        $docfiles->FreezingLocation=$request->FreezingLocation;
        $docfiles->FreezingEmbStaffId=$request->FreezingEmbStaffId;

        $date = date_create($request->ThawingDate);
        $docfiles->ThawingDate= $date->format('Y-m-d');

        $docfiles->ThawingTime=$request->ThawingTime;
        $docfiles->ThawingLocation=$request->ThawingLocation;
        $docfiles->ThawingEmbStaffId=$request->ThawingEmbStaffId;

        $docfiles->TransferTime=$request->TransferTime;
        $docfiles->NoOfEmbTrans=$request->NoOfEmbTrans;
        $docfiles->NoOfAttempts=$request->NoOfAttempts;
        $docfiles->IsAHYes=$this->CheckCheckBox($request->IsAHYes);
        $docfiles->IsAHNo=$this->CheckCheckBox($request->IsAHNo);
        $docfiles->CathLoading=$request->CathLoading;
        $docfiles->PhysicianStaffId=$request->PhysicianStaffId;
        $docfiles->EmbryologistStaffId=$request->EmbryologistStaffId;
        $docfiles->NurseStaffId=$request->NurseStaffId;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $StrawNo=$request->StrawNo;
        $OoctyeNo=$request->OoctyeNo;
        $Maturation=$request->Maturation;
        $StageGrade=$request->StageGrade;
        $IsThawYes=$request->IsThawYes;
        $IsThawNo=$request->IsThawNo;

        $N = count($StrawNo);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new OOctyeFreezeThawTransRecSub;
            $pricelistsub->OOcytFreThawTransRecsId = $doclab_id; 
            $pricelistsub->StrawNo= $StrawNo[$i]; 
            $pricelistsub->OoctyeNo= $OoctyeNo[$i]; 
            $pricelistsub->Maturation= $Maturation[$i]; 
            $pricelistsub->StageGrade= $StageGrade[$i]; 
            $pricelistsub->IsThawYes= $IsThawYes[$i]; 
            $pricelistsub->IsThawNo= $IsThawNo[$i]; 
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/oofrethatranrec/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join OOcyteFreezeThawTransRecs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select OOcyteFreezeThawTransRecs.*,p.name FreezingEmbStaffName,p1.name ThawingEmbStaffName,p2.name PhysicianStaffName,p3.name EmbryologistStaffName,p4.name NurseStaffName from OOcyteFreezeThawTransRecs 
                    left join staff as p on p.id = OOcyteFreezeThawTransRecs.FreezingEmbStaffId
                    left join staff as p1 on p1.id = OOcyteFreezeThawTransRecs.ThawingEmbStaffId
                    left join staff as p2 on p2.id = OOcyteFreezeThawTransRecs.PhysicianStaffId
                    left join staff as p3 on p3.id = OOcyteFreezeThawTransRecs.EmbryologistStaffId
                    left join staff as p4 on p4.id = OOcyteFreezeThawTransRecs.NurseStaffId
                  where OOcyteFreezeThawTransRecs.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select * from OOcyteFreezeThawTransRecSubs 
            where OOcytFreThawTransRecsId=".$docId;

        $OOcyteSubs = DB::select($strsql);

        $Staffs = Staff::all();

        return view('oofrethatranrec.view',compact('docresults','patients','OOcyteSubs','Staffs','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join OOcyteFreezeThawTransRecs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select OOcyteFreezeThawTransRecs.*,p.name FreezingEmbStaffName,p1.name ThawingEmbStaffName,p2.name PhysicianStaffName,p3.name EmbryologistStaffName,p4.name NurseStaffName from OOcyteFreezeThawTransRecs 
                    left join staff as p on p.id = OOcyteFreezeThawTransRecs.FreezingEmbStaffId
                    left join staff as p1 on p1.id = OOcyteFreezeThawTransRecs.ThawingEmbStaffId
                    left join staff as p2 on p2.id = OOcyteFreezeThawTransRecs.PhysicianStaffId
                    left join staff as p3 on p3.id = OOcyteFreezeThawTransRecs.EmbryologistStaffId
                    left join staff as p4 on p4.id = OOcyteFreezeThawTransRecs.NurseStaffId
                  where OOcyteFreezeThawTransRecs.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select * from OOcyteFreezeThawTransRecSubs 
            where OOcytFreThawTransRecsId=".$docId;

        $OOcyteSubs = DB::select($strsql);

        $Staffs = Staff::all();

        return view('oofrethatranrec.edit',compact('docresults','patients','OOcyteSubs','Staffs','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from OOcyteFreezeThawTransRecs where id=".$request->docId;
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

       $docfiles = OOctyeFreezeThawTransRec::find($request->docId);
        $docfiles->filelink = $imagepath;        
        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->Notes=$request->Notes;

        $date = date_create($request->FreezingDate);
        $docfiles->FreezingDate= $date->format('Y-m-d');

        $docfiles->FreezingTime=$request->FreezingTime;
        $docfiles->FreezingLocation=$request->FreezingLocation;
        $docfiles->FreezingEmbStaffId=$request->FreezingEmbStaffId;

        $date = date_create($request->ThawingDate);
        $docfiles->ThawingDate= $date->format('Y-m-d');

        $docfiles->ThawingTime=$request->ThawingTime;
        $docfiles->ThawingLocation=$request->ThawingLocation;
        $docfiles->ThawingEmbStaffId=$request->ThawingEmbStaffId;

        $docfiles->TransferTime=$request->TransferTime;
        $docfiles->NoOfEmbTrans=$request->NoOfEmbTrans;
        $docfiles->NoOfAttempts=$request->NoOfAttempts;
        $docfiles->IsAHYes= $this->CheckCheckBox($request->IsAHYes);
        $docfiles->IsAHNo=$this->CheckCheckBox($request->IsAHNo);
        $docfiles->CathLoading=$request->CathLoading;
        $docfiles->PhysicianStaffId=$request->PhysicianStaffId;
        $docfiles->EmbryologistStaffId=$request->EmbryologistStaffId;
        $docfiles->NurseStaffId=$request->NurseStaffId;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('OOcyteFreezeThawTransRecSubs')->where('OOcytFreThawTransRecsId', $request->docId)->delete();

        $StrawNo=$request->StrawNo;
        $OoctyeNo=$request->OoctyeNo;
        $Maturation=$request->Maturation;
        $StageGrade=$request->StageGrade;
        $IsThawYes=$request->IsThawYes;
        $IsThawNo=$request->IsThawNo;

        $N = count($StrawNo);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new OOctyeFreezeThawTransRecSub;
            $pricelistsub->OOcytFreThawTransRecsId = $doclab_id; 
            $pricelistsub->StrawNo= $StrawNo[$i]; 
            $pricelistsub->OoctyeNo= $OoctyeNo[$i]; 
            $pricelistsub->Maturation= $Maturation[$i]; 
            $pricelistsub->StageGrade= $StageGrade[$i]; 
            $pricelistsub->IsThawYes= $IsThawYes[$i]; 
            $pricelistsub->IsThawNo= $IsThawNo[$i]; 
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/oofrethatranrec/'.$request->txtpatientId);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from OOcyteFreezeThawTransRecs where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = OOctyeFreezeThawTransRec::destroy($request->del_id);

        return redirect()->to('/oofrethatranrec/'.$request->txtpatientId);
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
