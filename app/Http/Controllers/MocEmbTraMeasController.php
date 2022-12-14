<?php

namespace App\Http\Controllers;


use App\MocEmbTraMeas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManagerStatic as Image;
use File;

class MocEmbTraMeasController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Mock Embryo Transfer Measurements";  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()   
    {
        $this->middleware('auth');
    }
    public function MocEmbTraMeas($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select * from MocEmbTraMeas 
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('mockembtramea.patientindex',compact('docresult','patients'));
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

        return view('mockembtramea.new',compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $UtPoImage  = 'utpo/' ."utpo-".time().".png";
        $UtPoCaOr  = 'cer/' ."cer-".time().".png";
        $UtPoImagePath = public_path($UtPoImage);
        Image::make(file_get_contents($request->UtPoImage))->save($UtPoImagePath); 

        $UtPoCaOrPath = public_path($UtPoCaOr);
        Image::make(file_get_contents($request->UtPoCaOr))->save($UtPoCaOrPath); 



        //
        $imagepath = "";

        if ($files = $request->file('inputFile')) {
        // Define upload path
           $destinationPath = public_path('/file/'); // upload path
        // Upload Orginal Image           
           $imagepath = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $imagepath);
       }

        $docfiles = new MocEmbTraMeas;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->IsWalEasy=$this->CheckCheckBox($request->IsWalEasy);
        $docfiles->IsWalDiff=$this->CheckCheckBox($request->IsWalDiff);
        $docfiles->IsWalWIntr=$this->CheckCheckBox($request->IsWalWIntr);
        $docfiles->IsWalMeCaNe=$this->CheckCheckBox($request->IsWalMeCaNe);
        $docfiles->IsWalTenN=$this->CheckCheckBox($request->IsWalTenN);
        $docfiles->Comments=$request->Comments;
        $docfiles->UtMea=$request->UtMea;
        $docfiles->IsUtPoAnteflex=$this->CheckCheckBox($request->IsUtPoAnteflex);
        $docfiles->IsUtPoAnteverted=$this->CheckCheckBox($request->IsUtPoAnteverted);
        $docfiles->IsUtPoAxial=$this->CheckCheckBox($request->IsUtPoAxial);
        $docfiles->IsUtPoRetroverted=$this->CheckCheckBox($request->IsUtPoRetroverted);
        $docfiles->IsCaOr1=$this->CheckCheckBox($request->IsCaOr1);
        $docfiles->IsCaOr2=$this->CheckCheckBox($request->IsCaOr2);
        $docfiles->IsCaOr3=$this->CheckCheckBox($request->IsCaOr3);
        $docfiles->IsCaOr4=$this->CheckCheckBox($request->IsCaOr4);
        $docfiles->IsCaOr5=$this->CheckCheckBox($request->IsCaOr5);
        $docfiles->IsCaOr6=$this->CheckCheckBox($request->IsCaOr6);
        $docfiles->IsCaOr7=$this->CheckCheckBox($request->IsCaOr7);
        $docfiles->IsCaOr8=$this->CheckCheckBox($request->IsCaOr8);
        $docfiles->IsCaOr9=$this->CheckCheckBox($request->IsCaOr9);
        $docfiles->IsCaOr10=$this->CheckCheckBox($request->IsCaOr10);
        $docfiles->IsCaOr11=$this->CheckCheckBox($request->IsCaOr11);
        $docfiles->IsCaOr12=$this->CheckCheckBox($request->IsCaOr12);
        $docfiles->UtPoImage=$UtPoImage;
        $docfiles->UtPoCaOr=$UtPoCaOr;

        $docfiles->save();
        $doclab_id=$docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);

        return redirect()->to('/mockembtramea/'.$request->txtpatientId);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MocEmbTraMeas  $mocEmbTraMeas
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join MocEmbTraMeas as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from MocEmbTraMeas 
                  where id =".$docId;
        $docresults = DB::select($strsql);

        return view('mockembtramea.view',compact('docresults','patients','docId'));
    }

    public function PrintMocEmbTraMeas($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join MocEmbTraMeas as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from MocEmbTraMeas 
                  where id =".$docId;
        $docresults = DB::select($strsql);

        return view('mockembtramea.print',compact('docresults','patients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MocEmbTraMeas  $mocEmbTraMeas
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join MocEmbTraMeas as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select * from MocEmbTraMeas 
                  where id =".$docId;
        $docresults = DB::select($strsql);

        return view('mockembtramea.edit',compact('docresults','patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MocEmbTraMeas  $mocEmbTraMeas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        

        $imagepath = "";

        $strsql ="SELECT * from MocEmbTraMeas where id=".$request->docId;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
            File::delete($la->UtPoImage);
            File::delete($la->UtPoCaOr);
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

       $UtPoImage  = 'utpo/' ."utpo-".time().".png";
        $UtPoCaOr  = 'cer/' ."cer-".time().".png";
        $UtPoImagePath = public_path($UtPoImage);
        Image::make(file_get_contents($request->UtPoImage))->save($UtPoImagePath); 

        $UtPoCaOrPath = public_path($UtPoCaOr);
        Image::make(file_get_contents($request->UtPoCaOr))->save($UtPoCaOrPath); 


       $docfiles = MocEmbTraMeas::find($request->docId);
        $docfiles->filelink = $imagepath;        

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->IsWalEasy=$this->CheckCheckBox($request->IsWalEasy);
        $docfiles->IsWalDiff=$this->CheckCheckBox($request->IsWalDiff);
        $docfiles->IsWalWIntr=$this->CheckCheckBox($request->IsWalWIntr);
        $docfiles->IsWalMeCaNe=$this->CheckCheckBox($request->IsWalMeCaNe);
        $docfiles->IsWalTenN=$this->CheckCheckBox($request->IsWalTenN);
        $docfiles->Comments=$request->Comments;
        $docfiles->UtMea=$request->UtMea;
        $docfiles->IsUtPoAnteflex=$this->CheckCheckBox($request->IsUtPoAnteflex);
        $docfiles->IsUtPoAnteverted=$this->CheckCheckBox($request->IsUtPoAnteverted);
        $docfiles->IsUtPoAxial=$this->CheckCheckBox($request->IsUtPoAxial);
        $docfiles->IsUtPoRetroverted=$this->CheckCheckBox($request->IsUtPoRetroverted);
        $docfiles->IsCaOr1=$this->CheckCheckBox($request->IsCaOr1);
        $docfiles->IsCaOr2=$this->CheckCheckBox($request->IsCaOr2);
        $docfiles->IsCaOr3=$this->CheckCheckBox($request->IsCaOr3);
        $docfiles->IsCaOr4=$this->CheckCheckBox($request->IsCaOr4);
        $docfiles->IsCaOr5=$this->CheckCheckBox($request->IsCaOr5);
        $docfiles->IsCaOr6=$this->CheckCheckBox($request->IsCaOr6);
        $docfiles->IsCaOr7=$this->CheckCheckBox($request->IsCaOr7);
        $docfiles->IsCaOr8=$this->CheckCheckBox($request->IsCaOr8);
        $docfiles->IsCaOr9=$this->CheckCheckBox($request->IsCaOr9);
        $docfiles->IsCaOr10=$this->CheckCheckBox($request->IsCaOr10);
        $docfiles->IsCaOr11=$this->CheckCheckBox($request->IsCaOr11);
        $docfiles->IsCaOr12=$this->CheckCheckBox($request->IsCaOr12);
        $docfiles->UtPoImage=$UtPoImage;
        $docfiles->UtPoCaOr=$UtPoCaOr;

        $docfiles->save();
        $doclab_id=$docfiles->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/mockembtramea/'.$request->txtpatientId);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MocEmbTraMeas  $mocEmbTraMeas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $strsql ="SELECT * from MocEmbTraMeas where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
            File::delete($la->UtPoImage);
            File::delete($la->UtPoCaOr);
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = MocEmbTraMeas::destroy($request->del_id);

        return redirect()->to('/mockembtramea/'.$request->txtpatientId);
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
