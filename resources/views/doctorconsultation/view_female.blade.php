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
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger4" aria-controls="test-nlf-5">
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
                @foreach($docresults as $docresult)
                <input type="hidden" name="txtFemaleDoctorConsultationId" value="{{$docresult->id}}">
                <div class="bs-stepper-content">
                  <div id="test-nlf-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger1">
                    <div class="form-group clearfix">
                      <label for="dtDoc">
                          Date
                      </label>
                      <input type="date" name="txtDocDate"  id="dtDoc" value='{{$docresult->docdate}}' class="form-control">                    
                    </div>
                    <div class="form-group clearfix">
                      <h3>Civil Status</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="IsSingle" @if($docresult->IsSingle==1) checked @endif  id="chkCivilStatSingle">
                        <label for="chkCivilStatSingle">
                          Single
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="IsMarried" @if($docresult->IsMarried==1) checked @endif id="chkCivilStatMarried">
                        <label for="chkCivilStatMarried">
                          Married
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="IsDivorced" @if($docresult->IsDivorced==1) checked @endif id="chkCivilStatDivorced">
                        <label for="chkCivilStatDivorced">
                          Divorced
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="IsWidow" @if($docresult->IsWidow==1) checked @endif id="chkCivilStatWidowed">
                        <label for="chkCivilStatWidowed">
                          Widow
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="txtNumberOfChildren">
                        Number of Children
                      </label>
                      <input type="number" class="form-control" name="NoOfChildren" value="{{$docresult->NoOfChildren}}" id="txtNumberOfChildren">                        
                    </div>

                    <div class="form-group clearfix">
                      <h3>Work Status</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="WorkStatusYes" @if($docresult->WorkStatusYes==1) checked @endif  id="chckWorkStatYes">
                        <label for="chckWorkStatYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="WorkStatusNo" @if($docresult->WorkStatusNo==1) checked @endif id="chckWorkStatNo">
                        <label for="chckWorkStatNo">
                          No
                        </label>
                      </div> 
                      <div class="form-group">
                        <label for="txtWorkSpecify">
                          Specify
                        </label>
                        <input type="text" class="form-control" name="WorkStatusSpecify" value="{{$docresult->WorkStatusSpecify}}" id="txtWorkSpecify">
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Alcohol Intake</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="AlcoholIntakeYes" @if($docresult->AlcoholIntakeYes==1) checked @endif id="chckAlcoholInYes">
                        <label for="chckAlcoholInYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="AlcoholIntakeNo" @if($docresult->AlcoholIntakeNo==1) checked @endif id="chckAlcoholInNo">
                        <label for="chckAlcoholInNo">
                          No
                        </label>
                      </div> 
                      <div class="form-group">
                        <label for="txtAlcoholSpecify">
                          Specify
                        </label>
                        <input type="text" class="form-control" name="AlcoholIntakeSpecify" value="{{$docresult->AlcoholIntakeSpecify}}" id="txtAlcoholSpecify">
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Smoking</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SmokingYes" @if($docresult->SmokingYes==1) checked @endif  id="chckSmokingYes">
                        <label for="chckSmokingYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SmokingNo" @if($docresult->SmokingNo==1) checked @endif id="chckSmokingNo">
                        <label for="chckSmokingNo">
                          No
                        </label>
                      </div> 
                      <div class="form-group">
                        <label for="txtSmokingSpecify">
                          Specify
                        </label>
                        <input type="text" class="form-control" name="SmokingSpecify" value="{{$docresult->SmokingSpecify}}" id="txtSmokingSpecify">
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Substance Abuse</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SubstanceYes" @if($docresult->SubstanceYes==1) checked @endif id="chckSubAbuYes">
                        <label for="chckSubAbuYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SubstanceNo" @if($docresult->SubstanceNo==1) checked @endif id="chckSubAbuNo">
                        <label for="chckSubAbuNo">
                          No
                        </label>
                      </div> 
                      <div class="form-group">
                        <label for="txtSubAbuSpecify">
                          Specify
                        </label>
                        <input type="text" class="form-control" name="SubstanceSpecify" value="{{$docresult->SubstanceSpecify}}" id="txtSubAbuSpecify">
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
                      <input type="date"  id="dtMenstrualPeriod" name="LastMenstualPeriod" value="{{$docresult->LastMenstualPeriod}}" class="form-control">                          
                      <div class="form-group">
                        <label for="txtMenstrualSpecify">
                          Specify
                        </label>
                        <input type="text" class="form-control" name="LastMenstualPeriodSpecify" value="{{$docresult->LastMenstualPeriodSpecify}}" id="txtMenstrualSpecify">
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <h3>Pregnant</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PregnantYes" @if($docresult->PregnantYes==1) checked @endif  id="chckPregnantYes">
                        <label for="chckPregnantYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PregnantNo"  @if($docresult->PregnantNo==1) checked @endif  id="chckPregnantNo">
                        <label for="chckPregnantNo">
                          No
                        </label>
                      </div>
                      <div class="form-group">
                        <label for="txtPregnantSpecify">
                          Specify
                        </label>
                        <input type="text" class="form-control" name="PregnantSpecify" value="{{$docresult->PregnantSpecify}}" id="txtPregnantSpecify">
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <h3>Breast Feeding</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="BreastFeedingYes" @if($docresult->BreastFeedingYes==1) checked @endif  id="chckBreastFeedingYes">
                        <label for="chckBreastFeedingYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="BreastFeedingNo" @if($docresult->BreastFeedingNo==1) checked @endif id="chckBreastFeedingNo">
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
                          <input type="text" class="form-control" name="AgeStartPeriod" value="{{$docresult->AgeStartPeriod}}" id="txtStartMensPer">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Are your periods (Check if apply):</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodAbsent" @if($docresult->PeriodAbsent==1) checked @endif id="chckPeriodsAbsent">
                        <label for="chckPeriodsAbsent">
                          Absent
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodRegular" @if($docresult->PeriodRegular==1) checked @endif id="chckPeriodsRegular">
                        <label for="chckPeriodsRegular">
                          Regular
                        </label>
                      </div> 
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodLight" @if($docresult->PeriodLight==1) checked @endif id="chckPeriodsLight">
                        <label for="chckPeriodsLight">
                          Light
                        </label>
                      </div> 
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodHeavy" @if($docresult->PeriodHeavy==1) checked @endif id="chckPeriodsHeavy">
                        <label for="chckPeriodsHeavy">
                          Heavy
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodSpottingBefore" @if($docresult->PeriodSpottingBefore==1) checked @endif id="chckPeriodsSpottingBefPer">
                        <label for="chckPeriodsSpottingBefPer">
                          Spotting before period
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodSpottingBetween" @if($docresult->PeriodSpottingBetween==1) checked @endif id="chckPeriodsSpottingBetPer">
                        <label for="chckPeriodsSpottingBetPer">
                          Spotting between period
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PeriodIrregular" @if($docresult->PeriodIrregular==1) checked @endif  id="chckPeriodsIrregular">
                        <label for="chckPeriodsIrregular">
                          Irregular
                        </label>
                      </div>

                      <div class="form-group">
                        <label for="txtPeriodsYearly">
                          How many periods do you have yearly?
                        </label>
                        <input type="text" class="form-control" name="PeriodIrregularSpecify" value="{{$docresult->PeriodIrregularSpecify}}" id="txtPeriodsYearly">
                      </div>
                      <div class="form-group">
                        <h3>Do you have severe cramping or pelvic pain with your period?</h3>
                        <div class="icheck-success d-inline">
                          <input type="checkbox" name="SevereCrampingYes" @if($docresult->SevereCrampingYes==1) checked @endif id="chckCramPainPeriodYes">
                          <label for="chckCramPainPeriodYes">
                            Yes
                          </label>
                        </div> 
                        <div class="icheck-success d-inline">
                          <input type="checkbox" name="SevereCrampingNo" @if($docresult->SevereCrampingNo==1) checked @endif id="chckCramPainPeriodNo">
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
                          <input type="text" class="form-control" name="SevereCrampingSpecify" value="{{$docresult->SevereCrampingSpecify}}" id="txtCramPainPeriodSpecify">
                        </div>
                    </div>


                    <div class="form-group">
                      <h3>Pain scale score while you are in period 1- 10. (1 is the lowest 10 is the highest)</h3>
                    </div>

                    <div class="form-group clearfix">
                      <img src="{{ asset('dist/img/painscalescore.PNG')}}" alt="Pain Scale Score" style="opacity: .8">
                      <input type="number" class="form-control" name="PainScaleScore" value="{{$docresult->PainScaleScore}}" id="txtPainScaleScore">
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
                              <textarea id="inputNoteLead-Edit" name="PreHisConceivedYear" class="form-control" rows="4">{{$docresult->PreHisConceivedYear}}</textarea>
                            </div>                      
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                            <div class="form-group">
                              <label>How long to conceived</label>
                              <textarea id="inputNoteLead-Edit" name="PreHisLongConceived" class="form-control" rows="4">{{$docresult->PreHisLongConceived}}</textarea>
                            </div>                      
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                            <div class="form-group">
                              <label>Normal Delivery, C-Section, D&C, Miscarriage</label>
                              <textarea id="inputNoteLead-Edit" name="PreHisNorDelCSecMisc" class="form-control" rows="4">{{$docresult->PreHisNorDelCSecMisc}}</textarea>
                            </div>                      
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                            <div class="form-group">
                              <label>Fertility treatment used.</label>
                              <textarea id="inputNoteLead-Edit" name="PreHisFerTreaUsed" class="form-control" rows="4">{{$docresult->PreHisFerTreaUsed}}</textarea>
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
                        <input type="checkbox" name="SexHisCountOvuKitYes"  @if($docresult->SexHisCountOvuKitYes==1) checked @endif id="chckSexHisCountOvuKitYes">
                        <label for="chckSexHisCountOvuKitYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisCountOvuKitNo" @if($docresult->SexHisCountOvuKitNo==1) checked @endif id="chckSexHisCountOvuKitNo">
                        <label for="chckSexHisCountOvuKitNo">
                          No
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Do  you have any pain with intercourse</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisPainInterYes" @if($docresult->SexHisCountOvuKitNo==1) checked @endif id="chckSexHisPainInterYes">
                        <label for="chckSexHisPainInterYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisPainInterNo" @if($docresult->SexHisPainInterNo==1) checked @endif id="chckSexHisPainInterNo">
                        <label for="chckSexHisPainInterNo">
                          No
                        </label>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Have you ever used contraceptives</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisUseContraceptiveYes" @if($docresult->SexHisUseContraceptiveYes==1) checked @endif id="chckSexHisUseContraceptiveYes">
                        <label for="chckSexHisUseContraceptiveYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisUseContraceptiveNo" @if($docresult->SexHisUseContraceptiveNo==1) checked @endif id="chckSexHisUseContraceptiveNo">
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
                          <input type="text" class="form-control" name="SexHisUseContraceptiveSpecify" value="{{$docresult->SexHisUseContraceptiveSpecify}}" id="txtSexHisUseContraceptiveSpecify">
                        </div>
                    </div>                   

                    <div class="form-group clearfix">
                      <h3>Have you ever had any following sexually transmitted disease or pelvic pain. (Check all that apply)?</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisChlamydia" @if($docresult->SexHisChlamydia==1) checked @endif id="chckSexHisChlamydia">
                        <label for="chckSexHisChlamydia">
                          Chlamydia
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisGonorrhea" @if($docresult->SexHisGonorrhea==1) checked @endif id="chckSexHisGonorrhea">
                        <label for="chckSexHisGonorrhea">
                          Gonorrhea
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisSyphilis" @if($docresult->SexHisSyphilis==1) checked @endif id="chkSexHisSyphilis">
                        <label for="chkSexHisSyphilis">
                          Syphilis
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisGenitalWartsHPV" @if($docresult->SexHisGenitalWartsHPV==1) checked @endif id="chkSexHisGenitalWartsHPV">
                        <label for="chkSexHisGenitalWartsHPV">
                          Genital Warts / HPV
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisHepatitis" @if($docresult->SexHisHepatitis==1) checked @endif id="chkSexHisHepatitis">
                        <label for="chkSexHisHepatitis">
                          Hepatitis
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisHerpes" @if($docresult->SexHisHerpes==1) checked @endif id="chkSexHisHerpes">
                        <label for="chkSexHisHerpes">
                          Herpes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisHIVAIDS" @if($docresult->SexHisHIVAIDS==1) checked @endif id="chkSexHisHIVAIDS">
                        <label for="chkSexHisHIVAIDS">
                          HIV/AIDS
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisPID" @if($docresult->SexHisPID==1) checked @endif  id="chkSexHisPID">
                        <label for="chkSexHisPID">
                          PID (Pelvic Inflammatory Disease)
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SexHisUTI" @if($docresult->SexHisUTI==1) checked @endif  id="chkSexHisUTI">
                        <label for="chkSexHisUTI">
                          UTI
                        </label>
                      </div>                        
                    </div>
                    <div class="form-group">
                      <label for="chkSexHiTransmittedDeasesSpecify">
                          Other
                      </label>
                      <input type="text" name="SexHiTransmittedDeasesSpecify" value="{{$docresult->SexHiTransmittedDeasesSpecify}}" id="chkSexHiTransmittedDeasesSpecify" class="form-control">
                        
                    </div>

                    <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span>
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-5" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger5">
                    
                    <div class="form-group clearfix">
                      <h3>Do you have any current, chronic medical conditions (Diabetes, High Blood Pressure, ect.)?</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisChroMedConYes" @if($docresult->MedHisChroMedConYes==1) checked @endif  id="chckMedHisChroMedConYes">
                        <label for="chckMedHisChroMedConYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedHisChroMedConNo" @if($docresult->MedHisChroMedConNo==1) checked @endif id="chckMedHisChroMedConNo">
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
                          <input type="text" class="form-control" name="MedHisChroMedConSpecify" value="{{$docresult->MedHisChroMedConSpecify}}" id="txtMedHisChroMedConSpecify">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Are you currently taking any over the counter or herbal medications?</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="InMedicationYes" @if($docresult->InMedicationYes==1) checked @endif id="chckInMedicationYes">
                        <label for="chckInMedicationYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="InMedicationNo" @if($docresult->InMedicationNo==1) checked @endif id="chckInMedicationNo">
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
                          <input type="text" class="form-control" name="InMedicationSpecify" value="{{$docresult->InMedicationSpecify}}" id="txtInMedicationSpecify">
                        </div>
                    </div> 

                    <div class="form-group clearfix">
                      <h3>Aspirin intake (within the last 10 days).</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="IntakeAspirinYes" @if($docresult->IntakeAspirinYes==1) checked @endif id="chckIntakeAspirinYes">
                        <label for="chckIntakeAspirinYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="IntakeAspirinNo" @if($docresult->IntakeAspirinNo==1) checked @endif id="chckIntakeAspirinNo">
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
                          <input type="text" class="form-control" name="IntakeAspirinSpecify" value="{{$docresult->IntakeAspirinSpecify}}" id="txtIntakeAspirinSpecify">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Allergies in food.</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="FoodAllergyYes" @if($docresult->FoodAllergyYes==1) checked @endif  id="chckFoodAllergyYes">
                        <label for="chckFoodAllergyYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="FoodAllergyNo" @if($docresult->FoodAllergyNo==1) checked @endif id="chckFoodAllergyNo">
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
                          <input type="text" class="form-control" name="FoodAllergySpecify" value="{{$docresult->FoodAllergySpecify}}" id="txtFoodAllergySpecify">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Allergies in any Medication.</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedAllergyYes" @if($docresult->MedAllergyYes==1) checked @endif  id="chckMedAllergyYes">
                        <label for="chckMedAllergyYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="MedAllergyNo" @if($docresult->MedAllergyNo==1) checked @endif id="chckMedAllergyNo">
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
                          <input type="text" class="form-control" name="MedAllergySpecify" value="{{$docresult->MedAllergySpecify}}" id="txtMedAllergySpecify">
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
                            <textarea id="inputNoteLead-Edit" name="SurHisSurgery" class="form-control" rows="4">{{$docresult->SurHisSurgery}}</textarea>
                          </div>                      
                        </div>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                        <label for="dtSurHisSurgeryDate">
                            Date and Year of Surgery
                        </label>
                      <input type="date" name="SurHisSurgeryDate" value="{{$docresult->SurHisSurgeryDate}}" id="dtSurHisSurgeryDate" class="form-control">  
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <div class="form-group">
                            <label>Complication.</label>
                            <textarea id="inputNoteLead-Edit" name="SurHisComplication" class="form-control" rows="4">{{$docresult->SurHisComplication}}</textarea>
                          </div>                      
                        </div>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <h3>Do you have any problem with Anesthesia.</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SurHisProbAnesthesiaYes" @if($docresult->SurHisProbAnesthesiaYes==1) checked @endif  id="chckSurHisProbAnesthesiaYes">
                        <label for="chckSurHisProbAnesthesiaYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="SurHisProbAnesthesiaNo" @if($docresult->SurHisProbAnesthesiaNo==1) checked @endif id="chckSurHisProbAnesthesiaNoo">
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
                          <input type="text" class="form-control" name="SurHisProbAnesthesiaSpecify" value="{{$docresult->SurHisProbAnesthesiaSpecify}}" id="txtSurHisProbAnesthesiaSpecify">
                        </div>
                    </div>

                    <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span>
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-7" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger7">
                    
                    <div class="form-group clearfix">
                      <h3>Does any in your family have a history of medical condition.</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="FamHisFamMedConDiabetesMellitus" @if($docresult->FamHisFamMedConDiabetesMellitus==1) checked @endif id="chckFamHisFamMedConDiabetesMellitus">
                        <label for="chckFamHisFamMedConDiabetesMellitus">
                          Diabetes Mellitus
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="FamHisFamMedConHighBlood" @if($docresult->FamHisFamMedConHighBlood==1) checked @endif id="chckFamHisFamMedConHighBlood">
                        <label for="chckFamHisFamMedConHighBlood">
                          High Blood
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="FamHisFamMedConCancer" @if($docresult->FamHisFamMedConCancer==1) checked @endif id="chckFamHisFamMedCancer">
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
                          <input type="text" class="form-control" name="FamHisFamMedConHighOthers" value="{{$docresult->FamHisFamMedConHighOthers}}" id="txtFamHisFamMedConHighOthers">
                        </div>
                    </div>

                    <span class="btn btn-primary" onclick="stepper3.previous()">Previous</span>
                    <span class="btn btn-primary" onclick="stepper3.next()">Next</span>
                  </div>

                  <div id="test-nlf-8" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger8">
                    <div class="form-group clearfix">
                      <h3>Have you had prior fertility testing or treatment?</h3>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatYes" @if($docresult->PriorFerTreatYes==1) checked @endif id="chckPriorFerTreatYes">
                        <label for="chckPriorFerTreatYes">
                          Yes
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatNo" @if($docresult->PriorFerTreatNo==1) checked @endif id="chckPriorFerTreatNo">
                        <label for="chckPriorFerTreatNo">
                          No
                        </label>
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatCioNatInter" @if($docresult->PriorFerTreatCioNatInter==1) checked @endif id="chckPriorFerTreatCioNatInter">
                        <label for="chckPriorFerTreatCioNatInter">
                          Clomiphene with natural intercourse
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatCioInse" @if($docresult->PriorFerTreatCioInse==1) checked @endif id="chckPriorFerTreatCioInse">
                        <label for="chckPriorFerTreatCioInse">
                          Clomiphene with insemination (IUI)
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatVitFer" @if($docresult->PriorFerTreatVitFer==1) checked @endif id="chckPriorFerTreatVitFer">
                        <label for="chckPriorFerTreatVitFer">
                          In Vitro Fertilization
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatInjMedNatInt" @if($docresult->PriorFerTreatInjMedNatInt==1) checked @endif id="chckPriorFerTreatInjMedNatInt">
                        <label for="chckPriorFerTreatInjMedNatInt">
                          Injectable medication with natural intercourse
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatInjMedIns" @if($docresult->PriorFerTreatInjMedIns==1) checked @endif id="chckPriorFerTreatInjMedIns">
                        <label for="chckPriorFerTreatInjMedIns">
                          Injectable medication with insemination
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatFroEmbrTran" @if($docresult->PriorFerTreatFroEmbrTran==1) checked @endif id="chckPriorFerTreatFroEmbrTran">
                        <label for="chckPriorFerTreatFroEmbrTran">
                          Frozen Embryo Transfer
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        <input type="checkbox" name="PriorFerTreatHSG" @if($docresult->PriorFerTreatHSG==1) checked @endif id="chckPriorFerTreatHSG">
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
                          <input type="text" class="form-control" name="PriorFerTreatOthers" value="{{$docresult->PriorFerTreatOthers}}" id="txtPriorFerTreatOthers">
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
                              <textarea id="inputNoteLead-Edit" name="Notes" class="form-control" rows="4">{{$docresult->Notes}}</textarea>
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
                            <br>
                            <p>FILE: <a href="{{url('/')}}/{{$docresult->filelink}}" target="_blank">{{$docresult->filelink}} </a></p>                            
                          </div>
                          <br>                          
                        </div>
                      </div>
                    </div>

                    <span class="btn btn-primary mt-5" onclick="stepper3.previous()">Previous</span>
                    <!-- <button type="submit" class="btn btn-primary mt-5">Submit</button> --> 
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
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