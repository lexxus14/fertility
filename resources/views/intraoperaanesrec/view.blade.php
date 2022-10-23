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
                  
                  <div style='height: 501px;width: 686px'><img src="{{asset($docresult->IntOpeAneRecord)}}"></div>
                </div>  
              </div>           
              <br>  
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
                            {{$IntOpeAneRecTotalDoseDrug->ShortSymbol}}
                          </td>
                          <td class="text-center">
                            {{$IntOpeAneRecTotalDoseDrug->Dose}}
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



@endsection