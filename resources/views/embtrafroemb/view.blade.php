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
              <h3 class="card-title">Embryo Transfer with Frozen Embryo Data Sheet</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">

            <div class="form-group row">
              <div class="col-md-3">
                <label for="docdate" class="col-form-label">Date</label>
                <input type="date" class="form-control" id="docdate" name="docdate" value="{{$docresult->docdate}}" />
              </div>          
            </div>

            <div class="form-group row">
              <div class="col-md-3">
                <label for="FrozenEmb" class="col-form-label">No of Embryo</label>
                <input type="text" class="form-control" id="FrozenEmb" name="FrozenEmb" value="{{$docresult->FrozenEmb}}"/>
              </div> 
              <div class="col-md-3">
                <label for="FrozenDate" class="col-form-label">Frozen Date</label>
                <input type="date" class="form-control" id="FrozenDate" name="FrozenDate" value="{{$docresult->FrozenDate}}"/>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-3">
                <label for="ThaEmby" class="col-form-label">No of Embryo Thawed</label>
                <input type="text" class="form-control" id="ThaEmby" name="ThaEmby" value="{{$docresult->ThaEmby}}"/>
              </div> 
              <div class="col-md-3">
                <label for="EmbyDate" class="col-form-label">Thawed Date</label>
                <input type="date" class="form-control" id="EmbyDate" name="EmbyDate" value="{{$docresult->EmbyDate}}"/>
              </div>
              <div class="col-md-3">
                <label for="EmbyRem" class="col-form-label">Remaining Embryo</label>
                <input type="text" class="form-control" id="EmbyRem" name="EmbyRem" value="{{$docresult->EmbyRem}}"/>
              </div>
            </div>
            <div class="form-group row">
               
              <div class="col-md-3">
                <label for="EmbyTran" class="col-form-label">Embryo Transferred</label>
                <input type="text" class="form-control" id="EmbyTran" name="EmbyTran" value="{{$docresult->EmbyTran}}"/>
              </div>
              <div class="col-md-3">
                <label for="TranDate" class="col-form-label">Date Transfer</label>
                <input type="date" class="form-control" id="TranDate" name="TranDate" value="{{$docresult->TranDate}}"/>
              </div>
              <div class="col-md-2">
                  <label>Assisted Hatching &nbsp;</label>
                  <div class="icheck-success">                  
                    @if($docresult->IsAssHatchYes)
                    <input type="checkbox" id="IsAssHatchYes" name="IsAssHatchYes" checked="">
                    @else
                    <input type="checkbox" id="IsAssHatchYes" name="IsAssHatchYes">
                    @endif
                    <label for="IsAssHatchYes">
                      Yes
                    </label>
                  </div>
                  <div class="icheck-success">  
                    @if($docresult->IsAssHatchNo)                
                    <input type="checkbox" id="IsAssHatchNo" name="IsAssHatchNo" checked="">
                    @else
                    <input type="checkbox" id="IsAssHatchNo" name="IsAssHatchNo">
                    @endif
                    <label for="IsAssHatchNo">
                      No
                    </label>
                  </div>
                </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <label for="PatientInit" class="col-form-label">Patient Initials</label>
                <input type="text" class="form-control" id="PatientInit" name="PatientInit" value="{{$docresult->PatientInit}}" />
              </div>
              <div class="col-md-3">
                <label for="ET3" class="col-form-label">ET 3</label>
                <input type="text" class="form-control" id="ET3" name="ET3" value="{{$docresult->ET3}}"/>
              </div>
              <div class="col-md-3">
                <label for="ET5" class="col-form-label">ET 5</label>
                <input type="text" class="form-control" id="ET5" name="ET5" value="{{$docresult->ET5}}"/>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-4">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <input type="button" value="Embryologist:" class="btn btn-success float-right" data-toggle="modal" id="EmbryologistStaffName" data-target="#open-modal-staff">
                  </div>
                  <!-- /btn-group -->
                  <input type="hidden" class="form-control" name="EmbryologistStaffId" id="EmbryologistStaffId" value="{{$docresult->EmbryologistStaffId}}">
                  <input type="text" class="form-control" id="EmbryologistName"  value="{{$docresult->EmbryologistName}}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <input type="button" value="MD:" class="btn btn-success float-right" data-toggle="modal" id="MDStaffName" data-target="#open-modal-staff">
                  </div>
                  <!-- /btn-group -->
                  <input type="hidden" class="form-control" name="MDStaffId" id="MDStaffId" value="{{$docresult->MDStaffId}}">
                  <input type="text" class="form-control" id="MDName" value="{{$docresult->MDName}}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <input type="button" value="Nurse:" class="btn btn-success float-right" data-toggle="modal" id="NurseStaffName" data-target="#open-modal-staff">
                  </div>
                  <!-- /btn-group -->
                  <input type="hidden" class="form-control" name="NurseStaffId" id="NurseStaffId" value="{{$docresult->NurseStaffId}}">
                  <input type="text" class="form-control" id="NurseName" value="{{$docresult->NurseName}}">
                </div>
              </div>
            </div>
            <hr>
             
              <hr>
              <div class="row">
                <div class="col-sm-12">
                  <label for="Notes">Notes</label>
                  <textarea class="form-control" id="Notes" name="Notes">{{$docresult->Notes}}</textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputFile">File</label>
                    @if(is_file(public_path($docresult->filelink)))
                    <a href="{{asset($docresult->filelink)}}" target="_blank">Existing File...</a>
                    @endif
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <a href="{{route('EmbTraFroEmb')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
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