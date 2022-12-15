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
              <h3 class="card-title">IVF/Embryo Transfer Data Sheet</h3>

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
              <hr>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <div class="d-inline">
                        <label for="EggsRetrieved">You had &nbsp </label><input type="text" id="EggsRetrieved" name="EggsRetrieved" value="{{$docresult->EggsRetrieved}}"/> &nbsp <label for="EggsRetrievedDate">eggs retrieved on &nbsp</label><input type="date" class="" id="EggsRetrievedDate" name="EggsRetrievedDate" value="{{$docresult->EggsRetrievedDate}}"/>.
                        </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <div class="d-inline">
                        <label for="EggsFertilized">You had &nbsp </label><input type="text" id="EggsFertilized" name="EggsFertilized" value="{{$docresult->EggsFertilized}}"/> &nbsp <label for="EggsFertilizedDate">eggs fertilized on &nbsp</label><input type="date" class="" id="EggsFertilizedDate" name="EggsFertilizedDate" value="{{$docresult->EggsFertilizedDate}}"/>.
                        </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <div class="d-inline">
                        <label for="EmbryosTransd">You had &nbsp </label><input type="text" id="EmbryosTransd" name="EmbryosTransd" value="{{$docresult->EmbryosTransd}}"/> &nbsp <label for="EmbryosTransdDate">embryo(s) transferred &nbsp</label><input type="date" class="" id="EmbryosTransdDate" name="EmbryosTransdDate" value="{{$docresult->EmbryosTransdDate}}"/>.
                        </div>
                    </div>
                </div>
              </div>              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsDay3==1)
                      <input type="checkbox" name="IsDay3" checked id="IsDay3">
                      @else
                      <input type="checkbox" name="IsDay3" id="IsDay3">
                      @endif
                      <label for="IsDay3">
                        Day 3
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsDay5==1)
                      <input type="checkbox" name="IsDay5" checked id="IsDay5">
                      @else
                      <input type="checkbox" name="IsDay5" id="IsDay5">
                      @endif
                      <label for="IsDay5">
                        Day 5
                      </label>
                    </div>                   
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <div class="d-inline">
                        <label for="EmbryosDis">You have &nbsp </label><input type="text" id="EmbryosDis" name="EmbryosDis" value="{{$docresult->EmbryosDis}}" /> &nbsp embryo(s) to be discarded.
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsICSI)
                      <input type="checkbox" name="IsICSI" checked id="IsICSI">
                      @else
                      <input type="checkbox" name="IsICSI" id="IsICSI">
                      @endif
                      <label for="IsICSI">
                        Procedure Performed ICSI
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ICSIPatientInitials" class="col-form-label">Patient Initials:</label>
                    <input type="text" class="form-control" id="ICSIPatientInitials" name="ICSIPatientInitials" value="{{$docresult->ICSIPatientInitials}}" />                  
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsAssistedHatch)
                      <input type="checkbox" name="IsAssistedHatch" checked id="IsAssistedHatch">
                      @else
                      <input type="checkbox" name="IsAssistedHatch" id="IsAssistedHatch">
                      @endif
                      <label for="IsAssistedHatch">
                        Assisted Hatching
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="AssistedHatchPatientInitials" class="col-form-label">Patient Initials:</label>
                    <input type="text" class="form-control" id="AssistedHatchPatientInitials" name="AssistedHatchPatientInitials" value="{{$docresult->AssistedHatchPatientInitials}}" />                  
                  </div>
                </div>
              </div>

              <div class="form-group row">   
                <div class="col-md-2">
                  <label for="EmbryosTransDate" class="col-form-label">Embryos Transfer Date</label>
                  <input type="date" class="form-control" id="EmbryosTransDate" name="EmbryosTransDate" value="{{$docresult->EmbryosTransDate}}"/>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsVerifiedCorrectName)
                      <input type="checkbox" name="IsVerifiedCorrectName" checked id="IsVerifiedCorrectName">
                      @else
                      <input type="checkbox" name="IsVerifiedCorrectName" id="IsVerifiedCorrectName">
                      @endif
                      <label for="IsVerifiedCorrectName">
                        Partner Verifited the dish/vessel with CORRECT NAME
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="VerifiedCorrectNamePatientInitials" class="col-form-label">Patient Initials:</label>
                    <input type="text" class="form-control" id="VerifiedCorrectNamePatientInitials" name="VerifiedCorrectNamePatientInitials" value="{{$docresult->VerifiedCorrectNamePatientInitials}}" />                  
                  </div>
                </div>
              </div>             

              <div class="form-group row">
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Nurse:" class="btn btn-success float-right" id="NurseName" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="NurseStaffId" id="NurseStaffId" value="{{$docresult->NurseStaffId}}">
                    <input type="text" class="form-control" id="NurseStaffName" value="{{$docresult->NurseName}}">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Embryologist:" class="btn btn-success float-right" id="EmbryologistName" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="EmbryologistStaffId" id="EmbryologistStaffId" value="{{$docresult->EmbryologistStaffId}}">
                    <input type="text" class="form-control" id="EmbryologistStaffName" value="{{$docresult->EmbryologistName}}">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="MD:" class="btn btn-success float-right" id="MDName" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="MDStaffId" id="MDStaffId" value="{{$docresult->MDStaffId}}">
                    <input type="text" class="form-control" id="MDStaffName" value="{{$docresult->MDName}}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea class="form-control" rows="4" name="Notes">{{$docresult->Notes}}</textarea>
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
                    @if(is_file(public_path($docresult->filelink)))
                    <a href="{{asset($docresult->filelink)}}" target="_blank">Existing File...</a>
                    @endif
                  </div>
                </div>
              </div>              
              
              <div class="row">
                <div class="col-12">
                  <a href="{{route('IVFEmbryoTransDataSheet')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                  <a href="{{route('PrintIVFEmbryoTransDataSheet')}}/{{$docId}}" target="_blank" class="btn btn-secondary float-right">Print</a>
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