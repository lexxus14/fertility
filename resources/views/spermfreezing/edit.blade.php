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
   <form action="{{route('SpermFreezingUpdate')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" id="quickForm" novalidate="">
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
              <h3 class="card-title">Sperm Freezing</h3>

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
                <div class="col-md-3">
                  <label for="FileNo" class="col-form-label">File NO</label>
                  <input type="text" class="form-control" id="FileNo" name="FileNo" value="{{$docresult->FileNo}}"/>
                </div>
                <div class="col-md-3">
                  <label for="FreezingNo" class="col-form-label">Freezing No</label>
                  <input type="text" class="form-control" id="FreezingNo" name="FreezingNo" value="{{$docresult->FreezingNo}}"/>
                </div>
                <div class="col-md-3">
                  <label for="AccnNo" class="col-form-label">Accn NO</label>
                  <input type="text" class="form-control" id="AccnNo" name="AccnNo" value="{{$docresult->AccnNo}}"/>
                </div>
              </div>

              <div class="form-group row">                
                <div class="col-md-2">
                  <label for="CollectionTime" class="col-form-label">Collection Time</label>
                  <input type="time" class="form-control" id="CollectionTime" name="CollectionTime" value="{{$docresult->CollectionTime}}"/>
                </div>
                <div class="col-md-2">
                  <label for="DaysOfAbstinence" class="col-form-label">Days of Abtinence</label>
                  <input type="text" class="form-control" id="DaysOfAbstinence" name="DaysOfAbstinence" value="{{$docresult->DaysOfAbstinence}}"/>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  Complete of Ejaculation
                  <div class="row">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsEjaculateComplete)
                      <input type="checkbox" name="IsEjaculateComplete" checked id="IsEjaculateComplete">
                      @else
                      <input type="checkbox" name="IsEjaculateComplete" id="IsEjaculateComplete">
                      @endif
                      <label for="IsEjaculateComplete">
                        Complete
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsEjaculateIncomplete)
                      <input type="checkbox" name="IsEjaculateIncomplete" checked id="IsEjaculateIncomplete">
                      @else
                      <input type="checkbox" name="IsEjaculateIncomplete" id="IsEjaculateIncomplete">
                      @endif
                      <label for="IsEjaculateIncomplete">
                        Incomplete
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsEjaculateSpilled)
                      <input type="checkbox" name="IsEjaculateSpilled" checked id="IsEjaculateSpilled">
                      @else
                      <input type="checkbox" name="IsEjaculateSpilled" id="IsEjaculateSpilled">
                      @endif
                      <label for="IsEjaculateSpilled">
                        Spilled
                      </label>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                  Collected At &nbsp
                  <div class="icheck-success d-inline">
                    @if($docresult->IsCollectedOnSite)
                    <input type="checkbox" name="IsCollectedOnSite" checked id="IsCollectedOnSite">
                    @else
                    <input type="checkbox" name="IsCollectedOnSite" id="IsCollectedOnSite">
                    @endif
                    <label for="IsCollectedOnSite">
                      On Site
                    </label>
                  </div>
                  <div class="icheck-success d-inline">
                    @if($docresult->IsCollectedOffSite)
                    <input type="checkbox" name="IsCollectedOffSite" checked id="IsCollectedOffSite">
                    @else
                    <input type="checkbox" name="IsCollectedOffSite" id="IsCollectedOffSite">
                    @endif
                    <label for="IsCollectedOffSite">
                      Off Site
                    </label>
                  </div>
                  <div class="row">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsFreshEja)
                      <input type="checkbox" name="IsFreshEja" checked id="IsFreshEja">
                      @else
                      <input type="checkbox" name="IsFreshEja" id="IsFreshEja">
                      @endif
                      <label for="IsFreshEja">
                        Fresh Ejaculation
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsMESA)
                      <input type="checkbox" name="IsMESA" checked id="IsMESA">
                      @else
                      <input type="checkbox" name="IsMESA" id="IsMESA">
                      @endif
                      <label for="IsMESA">
                        MESA
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsTESE)
                      <input type="checkbox" name="IsTESE" checked id="IsTESE">
                      @else
                      <input type="checkbox" name="IsTESE" id="IsTESE">
                      @endif
                      <label for="IsTESE">
                        TESE
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsPESA)
                      <input type="checkbox" name="IsPESA" checked id="IsPESA">
                      @else
                      <input type="checkbox" name="IsPESA" id="IsPESA">
                      @endif
                      <label for="IsPESA">
                        PESA
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsReFreeze)
                      <input type="checkbox" name="IsReFreeze" checked id="IsReFreeze">
                      @else
                      <input type="checkbox" name="IsReFreeze" id="IsReFreeze">
                      @endif
                      <label for="IsReFreeze">
                        Re-Freeze
                      </label>
                    </div>
                  </div>
                </div>
              </div>   
              
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <!-- <h3 class="card-title">Responsive Hover Table</h3> -->
                      <div class="row">
                        <div class="col-md-4">
                         
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4 text-center">
                          WHO Manual 5th Edition, 2010
                        </div>
                      </div>
                      <!-- <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                        </div>
                      </div> -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>Physical Characteristic</th>
                            <th></th>
                            <th>Normal Range</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Volume</td>
                            <td><input type="number" class="form-control" name="Volume" value="{{$docresult->Volume}}"> </td>
                            <td>1.5 ml</td>
                          </tr>
                          <tr>
                            <td>Liquefaction</td>
                            <td><input type="text" class="form-control" name="Liquefaction" value="{{$docresult->Liquefaction}}"> </td>
                            <td>< 60 min.</td>
                          </tr>
                          <tr>
                            <td>Color</td>
                            <td><input type="text" class="form-control" name="Color" value="{{$docresult->Color}}"> </td>
                            <td>[Grey, White, Opalscent] </td>
                          </tr>
                          <tr>
                            <td>Viscosity</td>
                            <td><input type="text" class="form-control" name="Viscosity" value="{{$docresult->Viscosity}}"> </td>
                            <td>[None to sligth]</td>
                          </tr>
                          <tr>
                            <td>pH</td>
                            <td><input type="number" class="form-control" name="pH" value="{{$docresult->pH}}"> </td>
                            <td>>= 7.2</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>           
              <h3>PRC PROCESSED SPERM</h3>
              
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="OfVialsNo"># of Vials</label>
                    <input type="number" class="form-control" name="OfVialsNo" value="{{$docresult->OfVialsNo}}">
                    <label for="Tank">Tank</label>
                    <input type="text" class="form-control" name="Tank" value="{{$docresult->Tank}}">
                    <label for="Canister">Canister</label>
                    <input type="text" class="form-control" name="Canister" value="{{$docresult->Canister}}">
                    <label for="Cane">Cane</label>
                    <input type="text" class="form-control" name="Cane" value="{{$docresult->Cane}}">
                    
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="SpermVolume">Volume</label>
                    <input type="number" class="form-control" name="SpermVolume" value="{{$docresult->SpermVolume}}">
                    <label for="Conc">Conc .ml</label>
                    <input type="text" class="form-control" name="Conc" placeholder="ml" value="{{$docresult->Conc}}">
                    <label for="Motility">Motility</label>
                    <input type="text" class="form-control" name="Motility" value="{{$docresult->Motility}}">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="DateRecovered">Date Recovered</label>
                    <input type="date" class="form-control" name="DateRecovered" value="{{$docresult->DateRecovered}}">
                    <label for="Office">Office</label>
                    <input type="text" class="form-control" name="Office" value="{{$docresult->Office}}">

                  </div>
                </div>

                <div class="col-md-3">
                  Specimen Type
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsSpecTypeFresh)
                      <input type="checkbox" name="IsSpecTypeFresh" checked id="IsSpecTypeFresh">
                      @else
                      <input type="checkbox" name="IsSpecTypeFresh" id="IsSpecTypeFresh">
                      @endif
                      <label for="IsSpecTypeFresh">
                        Fresh
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsSpecTESAPESAMESA)
                      <input type="checkbox" name="IsSpecTESAPESAMESA" checked id="IsSpecTESAPESAMESA">
                      @else
                      <input type="checkbox" name="IsSpecTESAPESAMESA" id="IsSpecTESAPESAMESA">
                      @endif
                      <label for="IsSpecTESAPESAMESA">
                        TESA PESA MESA
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsSpecPrevFroz)
                      <input type="checkbox" name="IsSpecPrevFroz" checked id="IsSpecPrevFroz">
                      @else
                      <input type="checkbox" name="IsSpecPrevFroz" id="IsSpecPrevFroz">
                      @endif
                      <label for="IsSpecPrevFroz">
                        Previously Frozen
                      </label>
                    </div>
                  </div>
                </div>
                
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Completed By:" class="btn btn-success float-right" id="CompByName" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="CompByStaffId" id="CompByStaffId" value="{{$docresult->CompByStaffId}}">
                    <input type="text" class="form-control" id="CompByStaffName" value="{{$docresult->StaffName}}">
                  </div>
                </div>
              </div>
              
              <div class="row">                
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="Notes" class="col-form-label">Comments</label>
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
                    @if(is_file(public_path($docresult->filelink)))
                    <a href="{{asset($docresult->filelink)}}" target="_blank">Existing File...</a>
                    @endif
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <a href="{{route('SpermFreezing')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
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





<script >
    $(document).ready(function(){

    $('#CompByName').click(function(){
      $('#StaffModalTitle').text('Completed By');
       $('#SelectedModal').val("1");
    });

    $('.add-staff').click(function(){

      var med_id = $(this).val();
      var SelectedId = $('#SelectedModal').val();
      url = '{{route('GetStaffInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);


        switch(SelectedId){
          case "1":
            $('#CompByStaffName').val(data.name); 
            $('#CompByStaffId').val(data.id); 
            break;

          default:
            $('#CompByStaffName').val(data.name); 
            $('#CompByStaffId').val(data.id); 

        }

        $('#SelectedModal').val("0");
      });

      $('#open-modal-staff').modal('toggle'); 

    });


    });

/* Lead Assessement */


  </script>

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>



@endsection