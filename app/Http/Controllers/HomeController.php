<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LeadReminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $strsql = "select count(id) as TotalLead from patients";
        $TotalLeads = DB::select($strsql);

        $strsql = "select count(id) as TotalPatient from patients where IsPatient = 1";
        $TotalPatients = DB::select($strsql);

        $PatientBookings = DB::table('patientbooked')
                ->select('patientbooked.id','patientbooked.docdate','patientbooked.bookedtime','patientbooked.notes','patients.MainContactPerson','bookedstatus.description','staff.name')
                ->join('patients', 'patientbooked.patientid', '=', 'patients.id')
                ->join('staff', 'patientbooked.staffid', '=', 'staff.id')
                ->join('bookedstatus', 'patientbooked.bookstatusid', '=', 'bookedstatus.id')
                ->orderBy('patientbooked.docdate','patientbooked.id', 'desc')
                ->paginate();


        $leadreminders = DB::table('lead_reminders')
                ->select('lead_reminders.id','lead_reminders.is_read','lead_reminders.date_reminder','lead_reminders.time_reminder','lead_reminders.notes','patients.MainContactPerson','reasons.description','staff.name')
                ->join('patients', 'lead_reminders.patientid', '=', 'patients.id')
                ->join('staff', 'lead_reminders.staffid', '=', 'staff.id')
                ->join('reasons', 'lead_reminders.reasonid', '=', 'reasons.id')
                ->orderBy('date_reminder', 'desc')
                ->paginate();

        $strsql = "SELECT count(patients.LeadSourceId) as TotalLeadSource, lead_sources.description FROM lead_sources
                    LEFT JOIN patients on patients.LeadSourceId = lead_sources.id
                    group by patients.LeadSourceId,lead_sources.description";
        $LeadSourcesTotals =DB::select($strsql);

        // $strsql ="select date_format(DateInPatient,'%M') as Months,count(DateInPatient) as TotalPatients from leadtopatientlist where IsLeadInPatient = 0 group by year(DateInPatient),month(DateInPatient) order by year(DateInPatient),month(DateInPatient)";
        // $LeadMonthlyTotals =DB::select($strsql);

        // $strsql ="select date_format(DateInPatient,'%M') as Months,count(DateInPatient) as TotalPatients from leadtopatientlist where IsLeadInPatient = 1 group by year(DateInPatient),month(DateInPatient) order by year(DateInPatient),month(DateInPatient)";
        // $InPatientMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =1 and DateInPatient between '".date("Y")."-01-01' and '".date("Y")."-01-31'  group by DateInPatient";

        $InPatientJanMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =1 and DateInPatient between '".date("Y")."-02-01' and '".date("Y")."-02-28'  group by DateInPatient";

        $InPatientFebMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =1 and DateInPatient between '".date("Y")."-03-01' and '".date("Y")."-03-31'  group by DateInPatient";

        $InPatientMarMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =1 and DateInPatient between '".date("Y")."-04-01' and '".date("Y")."-04-30'  group by DateInPatient";

        $InPatientAprMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =1 and DateInPatient between '".date("Y")."-05-01' and '".date("Y")."-05-31'  group by DateInPatient";

        $InPatientMayMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =1 and DateInPatient between '".date("Y")."-06-01' and '".date("Y")."-06-30'  group by DateInPatient";

        $InPatientJunMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =1 and DateInPatient between '".date("Y")."-07-01' and '".date("Y")."-07-31'  group by DateInPatient";

        $InPatientJulMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =1 and DateInPatient between '".date("Y")."-08-01' and '".date("Y")."-08-31'  group by DateInPatient";

        $InPatientAugMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =1 and DateInPatient between '".date("Y")."-09-01' and '".date("Y")."-09-30'  group by DateInPatient";

        $InPatientSepMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =1 and DateInPatient between '".date("Y")."-10-01' and '".date("Y")."-10-31'  group by DateInPatient";

        $InPatientOctMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =1 and DateInPatient between '".date("Y")."-11-01' and '".date("Y")."-11-30'  group by DateInPatient";

        $InPatientNovMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =1 and DateInPatient between '".date("Y")."-12-01' and '".date("Y")."-12-31'  group by DateInPatient";

        $InPatientDecMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =0 and DateInPatient between '".date("Y")."-01-01' and '".date("Y")."-01-31'  group by DateInPatient";

        $LeadJanMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =0 and DateInPatient between '".date("Y")."-02-01' and '".date("Y")."-002-28'  group by DateInPatient";

        $LeadFebMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =0 and DateInPatient between '".date("Y")."-03-01' and '".date("Y")."-03-31'  group by DateInPatient";

        $LeadMarMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =0 and DateInPatient between '".date("Y")."-04-01' and '".date("Y")."-04-30'  group by DateInPatient";

        $LeadAprMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =0 and DateInPatient between '".date("Y")."-05-01' and '".date("Y")."-05-31'  group by DateInPatient";

        $LeadMayMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =0 and DateInPatient between '".date("Y")."-06-01' and '".date("Y")."-06-30'  group by DateInPatient";

        $LeadJunMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =0 and DateInPatient between '".date("Y")."-07-01' and '".date("Y")."-07-31'  group by DateInPatient";

        $LeadJulMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =0 and DateInPatient between '".date("Y")."-08-01' and '".date("Y")."-08-31'  group by DateInPatient";

        $LeadAugMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =0 and DateInPatient between '".date("Y")."-09-01' and '".date("Y")."-09-30'  group by DateInPatient";

        $LeadSepMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =0 and DateInPatient between '".date("Y")."-10-01' and '".date("Y")."-10-31'  group by DateInPatient";

        $LeadOctMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =0 and DateInPatient between '".date("Y")."-11-01' and '".date("Y")."-11-30'  group by DateInPatient";

        $LeadNovMonthlyTotals =DB::select($strsql);

        $strsql="select count(DateInPatient) as TotalJanLeads from leadtopatientlist where IsLeadInPatient =0 and DateInPatient between '".date("Y")."-12-01' and '".date("Y")."-12-31'  group by DateInPatient";

        $LeadDecMonthlyTotals =DB::select($strsql);

        return view('home',compact('TotalLeads','TotalPatients','PatientBookings','leadreminders','LeadSourcesTotals','InPatientJanMonthlyTotals','InPatientFebMonthlyTotals','InPatientMarMonthlyTotals','InPatientAprMonthlyTotals','InPatientMayMonthlyTotals','InPatientJunMonthlyTotals','InPatientJulMonthlyTotals','InPatientAugMonthlyTotals','InPatientSepMonthlyTotals','InPatientOctMonthlyTotals','InPatientNovMonthlyTotals','InPatientDecMonthlyTotals','LeadJanMonthlyTotals','LeadFebMonthlyTotals','LeadMarMonthlyTotals','LeadAprMonthlyTotals','LeadMayMonthlyTotals','LeadJunMonthlyTotals','LeadJulMonthlyTotals','LeadAugMonthlyTotals','LeadSepMonthlyTotals','LeadOctMonthlyTotals','LeadNovMonthlyTotals','LeadDecMonthlyTotals'));
    }
    
}
