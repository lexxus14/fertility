<?php

namespace App\Http\Controllers;


use App\FET;
use App\FetMedSubs;
use App\FETBcp;
use App\FETExpDate;
use App\FETOthers;
use App\FetOtherMedSubs;
use App\DayShfts;
use App\Medicine;
use App\MedicineUnit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FETController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "FET";

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

    public function fet($DocId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join fetphases as st on st.patientid = p.id
                    WHERE st.id =".$DocId;
        $patients = DB::select($strsql);

        $strsql ="select *
                    from fets 
                  where  FETPhaseID =".$DocId;
        $docresult = DB::select($strsql);

        $strsql ="select *
                    from fetBCPS 
                  where  FETPhaseID =".$DocId;
        $docresultBCPS  = DB::select($strsql);

        $strsql ="select *
                    from fetphases 
                  where  id =".$DocId;
        $docresultheaders = DB::select($strsql);

        $medicines = Medicine::all(); 
        $medicinesunits = MedicineUnit::all(); 
        $dayshifts = DayShfts::all(); 
        return view('fet.patientindex',compact('docresult','patients','DocId','medicines','medicinesunits','dayshifts','docresultheaders','docresultBCPS'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
       $AddDate = 0;
       $date = date_create($request->txtDocDate);
       $docDate = date_create($request->txtDocDate);
       $docDate = date_format($docDate,"Y-m-d");;
       for($ctrloop = intval($request->CycleFrom);$ctrloop<=intval($request->CycleTo);$ctrloop++)
       {

            $docfiles = new FET;
            
            if($AddDate>0){                
                date_add($date,date_interval_create_from_date_string("1 days"));
            } 
            $AddDate++;
            $Newdate = date_format($date,"Y-m-d");
            $docfiles->docdate= $docDate;
            $docfiles->CycleDate= $Newdate;

            
            $docfiles->FETPhaseID = $request->FETPhaseID;
            $docfiles->CycleNo = $ctrloop;

            $docfiles->Notes = $request->Notes;

            $docfiles->filelink = '/file/'.$imagepath;

            $docfiles->createdbyid=Auth::user()->id;
            $docfiles->save();
            $doclab_id = $docfiles->id;

            $docFETBcp = new FETBcp;
            $docFETBcp->docdate = $docDate;
            $docFETBcp->FETPhaseID = $request->FETPhaseID;
            $docFETBcp->CycleDate = $Newdate;
            $docFETBcp->CycleNo = $ctrloop;
            $docFETBcp->save();

            
            $MedId=$request->NMedId;
            $dose=$request->Ndose;
            $UnitId=$request->NUnitId;
            $DayShiftId=$request->NDayShiftId;

            $N = count($MedId);

            for($i=0; $i < $N; $i++)
            {
                $pricelistsub = new FetMedSubs;
                $pricelistsub->FetId = $doclab_id; 
                $pricelistsub->MedId = $MedId[$i];
                $pricelistsub->MedUnitId = $UnitId[$i];
                $pricelistsub->DayShiftId = $DayShiftId[$i];
                $pricelistsub->Dose = $dose[$i];
                $pricelistsub->save();
                
            }

            $translinks = new SystemFunctionController;

            $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        }

       
        
        return redirect()->to('/fet/'.$request->FETPhaseID);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_other(Request $request)
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
       $AddDate = 0;
       $date = date_create($request->txtDocDate);
       $docDate = date_create($request->txtDocDate);
       $docDate = date_format($docDate,"Y-m-d");;
       for($ctrloop = intval($request->CycleFrom);$ctrloop<=intval($request->CycleTo);$ctrloop++)
       {

            $docfiles = new FETOthers;
            
            if($AddDate>0){                
                date_add($date,date_interval_create_from_date_string("1 days"));
            } 
            $AddDate++;
            $Newdate = date_format($date,"Y-m-d");
            $docfiles->docdate= $docDate;
            $docfiles->CycleDate= $Newdate;

            
            $docfiles->FETPhaseID = $request->FETPhaseID;

            $docfiles->Notes = $request->Notes;

            $docfiles->filelink = '/file/'.$imagepath;

            $docfiles->createdbyid=Auth::user()->id;
            $docfiles->save();
            $doclab_id = $docfiles->id;
            
            $MedId=$request->OMedId;
            $dose=$request->Odose;
            $UnitId=$request->OUnitId;
            $DayShiftId=$request->ODayShiftId;

            $N = count($MedId);

            for($i=0; $i < $N; $i++)
            {
                $pricelistsub = new FetOtherMedSubs;
                $pricelistsub->fetothersId = $doclab_id; 
                $pricelistsub->MedId = $MedId[$i];
                $pricelistsub->MedUnitId = $UnitId[$i];
                $pricelistsub->DayShiftId = $DayShiftId[$i];
                $pricelistsub->Dose = $dose[$i];
                $pricelistsub->save();
                
            }

            $translinks = new SystemFunctionController;

            $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        }

       
        
        return redirect()->to('/fet/'.$request->StimulatingMedicationsid);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_expected(Request $request)
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
       $AddDate = 0;
       $date = date_create($request->txtDocDate);
       $docDate = date_create($request->txtDocDate);
       $docDate = date_format($docDate,"Y-m-d");;
       for($ctrloop = intval($request->CycleFrom);$ctrloop<=intval($request->CycleTo);$ctrloop++)
       {

            $docfiles = new FETExpDate;
            
            if($AddDate>0){                
                date_add($date,date_interval_create_from_date_string("1 days"));
            } 
            $AddDate++;
            $Newdate = date_format($date,"Y-m-d");
            $docfiles->docdate= $docDate;
            $docfiles->CycleNo= $ctrloop;
            $docfiles->CycleDate= $Newdate;            
            $docfiles->FETPhaseID = $request->FETPhaseID;

            $docfiles->Notes = $request->Notes;

            $docfiles->filelink = '/file/'.$imagepath;

            $docfiles->createdbyid=Auth::user()->id;
            $docfiles->save();

        }

       
        
        return redirect()->to('/fet/'.$request->FETPhaseID);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
