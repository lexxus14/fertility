<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*Reason*/
Route::get('/reason','ReasonController@index')->name('ReasonIndex');
Route::get('/reason/new','ReasonController@create')->name('ReasonCreate');
Route::post('/reason','ReasonController@store')->name('ReasonStore');
Route::post('/reason/delete','ReasonController@destroy')->name('ReasonDelete');
Route::get('/reason/edit/{id?}','ReasonController@edit')->name('ReasonEdit');
Route::post('/reason/update','ReasonController@update')->name('ReasonUpdate');

/*Nationality*/
Route::get('/nationality','NationalityController@index')->name('NationalityIndex');
Route::get('/nationality/new','NationalityController@create')->name('NationalityCreate');
Route::post('/nationality','NationalityController@store')->name('NationalityStore');
Route::post('/nationality/delete','NationalityController@destroy')->name('NationalityDelete');
Route::get('/nationality/edit/{id?}','NationalityController@edit')->name('NationalityEdit');
Route::post('/nationality/update','NationalityController@update')->name('NationalityUpdate');

/*VitalSign*/
Route::get('/vitalsign','VitalSignController@index')->name('VitalSignIndex');
Route::get('/vitalsign/new','VitalSignController@create')->name('VitalSignCreate');
Route::post('/vitalsign','VitalSignController@store')->name('VitalSignStore');
Route::post('/vitalsign/delete','VitalSignController@destroy')->name('VitalSignDelete');
Route::get('/vitalsign/edit/{id?}','VitalSignController@edit')->name('VitalSignEdit');
Route::post('/vitalsign/update','VitalSignController@update')->name('VitalSignUpdate');

Route::get('/vitalsign/getvitalsigninfo/{id?}','VitalSignController@GetVitalSignInfo')->name('GetVitalSignInfo');

/*DoctorDiagnosis*/
Route::get('/doctordiagnosis','DoctorDiagnosisController@index')->name('DoctorDiagnosisIndex');
Route::get('/doctordiagnosis/new','DoctorDiagnosisController@create')->name('DoctorDiagnosisCreate');
Route::post('/doctordiagnosis','DoctorDiagnosisController@store')->name('DoctorDiagnosisStore');
Route::post('/doctordiagnosis/delete','DoctorDiagnosisController@destroy')->name('DoctorDiagnosisDelete');
Route::get('/doctordiagnosis/edit/{id?}','DoctorDiagnosisController@edit')->name('DoctorDiagnosisEdit');
Route::post('/doctordiagnosis/update','DoctorDiagnosisController@update')->name('DoctorDiagnosisUpdate');
Route::get('/doctordiagnosis/getdoctordiagnosinfo/{id?}','DoctorDiagnosisController@DoctorDiagnosInfo')->name('DoctorDiagnosInfo');

/*DoctorsPlan*/
Route::get('/doctorsplan','DoctorsPlansController@index')->name('DoctorsPlansIndex');
Route::get('/doctorsplan/new','DoctorsPlansController@create')->name('DoctorsPlansCreate');
Route::post('/doctorsplan','DoctorsPlansController@store')->name('DoctorsPlansStore');
Route::post('/doctorsplan/delete','DoctorsPlansController@destroy')->name('DoctorsPlansDelete');
Route::get('/doctorsplan/edit/{id?}','DoctorsPlansController@edit')->name('DoctorsPlansEdit');
Route::post('/doctorsplan/update','DoctorsPlansController@update')->name('DoctorsPlansUpdate');
Route::get('/doctorsplan/getdoctorsplaninfo/{id?}','DoctorsPlansController@DoctorsPlanInfo')->name('DoctorsPlanInfo');

/*SystemUser*/
Route::get('/sysuser','SystemUserController@index')->name('SystemUserIndex');
Route::get('/sysuser/new','SystemUserController@create')->name('SystemUserCreate');
Route::post('/sysuser','SystemUserController@store')->name('SystemUserStore');
Route::post('/sysuser/delete','SystemUserController@destroy')->name('SystemUserDelete');
Route::get('/sysuser/edit/{id?}','SystemUserController@edit')->name('SystemUserEdit');

Route::get('/sysuser/profile/{id?}','SystemUserController@UserProfileEdit')->name('SystemUserProfileEdit');
Route::post('/sysuser/updateprofile','SystemUserController@UpdateProfile')->name('SystemUserProfileUpdate');

Route::post('/sysuser/update','SystemUserController@update')->name('SystemUserUpdate');
Route::get('/sysuser/getuseremail/{email?}','SystemUserController@GetUserEmail')->name('GetUserEmail');

/*LeadSource*/
Route::get('/leadsource','LeadSourceController@index')->name('LeadSourceIndex');
Route::get('/leadsource/new','LeadSourceController@create')->name('LeadSourceCreate');
Route::post('/leadsource','LeadSourceController@store')->name('LeadSourceStore');
Route::post('/leadsource/delete','LeadSourceController@destroy')->name('LeadSourceDelete');
Route::get('/leadsource/edit/{id?}','LeadSourceController@edit')->name('LeadSourceEdit');
Route::post('/leadsource/update','LeadSourceController@update')->name('LeadSourceUpdate');

/*Treatment*/
Route::get('/treatement','TreatmentController@index')->name('TreatmentIndex');
Route::get('/treatement/new','TreatmentController@create')->name('TreatmentCreate');
Route::post('/treatement','TreatmentController@store')->name('TreatmentStore');
Route::post('/treatement/delete','TreatmentController@destroy')->name('TreatmentDelete');
Route::get('/treatement/edit/{id?}','TreatmentController@edit')->name('TreatmentEdit');
Route::post('/treatement/update','TreatmentController@update')->name('TreatmentUpdate');

/*Medicine*/
Route::get('/medicine','MedicineController@index')->name('MedicineIndex');
Route::get('/medicine/new','MedicineController@create')->name('MedicineCreate');
Route::post('/medicine','MedicineController@store')->name('MedicineStore');
Route::post('/medicine/delete','MedicineController@destroy')->name('MedicineDelete');
Route::get('/medicine/edit/{id?}','MedicineController@edit')->name('MedicineEdit');
Route::post('/medicine/update','MedicineController@update')->name('MedicineUpdate');

/*Lab Test*/
Route::get('/labtest','LabTestController@index')->name('LabTestIndex');
Route::get('/labtest/new','LabTestController@create')->name('LabTestCreate');
Route::post('/labtest','LabTestController@store')->name('LabTestStore');
Route::post('/labtest/delete','LabTestController@destroy')->name('LabTestDelete');
Route::get('/labtest/edit/{id?}','LabTestController@edit')->name('LabTestEdit');
Route::post('/labtest/update','LabTestController@update')->name('LabTestUpdate');

Route::get('/labtest/getlabinfo/{id?}','LabTestController@GetLabTestInfo')->name('GetLabTestInfo');


/*Procedure*/
Route::get('/procedure','ProcedureController@index')->name('ProcedureIndex');
Route::get('/procedure/new','ProcedureController@create')->name('ProcedureCreate');
Route::post('/procedure','ProcedureController@store')->name('ProcedureStore');
Route::post('/procedure/delete','ProcedureController@destroy')->name('ProcedureDelete');
Route::get('/procedure/edit/{id?}','ProcedureController@edit')->name('ProcedureEdit');
Route::post('/procedure/update','ProcedureController@update')->name('ProcedureUpdate');

/*Staff*/
Route::get('/staff','StaffController@index')->name('StaffIndex');
Route::get('/staff/new','StaffController@create')->name('StaffCreate');
Route::post('/staff','StaffController@store')->name('StaffStore');
Route::post('/staff/delete','StaffController@destroy')->name('StaffDelete');
Route::get('/staff/edit/{id?}','StaffController@edit')->name('StaffEdit');
Route::post('/staff/update','StaffController@update')->name('StaffUpdate');
Route::get('/staff/getstaffinfo/{id?}','StaffController@GetStaffInfo')->name('GetStaffInfo');

/*Patient*/
Route::get('/patient','PatientController@index')->name('PatientIndex');
Route::get('/patient/new','PatientController@create')->name('PatientCreate');
Route::post('/patient/add','PatientController@store')->name('PatientStore');
Route::get('/patient/view/{PatientID?}','PatientController@show')->name('PatientShow');

Route::post('/patientsearch','PatientController@LeadSearch')->name('PatientSearch');
Route::get('/patientsearch/{search?}','PatientController@LeadInfoSearch')->name('PatientInfoSearch');

/*Lead*/
Route::get('/lead','LeadController@index')->name('LeadIndex');
Route::get('/lead/new','LeadController@create')->name('LeadCreate');
Route::post('/lead','LeadController@store')->name('LeadStore');
Route::post('/lead/delete/{id?}','LeadController@destroy')->name('LeadDelete');
Route::get('/lead/edit/{id?}','LeadController@edit')->name('LeadEdit');
Route::get('/lead/view/{id?}','LeadController@show')->name('LeadView');
Route::post('/lead/update','LeadController@update')->name('LeadUpdate');

Route::get('/lead/print/{id?}','LeadController@LeadPrint')->name('LeadPrint');

Route::get('/lead/import','LeadController@ImportLead')->name('ImportLead');
// Route::post('/lead/import','LeadController@ImportLeadSave')->name('ImportLeadSave');
Route::post('/lead/import','LeadController@ImportTempTable')->name('ImportLeadSave');

Route::post('/leadsearch','LeadController@LeadSearch')->name('LeadSearch');
Route::get('/leadsearch/{search?}','LeadController@LeadInfoSearch')->name('LeadInfoSearch');

/*Document*/
Route::get('/document','DocumentController@index')->name('DocumentIndex');
Route::get('/document/{PatientID?}','DocumentController@PatientDocument')->name('PatientDocument');
Route::get('/document/add/{PatientID?}','DocumentController@create')->name('DocumentCreate');
Route::post('/document/add','DocumentController@store')->name('DocumentStore');

Route::get('/document/edit/{id?}','DocumentController@edit')->name('DocumentEdit');
Route::post('/document/update','DocumentController@update')->name('DocumentUpdate');
Route::get('/document/view/{PatientID?}','DocumentController@show')->name('DocumentShow');
Route::post('/document/delete','DocumentController@destroy')->name('DocumentDelete');

/*Lab Investigation*/
Route::get('/lavinv','LabInvestigationController@index')->name('LabInvestigationIndex');
Route::get('/labinv/{PatientID?}','LabInvestigationController@PatientLab')->name('PatientLab');
Route::get('/labinv/add/{PatientID?}','LabInvestigationController@create')->name('LabCreate');
Route::post('/labinv/add','LabInvestigationController@store')->name('LabStore');

Route::get('/lavinv/edit/{id?}','LabInvestigationController@edit')->name('LabInvestigationEdit');
Route::get('/labinv/view/{PatientID?}','LabInvestigationController@show')->name('LabInvestigationShow');
Route::post('/labinv/delete','LabInvestigationController@destroy')->name('LabInvestigationDelete');
Route::post('/lavinb/update','LabInvestigationController@update')->name('LabInvestigationUpdate');

/*Patient Vital Sign*/
    Route::get('/patientvitalsign','PatientVitalSignController@index')->name('PatientVitalSignIndex');
    Route::get('/patientvitalsign/{PatientID?}','PatientVitalSignController@PatientVitalSign')->name('PatientPatientVitalSign');
    Route::get('/patientvitalsign/add/{PatientID?}','PatientVitalSignController@create')->name('PatientVitalSignCreate');
    Route::post('/patientvitalsign/add','PatientVitalSignController@store')->name('PatientVitalSignStore');

    Route::get('/patientvitalsign/edit/{id?}','PatientVitalSignController@edit')->name('PatientVitalSignEdit');
    Route::get('/patientvitalsign/view/{PatientID?}','PatientVitalSignController@show')->name('PatientVitalSignShow');
    Route::post('/patientvitalsign/delete','PatientVitalSignController@destroy')->name('PatientVitalSignDelete');
    Route::post('/patientvitalsign/update','PatientVitalSignController@update')->name('PatientVitalSignUpdate');
    Route::get('/patientvitalsign/print/{PatientID?}','PatientVitalSignController@PrintVitalSign')->name('PatientVitalSignPrint');
/*Patient Vital Sign*/

/*Patient Diagnostic Hysteroscopy*/
    // Route::get('/diaghyste','DiagnosticHysteController@index')->name('DiagHysteroscopyIndex');
    Route::get('/diaghyste/{PatientID?}','DiagnosticHysteController@DiagHysteroscopy')->name('DiagHysteroscopy');
    Route::get('/diaghyste/add/{PatientID?}','DiagnosticHysteController@create')->name('DiagHysteroscopyCreate');
    Route::post('/diaghyste/add','DiagnosticHysteController@store')->name('DiagHysteroscopyStore');

    Route::get('/diaghyste/edit/{id?}','DiagnosticHysteController@edit')->name('DiagHysteroscopyEdit');
    Route::get('/diaghyste/view/{PatientID?}','DiagnosticHysteController@show')->name('DiagHysteroscopyShow');
    Route::get('/diaghyste/print/{PatientID?}','DiagnosticHysteController@PrintDiagHysteroscopy')->name('PrintDiagHysteroscopy');
    Route::post('/diaghyste/delete','DiagnosticHysteController@destroy')->name('DiagHysteroscopyDelete');
    Route::post('/diaghyste/update','DiagnosticHysteController@update')->name('DiagHysteroscopyUpdate');
/*Patient Diagnostic Hysteroscopy*/

/*Patient PostOpPostNotes*/
    // Route::get('/diaghyste','PostOpPostProcNotesController@index')->name('PostOpPostProcNotesIndex');
    Route::get('/poppnotes/{PatientID?}','PostOpPostProcNotesController@PostOpPostProcNotes')->name('PostOpPostProcNotes');
    Route::get('/poppnotes/add/{PatientID?}','PostOpPostProcNotesController@create')->name('PostOpPostProcNotesCreate');
    Route::post('/poppnotes/add','PostOpPostProcNotesController@store')->name('PostOpPostProcNotesStore');

    Route::get('/poppnotes/edit/{id?}','PostOpPostProcNotesController@edit')->name('PostOpPostProcNotesEdit');
    Route::get('/poppnotes/view/{PatientID?}','PostOpPostProcNotesController@show')->name('PostOpPostProcNotesShow');
    Route::get('/poppnotes/print/{PatientID?}','PostOpPostProcNotesController@PrintPostOpPostProcNotes')->name('PrintPostOpPostProcNotes');
    Route::post('/poppnotes/delete','PostOpPostProcNotesController@destroy')->name('PostOpPostProcNotesDelete');
    Route::post('/poppnotes/update','PostOpPostProcNotesController@update')->name('PostOpPostProcNotesUpdate');
/*Patient PostOpPostNotes*/

/*Pre Operative Checklist*/
    // Route::get('/diaghyste','PostOpPostProcNotesController@index')->name('PostOpPostProcNotesIndex');
    Route::get('/popcklst/{PatientID?}','PreOperaCheckListController@PreOperaCheckList')->name('PreOperaCheckList');
    Route::get('/popcklst/add/{PatientID?}','PreOperaCheckListController@create')->name('PreOperaCheckListCreate');
    Route::post('/popcklst/add','PreOperaCheckListController@store')->name('PreOperaCheckListStore');

    Route::get('/popcklst/edit/{id?}','PreOperaCheckListController@edit')->name('PreOperaCheckListEdit');
    Route::get('/popcklst/view/{PatientID?}','PreOperaCheckListController@show')->name('PreOperaCheckListShow');
    Route::get('/popcklst/print/{PatientID?}','PreOperaCheckListController@PrintPreOperaCheckList')->name('PrintPreOperaCheckList');
    Route::post('/popcklst/delete','PreOperaCheckListController@destroy')->name('PreOperaCheckListDelete');
    Route::post('/popcklst/update','PreOperaCheckListController@update')->name('PreOperaCheckListUpdate');
/*Pre Operative Checklist*/

/*Pre Operative Report*/
    // Route::get('/diaghyste','PostOpPostProcNotesController@index')->name('PostOpPostProcNotesIndex');
    Route::get('/opreport/{PatientID?}','OperativeReportController@PreOperaCheckList')->name('OperativeReport');
    Route::get('/opreport/add/{PatientID?}','OperativeReportController@create')->name('OperativeReportCreate');
    Route::post('/opreport/add','OperativeReportController@store')->name('OperativeReportStore');

    Route::get('/opreport/edit/{id?}','OperativeReportController@edit')->name('OperativeReportEdit');
    Route::get('/opreport/view/{PatientID?}','OperativeReportController@show')->name('OperativeReportShow');
    Route::get('/opreport/print/{PatientID?}','OperativeReportController@PrintOperativeReport')->name('PrintOperativeReport');
    Route::post('/opreport/delete','OperativeReportController@destroy')->name('OperativeReportDelete');
    Route::post('/opreport/update','OperativeReportController@update')->name('OperativeReportUpdate');
/*Pre Operative Report*/

/*Mock Embryo Transfer Measurements*/
    // Route::get('/mockembtramea','MocEmbTraMeasController@index')->name('OVFReqFormIndex');
    Route::get('/mockembtramea/{PatientID?}','MocEmbTraMeasController@MocEmbTraMeas')->name('MocEmbTraMeas');
    Route::get('/mockembtramea/add/{PatientID?}','MocEmbTraMeasController@create')->name('MocEmbTraMeasCreate');
    Route::post('/mockembtramea/add','MocEmbTraMeasController@store')->name('MocEmbTraMeasStore');

    Route::get('/mockembtramea/edit/{id?}','MocEmbTraMeasController@edit')->name('MocEmbTraMeasEdit');
    Route::get('/mockembtramea/view/{PatientID?}','MocEmbTraMeasController@show')->name('MocEmbTraMeasShow');
    Route::get('/mockembtramea/print/{PatientID?}','MocEmbTraMeasController@PrintMocEmbTraMeas')->name('MocEmbTraMeasPrint');
    Route::post('/mockembtramea/delete','MocEmbTraMeasController@destroy')->name('MocEmbTraMeasDelete');
    Route::post('/mockembtramea/update','MocEmbTraMeasController@update')->name('MocEmbTraMeasUpdate');
/*Mock Embryo Transfer Measurements*/

/*Intra Operative Anesthesia Records*/
    // Route::get('/intraoperaanesrec','IntraOperaAnesRecsController@index')->name('OVFReqFormIndex');
    Route::get('/intraoperaanesrec/{PatientID?}','IntraOperaAnesRecsController@IntraOperAnesRecs')->name('IntraOperAnesRecs');
    Route::get('/intraoperaanesrec/add/{PatientID?}','IntraOperaAnesRecsController@create')->name('IntraOperAnesRecsCreate');
    Route::post('/intraoperaanesrec/add','IntraOperaAnesRecsController@store')->name('IntraOperAnesRecsStore');

    Route::get('/intraoperaanesrec/edit/{id?}','IntraOperaAnesRecsController@edit')->name('IntraOperAnesRecsEdit');
    Route::get('/intraoperaanesrec/view/{PatientID?}','IntraOperaAnesRecsController@show')->name('IntraOperAnesRecsShow');
    Route::get('/intraoperaanesrec/print/{PatientID?}','IntraOperaAnesRecsController@PrintIntraOperAnesRecs')->name('PrintIntraOperAnesRecs');
    Route::post('/intraoperaanesrec/delete','IntraOperaAnesRecsController@destroy')->name('IntraOperAnesRecsDelete');
    Route::post('/intraoperaanesrec/update','IntraOperaAnesRecsController@update')->name('IntraOperAnesRecsUpdate');
/*Intra Operative Anesthesia Records*/

/*IVF Embryo Transfer Data Sheet*/
    // Route::get('/ivfembratransdatasheet','IVFEmbryoTransDataSheetController@index')->name('IVFEmbryoTransDataSheetIndex');
    Route::get('/ivfembratransdatasheet/{PatientID?}','IVFEmbryoTransDataSheetController@IVFEmbryoTransDataSheet')->name('IVFEmbryoTransDataSheet');
    Route::get('/ivfembratransdatasheet/add/{PatientID?}','IVFEmbryoTransDataSheetController@create')->name('IVFEmbryoTransDataSheetCreate');
    Route::post('/ivfembratransdatasheet/add','IVFEmbryoTransDataSheetController@store')->name('IVFEmbryoTransDataSheetStore');

    Route::get('/ivfembratransdatasheet/edit/{id?}','IVFEmbryoTransDataSheetController@edit')->name('IVFEmbryoTransDataSheetEdit');
    Route::get('/ivfembratransdatasheet/view/{PatientID?}','IVFEmbryoTransDataSheetController@show')->name('IVFEmbryoTransDataSheetShow');
    Route::get('/ivfembratransdatasheet/print/{PatientID?}','IVFEmbryoTransDataSheetController@PrintIVFEmbryoTransDataSheet')->name('PrintIVFEmbryoTransDataSheet');
    Route::post('/ivfembratransdatasheet/delete','IVFEmbryoTransDataSheetController@destroy')->name('IVFEmbryoTransDataSheetDelete');
    Route::post('/ivfembratransdatasheet/update','IVFEmbryoTransDataSheetController@update')->name('IVFEmbryoTransDataSheetUpdate');
/*IVF Embryo Transfer Data Sheet*/

/*Sperm Freezing*/
    // Route::get('/spermfreezing','SpermFreezingController@index')->name('IVFEmbryoTransDataSheetIndex');
    Route::get('/spermfreezing/{PatientID?}','SpermFreezingController@SpermFreezing')->name('SpermFreezing');
    Route::get('/spermfreezing/add/{PatientID?}','SpermFreezingController@create')->name('SpermFreezingCreate');
    Route::post('/spermfreezing/add','SpermFreezingController@store')->name('SpermFreezingStore');

    Route::get('/spermfreezing/edit/{id?}','SpermFreezingController@edit')->name('SpermFreezingEdit');
    Route::get('/spermfreezing/view/{PatientID?}','SpermFreezingController@show')->name('SpermFreezingShow');
    Route::get('/spermfreezing/print/{PatientID?}','SpermFreezingController@PrintSpermFreezing')->name('PrintSpermFreezing');
    Route::post('/spermfreezing/delete','SpermFreezingController@destroy')->name('SpermFreezingDelete');
    Route::post('/spermfreezing/update','SpermFreezingController@update')->name('SpermFreezingUpdate');
/*Sperm Freezing*/

/*Sperm Thawing*/
    // Route::get('/spermthawing','SpermThawingController@index')->name('SpermThawingIndex');
    Route::get('/spermthawing/{PatientID?}','SpermThawingController@SpermThawing')->name('SpermThawing');
    Route::get('/spermthawing/add/{PatientID?}','SpermThawingController@create')->name('SpermThawingCreate');
    Route::post('/spermthawing/add','SpermThawingController@store')->name('SpermThawingStore');

    Route::get('/spermthawing/edit/{id?}','SpermThawingController@edit')->name('SpermThawingEdit');
    Route::get('/spermthawing/view/{PatientID?}','SpermThawingController@show')->name('SpermThawingShow');
    Route::get('/spermthawing/print/{PatientID?}','SpermThawingController@PrintSpermThawing')->name('PrintSpermThawing');
    Route::post('/spermthawing/delete','SpermThawingController@destroy')->name('SpermThawingDelete');
    Route::post('/spermthawing/update','SpermThawingController@update')->name('SpermThawingUpdate');
/*Sperm Thawing*/


/*Semen Analysis*/
    // Route::get('/semenanalysis','SemenAnalysisController@index')->name('SemenAnalysisIndex');
    Route::get('/semenanalysis/{PatientID?}','SemenAnalysisController@SemenAnalysis')->name('SemenAnalysis');
    Route::get('/semenanalysis/add/{PatientID?}','SemenAnalysisController@create')->name('SemenAnalysisCreate');
    Route::post('/semenanalysis/add','SemenAnalysisController@store')->name('SemenAnalysisStore');

    Route::get('/semenanalysis/edit/{id?}','SemenAnalysisController@edit')->name('SemenAnalysisEdit');
    Route::get('/semenanalysis/view/{PatientID?}','SemenAnalysisController@show')->name('SemenAnalysisShow');
    Route::get('/semenanalysis/print/{PatientID?}','SemenAnalysisController@PrintSemenAnalysis')->name('PrintSemenAnalysis');
    Route::post('/semenanalysis/delete','SemenAnalysisController@destroy')->name('SemenAnalysisDelete');
    Route::post('/semenanalysis/update','SemenAnalysisController@update')->name('SemenAnalysisUpdate');
/*Semen Analysis*/

/*OOcyte Retrieval Report*/
    // Route::get('/oocyteretreport','OOcyteRetrievalReportController@index')->name('OOcyteRetReportIndex');
    Route::get('/oocyteretreport/{PatientID?}','OOcyteRetrievalReportController@OOcyteRetReport')->name('OOcyteRetReport');
    Route::get('/oocyteretreport/add/{PatientID?}','OOcyteRetrievalReportController@create')->name('OOcyteRetReportCreate');
    Route::post('/oocyteretreport/add','OOcyteRetrievalReportController@store')->name('OOcyteRetReportStore');

    Route::get('/oocyteretreport/edit/{id?}','OOcyteRetrievalReportController@edit')->name('OOcyteRetReportEdit');
    Route::get('/oocyteretreport/view/{PatientID?}','OOcyteRetrievalReportController@show')->name('OOcyteRetReportShow');
    Route::get('/oocyteretreport/print/{PatientID?}','OOcyteRetrievalReportController@OOcyteRetReportPrint')->name('OOcyteRetReportPrint');
    Route::post('/oocyteretreport/delete','OOcyteRetrievalReportController@destroy')->name('OOcyteRetReportDelete');
    Route::post('/oocyteretreport/update','OOcyteRetrievalReportController@update')->name('OOcyteRetReportUpdate');
/*OOcyte Retrieval Report*/

/*OOcyte Freeze Thaw Tran Rec*/
    // Route::get('/oofrethatranrec','OOctyeFreezeThawTransRecController@index')->name('OOctyeFreezeThawTransIndex');
    Route::get('/oofrethatranrec/{PatientID?}','OOctyeFreezeThawTransRecController@OOctyeFreezeThawTrans')->name('OOctyeFreezeThawTrans');
    // Route::get('/oofrethatranrec/add/{PatientID?}','OOctyeFreezeThawTransRecController@create')->name('OOctyeFreezeThawTransCreate');
    Route::get('/oofrethatranrec/ofttr/{PatientID?}','OOctyeFreezeThawTransRecController@create')->name('OOctyeFreezeThawTransCreate');
    Route::get('/oofrethatranrec/ofttr/{PatientID?}/{id?}','OOctyeFreezeThawTransRecController@createExist')->name('ExistOOctyeFreezeThawTrans');
    

    Route::get('/oofrethatranrec/edit/{id?}','OOctyeFreezeThawTransRecController@edit')->name('OOctyeFreezeThawTransEdit');
    Route::get('/oofrethatranrec/view/{PatientID?}/{id?}','OOctyeFreezeThawTransRecController@show')->name('OOctyeFreezeThawTransShow');
    Route::get('/oofrethatranrec/print/{PatientID?}/{id?}','OOctyeFreezeThawTransRecController@OOctyeFreezeThawTransPrint')->name('OOctyeFreezeThawTransPrint');
    Route::post('/oofrethatranrec/delete','OOctyeFreezeThawTransRecController@destroy')->name('OOctyeFreezeThawTransDelete');
    Route::post('/oofrethatranrec/update','OOctyeFreezeThawTransRecController@update')->name('OOctyeFreezeThawTransUpdate');

    Route::get('/oofrethatranrec/newfreezthawdetails/{PatientID?}','OOctyeFreezeThawTransRecController@StoreOoFreThaTranRec')->name('NewFreezThawDetails');
    Route::get('/oofrethatranrec/savefreezthawdetails/{PatientID?}','OOctyeFreezeThawTransRecController@StoreOoFreThaTranRecSave')->name('NewFreezThawDetailsSave');

    Route::get('/oofrethatranrec/newfreezthaw/{PatientID?}/{id?}','OOctyeFreezeThawTransRecController@CreateFreezThaw')->name('CreateFreezThaw');
    Route::get('/oofrethatranrec/editfreezthaw/{PatientID?}/{id?}','OOctyeFreezeThawTransRecController@EditFreezThaw')->name('EditFreezThaw');
    Route::post('/oofrethatranrec/add','OOctyeFreezeThawTransRecController@store')->name('OOctyeFreezeThawTransStore');
    Route::post('/oofrethatranrec/updateDetails','OOctyeFreezeThawTransRecController@updateDetails')->name('OOctyeFreezeThawTransUpdateDetails');

    Route::post('/oofrethatranrec/deletedetails','OOctyeFreezeThawTransRecController@destroydetails')->name('OOctyeFreezeThawTransDeleteDetails');
/*OOcyte Freeze Thaw Tran Rec*/

/*IUI*/
    // Route::get('/iui','IUIController@index')->name('IUIIndex');
    Route::get('/iui/{PatientID?}','IUIController@IUI')->name('IUI');
    Route::get('/iui/add/{PatientID?}','IUIController@create')->name('IUICreate');
    Route::post('/iui/add','IUIController@store')->name('IUIStore');

    Route::get('/iui/edit/{id?}','IUIController@edit')->name('IUIEdit');
    Route::get('/iui/view/{PatientID?}','IUIController@show')->name('IUIShow');
    Route::get('/iui/print/{PatientID?}','IUIController@PrintIUI')->name('PrintIUI');
    Route::post('/iui/delete','IUIController@destroy')->name('IUIDelete');
    Route::post('/iui/update','IUIController@update')->name('IUIUpdate');
/*IUI*/

/*Embryology Record I*/
    // Route::get('/embryoreci','EmbryologyRecordController@index')->name('EmbryologyRecordIIndex');
    Route::get('/embryoreci/{PatientID?}','EmbryologyRecordController@EmbryologyRecordI')->name('EmbryologyRecordI');
    Route::get('/embryoreci/add/{PatientID?}','EmbryologyRecordController@create')->name('EmbryologyRecordICreate');
    Route::post('/embryoreci/add','EmbryologyRecordController@store')->name('EmbryologyRecordIStore');

    Route::get('/embryoreci/edit/{id?}','EmbryologyRecordController@edit')->name('EmbryologyRecordIEdit');
    Route::get('/embryoreci/view/{PatientID?}','EmbryologyRecordController@show')->name('EmbryologyRecordIShow');
    Route::get('/embryoreci/print/{PatientID?}','EmbryologyRecordController@PrintEmbryologyRecordI')->name('PrintEmbryologyRecordI');
    Route::post('/embryoreci/delete','EmbryologyRecordController@destroy')->name('EmbryologyRecordIDelete');
    Route::post('/embryoreci/update','EmbryologyRecordController@update')->name('EmbryologyRecordIUpdate');
/*Embryology Record I*/

/*Embryology Record II*/
    // Route::get('/embryorecii','EmbryoRecordIIController@index')->name('EmbryologyRecordIIIndex');
    Route::get('/embryorecii/{PatientID?}','EmbryoRecordIIController@EmbryologyRecordII')->name('EmbryologyRecordII');
    Route::get('/embryorecii/add/{PatientID?}','EmbryoRecordIIController@create')->name('EmbryologyRecordIICreate');
    Route::post('/embryorecii/add','EmbryoRecordIIController@store')->name('EmbryologyRecordIIStore');

    Route::get('/embryorecii/edit/{id?}','EmbryoRecordIIController@edit')->name('EmbryologyRecordIIEdit');
    Route::get('/embryorecii/view/{PatientID?}','EmbryoRecordIIController@show')->name('EmbryologyRecordIIShow');
    Route::get('/embryorecii/print/{PatientID?}','EmbryoRecordIIController@PrintEmbryologyRecordII')->name('PrintEmbryologyRecordII');
    Route::post('/embryorecii/delete','EmbryoRecordIIController@destroy')->name('EmbryologyRecordIIDelete');
    Route::post('/embryorecii/update','EmbryoRecordIIController@update')->name('EmbryologyRecordIIUpdate');
/*Embryology Record II*/

/*embryo transfer froozen emb*/
    // Route::get('/embtrafroemb','EmbTraFroEmbController@index')->name('EmbTraFroEmbIndex');
    Route::get('/embtrafroemb/{PatientID?}','EmbTraFroEmbController@EmbTraFroEmb')->name('EmbTraFroEmb');
    Route::get('/embtrafroemb/add/{PatientID?}','EmbTraFroEmbController@create')->name('EmbTraFroEmbCreate');
    Route::post('/embtrafroemb/add','EmbTraFroEmbController@store')->name('EmbTraFroEmbStore');

    Route::get('/embtrafroemb/edit/{id?}','EmbTraFroEmbController@edit')->name('EmbTraFroEmbEdit');
    Route::get('/embtrafroemb/view/{PatientID?}','EmbTraFroEmbController@show')->name('EmbTraFroEmbShow');
    Route::get('/embtrafroemb/print/{PatientID?}','EmbTraFroEmbController@PrintEmbTraFroEmb')->name('PrintEmbTraFroEmb');
    Route::post('/embtrafroemb/delete','EmbTraFroEmbController@destroy')->name('EmbTraFroEmbDelete');
    Route::post('/embtrafroemb/update','EmbTraFroEmbController@update')->name('EmbTraFroEmbUpdate');
/*embryo transfer froozen emb*/

/*Post Anesthesia Records*/
    // Route::get('/posanesrecs','PostAnesthesiaRecsController@index')->name('OVFReqFormIndex');
    Route::get('/posanesrecs/{PatientID?}','PostAnesthesiaRecsController@PostAnesthesiaRecs')->name('PostAnesthesiaRecs');
    Route::get('/posanesrecs/add/{PatientID?}','PostAnesthesiaRecsController@create')->name('PostAnesthesiaRecsCreate');
    Route::post('/posanesrecs/add','PostAnesthesiaRecsController@store')->name('PostAnesthesiaRecsStore');

    Route::get('/posanesrecs/edit/{id?}','PostAnesthesiaRecsController@edit')->name('PostAnesthesiaRecsEdit');
    Route::get('/posanesrecs/view/{PatientID?}','PostAnesthesiaRecsController@show')->name('PostAnesthesiaRecsShow');
    Route::get('/posanesrecs/print/{PatientID?}','PostAnesthesiaRecsController@PrintPostAnesthesiaRecs')->name('PrintPostAnesthesiaRecs');
    Route::post('/posanesrecs/delete','PostAnesthesiaRecsController@destroy')->name('PostAnesthesiaRecsDelete');
    Route::post('/posanesrecs/update','PostAnesthesiaRecsController@update')->name('PostAnesthesiaRecsUpdate');
/*Post Anesthesia Records*/

/*Pre Anestheisa Check Records*/
    // Route::get('/preanecherecs','PreAneCheRecController@index')->name('OVFReqFormIndex');
    Route::get('/preanecherecs/{PatientID?}','PreAneCheRecController@PreAneCheRecs')->name('PreAneCheRecs');
    Route::get('/preanecherecs/add/{PatientID?}','PreAneCheRecController@create')->name('PreAneCheRecsCreate');
    Route::post('/preanecherecs/add','PreAneCheRecController@store')->name('PreAneCheRecsStore');

    Route::get('/preanecherecs/edit/{id?}','PreAneCheRecController@edit')->name('PreAneCheRecsEdit');
    Route::get('/preanecherecs/view/{PatientID?}','PreAneCheRecController@show')->name('PreAneCheRecsShow');
    Route::get('/preanecherecs/print/{PatientID?}','PreAneCheRecController@PrintPreAneCheRecs')->name('PrintPreAneCheRecs');
    Route::post('/preanecherecs/delete','PreAneCheRecController@destroy')->name('PreAneCheRecsDelete');
    Route::post('/preanecherecs/update','PreAneCheRecController@update')->name('PreAneCheRecsUpdate');
/*Pre Anestheisa Check Records*/

/*Consent of Anesthesia*/
    // Route::get('/conofanesthesia','ConOfAnesthesiaController@index')->name('ConOfAnesthesiaIndex');
    Route::get('/conofanesthesia/{PatientID?}','ConOfAnesthesiaController@ConOfAnesthesia')->name('ConOfAnesthesia');
    Route::get('/conofanesthesia/add/{PatientID?}','ConOfAnesthesiaController@create')->name('ConOfAnesthesiaCreate');
    Route::post('/conofanesthesia/add','ConOfAnesthesiaController@store')->name('ConOfAnesthesiaStore');

    Route::get('/conofanesthesia/edit/{id?}','ConOfAnesthesiaController@edit')->name('ConOfAnesthesiaEdit');
    Route::get('/conofanesthesia/view/{PatientID?}','ConOfAnesthesiaController@show')->name('ConOfAnesthesiaShow');
    Route::get('/conofanesthesia/print/{PatientID?}','ConOfAnesthesiaController@PrintConOfAnesthesia')->name('PrintConOfAnesthesia');
    Route::post('/conofanesthesia/delete','ConOfAnesthesiaController@destroy')->name('ConOfAnesthesiaDelete');
    Route::post('/conofanesthesia/update','ConOfAnesthesiaController@update')->name('ConOfAnesthesiaUpdate');
/*Consent of Anesthesia*/

/*IVF Requisition Form*/
    // Route::get('/diaghyste','IVFReqFormController@index')->name('OVFReqFormIndex');
    Route::get('/ivfreqform/{PatientID?}','IVFReqFormController@OVFReqForm')->name('OVFReqForm');
    Route::get('/ivfreqform/add/{PatientID?}','IVFReqFormController@create')->name('OVFReqFormCreate');
    Route::post('/ivfreqform/add','IVFReqFormController@store')->name('OVFReqFormStore');

    Route::get('/ivfreqform/edit/{id?}','IVFReqFormController@edit')->name('OVFReqFormEdit');
    Route::get('/ivfreqform/view/{PatientID?}','IVFReqFormController@show')->name('OVFReqFormShow');
    Route::get('/ivfreqform/print/{PatientID?}','IVFReqFormController@PrintIVFReqForm')->name('PrintOVFReqForm');
    Route::post('/ivfreqform/delete','IVFReqFormController@destroy')->name('OVFReqFormDelete');
    Route::post('/ivfreqform/update','IVFReqFormController@update')->name('OVFReqFormUpdate');
/*IVF Requisition Form*/

/*Patient Doctor Diagnosis*/
Route::get('/patientdoctordiagnosis','PatientDoctorDiagnosisController@index')->name('PatientDoctorDiagnosisIndex');
Route::get('/patientdoctordiagnosis/{PatientID?}','PatientDoctorDiagnosisController@PatientDoctorDiagnosisSign')->name('PatientDoctorDiagnosisSign');
Route::get('/patientdoctordiagnosis/add/{PatientID?}','PatientDoctorDiagnosisController@create')->name('PatientDoctorDiagnosisCreate');
Route::post('/patientdoctordiagnosis/add','PatientDoctorDiagnosisController@store')->name('PatientDoctorDiagnosisStore');

Route::get('/patientdoctordiagnosis/edit/{id?}','PatientDoctorDiagnosisController@edit')->name('PatientDoctorDiagnosisEdit');
Route::get('/patientdoctordiagnosis/view/{PatientID?}','PatientDoctorDiagnosisController@show')->name('PatientDoctorDiagnosisShow');
Route::post('/patientdoctordiagnosis/delete','PatientDoctorDiagnosisController@destroy')->name('PatientDoctorDiagnosisDelete');
Route::post('/patientdoctordiagnosis/update','PatientDoctorDiagnosisController@update')->name('PatientDoctorDiagnosisUpdate');

Route::get('/patientdoctordiagnosis/print/{PatientID?}','PatientDoctorDiagnosisController@PrintDiagnosis')->name('PatientDoctorDiagnosisPrint');

/*Patient Doctor Plan*/
Route::get('/patientdoctorsplan','PatientDoctorsPlanController@index')->name('PatientDoctorsPlanIndex');
Route::get('/patientdoctorsplan/{PatientID?}','PatientDoctorsPlanController@PatientDoctorsPlanSign')->name('PatientDoctorsPlanSign');
Route::get('/patientdoctorsplan/add/{PatientID?}','PatientDoctorsPlanController@create')->name('PatientDoctorsPlanCreate');
Route::post('/patientdoctorsplan/add','PatientDoctorsPlanController@store')->name('PatientDoctorsPlanStore');

Route::get('/patientdoctorsplan/edit/{id?}','PatientDoctorsPlanController@edit')->name('PatientDoctorsPlanEdit');
Route::get('/patientdoctorsplan/view/{PatientID?}','PatientDoctorsPlanController@show')->name('PatientDoctorsPlanShow');
Route::post('/patientdoctorsplan/delete','PatientDoctorsPlanController@destroy')->name('PatientDoctorsPlanDelete');
Route::post('/patientdoctorsplan/update','PatientDoctorsPlanController@update')->name('PatientDoctorsPlanUpdate');
Route::get('/patientdoctorsplan/print/{PatientID?}','PatientDoctorsPlanController@PrintDoctorsPlan')->name('PatientDoctorsPlanPrint');

/*Patient Booking*/
Route::get('/patientbooking/{PatientID?}','PatientBookingController@PatientBookingIndex')->name('PatientBookingIndex');
Route::get('/patientbooking/add/{PatientID?}','PatientBookingController@create')->name('PatientBookingCreate');
Route::post('/patientbooking/add','PatientBookingController@store')->name('PatientBookingStore');
Route::post('/patientbooking/delete','PatientBookingController@destroy')->name('PatientBookingDelete');
Route::get('/patientbooking/edit/{id?}','PatientBookingController@edit')->name('PatientBookingEdit');
Route::post('/patientbooking/update','PatientBookingController@update')->name('PatientBookingUpdate');
Route::get('/patientbooking/view/{PatientID?}','PatientBookingController@show')->name('PatientBookingShow');


/*Patient Doctor's Lab*/
Route::get('/patientdoctorslab','PatientDoctrosLabController@index')->name('PatientDoctorsLabIndex');
Route::get('/patientdoctorslab/{PatientID?}','PatientDoctrosLabController@PatientDoctorsLab')->name('PatientDoctorsLab');
Route::get('/patientdoctorslab/add/{PatientID?}','PatientDoctrosLabController@create')->name('PatientDoctorsLabCreate');
Route::post('/patientdoctorslab/add','PatientDoctrosLabController@store')->name('PatientDoctorsLabStore');

Route::get('/patientdoctorslab/edit/{id?}','PatientDoctrosLabController@edit')->name('PatientDoctorsLabEdit');
Route::get('/patientdoctorslab/view/{PatientID?}','PatientDoctrosLabController@show')->name('PatientDoctorsLabShow');
Route::post('/patientdoctorslab/delete','PatientDoctrosLabController@destroy')->name('PatientDoctorsLabDelete');
Route::post('/patientdoctorslab/update','PatientDoctrosLabController@update')->name('PatientDoctorsLabUpdate');

Route::get('/patientdoctorslab/print/{PatientID?}','PatientDoctrosLabController@PrintPatientDoctorsLab')->name('PatientDoctorsLabPrint');

/*Doctor Consultation*/
Route::get('/doctorconsultation/{PatientID?}','DoctorConsultationController@DoctorConsultation')->name('DoctorConsultation');
Route::get('/doctorconsultation/add/female/{PatientID?}','DoctorConsultationController@createfemale')->name('DoctorConsultationCreateFemale');
Route::post('/doctorconsultation/addfemale','DoctorConsultationController@storefemale')->name('DoctorConsultationStoreFemale');
Route::post('/doctorconsultation/delete/female','DoctorConsultationController@destroyfemale')->name('DoctorConsultationDeleteFemale');
Route::get('/doctorconsultation/edit/female/{id?}','DoctorConsultationController@editfemale')->name('DoctorConsultationEditFemale');
Route::post('/doctorconsultation/update/female','DoctorConsultationController@updatefemale')->name('DoctorConsultationUpdateFemale');
Route::get('/doctorconsultation/view/female/{PatientID?}','DoctorConsultationController@showfemale')->name('DoctorConsultationShowFemale');

Route::get('/doctorconsultation/add/male/{PatientID?}','DoctorConsultationController@createmale')->name('DoctorConsultationCreateMale');
Route::post('/doctorconsultation/addmale','DoctorConsultationController@storemale')->name('DoctorConsultationStoreMale');
Route::post('/doctorconsultation/delete/male','DoctorConsultationController@destroymale')->name('DoctorConsultationDeleteMale');
Route::get('/doctorconsultation/edit/male/{id?}','DoctorConsultationController@editmale')->name('DoctorConsultationEditMale');
Route::post('/doctorconsultation/update/male','DoctorConsultationController@updatemale')->name('DoctorConsultationUpdateMale');
Route::get('/doctorconsultation/view/male/{PatientID?}','DoctorConsultationController@showmale')->name('DoctorConsultationShowMale');

/*Patient Calendar*/
Route::get('/patientcalendar/{PatientID?}','PatientCalendarController@index')->name('PatientCalendarIndex');

/*Patient Stimulating Phase*/
    Route::get('/stimulatingphase/{PatientID?}','StimulatingPhaseController@StimulatingPhase')->name('StimulatingPhase');
    Route::post('/stimulatingphase/add','StimulatingPhaseController@store')->name('StimulatingPhaseStore');
    Route::get('/stimulatingphase/edit/{id?}','StimulatingPhaseController@edit')->name('StimulatingPhaseEdit');
    Route::post('/stimulatingphase/update','StimulatingPhaseController@update')->name('StimulatingPhaseUpdate');
    Route::get('/stimulatingphase/view/{PatientID?}','StimulatingPhaseController@show')->name('StimulatingPhaseShow');
    Route::post('/stimulatingphase/delete','StimulatingPhaseController@destroy')->name('StimulatingPhaseDelete');
/*Patient Stimulating Phase*/

/*FET Phase*/
    Route::get('/fetphase/{PatientID?}','FETPhaseController@FETPhase')->name('FETPhase');
    Route::post('/fetphase/add','FETPhaseController@store')->name('FETPhaseStore');
    Route::get('/fetphase/edit/{id?}','FETPhaseController@edit')->name('FETPhaseEdit');
    Route::post('/fetphase/update','FETPhaseController@update')->name('FETPhaseUpdate');
    Route::get('/fetphase/view/{PatientID?}','FETPhaseController@show')->name('FETPhaseShow');
    Route::post('/fetphase/delete','FETPhaseController@destroy')->name('FETPhaseDelete');
/*FET*/



/*Stimulating Medecine*/
    Route::get('/stimulatingmedicine/{StiPhaseId?}','StimulatingMedecineController@StimulatingMedicine')->name('StimulatingMedicine');
    Route::post('/stimulatingmedicine/store','StimulatingMedecineController@store')->name('StimulatingMedicineStore');
    Route::get('/stimulatingmedicine/edit/{StiPhaseId?}/{id?}','StimulatingMedecineController@edit')->name('StimulatingMedicineEdit');
    Route::post('/stimulatingmedicine/update','StimulatingMedecineController@update')->name('StimulatingMedicineUpdate');
    Route::get('/stimulatingmedicine/view/{StiPhaseId?}/{id?}','StimulatingMedecineController@show')->name('StimulatingMedicineShow');
    Route::post('/stimulatingmedicine/delete','StimulatingMedecineController@destroy')->name('StimulatingMedicineDelete');

    Route::get('/stimulatingmedicine/print/{StiPhaseId?}','StimulatingMedecineController@PrintStimulatingMedicine')->name('PrintStimulatingMedicine');
/*Stimulating Medecine*/

/*FET*/
    Route::get('/fet/{StiPhaseId?}','FETController@fet')->name('FET');
    Route::post('/fet/store','FETController@store')->name('FetStore');
    Route::post('/fet/otherstore','FETController@store_other')->name('FetOtherStore');
    Route::post('/fet/expectedstore','FETController@store_expected')->name('FetExpectedStore');
    Route::get('/fet/print/{StiPhaseId?}','FETController@Printfet')->name('PrintFET');

    Route::get('/fet/view/{PhaseId?}/{id?}','FETController@view')->name('FetView');
    Route::get('/fet/viewbcp/{PhaseId?}/{id?}','FETController@viewbcp')->name('FetViewBCP');
    Route::get('/fet/viewexpdate/{PhaseId?}/{id?}','FETController@ViewExpectedDate')->name('ViewExpectedDate');
    Route::get('/fet/viewothers/{PhaseId?}/{id?}','FETController@ViewOthers')->name('ViewEditOthers');
    
    Route::get('/fet/edit/{PhaseId?}/{id?}','FETController@edit')->name('FetEdit');
    Route::get('/fet/editbcp/{PhaseId?}/{id?}','FETController@editbcp')->name('FetEditBCP');
    Route::get('/fet/editexpdate/{PhaseId?}/{id?}','FETController@EditExpectedDate')->name('EditExpectedDate');
    Route::get('/fet/editothers/{PhaseId?}/{id?}','FETController@EditOthers')->name('FetEditOthers');
    
    Route::post('/fet/update','FETController@update')->name('FetUpdate');
    Route::post('/fet/updateothers','FETController@UpdateOthers')->name('FetUpdateOthers');
    Route::post('/fet/updatebcp','FETController@updatebcp')->name('FetUpdateBcp');
    Route::post('/fet/updateexpecteddate','FETController@UpdateExpecteDate')->name('UpdateExpecteDate');

    Route::post('/fet/delete','FETController@destroy')->name('FetDelete');
    Route::post('/fet/deletebcp','FETController@destroybcp')->name('FetBCPDelete');
    Route::post('/fet/deleteexpecteddate','FETController@destroyexpecteddate')->name('FetExpecteDateDelete');
    Route::post('/fet/deleteothercycle','FETController@destroyothercycle')->name('FetOtherCycleDelete');
/*FET*/

/*FET Page 2*/
    Route::get('/fetpage2/{PhaseId?}','FETPage2Controller@FETpage2')->name('FETpage2');
    Route::get('/fetpage2/add/{PhaseId?}','FETPage2Controller@create')->name('FETpage2Create');
    Route::post('/fetpage2/add','FETPage2Controller@store')->name('FETpage2Store');
    Route::get('/fetpage2/edit/{PhaseId?}/{id?}','FETPage2Controller@edit')->name('FETpage2Edit');
    Route::post('/fetpage2/update','FETPage2Controller@update')->name('FETpage2Update');
    Route::get('/fetpage2/view/{PhaseId?}/{id?}','FETPage2Controller@show')->name('FETpage2Show');
    Route::get('/fetpage2/print/{PhaseId?}/{id?}','FETPage2Controller@PrintFETpage2')->name('PrintFETpage2');
    Route::post('/fetpage2/delete','FETPage2Controller@destroy')->name('FETpage2Delete');
/*FET Page 2*/

/*Fresh Form Phase*/
    Route::get('/freshformphase/{PatientID?}','FreshFormPhaseController@FreshFormPhase')->name('FreshFormPhase');
    Route::post('/freshformphase/add','FreshFormPhaseController@store')->name('FreshFormPhaseStore');
    Route::get('/freshformphase/edit/{id?}','FreshFormPhaseController@edit')->name('FreshFormPhaseEdit');
    Route::post('/freshformphase/update','FreshFormPhaseController@update')->name('FreshFormPhaseUpdate');
    Route::get('/freshformphase/view/{PatientID?}','FreshFormPhaseController@show')->name('FreshFormPhaseShow');
    Route::post('/freshformphase/delete','FreshFormPhaseController@destroy')->name('FreshFormPhaseDelete');

/*Fresh Form Phase*/

/*Fresh Form*/
    Route::get('/freshform/{StiPhaseId?}','FreshFormController@FreshForm')->name('FreshForm');
    Route::get('/freshform/print/{StiPhaseId?}','FreshFormController@PrintFreshForm')->name('PrintFreshForm');
    Route::post('/freshform/store','FreshFormController@store')->name('FreshFormStore');
    Route::post('/freshform/expectedstore','FreshFormController@store_expected')->name('FreshFormExpectedStore');

    Route::get('/freshform/view/{PhaseId?}/{id?}','FreshFormController@view')->name('FreshFormView');
    Route::get('/freshform/viewbcp/{PhaseId?}/{id?}','FreshFormController@viewbcp')->name('FreshFormViewBCP');
    Route::get('/freshform/viewexpdate/{PhaseId?}/{id?}','FreshFormController@ViewExpectedDate')->name('FreshFormViewExpectedDate');

    Route::get('/freshform/edit/{PhaseId?}/{id?}','FreshFormController@edit')->name('FreshFormEdit');
    Route::get('/freshform/editbcp/{PhaseId?}/{id?}','FreshFormController@editbcp')->name('FreshFormEditBCP');
    Route::get('/freshform/editexpdate/{PhaseId?}/{id?}','FreshFormController@EditExpectedDate')->name('FreshFormEditExpectedDate');

    Route::post('/freshform/update','FreshFormController@update')->name('FreshFormUpdate');
    Route::post('/freshform/updatebcp','FreshFormController@updatebcp')->name('FreshFormUpdateBcp');
    Route::post('/freshform/updateexpecteddate','FreshFormController@UpdateExpecteDate')->name('FreshFormUpdateExpecteDate');

    Route::post('/freshform/delete','FreshFormController@destroy')->name('FreshFormDelete');
    Route::post('/freshform/bcpdelete','FreshFormController@FreshFormBCPdestroy')->name('FreshFormBCPdestroy');
    Route::post('/freshform/expectedpdelete','FreshFormController@FreshFormExptecteddestroy')->name('FreshFormExptecteddestroy');
/*Fresh Form*/

/*Fresh Form Page2*/
    Route::get('/freshshortprotocol/{PhaseId?}','FreshFormPage2Controller@FreshFormPage2')->name('FreshFormPage2');
    Route::get('/freshshortprotocol/add/{PhaseId?}','FreshFormPage2Controller@create')->name('FreshFormPage2Create');
    Route::post('/freshshortprotocol/add','FreshFormPage2Controller@store')->name('FreshFormPage2Store');
    Route::get('/freshshortprotocol/edit/{PhaseId?}/{id?}','FreshFormPage2Controller@edit')->name('FreshFormPage2Edit');
    Route::post('/freshshortprotocol/update','FreshFormPage2Controller@update')->name('FreshFormPage2Update');
    Route::get('/freshshortprotocol/view/{PhaseId?}/{id?}','FreshFormPage2Controller@show')->name('FreshFormPage2Show');
    Route::get('/freshshortprotocol/print/{PhaseId?}/{id?}','FreshFormPage2Controller@PrintFreshFormPage2')->name('FreshFormPage2Print');
    Route::post('/freshshortprotocol/delete','FreshFormPage2Controller@destroy')->name('FreshFormPage2Delete');
/*Fresh Form Page2*/

/*Fresh Form Long Protocol*/
    Route::get('/freshlongprotocol/{PhaseId?}','FreshFormLongProtocolController@FreshFormLongPro')->name('FreshFormLongPro');
    Route::get('/freshlongprotocol/add/{PhaseId?}','FreshFormLongProtocolController@create')->name('FreshFormLongProCreate');
    Route::post('/freshlongprotocol/add','FreshFormLongProtocolController@store')->name('FreshFormLongProStore');
    Route::get('/freshlongprotocol/edit/{PhaseId?}/{id?}','FreshFormLongProtocolController@edit')->name('FreshFormLongProEdit');
    Route::post('/freshlongprotocol/update','FreshFormLongProtocolController@update')->name('FreshFormLongProUpdate');
    Route::get('/freshlongprotocol/view/{PhaseId?}/{id?}','FreshFormLongProtocolController@show')->name('FreshFormLongProShow');
    Route::post('/freshlongprotocol/delete','FreshFormLongProtocolController@destroy')->name('FreshFormLongProDelete');

    Route::get('/freshlongprotocol/print/{PhaseId?}/{id?}','FreshFormLongProtocolController@PrintLongProtocol')->name('FreshFormLongProPrint');
/*Fresh Form Long Protocol*/

/*Clomid Cycle*/
    Route::get('/clomidcycle/{PatientID?}','ClomidCycleController@ClomidCycle')->name('ClomidCycle');
    Route::get('/clomidcycle/add/{PatientID?}','ClomidCycleController@create')->name('ClomidCycleCreate');
    Route::post('/clomidcycle/add','ClomidCycleController@store')->name('ClomidCycleStore');
    Route::get('/clomidcycle/edit/{id?}','ClomidCycleController@edit')->name('ClomidCycleEdit');
    Route::post('/clomidcycle/update','ClomidCycleController@update')->name('ClomidCycleUpdate');
    Route::get('/clomidcycle/view/{id?}','ClomidCycleController@show')->name('ClomidCycleShow');
    Route::get('/clomidcycle/print/{id?}','ClomidCycleController@PrintClomidCycle')->name('PrintClomidCycle');
    Route::post('/clomidcycle/delete','ClomidCycleController@destroy')->name('ClomidCycleDelete');
/*Clomid Cycle*/


/*HistoryAssessesment*/
Route::get('/historyasse','HistoryAssessmentController@index')->name('HistoryAssessmentIndex');
Route::get('/historyasse/{PatientID?}','HistoryAssessmentController@PatientHistory')->name('PatientHistory');
Route::get('/historyasse/add/{PatientID?}','HistoryAssessmentController@create')->name('HistoryCreate');
Route::post('/historyasse/add','HistoryAssessmentController@store')->name('HistoryStore');

Route::get('/historyasse/edit/{id?}','HistoryAssessmentController@edit')->name('HistoryEdit');
Route::get('/historyasse/view/{PatientID?}','HistoryAssessmentController@show')->name('HistoryShow');
Route::post('/historyasse/delete','HistoryAssessmentController@destroy')->name('HistoryDelete');
Route::post('/historyasse/update','HistoryAssessmentController@update')->name('HistoryUpdate');

/*LeadAssessesment*/
Route::get('/leadasse','LeadAssessmentController@index')->name('LeadAssessmentIndex');
Route::get('/leadasse/add/{PatientID?}','LeadAssessmentController@create')->name('LeadAssCreate');
Route::get('/leadasse/{PatientID?}','LeadAssessmentController@PatientLeadAssessment')->name('PatientLeadAssessment');
Route::post('/leadasse/add','LeadAssessmentController@store')->name('LeadAssStore');
Route::get('/leadasse/edit/{id?}','LeadAssessmentController@edit')->name('LeadAssEdit');
Route::post('/leadasse/update','LeadAssessmentController@update')->name('LeadAssUpdate');
Route::post('/leadasse/delete','LeadAssessmentController@destroy')->name('LeadAssDelete');
Route::get('/leadasse/view/{id?}','LeadAssessmentController@show')->name('LeadAssView');

/* Lead Reminder */
Route::post('/leadreminder/add','LeadRemindersController@store')->name('LeadReminderStore');
Route::post('/leadreminder/delete','LeadRemindersController@destroy')->name('LeadReminderDelete');
Route::get('/leadreminder/view/{id?}','LeadRemindersController@show')->name('LeadReminderView');
Route::get('/leadreminder/edit/{id?}','LeadRemindersController@edit')->name('LeadReminderEdit');
Route::post('/leadreminder/update','LeadRemindersController@update')->name('LeadReminderUpdate');

// Route::get('/staff','StaffController@index')->name('StaffIndex');
// Route::get('/staff/new','StaffController@create')->name('StaffCreate');
// Route::post('/staff','StaffController@store')->name('StaffStore');
// Route::post('/staff/delete','StaffController@destroy')->name('StaffDelete');
// Route::get('/staff/edit/{id?}','StaffController@edit')->name('StaffEdit');
// Route::post('/staff/update','StaffController@update')->name('StaffUpdate');

/*Doctor Notes*/
Route::get('/doctorsnotes','DoctorsnotesController@index')->name('DoctorsnotesIndex');
Route::get('/doctorsnotes/{PatientID?}','DoctorsnotesController@PatientDoctorNotes')->name('PatientDoctorNotes');
Route::get('/doctorsnotes/add/{PatientID?}','DoctorsnotesController@create')->name('DoctorNotesCreate');
Route::post('/doctorsnotes/add','DoctorsnotesController@store')->name('DoctorNotesStore');

Route::get('/doctorsnotes/edit/{id?}','DoctorsnotesController@edit')->name('DoctorNotesEdit');
Route::get('/doctorsnotes/view/{PatientID?}','DoctorsnotesController@show')->name('DoctorNotesShow');
Route::post('/doctorsnotes/delete','DoctorsnotesController@destroy')->name('DoctorNotesDelete');
Route::post('/doctorsnotes/update','DoctorsnotesController@update')->name('DoctorNotesUpdate');

/*Price List*/
Route::get('/pricelist','PriceListController@index')->name('PriceListIndex');
Route::get('/pricelist/{PatientID?}','PriceListController@PatientPriceList')->name('PatientPriceList');
Route::get('/pricelist/add/{PatientID?}','PriceListController@create')->name('PriceListCreate');
Route::post('/pricelist/add','PriceListController@store')->name('PriceListStore');
Route::get('/pricelist/view/{ID?}','PriceListController@show')->name('PriceListView');
Route::get('/pricelist/edit/{ID?}','PriceListController@edit')->name('PriceListEdit');
Route::post('/pricelist/update','PriceListController@update')->name('PriceListUpdate');
Route::post('/pricelist/delete','PriceListController@destroy')->name('PriceListDelete');

Route::get('/pricelist/getmedinfo/{id?}','PriceListController@GetMedInfo')->name('GetMedInfo');

/*Pathology Xray*/
Route::get('/pathologyxray','PathologyXRayController@index')->name('PathologyXRayIndex');
Route::get('/pathologyxray/{PatientID?}','PathologyXRayController@PatientPathologyXray')->name('PatientPathologyXray');
Route::get('/pathologyxray/add/{PatientID?}','PathologyXRayController@create')->name('PathologyXrayCreate');
Route::post('/pathologyxray/add','PathologyXRayController@store')->name('PathologyXrayStore');

Route::get('/pathologyxray/edit/{id?}','PathologyXRayController@edit')->name('PathologyXrayEdit');
Route::get('/pathologyxray/view/{PatientID?}','PathologyXRayController@show')->name('PathologyXrayShow');
Route::post('/pathologyxray/delete','PathologyXRayController@destroy')->name('PathologyXrayDelete');
Route::post('/pathologyxray/update','PathologyXRayController@update')->name('PathologyXrayUpdate');

/*Patient Medication*/
Route::get('/patientmedication','PatientMedicationController@index')->name('PatientMedicationIndex');
Route::get('/patientmedication/{PatientID?}','PatientMedicationController@PatientMedication')->name('PatientMedication');
Route::get('/patientmedication/add/{PatientID?}','PatientMedicationController@create')->name('PatientMedicationCreate');
Route::post('/patientmedication/add','PatientMedicationController@store')->name('PatientMedicationStore');

Route::get('/patientmedication/view/{ID?}','PatientMedicationController@show')->name('PatientMedicationView');
Route::get('/patientmedication/edit/{ID?}','PatientMedicationController@edit')->name('PatientMedicationEdit');
Route::post('/patientmedication/update','PatientMedicationController@update')->name('PatientMedicationUpdate');
Route::post('/patientmedication/delete','PatientMedicationController@destroy')->name('PatientMedicationDelete');
Route::get('/patientmedication/print/{ID?}','PatientMedicationController@PrintPatientMedication')->name('PatientMedicationPrint');

Route::get('/patientmedication/getmedinfo/{id?}','PatientMedicationController@GetMedInfo')->name('GetMedInfo');

/*Patient Procedure*/
Route::get('/patientprocedure','PatientProcedureController@index')->name('PatientProcedureIndex');
Route::get('/patientprocedure/{PatientID?}','PatientProcedureController@PatientProcedure')->name('PatientProcedure');
Route::get('/patientprocedure/add/{PatientID?}','PatientProcedureController@create')->name('PatientProcedureCreate');
Route::post('/patientprocedure/add','PatientProcedureController@store')->name('PatientProcedureStore');

Route::get('/patientprocedure/view/{ID?}','PatientProcedureController@show')->name('PatientProcedureView');
Route::get('/patientprocedure/edit/{ID?}','PatientProcedureController@edit')->name('PatientProcedureEdit');
Route::post('/patientprocedure/update','PatientProcedureController@update')->name('PatientProcedureUpdate');
Route::post('/patientprocedure/delete','PatientProcedureController@destroy')->name('PatientProcedureDelete');
Route::get('/patientprocedure/print/{ID?}','PatientProcedureController@PrintPatientProcedure')->name('PatientProcedurePrint');

Route::get('/patientmedication/procedureinfo/{id?}','PatientProcedureController@GetProcedureInfo')->name('GetProcedureInfo');

/*Patient Treatment*/
Route::get('/patienttreatment','PatientTreatmentController@index')->name('PatientTreatmentIndex');
Route::get('/patienttreatment/{PatientID?}','PatientTreatmentController@PatientTreatment')->name('PatientTreatment');
Route::get('/patienttreatment/add/{PatientID?}','PatientTreatmentController@create')->name('PatientTreatmentCreate');
Route::post('/patienttreatment/add','PatientTreatmentController@store')->name('PatientTreatmentStore');

Route::get('/patienttreatment/view/{ID?}','PatientTreatmentController@show')->name('PatientTreatmentView');
Route::get('/patienttreatment/edit/{ID?}','PatientTreatmentController@edit')->name('PatientTreatmentEdit');
Route::post('/patienttreatment/update','PatientTreatmentController@update')->name('PatientTreatmentUpdate');
Route::post('/patienttreatment/delete','PatientTreatmentController@destroy')->name('PatientTreatmentDelete');

/*Consulation*/
Route::get('/consultation','ConsultationController@index')->name('ConsultationIndex');
Route::get('/consultation/{PatientID?}','ConsultationController@PatientConsultation')->name('PatientConsultation');
Route::get('/consultation/add/{PatientID?}','ConsultationController@create')->name('ConsultationCreate');
Route::post('/consultation/add','ConsultationController@store')->name('ConsultationStore');

Route::get('/consultation/view/{ID?}','ConsultationController@show')->name('ConsultationView');
Route::get('/consultation/edit/{ID?}','ConsultationController@edit')->name('ConsultationEdit');
Route::post('/consultation/update','ConsultationController@update')->name('ConsultationUpdate');
Route::post('/consultation/delete','ConsultationController@destroy')->name('ConsultationDelete');


/*Egg Collected*/
Route::get('/eggscollected','EggsCollectedController@index')->name('EggsCollectedIndex');
Route::get('/eggscollected/{PatientID?}','EggsCollectedController@PatientEggCollected')->name('PatientEggCollected');
Route::get('/eggscollected/add/{PatientID?}','EggsCollectedController@create')->name('EggCollectedCreate');
Route::post('/eggscollected/add','EggsCollectedController@store')->name('EggCollectedStore');
Route::get('/eggscollected/edit/{ID?}','EggsCollectedController@edit')->name('EggCollectedEdit');
Route::post('/eggscollected/update','EggsCollectedController@update')->name('EggCollectedUpdate');
Route::get('/eggscollected/view/{ID?}','EggsCollectedController@show')->name('EggCollectedView');
Route::post('/eggscollected/delete','EggsCollectedController@destroy')->name('EggCollectedDelete');

/*Egg Fertilized*/
Route::get('/eggsfertilized','EggsFertilizedController@index')->name('EggsFertilizedIndex');
Route::get('/eggsfertilized/{PatientID?}','EggsFertilizedController@PatientEggFertilized')->name('PatientEggFertilized');
Route::get('/eggsfertilized/add/{PatientID?}','EggsFertilizedController@create')->name('EggFertilizedCreate');
Route::post('/eggsfertilized/add','EggsFertilizedController@store')->name('EggFertilizedStore');
Route::get('/eggsfertilized/edit/{ID?}','EggsFertilizedController@edit')->name('EggFertilizedEdit');
Route::post('/eggsfertilized/update','EggsFertilizedController@update')->name('EggFertilizedUpdate');
Route::get('/eggsfertilized/view/{ID?}','EggsFertilizedController@show')->name('EggFertilizedView');
Route::post('/eggsfertilized/delete','EggsFertilizedController@destroy')->name('EggFertilizedDelete');

/*Good Embryo*/
Route::get('/goodembryo','GoodEmbryoController@index')->name('GoodEmbryoIndex');
Route::get('/goodembryo/{PatientID?}','GoodEmbryoController@PatientGoodEmbryo')->name('PatientGoodEmbryo');
Route::get('/goodembryo/add/{PatientID?}','GoodEmbryoController@create')->name('GoodEmbryoCreate');
Route::post('/goodembryo/add','GoodEmbryoController@store')->name('GoodEmbryoStore');
Route::get('/goodembryo/edit/{ID?}','GoodEmbryoController@edit')->name('GoodEmbryoEdit');
Route::post('/goodembryo/update','GoodEmbryoController@update')->name('GoodEmbryoUpdate');
Route::get('/goodembryo/view/{ID?}','GoodEmbryoController@show')->name('GoodEmbryoView');
Route::post('/goodembryo/delete','GoodEmbryoController@destroy')->name('GoodEmbryoDelete');


/*Transferred Embryo*/
Route::get('/transferredembryo','TransferredEmbryoController@index')->name('TransferredEmbryoIndex');
Route::get('/transferredembryo/{PatientID?}','TransferredEmbryoController@PatientTransferredEmbryo')->name('PatientTransferredEmbryo');
Route::get('/transferredembryo/add/{PatientID?}','TransferredEmbryoController@create')->name('TransferredEmbryoCreate');
Route::post('/transferredembryo/add','TransferredEmbryoController@store')->name('TransferredEmbryoStore');

Route::get('/transferredembryo/edit/{ID?}','TransferredEmbryoController@edit')->name('TransferredEmbryoEdit');
Route::post('/transferredembryo/update','TransferredEmbryoController@update')->name('TransferredEmbryoUpdate');
Route::get('/transferredembryo/view/{ID?}','TransferredEmbryoController@show')->name('TransferredEmbryoView');
Route::post('/transferredembryo/delete','TransferredEmbryoController@destroy')->name('TransferredEmbryoDelete');

/*Frozen Embryo*/
Route::get('/frozenembryo','FrozenEmbryoController@index')->name('FrozenEmbryoIndex');
Route::get('/frozenembryo/{PatientID?}','FrozenEmbryoController@PatientFrozenEmbryo')->name('PatientFrozenEmbryo');
Route::get('/frozenembryo/add/{PatientID?}','FrozenEmbryoController@create')->name('FrozenEmbryoCreate');
Route::post('/frozenembryo/add','FrozenEmbryoController@store')->name('FrozenEmbryoStore');

Route::get('/frozenembryo/edit/{ID?}','FrozenEmbryoController@edit')->name('FrozenEmbryoEdit');
Route::post('/frozenembryo/update','FrozenEmbryoController@update')->name('FrozenEmbryoUpdate');
Route::get('/frozenembryo/view/{ID?}','FrozenEmbryoController@show')->name('FrozenEmbryoView');
Route::post('/frozenembryo/delete','FrozenEmbryoController@destroy')->name('FrozenEmbryoDelete');


/*Biopsy Study*/
Route::get('/biopsystudy','BiopsyStudyController@index')->name('BiopsyStudyIndex');
Route::get('/biopsystudy/{PatientID?}','BiopsyStudyController@PatientBiopsyStudy')->name('PatientBiopsyStudy');
Route::get('/biopsystudy/add/{PatientID?}','BiopsyStudyController@create')->name('BiopsyStudyCreate');
Route::post('/biopsystudy/add','BiopsyStudyController@store')->name('BiopsyStudyStore');

Route::get('/biopsystudy/edit/{ID?}','BiopsyStudyController@edit')->name('BiopsyStudyEdit');
Route::post('/biopsystudy/update','BiopsyStudyController@update')->name('BiopsyStudyUpdate');
Route::get('/biopsystudy/view/{ID?}','BiopsyStudyController@show')->name('BiopsyStudyView');
Route::post('/biopsystudy/delete','BiopsyStudyController@destroy')->name('BiopsyStudyDelete');

/*Biopsy Result*/
Route::get('/biopsyresult','BiopsyResultController@index')->name('BiopsyResultIndex');
Route::get('/biopsyresult/{PatientID?}','BiopsyResultController@PatientBiopsyResult')->name('PatientBiopsyResult');
Route::get('/biopsyresult/add/{PatientID?}','BiopsyResultController@create')->name('BiopsyResultCreate');
Route::post('/biopsyresult/add','BiopsyResultController@store')->name('BiopsyResultStore');

Route::get('/biopsyresult/edit/{ID?}','BiopsyResultController@edit')->name('BiopsyResultEdit');
Route::post('/biopsyresult/update','BiopsyResultController@update')->name('BiopsyResultUpdate');
Route::get('/biopsyresult/view/{ID?}','BiopsyResultController@show')->name('BiopsyResultView');
Route::post('/biopsyresult/delete','BiopsyResultController@destroy')->name('BiopsyResultDelete');

/*Result*/
Route::get('/result/{PatientID?}','FertilityResultController@PatientFertilityResult')->name('PatientFertilityResult');
Route::get('/result/add/{PatientID?}','FertilityResultController@create')->name('FertilityResultCreate');
Route::post('/result/add','FertilityResultController@store')->name('FertilityResultStore');

Route::get('/result/edit/{ID?}','FertilityResultController@edit')->name('FertilityResultEdit');
Route::post('/result/update','FertilityResultController@update')->name('FertilityResultUpdate');
Route::get('/result/view/{ID?}','FertilityResultController@show')->name('FertilityResultView');
Route::post('/result/delete','FertilityResultController@destroy')->name('FertilityResultDelete');

/*Report Generation*/
Route::get('/generatesummary/{PatiendId?}','ReportController@GenerateSummary')->name('GenerateSummary');
Route::get('/leadreport','ReportController@LeadReport')->name('LeadReport');
Route::get('/leadreport/action','ReportController@LeadAction')->name('LeadAction');
Route::get('/consultationreport','ReportController@ConsultationReport')->name('ConsultationReport');
Route::get('/medicinereport','ReportController@MedicineReport')->name('MedicineReport');
Route::get('/treatmentreport','ReportController@TreatmentReport')->name('TreatmentReport');
