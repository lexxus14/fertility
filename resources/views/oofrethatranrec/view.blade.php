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
   <form action="{{route('OOctyeFreezeThawTransUpdate')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
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
              <h3 class="card-title">OOcyte Freeze Thawing Transfer Record</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body"> 
              @if(isset($docId))
              <?php $tableNo =1; ?>
              @foreach($OOcyteSubs as $OOcyteSub)
                <?php 
                  $strsql ="select * from OOctyeFreezeThawTransRecSubDetails 
                      where OOcFTTRSubId=".$OOcyteSub->id;

                  $OOcyteSubDetails = DB::select($strsql);
                ?>
              <div class="row">
                <div class="col-12">
                <!-- /.card-header -->
                    <!-- <table id="example1" class="table table-bordered table-striped"> -->
                    <table  class="table table-bordered table-striped">
                      <thead>                  
                      <tr>
                        <th colspan="1" class="text-center">
                          <button type="button" class="btn btn-warning float-left">Table No: {{$tableNo}}</button>        
                        </th>
                        <th colspan="2" class="text-center">OOCyte Freezing</th>
                        <th colspan="2" class="text-center">OOCyte Thawing</th>      
                      </tr>  
                      <tr>
                        <th>Straw No</th>
                        <th>OOCyte No</th>
                        <th>Maturation</th>
                        <th>Stage/Grade</th>
                        <th>Thaw (Y/N)</th>                  
                      </tr>                
                      </thead>
                      <tbody id="tbody">
                        <?php $rowIdx=1; ?>
                       @foreach($OOcyteSubDetails as $OOcyteSubDetail)
                        <tr id="R{{$rowIdx}}">
                          <td class="row-index text-center">                
                            <input type="text" class="form-control" name="StrawNo[]" value="{{$OOcyteSubDetail->StrawNo}}">
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" name="OoctyeNo[]" value="{{$OOcyteSubDetail->OoctyeNo}}">
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" name="Maturation[]" value="{{$OOcyteSubDetail->Maturation}}">
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" name="StageGrade[]" value="{{$OOcyteSubDetail->StageGrade}}">
                          </td>
                          <td class="text-left">
                              <div class="form-group">
                              <input type="hidden" value="{{$OOcyteSubDetail->IsThawYes}}" name="IsThawYes[]"  id="IsThawYes{{$rowIdx}}">
                                <div class="icheck-success d-inline">               
                                @if($OOcyteSubDetail->IsThawYes==1)   
                                  <input type="checkbox" id="F{{$rowIdx}}" checked="" class="IsThawYes">
                                @else
                                  <input type="checkbox" id="F{{$rowIdx}}" class="IsThawYes">
                                @endif
                                  <label for="F{{$rowIdx}}">
                                    Yes
                                  </label>
                                </div>
                              </div>
                              <div class="form-group">
                              <input type="hidden" value="{{$OOcyteSubDetail->IsThawNo}}" name="IsThawNo[]"  id="IsThawNo{{$rowIdx}}">
                                <div class="icheck-success d-inline">
                                  @if($OOcyteSubDetail->IsThawNo==1)   
                                  <input type="checkbox" checked=""  id="T{{$rowIdx}}" class="IsThawNo">
                                  @else
                                  <input type="checkbox"  id="T{{$rowIdx}}" class="IsThawNo">
                                  @endif
                                  <label for="T{{$rowIdx}}">
                                    No
                                  </label>
                                </div>
                              </div>                  
                          </td>
                          </tr>
                          <?php $rowIdx++; ?>
                       @endforeach                    
                      </tbody> 
                      <tfoot>
                        <tr>
                          <td>Date/Time</td>
                          <td colspan="2"> 
                            <input type="date" name="FreezingDate" class="form-control" value="{{$OOcyteSub->FreezingDate}}">
                            <input type="time" name="FreezingTime" class="form-control" value="{{$OOcyteSub->FreezingTime}}"> 
                          </td>
                          <td colspan="2"> 
                            <input type="date" name="ThawingDate" class="form-control" value="{{$OOcyteSub->ThawingDate}}">
                            <input type="time" name="ThawingTime" class="form-control" value="{{$OOcyteSub->ThawingTime}}"> 
                          </td>
                        </tr>
                        <tr>
                          <td>Location</td>
                          <td colspan="2"> <input type="text" name="FreezingLocation" class="form-control" value="{{$OOcyteSub->FreezingLocation}}"></td>
                          <td colspan="2"> <input type="text" name="ThawingLocation" class="form-control" value="{{$OOcyteSub->ThawingLocation}}"></td>
                        </tr>
                        <tr>
                          <td>Embryologist</td>
                          <td colspan="2"> 
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <input type="button" value="Emb:" class="btn btn-success float-right">
                              </div>
                              <!-- /btn-group -->
                              <input type="text" class="form-control" id="FreezingEmbName" value="{{$OOcyteSub->FreezingEmbStaff}}">
                            </div>  
                          </td>
                          <td colspan="2"> 
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <input type="button" value="Emb:" class="btn btn-success float-right">
                              </div>
                              <!-- /btn-group -->
                              <input type="text" class="form-control" id="ThawingEmbName" value="{{$OOcyteSub->ThawingEmbStaff}}">
                            </div>
                          </td>
                        </tr>
                      </tfoot>                
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>
              <?php $tableNo++; ?>
              @endforeach 
              @endif
              <hr> 
              @if(!isset($docresults))   
              <div class="form-group row">
                <div class="col-md-3">
                  <label for="docdate" class="col-form-label">Transfer Date</label>
                  <input type="date" class="form-control" id="docdate" name="docdate"/>
                </div>
                <div class="col-md-3">
                  <label for="TransferTime" class="col-form-label">Time</label>
                  <input type="time" class="form-control" id="TransferTime" name="TransferTime"/>
                </div>
                <div class="col-md-3">
                  <label for="NoOfEmbTrans" class="col-form-label">No Of Embryo Trans</label>
                  <input type="text" class="form-control" id="NoOfEmbTrans" name="NoOfEmbTrans"/>
                </div>
                <div class="col-md-3">
                  <label for="NoOfAttempts" class="col-form-label">No Of Attempts</label>
                  <input type="text" class="form-control" id="NoOfAttempts" name="NoOfAttempts"/>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                    <label>AH: &nbsp</label>
                    <div class="icheck-success d-inline">                  
                      <input type="checkbox" id="IsAHYes" class="IsAHYes" name="IsAHYes">
                      <label for="IsAHYes">
                        Yes
                      </label>
                    </div>
                    <div class="icheck-success d-inline">                  
                      <input type="checkbox" id="IsAHNo" class="IsAHNo" name="IsAHNo">
                      <label for="IsAHNo">
                        No
                      </label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <label for="CathLoading" class="col-form-label">Catheter Loading</label>                 
                      <input type="text" id="IsCathLoadingAHYes" class="form-control" name="CathLoading">                      
                  </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Physician:" class="btn btn-success float-right" data-toggle="modal" id="PhysicianStaffName" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="PhysicianStaffId" id="PhysicianStaffId" value="0">
                    <input type="text" class="form-control" id="PhysicianName">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Embryologist:" class="btn btn-success float-right" data-toggle="modal" id="EmbryologistStaffName" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="EmbryologistStaffId" id="EmbryologistStaffId" value="0">
                    <input type="text" class="form-control" id="EmbryologistName">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Nurse:" class="btn btn-success float-right" data-toggle="modal" id="NurseStaffName" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="NurseStaffId" id="NurseStaffId" value="0">
                    <input type="text" class="form-control" id="NurseName">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="Notes">
                    Notes
                  </label>
                  <textarea class="form-control" name="Notes" rows="4"></textarea>
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
              @else
              @foreach($docresults as $docresult)
              <div class="form-group row">
                <div class="col-md-3">
                  <label for="docdate" class="col-form-label">Transfer Date</label>
                  <input type="date" class="form-control" id="docdate" name="docdate" value="{{$docresult->docdate}}" />
                </div>
                <div class="col-md-3">
                  <label for="TransferTime" class="col-form-label">Time</label>
                  <input type="time" class="form-control" id="TransferTime" name="TransferTime" value="{{$docresult->TransferTime}}"/>
                </div>
                <div class="col-md-3">
                  <label for="NoOfEmbTrans" class="col-form-label">No Of Embryo Trans</label>
                  <input type="text" class="form-control" id="NoOfEmbTrans" name="NoOfEmbTrans" value="{{$docresult->NoOfEmbTrans}}"/>
                </div>
                <div class="col-md-3">
                  <label for="NoOfAttempts" class="col-form-label">No Of Attempts</label>
                  <input type="text" class="form-control" id="NoOfAttempts" name="NoOfAttempts" value="{{$docresult->NoOfAttempts}}"/>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                    <label>AH: &nbsp</label>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsAHYes==1)                  
                      <input type="checkbox" checked="" id="IsAHYes" class="IsAHYes" name="IsAHYes">
                      @else
                      <input type="checkbox" id="IsAHYes" class="IsAHYes" name="IsAHYes">
                      @endif
                      <label for="IsAHYes">
                        Yes
                      </label>
                    </div>
                    <div class="icheck-success d-inline">  
                    @if($docresult->IsAHNo==1)                  
                      <input type="checkbox" checked="" id="IsAHNo" class="IsAHNo" name="IsAHNo">
                    @else
                      <input type="checkbox" id="IsAHNo" class="IsAHNo" name="IsAHNo">
                    @endif
                      <label for="IsAHNo">
                        No
                      </label>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <label for="CathLoading" class="col-form-label">Catheter Loading</label>                 
                      <input type="text" id="IsCathLoadingAHYes" class="form-control" name="CathLoading" value="{{$docresult->CathLoading}}">                      
                  </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Physician:" class="btn btn-success float-right" data-toggle="modal" id="PhysicianStaffName" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="PhysicianStaffId" id="PhysicianStaffId" value="0">
                    <input type="text" class="form-control" id="PhysicianName" value="{{$docresult->PhysicianStaffName}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Embryologist:" class="btn btn-success float-right">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="EmbryologistStaffId" id="EmbryologistStaffId" value="0">
                    <input type="text" class="form-control" id="EmbryologistName" value="{{$docresult->EmbryologistStaffName}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Nurse:" class="btn btn-success float-right" >
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="NurseStaffId" id="NurseStaffId" value="0">
                    <input type="text" class="form-control" id="NurseName" value="{{$docresult->NurseStaffName}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="Notes">
                    Notes
                  </label>
                  <textarea class="form-control" name="Notes" rows="4">{{$docresult->Notes}}</textarea>
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
              @endforeach
              @endif
              <div class="row">
                <div class="col-12">
                  <a href="{{route('OOctyeFreezeThawTrans')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                  <a href="{{route('OOctyeFreezeThawTransPrint')}}/{{$intPatientId}}/{{$docId}}" target="_blank" class="btn btn-secondary float-right">Print</a>
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
  <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you to delete?</p>
            </div>
            <form method="POST" action="{{route('OOctyeFreezeThawTransDeleteDetails')}}">
              {{ csrf_field() }}
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete</button>
              </div>
              <input type="hidden" id="del_id" name="del_id" value="0">
              <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
              @if(isset($docId))
              <input type="hidden" name="docId" value="{{$docId}}">
              @endif
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

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

  <script >
    $(document).ready(function(){

    
    var rowIdx = 0;  

    $('.open-modal-delete').click(function(data){
      var id = $(this).val();
      $('#del_id').val(id);
    });                
    
    /* Price List */

    $('#AddProcessedSperm').click(function(){

            $('#tbody').append(`<tr id="R${++rowIdx}">
              <td class="row-index text-center">                
                <input type="text" class="form-control" name="StrawNo[]" value="1">
              </td>
              <td class="text-center">
                <input type="text" class="form-control" name="OoctyeNo[]" >
              </td>
              <td class="text-center">
                <input type="text" class="form-control" name="Maturation[]">
              </td>
              <td class="text-center">
                <input type="text" class="form-control" name="StageGrade[]">
              </td>
              <td class="text-left">
                  <div class="form-group">
                  <input type="hidden" value="0" name="IsThawYes[]"  id="IsThawYes${rowIdx}">
                    <div class="icheck-success d-inline">                  
                      <input type="checkbox" id="F${rowIdx}" class="IsThawYes">
                      <label for="F${rowIdx}">
                        Yes
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                  <input type="hidden" value="0" name="IsThawNo[]"  id="IsThawNo${rowIdx}">
                    <div class="icheck-success d-inline">
                      <input type="checkbox"  id="T${rowIdx}" class="IsThawNo">
                      <label for="T${rowIdx}">
                        No
                      </label>
                    </div>
                  </div>                  
              </td>
              <td class="text-center">
                <input type="button" class="btn btn-danger btn-sm remove-medicine-treatment float-right" value="Remove">

                </td>
              </tr>`);


    });


    $('#FreezingEmbStaffName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
       $('#SelectedModal').val("1");
    });

    $('#ThawingEmbStaffName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
       $('#SelectedModal').val("2");
    });

    $('#PhysicianStaffName').click(function(){
      $('#StaffModalTitle').text('Physician');
       $('#SelectedModal').val("3");
    });

    $('#EmbryologistStaffName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
       $('#SelectedModal').val("4");
    });

    $('#NurseStaffName').click(function(){
      $('#StaffModalTitle').text('Nurse');
       $('#SelectedModal').val("5");
    });

    $('.add-staff').click(function(){

      var med_id = $(this).val();
      var SelectedId = $('#SelectedModal').val();
      url = '{{route('GetStaffInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);


        switch(SelectedId){
          case "1":
            $('#FreezingEmbName').val(data.name); 
            $('#FreezingEmbStaffId').val(data.id); 
            break;

          case "2":
            $('#ThawingEmbName').val(data.name); 
            $('#ThawingEmbStaffId').val(data.id); 
            break;

          case "3":
            $('#PhysicianName').val(data.name); 
            $('#PhysicianStaffId').val(data.id); 
            break;

          case "4":
            $('#EmbryologistName').val(data.name); 
            $('#EmbryologistStaffId').val(data.id); 
            break;

          default:
            $('#NurseName').val(data.name); 
            $('#NurseStaffId').val(data.id); 

        }

        $('#SelectedModal').val("0");
      });

      $('#open-modal-staff').modal('toggle'); 

    });


   // jQuery button click event to remove a row.
    $('#tbody').on('click', '.IsThawYes', function () {

      var id = $(this).attr('id');
      var dig = parseInt(id.substring(1));

      var curval = $('#IsThawYes'+dig).val();
      if(curval==0)
      {
        $('#IsThawYes'+dig).val(1);
      }
      else
      {
         $('#IsThawYes'+dig).val(0);
      }

    });

    $('#tbody').on('click', '.IsThawNo', function () {

      var id = $(this).attr('id');
      var dig = parseInt(id.substring(1));

      var curval = $('#IsThawNo'+dig).val();
      if(curval==0)
      {
        $('#IsThawNo'+dig).val(1);
      }
      else
      {
         $('#IsThawNo'+dig).val(0);
      }

    });

    $('#tbody').on('click', '.remove-medicine-treatment', function () {


      // Getting all the rows next to the row
      // containing the clicked button
      var child = $(this).closest('tr').nextAll();

      // // Iterating across all the rows
      // // obtained to change the index
      // child.each(function () {

      //             // Getting <tr> id.
      //             var id = $(this).attr('id');

      //             // Getting the <p> inside the .row-index class.
      //             var idx = $(this).children('.row-index').children('p');

      //             // Gets the row number from <tr> id.
      //             var dig = parseInt(id.substring(1));

      //             // Modifying row index.
      //             idx.html(`${dig - 1}`);

      //             // Modifying row id.
      //             $(this).attr('id', `R${dig - 1}`);
      // });

      // Removing the current row.
      $(this).closest('tr').remove();

      // Decreasing total number of rows by 1.
      // rowIdx--;
    });

    });

/* Lead Assessement */


  </script>
@endsection