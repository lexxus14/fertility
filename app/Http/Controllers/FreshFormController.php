<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FreshFormPhase;
use App\FreshForm;
use App\FreshFormMedSub;
use App\FreshFormBCP;
use App\FreshFormExpDate;
use App\Medicine;
use App\MedicineUnit; 
use App\DayShfts; 

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FreshFormController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Fresh Form";

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function FreshForm($DocId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join FreshPhases as st on st.patientid = p.id
                    WHERE st.id =".$DocId;
        $patients = DB::select($strsql);

        $strsql ="select *
                    from FreshForms 
                  where  FreshPhaseID =".$DocId;
        $docresult = DB::select($strsql);

        $strsql ="select *
                    from FreshFormBCPs 
                  where  FreshPhaseID =".$DocId;
        $docresultBCPS  = DB::select($strsql);

        $strsql ="select *
                    from FreshFormExpDates 
                  where  FreshPhaseID =".$DocId;
        $docresultExpDate  = DB::select($strsql);

        $strsql ="select *
                    from FreshPhases 
                  where  id =".$DocId;
        $docresultheaders = DB::select($strsql);

        $strsql ="select COUNT(*) AS TotalFETPage2
                    from FETPage2s 
                    inner join fets on fets.id =  FETPage2s.FETiD
                  where  FETPhaseID =".$DocId;
        $TotalFETPage2s = DB::select($strsql);


        $medicines = Medicine::all(); 
        $medicinesunits = MedicineUnit::all(); 
        $dayshifts = DayShfts::all(); 
        return view('fresh.patientindex',compact('docresult','patients','DocId','medicines','medicinesunits','dayshifts','docresultheaders','docresultBCPS','docresultExpDate','docresultFETothers','TotalFETPage2s'));
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
       $docDate = date_format($docDate,"Y-m-d");
       for($ctrloop = intval($request->CycleFrom);$ctrloop<=intval($request->CycleTo);$ctrloop++)
       {

            $docfiles = new FreshForm;
            
            if($AddDate>0){                
                date_add($date,date_interval_create_from_date_string("1 days"));
            } 
            $AddDate++;
            $Newdate = date_format($date,"Y-m-d");
            $docfiles->docdate= $docDate;
            $docfiles->CycleDate= $Newdate;

            
            $docfiles->FreshPhaseID = $request->FreshPhaseID;
            $docfiles->CycleNo = $ctrloop;

            $docfiles->Notes = $request->Notes;

            $docfiles->filelink = '/file/'.$imagepath;

            $docfiles->createdbyid=Auth::user()->id;
            $docfiles->save();
            $doclab_id = $docfiles->id;

            $docFETBcp = new FreshFormBCP;
            $docFETBcp->docdate = $docDate;
            $docFETBcp->FreshPhaseID = $request->FreshPhaseID;
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
                $pricelistsub = new FreshFormMedSub;
                $pricelistsub->FreshFormId = $doclab_id; 
                $pricelistsub->MedId = $MedId[$i];
                $pricelistsub->MedUnitId = $UnitId[$i];
                $pricelistsub->DayShiftId = $DayShiftId[$i];
                $pricelistsub->Dose = $dose[$i];
                $pricelistsub->save();
                
            }

            $translinks = new SystemFunctionController;

            $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        }

       
        
        return redirect()->to('/freshform/'.$request->FreshPhaseID);
    }

    public function store_expected(Request $request)
    {
        $AddDate = 0;
       $date = date_create($request->txtDocDate);
       $docDate = date_create($request->txtDocDate);
       $docDate = date_format($docDate,"Y-m-d");;
       for($ctrloop = intval($request->CycleFrom);$ctrloop<=intval($request->CycleTo);$ctrloop++)
       {

            $docfiles = new FreshFormExpDate;
            
            if($AddDate>0){                
                date_add($date,date_interval_create_from_date_string("1 days"));
            } 
            $AddDate++;
            $Newdate = date_format($date,"Y-m-d");
            $docfiles->docdate= $docDate;
            $docfiles->CycleNo= $ctrloop;
            $docfiles->CycleDate= $Newdate;            
            $docfiles->FreshPhaseID = $request->FreshPhaseID;

            $docfiles->Notes = $request->Notes;

            $docfiles->createdbyid=Auth::user()->id;
            $docfiles->save();

        }       
        
        return redirect()->to('/freshform/'.$request->FreshPhaseID);
    }

    public function view($PhaseId,$DocId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join freshphases as st on st.patientid = p.id
                    WHERE st.id =".$PhaseId;
        $patients = DB::select($strsql);

        $strsql ="select *
                    from freshforms 
                  where  id =".$DocId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT Dose,m.id as MedId,freshformmedsubs.MedUnitId,freshformmedsubs.DayShiftId, m.description as Medicine,mu.ShortSymbol,d.ShortSymbol as DayShifSymbol 
                    FROM `freshformmedsubs`
                    INNER JOIN medicines m on m.id = freshformmedsubs.MedId
                    INNER JOIN medicineunits mu on mu.id = freshformmedsubs.MedUnitId
                    INNER JOIN dayshifts d on d.id = freshformmedsubs.DayShiftId
                    WHERE FreshFormId =".$DocId;
        $subdocresults = DB::select($strsql);

        $medicines = Medicine::all(); 
        $medicinesunits = MedicineUnit::all(); 
        $dayshifts = DayShfts::all();  
        return view('fresh.view',compact('PhaseId','DocId','docresults','patients','medicines','medicinesunits','subdocresults','dayshifts'));
    }

    public function viewbcp($PhaseId,$docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join freshphases as st on st.patientid = p.id
                    WHERE st.id =".$PhaseId;
        $patients = DB::select($strsql);

        $strsql ="select *
                    from freshformbcps 
                  where  id =".$docId." and FreshPhaseID=".$PhaseId;
        $docresults  = DB::select($strsql);

        $medicines = Medicine::all(); 
        $medicinesunits = MedicineUnit::all(); 
        $dayshifts = DayShfts::all();  
        return view('fresh.viewbcp',compact('PhaseId','docId','docresults','patients','medicines','medicinesunits','dayshifts'));
    }

    public function ViewExpectedDate($PhaseId,$docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join freshphases as st on st.patientid = p.id
                    WHERE st.id =".$PhaseId;
        $patients = DB::select($strsql);

        $strsql ="select *
                    from FreshFormExpDates 
                  where  id =".$docId." and FreshPhaseID=".$PhaseId;
        $docresults  = DB::select($strsql);

        $medicines = Medicine::all(); 
        $medicinesunits = MedicineUnit::all(); 
        $dayshifts = DayShfts::all();  
        return view('fresh.viewexpdate',compact('PhaseId','docId','docresults','patients','medicines','medicinesunits','dayshifts'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($PhaseId,$DocId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join freshphases as st on st.patientid = p.id
                    WHERE st.id =".$PhaseId;
        $patients = DB::select($strsql);

        $strsql ="select *
                    from freshforms 
                  where  id =".$DocId;
        $docresults = DB::select($strsql);

        $strsql ="SELECT Dose,m.id as MedId,freshformmedsubs.MedUnitId,freshformmedsubs.DayShiftId, m.description as Medicine,mu.ShortSymbol,d.ShortSymbol as DayShifSymbol 
                    FROM `freshformmedsubs`
                    INNER JOIN medicines m on m.id = freshformmedsubs.MedId
                    INNER JOIN medicineunits mu on mu.id = freshformmedsubs.MedUnitId
                    INNER JOIN dayshifts d on d.id = freshformmedsubs.DayShiftId
                    WHERE FreshFormId =".$DocId;
        $subdocresults = DB::select($strsql);

        $medicines = Medicine::all(); 
        $medicinesunits = MedicineUnit::all(); 
        $dayshifts = DayShfts::all();  
        return view('fresh.edit',compact('PhaseId','DocId','docresults','patients','medicines','medicinesunits','subdocresults','dayshifts'));
    }

    public function editbcp($PhaseId,$docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join freshphases as st on st.patientid = p.id
                    WHERE st.id =".$PhaseId;
        $patients = DB::select($strsql);

        $strsql ="select *
                    from freshformbcps 
                  where  id =".$docId." and FreshPhaseID=".$PhaseId;
        $docresults  = DB::select($strsql);

        $medicines = Medicine::all(); 
        $medicinesunits = MedicineUnit::all(); 
        $dayshifts = DayShfts::all();  
        return view('fresh.editbcp',compact('PhaseId','docId','docresults','patients','medicines','medicinesunits','dayshifts'));
    }

    public function EditExpectedDate($PhaseId,$docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join freshphases as st on st.patientid = p.id
                    WHERE st.id =".$PhaseId;
        $patients = DB::select($strsql);

        $strsql ="select *
                    from freshformexpdates 
                  where  id =".$docId." and FreshPhaseID=".$PhaseId;
        $docresults  = DB::select($strsql);

        $medicines = Medicine::all(); 
        $medicinesunits = MedicineUnit::all(); 
        $dayshifts = DayShfts::all();  
        return view('fresh.editexpdate',compact('PhaseId','docId','docresults','patients','medicines','medicinesunits','dayshifts'));
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
        $docDate = date_create($request->txtDocDate);
        $docDate = date_format($docDate,"Y-m-d");

        $cdocDate = date_create($request->CycleDate);
        $cdocDate = date_format($cdocDate,"Y-m-d");

        $docfiles = FreshForm::find($request->DocId);
        $docfiles->CycleDate= $cdocDate;

        
        $docfiles->CycleNo = $request->CycleNo;

        $docfiles->Notes = $request->Notes;

        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('freshformmedsubs')->where('FreshFormId', $request->DocId)->delete();

        $MedId=$request->NMedId;
        $dose=$request->Ndose;
        $UnitId=$request->NUnitId;
        $DayShiftId=$request->NDayShiftId;

        $N = count($MedId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new FreshFormMedSub;
            $pricelistsub->FreshFormId = $doclab_id; 
            $pricelistsub->MedId = $MedId[$i];
            $pricelistsub->MedUnitId = $UnitId[$i];
            $pricelistsub->DayShiftId = $DayShiftId[$i];
            $pricelistsub->Dose = $dose[$i];
            $pricelistsub->save();
            
        }

        return redirect()->to('/freshform/'.$request->PhaseId);
    }

    public function updatebcp(Request $request)
    {
        $docDate = date_create($request->txtDocDate);
        $docDate = date_format($docDate,"Y-m-d");

        $cdocDate = date_create($request->CycleDate);
        $cdocDate = date_format($cdocDate,"Y-m-d");

        $docFETBcp = FreshFormBCP::find($request->txtDocId);
        $docFETBcp->docdate = $docDate;
        $docFETBcp->CycleDate =$cdocDate;
        $docFETBcp->CycleNo = $request->CycleNo;
        $docFETBcp->Notes = $request->Notes;
        $docFETBcp->save();
        return redirect()->to('/freshform/'.$request->PhaseId);      
    }

    public function UpdateExpecteDate(Request $request)
    {
        $docDate = date_create($request->txtDocDate);
        $docDate = date_format($docDate,"Y-m-d");

        $docfiles = FreshFormExpDate::find($request->txtDocId);
        $docfiles->docdate= $docDate;
        $docfiles->CycleNo= $request->CycleNo; 
        $docfiles->CycleDate= $docDate;

        $docfiles->Notes = $request->Notes;

        $docfiles->createdbyid=Auth::user()->id;
        $docfiles->save();
        return redirect()->to('/freshform/'.$request->PhaseId);      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $leadassessment = FreshForm::destroy($request->del_id);       

        return redirect()->to('/freshform/'.$request->txtDocId);
    }

    public function FreshFormBCPdestroy(Request $request)
    {
        $leadassessment = FreshFormBCP::destroy($request->del_id);       

        return redirect()->to('/freshform/'.$request->txtDocId);
    }

    public function FreshFormExptecteddestroy(Request $request)
    {
        $leadassessment = FreshFormExpDate::destroy($request->del_id);       

        return redirect()->to('/freshform/'.$request->txtDocId);
    }
}
