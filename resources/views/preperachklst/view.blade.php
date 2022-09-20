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
      <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
      <input type="hidden" name="docId" value="{{$docId}}">
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
              <h3 class="card-title">Preoperative Checklist</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group row">
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Given by:" class="btn btn-success float-right" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="GivenByStaffid" id="GivenByStaffid" value="{{$docresult->GivenByStaffid}}">
                    <input type="text" class="form-control" id="GivenByStaffName" value="{{$docresult->StaffName}}">
                  </div>
                </div>
              </div>
              <div class="form-group row">                
                <div class="col-md-2">
                  <label for="PreOperaDate" class="col-form-label">Date</label>
                  <input type="date" class="form-control" id="PreOperaDate" name="PreOperaDate" value="{{$docresult->PreOperaDate}}"/>
                </div>
                <div class="col-md-2">
                  <label for="PreOperaTime" class="col-form-label">Time</label>
                  <input type="time" class="form-control" id="PreOperaTime" name="PreOperaTime" value="{{$docresult->PreOperaTime}}"/>
                </div>
              </div>
              <div class="form-group row">                
                <div class="col-md-2">
                  <label for="PSurgeryDate" class="col-form-label">Surgery Date</label>
                  <input type="date" class="form-control" id="PSurgeryDate" name="PSurgeryDate" value="{{$docresult->PSurgeryDate}}"/>
                </div>
                <div class="col-md-2">
                  <label for="SurgeryTime" class="col-form-label">Time</label>
                  <input type="time" class="form-control" id="SurgeryTime" name="SurgeryTime" value="{{$docresult->SurgeryTime}}"/>
                </div>
              </div>

              <div class="form-group row">                
                <div class="col-md-2">
                  <label for="ArrivalTime" class="col-form-label">Time to arrive</label>
                  <input type="time" class="form-control" id="ArrivalTime" name="ArrivalTime" value="{{$docresult->ArrivalTime}}"/>
                </div>
                <div class="col-md-10">
                  <label for="NPOInstruction" class="col-form-label">NPO Instruction</label>
                  <input type="text" class="form-control" id="NPOInstruction" name="NPOInstruction" value="{{$docresult->NPOInstruction}}"/>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsNoJewelry==1)
                      <input type="checkbox" name="IsNoJewelry" id="IsNoJewelry" checked>
                      @else
                      <input type="checkbox" name="IsNoJewelry" id="IsNoJewelry">
                      @endif
                      <label for="IsNoJewelry">
                        No Jewelry
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsNoMakeup==1)
                      <input type="checkbox" name="IsNoMakeup" id="IsNoMakeup" checked>
                      @else
                      <input type="checkbox" name="IsNoMakeup" id="IsNoMakeup">
                      @endif
                      <label for="IsNoMakeup">
                        No Makeup
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsNoNailPolish==1)
                      <input type="checkbox" name="IsNoNailPolish" id="IsNoNailPolish" checked>
                      @else
                      <input type="checkbox" name="IsNoNailPolish" id="IsNoNailPolish">
                      @endif
                      <label for="IsNoNailPolish">
                        No Nail Polish
                      </label>
                    </div>                   
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label for="Others" class="col-form-label">Others</label>
                    <textarea class="form-control" name="Others" id="Others">{{$docresult->Others}}</textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <h3>UPON ADMISSION: NURSING ASSESSMENT</h3>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <h3>Patient Identification:&nbsp{{$strPatientName}}</h3>
                  </div>
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
                        <th>Vital Sign</th>
                        <th>Result</th>
                        <th style="width: 40px">Action</th>
                      </tr>                  
                      </thead>
                      <tbody id="tbody">
                        <?php $intctrVS=1 ?>
                        @foreach($PreOpeChkLstVitalSigns as $PreOpeChkLstVitalSign)
                        <tr id="R{{$intctrVS}}">
                          <td class="row-index text-center">
                            <input type="hidden" class="medid" name="VitalSignId[]" value="{{$PreOpeChkLstVitalSign->id}}">
                            <p>{{$intctrVS}}</p>
                          </td>
                          <td class="text-center">
                            {{$PreOpeChkLstVitalSign->description}}
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" name="VitalSignRes[]" value="{{$PreOpeChkLstVitalSign->VitalSignRes}}">
                          </td>
                          <td class="text-center">
                            <input type="button" class="btn btn-danger btn-sm remove-medicine-treatment float-right" value="Remove">
                          </td>
                        </tr> 
                        <?php $intctrVS++; ?>
                        @endforeach                      
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>
              <div class="row">                
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="NpoStatus" class="col-form-label">NPO Status</label>
                    <input type="text" class="form-control" id="NpoStatus" name="NpoStatus" value="{{$docresult->NpoStatus}}">  
                  </div>                  
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Allergy" class="col-form-label">Allergy</label>
                    <input type="text" class="form-control" id="Allergy" name="Allergy" value="{{$docresult->Allergy}}"> 
                  </div>                  
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
                        <?php $intctrP=1;?>
                        @foreach($PreOpProcedures as $PreOpProcedure)
                       <tr id="R{{$intctrP}}">
                        <td class="row-index text-center">
                          <input type="hidden" class="medid" name="ProcedureId[]" value="{{$PreOpProcedure->id}}">
                          <p>{{$intctrP}}</p>
                        </td>
                        <td class="text-center">
                          {{$PreOpProcedure->description}}
                        </td>
                        <td class="text-center">
                          <input type="button" class="btn btn-danger btn-sm remove-procedure float-right" value="Remove">
                          </td>
                        </tr>
                        <?php $intctrP++; ?>
                        @endforeach 
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>
              <div class="row">                
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="HisAndPhy" class="col-form-label">History and Physical</label>
                    <input type="text" class="form-control" id="HisAndPhy" name="HisAndPhy" value="{{$docresult->HisAndPhy}}">  
                  </div>                  
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="InfoConforSur" class="col-form-label">Informed Consent for Surgery</label>
                    <input type="text" class="form-control" id="InfoConforSur" name="InfoConforSur" value="{{$docresult->InfoConforSur}}"> 
                  </div>                  
                </div> 
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="AnesCons" class="col-form-label">Anesthesia Consent</label>
                    <input type="text" class="form-control" id="AnesCons" name="AnesCons" value="{{$docresult->AnesCons}}">
                  </div>                  
                </div>               
              </div>
              <div class="row">                
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="LabReport" class="col-form-label">Lab Reports</label>
                    <input type="text" class="form-control" id="LabReport" name="LabReport" value="{{$docresult->LabReport}}">  
                  </div>                  
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="PreOpMed" class="col-form-label">Pre-Op Medications</label>
                    <input type="text" class="form-control" id="PreOpMed" name="PreOpMed" value="{{$docresult->PreOpMed}}"> 
                  </div>                  
                </div> 
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="VoidedFreely" class="col-form-label">Voided Freely</label>
                    <input type="text" class="form-control" id="VoidedFreely" name="VoidedFreely" value="{{$docresult->VoidedFreely}}"> 
                  </div>                  
                </div>               
              </div>            

              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputFile">File</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="inputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>                      
                    </div>
                    <br/>
                      @if(is_file(public_path($docresult->filelink)))
                      <a href="{{asset($docresult->filelink)}}" target="_blank">Existing File..</a>
                      @endif
                  </div>

                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <a href="{{route('PreOperaCheckList')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
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