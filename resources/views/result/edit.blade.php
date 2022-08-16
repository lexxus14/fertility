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
      ?>
      @foreach($patients as $patient)
      <?php
        $strMainContactPerson = $patient->MainContactPerson;
        $strMainContactNo = $patient->MainContactNo;
        $strMainEmail = $patient->MainEmail;
        $intPatientId=$patient->id;
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
      <div class="container-fluid">
        <form id="quickForm" action="{{route('FertilityResultUpdate')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
              <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">              
              @foreach($patientresults as $result)
              <input type="hidden" name="Id" value="{{$result->id}}">
              <div class="modal-body">
                <div class="row  card card-primary">
                  <div class="col-4">
                      <div class="form-group">
                        <label>Date</label>
                        <div class="input-group date" id="lead-date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" id="lead-date-doc" name="txtLeadDate" data-target="#lead-date"/>
                            <div class="input-group-append" data-target="#lead-date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                       <script>
                        const d = new Date("{{$result->Date}}");
                        let text = d.toLocaleString();
                        document.getElementById("lead-date-doc").value = text;
                      </script>
                      </div>
                  </div>
                  <div class="col-4">
                      <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control select2" name="cmbDoctor" style="width: 100%;">
                           @foreach($staffs as $staff)
                            @if($staff->id == $result->DoctorId)
                              <option value="{{$staff->id}}" selected>{{$staff->name}}</option>
                            @else
                              <option value="{{$staff->id}}">{{$staff->name}}</option>
                            @endif
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Nurse</label>
                        <select class="form-control select2" name="cmbNurse" style="width: 100%;">
                           @foreach($staffs as $staff)
                            @if($staff->id == $result->NurseId)
                              <option value="{{$staff->id}}" selected>{{$staff->name}}</option>
                            @else
                              <option value="{{$staff->id}}">{{$staff->name}}</option>
                            @endif
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio" value="In-Progress" 
                          @if($result->Result=="In-Progress")
                          checked
                          @endif>
                          <label for="customRadio1" class="custom-control-label">In-Progress</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" value="Success" @if($result->Result=="Success")
                          checked
                          @endif>
                          <label for="customRadio2" class="custom-control-label">Success</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio3" value="Failed" name="customRadio" 
                          @if($result->Result=="Failed")
                          checked
                          @endif
                          >
                          <label for="customRadio3" class="custom-control-label">Failed</label>
                        </div>
                      </div>
                  
                      </div>
                      <div class="col-12">
                      <div class="form-group">
                        <div class="form-group">
                          <label>Note</label>
                          <textarea id="inputNoteLead-Edit" name="txtnoteassessment" class="form-control" rows="4">{{$result->Notes}}</textarea>
                        </div>                      
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="inputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>                            
                        </div>
                      </div>
                      <div class="col-12">
                        <p>FILE: <a href="{{url('/')}}/{{$result->FileLink}}" target="_blank">{{$result->FileLink}} </a></p>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="modal-footer justify-content-between">
                        <a href="{{route('PatientFertilityResult')}}/{{$intPatientId}}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                  </div>
                </div> 
              </div>
              @endforeach       
        </form>
      </div>
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
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "searching": false,
      "autoWidth": false,
      "ordering": false,
      "paging": false,
      "info": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#example2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    $("#example3").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    $('#example4').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    /* Lead Assessement */
    $('.open-modal-lead-assessment').click(function(data){
      var id = $(this).val();
      $('#patient_id').val(id);
    });

    $('#quickForm').validate({
    rules: {
      txtLeadDate: {
        required: true
      },
      txtEggsCollected: {
        required: true,
        digits: true
      },
    },
    messages: {
      txtLeadDate: {
        required: "Please enter the date"
      },
      txtEggsCollected: {
        required: "Please provide the number of collected eggs."
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
    /*/.end of Lead Assessment*/
  });
</script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endsection