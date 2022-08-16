<?php

namespace App\Http\Controllers;

use App\DoctorDiagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorDiagnosisController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "DoctorDiagnosis";
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
        $doctordiagnosis = DoctorDiagnosis::all();
        return view('doctordiagnosis.index',compact('doctordiagnosis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('doctordiagnosis.new');
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
            $doctordiagnosis = new DoctorDiagnosis;
            $doctordiagnosis->code = $request->txtcode;
            $doctordiagnosis->description = $request->txtdescription;
            $doctordiagnosis->note = $request->txtnote;
            $doctordiagnosis->save();

            $doctordiagnosisId = $doctordiagnosis->id;

            $translinks = new SystemFunctionController;

            $translinks->StoreTransLink($doctordiagnosisId,$this->DocTransName);


        return redirect()->to('/doctordiagnosis');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function show(Reason $reason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // var_dump($id);
        // $reasons =Reason::find(1)->get();
        $doctordiagnosis = DB::table('doctordiagnosis')->where('id',$id)->get();
        // var_dump($reasons);
        return view('doctordiagnosis.edit',compact('doctordiagnosis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $doctordiagnosis = DoctorDiagnosis::find($request->id);
        $doctordiagnosis->code = $request->txtcode;
        $doctordiagnosis->description = $request->txtdescription;
        $doctordiagnosis->note = $request->txtnote;
        $doctordiagnosis->save();
        
        $translinks = new SystemFunctionController;

        $translinks->UpdateTransLink($request->id,$this->DocTransName);
        return redirect()->to('/doctordiagnosis');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $doctordiagnosis = DoctorDiagnosis::destroy($request->del_id);
        return redirect()->to('/doctordiagnosis');
    }

    public function DoctorDiagnosInfo($id)
    {
        $task = DoctorDiagnosis::find($id);

        return response()->json($task);

    }
}
