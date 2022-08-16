<?php

namespace App\Http\Controllers;

use App\LabTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SystemFunctionController;


class LabTestController extends Controller
{
    private $DocTransName = "Laboratory Test";  
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
        $labtests = LabTest::all();
        return view('labtest.index',compact('labtests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('labtest.new');
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
        $labtest = new LabTest;
        $labtest->code = $request->txtcode;
        $labtest->description = $request->txtdescription;
        $labtest->price = $request->txtprice;
        $labtest->note = $request->txtnote;
        $labtest->save();

        $transid = $labtest->id;

        $translinks = new SystemFunctionController;

        $translinks->StoreTransLink($transid,$this->DocTransName);

        return redirect()->to('/labtest');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LabTest  $labTest
     * @return \Illuminate\Http\Response
     */
    public function show(LabTest $labTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LabTest  $labTest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $labtests = DB::table('lab_tests')->where('id',$id)->get();
        // var_dump($reasons);
        return view('labtest.edit',compact('labtests'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LabTest  $labTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $labtest = LabTest::find($request->id);
        $labtest->code = $request->txtcode;
        $labtest->description = $request->txtdescription;
        $labtest->price = $request->txtprice;
        $labtest->note = $request->txtnote;
        $labtest->save();
        return redirect()->to('/labtest');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LabTest  $labTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $labtest = LabTest::destroy($request->del_id);
        return redirect()->to('/labtest');
    }

    public function GetLabTestInfo($id)
    {
        $task = LabTest::find($id);

        return response()->json($task);

    }
}
