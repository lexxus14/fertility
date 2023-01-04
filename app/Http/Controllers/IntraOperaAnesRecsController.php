<?php

namespace App\Http\Controllers;

use App\IntraOperaAnesRecs;
use App\IntOpeAneRecTotalDoseDrugs;
use App\Staff;
use App\Medicine;
use App\MedicineUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManagerStatic as Image;
use File;

use App\Http\Controllers\Controller;

class IntraOperaAnesRecsController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Inter-Operative Anesthesia Records";

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

    public function IntraOperAnesRecs($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="select IntraOperAnesRecs.*,p.name StaffName from IntraOperAnesRecs 
                    left join staff as p on p.id = IntraOperAnesRecs.SurgeonStaffId
                  where patientid =".$PatientId;
        $docresult = DB::select($strsql);

        return view('intraoperaanesrec.patientindex',compact('docresult','patients'));
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
        $Medicines = Medicine::all();
        $MedicineUnits = MedicineUnit::all();

        return view('intraoperaanesrec.new',compact('patients','Staffs','Medicines','MedicineUnits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $IntOpeAneRecord  = 'intropeanesrec/' ."intropeanesrec-".time().".png";
        $IntOpeAneRecordImagePath = public_path($IntOpeAneRecord);
        Image::make(file_get_contents($request->IntOpeAneRecord))->save($IntOpeAneRecordImagePath); 

        //
        $imagepath = "";

        if ($files = $request->file('inputFile')) {
        // Define upload path
           $destinationPath = public_path('/file/'); // upload path
        // Upload Orginal Image           
           $imagepath = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $imagepath);
       }

        $docfiles = new IntraOperaAnesRecs;
        $docfiles->patientid = $request->txtpatientId;
        $docfiles->filelink = '/file/'.$imagepath;        
        $docfiles->createdbyid=Auth::user()->id;

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->BP=$request->BP;
        $docfiles->PulseRate=$request->PulseRate;
        $docfiles->RR=$request->RR;
        $docfiles->Temperature=$request->Temperature;
        $docfiles->Allergy=$request->Allergy;
        $docfiles->IntraOperativeDiags=$request->IntraOperativeDiags;
        $docfiles->SurgeryName=$request->SurgeryName; 
        $docfiles->SurgeonStaffId=$request->SurgeonStaffId;
        $docfiles->AsstSurgeonStaffId=$request->AsstSurgeonStaffId;
        $docfiles->AnesthetistStaffId=$request->AnesthetistStaffId;
        $docfiles->TypeOfAnesthesia=$request->TypeOfAnesthesia; 
        $docfiles->AnesthesiaStartTime=$request->AnesthesiaStartTime; 
        $docfiles->AnesthesiaEndTime=$request->AnesthesiaEndTime;
        $docfiles->SurgeryStartTime=$request->SurgeryStartTime;
        $docfiles->SurgeryEndTime=$request->SurgeryEndTime;
        $docfiles->IntOpeAneRecord=$IntOpeAneRecord;
        $docfiles->Notes=$request->Notes;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $MedId=$request->MedId;
        $UnitId=$request->UnitId;
        $Dose=$request->Dose;

        $N = count($MedId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new IntOpeAneRecTotalDoseDrugs;
            $pricelistsub->IntraOperaAnesRecId = $doclab_id; 
            $pricelistsub->MedId=$MedId[$i];
            $pricelistsub->UnitId=$UnitId[$i];
            $pricelistsub->Dose=$Dose[$i];
            $pricelistsub->save();
            
        }     

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/intraoperaanesrec/'.$request->txtpatientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IntraOperaAnesRecs  $intraOperaAnesRecs
     * @return \Illuminate\Http\Response
     */
    public function show($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join IntraOperAnesRecs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select IntraOperAnesRecs.*,p.name StaffName,s.name AsstSurgeonStaffName,s1.name AnesthetistStaffName  from IntraOperAnesRecs 
                    left join staff as p on p.id = IntraOperAnesRecs.SurgeonStaffId
                    left join staff as s on s.id = IntraOperAnesRecs.AsstSurgeonStaffId
                    left join staff as s1 on s1.id = IntraOperAnesRecs.AnesthetistStaffId
                  where IntraOperAnesRecs.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dd.description,mu.ShortSymbol,IntOpeAneRecTotalDoseDrugs.* from IntOpeAneRecTotalDoseDrugs 
            inner join medicines dd on dd.id = IntOpeAneRecTotalDoseDrugs.MedId
            inner join medicineunits mu on mu.id = IntOpeAneRecTotalDoseDrugs.UnitId
            where IntOpeAneRecTotalDoseDrugs.IntraOperaAnesRecId=".$docId;

        $IntOpeAneRecTotalDoseDrugs = DB::select($strsql);

        $Staffs = Staff::all();
        $Medicines = Medicine::all();
        $MedicineUnits = MedicineUnit::all();

        return view('intraoperaanesrec.view',compact('docresults','patients','Medicines','MedicineUnits','IntOpeAneRecTotalDoseDrugs','Staffs','docId'));
    }

    public function PrintIntraOperAnesRecs($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join IntraOperAnesRecs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select IntraOperAnesRecs.*,p.name StaffName,s.name AsstSurgeonStaffName,s1.name AnesthetistStaffName  from IntraOperAnesRecs 
                    left join staff as p on p.id = IntraOperAnesRecs.SurgeonStaffId
                    left join staff as s on s.id = IntraOperAnesRecs.AsstSurgeonStaffId
                    left join staff as s1 on s1.id = IntraOperAnesRecs.AnesthetistStaffId
                  where IntraOperAnesRecs.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dd.description,mu.ShortSymbol,IntOpeAneRecTotalDoseDrugs.* from IntOpeAneRecTotalDoseDrugs 
            inner join medicines dd on dd.id = IntOpeAneRecTotalDoseDrugs.MedId
            inner join medicineunits mu on mu.id = IntOpeAneRecTotalDoseDrugs.UnitId
            where IntOpeAneRecTotalDoseDrugs.IntraOperaAnesRecId=".$docId;

        $IntOpeAneRecTotalDoseDrugs = DB::select($strsql);

        $Staffs = Staff::all();
        $Medicines = Medicine::all();
        $MedicineUnits = MedicineUnit::all();

        return view('intraoperaanesrec.print',compact('docresults','patients','Medicines','MedicineUnits','IntOpeAneRecTotalDoseDrugs','Staffs','docId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IntraOperaAnesRecs  $intraOperaAnesRecs
     * @return \Illuminate\Http\Response
     */
    public function edit($docId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join IntraOperAnesRecs as li on li.patientid = p.id
                    WHERE li.id =".$docId;
        $patients = DB::select($strsql);

        $strsql ="select IntraOperAnesRecs.*,p.name StaffName,s.name AsstSurgeonStaffName,s1.name AnesthetistStaffName  from IntraOperAnesRecs 
                    left join staff as p on p.id = IntraOperAnesRecs.SurgeonStaffId
                    left join staff as s on s.id = IntraOperAnesRecs.AsstSurgeonStaffId
                    left join staff as s1 on s1.id = IntraOperAnesRecs.AnesthetistStaffId
                  where IntraOperAnesRecs.id =".$docId;
        $docresults = DB::select($strsql);

        $strsql ="select dd.description,mu.ShortSymbol,IntOpeAneRecTotalDoseDrugs.* from IntOpeAneRecTotalDoseDrugs 
            inner join medicines dd on dd.id = IntOpeAneRecTotalDoseDrugs.MedId
            inner join medicineunits mu on mu.id = IntOpeAneRecTotalDoseDrugs.UnitId
            where IntOpeAneRecTotalDoseDrugs.IntraOperaAnesRecId=".$docId;

        $IntOpeAneRecTotalDoseDrugs = DB::select($strsql);

        $Staffs = Staff::all();
        $Medicines = Medicine::all();
        $MedicineUnits = MedicineUnit::all();

        return view('intraoperaanesrec.edit',compact('docresults','patients','Medicines','MedicineUnits','IntOpeAneRecTotalDoseDrugs','Staffs','docId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IntraOperaAnesRecs  $intraOperaAnesRecs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $imagepath = "";

        $strsql ="SELECT * from IntraOperAnesRecs where id=".$request->docId;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
            File::delete($la->IntOpeAneRecord);
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

       $IntOpeAneRecord  = 'intropeanesrec/' ."intropeanesrec-".time().".png";
        $IntOpeAneRecordImagePath = public_path($IntOpeAneRecord);
        Image::make(file_get_contents($request->IntOpeAneRecord))->save($IntOpeAneRecordImagePath);

       $docfiles = IntraOperaAnesRecs::find($request->docId);
        $docfiles->filelink = $imagepath;        

        $date = date_create($request->docdate);
        $docfiles->docdate= $date->format('Y-m-d');

        $docfiles->BP=$request->BP;
        $docfiles->PulseRate=$request->PulseRate;
        $docfiles->RR=$request->RR;
        $docfiles->Temperature=$request->Temperature;
        $docfiles->Allergy=$request->Allergy;
        $docfiles->IntraOperativeDiags=$request->IntraOperativeDiags;
        $docfiles->SurgeryName=$request->SurgeryName; 
        $docfiles->SurgeonStaffId=$request->SurgeonStaffId;
        $docfiles->AsstSurgeonStaffId=$request->AsstSurgeonStaffId;
        $docfiles->AnesthetistStaffId=$request->AnesthetistStaffId;
        $docfiles->TypeOfAnesthesia=$request->TypeOfAnesthesia; 
        $docfiles->AnesthesiaStartTime=$request->AnesthesiaStartTime; 
        $docfiles->AnesthesiaEndTime=$request->AnesthesiaEndTime;
        $docfiles->SurgeryStartTime=$request->SurgeryStartTime;
        $docfiles->SurgeryEndTime=$request->SurgeryEndTime;
        $docfiles->IntOpeAneRecord=$IntOpeAneRecord;
        $docfiles->Notes=$request->Notes;
        $docfiles->save();
        $doclab_id = $docfiles->id;

        $sub = DB::table('IntOpeAneRecTotalDoseDrugs')->where('IntraOperaAnesRecId', $request->docId)->delete();

        $MedId=$request->MedId;
        $UnitId=$request->UnitId;
        $Dose=$request->Dose;

        $N = count($MedId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new IntOpeAneRecTotalDoseDrugs;
            $pricelistsub->IntraOperaAnesRecId = $doclab_id; 
            $pricelistsub->MedId=$MedId[$i];
            $pricelistsub->UnitId=$UnitId[$i];
            $pricelistsub->Dose=$Dose[$i];
            $pricelistsub->save();
            
        }     

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($doclab_id,$this->DocTransName);
        
        return redirect()->to('/intraoperaanesrec/'.$request->txtpatientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IntraOperaAnesRecs  $intraOperaAnesRecs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $strsql ="SELECT * from IntraOperAnesRecs where id=".$request->del_id;
        $las = DB::select($strsql);

        $laLinkFile ="";

        foreach($las as $la){
            $laLinkFile = $la->filelink;
            File::delete($la->IntOpeAneRecord);
        }
            
        if(is_file(public_path($laLinkFile))){
            unlink(public_path($laLinkFile));
        }

        $leadassessment = IntraOperaAnesRecs::destroy($request->del_id);

        return redirect()->to('/intraoperaanesrec/'.$request->txtpatientId);
    }
}
