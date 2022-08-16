@extends('layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <!-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div> -->
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the report to test.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> PRC FERTILIY.
                    <small class="float-right">Date: <?php echo date('d-m-Y');?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              @foreach($patients as $patient)
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
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
            	<div class="col-sm-4 invoice-col">
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

              <div class="row">
                <div class="col-12">
                  <hr>
                  <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Results.
                  </h4>
                  <br>
                  <h5>
                    <i></i> Result
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Doctor</th>
                      <th>Nurse</th>
                      <th>Result</th>
                      <th>Notes</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($patientresults as $patientresult)
                    <tr>
                      <td>{{$patientresult->id}}</td>
                      <td>{{$patientresult->Date}}</td>
                      <td>{{$patientresult->Doctor}}</td>
                      <td>{{$patientresult->Nurse}}</td>
                      <td>{{$patientresult->Result}}</td>
                      <td>{{$patientresult->Notes}}</td>
                      <td><a href="{{url('/')}}/{{$patientresult->FileLink}}" target="_blank">View</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-12">
                  <hr>
                  <h4>
                    <i class="fas fa-user-plus"></i> Patient Files
                  </h4>
                  <br>
                  <h5>
                    <i></i> Document
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Document</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($docresults as $docresult)
                    <tr>
                      <td>{{$docresult->id}}</td>
                      <td>{{$docresult->docdate}}</td>
                      <td>{{$docresult->description}}</td>
                      <td>{{$docresult->notes}}</td>
                      <td><a href="{{url('/')}}/{{$docresult->filelink}}" target="_blank">View</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
<!--                   <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Files.
                  </h4> -->
                  <br>
                  <h5>
                    <i></i> Lab Investigation
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Lab Investigation</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($labinvs as $labinv)
                    <tr>
                      <td>{{$labinv->id}}</td>
                      <td>{{$labinv->docdate}}</td>
                      <td>{{$labinv->description}}</td>
                      <td>{{$labinv->notes}}</td>
                      <td><a href="{{url('/')}}/{{$labinv->filelink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
<!--                   <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Files.
                  </h4> -->
                  <br>
                  <h5>
                    <i></i> Doctor's Notes
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Doctor Notes</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($docnotes as $docnote)
                    <tr>
                      <td>{{$docnote->id}}}</td>
                      <td>{{$docnote->docdate}}}</td>
                      <td>{{$docnote->description}}</td>
                      <td>{{$docnote->notes}}</td>
                      <td><a href="{{url('/')}}/{{$docnote->filelink}}" target="_blank">View</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
<!--                   <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Files.
                  </h4> -->
                  <br>
                  <h5>
                    <i></i> History Assessment
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>History Assessment</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($historyassessments as $historyassessment)
                    <tr>
                      <td>{{$historyassessment->id}}</td>
                      <td>{{$historyassessment->docdate}}</td>
                      <td>{{$historyassessment->description}}</td>
                      <td>{{$historyassessment->notes}}</td>
                      <td><a href="{{url('/')}}/{{$historyassessment->filelink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->


              <div class="row">
                <div class="col-12">
                  <hr>
<!--                   <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Files.
                  </h4> -->
                  <br>
                  <h5>
                    <i></i> Pathology / X-Ray
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Pathology / X-Ray</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($pathologyxrays as $pathologyxray)
                    <tr>
                      <td>{{$pathologyxray->id}}</td>
                      <td>{{$pathologyxray->docdate}}</td>
                      <td>{{$pathologyxray->description}}</td>
                      <td>{{$pathologyxray->notes}}</td>
                      <td><a href="{{url('/')}}/{{$pathologyxray->filelink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
                  <h4>
                    <i class="fas fa-user-plus"></i> In-Patient.
                  </h4>
                  <br>
                  <h5>
                    <i></i> Patient Medication
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Medication</th>
                      <th>Notes</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                     @foreach($patientmedications as $patientmedication)
                    <tr>
                      <td>{{$patientmedication->id}}</td>
                      <td>{{$patientmedication->docdate}}</td>
                      <td>{{$patientmedication->description}}</td>
                      <td>{{$patientmedication->notes}}</td>
                      <td><a href="{{url('/')}}/{{$patientmedication->filelink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
<!--                   <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Files.
                  </h4> -->
                  <br>
                  <h5>
                    <i></i> Patient Treatment
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Treament</th>
                      <th>Notes</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($patienttreatments as $patienttreatment)
                    <tr>
                      <td>{{$patienttreatment->id}}</td>
                      <td>{{$patienttreatment->docdate}}</td>
                      <td>{{$patienttreatment->description}}</td>
                      <td>{{$patienttreatment->notes}}</td>
                      <td><a href="{{url('/')}}/{{$patienttreatment->filelink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
<!--                   <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Files.
                  </h4> -->
                  <br>
                  <h5>
                    <i></i> Eggs Collected
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Doctor</th>
                      <th>Nurse</th>
                      <th>Number of Eggs</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($eggscollecteds as $eggscollected)
                    <tr>
                      <td>{{$eggscollected->id}}</td>
                      <td>{{$eggscollected->Date}}</td>
                      <td>{{$eggscollected->Doctor}}</td>
                      <td>{{$eggscollected->Nurse}}</td>
                      <td>{{$eggscollected->EggsCollected}}</td>
                      <td>{{$eggscollected->Notes}}</td>
                      <td><a href="{{url('/')}}/{{$eggscollected->FileLink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
<!--                   <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Files.
                  </h4> -->
                  <br>
                  <h5>
                    <i></i> Eggs Fertilized
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Doctor</th>
                      <th>Nurse</th>
                      <th>Number of Eggs</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($eggsfertilizeds as $eggsfertilized)
                    <tr>
                      <td>{{$eggsfertilized->id}}</td>
                      <td>{{$eggsfertilized->Date}}</td>
                      <td>{{$eggsfertilized->Doctor}}</td>
                      <td>{{$eggsfertilized->Nurse}}</td>
                      <td>{{$eggsfertilized->EggsFertilized}}</td>
                      <td>{{$eggsfertilized->Note}}</td>
                      <td><a href="{{url('/')}}/{{$eggsfertilized->FileLink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
<!--                   <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Files.
                  </h4> -->
                  <br>
                  <h5>
                    <i></i> Good Embryo
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Doctor</th>
                      <th>Nurse</th>
                      <th>Number of Embryo</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($goodembryos as $goodembryos)
                    <tr>
                      <td>{{$goodembryos->id}}</td>
                      <td>{{$goodembryos->Date}}</td>
                      <td>{{$goodembryos->Doctor}}</td>
                      <td>{{$goodembryos->Nurse}}</td>
                      <td>{{$goodembryos->GoodEmbryo}}</td>
                      <td>{{$goodembryos->Notes}}</td>
                      <td><a href="{{url('/')}}/{{$eggsfertilized->FileLink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
<!--                   <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Files.
                  </h4> -->
                  <br>
                  <h5>
                    <i></i> Transferred Embryo
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Doctor</th>
                      <th>Nurse</th>
                      <th>Number of Embryo</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($transferredembryos as $transferredembryo)
                    <tr>
                      <td>{{$transferredembryo->id}}</td>
                      <td>{{$transferredembryo->Date}}</td>
                      <td>{{$transferredembryo->Doctor}}</td>
                      <td>{{$transferredembryo->Nurse}}</td>
                      <td>{{$transferredembryo->TransferredEmbryo}}</td>
                      <td>{{$transferredembryo->Notes}}</td>
                      <td><a href="{{url('/')}}/{{$transferredembryo->FileLink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
<!--                   <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Files.
                  </h4> -->
                  <br>
                  <h5>
                    <i></i> Frozen Embryo
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Doctor</th>
                      <th>Nurse</th>
                      <th>Number of Embryo</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($frozenembryos as $frozenembryo)
                    <tr>
                      <td>{{$frozenembryo->id}}</td>
                      <td>{{$frozenembryo->Date}}</td>
                      <td>{{$frozenembryo->Doctor}}</td>
                      <td>{{$frozenembryo->Nurse}}</td>
                      <td>{{$frozenembryo->FrozenEmbryo}}</td>
                      <td>{{$frozenembryo->Notes}}</td>
                      <td><a href="{{url('/')}}/{{$frozenembryo->FileLink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
<!--                   <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Files.
                  </h4> -->
                  <br>
                  <h5>
                    <i></i> Biopsy Study
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Doctor</th>
                      <th>Nurse</th>
                      <th>Number of Embryo</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($biopsystudys as $biopsystudy)
                    <tr>
                      <td>{{$biopsystudy->id}}</td>
                      <td>{{$biopsystudy->Date}}</td>
                      <td>{{$biopsystudy->Doctor}}</td>
                      <td>{{$biopsystudy->Nurse}}</td>
                      <td>{{$biopsystudy->NumberOfEmbryo}}</td>
                      <td>{{$biopsystudy->Notes}}</td>
                      <td><a href="{{url('/')}}/{{$biopsystudy->FileLink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
<!--                   <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Files.
                  </h4> -->
                  <br>
                  <h5>
                    <i></i> Biopsy Study Result
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Doctor</th>
                      <th>Nurse</th>
                      <th>Normal Embryo</th>
                      <th>Abnormal Embryo</th>
                      <th>Number of Male</th>
                      <th>Number of Female</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($biopsystudyresults as $biopsystudyresult)
                    <tr>
                      <td>{{$biopsystudyresult->id}}</td>
                      <td>{{$biopsystudyresult->Date}}</td>
                      <td>{{$biopsystudyresult->Doctor}}</td>
                      <td>{{$biopsystudyresult->Nurse}}</td>
                      <td>{{$biopsystudyresult->NormalEmbryo}}</td>
                      <td>{{$biopsystudyresult->AbnormalEmbryo}}</td>
                      <td>{{$biopsystudyresult->NumberOfMale}}</td>
                      <td>{{$biopsystudyresult->NumberOfFemale}}</td>
                      <td>{{$biopsystudyresult->Notes}}</td>
                      <td><a href="{{url('/')}}/{{$biopsystudyresult->FileLink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
                  <h4>
                    <i class="fas fa-user-plus"></i> Lead.
                  </h4>
                  <br>
                  <h5>
                    <i></i> Consultation
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Document</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($consultations as $consultation)
                    <tr>
                      <td>{{$consultation->id}}</td>
                      <td>{{$consultation->docdate}}</td>
                      <td>{{$consultation->description}}</td>
                      <td>{{$consultation->notes}}</td>
                      <td><a href="{{url('/')}}/{{$consultation->filelink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  <hr>
<!--                   <h4>
                    <i class="fas fa-pencil-alt"></i> Patient Files.
                  </h4> -->
                  <br>
                  <h5>
                    <i></i> Price List
                  </h5>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Note</th>
                      <th>Attachment</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($pricelists as $pricelist)
                    <tr>
                      <td>{{$pricelist->id}}</td>
                      <td>{{$pricelist->pricelistdate}}</td>
                      <td>{{$pricelist->total_amount}}</td>
                      <td>{{$pricelist->notes}}</td>
                      <td><a href="{{url('/')}}/{{$pricelist->filelink}}" target="_blank">View</a></td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection