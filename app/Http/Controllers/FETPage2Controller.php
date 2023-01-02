<?php

namespace App\Http\Controllers;
use App\DoctorDiagnosis;
use App\FETPage2;
use App\FETPage2DiagSub;
use App\FETPage2CDSub;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FETPage2Controller extends Controller
{
    private $DocTransName = "Patient Vital Sign";
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

    public function FETPage2($DocId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join fetphases as st on st.patientid = p.id
                    WHERE st.id =".$DocId;
        $patients = DB::select($strsql);

        $strsql ="select * from FETPage2s 
                  where FETiD =".$DocId;
        $docresult = DB::select($strsql);

        return view('fetpage2.patientindex',compact('docresult','patients','DocId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($DocId)
    {
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join fetphases as st on st.patientid = p.id
                    WHERE st.id =".$DocId;
        $patients = DB::select($strsql);

        $doctorDiagnosis = DoctorDiagnosis::all();

        return view('fetpage2.new',compact('patients','doctorDiagnosis','DocId'));
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

        $docfiles = new FETPage2;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->FETiD = $request->FETiD;

        $date = date_create($request->LupronStartDate);
        $docfiles->LupronStartDate= $date->format('Y-m-d');

        $date = date_create($request->CD2Date);
        $docfiles->CD2Date= $date->format('Y-m-d');

        $docfiles->UterinePosition = $request->UterinePosition;
        $docfiles->Measurement = $request->Measurement;
        $docfiles->HIPPA = $request->HIPPA;
        $docfiles->CD1Etradiol = $request->CD1Etradiol;
        $docfiles->CD1PRL = $request->CD1PRL;
        $docfiles->BloodType = $request->BloodType;
        $docfiles->FETDate = $request->FETDate;
        $docfiles->Embros = $request->Embros;
        $docfiles->Trans = $request->Trans;
        $docfiles->Cryo = $request->Cryo;

        $docfiles->filelink = '/file/'.$imagepath;

        $docfiles->Notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $DiagnosisID=$request->DiagnosisID;

        $N = count($DiagnosisID);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new FETPage2DiagSub;
            $pricelistsub->FETPage2sId = $doclab_id; 
            $pricelistsub->DiagnosisID = $DiagnosisID[$i];
            $pricelistsub->save();
            
        }

        $CDNo=$request->CDNo;
        $CDDate=$request->CDDate;
        $RT=$request->RT;
        $LT=$request->LT;
        $Lining=$request->Lining;
        $Estradiol=$request->Estradiol;
        $Notes=$request->Notes;

        $N = count($CDNo);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new FETPage2CDSub;
            $pricelistsub->FETPage2sId = $doclab_id; 
            $pricelistsub->CDNo = $CDNo[$i];

            $date = date_create($request->CDDate[$i]);            
            $pricelistsub->CDDate= $date->format('Y-m-d');

            $pricelistsub->RT = $RT[$i];
            $pricelistsub->LT = $LT[$i];
            $pricelistsub->Lining = $Lining[$i];
            $pricelistsub->Estradiol = $Estradiol[$i];
            $pricelistsub->Notes = $Notes[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/fetpage2/'.$request->FETiD);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($PhaseId,$DocId)
    {
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join fetphases as st on st.patientid = p.id
                    WHERE st.id =".$PhaseId;
        $patients = DB::select($strsql);

        $strsql ="SELECT * from fetpage2s
                    WHERE id =".$DocId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT doctordiagnosis.id,doctordiagnosis.description from FETPage2DiagnosisSubs
                    INNER JOIN doctordiagnosis on doctordiagnosis.id = FETPage2DiagnosisSubs.DiagnosisID
                    WHERE FETPage2sId =".$DocId;
        $FETPage2DiagnosisSubs = DB::select($strsql);

        $strsql ="SELECT * from FETPage2CDSubs
                    WHERE FETPage2sId =".$DocId;
        $FETPage2CDSubs = DB::select($strsql);


        $doctorDiagnosis = DoctorDiagnosis::all();

        return view('fetpage2.view',compact('patients','doctorDiagnosis','DocId','PhaseId','docresults','FETPage2DiagnosisSubs','FETPage2CDSubs'));
    }

    public function PrintFETpage2($PhaseId,$DocId)
    {
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join fetphases as st on st.patientid = p.id
                    WHERE st.id =".$PhaseId;
        $patients = DB::select($strsql);

        $strsql ="SELECT * from fetpage2s
                    WHERE id =".$DocId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT doctordiagnosis.id,doctordiagnosis.description from FETPage2DiagnosisSubs
                    INNER JOIN doctordiagnosis on doctordiagnosis.id = FETPage2DiagnosisSubs.DiagnosisID
                    WHERE FETPage2sId =".$DocId;
        $FETPage2DiagnosisSubs = DB::select($strsql);

        $strsql ="SELECT * from FETPage2CDSubs
                    WHERE FETPage2sId =".$DocId;
        $FETPage2CDSubs = DB::select($strsql);


        $doctorDiagnosis = DoctorDiagnosis::all();

        return view('fetpage2.print',compact('patients','doctorDiagnosis','DocId','PhaseId','docresults','FETPage2DiagnosisSubs','FETPage2CDSubs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($PhaseId,$DocId)
    {
        //
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join fetphases as st on st.patientid = p.id
                    WHERE st.id =".$PhaseId;
        $patients = DB::select($strsql);

        $strsql ="SELECT * from fetpage2s
                    WHERE id =".$DocId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT doctordiagnosis.id,doctordiagnosis.description from FETPage2DiagnosisSubs
                    INNER JOIN doctordiagnosis on doctordiagnosis.id = FETPage2DiagnosisSubs.DiagnosisID
                    WHERE FETPage2sId =".$DocId;
        $FETPage2DiagnosisSubs = DB::select($strsql);

        $strsql ="SELECT * from FETPage2CDSubs
                    WHERE FETPage2sId =".$DocId;
        $FETPage2CDSubs = DB::select($strsql);


        $doctorDiagnosis = DoctorDiagnosis::all();

        return view('fetpage2.edit',compact('patients','doctorDiagnosis','DocId','PhaseId','docresults','FETPage2DiagnosisSubs','FETPage2CDSubs'));
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

        $strsql ="SELECT * from FETPage2s where id=".$request->FETPage2iD;
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

       $docfiles = FETPage2::find($request->FETPage2iD);

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->patientid = $request->txtpatientId;
        $docfiles->FETiD = $request->FETiD;

        $date = date_create($request->LupronStartDate);
        $docfiles->LupronStartDate= $date->format('Y-m-d');

        $date = date_create($request->CD2Date);
        $docfiles->CD2Date= $date->format('Y-m-d');

        $docfiles->UterinePosition = $request->UterinePosition;
        $docfiles->Measurement = $request->Measurement;
        $docfiles->HIPPA = $request->HIPPA;
        $docfiles->CD1Etradiol = $request->CD1Etradiol;
        $docfiles->CD1PRL = $request->CD1PRL;
        $docfiles->BloodType = $request->BloodType;
        $docfiles->FETDate = $request->FETDate;
        $docfiles->Embros = $request->Embros;
        $docfiles->Trans = $request->Trans;
        $docfiles->Cryo = $request->Cryo;

        $docfiles->filelink = '/file/'.$imagepath;

        $docfiles->Notes = $request->txtnotes;
        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('FETPage2DiagnosisSubs')->where('FETPage2sId', $request->FETPage2iD)->delete();

        $DiagnosisID=$request->DiagnosisID;

        $N = count($DiagnosisID);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new FETPage2DiagSub;
            $pricelistsub->FETPage2sId = $doclab_id; 
            $pricelistsub->DiagnosisID = $DiagnosisID[$i];
            $pricelistsub->save();
            
        }

        $CDNo=$request->CDNo;
        $CDDate=$request->CDDate;
        $RT=$request->RT;
        $LT=$request->LT;
        $Lining=$request->Lining;
        $Estradiol=$request->Estradiol;
        $Notes=$request->Notes;

        $sub = DB::table('FETPage2CDSubs')->where('FETPage2sId', $request->FETPage2iD)->delete();

        $N = count($CDNo);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new FETPage2CDSub;
            $pricelistsub->FETPage2sId = $doclab_id; 
            $pricelistsub->CDNo = $CDNo[$i];

            $date = date_create($request->CDDate[$i]);            
            $pricelistsub->CDDate= $date->format('Y-m-d');

            $pricelistsub->RT = $RT[$i];
            $pricelistsub->LT = $LT[$i];
            $pricelistsub->Lining = $Lining[$i];
            $pricelistsub->Estradiol = $Estradiol[$i];
            $pricelistsub->Notes = $Notes[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/fetpage2/'.$request->FETiD);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from fetpage2s where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = FETPage2::destroy($request->del_id);

        return redirect()->to('/fetpage2/'.$request->DocId);
    }
}
