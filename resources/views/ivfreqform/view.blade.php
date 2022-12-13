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
                  <label for="docdate" class="col-form-label">Date</label>
                  <input type="date" class="form-control" id="docdate" name="docdate" value="{{$docresult->docdate}}" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Patient's Physician" class="btn btn-success float-right">
                    </div>
                    <!-- /btn-group -->
                    <input type="text" class="form-control" id="PhysicianName" value="{{$docresult->StaffName}}">
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
                                @if($docresult->IsFemalePartner==1)
                                <input type="checkbox" name="IsFemalePartner" id="IsFemalePartner" checked>
                                @else
                                <input type="checkbox" name="IsFemalePartner" id="IsFemalePartner">
                                @endif
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
                                  <input type="text" name="BaselineFSH" class="form-control" id="BaselineFSH" value="{{$docresult->BaselineFSH}}">
                              </div>
                              <div class="col-md-4">  
                                  <label for="UTLining">
                                    UT Lining
                                  </label>
                                  <input type="text" name="UTLining" class="form-control" id="UTLining" value="{{$docresult->UTLining}}">
                              </div>
                              <div class="col-md-4">    
                                  <label for="AMH">
                                    AMH
                                  </label>
                                  <input type="text" name="AMH" class="form-control" id="AMH" value="{{$docresult->AMH}}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-md-12">  
                                  <label for="OocyteSoureValid">
                                    Inf. Dis/. FDA Testing/Screening completed and valid
                                  </label>
                                  <input type="text" name="OocyteSoureValid" class="form-control" id="OocyteSoureValid" value="{{$docresult->OocyteSoureValid}}">
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
                                @if($docresult->IsMalePartner)
                                <input type="checkbox" name="IsMalePartner" id="IsMalePartner" checked>
                                @else
                                <input type="checkbox" name="IsMalePartner" id="IsMalePartner">
                                @endif
                                <label for="IsMalePartner">
                                  Male Partner
                                </label>
                              </div>                   
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group">
                              <div class="icheck-success d-inline">
                                @if($docresult->IsFresh==1)
                                <input type="checkbox" name="IsFresh" id="IsFresh" checked>
                                @else
                                <input type="checkbox" name="IsFresh" id="IsFresh">
                                @endif
                                <label for="IsFresh">
                                  Fresh
                                </label>
                              </div>                   
                            </div>
                            <div class="form-group">
                              <div class="icheck-success d-inline">
                                @if($docresult->IsFrozen==1)
                                <input type="checkbox" name="IsFrozen" id="IsFrozen" checked>
                                @else
                                <input type="checkbox" name="IsFrozen" id="IsFrozen">
                                @endif
                                <label for="IsFrozen">
                                  Frozen
                                </label>
                              </div>                   
                            </div>
                            <div class="form-group">
                              <div class="icheck-success d-inline">
                                @if($docresult->IsTESE==1)
                                <input type="checkbox" name="IsTESE" id="IsTESE" checked>
                                @else
                                <input type="checkbox" name="IsTESE" id="IsTESE">
                                @endif
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
                                  <input type="text" name="SpermSourceValid" class="form-control" id="SpermSourceValid" value="{{$docresult->SpermSourceValid}}">
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
                  <input type="text" class="form-control" id="Dx" name="Dx" value="{{$docresult->Dx}}"/>
                </div>              
                <div class="col-md-1">
                  <label for="G" class="col-form-label">G</label>
                  <input type="text" class="form-control" id="G" name="G" value="{{$docresult->G}}"/>
                </div>
                <div class="col-md-1">
                  <label for="P" class="col-form-label">P</label>
                  <input type="text" class="form-control" id="P" name="P" value="{{$docresult->P}}"/>
                </div>
                <div class="col-md-1">
                  <label for="T" class="col-form-label">T</label>
                  <input type="text" class="form-control" id="T" name="T" value="{{$docresult->T}}"/>
                </div>
                <div class="col-md-1">
                  <label for="A" class="col-form-label">A</label>
                  <input type="text" class="form-control" id="A" name="A" value="{{$docresult->A}}"/>
                </div>
                <div class="col-md-1">
                  <label for="L" class="col-form-label">L</label>
                  <input type="text" class="form-control" id="L" name="L" value="{{$docresult->L}}"/>
                </div>
              </div>
              <h3>Medication</h3>
              <div class="form-group row">                
                <div class="col-md-6">
                  <label for="Protocol" class="col-form-label">Protocol</label>
                  <input type="text" class="form-control" id="Protocol" name="Protocol" value="{{$docresult->Protocol}}"/>
                </div>
                <div class="col-md-6">
                  <label for="Cycle" class="col-form-label">Cycle</label>
                  <input type="text" class="form-control" id="Cycle" name="Cycle" value="{{$docresult->Cycle}}"/>
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
                      </tr>                  
                      </thead>
                      <tbody id="tbody">
                        <?php $intcrM = 1; ?>
                        @foreach($IVFReqFormMeds as $IVFReqFormMed)
                       <tr id="R{{$intcrM}}">
                        <td class="row-index text-center">
                          <input type="hidden" class="medid" name="MedId[]" value="{{$IVFReqFormMed->id}}">
                          <p>{{$intcrM}}</p>
                        </td>
                        <td class="text-center">
                        {{$IVFReqFormMed->description}}
                        </td>
                        <td class="text-center"><input type="number" class="form-control" name="MedDosage[]" value="{{$IVFReqFormMed->MedDosage}}"></td>
                        <td>
                          <select name="MedUnitId[]" class="form-control" aria-invalid="false">
                            @foreach($MedicineUnits as $MedicineUnit)
                              @if($MedicineUnit->id==$IVFReqFormMed->MedUnitId)
                            <option value="{{$MedicineUnit->id}}" selected>{{$MedicineUnit->ShortSymbol}}</option>
                              @else
                            <option value="{{$MedicineUnit->id}}">{{$MedicineUnit->ShortSymbol}}</option>
                              @endif
                            @endforeach
                          </select>
                        </td>
                        </tr> 
                      <?php $intcrM++; ?>
                        @endforeach
        
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>
              <hr>
              <h3>Procedure Ordered</h3>  
              <div class="row">
                <div class="col-12">
                <!-- /.card-header -->
                    <!-- <table id="example1" class="table table-bordered table-striped"> -->
                    <table  class="table table-bordered table-striped">
                      <thead>                  
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Procedure</th>
                      </tr>                  
                      </thead>
                      <tbody id="tbody_pro">
                        <?php $intctrP=1; ?>
                        @foreach($IVFProcOrds as $IVFProcOrd)
                        <tr id="R{{$intctrP}}">
                        <td class="row-index text-center">
                        <input type="hidden" name="ProcedureId[]" value="{{$IVFProcOrd->id}}">
                          <p>{{$intctrP}}</p>
                        </td>
                        <td class="text-center">
                          {{$IVFProcOrd->description}}
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
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsICSI==1)
                      <input type="checkbox" name="IsICSI" id="IsICSI" checked>
                      @else
                      <input type="checkbox" name="IsICSI" id="IsICSI">
                      @endif
                      <label for="IsICSI">
                        ICSI
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsAssHatching==1)
                      <input type="checkbox" name="IsAssHatching" id="IsAssHatching" checked>
                      @else
                      <input type="checkbox" name="IsAssHatching" id="IsAssHatching">
                      @endif
                      <label for="IsAssHatching">
                        Assissted Hatching
                      </label>
                    </div> 
                    <div class="icheck-success d-inline">
                      @if($docresult->IsEmbBxFSH==1)
                      <input type="checkbox" name="IsEmbBxFSH" id="IsEmbBxFSH" checked>
                      @else
                      <input type="checkbox" name="IsEmbBxFSH" id="IsEmbBxFSH">
                      @endif
                      <label for="IsEmbBxFSH">
                        Embryo Bx for FSH
                      </label>
                    </div>  
                    <div class="icheck-success d-inline">
                      @if($docresult->IsEmbBxAcgh==1)
                      <input type="checkbox" name="IsEmbBxAcgh" id="IsEmbBxAcgh" checked>
                      @else
                      <input type="checkbox" name="IsEmbBxAcgh" id="IsEmbBxAcgh">
                      @endif
                      <label for="IsEmbBxAcgh">
                        Embryo Bx for Acgh
                      </label>
                    </div>                 
                  </div>                  
                </div>
              </div>
              <hr>
              <h3>OV. STM./Retrieval Info</h3>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="PeakE2" class="col-form-label">Peack E2</label>
                    <input type="text" class="form-control" id="PeakE2" name="PeakE2" value="{{$docresult->PeakE2}}"/>                     
                  </div>                  
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="NoFollHcgInjDays" class="col-form-label">No. Follicles on hCG inj. Day</label>
                    <input type="text" class="form-control" id="NoFollHcgInjDays" name="NoFollHcgInjDays" value="{{$docresult->NoFollHcgInjDays}}"/>                     
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="StimDays" class="col-form-label">Stimulation Days</label>
                    <input type="text" class="form-control" id="StimDays" name="StimDays" value="{{$docresult->StimDays}}">  
                  </div>                  
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="CycleStartDate" class="col-form-label">Cycle start Date</label>
                    <input type="date" class="form-control" id="CycleStartDate" name="CycleStartDate" value="{{$docresult->CycleStartDate}}">  
                  </div>                  
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="PatientCoastedDays" class="col-form-label">Patient Coasted (Days)</label>
                    <input type="text" class="form-control" id="PatientCoastedDays" name="PatientCoastedDays" value="{{$docresult->PatientCoastedDays}}"> 
                  </div>                  
                </div>
              </div>
              Chromosomal Study
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsPGTA==1)
                      <input type="checkbox" name="IsPGTA" id="IsPGTA" checked>
                      @else
                      <input type="checkbox" name="IsPGTA" id="IsPGTA">
                      @endif
                      <label for="IsPGTA">
                        PGTA
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsGenderSel==1)
                      <input type="checkbox" name="IsGenderSel" id="IsGenderSel" checked>
                      @else
                      <input type="checkbox" name="IsGenderSel" id="IsGenderSel">
                      @endif
                      <label for="IsGenderSel">
                        Gender Selection
                      </label>
                    </div> 
                    <div class="icheck-success d-inline">
                      @if($docresult->IsPGTM==1)
                      <input type="checkbox" name="IsPGTM" id="IsPGTM" checked>
                      @else
                      <input type="checkbox" name="IsPGTM" id="IsPGTM">
                      @endif
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
                    <input type="date" class="form-control" id="HcgDate" name="HcgDate" value="{{$docresult->HcgDate}}">  
                  </div>                  
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="HcgTime" class="col-form-label">Time</label>
                    <input type="time" class="form-control" id="HcgTime" name="HcgTime" value="{{$docresult->HcgTime}}"> 
                  </div>                  
                </div> 
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="ErDate" class="col-form-label">ER Date</label>
                    <input type="date" class="form-control" id="ErDate" name="ErDate" value="{{$docresult->ErDate}}"> 
                  </div>                  
                </div>  
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="ErTime" class="col-form-label">Time</label>
                    <input type="time" class="form-control" id="ErTime" name="ErTime" value="{{$docresult->ErTime}}"> 
                  </div>                  
                </div>             
              </div>            
              <hr>
              <div class="row">
                <div class="col-md-12">
                  Embryo Transfer
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsBryoTransYes)
                      <input type="checkbox" name="IsBryoTransYes" id="IsBryoTransYes" checked>
                      @else
                      <input type="checkbox" name="IsBryoTransYes" id="IsBryoTransYes">
                      @endif
                      <label for="IsBryoTransYes">
                        Yes
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsBryoTransNo)
                      <input type="checkbox" name="IsBryoTransNo" id="IsBryoTransNo" checked>
                      @else
                      <input type="checkbox" name="IsBryoTransNo" id="IsBryoTransNo">
                      @endif
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
                    <textarea class="form-control" name="Notes" id="Notes" rows="5">{{$docresult->Notes}}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <a href="{{asset($docresult->filelink)}}" target="_blank">Existing File...</a>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <a href="{{route('OVFReqForm')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                  <a href="{{route('PrintOVFReqForm')}}/{{$docId}}" target="_blank" class="btn btn-secondary float-right">Print</a>
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