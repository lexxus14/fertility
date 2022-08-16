<?php

namespace App\Http\Controllers;

use App\PriceList;
use App\PriceListSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Staff;
use App\Reason;
use App\Medicine;

use App\Http\Controllers\SystemFunctionController;

class PriceListController extends Controller
{
    protected $redirectTo = '/home';
    private $DocTransName = "Price List"; 
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
        return view('pricelist.index');
    }

    public function PatientPriceList($PatientId){
        return view('pricelist.patientindex');
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

        $strsql ="select la.*,r.description from lead_assessments la 
                    inner join reasons r on r.id = la.reasonid
                    where la.id=".$PatientId;
        $leadassessments = DB::select($strsql);



        $medicines = Medicine::all();
        $staffs = Staff::all();
        $reasons = Reason::all();

        return view('pricelist.new',compact('patients','leadassessments','staffs','reasons','medicines'));
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

        $pricelist = new PriceList;
        $pricelist->patientid=$request->txtpatientId;

        $date = date_create($request->txtLeadDate);
        $pricelist->pricelistdate= $date->format('Y-m-d');

        $pricelist->total_amount=$request->txtTotalPayableAmount;
        $pricelist->notes=$request->txtnotepricelist;
        $pricelist->staffid=$request->cmbStaff;
        $pricelist->createdbyid=Auth::user()->id;
        $pricelist->save();
        $pricelist_id = $pricelist->id;

        $MedicineId=$request->txtMedicineId;
        $qty=$request->txtqty;
        $amount=$request->txtamount;
        $TotalAmount=$request->txtTotalAmount;

        $N = count($MedicineId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PriceListSub;
            $pricelistsub->pricelistid = $pricelist_id; 
            $pricelistsub->medicineid = $MedicineId[$i];
            $pricelistsub->qty = $qty[$i];
            $pricelistsub->amount = $amount[$i];
            $pricelistsub->total_amount = $TotalAmount[$i];
            $pricelistsub->save();
            
        }

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($pricelist_id,$this->DocTransName);
            
            return redirect()->to('/lead/view/'.$request->txtpatientId);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function show($priceListId)
    {
         $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join price_lists as pr on pr.patientid = p.id
                    WHERE pr.id =".$priceListId;
        $patients = DB::select($strsql);

        $strsql ="select pl.*,s.name from price_lists pl 
                    inner join staff s on s.id = pl.staffid
                    where pl.id=".$priceListId;
        $pricelists = DB::select($strsql);


        $strsql ="select pls.*,m.description from price_list_subs pls 
                    inner join price_lists pl on pl.id = pls.pricelistid
                    inner join medicines m on m.id = pls.medicineid                    
                    where pl.id=".$priceListId." order by pls.id asc";
        $pricelistssub = DB::select($strsql);


        $medicines = Medicine::all();
        $staffs = Staff::all();
        $reasons = Reason::all();

        return view('pricelist.view',compact('pricelistssub','patients','pricelists','staffs','reasons','medicines'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function edit($priceListId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    inner join price_lists as pr on pr.patientid = p.id
                    WHERE pr.id =".$priceListId;
        $patients = DB::select($strsql);

        $strsql ="select pl.*,s.name from price_lists pl 
                    inner join staff s on s.id = pl.staffid
                    where pl.id=".$priceListId;
        $pricelists = DB::select($strsql);


        $strsql ="select pls.*,m.description from price_list_subs pls 
                    inner join price_lists pl on pl.id = pls.pricelistid
                    inner join medicines m on m.id = pls.medicineid                    
                    where pl.id=".$priceListId." order by pls.id asc";
        $pricelistssub = DB::select($strsql);


        $medicines = Medicine::all();
        $staffs = Staff::all();
        $reasons = Reason::all();

        // return view('pricelist.edit');
        return view('pricelist.edit',compact('pricelistssub','patients','pricelists','staffs','reasons','medicines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pricelist = PriceList::find($request->txtPriceListId);
        $pricelist->patientid=$request->txtpatientId;

        $date = date_create($request->txtLeadDate);
        $pricelist->pricelistdate= $date->format('Y-m-d');

        $pricelist->total_amount=$request->txtTotalPayableAmount;
        $pricelist->notes=$request->txtnotepricelist;
        $pricelist->staffid=$request->cmbStaff;
        $pricelist->createdbyid=Auth::user()->id;
        $pricelist->save();

        $sub = DB::table('price_list_subs')->where('pricelistid', $request->txtPriceListId)->delete();

        $MedicineId=$request->txtMedicineId;
        $qty=$request->txtqty;
        $amount=$request->txtamount;
        $TotalAmount=$request->txtTotalAmount;

        $N = count($MedicineId);

        for($i=0; $i < $N; $i++)
        {
            $pricelistsub = new PriceListSub;
            $pricelistsub->pricelistid = $request->txtPriceListId;
            $pricelistsub->medicineid = $MedicineId[$i];
            $pricelistsub->qty = $qty[$i];
            $pricelistsub->amount = $amount[$i];
            $pricelistsub->total_amount = $TotalAmount[$i];
            $pricelistsub->save();
            
        }

            return redirect()->to('/lead/view/'.$request->txtpatientId);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //

        $sub = DB::table('price_list_subs')->where('pricelistid', $request->del_id)->delete();
        $sub = DB::table('price_lists')->where('id', $request->del_id)->delete();
        if(isset($request->txtTransactionSource)){
            return redirect()->to('/lead/view/'.$request->txtpatientId);
        }
    }

    public function GetMedInfo($id)
    {
        $task = Medicine::find($id);

        return response()->json($task);

    }
}
