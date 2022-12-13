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
              <h3 class="card-title">Post Operation/Procedure Notes</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group row">
                  <div class="col-md-2">
                    <label for="docdate" class="col-form-label">Date</label>
                    <input type="date" class="form-control" id="docdate" name="docdate" value="{{$docresult->docdate}}" />
                  </div>
                  <div class="col-md-2">
                    <label for="docTime" class="col-form-label">Time</label>
                    <input type="time" class="form-control" id="docTime" name="docTime"  value="{{$docresult->docTime}}"/>
                  </div>
              </div>
 
              <div class="row">
                <div class="col-12">
                <!-- /.card-header -->
                    <!-- <table id="example1" class="table table-bordered table-striped"> -->
                    <table  class="table table-bordered table-striped">
                      <thead>                  
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Pre Diagnosis</th>
                        <th style="width: 40px">Action</th>
                      </tr>                  
                      </thead>
                      <tbody id="tbody">
                        <?php $intctr=1 ?>
                        @foreach($PreOpDiagnosis as $PreOpDiagnosi)
                       <tr id="R{{$intctr}}">
                          <td class="row-index text-center">
                            <input type="hidden" class="medid" name="PreDiagnosisId[]" value="{{$PreOpDiagnosi->id}}">
                            <p>{{$intctr}}</p>
                          </td>
                          <td class="text-center">
                            {{$PreOpDiagnosi->description}}
                          </td>
                          <td class="text-center">
                            <input type="button" class="btn btn-danger btn-sm remove-medicine-treatment float-right" value="Remove">
                          </td>
                        </tr>
                        <?php $intctr++; ?>
                        @endforeach  
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                <!-- /.card-header -->
                    <!-- <table id="example1" class="table table-bordered table-striped"> -->
                    <table  class="table table-bordered table-striped">
                      <thead>                  
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Procedure</th>
                        <th style="width: 40px">Action</th>
                      </tr>                  
                      </thead>
                      <tbody id="tbody_pro">
                        <?php $intctr2=1; ?>
                        @foreach($PreOpProcedures as $PreOpProcedure)
                        <tr id="R{{$intctr2}}">
                          <td class="row-index text-center">
                            <input type="hidden" class="medid" name="ProcedureId[]" value="{{$PreOpProcedure->id}}">
                            <p>{{$intctr2}}</p>
                          </td>
                          <td class="text-center">
                            {{$PreOpProcedure->description}}
                          </td>
                          <td class="text-center">
                            <input type="button" class="btn btn-danger btn-sm remove-procedure float-right" value="Remove">                           
                          </td>
                        </tr> 
                        <?php $intctr2++; ?>
                        @endforeach                   
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>
   
              <div class="row">
                <div class="col-12">
                <!-- /.card-header -->
                    <!-- <table id="example1" class="table table-bordered table-striped"> -->
                    <table  class="table table-bordered table-striped">
                      <thead>                  
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Findings/Post-Op Diagnosis</th>
                        <th style="width: 40px">Action</th>
                      </tr>                  
                      </thead>
                      <tbody id="tbody_findings">
                        <?php $intctr3=1; ?>
                        @foreach($FindingPostOpDiags as $FindingPostOpDiag)
                        <tr id="R{{$intctr3}}">
                          <td class="row-index text-center">
                            <input type="hidden" class="medid" name="FindingDiagnosisId[]" value="{{$FindingPostOpDiag->id}}">
                            <p>{{$intctr3}}</p>
                          </td>
                          <td class="text-center">
                            {{$FindingPostOpDiag->description}}
                          </td>
                          <td class="text-center">
                            <input type="button" class="btn btn-danger btn-sm remove-findings float-right" value="Remove">
                          </td>
                        </tr> 
                        <?php $intctr3++; ?>
                        @endforeach
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>

              <div class="row">                
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="SurgeonPerformingMD" class="col-form-label">Surgeon/Performing MD</label>
                    <input type="text" class="form-control" id="SurgeonPerformingMD" name="SurgeonPerformingMD" value="{{$docresult->SurgeonPerformingMD}}">  
                  </div>                  
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Anesthesiologist" class="col-form-label">Anesthesiologist</label>
                    <input type="text" class="form-control" id="Anesthesiologist" name="Anesthesiologist" value="{{$docresult->Anesthesiologist}}"> 
                  </div>                  
                </div> 
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="AnesthesiaUsed" class="col-form-label">Anesthesia Used</label>
                    <input type="text" class="form-control" id="AnesthesiaUsed" name="AnesthesiaUsed" value="{{$docresult->AnesthesiaUsed}}"> 
                  </div>                  
                </div>               
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Specimens" class="col-form-label">Specimens</label>
                    <input type="text" class="form-control" id="Specimens" name="Specimens" value="{{$docresult->Specimens}}">  
                  </div>                  
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Drains" class="col-form-label">Drains</label>
                    <input type="text" class="form-control" id="Drains" name="Drains" value="{{$docresult->Drains}}"> 
                  </div>                  
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="EstBloodLoss" class="col-form-label">Est. Blood Loss</label>
                    <input type="text" class="form-control" id="EstBloodLoss" name="EstBloodLoss" value="{{$docresult->EstBloodLoss}}"> 
                  </div>                  
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="Complications" class="col-form-label">Complications</label>
                    <textarea class="form-control" name="Complications" id="Complications">{{$docresult->Complications}}</textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  Conditions:
                </div>
              </div>

              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsConStable==1)
                      <input type="checkbox" name="IsConStable" id="IsConStable" checked>
                      @else
                      <input type="checkbox" name="IsConStable" id="IsConStable">
                      @endif
                      <label for="IsConStable">
                        Stable
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsConGuarded==1)
                      <input type="checkbox" name="IsConGuarded" id="IsConGuarded" checked>
                      @else
                      <input type="checkbox" name="IsConGuarded" id="IsConGuarded">
                      @endif
                      <label for="IsConGuarded">
                        Guarded
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsConCritical==1)
                      <input type="checkbox" name="IsConCritical" id="IsConCritical" checked>
                      @else
                      <input type="checkbox" name="IsConCritical" id="IsConCritical">
                      @endif
                      <label for="IsConCritical">
                        Critical
                      </label>
                    </div>                   
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label for="ConOthers" class="col-form-label">Others</label>
                    <textarea class="form-control" name="ConOthers" id="ConOthers">{{$docresult->ConOthers}}</textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="Notes" class="col-form-label">Notes</label>
                    <textarea class="form-control" name="Notes" id="Notes">{{$docresult->Notes}}</textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputFile">File</label>
                    <div class="input-group">
                      
                    </div>
                    <br/>
                    @if(is_file(public_path($docresult->filelink)))
                    <a href="{{$docresult->filelink}}" target="_blank">Existing File..</a>
                    @endif
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <a href="{{route('PostOpPostProcNotes')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                  <a href="{{route('PrintPostOpPostProcNotes')}}/{{$docId}}" target="_blank" class="btn btn-secondary float-right">Print</a>
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