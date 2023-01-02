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
   <form action="{{route('DoctorConsultationStoreFemale')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
        {{ csrf_field() }}
      <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">


      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="mb-5 p-4 bg-white shadow-sm">
              <h3>Female History</h3>
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
                      <span class="bs-stepper-label">Menstrual History</span>
                    </button>
                  </div>

                  <!-- <div class="bs-stepper-line"></div> -->
                  <div class="step" data-target="#test-nlf-3">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger3" aria-controls="test-nlf-3">
                      <span class="bs-stepper-circle">
                        <span class="fas fa-map-marked" aria-hidden="true"></span>
                      </span>
                      <span class="bs-stepper-label">Pregnancy History</span>
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
                      <span class="bs-stepper-label">Medical History</span>
                    </button>
                  </div>

                  <!-- <div class="bs-stepper-line"></div> -->
                  <div class="step" data-target="#test-nlf-6">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger6" aria-controls="test-nlf-6">
                      <span class="bs-stepper-circle">
                        <span class="fas fa-map-marked" aria-hidden="true"></span>
                      </span>
                      <span class="bs-stepper-label">Surgical History</span>
                    </button>
                  </div>

                  <!-- <div class="bs-stepper-line"></div> -->
                  <div class="step" data-target="#test-nlf-7">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger7" aria-controls="test-nlf-7">
                      <span class="bs-stepper-circle">
                        <span class="fas fa-map-marked" aria-hidden="true"></span>
                      </span>
                      <span class="bs-stepper-label">Family History</span>
                    </button>
                  </div>

                  <!-- <div class="bs-stepper-line"></div> -->
                  <div class="step" data-target="#test-nlf-8">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger8" aria-controls="test-nlf-8">
                      <span class="bs-stepper-circle">
                        <span class="fas fa-map-marked" aria-hidden="true"></span>
                      </span>
                      <span class="bs-stepper-label">Prior Fertility History</span>
                    </button>
                  </div>

                  <!-- <div class="bs-stepper-line"></div> -->
                  <div class="step" data-target="#test-nlf-9">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger9" aria-controls="test-nlf-9">
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
                      <label for="dtDoc">
                          Date
                      </label>
                      <input type="date" name="txtDocDate"  id="dtDoc" value='{{date("Y-m-d")}}' class="form-control">                    
                    </div>
                    <div class="form-group clearfix">
                      <h3>Civil Status</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="IsSingle"  id="chkCivilStatSingle">
                        <label for="chkCivilStatSingle">
                          Single
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="IsMarried" id="chkCivilStatMarried">
                        <label for="chkCivilStatMarried">
                          Married
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="IsDivorced" id="chkCivilStatDivorced">
                        <label for="chkCivilStatDivorced">
                          Divorced
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="IsWidow" id="chkCivilStatWidowed">
                        <label for="chkCivilStatWidowed">
                          Widow
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="txtNumberOfChildren">
                        Number of Children
                      </label>
                      <input type="number" class="form-control" name="NoOfChildren" id="txtNumberOfChildren">                        
                    </div>

                    <div class="form-group clearfix">
                      <h3>Work Status</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="WorkStatusYes"  id="chckWorkStatYes">
                        <label for="chckWorkStatYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="WorkStatusNo" id="chckWorkStatNo">
                        <label for="chckWorkStatNo">
                          No
                        </label>
                      </div> 
                      <div class="form-group">
                        <label for="txtWorkSpecify">
                          Specify
                        </label>
                        <input type="text" class="form-control" name="WorkStatusSpecify" id="txtWorkSpecify">
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Alcohol Intake</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="AlcoholIntakeYes" id="chckAlcoholInYes">
                        <label for="chckAlcoholInYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="AlcoholIntakeNo" id="chckAlcoholInNo">
                        <label for="chckAlcoholInNo">
                          No
                        </label>
                      </div> 
                      <div class="form-group">
                        <label for="txtAlcoholSpecify">
                          Specify
                        </label>
                        <input type="text" class="form-control" name="AlcoholIntakeSpecify" id="txtAlcoholSpecify">
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Smoking</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SmokingYes"  id="chckSmokingYes">
                        <label for="chckSmokingYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SmokingNo" id="chckSmokingNo">
                        <label for="chckSmokingNo">
                          No
                        </label>
                      </div> 
                      <div class="form-group">
                        <label for="txtSmokingSpecify">
                          Specify
                        </label>
                        <input type="text" class="form-control" name="SmokingSpecify" id="txtSmokingSpecify">
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Substance Abuse</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SubstanceYes"  id="chckSubAbuYes">
                        <label for="chckSubAbuYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SubstanceNo" id="chckSubAbuNo">
                        <label for="chckSubAbuNo">
                          No
                        </label>
                      </div> 
                      <div class="form-group">
                        <label for="txtSubAbuSpecify">
                          Specify
                        </label>
                        <input type="text" class="form-control" name="SubstanceSpecify" id="txtSubAbuSpecify">
                      </div>
                    </div>

                    <!-- <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span> -->
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger2">
                    <div class="form-group clearfix">
                      <h3>Last Menstrual Period</h3>
                      <label for="dtMenstrualPeriod">
                          Date
                      </label>
                      <input type="date"  id="dtMenstrualPeriod" name="LastMenstualPeriod" class="form-control">                          
                      <div class="form-group">
                        <label for="txtMenstrualSpecify">
                          Specify
                        </label>
                        <input type="text" class="form-control" name="LastMenstualPeriodSpecify" id="txtMenstrualSpecify">
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <h3>Pregnant</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PregnantYes"  id="chckPregnantYes">
                        <label for="chckPregnantYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PregnantNo" id="chckPregnantNo">
                        <label for="chckPregnantNo">
                          No
                        </label>
                      </div>
                      <div class="form-group">
                        <label for="txtPregnantSpecify">
                          Specify
                        </label>
                        <input type="text" class="form-control" name="PregnantSpecify" id="txtPregnantSpecify">
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <h3>Breast Feeding</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="BreastFeedingYes"  id="chckBreastFeedingYes">
                        <label for="chckBreastFeedingYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="BreastFeedingNo" id="chckBreastFeedingNo">
                        <label for="chckBreastFeedingNo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group clearfix"> 
                        <div class="form-group">
                          <label for="txtStartMensPer">
                            What age did you start with your first menstrual period?
                          </label>
                          <input type="number" class="form-control" name="AgeStartPeriod" id="txtStartMensPer">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Are your periods (Check if apply):</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodAbsent"  id="chckPeriodsAbsent">
                        <label for="chckPeriodsAbsent">
                          Absent
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodRegular" id="chckPeriodsRegular">
                        <label for="chckPeriodsRegular">
                          Regular
                        </label>
                      </div> 
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodLight" id="chckPeriodsLight">
                        <label for="chckPeriodsLight">
                          Light
                        </label>
                      </div> 
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodHeavy"  id="chckPeriodsHeavy">
                        <label for="chckPeriodsHeavy">
                          Heavy
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodSpottingBefore"  id="chckPeriodsSpottingBefPer">
                        <label for="chckPeriodsSpottingBefPer">
                          Spotting before period
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodSpottingBetween" id="chckPeriodsSpottingBetPer">
                        <label for="chckPeriodsSpottingBetPer">
                          Spotting between period
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodIrregular"  id="chckPeriodsIrregular">
                        <label for="chckPeriodsIrregular">
                          Irregular
                        </label>
                      </div>

                      <div class="form-group">
                        <label for="txtPeriodsYearly">
                          How many periods do you have yearly?
                        </label>
                        <input type="text" class="form-control" name="PeriodIrregularSpecify" id="txtPeriodsYearly">
                      </div>
                      <div class="form-group">
                        <h3>Do you have severe cramping or pelvic pain with your period?</h3>
                        <div class="icheck-success d-inline">
                          <input type="checkbox" name="SevereCrampingYes" id="chckCramPainPeriodYes">
                          <label for="chckCramPainPeriodYes">
                            Yes
                          </label>
                        </div> 
                        <div class="icheck-success d-inline">
                          <input type="checkbox" name="SevereCrampingNo" id="chckCramPainPeriodNo">
                          <label for="chckCramPainPeriodNo">
                            No
                          </label>
                        </div>                          
                      </div>
                    </div>
                    <div class="form-group clearfix"> 
                        <div class="form-group">
                          <label for="txtCramPainPeriodSpecify">
                            Specify
                          </label>
                          <input type="text" class="form-control" name="SevereCrampingSpecify" id="txtCramPainPeriodSpecify">
                        </div>
                    </div>


                    <div class="form-group">
                      <h3>Pain scale score while you are in period 1- 10. (1 is the lowest 10 is the highest)</h3>
                    </div>

                    <div class="form-group clearfix">
                      <img src="{{ asset('dist/img/painscalescore.PNG')}}" alt="Pain Scale Score" style="opacity: .8">
                      <input type="number" class="form-control" name="PainScaleScore" id="txtPainScaleScore">
                    </div>

                    <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span>
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-3" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger3">
                    
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                            <div class="form-group">
                              <label>Year you conceived</label>
                              <textarea id="inputNoteLead-Edit" name="PreHisConceivedYear" class="form-control" rows="4"></textarea>
                            </div>                      
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                            <div class="form-group">
                              <label>How long to conceived</label>
                              <textarea id="inputNoteLead-Edit" name="PreHisLongConceived" class="form-control" rows="4"></textarea>
                            </div>                      
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                            <div class="form-group">
                              <label>Normal Delivery, C-Section, D&C, Miscarriage</label>
                              <textarea id="inputNoteLead-Edit" name="PreHisNorDelCSecMisc" class="form-control" rows="4"></textarea>
                            </div>                      
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                            <div class="form-group">
                              <label>Fertility treatment used.</label>
                              <textarea id="inputNoteLead-Edit" name="PreHisFerTreaUsed" class="form-control" rows="4"></textarea>
                            </div>                      
                          </div>
                      </div>
                    </div>

                    <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span>
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-4" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger4">
                    
                    <div class="form-group clearfix">
                      <h3>Have you used over the counter ovulation kit to time intercourse</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisCountOvuKitYes"  id="chckSexHisCountOvuKitYes">
                        <label for="chckSexHisCountOvuKitYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisCountOvuKitNo" id="chckSexHisCountOvuKitNo">
                        <label for="chckSexHisCountOvuKitNo">
                          No
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Do  you have any pain with intercourse</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisPainInterYes"  id="chckSexHisPainInterYes">
                        <label for="chckSexHisPainInterYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisPainInterNo" id="chckSexHisPainInterNo">
                        <label for="chckSexHisPainInterNo">
                          No
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Have you ever used contraceptives</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisUseContraceptiveYes"  id="chckSexHisUseContraceptiveYes">
                        <label for="chckSexHisUseContraceptiveYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisUseContraceptiveNo" id="chckSexHisUseContraceptiveNo">
                        <label for="chckSexHisUseContraceptiveNo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group clearfix"> 
                        <div class="form-group">
                          <label for="txtSexHisUseContraceptiveSpecify">
                            Specify
                          </label>
                          <input type="text" class="form-control" name="SexHisUseContraceptiveSpecify" id="txtSexHisUseContraceptiveSpecify">
                        </div>
                    </div>                   

                    <div class="form-group clearfix">
                      <h3>Have you ever had any following sexually transmitted disease or pelvic pain. (Check all that apply)?</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisChlamydia"  id="chckSexHisChlamydia">
                        <label for="chckSexHisChlamydia">
                          Chlamydia
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisGonorrhea" id="chckSexHisGonorrhea">
                        <label for="chckSexHisGonorrhea">
                          Gonorrhea
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisSyphilis"  id="chkSexHisSyphilis">
                        <label for="chkSexHisSyphilis">
                          Syphilis
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisGenitalWartsHPV" id="chkSexHisGenitalWartsHPV">
                        <label for="chkSexHisGenitalWartsHPV">
                          Genital Warts / HPV
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisHepatitis"  id="chkSexHisHepatitis">
                        <label for="chkSexHisHepatitis">
                          Hepatitis
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisHerpes" id="chkSexHisHerpes">
                        <label for="chkSexHisHerpes">
                          Herpes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisHIVAIDS"  id="chkSexHisHIVAIDS">
                        <label for="chkSexHisHIVAIDS">
                          HIV/AIDS
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisPID"  id="chkSexHisPID">
                        <label for="chkSexHisPID">
                          PID (Pelvic Inflammatory Disease)
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisUTI"  id="chkSexHisUTI">
                        <label for="chkSexHisUTI">
                          UTI
                        </label>
                      </div>                        
                    </div>
                    <div class="form-group">
                      <label for="chkSexHiTransmittedDeasesSpecify">
                          Other
                      </label>
                      <input type="text" name="SexHiTransmittedDeasesSpecify" id="chkSexHiTransmittedDeasesSpecify" class="form-control">
                        
                    </div>

                    <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span>
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-5" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger5">
                    
                    <div class="form-group clearfix">
                      <h3>Do you have any current, chronic medical conditions (Diabetes, High Blood Pressure, ect.)?</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisChroMedConYes"  id="chckMedHisChroMedConYes">
                        <label for="chckMedHisChroMedConYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisChroMedConNo" id="chckMedHisChroMedConNo">
                        <label for="chckMedHisChroMedConNo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group clearfix"> 
                        <div class="form-group">
                          <label for="txtMedHisChroMedConSpecify">
                            Specify
                          </label>
                          <input type="text" class="form-control" name="MedHisChroMedConSpecify" id="txtMedHisChroMedConSpecify">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Are you currently taking any over the counter or herbal medications?</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="InMedicationYes" id="chckInMedicationYes">
                        <label for="chckInMedicationYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="InMedicationNo" id="chckInMedicationNo">
                        <label for="chckInMedicationNo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group clearfix"> 
                        <div class="form-group">
                          <label for="txtInMedicationSpecify">
                            Specify
                          </label>
                          <input type="text" class="form-control" name="InMedicationSpecify" id="txtInMedicationSpecify">
                        </div>
                    </div> 

                    <div class="form-group clearfix">
                      <h3>Aspirin intake (within the last 10 days).</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="IntakeAspirinYes" id="chckIntakeAspirinYes">
                        <label for="chckIntakeAspirinYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="IntakeAspirinNo" id="chckIntakeAspirinNo">
                        <label for="chckIntakeAspirinNo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group clearfix"> 
                        <div class="form-group">
                          <label for="txtIntakeAspirinSpecify">
                            Specify
                          </label>
                          <input type="text" class="form-control" name="IntakeAspirinSpecify" id="txtIntakeAspirinSpecify">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Allergies in food.</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="FoodAllergyYes"  id="chckFoodAllergyYes">
                        <label for="chckFoodAllergyYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="FoodAllergyNo" id="chckFoodAllergyNo">
                        <label for="chckFoodAllergyNo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group clearfix"> 
                        <div class="form-group">
                          <label for="txtFoodAllergySpecify">
                            Specify
                          </label>
                          <input type="text" class="form-control" name="FoodAllergySpecify" id="txtFoodAllergySpecify">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Allergies in any Medication.</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedAllergyYes" id="chckMedAllergyYes">
                        <label for="chckMedAllergyYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedAllergyNo" id="chckMedAllergyNo">
                        <label for="chckMedAllergyNo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group clearfix"> 
                        <div class="form-group">
                          <label for="txtMedAllergySpecify">
                            Specify
                          </label>
                          <input type="text" class="form-control" name="MedAllergySpecify" id="txtMedAllergySpecify">
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
                            <label>What type of Surgery.</label>
                            <textarea id="inputNoteLead-Edit" name="SurHisSurgery" class="form-control" rows="4"></textarea>
                          </div>                      
                        </div>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                        <label for="dtSurHisSurgeryDate">
                            Date and Year of Surgery
                        </label>
                      <input type="date" name="SurHisSurgeryDate" id="dtSurHisSurgeryDate" class="form-control">  
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <div class="form-group">
                            <label>Complication.</label>
                            <textarea id="inputNoteLead-Edit" name="SurHisComplication" class="form-control" rows="4"></textarea>
                          </div>                      
                        </div>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Do you have any problem with Anesthesia.</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SurHisProbAnesthesiaYes"  id="chckSurHisProbAnesthesiaYes">
                        <label for="chckSurHisProbAnesthesiaYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SurHisProbAnesthesiaNo" id="chckSurHisProbAnesthesiaNoo">
                        <label for="chckSurHisProbAnesthesiaNoo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group clearfix"> 
                        <div class="form-group">
                          <label for="txtSurHisProbAnesthesiaSpecify">
                            Specify
                          </label>
                          <input type="text" class="form-control" name="SurHisProbAnesthesiaSpecify" id="txtSurHisProbAnesthesiaSpecify">
                        </div>
                    </div>

                    <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span>
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-7" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger7">
                    
                    <div class="form-group clearfix">
                      <h3>Does any in your family have a history of medical condition.</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="FamHisFamMedConDiabetesMellitus" id="chckFamHisFamMedConDiabetesMellitus">
                        <label for="chckFamHisFamMedConDiabetesMellitus">
                          Diabetes Mellitus
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="FamHisFamMedConHighBlood" id="chckFamHisFamMedConHighBlood">
                        <label for="chckFamHisFamMedConHighBlood">
                          High Blood
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="FamHisFamMedConCancer" id="chckFamHisFamMedCancer">
                        <label for="chckFamHisFamMedCancer">
                          Cancer
                        </label>
                      </div>
                    </div>
                    <div class="form-group clearfix"> 
                        <div class="form-group">
                          <label for="txtFamHisFamMedConHighOthers">
                            Others
                          </label>
                          <input type="text" class="form-control" name="FamHisFamMedConHighOthers" id="txtFamHisFamMedConHighOthers">
                        </div>
                    </div>

                    <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span>
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-8" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger8">
                    <div class="form-group clearfix">
                      <h3>Have you had prior fertility testing or treatment?</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatYes" id="chckPriorFerTreatYes">
                        <label for="chckPriorFerTreatYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatNo" id="chckPriorFerTreatNo">
                        <label for="chckPriorFerTreatNo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatCioNatInter" id="chckPriorFerTreatCioNatInter">
                        <label for="chckPriorFerTreatCioNatInter">
                          Clomiphene with natural intercourse
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatCioInse" id="chckPriorFerTreatCioInse">
                        <label for="chckPriorFerTreatCioInse">
                          Clomiphene with insemination (IUI)
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatVitFer" id="chckPriorFerTreatVitFer">
                        <label for="chckPriorFerTreatVitFer">
                          In Vitro Fertilization
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatInjMedNatInt" id="chckPriorFerTreatInjMedNatInt">
                        <label for="chckPriorFerTreatInjMedNatInt">
                          Injectable medication with natural intercourse
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatInjMedIns" id="chckPriorFerTreatInjMedIns">
                        <label for="chckPriorFerTreatInjMedIns">
                          Injectable medication with insemination
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatFroEmbrTran" id="chckPriorFerTreatFroEmbrTran">
                        <label for="chckPriorFerTreatFroEmbrTran">
                          Frozen Embryo Transfer
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatHSG" id="chckPriorFerTreatHSG">
                        <label for="chckPriorFerTreatHSG">
                          HSG (Hysterosalpingogram)(Fallopian tube test if there is blockage)
                        </label>
                      </div>
                    </div>
                    <div class="form-group clearfix"> 
                        <div class="form-group">
                          <label for="txtPriorFerTreatOthers">
                            Others
                          </label>
                          <input type="text" class="form-control" name="PriorFerTreatOthers" id="txtPriorFerTreatOthers">
                        </div>
                    </div>
                    <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span>
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-9" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger9">
                    
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