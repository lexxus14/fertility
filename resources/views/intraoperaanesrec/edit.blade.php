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
    <?php $imgGraph=""; ?>
    <?php $intctrIntOpe=1; ?>
    @foreach($docresults as $docresult)
   <form action="{{route('IntraOperAnesRecsUpdate')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" id="quickForm" novalidate="">
        {{ csrf_field() }}
        <?php $imgGraph=$docresult->IntOpeAneRecord;  ?>
      <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
      <input type="hidden" name="docId" value="{{$docId}}">
      <input type="hidden" name="IntOpeAneRecord" id="IntOpeAneRecord" value="0">
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
              <h3 class="card-title">Intra-Operative Anesthesia Record</h3>

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
              </div>

              <div class="form-group row">
                <div class="col-md-2">
                  <label for="BP" class="col-form-label">BP</label>
                  <input type="text" name="BP" id="BP" class="form-control" value="{{$docresult->BP}}">
                </div>
                <div class="col-md-2">
                  <label for="PulseRate" class="col-form-label">PulseRate</label>
                  <input type="text" name="PulseRate" id="PulseRate" class="form-control" value="{{$docresult->PulseRate}}">
                </div>
                <div class="col-md-2">
                  <label for="RR" class="col-form-label">R/R</label>
                  <input type="text" name="RR" id="RR" class="form-control" value="{{$docresult->RR}}">
                </div>
                <div class="col-md-2">
                  <label for="Temperature" class="col-form-label">Temperature</label>
                  <input type="text" name="Temperature" id="Temperature" class="form-control" value="{{$docresult->Temperature}}">
                </div>
                <div class="col-md-4">
                  <label for="Allergy" class="col-form-label">Allergy</label>
                  <input type="text" name="Allergy" id="Allergy" class="form-control" value="{{$docresult->Allergy}}">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="IntraOperativeDiags" class="col-form-label">Intra-operative Diagnosis</label>
                  <input type="text" name="IntraOperativeDiags" id="IntraOperativeDiags" class="form-control" value="{{$docresult->IntraOperativeDiags}}">
                </div>
                <div class="col-md-6">
                  <label for="SurgeryName" class="col-form-label">Surgery Name</label>
                  <input type="text" name="SurgeryName" id="SurgeryName" class="form-control" value="{{$docresult->SurgeryName}}">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Surgeon Name:" class="btn btn-success float-right" id="SurgeonName" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="SurgeonStaffId" id="SurgeonStaffId" value="{{$docresult->SurgeonStaffId}}">
                    <input type="text" class="form-control" id="SurgeonStaffName" value="{{$docresult->StaffName}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Asst. Surgeon Name:" class="btn btn-success float-right" id="AsstSurgeonName" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="AsstSurgeonStaffId" id="AsstSurgeonStaffId" value="{{$docresult->AsstSurgeonStaffId}}">
                    <input type="text" class="form-control" id="AsstSurgeonStaffName" value="{{$docresult->AsstSurgeonStaffName}}">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Anesthetist Name:" class="btn btn-success float-right" id="AnesthetistName" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="AnesthetistStaffId" id="AnesthetistStaffId" value="{{$docresult->AnesthetistStaffId}}">
                    <input type="text" class="form-control" id="AnesthetistStaffName" value="{{$docresult->AnesthetistStaffName}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group">  
                    <label for="TypeOfAnesthesia">Type of Anesthesia &nbsp</label>
                    <input type="text" class="form-control" id="TypeOfAnesthesia" name="TypeOfAnesthesia" value="{{$docresult->TypeOfAnesthesia}}">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6"> 
                    <label for="AnesthesiaStartTime">Anesthesia Start: &nbsp</label>
                    <input type="time" class="form-control" id="AnesthesiaStartTime" name="AnesthesiaStartTime" value="{{$docresult->AnesthesiaStartTime}}">
                </div>
                <div class="col-md-6">  
                    <label for="SurgeryStartTime">Surgery Start: &nbsp</label>
                    <input type="time" class="form-control" id="SurgeryStartTime" name="SurgeryStartTime" value="{{$docresult->SurgeryStartTime}}">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6"> 
                    <label for="AnesthesiaEndTime">Anesthesia End &nbsp</label>
                    <input type="time" class="form-control" id="AnesthesiaEndTime" name="AnesthesiaEndTime" value="{{$docresult->AnesthesiaEndTime}}">
                </div>
                <div class="col-md-6">
                    <label for="SurgeryStartTime">Surgery End &nbsp</label>
                    <input type="time" class="form-control" id="SurgeryEndTime" name="SurgeryEndTime" value="{{$docresult->SurgeryEndTime}}">
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12">                  
                  <div class="form-group">                    
                    <div class="tools">
                      Tools:
                        <a id="tool-pencil">Pencil</a>
                          |
                        <a id="tool-eraser">Eraser</a>
                          |
                        <a id="tool-text">Text</a>                                            
                          |
                        <a id="tool-clear">Clear</a>                                                                                          
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="colors">
                        Color:
                          <a id="colorTool-black">Black</a>
                            |
                          <a id="colorTool-blue">Blue</a>
                            |
                          <a id="colorTool-red">Red</a>
                      </div>
                  </div>
                  <div class="literally core" style='height: 501px;width: 686px'></div>
                </div>  
              </div>           
              <br>
              <div class="row">
                <div class="form-group">
                <div class="col-12">
                  <input type="button" value="Add Medicine" class="btn btn-success float-right" data-toggle="modal" data-target="#open-modal-medicine">
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
                        <th>Medicine</th>
                        <th>Unit</th>
                        <th>Dose</th>
                        <th style="width: 40px">Action</th>
                      </tr>                  
                      </thead>
                      <tbody id="tbody_medicine">
                        
                        @foreach($IntOpeAneRecTotalDoseDrugs as $IntOpeAneRecTotalDoseDrug)
                        <tr id="R{{$intctrIntOpe}}">
                          <td class="row-index text-center">
                            <input type="hidden" class="medid" name="MedId[]" value="{{$IntOpeAneRecTotalDoseDrug->MedId}}">
                            <p>{{$intctrIntOpe}}</p>
                          </td>
                          <td class="text-center">
                            {{$IntOpeAneRecTotalDoseDrug->description}}
                          </td>
                          <td>
                            <select name="UnitId" class="form-control">
                              @foreach($MedicineUnits as $MedicineUnit)
                              @if($IntOpeAneRecTotalDoseDrug->MedId==$MedicineUnit->id)
                              <option selected value="{{$MedicineUnit->id}}">{{$MedicineUnit->ShortSymbol}}</option>
                              @else
                              <option value="{{$MedicineUnit->id}}">{{$MedicineUnit->ShortSymbol}}</option>
                              @endif
                              @endforeach
                            </select>
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" name="Dose[]" value="{{$IntOpeAneRecTotalDoseDrug->Dose}}">
                          </td>
                          <td class="text-center">
                            <input type="button" class="btn btn-danger btn-sm remove-medicine float-right" value="Remove">
                          </td>
                        </tr>
                        <?php $intctrIntOpe++; ?>
                        @endforeach
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>
              <div class="row">                
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="Notes" class="col-form-label">Notes</label>
                    <textarea id="Notes" name="Notes" class="form-control" rows="4">{{$docresult->Notes}}</textarea>
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
                    <p>
                      @if(is_file(public_path($docresult->filelink)))
                      <a href="{{asset($docresult->filelink)}}" target="_blank">Existing File...</a>
                      @endif
                    </p>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <a href="{{route('IntraOperAnesRecs')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                  <button type="submit" class="btn btn-success float-right" id="tool-save">Save</button> 
                </div>
              </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      

    </form>
    @endforeach
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Medicine -->
      <div class="modal fade" id="open-modal-medicine">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Medicine</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>


            <div class="modal-body">
              <div class="row">
                <div class="col-12">

                  <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Description</th>                      
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $intctr =0;
                    ?>
                    @foreach($Medicines as $Medicine)
                    <?php
                    $intctr++; 
                    ?>
                    <tr>
                      <td>{{$intctr}}</td>
                      <td>{{$Medicine->description}}</td>

                      <td><button type="button" class="btn btn-success add-medicine" value="{{$Medicine->id}}">Add</button> </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>                                 
                </div>

              </div>

            </div>
            
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>


          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  <!-- /.modal -->

  <!-- Modal Staff -->
      <div class="modal fade" id="open-modal-staff">
        <input type="hidden" name="" id="SelectedModal" value="0">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="StaffModalTitle">Staff</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>


            <div class="modal-body">
              <div class="row">
                <div class="col-12">

                  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Staff</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $intctr =0;
                    ?>
                    @foreach($Staffs as $Staff)
                    <?php
                    $intctr++; 
                    ?>
                    <tr>
                      <td>{{$intctr}}</td>
                      <td>{{$Staff->name}}</td>

                      <td><button type="button" class="btn btn-success add-staff" value="{{$Staff->id}}">Add</button> </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>                                 
                </div>

              </div>

            </div>
            
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>


          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  <!-- /.modal -->

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

<script src="{{asset('js/literallycanvas-core.js')}}" type="text/javascript"></script>

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

<script >
    $(document).ready(function(){

    
    var rowIdx = {{$intctrIntOpe}} - 1; 

    
    /* Price List */

    $('.add-medicine').click(function(){

      var med_id = $(this).val();
      url = '{{route('GetMedInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);
            $('#tbody_medicine').append(`<tr id="R${++rowIdx}">
              <td class="row-index text-center">
              <input type="hidden" class="medid" name="MedId[]" value="${data.id}">
                <p>${rowIdx}</p>
              </td>
              <td class="text-center">
              ${data.description}
              </td>
              <td>
                <select name="UnitId[]" class="form-control">
                  <?php foreach($MedicineUnits as $MedicineUnit){ ?>
                  <option value="<?php echo $MedicineUnit->id; ?>"><?php echo $MedicineUnit->ShortSymbol; ?></option>
                  <?php } ?>
                </select>
              </td>
              <td class="text-center">
              <input type="text" class="form-control" name="Dose[]">
              </td>
              <td class="text-center">
                <input type="button" class="btn btn-danger btn-sm remove-medicine float-right" value="Remove">

                </td>
              </tr>`);
      });

    });

    $('.add-procedure').click(function(){

      var med_id = $(this).val();
      url = '{{route('GetProcedureInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);
            $('#tbody_pro').append(`<tr id="R${++rowIdx}">
              <td class="row-index text-center">
              <input type="hidden" class="medid" name="ProcedureId[]" value="${data.id}">
                <p>${rowIdx}</p>
              </td>
              <td class="text-center">
              ${data.description}
              </td>
              <td class="text-center">
                <input type="button" class="btn btn-danger btn-sm remove-procedure float-right" value="Remove">
              </td>
              </tr>`);
      });

    });

    $('#SurgeonName').click(function(){
      $('#StaffModalTitle').text('Surgeon Name');
       $('#SelectedModal').val("1");
    });

    $('#AsstSurgeonName').click(function(){
      $('#StaffModalTitle').text('Asst. Surgeon Name');
      $('#SelectedModal').val("2");
    });

    $('#AnesthetistName').click(function(){
      $('#StaffModalTitle').text('Anesthetist Name');
    });


    $('.add-staff').click(function(){

      var med_id = $(this).val();
      var SelectedId = $('#SelectedModal').val();
      url = '{{route('GetStaffInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);


        switch(SelectedId){
          case "1":
            $('#SurgeonStaffName').val(data.name); 
            $('#SurgeonStaffId').val(data.id); 
            break;
          case "2":
            $('#AsstSurgeonStaffName').val(data.name); 
            $('#AsstSurgeonStaffId').val(data.id); 
            break;
          default:
            $('#AnesthetistStaffName').val(data.name); 
            $('#AnesthetistStaffId').val(data.id); 

        }

        $('#SelectedModal').val("0");
      });

      $('#open-modal-staff').modal('toggle'); 

    });

    // jQuery button click event to remove a row.
    $('#tbody_medicine').on('click', '.remove-medicine', function () {


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

    });

/* Lead Assessement */


  </script>

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

<script>

  $(document).ready(function(){
    <?php 
        $ImageBackground ="'".url($imgGraph)."'";
    ?>

    
    var ImageBackground = <?php echo $ImageBackground; ?>;
    var backgroundImage = new Image()  
    backgroundImage.src = <?php echo $ImageBackground; ?>;

    var MainUrl = <?php echo "'".url('/')."'"; ?>;
    var url = MainUrl + '/';
      
      var lc = LC.init(
        document.getElementsByClassName('core')[0],
        {
            
          backgroundShapes: [
            LC.createShape(
              'Image', {x: 1, y: 1, image: backgroundImage, scale:1})
          ],
          defaultStrokeWidth: 2    
        }

        );

      
    <!-- custom UI ... -->
    var tools = [
      {
        name: 'pencil',
        el: document.getElementById('tool-pencil'),
        tool: new LC.tools.Pencil(lc)
      },
      {
        name: 'eraser',
        el: document.getElementById('tool-eraser'),
        tool: new LC.tools.Eraser(lc)
      },
      {
        name: 'text',
        el: document.getElementById('tool-text'),
        tool: new LC.tools.Text(lc)
      }
    ];
    
    strokeWidths = [
          {
            name: 10,
            el: document.getElementById('sizeTool-1'),
            size: 10
          },{
            name: 20,
            el: document.getElementById('sizeTool-2'),
            size: 20
          },{
            name: 50,
            el: document.getElementById('sizeTool-3'),
            size: 50
          }
        ];
    colors = [
          {
            name: 'black',
            el: document.getElementById('colorTool-black'),
            color: '#000000'
          },{
            name: 'blue',
            el: document.getElementById('colorTool-blue'),
            color: '#0000ff'
          },{
            name: 'red',
            el: document.getElementById('colorTool-red'),
            color: '#ff0000'
          }
        ];

        setCurrentByName = function(ary, val) {
          ary.forEach(function(i) {
            $(i.el).toggleClass('current', (i.name == val));
          });
        };

    // Wire Colors
        colors.forEach(function(clr) {
          $(clr.el).click(function() {
            lc.setColor('primary', clr.color)
            setCurrentByName(colors, clr.name);
          })
        })
        setCurrentByName(colors, colors[0].name);


    var activateTool = function(t) {
        lc.setTool(t.tool);

        tools.forEach(function(t2) {
          if (t == t2) {
            t2.el.style.backgroundColor = 'yellow';
          } else {
            t2.el.style.backgroundColor = 'transparent';
          }
        });
    }

    var activateColor = function(t) {
        lc.setColor(t.color);

        colors.forEach(function(t2) {
          if (t == t2) {
            t2.el.style.backgroundColor = 'yellow';
          } else {
            t2.el.style.backgroundColor = 'transparent';
          }
        });
    }

    tools.forEach(function(t) {
      t.el.style.cursor = "pointer";
      t.el.onclick = function(e) {
        e.preventDefault();
        activateTool(t);
      };
    });
    activateTool(tools[0]);

    colors.forEach(function(t) {
      t.el.style.cursor = "pointer";
      t.el.onclick = function(e) {
        e.preventDefault();
        activateColor(t);
      };
    });
    activateColor(colors[0]);
      
        
    $("#tool-clear").click(function (e) {
      lc.clear();
    });

    $("#tool-save").click(function (e) {
      $("#IntOpeAneRecord").val(lc.getImage({scale: 1, margin: {top: 0, right: 0, bottom: 0, left: 0}}).toDataURL());
    });

  });
</script>


@endsection