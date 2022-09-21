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
   <form action="{{route('OVFReqFormStore')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
        {{ csrf_field() }}
      <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
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
              <h3 class="card-title">IVF Requisition Form</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">              
              <div class="form-group row">
                <div class="col-md-2">
                  <label for="PreOperaDate" class="col-form-label">Date</label>
                  <input type="date" class="form-control" id="PreOperaDate" name="PreOperaDate"/>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Patient's Physician" class="btn btn-success float-right" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="PhysicianId" id="PhysicianId" value="0">
                    <input type="text" class="form-control" id="PhysicianName">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Oocyte Source</h3>
                      </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="form-group">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" name="IsFemalePartner" id="IsFemalePartner">
                                <label for="IsFemalePartner">
                                  Female Partner
                                </label>
                              </div>                   
                            </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-md-4">
                                  <label for="BaselineFSH">
                                    Baseline FSH
                                  </label>
                                  <input type="text" name="BaselineFSH" class="form-control" id="BaselineFSH">
                              </div>
                              <div class="col-md-4">  
                                  <label for="UTLining">
                                    UT Lining
                                  </label>
                                  <input type="text" name="UTLining" class="form-control" id="UTLining">
                              </div>
                              <div class="col-md-4">    
                                  <label for="AMH">
                                    AMH
                                  </label>
                                  <input type="text" name="AMH" class="form-control" id="AMH">
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-md-12">  
                                  <label for="OocyteSoureValid">
                                    Inf. Dis/. FDA Testing/Screening completed and valid
                                  </label>
                                  <input type="text" name="OocyteSoureValid" class="form-control" id="OocyteSoureValid">
                             </div>
                          </div> 
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Sperm Source</h3>
                      </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="form-group">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" name="IsMalePartner" id="IsMalePartner">
                                <label for="IsMalePartner">
                                  Male Partner
                                </label>
                              </div>                   
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" name="IsFresh" id="IsFresh">
                                <label for="IsFresh">
                                  Fresh
                                </label>
                              </div>                   
                            </div>
                            <div class="form-group">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" name="IsFrozen" id="IsFrozen">
                                <label for="IsFrozen">
                                  Frozen
                                </label>
                              </div>                   
                            </div>
                            <div class="form-group">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" name="IsTESE" id="IsTESE">
                                <label for="IsTESE">
                                  TSE ect.
                                </label>
                              </div>                   
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group">                                  
                                  <label for="SpermSourceValid">
                                    Inf. Dis/. FDA Testing/Screening completed and valid
                                  </label>
                                  <input type="text" name="SpermSourceValid" class="form-control" id="SpermSourceValid">
                               </div>
                            </div>
                          </div> 
                        </div>
                    </div>
                </div>
              </div>
              <hr>
              <div class="form-group row">                
                <div class="col-md-7">
                  <label for="Dx" class="col-form-label">Dx</label>
                  <input type="text" class="form-control" id="Dx" name="Dx"/>
                </div>              
                <div class="col-md-1">
                  <label for="G" class="col-form-label">G</label>
                  <input type="text" class="form-control" id="G" name="G"/>
                </div>
                <div class="col-md-1">
                  <label for="P" class="col-form-label">P</label>
                  <input type="text" class="form-control" id="P" name="P"/>
                </div>
                <div class="col-md-1">
                  <label for="T" class="col-form-label">T</label>
                  <input type="text" class="form-control" id="T" name="T"/>
                </div>
                <div class="col-md-1">
                  <label for="A" class="col-form-label">A</label>
                  <input type="text" class="form-control" id="A" name="A"/>
                </div>
                <div class="col-md-1">
                  <label for="L" class="col-form-label">L</label>
                  <input type="text" class="form-control" id="L" name="L"/>
                </div>
              </div>
              <h3>Medication</h3>
              <div class="form-group row">                
                <div class="col-md-6">
                  <label for="Protocol" class="col-form-label">Protocol</label>
                  <input type="text" class="form-control" id="Protocol" name="Protocol"/>
                </div>
                <div class="col-md-6">
                  <label for="Cycle" class="col-form-label">Cycle</label>
                  <input type="text" class="form-control" id="Cycle" name="Cycle"/>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                <div class="col-12">
                  <input type="button" value="Add Medicine" class="btn btn-success float-right" data-toggle="modal" data-target="#open-modal-medicine-treatment">
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
                        <th>Dosage</th>
                        <th>Unit</th>
                        <th style="width: 40px">Action</th>
                      </tr>                  
                      </thead>
                      <tbody id="tbody">
                        
                      
        
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>
              <hr>
              <h3>Procedure Ordered</h3>
              <div class="row">
                <div class="form-group">
                <div class="col-12">
                  <input type="button" value="Add Procedure" class="btn btn-success float-right" data-toggle="modal" data-target="#open-modal-procedure">
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
                        
                      
        
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>
              <hr>
              <h3>OV. STM./Retrieval Info</h3>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="PeakE2" class="col-form-label">Peack E2</label>
                    <input type="text" class="form-control" id="PeakE2" name="PeakE2"/>                     
                  </div>                  
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="NoFollHcgInjDays" class="col-form-label">No. Follicles on hCG inj. Day</label>
                    <input type="text" class="form-control" id="NoFollHcgInjDays" name="NoFollHcgInjDays"/>                     
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="StimDays" class="col-form-label">Stimulation Days</label>
                    <input type="text" class="form-control" id="StimDays" name="StimDays">  
                  </div>                  
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="CycleStartDate" class="col-form-label">Cycle start Date</label>
                    <input type="date" class="form-control" id="CycleStartDate" name="CycleStartDate">  
                  </div>                  
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="PatientCoastedDays" class="col-form-label">Patient Coasted (Days)</label>
                    <input type="text" class="form-control" id="PatientCoastedDays" name="PatientCoastedDays"> 
                  </div>                  
                </div>
              </div>
              Chromosomal Study
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" name="IsPGTA" id="IsPGTA">
                      <label for="IsPGTA">
                        PGTA
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      <input type="checkbox" name="IsGenderSel" id="IsGenderSel">
                      <label for="IsGenderSel">
                        Gender Selection
                      </label>
                    </div> 
                    <div class="icheck-success d-inline">
                      <input type="checkbox" name="IsPGTM" id="IsPGTM">
                      <label for="IsPGTM">
                        PGT-M
                      </label>
                    </div>                   
                  </div>                  
                </div>
              </div>
              
              <div class="row">                
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="HcgDate" class="col-form-label">hCG Date</label>
                    <input type="date" class="form-control" id="HcgDate" name="HcgDate">  
                  </div>                  
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="HcgTime" class="col-form-label">Time</label>
                    <input type="time" class="form-control" id="HcgTime" name="HcgTime"> 
                  </div>                  
                </div> 
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="ErDate" class="col-form-label">ER Date</label>
                    <input type="date" class="form-control" id="ErDate" name="ErDate"> 
                  </div>                  
                </div>  
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="ErTime" class="col-form-label">Time</label>
                    <input type="time" class="form-control" id="ErTime" name="ErTime"> 
                  </div>                  
                </div>             
              </div>            
              <hr>
              <div class="row">
                <div class="col-md-12">
                  Embryo Transfer
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" name="IsBryoTransYes" id="IsBryoTransYes">
                      <label for="IsBryoTransYes">
                        Yes
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      <input type="checkbox" name="IsBryoTransNo" id="IsBryoTransNo">
                      <label for="IsBryoTransNo">
                        No
                      </label>
                    </div>                    
                  </div>                  
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="Notes">Notes</label>
                    <textarea class="form-control" name="Notes" id="Notes" rows="5"></textarea>
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
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <a href="{{route('OVFReqForm')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                  <input type="submit" value="Save" class="btn btn-success float-right">
                </div>
              </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      

    </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Medicine Treatement -->
      <div class="modal fade" id="open-modal-medicine-treatment">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Medicine</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>


            <div class="modal-body">
              <div class="row">
                <div class="col-12">

                  <table id="example3" class="table table-bordered table-striped">
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

                      <td><button type="button" class="btn btn-success add-medicine-treatment" value="{{$Medicine->id}}">Add</button> </td>
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

  <!-- Modal Procedure -->
      <div class="modal fade" id="open-modal-procedure">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Procedure</h4>
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
                    @foreach($Procedures as $Procedure)
                    <?php
                    $intctr++; 
                    ?>
                    <tr>
                      <td>{{$intctr}}</td>
                      <td>{{$Procedure->description}}</td>

                      <td><button type="button" class="btn btn-success add-procedure" value="{{$Procedure->id}}">Add</button> </td>
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
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Staff</h4>
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

  <script >
    $(document).ready(function(){

    
    var rowIdx = 0;          
    var rowIdx_pro = 0;              
    
    /* Price List */

    $('.add-medicine-treatment').click(function(){

      var med_id = $(this).val();
      url = '{{route('GetMedInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);
            $('#tbody').append(`<tr id="R${++rowIdx}">
              <td class="row-index text-center">
              <input type="hidden" class="medid" name="MedId[]" value="${data.id}">
                <p>${rowIdx}</p>
              </td>
              <td class="text-center">
              ${data.description}
              </td>
              <td class="text-center"><input type="number" class="form-control" name="MedDosage[]"></td>
              <td>
                <select name="MedUnitId[]" class="form-control" aria-invalid="false">
                  @foreach($MedicineUnits as $MedicineUnit)
                  <option value="{{$MedicineUnit->id}}">{{$MedicineUnit->ShortSymbol}}</option>
                  @endforeach
                </select>
              </td>
              <td class="text-center">
                <input type="button" class="btn btn-danger btn-sm remove-medicine-treatment float-right" value="Remove">
                  </i>

                </td>
              </tr>`);
      });

    });

    $('.add-procedure').click(function(){

      var med_id = $(this).val();
      url = '{{route('GetProcedureInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);
            $('#tbody_pro').append(`<tr id="R${++rowIdx_pro}">
              <td class="row-index text-center">
              <input type="hidden" class="medid" name="ProcedureId[]" value="${data.id}">
                <p>${rowIdx_pro}</p>
              </td>
              <td class="text-center">
              ${data.description}
              </td>
              <td class="text-center">
                <input type="button" class="btn btn-danger btn-sm remove-procedure float-right" value="Remove">
                  </i>

                </td>
              </tr>`);
      });

    });

    $('.add-staff').click(function(){

      var med_id = $(this).val();
      url = '{{route('GetStaffInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);
        $('#PhysicianName').val(data.name); 
        $('#PhysicianId').val(data.id); 
      });

      $('#open-modal-staff').modal('toggle'); 

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

    // jQuery button click event to remove a row.
    $('#tbody_pro').on('click', '.remove-procedure', function () {


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
      rowIdx_pro--;
    });

    });

/* Lead Assessement */


  </script>
@endsection