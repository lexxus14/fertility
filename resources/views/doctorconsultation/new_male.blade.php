@extends('layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>Invoice</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php
      $strMainContactPerson ="";
      $strMainContactNo="";
      $strMainEmail="";
      $intPatientId=0;
      ?>
      @foreach($patients as $patient)
      <?php
        $strMainContactPerson = $patient->MainContactPerson;
        $strMainContactNo = $patient->MainContactNo;
        $strMainEmail = $patient->MainEmail;
        $intPatientId=$patient->id;
      ?>
    <section class="content"> 
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Application buttons -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <div class="card-body">               
                <!-- <p>Application Buttons with Custom Colors</p> -->
                <a href="{{route('LeadView')}}/{{$intPatientId}}" class="btn btn-app bg-secondary">                  
                  <i class="fas fa-user-plus"></i> Info
                </a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">          


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <!-- <i class="fas fa-user"></i> Patient Profile -->
                    <!-- <small class="float-right">Date: 2/10/2014</small> -->
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->              
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  Main Contact
                  <address>
                  <strong>{{$strMainContactPerson}}</strong><br>
                    Email: {{$strMainEmail}}<br>
                    Contact No: {{$strMainContactNo}}<br>
                    Lead Source: {{$patient->LeadSource}}<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  Wife
                  <address>
                    <strong>{{$patient->WifeName}}&nbsp{{$patient->WifeLastName}}</strong><br>
                    Birth Date:{{$patient->WifeBirthDate}}<br>
                    Married Since:{{$patient->MarriedSince}}<br>
                    Contact No: {{$patient->WifeContactNo}}<br>
                    Nationality: {{$patient->WifeNationality}}<br>
                    Address: {{$patient->WifeAddress}}<br>
                    Email: {{$patient->WifeEmailAddress}}<br>
                    <div class="form-group">
                      @if($patient->IsIVF=='on')
                      <input type="checkbox" id="checkboxPrimary1" checked>
                      @else
                      <input type="checkbox" id="checkboxPrimary1" >
                      @endif
                      <label for="checkboxPrimary1">IVF Before
                      </label>
                      @if($patient->IsHasChildren=='on')
                      <input type="checkbox" id="checkboxPrimary2" checked>
                      @else
                      <input type="checkbox" id="checkboxPrimary2" >
                      @endif
                      <label for="checkboxPrimary2">Has Children
                      </label>
                      @if($patient->IsMiscarriage=='on')
                      <input type="checkbox" id="checkboxPrimary3" checked>
                      @else
                      <input type="checkbox" id="checkboxPrimary3" >
                      @endif
                      <label for="checkboxPrimary3">Miscarriage
                      </label>
                  </div>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  Husband
                  <address>
                    <strong>{{$patient->HusbandName}}&nbsp{{$patient->HusbandLastName}}</strong><br>
                    Birth Date: {{$patient->HusbandBirthDate}}<br>
                    Contact No: {{$patient->HusbandContactNo}}<br>
                    Nationality: {{$patient->HusbandNationality}}<br>
                    Address: {{$patient->HusbandAddress}}<br>
                    Email: {{$patient->HusbandEmailAddress}}<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  <b>Profile No:{{$patient->FileNo}}</b><br>
                  <br>
                  <b>NOTE:</b> {{$patient->Notes}}<br>
                </div>
                <!-- /.col -->
              </div>
              @endforeach
              <!-- /.row -->
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  <section class="content">
   <form action="{{route('DoctorConsultationStoreMale')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
        {{ csrf_field() }}
      <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">


      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="mb-5 p-4 bg-white shadow-sm">
              <h3>Male History</h3>
              <div id="stepper3" class="bs-stepper">
                <div class="bs-stepper-header" role="tablist">
                  <div class="step" data-target="#test-nlf-1">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger1" aria-controls="test-nlf-1">
                      <span class="bs-stepper-circle">
                        <span class="fas fa-user" aria-hidden="true"></span>
                      </span>
                      <span class="bs-stepper-label">Social History</span>
                    </button>
                  </div>

                  <!-- <div class="bs-stepper-line"></div> -->
                  <div class="step" data-target="#test-nlf-2">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger2" aria-controls="test-nlf-2">
                      <span class="bs-stepper-circle">
                        <span class="fas fa-map-marked" aria-hidden="true"></span>
                      </span>
                      <span class="bs-stepper-label">Family History</span>
                    </button>
                  </div>

                  <!-- <div class="bs-stepper-line"></div> -->
                  <div class="step" data-target="#test-nlf-3">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger3" aria-controls="test-nlf-3">
                      <span class="bs-stepper-circle">
                        <span class="fas fa-map-marked" aria-hidden="true"></span>
                      </span>
                      <span class="bs-stepper-label">Medical History</span>
                    </button>
                  </div>

                  <!-- <div class="bs-stepper-line"></div> -->
                  <div class="step" data-target="#test-nlf-4">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger4" aria-controls="test-nlf-4">
                      <span class="bs-stepper-circle">
                        <span class="fas fa-map-marked" aria-hidden="true"></span>
                      </span>
                      <span class="bs-stepper-label">Sexual History</span>
                    </button>
                  </div>                  

                  <!-- <div class="bs-stepper-line"></div> -->
                  <div class="step" data-target="#test-nlf-5">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger5" aria-controls="test-nlf-5">
                      <span class="bs-stepper-circle">
                        <span class="fas fa-map-marked" aria-hidden="true"></span>
                      </span>
                      <span class="bs-stepper-label">Surgical History</span>
                    </button>
                  </div>                 

                  <!-- <div class="bs-stepper-line"></div> -->
                  <div class="step" data-target="#test-nlf-6">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger6" aria-controls="test-nlf-6">
                      <span class="bs-stepper-circle">
                        <span class="fas fa-save" aria-hidden="true"></span>
                      </span>
                      <span class="bs-stepper-label">Submit</span>
                    </button>
                  </div>
                </div>
                <div class="bs-stepper-content">
                  <div id="test-nlf-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger1">
                    <div class="form-group clearfix">
                      <label for="dtdocdate">
                          Date
                      </label>
                      <input type="date" name="docdate"  id="dtdocdate" value='{{date("Y-m-d")}}' class="form-control">                    
                    </div>
                    <div class="form-group clearfix">
                      <h3>Civil Status</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SocHisSingle"  id="chkCivilStatSingle">
                        <label for="chkCivilStatSingle">
                          Single
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SocHisMarried" id="chkCivilStatMarried">
                        <label for="chkCivilStatMarried">
                          Married
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SocHisDivorced" id="chkCivilStatDivorced">
                        <label for="chkCivilStatDivorced">
                          Divorced
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SocHisWidow" id="chkCivilStatWidowed">
                        <label for="chkCivilStatWidowed">
                          Widow
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="txtNumberOfChildren">
                        Number of Children
                      </label>
                      <input type="number" class="form-control" name="SocHisNoOfChildren" id="txtNumberOfChildren">                        
                    </div>

                    <div class="form-group clearfix">
                      <h3>Work Status</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SocHisWorkingStatusYes"  id="chckWorkStatYes">
                        <label for="chckWorkStatYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SocHisWorkingStatusNo" id="chckWorkStatNo">
                        <label for="chckWorkStatNo">
                          No
                        </label>
                      </div> 
                      <div class="form-group">
                        <label for="txtWorkSpecify">
                          Specify
                        </label>
                        <input type="text" class="form-control" name="SocHisWorkingSpecify" id="txtWorkSpecify">
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Alcohol Intake</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="chckAlcoholInYes" name="SocHisAlcoholIntakeYes" id="chckAlcoholInYes">
                        <label for="chckAlcoholInYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SocHisAlcoholIntakeNo" id="chckAlcoholInNo">
                        <label for="chckAlcoholInNo">
                          No
                        </label>
                      </div> 
                    </div>

                    <div class="form-group clearfix">
                      <h3>Smoking</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SocHisSmokingYes"  id="chckSmokingYes">
                        <label for="chckSmokingYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SocHisSmokingNo" id="chckSmokingNo">
                        <label for="chckSmokingNo">
                          No
                        </label>
                      </div> 
                    </div>

                    <div class="form-group clearfix">
                      <h3>Substance Abuse</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SocHisSubsAbuseYes"  id="chckSubAbuYes">
                        <label for="chckSubAbuYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SocHisSubsAbuseNo" id="chckSubAbuNo">
                        <label for="chckSubAbuNo">
                          No
                        </label>
                      </div> 
                    </div>

                    <!-- <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span> -->
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger2">                    
                    <div class="form-group clearfix">
                      <h3>Does any of your family have any history for the following medical condition?</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="FamHisMedConDiaMille"  id="chkFamHisMedConDiaMille">
                        <label for="chkFamHisMedConDiaMille">
                          Diabetes Milletus
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="FamHisMedConHigbBlood" id="chkFamHisMedConHigbBlood">
                        <label for="chkFamHisMedConHigbBlood">
                          High Blood
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="FamHisMedConCancer" id="chkFamHisMedConCancer">
                        <label for="chkFamHisMedConCancer">
                          Cancer
                        </label>
                      </div>
                      <div class="form-group">
                        <label for="txtFamHisMedConOthers">
                          Others
                        </label>
                        <input type="text" class="form-control" name="FamHisMedConOthers" id="txtFamHisMedConOthers">
                      </div>
                    </div>    

                    <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span>
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-3" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger3">
                    
                    <div class="form-group clearfix">
                      <h3>Have you done Semen Analysis?</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisSemAnaYes"  id="chkMedHisSemAnaYes">
                        <label for="chkMedHisSemAnaYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisSemAnaNo"  id="chkMedHisSemAnaNo">
                        <label for="chkMedHisSemAnaNo">
                          No
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Are you experiencing <b>Retrograde Ejaculation?</b>(experiencing like after intercourse-dry, ejaculated very little or no semen coming out of your penis or when your urine is cloudy after intercourse because it containes semen)</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisRetroEjaYes"  id="chkMedHisRetroEjaYes">
                        <label for="chkMedHisRetroEjaYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisRetroEjaNo"  id="chkMedHisRetroEjaNo">
                        <label for="chkMedHisRetroEjaNo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <h3>Have you been exposed to radiation or harmful chemicals?</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisExpRadHarChemYes"  id="chkMedHisExpRadHarChemYes">
                        <label for="chkMedHisExpRadHarChemYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisExpRadHarChemNo"  id="chkMedHisExpRadHarChemNo">
                        <label for="chkMedHisExpRadHarChemNo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtMedHisExpRadHarChemSpecify">
                        Specify
                      </label>
                      <input type="text" class="form-control" name="MedHisExpRadHarChemSpecify" id="txtMedHisExpRadHarChemSpecify">
                    </div>

                    <div class="form-group clearfix">
                      <h3>Do you have any current, chronic medical conditions? (Diabetes, High Blood Pressure, etc.)</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisChroMedConYes"  id="chkMedHisChroMedConYes">
                        <label for="chkMedHisChroMedConYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisChroMedConNo"  id="chkMedHisChroMedConNo">
                        <label for="chkMedHisChroMedConNo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtMedHisChroMedConSpecify">
                        Specify
                      </label>
                      <input type="text" class="form-control" name="MedHisChroMedConSpecify" id="txtMedHisChroMedConSpecify">
                    </div>

                    <div class="form-group">
                      <label for="txtMedHisCurMed">
                        Current Medication:
                      </label>
                      <input type="text" class="form-control" name="MedHisCurMed" id="txtMedHisCurMed">
                    </div>

                    <div class="form-group clearfix">
                      <h3>Are you currently taking any over the counter or herbal medications?</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisOvCouHerMedYes"  id="chkMedHisOvCouHerMedYes">
                        <label for="chkMedHisOvCouHerMedYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisOvCouHerMedNo"  id="chkMedHisOvCouHerMedNo">
                        <label for="chkMedHisOvCouHerMedNo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtMedHisOvCouHerMedSpecify">
                        Specify
                      </label>
                      <input type="text" class="form-control" name="MedHisOvCouHerMedSpecify" id="txtMedHisOvCouHerMedSpecify">
                    </div>

                    <div class="form-group clearfix">
                      <h3>Allergies in Food</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisAllerFoodYes"  id="chkMedHisAllerFoodYes">
                        <label for="chkMedHisAllerFoodYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisAllerFoodNonKnown"  id="chkMedHisAllerFoodNonKnown">
                        <label for="chkMedHisAllerFoodNonKnown">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtMedHisAllerFoodSpecify">
                        Specify
                      </label>
                      <input type="text" class="form-control" name="MedHisAllerFoodSpecify" id="txtMedHisAllerFoodSpecify">
                    </div>

                    <div class="form-group clearfix">
                      <h3>Allergies in Medication</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisAllerMedYes"  id="chkMedHisAllerMedYes">
                        <label for="chkMedHisAllerMedYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisAllerMedNonKnown"  id="chkMedHisAllerMedNonKnown">
                        <label for="chkMedHisAllerMedNonKnown">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtMedHisAllerMedSpecify">
                        Specify
                      </label>
                      <input type="text" class="form-control" name="MedHisAllerMedSpecify" id="txtMedHisAllerMedSpecify">
                    </div>

                    <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span>
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-4" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger4">
                    
                    <div class="form-group clearfix">
                      <h3>Have you ever had any following sexually transmitted disease or pelvic pain. (Check all
that apply)</h3>
                    </div>

                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisChlamydi"  id="chkSexHisChlamydi">
                        <label for="chkSexHisChlamydi">
                          Chlamydia
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisGonorrhea"  id="chkSexHisGonorrhea">
                        <label for="chkSexHisGonorrhea">
                          Gonorrhea
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisSyphilis"  id="chkSexHisSyphilis">
                        <label for="chkSexHisSyphilis">
                          Syphilis
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisGenWartsHPV"  id="chkSexHisGenWartsHPV">
                        <label for="chkSexHisGenWartsHPV">
                          Genital Warts/HPV
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisHepatitis"  id="chkSexHisHepatitis">
                        <label for="chkSexHisHepatitis">
                          Hepatitis
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisHerpes"  id="chkSexHisHerpes">
                        <label for="chkSexHisHerpes">
                          Herpes
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisHIVAIDS"  id="chkSexHisHIVAIDS">
                        <label for="chkSexHisHIVAIDS">
                          HIV/AIDS
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisPIV"  id="chkSexHisPIV">
                        <label for="chkSexHisPIV">
                          PID (Pelvic Inflammatory Disease)
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label for="txtSexHisOthers">
                        Others
                      </label>
                      <input type="text" class="form-control" name="SexHisOthers" id="txtSexHisOthers">
                    </div>

                    <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span>
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-5" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger5">
                    
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                            <div class="form-group">
                              <label>What type of surgery?</label>
                              <textarea id="inputNoteLead-Edit" name="SurHisTypeSurgery" class="form-control" rows="4"></textarea>
                            </div>                      
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                            <div class="form-group">
                              <label>When?</label>
                              <textarea id="inputNoteLead-Edit" name="SurHisWhen" class="form-control" rows="4"></textarea>
                            </div>                      
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                            <div class="form-group">
                              <label>Any complications?</label>
                              <textarea id="inputNoteLead-Edit" name="SurHisComplication" class="form-control" rows="4"></textarea>
                            </div>                      
                          </div>
                      </div>
                    </div>

                    <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span>
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-6" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger6">
                    
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                            <div class="form-group">
                              <label>Notes:</label>
                              <textarea id="inputNoteLead-Edit" name="Notes" class="form-control" rows="4"></textarea>
                            </div>                      
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputFile">Attach File:</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="exampleInputFile" name="inputFile">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>                            
                          </div>
                          <br>                          
                        </div>
                      </div>
                    </div>

                    <span class="btn btn-primary mt-5" onclick="stepper3.previous()">Previous</span>
                    <button type="submit" class="btn btn-primary mt-5">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </form>
  </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->


  <!-- DataTables  & Plugins
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
 -->

 <script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>   
 <!-- <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script> -->



 <script type="text/javascript">
    $(function () { 
       //Date picker
    $('#lead-date').datetimepicker({
        format: 'L'
    });

    $('#lead-date-update').datetimepicker({
        format: 'L'
    });
    $('#marrieddate').datetimepicker({
        format: 'L'
    });    
    $('#husbandbirthdate').datetimepicker({
        format: 'L'
    });

    


  'use strict'

  
  window.stepper3 = new Stepper(document.querySelector('#stepper3'), {
    linear: false,
    animation: true
  })




  



  });
 </script> 


<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endsection