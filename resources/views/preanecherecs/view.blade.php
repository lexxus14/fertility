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
      $strPatientName="";
      ?>
      @foreach($patients as $patient)
      <?php
        $strMainContactPerson = $patient->MainContactPerson;
        $strMainContactNo = $patient->MainContactNo;
        $strMainEmail = $patient->MainEmail;
        $intPatientId=$patient->id;

        if($patient->IsHusbandPatient==1)
        {
          $strPatientName=$patient->HusbandName.' '.$patient->HusbandLastName;
        }
        else
        {
          $strPatientName= $patient->WifeName.' '.$patient->WifeLastName; 
        }

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
    @foreach($docresults as $docresult)
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header">
              <h3 class="card-title">Pre-Anesthesia (Check-up) Record</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <input type="button" value="Add Diagnosis" class="btn btn-success float-left" data-toggle="modal" data-target="#open-modal-diagnosis">
                    </div>
                      <table  class="table table-bordered table-striped">
                        <thead>                  
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Diagnosis</th>
                        </tr>                  
                        </thead>
                        <tbody id="tbody_diag">
                          <?php $intctrDiag = 1;?>
                          @foreach($PreAnePreopDiags as $PreAnePreopDiag)
                          <tr id="R{{$intctrDiag}}">
                            <td class="row-index text-center">
                              <input type="hidden" class="medid" name="DiagnosisId[]" value="{{$PreAnePreopDiag->id}}">
                              <p>{{$intctrDiag}}</p>
                            </td>
                            <td class="text-center">
                              {{$PreAnePreopDiag->description}}
                            </td>
                          </tr>
                          <?php $intctrDiag++; ?>
                          @endforeach 
                        </tbody>                  
                      </table>
                  
                    
                  </div> 
                  <div class="col-md-6">
                    <div class="form-group">
                        <input type="button" value="Add Procedure" class="btn btn-success float-left" data-toggle="modal" data-target="#open-modal-procedure">
                    </div>
                      <table  class="table table-bordered table-striped">
                        <thead>                  
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Procedure</th>
                        </tr>                  
                        </thead>
                        <tbody id="tbody_pro">
                          <?php $intctrPro = 1; ?>
                          @foreach($PreAneProProcs as $PreAneProProc)
                          <tr id="R{{$intctrPro}}">
                            <td class="row-index text-center">
                              <input type="hidden" class="medid" name="ProcedureId[]" value="{{$PreAneProProc->id}}">
                              <p>{{$intctrPro}}</p>
                            </td>
                            <td class="text-center">
                              {{$PreAneProProc->description}}
                            </td>
                            <?php $intctrPro++; ?>
                          </tr>
                          @endforeach  
                        </tbody>                  
                      </table>               
                  </div>  
              </div> 

              <div class="form-group row">
                <div class="col-md-6">
                 <label for="PreAneSurHis">Pre-Anesthetic Surgical History</label>
                 <textarea class="form-control" id="PreAneSurHis" rows="5" name="PreAneSurHis">{{$docresult->PreAneSurHis}}</textarea> 
                </div>
                <div class="col-md-6">
                 <label for="CurTheraphy">Current Therapy</label>
                 <textarea class="form-control" id="CurTheraphy" rows="5" name="CurTheraphy">{{$docresult->CurTheraphy}}</textarea> 
                </div>
              </div>
              <div class="row">                  
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="button" value="Add Vital Sign" class="btn btn-success float-left" data-toggle="modal" data-target="#open-modal-medicine-treatment">   
                
                    <table  class="table table-bordered table-striped">
                      <thead>                  
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Vital Sign</th>
                        <th>Result</th>
                      </tr>                  
                      </thead>
                      <tbody id="tbody">
                        <?php $intctrVS=1; ?>
                        @foreach($PreAneGenInfVitSigns as $PreAneGenInfVitSign)
                        <tr id="R{{$intctrVS}}">
                          <td class="row-index text-center">
                            <input type="hidden" class="medid" name="VitalSignId[]" value="{{$PreAneGenInfVitSign->id}}">
                            <p>{{$intctrVS}}</p>
                          </td>
                          <td class="text-center">
                            {{$PreAneGenInfVitSign->description}}
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" name="VitalSignRes[]" value="{{$PreAneGenInfVitSign->VSResult}}">
                          </td>
                        </tr> 
                        <?php $intctrVS++; ?>
                        @endforeach 
                      </tbody>                  
                    </table>
                  </div>
                </div>
             
                <div class="col-md-2">
                  <h3>Special Risk</h3>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsSpeRisHypertension)
                      <input type="checkbox" name="IsSpeRisHypertension" id="IsSpeRisHypertension" checked>
                      @else
                      <input type="checkbox" name="IsSpeRisHypertension" id="IsSpeRisHypertension">
                      @endif
                      <label for="IsSpeRisHypertension">
                        Hypertension
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsSpeRiBronchialAsthma)
                      <input type="checkbox" name="IsSpeRiBronchialAsthma" id="IsSpeRiBronchialAsthma" checked>
                      @else
                      <input type="checkbox" name="IsSpeRiBronchialAsthma" id="IsSpeRiBronchialAsthma">
                      @endif
                      <label for="IsSpeRiBronchialAsthma">
                        Bronchial Asthma
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsSpeRiCOPD)
                      <input type="checkbox" name="IsSpeRiCOPD" id="IsSpeRiCOPD" checked>
                      @else
                      <input type="checkbox" name="IsSpeRiCOPD" id="IsSpeRiCOPD">
                      @endif
                      <label for="IsSpeRiCOPD">
                        COPD
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsSpeRiObesity)
                      <input type="checkbox" name="IsSpeRiObesity" id="IsSpeRiObesity" checked>
                      @else
                      <input type="checkbox" name="IsSpeRiObesity" id="IsSpeRiObesity">
                      @endif
                      <label for="IsSpeRiObesity">
                        Obesity
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsSpeRiDiaMellitus)
                      <input type="checkbox" name="IsSpeRiDiaMellitus" id="IsSpeRiDiaMellitus" checked>
                      @else
                      <input type="checkbox" name="IsSpeRiDiaMellitus" id="IsSpeRiDiaMellitus">
                      @endif
                      <label for="IsSpeRiDiaMellitus">
                        Diabetes Mellitus
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsSpeRiIscHeaDisease)
                      <input type="checkbox" name="IsSpeRiIscHeaDisease" id="IsSpeRiIscHeaDisease" checked>
                      @else
                      <input type="checkbox" name="IsSpeRiIscHeaDisease" id="IsSpeRiIscHeaDisease">
                      @endif
                      <label for="IsSpeRiIscHeaDisease">
                        Ischemipc Heart Disease
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsSpeRiAlcHistory)
                      <input type="checkbox" name="IsSpeRiAlcHistory" id="IsSpeRiAlcHistory" checked>
                      @else
                      <input type="checkbox" name="IsSpeRiAlcHistory" id="IsSpeRiAlcHistory">
                      @endif
                      <label for="IsSpeRiAlcHistory">
                        Alcohol History
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsSpeRiSmoHistory)
                      <input type="checkbox" name="IsSpeRiSmoHistory" id="IsSpeRiSmoHistory" checked>
                      @else
                      <input type="checkbox" name="IsSpeRiSmoHistory" id="IsSpeRiSmoHistory">
                      @endif
                      <label for="IsSpeRiSmoHistory">
                        Smoking History
                      </label>
                    </div>                   
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Others" class="col-form-label">Others</label>
                    <textarea class="form-control" name="Others" id="Others">{{$docresult->Others}}</textarea>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <h3>Airway (Mallampati) Score</h3>

                      <div class="icheck-primary d-inline">
                        @if($docresult->AirwayScore==1)
                        <input type="radio" id="radioPrimary1" name="AirwayScore" value="1" checked>
                        @else
                        <input type="radio" id="radioPrimary1" name="AirwayScore" value="1">
                        @endif
                        <label for="radioPrimary1">
                          I
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        @if($docresult->AirwayScore==2)
                        <input type="radio" id="radioPrimary2" name="AirwayScore" value="2" checked>
                        @else
                        <input type="radio" id="radioPrimary2" name="AirwayScore" value="2">
                        @endif
                        <label for="radioPrimary2">
                          II
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        @if($docresult->AirwayScore==3)
                        <input type="radio" id="radioPrimary3" name="AirwayScore" value="3" checked>
                        @else
                        <input type="radio" id="radioPrimary3" name="AirwayScore" value="3">
                        @endif
                        <label for="radioPrimary3">
                          III
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        @if($docresult->AirwayScore==4)
                        <input type="radio" id="radioPrimary4" name="AirwayScore" value="4" checked>
                        @else
                        <input type="radio" id="radioPrimary4" name="AirwayScore" value="4">
                        @endif
                        <label for="radioPrimary4">
                          IV
                        </label>
                      </div>
                    
                </div>
                <div class="col-md-6">
                  <h3>ASA Score</h3>

                      <div class="icheck-primary d-inline">
                        @if($docresult->AsaScore==1)
                        <input type="radio" id="radioAsaScore" name="AsaScore" value="1" checked>
                        @else
                        <input type="radio" id="radioAsaScore" name="AsaScore" value="1">
                        @endif
                        <label for="radioAsaScore">
                          I
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        @if($docresult->AsaScore==2)
                        <input type="radio" id="radioAsaScore2" name="AsaScore" value="2" checked>
                        @else
                        <input type="radio" id="radioAsaScore2" name="AsaScore" value="2">
                        @endif
                        <label for="radioAsaScore2">
                          II
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        @if($docresult->AsaScore==3)
                        <input type="radio" id="radioAsaScore3" name="AsaScore" value="3" checked>
                        @else
                        <input type="radio" id="radioAsaScore3" name="AsaScore" value="3">
                        @endif
                        <label for="radioAsaScore3">
                          III
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        @if($docresult->AsaScore==4)
                        <input type="radio" id="radioAsaScore4" name="AsaScore" value="4" checked>
                        @else
                        <input type="radio" id="radioAsaScore4" name="AsaScore" value="4">
                        @endif
                        <label for="radioAsaScore4">
                          IV
                        </label>
                      </div>
                    
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <h3>Pre Medication Drugs & Instructions</h3>
                  <textarea class="form-control" name="PreMedDruInsNote" rows="5">{{$docresult->PreMedDruInsNote}}</textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <h3>Anesthesia Plan</h3>
                  <textarea class="form-control" name="AnesthesiaPlan" rows="5">{{$docresult->AnesthesiaPlan}}</textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Anestetist Name:" class="btn btn-success float-right" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="AnesthetistStaffId" id="GivenByStaffid" value="{{$docresult->AnesthetistStaffId}}">
                    <input type="text" class="form-control" id="GivenByStaffName" value="{{$docresult->StaffName}}">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group">
                    <label for="AnesthetistDate">Date</label>
                    <input type="date" name="AnesthetistDate" id="AnesthetistDate" class="form-control" value="{{$docresult->AnesthetistDate}}">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group">
                    <label for="AnesthetistTime">Time</label>
                    <input type="time" name="AnesthetistTime" id="AnesthetistTime" class="form-control" value="{{$docresult->AnesthetistTime}}">
                  </div>
                </div>
              </div>           
           
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    @if(is_file(public_path($docresult->filelink)))
                    <a href="{{asset($docresult->filelink)}}" target="_blank">Existing File...</a>
                    @endif
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <a href="{{route('PreAneCheRecs')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                  <a href="{{route('PrintPreAneCheRecs')}}/{{$docId}}" target="_blank" class="btn btn-secondary float-right">Print</a>
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
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example1').DataTable({
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


<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

@endsection