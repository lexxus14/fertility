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
        <input type="hidden" name="FreshFormId" value="{{$DocId}}">
        @foreach($docresults as $docresult)
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Long Protocol</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsConsent==1)
                      <input type="checkbox" name="IsConsent" checked id="chkConcent">
                      @else
                      <input type="checkbox" name="IsConsent" id="chkConcent">
                      @endif
                      <label for="chkConcent">
                        Consent
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->CBC==1)
                      <input type="checkbox" name="CBC" checked id="CBC">
                      @else
                      <input type="checkbox" name="CBC" id="CBC">
                      @endif
                      <label for="CBC">
                        CBC
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsWallace==1)
                      <input type="checkbox" name="IsWallace" checked id="IsWallace">
                      @else
                      <input type="checkbox" name="IsWallace" id="IsWallace">
                      @endif
                      <label for="IsWallace">
                        Wallace
                      </label>
                    </div>
                    
                  </div>
                </div>
                <div class="row">
                  <div class="col-2">
                      <div class="form-group">
                        <label>Office</label>
                          <input type="text" class="form-control" name="Office" value="{{$docresult->Office}}" />
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>Retrieval Location</label>
                          <input type="text" class="form-control" name="RetLoc" value="{{$docresult->RetLoc}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>Cryo Sperm Loc</label>
                          <input type="text" class="form-control" name="CrySpermLoc" value="{{$docresult->CrySpermLoc}}"/>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-2">
                      <div class="form-group">
                        <label>IVF</label>
                          <input type="text" class="form-control" name="IVF" value="{{$docresult->IVF}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>Ovum Donor</label>
                          <input type="text" class="form-control" name="OvDonor" value="{{$docresult->OvDonor}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>IVF w/ Surrugate</label>
                          <input type="text" class="form-control" name="IVFwSur" value="{{$docresult->IVFwSur}}"/>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-2">
                      <div class="form-group">
                        <label>Lupron Start Date</label>
                          <input type="date" class="form-control" name="LupronStartDate" value="{{$docresult->LupronStartDate}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>CD2</label>
                          <input type="date" class="form-control" name="CD2" value="{{$docresult->CD2}}"/>
                      </div>
                  </div>
                  
                </div>

                <div class="row">
                  <div class="col-2">
                      <div class="form-group">
                        <label>FSH</label>
                          <input type="text" class="form-control" name="FSH" value="{{$docresult->FSH}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>Estradiol</label>
                          <input type="text" class="form-control" name="LongEstradiol" value="{{$docresult->LongEstradiol}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>AMH</label>
                          <input type="text" class="form-control" name="AMH" value="{{$docresult->AMH}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>Date</label>
                          <input type="date" class="form-control" name="LongProcDate" value="{{$docresult->LongProcDate}}"/>
                      </div>
                  </div>
                  
                </div>

                <div class="row">
                  <div class="col-2">
                      <div class="form-group">
                        <label>Uterine Position</label>
                          <input type="text" class="form-control" name="UterinePosition" value="{{$docresult->UterinePosition}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>Measurement</label>
                          <input type="number" class="form-control" name="Measurement" placeholder="mm" value="{{$docresult->Measurement}}" />
                      </div>
                  </div>               
                  
                </div>
                <hr>
                <div class="row">
                  <div class="col-6">
                  <!-- /.card-header -->
                      <!-- <table id="example1" class="table table-bordered table-striped"> -->
                      <table  class="table table-bordered table-striped">
                        <thead>                  
                        <tr>
                          <th>#</th>
                          <th>Diagnosis</th>
                        </tr>                  
                        </thead>
                        <tbody id="tbody">
                          <?php $intctrDiag=1; ?>
                          @foreach($DiagnosisSubs as $DiagnosisSub)
                         <tr>
                            <td class="row-index text-center">
                            <input type="hidden"  name="DiagnosisID[]" value="{{$DiagnosisSub->id}}">
                              <p>{{$intctrDiag}}</p>
                            </td>
                            <td class="text-center">
                            {{$DiagnosisSub->description}}
                            </td>
                          </tr> 
                          <?php $intctrDiag++; ?>                       
                          @endforeach
                        </tbody>                  
                      </table>
                  <!-- /.card-body -->
                    
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>Protocol</label>
                      <input type="text" class="form-control" name="Protocol" value="{{$docresult->Protocol}}">
                    </div>
                  </div>
                  
                  <div class="col-4">
                    <div class="form-group">
                      <label>CD1 Estradiol</label>
                      <input type="text" class="form-control" name="CD1Estradiol" value="{{$docresult->CD1Estradiol}}">
                    </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>CD1 Prolactin</label>
                          <input type="text" class="form-control" name="CD1Prolactin" value="{{$docresult->CD1Prolactin}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>CD9 Prolactin</label>
                          <input type="text" class="form-control" name="CD9Prolactin" value="{{$docresult->CD9Prolactin}}"/>
                      </div>
                  </div>
                </div>
                <hr>   
                <div class="row">
                  <div class="col-12">
                  <!-- /.card-header -->
                      <!-- <table id="example1" class="table table-bordered table-striped"> -->
                      <table  class="table table-bordered table-striped">
                        <thead>                  
                        <tr>
                          <th>CD No</th>
                          <th>Date</th>
                          <th>Ultrasound</th>
                          <th>Lining</th>
                          <th>Estradiol</th>
                          <th>Notes</th>
                        </tr>                  
                        </thead>
                        <tbody id="tbody_cd"> 
                          @foreach($FreshFormLongProSubs as $FreshFormLongProSub)
                         <tr>
                          <td class="row-index text-center">
                            <input type="number" class="form-control" name="CDNo[]" value="{{$FreshFormLongProSub->CycleNo}}">
                          </td>
                          <td class="text-center">
                            <input type="date" class="form-control" name="CDDate[]" value="{{$FreshFormLongProSub->CycleDate}}">
                          </td>
                          <td class="text-center">
                            <div class="form-group row">
                              <label for="rt" class="col-sm-2 col-form-label">RT</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="rt" name="RT[]" value="{{$FreshFormLongProSub->UltrasoundRT}}" placeholder="RT">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="lt" class="col-sm-2 col-form-label">LT</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="lt" name="LT[]" value="{{$FreshFormLongProSub->UltrasoundLT}}" placeholder="LT">
                              </div>
                            </div>
                          </td>        
                          <td class="text-center">
                            <input type="text" class="form-control" name="Lining[]" value="{{$FreshFormLongProSub->Lining}}">
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" name="Estradiol[]" value="{{$FreshFormLongProSub->Estradiol}}">
                          </td>
                          <td class="text-center">
                            <textarea name="Notes[]" class="form-control"> {{$FreshFormLongProSub->Notes}} </textarea>
                          </td>
                          </tr>                         
                          @endforeach
                        </tbody>                  
                      </table>
                  <!-- /.card-body -->
                    
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <div class="form-group">
                          <label>Note</label>
                          <textarea id="inputNoteLead-Edit" name="txtnotes" class="form-control" rows="4"> {{$docresult->Notes}}</textarea>
                        </div>                      
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-2">
                      <div class="form-group">
                        <label>hCG</label>
                          <input type="date" class="form-control" name="HcgDate" value="{{$docresult->HcgDate}}" />
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>Time</label>
                          <input type="time" class="form-control" name="HCGTime" value="{{$docresult->HCGTime}}"/>
                      </div>
                  </div>                  
            

                  <div class="col-2">
                      <div class="form-group">
                        <label>ER</label>
                          <input type="date" class="form-control" name="ERDate" value="{{$docresult->ERDate}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>Time</label>
                          <input type="time" class="form-control" name="ERTime" value="{{$docresult->ERTime}}"/>
                      </div>
                  </div>   
                  <div class="col-2">
                      <div class="form-group">
                        <label>Blood Type</label>
                          <input type="text" class="form-control" name="BloodType" value="{{$docresult->BloodType}}"/>
                      </div>
                  </div>             
                </div>
                <div class="row">
                  <div class="col-2">
                      <div class="form-group">
                        <label>ET Date</label>
                          <input type="date" class="form-control" name="ETDate" value="{{$docresult->ETDate}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>#Embryo</label>
                          <input type="text" class="form-control" name="NoEmbryos" value="{{$docresult->NoEmbryos}}"/>
                      </div>
                  </div>                  
            

                  <div class="col-2">
                      <div class="form-group">
                        <label>#Trans</label>
                          <input type="text" class="form-control" name="NoTrans" value="{{$docresult->NoTrans}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>#Eggs</label>
                          <input type="text" class="form-control" name="NoEggs" value="{{$docresult->NoEggs}}"/>
                      </div>
                  </div>   
                  <div class="col-2">
                      <div class="form-group">
                        <label>#Cryo</label>
                          <input type="text" class="form-control" name="NoCryo" value="{{$docresult->NoCryo}}"/>
                      </div>
                  </div>             
                </div>
                <div class="row">
                  <div class="col-2">
                      <div class="form-group">
                        <label>BETA #1</label>
                          <input type="text" class="form-control" name="BetaNo1" value="{{$docresult->BetaNo1}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>Date</label>
                          <input type="date" class="form-control" name="Beta1Date" value="{{$docresult->Beta1Date}}"/>
                      </div>
                  </div>                  
            

                  <div class="col-2">
                      <div class="form-group">
                        <label>BETA #1s</label>
                          <input type="text" class="form-control" name="BetNo2" value="{{$docresult->BetNo2}}"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>Date</label>
                          <input type="date" class="form-control" name="Beta2Date" value="{{$docresult->Beta2Date}}"/>
                      </div>
                  </div>   
                  <div class="col-2">
                      <div class="form-group">
                        <label>P4</label>
                          <input type="text" class="form-control" name="P4" value="{{$docresult->P4}}"/>
                      </div>
                  </div>             
                </div>
                <hr>   
                <div class="row">
                  <div class="col-12">
                  <!-- /.card-header -->
                      <!-- <table id="example1" class="table table-bordered table-striped"> -->
                      <table  class="table table-bordered table-striped">
                        <thead>                  
                        <tr>
                          <th></th>
                          <th></th>
                          <th>Progesteron</th>
                          <th># SACS</th>
                          <th># FHT</th>
                          <th>Action</th>
                        </tr>                  
                        </thead>
                        <tbody id="tbody_obus">
                          @foreach($FreshFormLongProgs as $FreshFormLongProg)
                         <tr>
                          <td class="row-index text-center">
                            <div class="form-group row">
                              <label for="lt" class="col-sm-4 col-form-label">OB US#</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="lt" name="OBUSNo[]" value="{{$FreshFormLongProg->OBUSNo}}">
                              </div>
                            </div>
                          
                            
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" name="OBUS[]" value="{{$FreshFormLongProg->OBUS}}">
                          </td>
                          <td class="text-center">
                              <input type="text" class="form-control" name="Progesterone[]" value="{{$FreshFormLongProg->Progesterone}}">
                          </td>        
                          <td class="text-center">
                            <input type="text" class="form-control" name="NoSACS[]" value="{{$FreshFormLongProg->NoSACS}}">
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" name="NoFHT[]" value="{{$FreshFormLongProg->NoFHT}}">
                          </td>
                          </tr> 
                          @endforeach
          
                        </tbody>                  
                      </table>
                  <!-- /.card-body -->
                    
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-4">
                      <div class="form-group">
                        <label>OB/GYN</label>
                          <input type="text" class="form-control" name="ObGyn" value="{{$docresult->ObGyn}}"/>
                      </div>
                  </div>
                  <div class="col-4">
                      <div class="form-group">
                        <label>Tel. No.</label>
                          <input type="text" class="form-control" name="TelNo" value="{{$docresult->TelNo}}"/>
                      </div>
                  </div>   
                  <div class="col-4">
                      <div class="form-group">
                        <label>Address</label>
                          <input type="text" class="form-control" name="Add" value="{{$docresult->Add}}"/>
                      </div>
                  </div> 
                </div>
                <div class="row">
                  <div class="col-12">
                    <a href="{{route('FreshFormLongPro')}}/{{$PhaseId}}" class="btn btn-secondary">Cancel</a>
                  </div>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        @endforeach

     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- DataTables  & Plugins -->
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

  })
 </script> 

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "searching": false,
      "autoWidth": false,
      "ordering": false,
      "paging": false,
      "info": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#example2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    $("#example4").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

    <script >
    $(document).ready(function(){
    var rowIdx = 0;
    var rowIdx_cd = 0;        
    var rowIdx_obus = 0;        
    
    $('#add_cd').click(function(){
      
      $('#tbody_cd').append(`<tr id="RCD${++rowIdx_cd}">
        <td class="row-index text-center">
          <input type="number" class="form-control" name="CDNo[]" value="${rowIdx_cd}">
        </td>
        <td class="text-center">
          <input type="date" class="form-control" name="CDDate[]">
        </td>
        <td class="text-center">
          <div class="form-group row">
            <label for="rt" class="col-sm-2 col-form-label">RT</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="rt" name="RT[]" placeholder="RT">
            </div>
          </div>
          <div class="form-group row">
            <label for="lt" class="col-sm-2 col-form-label">LT</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="lt" name="LT[]" placeholder="LT">
            </div>
          </div>
        </td>        
        <td class="text-center">
          <input type="text" class="form-control" name="Lining[]">
        </td>
        <td class="text-center">
          <input type="text" class="form-control" name="Estradiol[]">
        </td>
        <td class="text-center">
          <textarea name="Notes[]" class="form-control"> </textarea>
        </td>
        <td class="text-center">
          <input type="button" class="btn btn-danger btn-sm remove-cd float-right" value="Remove">
            </i>

          </td>
        </tr>`);
    });

    $('#add_obus').click(function(){
      
      $('#tbody_obus').append(`<tr id="ROBS${++rowIdx_obus}">
        <td class="row-index text-center">
          <div class="form-group row">
            <label for="lt" class="col-sm-4 col-form-label">OB US#</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="lt" name="OBUSNo[]" value="${rowIdx_obus}">
            </div>
          </div>
        
          
        </td>
        <td class="text-center">
          <input type="text" class="form-control" name="OBUS[]">
        </td>
        <td class="text-center">
            <input type="text" class="form-control" name="Progesterone[]">
        </td>        
        <td class="text-center">
          <input type="text" class="form-control" name="NoSACS[]">
        </td>
        <td class="text-center">
          <input type="text" class="form-control" name="NoFHT[]">
        </td>
        <td class="text-center">
          <input type="button" class="btn btn-danger btn-sm remove-obus float-right" value="Remove">
            </i>

          </td>
        </tr>`);
    });

    // jQuery button click event to remove a row.
    $('#tbody_cd').on('click', '.remove-cd', function () {


      // Getting all the rows next to the row
      // containing the clicked button
      var child = $(this).closest('tr').nextAll();

      // Iterating across all the rows
      // obtained to change the index
      child.each(function () {

                  // Getting <tr> id.
                  var id = $(this).attr('id');

                  // Getting the <p> inside the .row-index class.
                  var idx = $(this).children('.row-index').children('p');

                  // Gets the row number from <tr> id.
                  var dig = parseInt(id.substring(3));

                  // Modifying row index.
                  idx.html(`${dig - 1}`);

                  // Modifying row id.
                  $(this).attr('id', `RCD${dig - 1}`);
      });

      // Removing the current row.
      $(this).closest('tr').remove();

      // Decreasing total number of rows by 1.
      rowIdx_cd--;
    });

    // jQuery button click event to remove a row.
    $('#tbody_obus').on('click', '.remove-obus', function () {


      // Getting all the rows next to the row
      // containing the clicked button
      var child = $(this).closest('tr').nextAll();

      // Iterating across all the rows
      // obtained to change the index
      child.each(function () {

                  // Getting <tr> id.
                  var id = $(this).attr('id');

                  // Getting the <p> inside the .row-index class.
                  var idx = $(this).children('.row-index').children('p');

                  // Gets the row number from <tr> id.
                  var dig = parseInt(id.substring(4));

                  // Modifying row index.
                  idx.html(`${dig - 1}`);

                  // Modifying row id.
                  $(this).attr('id', `ROBS${dig - 1}`);
      });

      // Removing the current row.
      $(this).closest('tr').remove();

      // Decreasing total number of rows by 1.
      rowIdx_obus--;
    });

    /* Price List */

    $('.add-medicine-treatment').click(function(){

      var med_id = $(this).val();
      url = '{{route('DoctorDiagnosInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);
            $('#tbody').append(`<tr id="R${++rowIdx}">
              <td class="row-index text-center">
              <input type="hidden"  name="DiagnosisID[]" value="${data.id}">
                <p>${rowIdx}</p>
              </td>
              <td class="text-center">
              ${data.description}
              </td>
              <td class="text-center">
                <input type="button" class="btn btn-danger btn-sm remove-medicine-treatment float-right" value="Remove">
                

                </td>
              </tr>`);
      });

    });


    // jQuery button click event to remove a row.
    $('#tbody').on('click', '.remove-medicine-treatment', function () {

      var med_value = 0;
      var total_amount =0;
      var totalPayableAmount = 0;

      // Getting all the rows next to the row
      // containing the clicked button
      var child = $(this).closest('tr').nextAll();

      // Iterating across all the rows
      // obtained to change the index
      child.each(function () {

                  // Getting <tr> id.
                  var id = $(this).attr('id');

                  // Getting the <p> inside the .row-index class.
                  var idx = $(this).children('.row-index').children('p');

                  // Gets the row number from <tr> id.
                  var dig = parseInt(id.substring(1));

                  // Modifying row index.
                  idx.html(`${dig - 1}`);

                  // Modifying row id.
                  $(this).attr('id', `R${dig - 1}`);
      });

      // Removing the current row.
      $(this).closest('tr').remove();

      // Decreasing total number of rows by 1.
      rowIdx--;
    });

    $('.open-modal-lead-assessment').click(function(data){
      var id = $(this).val();
      $('#patient_id').val(id);
    });

    //display modal form for task editing
    $('.open-modal-lead-assessment-edit').click(function(){
        var task_id = $(this).val();
        // alert(task_id);
        $.get(url  + task_id, function (data) {
            //success data
            console.log(data);
            $('#LeadAssUpdateId').val(data[0].id);

            const d = new Date(data[0].date);
            let text = d.toLocaleDateString();
            $('#lead-date-update-ass').val(text);
            $("#cmbStaff").append("<option value='"+data[0].staffid+"'selected>"+data[0].name +"</option>");
            $("#cmbReason").append("<option value='"+data[0].reasonid+"'selected>"+data[0].description +"</option>");
            $('#inputNoteLead-Edit').text(data[0].notes);
            // $('#task').val(data.task);
            // $('#description').val(data.description);
            // $('#btn-save').val("update");

            // $('#myModal').modal('show');
        }) 

        // $.get(url + '/' + task_id, function (data) {
        //     //success data
        //     var i = 0
        //     for (i = 0, len = data.length; i < len; i++) {
        //         console.log(data[i]);
        //     }
            //console.log(data[1]);

            // $('#task_id').val(data.id);
            // $('#task').val(data.task);
            // $('#description').val(data.description);
            // $('#btn-save').val("update");

            $('#modal-lead-assessment-edit').modal('show');
        })
    });

/* Lead Assessement */


  </script>

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endsection