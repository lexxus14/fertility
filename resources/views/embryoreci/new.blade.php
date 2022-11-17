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
   <form action="{{route('EmbryologyRecordIStore')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
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
                <input type="date" class="form-control" id="docdate" name="docdate"/>
              </div>  
              <div class="col-md-3">
                <label for="RecordNo" class="col-form-label">Record No</label>
                <input type="text" class="form-control" id="RecordNo" name="RecordNo"/>
              </div> 
                            
            </div>
            <hr>
            <div class="form-group row">  
              <div class="col-md-4">
                  <label>Message Ok? &nbsp</label>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsMssgYes" name="IsMssgYes">
                    <label for="IsMssgYes">
                      Yes
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsMssgNo" name="IsMssgNo">
                    <label for="IsMssgNo">
                      No
                    </label>
                  </div>
                </div>  
                <div class="col-md-8">
                  <label>Cycle Type: &nbsp</label>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsIVF" name="IsIVF">
                    <label for="IsIVF">
                      IVF
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsICSC" name="IsICSC">
                    <label for="IsICSC">
                      ICSC
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsPGTA" name="IsPGTA">
                    <label for="IsPGTA">
                      PGT-A
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsPGTAM" name="IsPGTAM">
                    <label for="IsPGTAM">
                      PGT-M
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsBabayGender" name="IsBabayGender">
                    <label for="IsBabayGender">
                      Baby Gender
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsOOctye" name="IsOOctye">
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
                  <input type="date" class="form-control" id="hCGDate" name="hCGDate"/>
                </div>
                <div class="col-md-3">
                  <label for="hCGTime" class="col-form-label">hCG Time</label>
                  <input type="time" class="form-control" id="hCGTime" name="hCGTime"/>
                </div>
                <div class="col-md-3">
                  <label for="NoFoll" class="col-form-label"># Foll>=12</label>
                  <input type="number" class="form-control" id="NoFoll" name="NoFoll"/>
                </div>
                <div class="col-md-3">
                  <label for="MaxE2" class="col-form-label">Max E2</label>
                  <input type="text" class="form-control" id="MaxE2" name="MaxE2"/>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-2">
                  <label>Lupron &nbsp</label>
                  <div class="icheck-success">                  
                    <input type="checkbox" id="IsLupronYes" name="IsLupronYes">
                    <label for="IsLupronYes">
                      Yes
                    </label>
                  </div>
                  <div class="icheck-success">                  
                    <input type="checkbox" id="IsLupronNo" name="IsLupronNo">
                    <label for="IsLupronNo">
                      No
                    </label>
                  </div>
                </div> 
                <div class="col-md-4">
                  <label for="InfeDruAmount" class="col-form-label">Infertility Drugs & Amount</label>
                  <input type="text" class="form-control" id="InfeDruAmount" name="InfeDruAmount"/>
                </div>
                <div class="col-md-3">
                  <label for="CycleNo" class="col-form-label">Cycle No</label>
                  <input type="number" class="form-control" id="CycleNo" name="CycleNo"/>
                </div>
                <div class="col-md-3">
                  <label for="CycleDate" class="col-form-label">CycleDate</label>
                  <input type="date" class="form-control" id="CycleDate" name="CycleDate"/>
                </div>                
              </div>
              <hr>
              <div class="form-group row">
                <div class="col-md-3">
                  <label for="G" class="col-form-label">G</label>
                  <input type="text" class="form-control" id="G" name="G"/>
                </div>
                <div class="col-md-3">
                  <label for="P" class="col-form-label">P</label>
                  <input type="text" class="form-control" id="P" name="P"/>
                </div>
                <div class="col-md-3">
                  <label for="A" class="col-form-label">A</label>
                  <input type="text" class="form-control" id="A" name="A"/>
                </div>
                <div class="col-md-3">
                  <label for="E" class="col-form-label">E</label>
                  <input type="text" class="form-control" id="E" name="E"/>
                </div>
              </div>
              <div class="form-group row">
                  <div class="col-md-6">
                    <label for="dx1" class="col-form-label">1 dx</label>
                    <input type="text" class="form-control" id="dx1" name="dx1"/>
                  </div>
                  <div class="col-md-6">
                    <label for="dx2" class="col-form-label">2 dx</label>
                    <input type="text" class="form-control" id="dx2" name="dx2"/>
                  </div>
                  <div class="col-md-6">
                    <label for="Ethnicity" class="col-form-label">Ethnicity</label>
                    <input type="text" class="form-control" id="Ethnicity" name="Ethnicity"/>
                  </div>
                  <div class="col-md-6">
                    <label for="Town" class="col-form-label">Town</label>
                    <input type="text" class="form-control" id="Town" name="Town"/>
                  </div>                
              </div>
              <hr>

              <h4>Egg Retrieval: Day 0</h4>
              <div class="form-group row">
                  <div class="col-md-3">
                    <label for="RetDate" class="col-form-label">Ret Date</label>
                    <input type="date" class="form-control" id="RetDate" name="RetDate"/>
                  </div>
                  <div class="col-md-3">
                    <label for="RetNoOfEggs" class="col-form-label"># of Eggs</label>
                    <input type="number" class="form-control" id="RetNoOfEggs" name="RetNoOfEggs"/>
                  </div>
                  <div class="col-md-3">
                    <label for="RetStartTime" class="col-form-label">Start Time</label>
                    <input type="time" class="form-control" id="RetStartTime" name="RetStartTime"/>
                  </div>
                  <div class="col-md-3">
                    <label for="RetFinishTime" class="col-form-label">Finish Time</label>
                    <input type="time" class="form-control" id="RetFinishTime" name="RetFinishTime"/>
                  </div>                
              </div>
              <div class="form-group row">
                <div class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Anesthesiologist:" class="btn btn-success float-right" data-toggle="modal" id="RetAnesthesiologistStaffName" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="RetAnesthesiologistStaffId" id="RetAnesthesiologistStaffId" value="0">
                    <input type="text" class="form-control" id="RetAnesthesiologistName">
                  </div>
                </div>  
                <div class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Nurse:" class="btn btn-success float-right" data-toggle="modal" id="RetNurseStaffName" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="RetNurseStaffId" id="RetNurseStaffId" value="0">
                    <input type="text" class="form-control" id="RetNurseName">
                  </div>
                </div>              
                <div class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Embryologist:" class="btn btn-success float-right" data-toggle="modal" id="RetEmbStaffName" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="RetEmbStaffId" id="RetEmbStaffId" value="0">
                    <input type="text" class="form-control" id="RetEmbName">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Physician:" class="btn btn-success float-right" data-toggle="modal" id="RetPhysicianStaffName" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="RetPhysicianStaffId" id="RetPhysicianStaffId" value="0">
                    <input type="text" class="form-control" id="RetPhysicianName">
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
                    <input type="hidden" class="form-control" name="RetWristCheckByStaffId" id="RetWristCheckByStaffId" value="0">
                    <input type="text" class="form-control" id="RetWristCheckByName">
                  </div>
                </div>              
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="RetComments">
                    Comments
                  </label>
                  <textarea class="form-control" id="RetComments" name="RetComments" rows="4"></textarea>
                </div>
              </div>
              <hr>
              <div class="form-group row"> 
               <div class="col-md-4">
                  <label>Sperm: &nbsp;</label>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsFresh" name="IsFresh">
                    <label for="IsFresh">
                      Fresh
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsFrozen" name="IsFrozen">
                    <label for="IsFrozen">
                      Frozen
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsTESE" name="IsTESE">
                    <label for="IsTESE">
                      TESE
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsMESA" name="IsMESA">
                    <label for="IsMESA">
                      MESA
                    </label>
                  </div>
                </div>   

                <div class="col-md-8">
                  <label>Prep Method: &nbsp;</label>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsPreMetIsolate" name="IsPreMetIsolate">
                    <label for="IsPreMetIsolate">
                      Isolate
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsPreMetWashOnly" name="IsPreMetWashOnly">
                    <label for="IsPreMetWashOnly">
                      Wash Only
                    </label>
                  </div>
                  <div class="icheck-success d-inline">                  
                    <input type="checkbox" id="IsPreMetPentoxifyline" name="IsPreMetPentoxifyline">
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
                            <td><input type="number" class="form-control" name="PreWashVol"> </td>
                            <td><input type="number" class="form-control" name="PosWashVol"></td>
                          </tr>
                          <tr>
                            <td>Conc(x10/mL)</td>
                            <td><input type="number" class="form-control" name="PreWashConc"> </td>
                            <td><input type="number" class="form-control" name="PosWashConc"> </td>
                          </tr>
                          <tr>
                            <td>Motility(%)</td>
                            <td><input type="number" class="form-control" name="PreWashMotility"> </td>
                            <td><input type="number" class="form-control" name="PosWashMotility"> </td>
                          </tr>
                          <tr>
                            <td>Progression (1-4)</td>
                            <td><input type="number" class="form-control" name="PreWashProg"> </td>
                            <td><input type="number" class="form-control" name="PosWashProg"></td>
                          </tr>
                          <tr>
                            <td>Tech:</td>
                            <td><input type="text" class="form-control" name="PreWashTech"> </td>
                            <td><input type="text" class="form-control" name="PosWashTech"></td>
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
                  <textarea class="form-control" id="SpermComments" name="SpermComments" rows="4"></textarea>
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
                            <input type="text" class="form-control" name="InsInsICSI" id="InsInsICSI">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="InsInsConv">Conv</label>
                            <input type="text" class="form-control" id="InsInsConv" name="InsInsConv">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="InsInsTime">Insem Time</label>
                            <input type="time" class="form-control" id="InsInsTime" name="InsInsTime">
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
                            <input type="hidden" class="form-control" name="InsInsEmbrStaffId" id="InsInsEmbrStaffId" value="0">
                            <input type="text" class="form-control" id="InsInsEmbrName">
                          </div>
                          </div>
                        </div>
                      </div>
                        <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                              <label for="InsInsID">2 ID</label>
                              <input type="text" name="InsInsID" class="form-control" id="InsInsID">
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
                            <input type="text" class="form-control" name="FerRes2PN" id="FerRes2PN">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="FerRes1PN"># 1PN</label>
                            <input type="text" class="form-control" name="FerRes1PN" id="FerRes1PN">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="FerRes3PN">>= 3 PN</label>
                            <input type="text" class="form-control" name="FerRes3PN" id="FerRes3PN">
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
                            <input type="hidden" class="form-control" name="FerResEmbrStaffId" id="FerResEmbrStaffId" value="0">
                            <input type="text" class="form-control" id="FerResEmbrName">
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
                            <input type="time" class="form-control" name="HvaTime" id="HvaTime">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="HvaTech">Tech</label>
                            <input type="text" class="form-control" name="HvaTech" id="HvaTech">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="HvaMII">#MII</label>
                            <input type="text" class="form-control" name="HvaMII" id="HvaMII">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="HvaMI">#MI</label>
                            <input type="text" class="form-control" name="HvaMI" id="HvaMI">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="HvaGV">#GV</label>
                            <input type="text" class="form-control" name="HvaGV" id="HvaGV">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="HvaOther">#Other</label>
                            <input type="text" class="form-control" name="HvaOther" id="HvaOther">
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
                            <input type="number" class="form-control" name="ICSITotalInj" id="ICSITotalInj">
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
                            <input type="hidden" class="form-control" name="ICSIEmbStaffId" id="ICSIEmbStaffId" value="0">
                            <input type="text" class="form-control" id="ICSIEmbName">
                          </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <label for="ICSIComments"> Comments</label>
                          <input type="text" name="ICSIComments" id="ICSIComments" class="form-control">
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
                          <input type="date" name="EmbTranDate" id="EmbTranDate" class="form-control">
                        </div>
                        <div class="col-sm-6">
                          <label for="EmbTranTime">Time</label>
                          <input type="time" name="EmbTranTime" id="EmbTranTime" class="form-control">
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
                                <input type="hidden" class="form-control" name="EmbTranPhysiStaffId" id="EmbTranPhysiStaffId" value="0">
                                <input type="text" class="form-control" id="EmbTranPhysiName">
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
                                <input type="hidden" class="form-control" name="EmbTranEmbrStaffId" id="EmbTranEmbrStaffId" value="0">
                                <input type="text" class="form-control" id="EmbTranEmbrName">
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
                                <input type="hidden" class="form-control" name="EmbTranNurseStaffId" id="EmbTranNurseStaffId" value="0">
                                <input type="text" class="form-control" id="EmbTranNurseName">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="form-group row">

                        <div class="col-sm-12">
                            <label for="EmbTranID">2 ID</label>
                            <input type="text" name="EmbTranID" id="EmbTranID" class="form-control">  
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="EmbTranCatheter">Catheter</label>
                          <input type="text" name="EmbTranCatheter" id="EmbTranCatheter" class="form-control">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-6">
                          <label for="EmbTranNoAttempts"># Attempts</label>
                          <input type="number" name="EmbTranNoAttempts" id="EmbTranNoAttempts" class="form-control">
                        </div>
                        <div class="col-sm-6">
                          <label for="EmbTranNoRet"># Retained</label>
                          <input type="number" name="EmbTranNoRet" id="EmbTranNoRet" class="form-control">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-3">
                          <label>Tenac used: &nbsp</label>
                            <div class="icheck-success d-inline">                  
                              <input type="checkbox" id="IsEmbTranTenaYes" name="IsEmbTranTenaYes">
                              <label for="IsEmbTranTenaYes">
                                Yes
                              </label>
                            </div>
                            <div class="icheck-success d-inline">                  
                              <input type="checkbox" id="IsEmbTranTeanNo" name="IsEmbTranTeanNo">
                              <label for="IsEmbTranTeanNo">
                                No
                              </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                          <label>Bleeding: &nbsp</label>
                            <div class="icheck-success d-inline">                  
                              <input type="checkbox" id="IsEmbTranBleYes" name="IsEmbTranBleYes">
                              <label for="IsEmbTranBleYes">
                                Yes
                              </label>
                            </div>
                            <div class="icheck-success d-inline">                  
                              <input type="checkbox" id="IsEmbTranBleNo" name="IsEmbTranBleNo">
                              <label for="IsEmbTranBleNo">
                                No
                              </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                         <label>Cramping: &nbsp</label>
                            <div class="icheck-success d-inline">                  
                              <input type="checkbox" id="IsEmbTranCramYes" name="IsEmbTranCramYes">
                              <label for="IsEmbTranCramYes">
                                Yes
                              </label>
                            </div>
                            <div class="icheck-success d-inline">                  
                              <input type="checkbox" id="IsEmbTranCramNo" name="IsEmbTranCramNo">
                              <label for="IsEmbTranCramNo">
                                No
                              </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                         <label>Embryos retained: &nbsp</label>
                            <div class="icheck-success d-inline">                  
                              <input type="checkbox" id="IsEmbTranEmbRetYes" name="IsEmbTranEmbRetYes">
                              <label for="IsEmbTranEmbRetYes">
                                Yes
                              </label>
                            </div>
                            <div class="icheck-success d-inline">                  
                              <input type="checkbox" id="IsEmbTranEmbRetNo" name="IsEmbTranEmbRetNo">
                              <label for="IsEmbTranEmbRetNo">
                                No
                              </label>
                            </div>
                        </div>
                      </div>

                      <div class="form-group row">

                        <div class="col-sm-12">
                            <label for="EmbTranComments">Comments</label>
                            <input type="text" name="EmbTranComments" id="EmbTranComments" class="form-control">  
                        </div>
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="EmbTranNoEmbTran"># Emb Trans</label>
                            <input type="number" name="EmbTranNoEmbTran" id="EmbTranNoEmbTran" class="form-control">  
                        </div>
                        <div class="col-sm-6">
                         <label>AH: &nbsp</label>
                            <div class="icheck-success d-inline">                  
                              <input type="checkbox" id="IsEmbTranAHYes" name="IsEmbTranAHYes">
                              <label for="IsEmbTranAHYes">
                                Yes
                              </label>
                            </div>
                            <div class="icheck-success d-inline">                  
                              <input type="checkbox" id="IsEmbTranAHNo" name="IsEmbTranAHNo">
                              <label for="IsEmbTranAHNo">
                                No
                              </label>
                            </div>
                        </div>                    
                      </div> 

                      <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="EmbTranDayOfTran">Day of Trans</label>
                            <input type="text" name="EmbTranDayOfTran" id="EmbTranDayOfTran" class="form-control">  
                        </div>
                        <div class="col-sm-6">
                         <label>A-CGH: &nbsp</label>
                            <div class="icheck-success d-inline">                  
                              <input type="checkbox" id="IsEmbTranACGHYes" name="IsEmbTranACGHYes">
                              <label for="IsEmbTranACGHYes">
                                Yes
                              </label>
                            </div>
                            <div class="icheck-success d-inline">                  
                              <input type="checkbox" id="IsEmbTranACGHNo" name="IsEmbTranACGHNo">
                              <label for="IsEmbTranACGHNo">
                                No
                              </label>
                            </div>
                        </div>                    
                      </div> 
                      <div class="form-group row">
                        <div class="col-sm-12">
                           <label for="EmbTranQuaTrans">Quality of embryos Transfer(s)</label>
                            <textarea class="form-control" name="EmbTranQuaTrans" id="EmbTranQuaTrans" rows="3"></textarea> 
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
                            <input type="text" class="form-control" name="OocCrvVitri" id="OocCrvVitri">
                        </div>
                        <div class="col-sm-6">
                           <label for="OocCrvLotNo">Lot #</label>
                            <input type="number" class="form-control" name="OocCrvLotNo" id="OocCrvLotNo">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-4">
                           <label for="OocCrvExpDate">Exp Date</label>
                            <input type="date" class="form-control" name="OocCrvExpDate" id="OocCrvExpDate">
                        </div>
                        <div class="col-sm-8">
                           <label for="OocCrvDevice">Device</label>
                            <input type="text" class="form-control" name="OocCrvDevice" id="OocCrvDevice">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-4">
                           <label for="OocCrvDate">Date</label>
                            <input type="date" class="form-control" name="OocCrvDate" id="OocCrvDate">
                        </div>
                        
                        <div class="col-sm-4">
                           <label for="OocCrvTankCanCan">Tank/Canister/Cane</label>
                            <input type="text" class="form-control" name="OocCrvTankCanCan" id="OocCrvTankCanCan">
                        </div>
                        <div class="col-sm-4">
                           <label for="OocCrvTotalFroOoc">Total #Frozen Oocytes</label>
                            <input type="text" class="form-control" name="OocCrvTotalFroOoc" id="OocCrvTotalFroOoc">
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
                                <input type="hidden" class="form-control" name="OocCrvEmbStaffId" id="OocCrvEmbStaffId" value="0">
                                <input type="text" class="form-control" id="OocCrvEmbName">
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-12">
                           <label for="OocCrvComments">Comments</label>
                            <textarea class="form-control" id="OocCrvComments" name="OocCrvComments"></textarea>
                        </div>
                      </div>

                  </div>
                </div>
              </div>
              
              <hr>
              <div class="row">
                <div class="col-sm-12">
                  <label for="Notes">Notes</label>
                  <textarea class="form-control" id="Notes" name="Notes"></textarea>
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
                  <a href="{{route('EmbryologyRecordI')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
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
              

    $('#RetAnesthesiologistStaffName').click(function(){
      $('#StaffModalTitle').text('Anesthesiologist');
       $('#SelectedModal').val("1");
    });

    $('#RetNurseStaffName').click(function(){
      $('#StaffModalTitle').text('Nurse');
       $('#SelectedModal').val("2");
    });

    $('#RetEmbStaffName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
       $('#SelectedModal').val("3");
    });

    $('#RetPhysicianStaffName').click(function(){
      $('#StaffModalTitle').text('Physician');
       $('#SelectedModal').val("4");
    });
    $('#RetWristCheckByStaffName').click(function(){
      $('#StaffModalTitle').text('Wrist Check By');
       $('#SelectedModal').val("5");
    });

     $('#InsInsEmbrStaffName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
       $('#SelectedModal').val("6");
    });

    $('#FerResEmbrStaffName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
       $('#SelectedModal').val("7");
    });

    $('#ICSIEmbStaffName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
       $('#SelectedModal').val("8");
    });

    $('#EmbTranPhysiStaffname').click(function(){
      $('#StaffModalTitle').text('Physician');
       $('#SelectedModal').val("9");
    });

    $('#EmbTranEmbrStaffName').click(function(){
      $('#StaffModalTitle').text('Embryo');
       $('#SelectedModal').val("10");
    });

    $('#EmbTranNurseStaffName').click(function(){
      $('#StaffModalTitle').text('Nurse');
       $('#SelectedModal').val("11");
    });

    $('#OocCrvEmbStaffName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
       $('#SelectedModal').val("12");
    });

    $('.add-staff').click(function(){

      var med_id = $(this).val();
      var SelectedId = $('#SelectedModal').val();
      url = '{{route('GetStaffInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);


        switch(SelectedId){
          case "1":
            $('#RetAnesthesiologistName').val(data.name); 
            $('#RetAnesthesiologistStaffId').val(data.id); 
            break;

          case "2":
            $('#RetNurseName').val(data.name); 
            $('#RetNurseStaffId').val(data.id); 
            break;

          case "3":
            $('#RetEmbName').val(data.name); 
            $('#RetEmbStaffId').val(data.id); 
            break;

          case "4":
            $('#RetPhysicianName').val(data.name); 
            $('#RetPhysicianStaffId').val(data.id); 
            break;

          case "5":
            $('#RetWristCheckByName').val(data.name); 
            $('#RetWristCheckByStaffId').val(data.id); 
            break;

          case "6":
            $('#InsInsEmbrName').val(data.name); 
            $('#InsInsEmbrStaffId').val(data.id); 
            break;

          case "7":
            $('#FerResEmbrName').val(data.name); 
            $('#FerResEmbrStaffId').val(data.id); 
            break;

          case "8":
            $('#ICSIEmbName').val(data.name); 
            $('#ICSIEmbStaffId').val(data.id); 
            break;

          case "9":
            $('#EmbTranPhysiName').val(data.name); 
            $('#EmbTranPhysiStaffId').val(data.id); 
            break;

          case "10":
            $('#EmbTranEmbrName').val(data.name); 
            $('#EmbTranEmbrStaffId').val(data.id); 
            break;

          case "11":
            $('#EmbTranNurseName').val(data.name); 
            $('#EmbTranNurseStaffId').val(data.id); 
            break;

          default:
            $('#OocCrvEmbName').val(data.name); 
            $('#OocCrvEmbStaffId').val(data.id); 
            break;

        }

        $('#SelectedModal').val("0");
      });

      $('#open-modal-staff').modal('toggle'); 

    });

    });

/* Lead Assessement */


  </script>
@endsection