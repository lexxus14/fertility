<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SystemFunctionController;

class MedicineController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Medicine";  
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
        $medicines = Medicine::all();
        return view('medicine.index',compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('medicine.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Save In Database
            $intProdType = 0;
            if($request->chkIsTreament){
                $intProdType=1;
            }
            $medicine = new Medicine;
            $medicine->code = $request->txtcode;
            $medicine->description = $request->txtdescription;
            $medicine->price = $request->txtprice;
            $medicine->note = $request->txtnote;
            $medicine->prod_type = $intProdType;
            $medicine->save();

            $transid = $medicine->id;

            $translinks = new SystemFunctionController;

            $translinks->StoreTransLink($transid,$this->DocTransName);
        
        return redirect()->to('/medicine');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         //
        // var_dump($id);
        // $reasons =Reason::find(1)->get();
        $medicines = DB::table('medicines')->where('id',$id)->get();
        // var_dump($reasons);
        return view('medicine.edit',compact('medicines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $intProdType = 0;
            if($request->chkIsTreament){
                $intProdType=1;
            }

        $medicine = Medicine::find($request->id);
        $medicine->code = $request->txtcode;
        $medicine->description = $request->txtdescription;
        $medicine->price = $request->txtprice;
        $medicine->note = $request->txtnote;
        $medicine->prod_type = $intProdType;
        $medicine->save();

        $translinks = new SystemFunctionController;

        $translinks->UpdateTransLink($request->id,$this->DocTransName);
        
        return redirect()->to('/medicine');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $medicine = Medicine::destroy($request->del_id);
        return redirect()->to('/medicine');
    }
}
