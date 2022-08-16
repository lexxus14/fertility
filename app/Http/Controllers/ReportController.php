<?php

namespace App\Http\Controllers;

use App\ReportGen;
use Illuminate\Http\Request;
use Validator;
use App\Patient;
use App\Nationality;
use App\LeadSource;
use App\LeadAssessment;
use App\Staff;
use App\Reason;
use App\LeadReminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ReportController extends Controller
{
    protected $redirectTo = '/home'; 
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
    public function GenerateSummary($PatientId)
    {
        $strsql ="SELECT p.*,wn.description as WifeNationality,hn.description as HusbandNationality,ls.description LeadSource FROM `patients` as p 
                    INNER JOIN nationalities as wn on wn.id = p.WifeNationalityId
                    INNER JOIN lead_sources as ls on ls.id = p.LeadSourceId
                    inner join nationalities as hn on hn.id = p.HusbandNationalityId
                    WHERE p.id =".$PatientId;
        $patients = DB::select($strsql);

        $strsql ="SELECT fertility_results.*,staff.name as Doctor,SN.name as Nurse from fertility_results 
                left join staff on staff.id = fertility_results.DoctorId
                left join staff as SN on SN.id = fertility_results.NurseId
                WHERE PatientId=".$PatientId;
        $patientresults = DB::select($strsql);

        $strsql ="select * from documents 
                  where patientid =".$PatientId;
        $docresults = DB::select($strsql);

        $strsql ="select * from lab_investigations 
                  where patientid =".$PatientId;
        $labinvs = DB::select($strsql);

        $strsql ="select * from doctors_notes 
                  where patientid =".$PatientId;
        $docnotes = DB::select($strsql);

        $strsql ="select * from history_assessments 
                  where patientid =".$PatientId;
        $historyassessments = DB::select($strsql);

        $strsql ="select * from pathology_x_rays 
                  where patientid =".$PatientId;
        $pathologyxrays = DB::select($strsql);

        $strsql ="select * from patient_medications 
                  where patientid =".$PatientId;
        $patientmedications = DB::select($strsql);

        $strsql ="select * from patient_treatments 
                  where patientid =".$PatientId;
        $patienttreatments = DB::select($strsql);

        $strsql ="select eggs_collecteds.*,sd.name as Doctor, sn.name as Nurse from eggs_collecteds
                    inner join staff as sd on sd.id = eggs_collecteds.DoctorId
                    inner join staff as sn on sn.id = eggs_collecteds.NurseId
                  where patientid =".$PatientId;
        $eggscollecteds = DB::select($strsql);

        $strsql ="select eggs_fertilizeds.*,sd.name as Doctor, sn.name as Nurse from eggs_fertilizeds
                    inner join staff as sd on sd.id = eggs_fertilizeds.DoctorId
                    inner join staff as sn on sn.id = eggs_fertilizeds.NurseId
                  where patientid =".$PatientId;
        $eggsfertilizeds = DB::select($strsql);

        $strsql ="select good_embryos.*,sd.name as Doctor, sn.name as Nurse from good_embryos
                    inner join staff as sd on sd.id = good_embryos.DoctorId
                    inner join staff as sn on sn.id = good_embryos.NurseId
                  where patientid =".$PatientId;
        $goodembryos = DB::select($strsql);

        $strsql ="select transferred_embryos.*,sd.name as Doctor, sn.name as Nurse from transferred_embryos
                    inner join staff as sd on sd.id = transferred_embryos.DoctorId
                    inner join staff as sn on sn.id = transferred_embryos.NurseId
                  where patientid =".$PatientId;
        $transferredembryos = DB::select($strsql);

        $strsql ="select frozen_embryos.*,sd.name as Doctor, sn.name as Nurse from frozen_embryos
                    inner join staff as sd on sd.id = frozen_embryos.DoctorId
                    inner join staff as sn on sn.id = frozen_embryos.NurseId
                  where patientid =".$PatientId;
        $frozenembryos = DB::select($strsql);

        $strsql ="select biopsy_studies.*,sd.name as Doctor, sn.name as Nurse from biopsy_studies
                    inner join staff as sd on sd.id = biopsy_studies.DoctorId
                    inner join staff as sn on sn.id = biopsy_studies.NurseId
                  where patientid =".$PatientId;
        $biopsystudys = DB::select($strsql);

        $strsql ="select biopsy_results.*,sd.name as Doctor, sn.name as Nurse from biopsy_results
                    inner join staff as sd on sd.id = biopsy_results.DoctorId
                    inner join staff as sn on sn.id = biopsy_results.NurseId
                  where patientid =".$PatientId;
        $biopsystudyresults = DB::select($strsql);

        $strsql ="select biopsy_results.*,sd.name as Doctor, sn.name as Nurse from biopsy_results
                    inner join staff as sd on sd.id = biopsy_results.DoctorId
                    inner join staff as sn on sn.id = biopsy_results.NurseId
                  where patientid =".$PatientId;
        $biopsystudyresults = DB::select($strsql);

        $strsql ="select * from consultations
                  where patientid =".$PatientId;
        $consultations = DB::select($strsql);

        $strsql ="select * from price_lists
                  where patientid =".$PatientId;
        $pricelists = DB::select($strsql);

        return view('ReportGen.patientsummary',compact('pricelists','consultations','biopsystudyresults','biopsystudys','frozenembryos','transferredembryos','goodembryos','eggsfertilizeds','eggscollecteds','patienttreatments','patientmedications','pathologyxrays','historyassessments','patients','patientresults','docresults','labinvs','docnotes'));
    }
    public function LeadAction(Request $request){

       $strsql="";
        if($request->ajax()){
            $strreason = "";
            $intreason = 0;
            if(!empty($request->chkReason)){
                $intreason = count($request->chkReason);
                $strreason = " AND (";
                foreach($request->chkReason as $reason){
                    $strreason = $strreason." r.id = ".$reason;
                    $intreason--;
                    if($intreason>0){
                        $strreason = $strreason." OR ";
                    }
                }
                $strreason = $strreason." )";
            }
                $strsql="SELECT la.*,r.description Reason,p.MainContactPerson,s.name StaffName FROM lead_assessments la
                    LEFT JOIN reasons r ON r.id = la.reasonid
                    LEFT JOIN patients p on p.id = la.patientid
                    LEFT JOIN staff s on s.id = la.staffid
                    where la.iscurrent=1
                    and la.date BETWEEN '$request->DateFrom' AND '$request->DateTo'
                    AND la.assessmentrate BETWEEN $request->RateFrom and $request->RateTo
                     $strreason ORDER BY la.id asc";              
        }
        else{
            $strsql = "SELECT la.*,r.description as Reason,p.MainContactPerson,s.name StaffName FROM lead_assessments la
                        LEFT JOIN reasons r on r.id = la.reasonid
                        LEFT JOIN patients p ON p.id = la.patientid
                        LEFT JOIN staff s on s.id = la.staffid
                        where la.iscurrent = 1 AND la.date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY)
                        AND NOW() ORDER BY la.date desc";
        }
        

        $results = DB::select($strsql);

        // echo json_encode($data); 
        return response()->json($results);
    }

    public function LeadReport(Request $request)
    {
        $strsql="";
        // if(!empty($request->DateFrom)){
        //     $strreason = "";
        //     $intreason = 0;
        //     if(!empty($request->chkReason)){
        //         $intreason = count($request->chkReason);
        //         $strreason = " AND (";
        //         foreach($request->chkReason as $reason){
        //             $strreason = $strreason." r.id = ".$reason;
        //             $intreason--;
        //             if($intreason>0){
        //                 $strreason = $strreason." OR ";
        //             }
        //         }
        //         $strreason = $strreason." )";
        //     }
        //         $strsql="SELECT la.*,r.description Reason,p.MainContactPerson,s.name StaffName FROM lead_assessments la
        //             LEFT JOIN reasons r ON r.id = la.reasonid
        //             LEFT JOIN patients p on p.id = la.patientid
        //             LEFT JOIN staff s on s.id = la.staffid
        //             where la.iscurrent=1
        //             and la.date BETWEEN '$request->DateFrom' AND '$request->DateTo'
        //             AND la.assessmentrate BETWEEN $request->RateFrom and $request->RateTo
        //              $strreason ORDER BY la.date desc";              
        // }
        // else{
            // $strsql = "SELECT la.*,r.description as Reason,p.MainContactPerson,s.name StaffName FROM lead_assessments la
            //             LEFT JOIN reasons r on r.id = la.reasonid
            //             LEFT JOIN patients p ON p.id = la.patientid
            //             LEFT JOIN staff s on s.id = la.staffid
            //             where la.iscurrent = 1 AND la.date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY)
            //             AND NOW() ORDER BY la.date desc";
            $strsql = "SELECT la.*,r.description as Reason,p.MainContactPerson,s.name StaffName FROM lead_assessments la
                        LEFT JOIN reasons r on r.id = la.reasonid
                        LEFT JOIN patients p ON p.id = la.patientid
                        LEFT JOIN staff s on s.id = la.staffid
                        where la.iscurrent = 1 ORDER BY la.date asc";
        // }
        

        $results = DB::select($strsql);
        // var_dump($strsql);
        $strsql = "select * from users";
        $systemusers = DB::select($strsql);
        $reasons = Reason::all();
        return view('ReportGen.leadreport',compact('reasons','results'));
    }

    public function ConsultationReport(Request $request)
    {
        $strsql="";
        if(!empty($request->DateFrom)){
            
                $strsql="SELECT c.*, p.MainContactPerson from consultations c 
                    INNER JOIN patients p on p.id = c.patientid
                    WHERE c.docdate BETWEEN '$request->DateFrom'
                        AND '$request->DateTo' ORDER BY c.docdate desc";         
        }
        else{
            $strsql = "SELECT c.*, p.MainContactPerson from consultations c 
                        INNER JOIN patients p on p.id = c.patientid
                        WHERE c.docdate BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY)
                        AND NOW() ORDER BY c.docdate desc";
        }
        

        $results = DB::select($strsql);
        // var_dump($strsql);
        $strsql = "select * from users";
        $systemusers = DB::select($strsql);
        $reasons = Reason::all();
        return view('ReportGen.consultationreport',compact('reasons','systemusers','results'));
    }

    public function MedicineReport(Request $request)
    {
        $strsql="";
        if(!empty($request->DateFrom)){
            
                $strsql="SELECT m.description,sum(pls.qty)as TotalQty FROM medicines m                            
                            INNER JOIN price_list_subs pls on pls.medicineid = m.id
                            INNER JOIN price_lists pl on pl.id = pls.pricelistid
                            WHERE m.prod_type = 0
                            AND pl.pricelistdate BETWEEN '$request->DateFrom'
                            AND '$request->DateTo' 
                            GROUP BY m.id,m.description
                            ORDER BY pl.pricelistdate desc";         
        }
        else{
            $strsql = "SELECT m.description,sum(pls.qty)as TotalQty FROM medicines m                            
                            INNER JOIN price_list_subs pls on pls.medicineid = m.id
                            INNER JOIN price_lists pl on pl.id = pls.pricelistid
                            WHERE m.prod_type = 0
                            AND pl.pricelistdate BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY)
                            AND NOW() 
                            GROUP BY m.id,m.description
                            ORDER BY pl.pricelistdate desc";
        }
        

        $results = DB::select($strsql);
        // var_dump($strsql);
        $strsql = "select * from users";
        $systemusers = DB::select($strsql);
        $reasons = Reason::all();
        return view('ReportGen.medicinereport',compact('reasons','systemusers','results'));
    }

    public function TreatmentReport(Request $request)
    {
        $strsql="";
        if(!empty($request->DateFrom)){
            
                $strsql="SELECT m.description,sum(pls.qty)as TotalQty FROM medicines m                            
                            INNER JOIN price_list_subs pls on pls.medicineid = m.id
                            INNER JOIN price_lists pl on pl.id = pls.pricelistid
                            WHERE m.prod_type = 1
                            AND pl.pricelistdate BETWEEN '$request->DateFrom'
                            AND '$request->DateTo' 
                            GROUP BY m.id,m.description
                            ORDER BY pl.pricelistdate desc";         
        }
        else{
            $strsql = "SELECT m.description,sum(pls.qty)as TotalQty FROM medicines m                            
                            INNER JOIN price_list_subs pls on pls.medicineid = m.id
                            INNER JOIN price_lists pl on pl.id = pls.pricelistid
                            WHERE m.prod_type = 1
                            AND pl.pricelistdate BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY)
                            AND NOW() 
                            GROUP BY m.id,m.description
                            ORDER BY pl.pricelistdate desc";
        }
        

        $results = DB::select($strsql);
        // var_dump($strsql);
        $strsql = "select * from users";
        $systemusers = DB::select($strsql);
        $reasons = Reason::all();
        return view('ReportGen.treatmentreport',compact('reasons','systemusers','results'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReportGen  $reportGen
     * @return \Illuminate\Http\Response
     */
    public function show(ReportGen $reportGen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReportGen  $reportGen
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportGen $reportGen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReportGen  $reportGen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportGen $reportGen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReportGen  $reportGen
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportGen $reportGen)
    {
        //
    }
}
