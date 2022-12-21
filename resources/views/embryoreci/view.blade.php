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
              <h3 class="card-title">Embryology Record I</h3>

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
              <div class="col-md-3">
                <label for="RecordNo" class="col-form-label">Record No</label>
                <input type="text" class="form-control" id="RecordNo" name="RecordNo" value="{{$docresult->RecordNo}}"/>
              </div> 
                            
            </div>
            <hr>
            <div class="form-group row">  
              <div class="col-md-4">
                  <label>Message Ok? &nbsp</label>
                  <div class="icheck-success d-inline">
                    @if(!$docresult->IsMssgYes)                  
                    <input type="checkbox" id="IsMssgYes" name="IsMssgYes">
                    @else
                    <input type="checkbox" id="IsMssgYes" name="IsMssgYes" checked="">
                    @endif
                    <label for="IsMssgYes">
                      Yes
                    </label>
                  </div>
                  <div class="icheck-success d-inline">   
                    @if($docresult->IsMssgNo)               
                    <input type="checkbox" id="IsMssgNo" name="IsMssgNo" checked="">
                    @else
                    <input type="checkbox" id="IsMssgNo" name="IsMssgNo">
                    @endif
                    <label for="IsMssgNo">
                      No
                    </label>
                  </div>
                </div>  
                <div class="col-md-8">
                  <label>Cycle Type: &nbsp</label>
                  <div class="icheck-success d-inline">                  
                    @if($docresult->IsIVF)
                    <input type="checkbox" id="IsIVF" name="IsIVF" checked="">
                    @else
                    <input type="checkbox" id="IsIVF" name="IsIVF">
                    @endif
                    <label for="IsIVF">
                      IVF
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    @if($docresult->IsICSC)
                    <input type="checkbox" id="IsICSC" name="IsICSC" checked="">
                    @else
                    <input type="checkbox" id="IsICSC" name="IsICSC">
                    @endif
                    <label for="IsICSC">
                      ICSC
                    </label>
                  </div>
                  <div class="icheck-success d-inline">          
                    @if($docresult->IsPGTA)        
                    <input type="checkbox" id="IsPGTA" name="IsPGTA" checked="">
                    @else
                    <input type="checkbox" id="IsPGTA" name="IsPGTA">
                    @endif
                    <label for="IsPGTA">
                      PGT-A
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    @if($docresult->IsPGTAM)
                    <input type="checkbox" id="IsPGTAM" name="IsPGTAM" checked="">
                    @else
                    <input type="checkbox" id="IsPGTAM" name="IsPGTAM">
                    @endif
                    <label for="IsPGTAM">
                      PGT-M
                    </label>
                  </div>
                  <div class="icheck-success d-inline">  
                    @if($docresult->IsBabayGender)                
                    <input type="checkbox" id="IsBabayGender" name="IsBabayGender" checked="">
                    @else
                    <input type="checkbox" id="IsBabayGender" name="IsBabayGender">
                    @endif
                    <label for="IsBabayGender">
                      Baby Gender
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    @if($docresult->IsOOctye)
                    <input type="checkbox" id="IsOOctye" name="IsOOctye" checked="">
                    @else
                    <input type="checkbox" id="IsOOctye" name="IsOOctye">
                    @endif
                    <label for="IsOOctye">
                      OOctye Vitrification
                    </label>
                  </div>
                </div>             
              </div>
              <hr>
              <div class="form-group row">
                <div class="col-md-3">
                  <label for="hCGDate" class="col-form-label">hCG Date</label>
                  <input type="date" class="form-control" id="hCGDate" name="hCGDate" value="{{$docresult->hCGDate}}" />
                </div>
                <div class="col-md-3">
                  <label for="hCGTime" class="col-form-label">hCG Time</label>
                  <input type="time" class="form-control" id="hCGTime" name="hCGTime" value="{{$docresult->hCGTime}}" />
                </div>
                <div class="col-md-3">
                  <label for="NoFoll" class="col-form-label"># Foll>=12</label>
                  <input type="number" class="form-control" id="NoFoll" name="NoFoll" value="{{$docresult->NoFoll}}"/>
                </div>
                <div class="col-md-3">
                  <label for="MaxE2" class="col-form-label">Max E2</label>
                  <input type="text" class="form-control" id="MaxE2" name="MaxE2" value="{{$docresult->MaxE2}}"/>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-2">
                  <label>Lupron &nbsp</label>
                  <div class="icheck-success">                  
                    @if($docresult->IsLupronYes)
                    <input type="checkbox" id="IsLupronYes" name="IsLupronYes" checked="">
                    @else
                    <input type="checkbox" id="IsLupronYes" name="IsLupronYes">
                    @endif
                    <label for="IsLupronYes">
                      Yes
                    </label>
                  </div>
                  <div class="icheck-success">                  
                    @if($docresult->IsLupronNo)
                    <input type="checkbox" id="IsLupronNo" name="IsLupronNo" checked="">
                    @else
                    <input type="checkbox" id="IsLupronNo" name="IsLupronNo">
                    @endif
                    <label for="IsLupronNo">
                      No
                    </label>
                  </div>
                </div> 
                <div class="col-md-4">
                  <label for="InfeDruAmount" class="col-form-label">Infertility Drugs & Amount</label>
                  <input type="text" class="form-control" id="InfeDruAmount" name="InfeDruAmount" value="{{$docresult->InfeDruAmount}}" />
                </div>
                <div class="col-md-3">
                  <label for="CycleNo" class="col-form-label">Cycle No</label>
                  <input type="number" class="form-control" id="CycleNo" name="CycleNo" value="{{$docresult->CycleNo}}"/>
                </div>
                <div class="col-md-3">
                  <label for="CycleDate" class="col-form-label">Cycle Date</label>
                  <input type="date" class="form-control" id="CycleDate" name="CycleDate" value="{{$docresult->CycleDate}}"/>
                </div>                
              </div>
              <hr>
              <div class="form-group row">
                <div class="col-md-3">
                  <label for="G" class="col-form-label">G</label>
                  <input type="text" class="form-control" id="G" name="G" value="{{$docresult->G}}"/>
                </div>
                <div class="col-md-3">
                  <label for="P" class="col-form-label">P</label>
                  <input type="text" class="form-control" id="P" name="P" value="{{$docresult->P}}"/>
                </div>
                <div class="col-md-3">
                  <label for="A" class="col-form-label">A</label>
                  <input type="text" class="form-control" id="A" name="A" value="{{$docresult->A}}"/>
                </div>
                <div class="col-md-3">
                  <label for="E" class="col-form-label">E</label>
                  <input type="text" class="form-control" id="E" name="E" value="{{$docresult->E}}"/>
                </div>
              </div>
              <div class="form-group row">
                  <div class="col-md-6">
                    <label for="dx1" class="col-form-label">1 dx</label>
                    <input type="text" class="form-control" id="dx1" name="dx1" value="{{$docresult->dx1}}"/>
                  </div>
                  <div class="col-md-6">
                    <label for="dx2" class="col-form-label">2 dx</label>
                    <input type="text" class="form-control" id="dx2" name="dx2" value="{{$docresult->dx2}}"/>
                  </div>
                  <div class="col-md-6">
                    <label for="Ethnicity" class="col-form-label">Ethnicity</label>
                    <input type="text" class="form-control" id="Ethnicity" name="Ethnicity" value="{{$docresult->Ethnicity}}"/>
                  </div>
                  <div class="col-md-6">
                    <label for="Town" class="col-form-label">Town</label>
                    <input type="text" class="form-control" id="Town" name="Town" value="{{$docresult->Town}}"/>
                  </div>                
              </div>
              <hr>

              <h4>Egg Retrieval: Day 0</h4>
              <div class="form-group row">
                  <div class="col-md-3">
                    <label for="RetDate" class="col-form-label">Ret Date</label>
                    <input type="date" class="form-control" id="RetDate" name="RetDate" value="{{$docresult->RetDate}}"/>
                  </div>
                  <div class="col-md-3">
                    <label for="RetNoOfEggs" class="col-form-label"># of Eggs</label>
                    <input type="number" class="form-control" id="RetNoOfEggs" name="RetNoOfEggs" value="{{$docresult->RetNoOfEggs}}"/>
                  </div>
                  <div class="col-md-3">
                    <label for="RetStartTime" class="col-form-label">Start Time</label>
                    <input type="time" class="form-control" id="RetStartTime" name="RetStartTime" value="{{$docresult->RetStartTime}}"/>
                  </div>
                  <div class="col-md-3">
                    <label for="RetFinishTime" class="col-form-label">Finish Time</label>
                    <input type="time" class="form-control" id="RetFinishTime" name="RetFinishTime" value="{{$docresult->RetFinishTime}}"/>
                  </div>                
              </div>
              <div class="form-group row">
                <div class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Anesthesiologist:" class="btn btn-success float-right" data-toggle="modal" id="RetAnesthesiologistStaffName" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="RetAnesthesiologistStaffId" id="RetAnesthesiologistStaffId" value="{{$docresult->RetAnesthesiologistStaffId}}">
                    <input type="text" class="form-control" id="RetAnesthesiologistName" value="{{$docresult->RetAnesthesiologistName}}">
                  </div>
                </div>  
                <div class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Nurse:" class="btn btn-success float-right" data-toggle="modal" id="RetNurseStaffName" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="RetNurseStaffId" id="RetNurseStaffId" value="{{$docresult->RetNurseStaffId}}">
                    <input type="text" class="form-control" id="RetNurseName" value="{{$docresult->RetNurseName}}">
                  </div>
                </div>              
                <div class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Embryologist:" class="btn btn-success float-right" data-toggle="modal" id="RetEmbStaffName" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="RetEmbStaffId" id="RetEmbStaffId" value="{{$docresult->RetEmbStaffId}}">
                    <input type="text" class="form-control" id="RetEmbName" value="{{$docresult->RetEmbName}}">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Physician:" class="btn btn-success float-right" data-toggle="modal" id="RetPhysicianStaffName" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="RetPhysicianStaffId" id="RetPhysicianStaffId" value="{{$docresult->RetPhysicianStaffId}}">
                    <input type="text" class="form-control" id="RetPhysicianName" value="{{$docresult->RetPhysicianName}}">
                  </div>
                </div>  
              </div>
              <div class="form-group row">
                <div class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Wrist Check By:" class="btn btn-success float-right" data-toggle="modal" id="RetWristCheckByStaffName" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="RetWristCheckByStaffId" id="RetWristCheckByStaffId"  value="{{$docresult->RetWristCheckByStaffId}}">
                    <input type="text" class="form-control" id="RetWristCheckByName" value="{{$docresult->RetWristCheckByName}}">
                  </div>
                </div>              
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="RetComments">
                    Comments
                  </label>
                  <textarea class="form-control" id="RetComments" name="RetComments" rows="4">{{$docresult->RetComments}}</textarea>
                </div>
              </div>
              <hr>
              <div class="form-group row"> 
               <div class="col-md-4">
                  <label>Sperm: &nbsp;</label>
                  <div class="icheck-success d-inline">                  
                    @if($docresult->IsFresh)
                    <input type="checkbox" id="IsFresh" name="IsFresh" checked="">
                    @else
                    <input type="checkbox" id="IsFresh" name="IsFresh">
                    @endif
                    <label for="IsFresh">
                      Fresh
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    @if($docresult->IsFrozen)
                    <input type="checkbox" id="IsFrozen" name="IsFrozen" checked="">
                    @else
                    <input type="checkbox" id="IsFrozen" name="IsFrozen">
                    @endif
                    <label for="IsFrozen">
                      Frozen
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    @if($docresult->IsTESE)
                    <input type="checkbox" id="IsTESE" name="IsTESE" checked="">
                    @else
                    <input type="checkbox" id="IsTESE" name="IsTESE">
                    @endif
                    <label for="IsTESE">
                      TESE
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    @if($docresult->IsMESA)
                    <input type="checkbox" id="IsMESA" name="IsMESA" checked="">
                    @else
                    <input type="checkbox" id="IsMESA" name="IsMESA">
                    @endif
                    <label for="IsMESA">
                      MESA
                    </label>
                  </div>
                </div>   

                <div class="col-md-8">
                  <label>Prep Method: &nbsp;</label>
                  <div class="icheck-success d-inline">                  
                    @if($docresult->IsPreMetIsolate)
                    <input type="checkbox" id="IsPreMetIsolate" name="IsPreMetIsolate" checked="">
                    @else
                    <input type="checkbox" id="IsPreMetIsolate" name="IsPreMetIsolate">
                    @endif
                    <label for="IsPreMetIsolate">
                      Isolate
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    @if($docresult->IsPreMetWashOnly)
                    <input type="checkbox" id="IsPreMetWashOnly" name="IsPreMetWashOnly" checked="">
                    @else
                    <input type="checkbox" id="IsPreMetWashOnly" name="IsPreMetWashOnly">
                    @endif
                    <label for="IsPreMetWashOnly">
                      Wash Only
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    @if($docresult->IsPreMetPentoxifyline)
                    <input type="checkbox" id="IsPreMetPentoxifyline" name="IsPreMetPentoxifyline" checked="">
                    @else
                    <input type="checkbox" id="IsPreMetPentoxifyline" name="IsPreMetPentoxifyline">
                    @endif
                    <label for="IsPreMetPentoxifyline">
                      Pentoxifyline
                    </label>
                  </div>
                </div> 

              </div>

              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Pre Wash</th>
                            <th>Post Wash</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Vol(mL)</td>
                            <td><input type="number" class="form-control" name="PreWashVol" value="{{$docresult->PreWashVol}}"> </td>
                            <td><input type="number" class="form-control" name="PosWashVol" value="{{$docresult->PosWashVol}}"></td>
                          </tr>
                          <tr>
                            <td>Conc(x10/mL)</td>
                            <td><input type="number" class="form-control" name="PreWashConc" value="{{$docresult->PreWashConc}}"> </td>
                            <td><input type="number" class="form-control" name="PosWashConc" value="{{$docresult->PosWashConc}}"> </td>
                          </tr>
                          <tr>
                            <td>Motility(%)</td>
                            <td><input type="number" class="form-control" name="PreWashMotility" value="{{$docresult->PreWashMotility}}"> </td>
                            <td><input type="number" class="form-control" name="PosWashMotility" value="{{$docresult->PosWashMotility}}"> </td>
                          </tr>
                          <tr>
                            <td>Progression (1-4)</td>
                            <td><input type="number" class="form-control" name="PreWashProg" value="{{$docresult->PreWashProg}}"> </td>
                            <td><input type="number" class="form-control" name="PosWashProg" value="{{$docresult->PosWashProg}}"></td>
                          </tr>
                          <tr>
                            <td>Tech:</td>
                            <td><input type="text" class="form-control" name="PreWashTech" value="{{$docresult->PreWashTech}}"> </td>
                            <td><input type="text" class="form-control" name="PosWashTech" value="{{$docresult->PosWashTech}}"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <label for="SpermComments">
                    Comments
                  </label>
                  <textarea class="form-control" id="SpermComments" name="SpermComments" rows="4"> {{$docresult->SpermComments}}</textarea>
                </div>
              </div>

              <hr>
              
              
              <div class="row">

                <div class="col-md-3">
                  <div class="card">
                    <div class="card-header">
                      Insem Instructions
                    </div>
                    <div class="card-body">                  
                      <div class="row">
                        <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="InsInsICSI">ICSI</label>
                            <input type="text" class="form-control" name="InsInsICSI" id="InsInsICSI"  value="{{$docresult->InsInsICSI}}">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="InsInsConv">Conv</label>
                            <input type="text" class="form-control" id="InsInsConv" name="InsInsConv" value="{{$docresult->InsInsConv}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="InsInsTime">Insem Time</label>
                            <input type="time" class="form-control" id="InsInsTime" name="InsInsTime" value="{{$docresult->InsInsTime}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <input type="button" value="Embryologist:" class="btn btn-success float-right" data-toggle="modal" id="InsInsEmbrStaffName" data-target="#open-modal-staff">
                            </div>
                            <!-- /btn-group -->
                            <input type="hidden" class="form-control" name="InsInsEmbrStaffId" id="InsInsEmbrStaffId" value="{{$docresult->InsInsEmbrStaffId}}">
                            <input type="text" class="form-control" id="InsInsEmbrName" value="{{$docresult->InsInsEmbrName}}">
                          </div>
                          </div>
                        </div>
                      </div>
                        <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                              <label for="InsInsID">2 ID</label>
                              <input type="text" name="InsInsID" class="form-control" id="InsInsID" value="{{$docresult->InsInsID}}">
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="card">
                    <div class="card-header">
                      Fertiliztion Results
                    </div>
                    <div class="card-body">                  
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="FerRes2PN"># 2PN</label>
                            <input type="text" class="form-control" name="FerRes2PN" id="FerRes2PN" value="{{$docresult->FerRes2PN}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="FerRes1PN"># 1PN</label>
                            <input type="text" class="form-control" name="FerRes1PN" id="FerRes1PN"  value="{{$docresult->FerRes1PN}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="FerRes3PN">>= 3 PN</label>
                            <input type="text" class="form-control" name="FerRes3PN" id="FerRes3PN" value="{{$docresult->FerRes3PN}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <input type="button" value="Embryologist:" class="btn btn-success float-right" data-toggle="modal" id="FerResEmbrStaffName" data-target="#open-modal-staff">
                            </div>
                            <!-- /btn-group -->
                            <input type="hidden" class="form-control" name="FerResEmbrStaffId" id="FerResEmbrStaffId" value="{{$docresult->FerResEmbrStaffId}}">
                            <input type="text" class="form-control" id="FerResEmbrName" value="{{$docresult->FerResEmbrName}}">
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="card">
                    <div class="card-header">
                      Hyalurodidase
                    </div>
                    <div class="card-body">                  
                      <div class="row">
                        <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="HvaTime">Time</label>
                            <input type="time" class="form-control" name="HvaTime" id="HvaTime" value="{{$docresult->HvaTime}}">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="HvaTech">Tech</label>
                            <input type="text" class="form-control" name="HvaTech" id="HvaTech" value="{{$docresult->HvaTech}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="HvaMII">#MII</label>
                            <input type="text" class="form-control" name="HvaMII" id="HvaMII" value="{{$docresult->HvaMII}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="HvaMI">#MI</label>
                            <input type="text" class="form-control" name="HvaMI" id="HvaMI" value="{{$docresult->HvaMI}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="HvaGV">#GV</label>
                            <input type="text" class="form-control" name="HvaGV" id="HvaGV" value="{{$docresult->HvaGV}}">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="HvaOther">#Other</label>
                            <input type="text" class="form-control" name="HvaOther" id="HvaOther" value="{{$docresult->HvaOther}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="card">
                    <div class="card-header">ICSI</div>
                    <div class="card-body">                  
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="ICSITotalInj">Total # Injected</label>
                            <input type="number" class="form-control" name="ICSITotalInj" id="ICSITotalInj" value="{{$docresult->ICSITotalInj}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <input type="button" value="Embryologist:" class="btn btn-success float-right" data-toggle="modal" id="ICSIEmbStaffName" data-target="#open-modal-staff">
                            </div>
                            <!-- /btn-group -->
                            <input type="hidden" class="form-control" name="ICSIEmbStaffId" id="ICSIEmbStaffId"  value="{{$docresult->ICSIEmbStaffId}}">
                            <input type="text" class="form-control" id="ICSIEmbName" value="{{$docresult->ICSIEmbName}}">
                          </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <label for="ICSIComments"> Comments</label>
                          <input type="text" name="ICSIComments" id="ICSIComments" class="form-control" value="{{$docresult->ICSIComments}}">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <hr>

              <div class="row">  
                <div class="card  col-12">
                  <div class="card-header">
                    Embryo Transfer
                  </div>
                  <div class="card-body">          
                  <div class="row">                
                    <div class="col-md-8">
                      <div class="form-group row">
                        <div class="col-sm-6">
                          <label for="EmbTranDate">Date</label>
                          <input type="date" name="EmbTranDate" id="EmbTranDate" class="form-control"  value="{{$docresult->EmbTranDate}}">
                        </div>
                        <div class="col-sm-6">
                          <label for="EmbTranTime">Time</label>
                          <input type="time" name="EmbTranTime" id="EmbTranTime" class="form-control" value="{{$docresult->EmbTranTime}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-4">
                          <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <input type="button" value="Physician:" class="btn btn-success float-right" data-toggle="modal" id="EmbTranPhysiStaffname" data-target="#open-modal-staff">
                                </div>
                                <!-- /btn-group -->
                                <input type="hidden" class="form-control" name="EmbTranPhysiStaffId" id="EmbTranPhysiStaffId" value="{{$docresult->EmbTranPhysiStaffId}}">
                                <input type="text" class="form-control" id="EmbTranPhysiName" value="{{$docresult->EmbTranPhysiName}}"> 
                              </div>
                              </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <input type="button" value="Embryologist:" class="btn btn-success float-right" data-toggle="modal" id="EmbTranEmbrStaffName" data-target="#open-modal-staff">
                                </div>
                                <!-- /btn-group -->
                                <input type="hidden" class="form-control" name="EmbTranEmbrStaffId" id="EmbTranEmbrStaffId" value="{{$docresult->EmbTranEmbrStaffId}}">
                                <input type="text" class="form-control" id="EmbTranEmbrName" value="{{$docresult->EmbTranEmbrName}}">
                              </div>
                              </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <input type="button" value="Nurse:" class="btn btn-success float-right" data-toggle="modal" id="EmbTranNurseStaffName" data-target="#open-modal-staff">
                                </div>
                                <!-- /btn-group -->
                                <input type="hidden" class="form-control" name="EmbTranNurseStaffId" id="EmbTranNurseStaffId"  value="{{$docresult->EmbTranNurseStaffId}}">
                                <input type="text" class="form-control" id="EmbTranNurseName" value="{{$docresult->EmbTranNurseName}}">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="form-group row">

                        <div class="col-sm-12">
                            <label for="EmbTranID">2 ID</label>
                            <input type="text" name="EmbTranID" id="EmbTranID" class="form-control" value="{{$docresult->EmbTranID}}">  
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="EmbTranCatheter">Catheter</label>
                          <input type="text" name="EmbTranCatheter" id="EmbTranCatheter" class="form-control" value="{{$docresult->EmbTranCatheter}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-6">
                          <label for="EmbTranNoAttempts"># Attempts</label>
                          <input type="number" name="EmbTranNoAttempts" id="EmbTranNoAttempts" class="form-control" value="{{$docresult->EmbTranNoAttempts}}">
                        </div>
                        <div class="col-sm-6">
                          <label for="EmbTranNoRet"># Retained</label>
                          <input type="number" name="EmbTranNoRet" id="EmbTranNoRet" class="form-control" value="{{$docresult->EmbTranNoRet}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-3">
                          <label>Tenac used: &nbsp</label>
                            <div class="icheck-success d-inline">                  
                              @if($docresult->IsEmbTranTenaYes)
                              <input type="checkbox" id="IsEmbTranTenaYes" name="IsEmbTranTenaYes" checked="">
                              @else
                              <input type="checkbox" id="IsEmbTranTenaYes" name="IsEmbTranTenaYes">
                              @endif
                              <label for="IsEmbTranTenaYes">
                                Yes
                              </label>
                            </div>
                            <div class="icheck-success d-inline">      
                              @if($docresult->IsEmbTranTeanNo)            
                              <input type="checkbox" id="IsEmbTranTeanNo" name="IsEmbTranTeanNo" checked="">
                              @else
                              <input type="checkbox" id="IsEmbTranTeanNo" name="IsEmbTranTeanNo">
                              @endif
                              <label for="IsEmbTranTeanNo">
                                No
                              </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                          <label>Bleeding: &nbsp</label>
                            <div class="icheck-success d-inline">                  
                              @if($docresult->IsEmbTranBleYes)
                              <input type="checkbox" id="IsEmbTranBleYes" name="IsEmbTranBleYes" checked="">
                              @else
                              <input type="checkbox" id="IsEmbTranBleYes" name="IsEmbTranBleYes">
                              @endif
                              <label for="IsEmbTranBleYes">
                                Yes
                              </label>
                            </div>
                            <div class="icheck-success d-inline">                  
                              @if($docresult->IsEmbTranBleNo)
                              <input type="checkbox" id="IsEmbTranBleNo" name="IsEmbTranBleNo" checked="">
                              @else
                              <input type="checkbox" id="IsEmbTranBleNo" name="IsEmbTranBleNo">
                              @endif
                              <label for="IsEmbTranBleNo">
                                No
                              </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                         <label>Cramping: &nbsp</label>
                            <div class="icheck-success d-inline">    
                              @if($docresult->IsEmbTranBleNo)              
                              <input type="checkbox" id="IsEmbTranCramYes" name="IsEmbTranCramYes" checked="">
                              @else
                              <input type="checkbox" id="IsEmbTranCramYes" name="IsEmbTranCramYes">
                              @endif
                              <label for="IsEmbTranCramYes">
                                Yes
                              </label>
                            </div>
                            <div class="icheck-success d-inline">                  
                              @if($docresult->IsEmbTranCramNo)   
                              <input type="checkbox" id="IsEmbTranCramNo" name="IsEmbTranCramNo" checked="">
                              @else
                              <input type="checkbox" id="IsEmbTranCramNo" name="IsEmbTranCramNo">
                              @endif
                              <label for="IsEmbTranCramNo">
                                No
                              </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                         <label>Embryos retained: &nbsp</label>
                            <div class="icheck-success d-inline"> 
                              @if($docresult->IsEmbTranEmbRetYes)                   
                              <input type="checkbox" id="IsEmbTranEmbRetYes" name="IsEmbTranEmbRetYes" checked="">
                              @else
                              <input type="checkbox" id="IsEmbTranEmbRetYes" name="IsEmbTranEmbRetYes">
                              @endif
                              <label for="IsEmbTranEmbRetYes">
                                Yes
                              </label>
                            </div>
                            <div class="icheck-success d-inline">      
                              @if($docresult->IsEmbTranEmbRetNo)      
                              <input type="checkbox" id="IsEmbTranEmbRetNo" name="IsEmbTranEmbRetNo" checked="">
                              @else
                              <input type="checkbox" id="IsEmbTranEmbRetNo" name="IsEmbTranEmbRetNo">
                              @endif
                              <label for="IsEmbTranEmbRetNo">
                                No
                              </label>
                            </div>
                        </div>
                      </div>

                      <div class="form-group row">

                        <div class="col-sm-12">
                            <label for="EmbTranComments">Comments</label>
                            <input type="text" name="EmbTranComments" id="EmbTranComments" class="form-control" value="{{$docresult->EmbTranComments}}">  
                        </div>
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="EmbTranNoEmbTran"># Emb Trans</label>
                            <input type="number" name="EmbTranNoEmbTran" id="EmbTranNoEmbTran" class="form-control" value="{{$docresult->EmbTranNoEmbTran}}">  
                        </div>
                        <div class="col-sm-6">
                         <label>AH: &nbsp</label>
                            <div class="icheck-success d-inline">      
                              @if($docresult->IsEmbTranAHYes)            
                              <input type="checkbox" id="IsEmbTranAHYes" name="IsEmbTranAHYes" checked="">
                              @else
                              <input type="checkbox" id="IsEmbTranAHYes" name="IsEmbTranAHYes">
                              @endif
                              <label for="IsEmbTranAHYes">
                                Yes
                              </label>
                            </div>
                            <div class="icheck-success d-inline">   
                              @if($docresult->IsEmbTranAHNo)                 
                              <input type="checkbox" id="IsEmbTranAHNo" name="IsEmbTranAHNo" checked="">
                              @else
                              <input type="checkbox" id="IsEmbTranAHNo" name="IsEmbTranAHNo">
                              @endif
                              <label for="IsEmbTranAHNo">
                                No
                              </label>
                            </div>
                        </div>                    
                      </div> 

                      <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="EmbTranDayOfTran">Day of Trans</label>
                            <input type="text" name="EmbTranDayOfTran" id="EmbTranDayOfTran" class="form-control" value="{{$docresult->EmbTranDayOfTran}}">  
                        </div>
                        <div class="col-sm-6">
                         <label>A-CGH: &nbsp</label>
                            <div class="icheck-success d-inline">        
                              @if($docresult->IsEmbTranACGHYes)            
                              <input type="checkbox" id="IsEmbTranACGHYes" name="IsEmbTranACGHYes" checked="">
                              @else
                              <input type="checkbox" id="IsEmbTranACGHYes" name="IsEmbTranACGHYes">
                              @endif
                              <label for="IsEmbTranACGHYes">
                                Yes
                              </label>
                            </div>
                            <div class="icheck-success d-inline">  
                              @if($docresult->IsEmbTranACGHNo)                  
                              <input type="checkbox" id="IsEmbTranACGHNo" name="IsEmbTranACGHNo" checked="">
                              @else
                              <input type="checkbox" id="IsEmbTranACGHNo" name="IsEmbTranACGHNo">
                              @endif
                              <label for="IsEmbTranACGHNo">
                                No
                              </label>
                            </div>
                        </div>                    
                      </div> 
                      <div class="form-group row">
                        <div class="col-sm-12">
                           <label for="EmbTranQuaTrans">Quality of embryos Transfer(s)</label>
                            <textarea class="form-control" name="EmbTranQuaTrans" id="EmbTranQuaTrans" rows="3">{{$docresult->EmbTranQuaTrans}}</textarea> 
                        </div>
                      </div>

                    </div>
                  </div>
                  </div>
                </div>
              </div> 
              <hr>

              <div class="row">  
                <div class="card  col-12">
                  <div class="card-header">
                    Oocyte Cryoreservation
                  </div>
                  <div class="card-body"> 

                    <div class="form-group row">
                        <div class="col-sm-6">
                           <label for="EmbTranDayOfTran">Vitrification solution</label>
                            <input type="text" class="form-control" name="OocCrvVitri" id="OocCrvVitri" value="{{$docresult->OocCrvVitri}}">
                        </div>
                        <div class="col-sm-6">
                           <label for="OocCrvLotNo">Lot #</label>
                            <input type="number" class="form-control" name="OocCrvLotNo" id="OocCrvLotNo" value="{{$docresult->OocCrvLotNo}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-4">
                           <label for="OocCrvExpDate">Exp Date</label>
                            <input type="date" class="form-control" name="OocCrvExpDate" id="OocCrvExpDate" value="{{$docresult->OocCrvExpDate}}">
                        </div>
                        <div class="col-sm-8">
                           <label for="OocCrvDevice">Device</label>
                            <input type="text" class="form-control" name="OocCrvDevice" id="OocCrvDevice" value="{{$docresult->OocCrvDevice}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-4">
                           <label for="OocCrvDate">Date</label>
                            <input type="date" class="form-control" name="OocCrvDate" id="OocCrvDate" value="{{$docresult->OocCrvDate}}">
                        </div>
                        
                        <div class="col-sm-4">
                           <label for="OocCrvTankCanCan">Tank/Canister/Cane</label>
                            <input type="text" class="form-control" name="OocCrvTankCanCan" id="OocCrvTankCanCan" value="{{$docresult->OocCrvTankCanCan}}">
                        </div>
                        <div class="col-sm-4">
                           <label for="OocCrvTotalFroOoc">Total #Frozen Oocytes</label>
                            <input type="text" class="form-control" name="OocCrvTotalFroOoc" id="OocCrvTotalFroOoc" value="{{$docresult->OocCrvTotalFroOoc}}">
                        </div>
                      </div>
                    <div class="form-group row">
                      <div class="col-sm-3">
                           <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <input type="button" value="Embryologist:" class="btn btn-success float-right" data-toggle="modal" id="OocCrvEmbStaffName" data-target="#open-modal-staff">
                                </div>
                                <!-- /btn-group -->
                                <input type="hidden" class="form-control" name="OocCrvEmbStaffId" id="OocCrvEmbStaffId" value="{{$docresult->OocCrvEmbStaffId}}">
                                <input type="text" class="form-control" id="OocCrvEmbName" value="{{$docresult->OocCrvEmbName}}">
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-12">
                           <label for="OocCrvComments">Comments</label>
                            <textarea class="form-control" id="OocCrvComments" name="OocCrvComments">{{$docresult->OocCrvComments}}</textarea>
                        </div>
                      </div>

                  </div>
                </div>
              </div>
              
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
                  <a href="{{route('EmbryologyRecordI')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                  <a href="{{route('PrintEmbryologyRecordI')}}/{{$docId}}" target="_blank" class="btn btn-secondary float-right">Print</a>
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