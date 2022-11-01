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
   <form action="{{route('IVFEmbryoTransDataSheetStore')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
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
                  <input type="date" class="form-control" id="docdate" name="docdate"/>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <div class="d-inline">
                        <label for="EggsRetrieved">You had &nbsp </label><input type="text" id="EggsRetrieved" name="EggsRetrieved"/> &nbsp <label for="EggsRetrievedDate">eggs retrieved on &nbsp</label><input type="date" class="" id="EggsRetrievedDate" name="EggsRetrievedDate"/>.
                        </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <div class="d-inline">
                        <label for="EggsFertilized">You had &nbsp </label><input type="text" id="EggsFertilized" name="EggsFertilized"/> &nbsp <label for="EggsFertilizedDate">eggs fertilized on &nbsp</label><input type="date" class="" id="EggsFertilizedDate" name="EggsFertilizedDate"/>.
                        </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <div class="d-inline">
                        <label for="EmbryosTransd">You had &nbsp </label><input type="text" id="EmbryosTransd" name="EmbryosTransd"/> &nbsp <label for="EmbryosTransdDate">embryo(s) transferred &nbsp</label><input type="date" class="" id="EmbryosTransdDate" name="EmbryosTransdDate"/>.
                        </div>
                    </div>
                </div>
              </div>              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" name="IsDay3" id="IsDay3">
                      <label for="IsDay3">
                        Day 3
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" name="IsDay5" id="IsDay5">
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
                        <label for="EmbryosDis">You have &nbsp </label><input type="text" id="EmbryosDis" name="EmbryosDis"/> &nbsp embryo(s) to be discarded.
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" name="IsICSI" id="IsICSI">
                      <label for="IsICSI">
                        Procedure Performed ICSI
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ICSIPatientInitials" class="col-form-label">Patient Initials:</label>
                    <input type="text" class="form-control" id="ICSIPatientInitials" name="ICSIPatientInitials"/>                  
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" name="IsAssistedHatch" id="IsAssistedHatch">
                      <label for="IsAssistedHatch">
                        Assisted Hatching
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="AssistedHatchPatientInitials" class="col-form-label">Patient Initials:</label>
                    <input type="text" class="form-control" id="AssistedHatchPatientInitials" name="AssistedHatchPatientInitials"/>                  
                  </div>
                </div>
              </div>

              <div class="form-group row">   
                <div class="col-md-2">
                  <label for="EmbryosTransDate" class="col-form-label">Embryos Transfer Date</label>
                  <input type="date" class="form-control" id="EmbryosTransDate" name="EmbryosTransDate"/>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" name="IsVerifiedCorrectName" id="IsVerifiedCorrectName">
                      <label for="IsVerifiedCorrectName">
                        Partner Verifited the dish/vessel with CORRECT NAME
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="VerifiedCorrectNamePatientInitials" class="col-form-label">Patient Initials:</label>
                    <input type="text" class="form-control" id="VerifiedCorrectNamePatientInitials" name="VerifiedCorrectNamePatientInitials"/>                  
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
                    <input type="hidden" class="form-control" name="NurseStaffId" id="NurseStaffId" value="0">
                    <input type="text" class="form-control" id="NurseStaffName">
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
                    <input type="hidden" class="form-control" name="EmbryologistStaffId" id="EmbryologistStaffId" value="0">
                    <input type="text" class="form-control" id="EmbryologistStaffName">
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
                    <input type="hidden" class="form-control" name="MDStaffId" id="MDStaffId" value="0">
                    <input type="text" class="form-control" id="MDStaffName">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea class="form-control" rows="4" name="Notes"></textarea>
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
                  <a href="{{route('IVFEmbryoTransDataSheet')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
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
  bsCustomFileInput.init();
});
</script>

<script type="text/javascript">
  $(document).ready(function () {
    // body...
    $('#NurseName').click(function(){
      $('#StaffModalTitle').text('Nurse');
       $('#SelectedModal').val("1");
    });

    $('#EmbryologistName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
      $('#SelectedModal').val("2");
    });

    $('#MDName').click(function(){
      $('#StaffModalTitle').text('MD');
    });
    $('.add-staff').click(function(){

      var med_id = $(this).val();
      var SelectedId = $('#SelectedModal').val();
      url = '{{route('GetStaffInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);


        switch(SelectedId){
          case "1":
            $('#NurseStaffName').val(data.name); 
            $('#NurseStaffId').val(data.id); 
            break;
          case "2":
            $('#EmbryologistStaffName').val(data.name); 
            $('#EmbryologistStaffId').val(data.id); 
            break;
          default:
            $('#MDStaffName').val(data.name); 
            $('#MDStaffId').val(data.id); 
        }

        $('#SelectedModal').val("0");
      });

      $('#open-modal-staff').modal('toggle'); 

    });
  });
</script>
@endsection