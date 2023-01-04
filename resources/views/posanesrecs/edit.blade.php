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
    <?php $TotalScore = 0; ?>
    @foreach($docresults as $docresult)
   <form action="{{route('PostAnesthesiaRecsUpdate')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
        {{ csrf_field() }}
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
              <h3 class="card-title">Post Anesthesia Record</h3>

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
                  <label for="doctime" class="col-form-label">Time</label>
                  <input type="time" class="form-control" id="doctime" name="doctime" value="{{$docresult->doctime}}"/>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                <div class="col-12">
                  <input type="button" value="Surgical Procedure" class="btn btn-success float-right" data-toggle="modal" data-target="#open-modal-procedure">
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
                      <?php $intctrPro=1; ?> 
                      @foreach($PosAneRecSurProcSubs as $PosAneRecSurProcSub)
                        <tr id="R{{$intctrPro}}">
                          <td class="row-index text-center">
                            <input type="hidden" name="ProcedureId[]" value="{{$PosAneRecSurProcSub->id}}">
                            <p>{{$intctrPro}}</p>
                          </td>
                          <td class="text-center">
                            {{$PosAneRecSurProcSub->description}}
                          </td>
                          <td class="text-center">
                            <input type="button" class="btn btn-danger btn-sm remove-procedure float-right" value="Remove">

                          </td>
                        </tr>
                      <?php $intctrPro++; ?>
                      @endforeach                      
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Surgeon Name:" class="btn btn-success float-right" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="SurgeonStaffId" id="SurgeonStaffId" value="{{$docresult->SurgeonStaffId}}">
                    <input type="text" class="form-control" id="SurgeonStaffName" value="{{$docresult->SurgeonStaffName}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Anesthesist Name:" class="btn btn-success float-right" data-toggle="modal" data-target="#open-modal-staff-a">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="AnesthetestStaffId" id="AnesthetestStaffId" value="{{$docresult->AnesthetestStaffId}}">
                    <input type="text" class="form-control" id="AnesthetestStaffName" value="{{$docresult->AnesthetestStaffName}}">
                  </div>
                </div>
              </div>

              <div class="row">
                <label>Type of Anesthesia</label>
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsTypAneGA==1)
                      <input type="checkbox" name="IsTypAneGA" id="IsTypAneGA" checked>
                      @else
                      <input type="checkbox" name="IsTypAneGA" id="IsTypAneGA">
                      @endif
                      <label for="IsTypAneGA">
                        G A
                      </label>
                    </div> 
                    <div class="icheck-success d-inline">
                      @if($docresult->IsTypAneMAC==1)
                      <input type="checkbox" name="IsTypAneMAC" id="IsTypAneMAC" checked>
                      @else
                      <input type="checkbox" name="IsTypAneMAC" id="IsTypAneMAC">
                      @endif
                      <label for="IsTypAneMAC">
                        M A C
                      </label>
                    </div>  
                    <div class="icheck-success d-inline">
                      @if($docresult->IsTypAneRegAne==1)
                      <input type="checkbox" name="IsTypAneRegAne" id="IsTypAneRegAne" checked>
                      @else
                      <input type="checkbox" name="IsTypAneRegAne" id="IsTypAneRegAne">
                      @endif
                      <label for="IsTypAneRegAne">
                        Regional Anesthesia
                      </label>
                    </div>   
                    <div class="icheck-success d-inline">
                      @if($docresult->IsTypAneRegAne==1)
                      <input type="checkbox" name="IsTypAneOthers" id="IsTypAneOthers" checked>
                      @else
                      <input type="checkbox" name="IsTypAneOthers" id="IsTypAneOthers">
                      @endif
                      <label for="IsTypAneOthers">
                        Others
                      </label>
                    </div>             
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="form-group">
                <div class="col-12">
                  <input type="button" value="Monitoring Record" class="btn btn-success float-right add-mon-rec">
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
                        <th>Time</th>
                        <th>B/P</th>
                        <th>Pulse Rate</th>
                        <th>Sp02</th>
                        <th>Fi02</th>
                        <th>Pain Score</th>
                      </tr>                  
                      </thead>
                      <tbody id="tbody_pro-mon-rec">
                        <?php $intctrMonRec = 1; ?>
                        @foreach($PosAneMonRecSubs as $PosAneMonRecSub)
                        <tr id="R{{$intctrMonRec}}">
                          <td class="row-index text-center">
                            <input type="time" class="form-control" id="MonRecSubdoctime[]" name="MonRecSubdoctime[]" value="{{$PosAneMonRecSub->MonRecSubdoctime}}">
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" id="BP" name="BP[]" value="{{$PosAneMonRecSub->BP}}">
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" id="PulseRate" name="PulseRate[]" value="{{$PosAneMonRecSub->PulseRate}}">
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" id="Sp02" name="Sp02[]" value="{{$PosAneMonRecSub->Sp02}}">
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" id="Fi02" name="Fi02[]" value="{{$PosAneMonRecSub->Fi02}}">
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" id="PainScore" name="PainScore[]" value="{{$PosAneMonRecSub->PainScore}}">
                          </td>
                          <td class="text-center">
                            <input type="button" class="btn btn-danger btn-sm remove-mon-rec float-right" value="Remove">
                          </td>
                          </tr> 
                        <?php $intctrMonRec++; ?>
                        @endforeach 
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="DruInRec">Drug in Recovery</label>
                    <textarea class="form-control" name="DruInRec" id="DruInRec" rows="5">{{$docresult->DruInRec}}</textarea>
                  </div>
                </div>                
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCriDisCon==1)
                      <input type="checkbox" name="IsCriDisCon" id="IsCriDisCon" checked>
                      @else
                      <input type="checkbox" name="IsCriDisCon" id="IsCriDisCon">
                      @endif
                      <label for="IsCriDisCon">
                        Consciousness
                      </label>
                    </div> 
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCriDisAct==1)
                      <input type="checkbox" name="IsCriDisAct" id="IsCriDisAct" checked>
                      @else
                      <input type="checkbox" name="IsCriDisAct" id="IsCriDisAct">
                      @endif
                      <label for="IsCriDisAct">
                        Activity
                      </label>
                    </div>  
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCriDisBre==1)
                      <input type="checkbox" name="IsCriDisBre" id="IsCriDisBre" checked>
                      @else
                      <input type="checkbox" name="IsCriDisBre" id="IsCriDisBre">
                      @endif
                      <label for="IsCriDisBre">
                        Breathing
                      </label>
                    </div>   
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCriDisCir==1)
                      <input type="checkbox" name="IsCriDisCir" id="IsCriDisCir" checked>
                      @else
                      <input type="checkbox" name="IsCriDisCir" id="IsCriDisCir">
                      @endif
                      <label for="IsCriDisCir">
                        Circulation
                      </label>
                    </div>  
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCriDisOxySat==1)
                      <input type="checkbox" name="IsCriDisOxySat" id="IsCriDisOxySat" checked>
                      @else
                      <input type="checkbox" name="IsCriDisOxySat" id="IsCriDisOxySat">
                      @endif
                      <label for="IsCriDisOxySat">
                        Oxygen Saturation
                      </label>
                    </div> 

                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="HisAndPhy" class="col-form-label">Total Score</label>
                    <input type="text" class="form-control" id="TotalScore" name="TotalScore" value="{{$docresult->TotalScore}}" placeholder="10">  

                    <?php 
                      if(isset($docresult->TotalScore))
                      $TotalScore = $docresult->TotalScore; 
                    ?>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="DisInsAndRem">Discharge Instruction and Remark</label>
                    <textarea class="form-control" name="DisInsAndRem" id="DisInsAndRem" rows="5">{{$docresult->DisInsAndRem}}</textarea>  
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Recovery Nurse Name:" class="btn btn-success float-right" data-toggle="modal" data-target="#open-modal-nurse">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="RecNurStaffId" id="RecNurStaffId" value="{{$docresult->RecNurStaffId}}" >
                    <input type="text" class="form-control" id="RecNurStaffName" value="{{$docresult->RecNurStaffName}}">
                  </div>
                </div>
              </div>
              
              <div class="form-group row">                
                <div class="col-md-2">
                  <label for="DisDate" class="col-form-label">Discharge Date</label>
                  <input type="date" class="form-control" id="DisDate" name="DisDate" value="{{$docresult->DisDate}}"/>
                </div>
                <div class="col-md-2">
                  <label for="DisTime" class="col-form-label">Discharge Time</label>
                  <input type="time" class="form-control" id="DisTime" name="DisTime" value="{{$docresult->DisTime}}"/>
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
                  <a href="{{route('PostAnesthesiaRecs')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                  <input type="submit" value="Save" class="btn btn-success float-right">
                </div>
              </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      

    </form>
    @endforeach()
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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

  <!-- Modal Staff -->
      <div class="modal fade" id="open-modal-staff-a">
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

                      <td><button type="button" class="btn btn-success add-staff-a" value="{{$Staff->id}}">Add</button> </td>
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
      <div class="modal fade" id="open-modal-nurse">
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

                      <td><button type="button" class="btn btn-success add-staff-nurse" value="{{$Staff->id}}">Add</button> </td>
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

    
    var rowIdx =  {{$intctrMonRec}} - 1;          
    var rowIdx_pro = {{$intctrPro}} - 1;   

    var TotalScore = {{$TotalScore}};


    $('#IsCriDisCon').click(function(){
      if($('input[name="IsCriDisCon"]').is(':checked'))
      {
      TotalScore = TotalScore + 2;
      $('#TotalScore').val(TotalScore);
      }
      else
      {
        TotalScore = TotalScore - 2;
      $('#TotalScore').val(TotalScore);
      }
    });

    $('#IsCriDisAct').click(function(){
      if($('input[name="IsCriDisAct"]').is(':checked'))
      {
      TotalScore = TotalScore + 2;
      $('#TotalScore').val(TotalScore);
      }
      else
      {
        TotalScore = TotalScore - 2;
      $('#TotalScore').val(TotalScore);
      }
    });

    $('#IsCriDisBre').click(function(){
      if($('input[name="IsCriDisBre"]').is(':checked'))
      {
      TotalScore = TotalScore + 2;
      $('#TotalScore').val(TotalScore);
      }
      else
      {
        TotalScore = TotalScore - 2;
      $('#TotalScore').val(TotalScore);
      }
    });

    $('#IsCriDisCir').click(function(){
      if($('input[name="IsCriDisCir"]').is(':checked'))
      {
      TotalScore = TotalScore + 2;
      $('#TotalScore').val(TotalScore);
      }
      else
      {
        TotalScore = TotalScore - 2;
      $('#TotalScore').val(TotalScore);
      }
    });

    $('#IsCriDisOxySat').click(function(){
      if($('input[name="IsCriDisOxySat"]').is(':checked'))
      {
      TotalScore = TotalScore + 2;
      $('#TotalScore').val(TotalScore);
      }
      else
      {
        TotalScore = TotalScore - 2;
      $('#TotalScore').val(TotalScore);
      }
    }); 

    $('.add-mon-rec').click(function(){

            $('#tbody_pro-mon-rec').append(`<tr id="R${++rowIdx}">
              <td class="row-index text-center">
                  <input type="time" class="form-control" id="MonRecSubdoctime" name="MonRecSubdoctime[]">
              </td>
              <td class="text-center">
              <input type="text" class="form-control" id="BP" name="BP[]">
              </td>
              <td class="text-center">
              <input type="text" class="form-control" id="PulseRate" name="PulseRate[]">
              </td>
              <td class="text-center">
              <input type="text" class="form-control" id="Sp02" name="Sp02[]">
              </td>
              <td class="text-center">
              <input type="text" class="form-control" id="Fi02" name="Fi02[]">
              </td>
              <td class="text-center">
              <input type="text" class="form-control" id="PainScore" name="PainScore[]">
              </td>
              <td class="text-center">
                <input type="button" class="btn btn-danger btn-sm remove-mon-rec float-right" value="Remove">
                  </i>

                </td>
              </tr>`);
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
        $('#SurgeonStaffName').val(data.name); 
        $('#SurgeonStaffId').val(data.id); 
      });

      $('#open-modal-staff').modal('toggle'); 

    });

    $('.add-staff-a').click(function(){

      var med_id = $(this).val();
      url = '{{route('GetStaffInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);
        $('#AnesthetestStaffName').val(data.name); 
        $('#AnesthetestStaffId').val(data.id); 
      });

      $('#open-modal-staff-a').modal('toggle'); 

    });

    $('.add-staff-nurse').click(function(){

      var med_id = $(this).val();
      url = '{{route('GetStaffInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);
        $('#RecNurStaffName').val(data.name); 
        $('#RecNurStaffId').val(data.id); 
      });

      $('#open-modal-nurse').modal('toggle'); 

    });

    // jQuery button click event to remove a row.
    $('#tbody_pro-mon-rec').on('click', '.remove-mon-rec', function () {


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