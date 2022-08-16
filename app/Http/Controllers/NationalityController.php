<?php

namespace App\Http\Controllers;

use App\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NationalityController extends Controller
{
    protected $redirectTo = '/home'; 
    private $DocTransName = "Nationality";
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
        $nationalities = Nationality::all();
        return view('nationality.index',compact('nationalities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('nationality.new');
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
            $nationality = new Nationality;
            $nationality->code = $request->txtcode;
            $nationality->description = $request->txtdescription;
            $nationality->save();

            $nationalityId = $nationality->id;

            $translinks = new SystemFunctionController;

            $translinks->StoreTransLink($nationalityId,$this->DocTransName);


        return redirect()->to('/nationality');
        
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
        $nationalities = DB::table('nationalities')->where('id',$id)->get();
        // var_dump($reasons);
        return view('nationality.edit',compact('nationalities'));
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
        $nationalities = Nationality::find($request->id);
        $nationalities->code = $request->txtcode;
        $nationalities->description = $request->txtdescription;
        $nationalities->save();
        
        $translinks = new SystemFunctionController;

        $translinks->UpdateTransLink($nationalities->id,$this->DocTransName);
        return redirect()->to('/nationality');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $nationalities = Nationality::destroy($request->del_id);
        return redirect()->to('/nationality');
    }
}
