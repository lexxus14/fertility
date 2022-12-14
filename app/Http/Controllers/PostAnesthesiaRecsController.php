<?php

namespace App\Http\Controllers;

use App\Procedure;
use App\Staff;
use App\PostAnesthesiaRecs;
use App\PosAneRecSurProcSub;
use App\PosAneMonRecSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PostAnesthesiaRecsController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Post Anesthesia Record";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function PostAnesthesiaRecs($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select PostAnesthesiaRecs.*,p.name StaffName from PostAnesthesiaRecs 
                    inner join staff as p on p.id = PostAnesthesiaRecs.AnesthetestStaffId
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('posanesrecs.patientindex',compact('docresult','patients'));

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

        $Procedures = Procedure::all();
        $Staffs = Staff::all();

        return view('posanesrecs.new',compact('patients','Procedures','Staffs'));
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

        $docfiles = new PostAnesthesiaRecs;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $date = date_create($request->PreOperaDate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->doctime=$request->PreOperaTime;

        $docfiles->AnesthetestStaffId=$request->AnesthetestStaffId;
        $docfiles->SurgeonStaffId=$request->SurgeonStaffId;
        $docfiles->IsTypAneGA=$this->CheckCheckBox($request->IsTypAneGA);
        $docfiles->IsTypAneMAC=$this->CheckCheckBox($request->IsTypAneMAC);
        $docfiles->IsTypAneRegAne=$this->CheckCheckBox($request->IsTypAneRegAne);
        $docfiles->IsTypAneOthers=$this->CheckCheckBox($request->IsTypAneOthers);
        $docfiles->DruInRec=$request->DruInRec;
        $docfiles->IsCriDisCon=$this->CheckCheckBox($request->IsCriDisCon);
        $docfiles->IsCriDisAct=$this->CheckCheckBox($request->IsCriDisAct);
        $docfiles->IsCriDisBre=$this->CheckCheckBox($request->IsCriDisBre);
        $docfiles->IsCriDisCir=$this->CheckCheckBox($request->IsCriDisCir);
        $docfiles->IsCriDisOxySat=$this->CheckCheckBox($request->IsCriDisOxySat);
        $docfiles->TotalScore=$request->TotalScore;
        $docfiles->DisInsAndRem=$request->DisInsAndRem;
        $docfiles->RecNurStaffId=$request->RecNurStaffId;

        $date = date_create($request->DisDate);
        $docfiles->DisDate= $date->format('Y-m-d');

        $docfiles->DisTime=$request->DisTime;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $ProcedureId=$request->ProcedureId;

        $N = count($ProcedureId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PosAneRecSurProcSub;
            $pricelistsub->PostAnesthesiaRecsId = $doclab_id; 
            $pricelistsub->ProcedureId = $ProcedureId[$i];
            $pricelistsub->save();
            
        }

        $MonRecSubdoctime=$request->MonRecSubdoctime;
        $BP=$request->BP;
        $PulseRate=$request->PulseRate;
        $Sp02=$request->Sp02;
        $Fi02=$request->Fi02;
        $PainScore=$request->PainScore;

        $N = count($MonRecSubdoctime);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PosAneMonRecSub;
            $pricelistsub->PostAnesthesiaRecsId = $doclab_id; 
            $pricelistsub->MonRecSubdoctime=$MonRecSubdoctime[$i];   
            $pricelistsub->BP=$BP[$i];
            $pricelistsub->PulseRate=$PulseRate[$i];
            $pricelistsub->Sp02=$Sp02[$i];
            $pricelistsub->Fi02= $Fi02[$i];
            $pricelistsub->PainScore=$PainScore[$i];
            $pricelistsub->save();
            
        }      


        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/posanesrecs/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostAnesthesiaRecs  $postAnesthesiaRecs
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join PostAnesthesiaRecs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select PostAnesthesiaRecs.*,p.name AnesthetestStaffName,ss.name as SurgeonStaffName,ss.name as RecNurStaffName from PostAnesthesiaRecs 
                    left join staff as p on p.id = PostAnesthesiaRecs.AnesthetestStaffId
                    left join staff as ss on ss.id = PostAnesthesiaRecs.SurgeonStaffId
                    left join staff as rns on rns.id = PostAnesthesiaRecs.RecNurStaffId
                  where PostAnesthesiaRecs.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dd.id,dd.description from PosAneRecSurProcSub 
                    inner join procedures dd on dd.id = PosAneRecSurProcSub.ProcedureId
                    where PosAneRecSurProcSub.PostAnesthesiaRecsId=".$docId;

        $PosAneRecSurProcSubs = DB::select($strsql);

        $strsql ="select * from PosAneMonRecSub 
                    where PosAneMonRecSub.PostAnesthesiaRecsId=".$docId;

        $PosAneMonRecSubs = DB::select($strsql);


        $Procedures = Procedure::all();
        $Staffs = Staff::all();

        return view('posanesrecs.view',compact('docresults','patients','Procedures','PosAneRecSurProcSubs','Staffs','PosAneMonRecSubs','docId'));
    }

    public function PrintPostAnesthesiaRecs($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join PostAnesthesiaRecs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select PostAnesthesiaRecs.*,p.name AnesthetestStaffName,ss.name as SurgeonStaffName,ss.name as RecNurStaffName from PostAnesthesiaRecs 
                    left join staff as p on p.id = PostAnesthesiaRecs.AnesthetestStaffId
                    left join staff as ss on ss.id = PostAnesthesiaRecs.SurgeonStaffId
                    left join staff as rns on rns.id = PostAnesthesiaRecs.RecNurStaffId
                  where PostAnesthesiaRecs.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dd.id,dd.description from PosAneRecSurProcSub 
                    inner join procedures dd on dd.id = PosAneRecSurProcSub.ProcedureId
                    where PosAneRecSurProcSub.PostAnesthesiaRecsId=".$docId;

        $PosAneRecSurProcSubs = DB::select($strsql);

        $strsql ="select * from PosAneMonRecSub 
                    where PosAneMonRecSub.PostAnesthesiaRecsId=".$docId;

        $PosAneMonRecSubs = DB::select($strsql);


        $Procedures = Procedure::all();
        $Staffs = Staff::all();

        return view('posanesrecs.print',compact('docresults','patients','Procedures','PosAneRecSurProcSubs','Staffs','PosAneMonRecSubs','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostAnesthesiaRecs  $postAnesthesiaRecs
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join PostAnesthesiaRecs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select PostAnesthesiaRecs.*,p.name AnesthetestStaffName,ss.name as SurgeonStaffName,ss.name as RecNurStaffName from PostAnesthesiaRecs 
                    left join staff as p on p.id = PostAnesthesiaRecs.AnesthetestStaffId
                    left join staff as ss on ss.id = PostAnesthesiaRecs.SurgeonStaffId
                    left join staff as rns on rns.id = PostAnesthesiaRecs.RecNurStaffId
                  where PostAnesthesiaRecs.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dd.id,dd.description from PosAneRecSurProcSub 
                    inner join procedures dd on dd.id = PosAneRecSurProcSub.ProcedureId
                    where PosAneRecSurProcSub.PostAnesthesiaRecsId=".$docId;

        $PosAneRecSurProcSubs = DB::select($strsql);

        $strsql ="select * from PosAneMonRecSub 
                    where PosAneMonRecSub.PostAnesthesiaRecsId=".$docId;

        $PosAneMonRecSubs = DB::select($strsql);


        $Procedures = Procedure::all();
        $Staffs = Staff::all();

        return view('posanesrecs.edit',compact('docresults','patients','Procedures','PosAneRecSurProcSubs','Staffs','PosAneMonRecSubs','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostAnesthesiaRecs  $postAnesthesiaRecs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from PostAnesthesiaRecs where id=".$request->docId;
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

        $docfiles = PostAnesthesiaRecs::find($request->docId);
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->doctime=$request->doctime;

        $docfiles->AnesthetestStaffId=$request->AnesthetestStaffId;
        $docfiles->SurgeonStaffId=$request->SurgeonStaffId;
        $docfiles->IsTypAneGA=$this->CheckCheckBox($request->IsTypAneGA);
        $docfiles->IsTypAneMAC=$this->CheckCheckBox($request->IsTypAneMAC);
        $docfiles->IsTypAneRegAne=$this->CheckCheckBox($request->IsTypAneRegAne);
        $docfiles->IsTypAneOthers=$this->CheckCheckBox($request->IsTypAneOthers);
        $docfiles->DruInRec=$request->DruInRec;
        $docfiles->IsCriDisCon=$this->CheckCheckBox($request->IsCriDisCon);
        $docfiles->IsCriDisAct=$this->CheckCheckBox($request->IsCriDisAct);
        $docfiles->IsCriDisBre=$this->CheckCheckBox($request->IsCriDisBre);
        $docfiles->IsCriDisCir=$this->CheckCheckBox($request->IsCriDisCir);
        $docfiles->IsCriDisOxySat=$this->CheckCheckBox($request->IsCriDisOxySat);
        $docfiles->TotalScore=$request->TotalScore;
        $docfiles->DisInsAndRem=$request->DisInsAndRem;
        $docfiles->RecNurStaffId=$request->RecNurStaffId;

        $date = date_create($request->DisDate);
        $docfiles->DisDate= $date->format('Y-m-d');

        $docfiles->DisTime=$request->DisTime;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('PosAneRecSurProcSub')->where('PostAnesthesiaRecsId', $request->docId)->delete();


        $ProcedureId=$request->ProcedureId;

        $N = count($ProcedureId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PosAneRecSurProcSub;
            $pricelistsub->PostAnesthesiaRecsId = $doclab_id; 
            $pricelistsub->ProcedureId = $ProcedureId[$i];
            $pricelistsub->save();
            
        }

        $sub = DB::table('PosAneMonRecSub')->where('PostAnesthesiaRecsId', $request->docId)->delete();

        $MonRecSubdoctime=$request->MonRecSubdoctime;
        $BP=$request->BP;
        $PulseRate=$request->PulseRate;
        $Sp02=$request->Sp02;
        $Fi02=$request->Fi02;
        $PainScore=$request->PainScore;

        $N = count($MonRecSubdoctime);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PosAneMonRecSub;
            $pricelistsub->PostAnesthesiaRecsId = $doclab_id; 
            $pricelistsub->MonRecSubdoctime=$MonRecSubdoctime[$i];   
            $pricelistsub->BP=$BP[$i];
            $pricelistsub->PulseRate=$PulseRate[$i];
            $pricelistsub->Sp02=$Sp02[$i];
            $pricelistsub->Fi02= $Fi02[$i];
            $pricelistsub->PainScore=$PainScore[$i];
            $pricelistsub->save();
            
        }      


        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/posanesrecs/'.$request->txtpatientId);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostAnesthesiaRecs  $postAnesthesiaRecs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from PostAnesthesiaRecs where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = PostAnesthesiaRecs::destroy($request->del_id);

        return redirect()->to('/posanesrecs/'.$request->txtpatientId);
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
