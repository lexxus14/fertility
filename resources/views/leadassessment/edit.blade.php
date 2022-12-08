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
       <form action="{{route('LeadAssUpdate')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
        {{ csrf_field() }}
        @foreach($leadassessments as $leadassessment)
      <input type="hidden" name="id" value="{{$leadassessment->id}}">
      <input type="hidden" name="txtpatientId" value="{{$leadassessment->patientid}}">
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
              <h3 class="card-title">Edit Lead Assessment</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-2">
                    <div class="form-group">
                      <label>Date</label>
                      <div class="input-group date" id="lead-date" data-target-input="nearest">
                          <input type="text" id="lead-date-input" class="form-control datetimepicker-input" name="txtLeadDate" data-target="#lead-date"/>
                          <script>
                            const d = new Date("{{$leadassessment->date}}");
                            let text = d.toLocaleString();
                            document.getElementById("lead-date-input").value = text;
                          </script>
                          <div class="input-group-append" data-target="#lead-date" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                    <div class="form-group">
                      <label>Staff</label>
                      <select class="form-control select2" name="cmbStaff" style="width: 100%;">
                         @foreach($staffs as $staff)
                          @if($leadassessment->staffid == $staff->id)
                            <option value="{{$staff->id}}" selected>{{$staff->name}}</option>
                          @else
                            <option value="{{$staff->id}}">{{$staff->name}}</option>
                          @endif
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Reason</label>
                        <select class="form-control select2" name="cmbReason" style="width: 100%;">
                           @foreach($reasons as $reason)
                            @if($leadassessment->reasonid==$reason->id)
                              <option value="{{$reason->id}}" selected>{{$reason->description}}</option>
                            @else
                              <option value="{{$reason->id}}">{{$reason->description}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <div class="form-group">
                        <label>Note</label>
                        <textarea id="inputNoteLead-Edit" name="txtnoteassessment" class="form-control" rows="4">{{$leadassessment->notes}}</textarea>
                      </div>                      
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile" name="inputFileAssessment">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>                        
                        </div> 
                      </div>
                      <br>
                          <p>FILE: {{$leadassessment->FileLink}}</p>
                    </div>
                </div>
              </div>   
              <div class="row">
                <div class="card">
                    <div class="card-body text-center"> 
                      <input type="hidden" id="myratings" value="{{$leadassessment->assessmentrate}}" name="txtRating"> 
                      <span class="myratings">{{$leadassessment->assessmentrate}}</span>
                        <h4 class="mt-1">Assessment Rate</h4>
                        <fieldset class="rating"> 
                          @if($leadassessment->assessmentrate==5)
                          <input type="radio" id="star5" name="rating" value="5" checked />
                          @else
                          <input type="radio" id="star5" name="rating" value="5" />
                          @endif
                          <label class="full  fas" for="star5" title="Awesome - 5 stars"></label> 

                          <!-- <input type="radio" id="star4half" name="rating" value="4.5" />
                          <label class="half fas" for="star4half" title="Pretty good - 4.5 stars"></label>  -->

                          @if($leadassessment->assessmentrate==4)
                          <input type="radio"  id="star4" name="rating" value="4" checked/>
                          @else
                          <input type="radio"  id="star4" name="rating" value="4" />
                          @endif
                          <label class="full fas" for="star4" title="Pretty good - 4 stars"></label> 

                       <!--    <input type="radio" id="star3half" name="rating" value="3.5" />
                          <label class="half fas" for="star3half" title="Meh - 3.5 stars"></label>  -->
                          @if($leadassessment->assessmentrate==3)
                          <input type="radio" id="star3" name="rating" value="3" checked />
                          @else
                          <input type="radio" id="star3" name="rating" value="3" />
                          @endif
                          <label class="full fas" for="star3" title="Meh - 3 stars"></label> 

                         <!--  <input type="radio" id="star2half" name="rating" value="2.5" />
                          <label class="half fas" for="star2half" title="Kinda bad - 2.5 stars"></label>  -->

                          @if($leadassessment->assessmentrate==2)
                          <input type="radio" id="star2" name="rating" value="2" checked/>
                          @else
                          <input type="radio" id="star2" name="rating" value="2" />
                          @endif
                          <label class="full fas" for="star2" title="Kinda bad - 2 stars"></label> 

                         <!--  <input type="radio" id="star1half" name="rating" value="1.5" />
                          <label class="half fas" for="star1half" title="Meh - 1.5 stars"></label>  -->

                          @if($leadassessment->assessmentrate==5)
                          <input type="radio" id="star1" name="rating" value="1" checked/>                          
                          @else
                          <input type="radio" id="star1" name="rating" value="1" />
                          @endif
                          <label class="full fas" for="star1" title="Sucks big time - 1 star"></label> 

                       <!--    <input type="radio" id="starhalf" name="rating" value="0.5" />
                          <label class="half fas" for="starhalf" title="Sucks big time - 0.5 stars"></label>  -->

                          <input type="radio" class="reset-option" name="rating" value="reset" /> 
                        </fieldset>
                    </div>
                </div>

              </div>
              <div class="row">
                <div class="col-12">
                  <a href="{{route('LeadView')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                  <input type="submit" value="Save" class="btn btn-success float-right">
                </div>
              </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      
      @endforeach
    </form>
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
      "responsive": true, "lengthChange": false, "autoWidth": false,
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

    <script >
    $(document).ready(function(){

    var MainUrl = <?php echo "'".url('/')."'"; ?>;
    var url = MainUrl + '/leadasse/edit/';
    
    /* Lead Assessement */
    $('.open-modal-lead-assessment').click(function(data){
      var id = $(this).val();
      $('#patient_id').val(id);
    });

    $('#quickForm-lead-assessment').validate({
    rules: {
      txtMainEmail: {
        required: true,
        email: true,
      },
      txtMainContactNo: {
        required: true
      },
      txtMainContactPerson: {
        required: true
      },
    },
    messages: {
      txtMainEmail: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      },
      txtMainContactPerson: {
        required: "Please provide the contact person."
      },
      txtMainContactNo: "Please provide the contact number."
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

    //display modal form for task editing
    $('.open-modal-lead-assessment-edit').click(function(){
        var task_id = $(this).val();
        // alert(task_id);
        $.get(url  + task_id, function (data) {
            //success data
            console.log(data);
            $('#LeadAssUpdateId').val(data[0].id);

            const d = new Date(data[0].date);
            let text = d.toLocaleDateString();
            $('#lead-date-update-ass').val(text);
            $("#cmbStaff").append("<option value='"+data[0].staffid+"'selected>"+data[0].name +"</option>");
            $("#cmbReason").append("<option value='"+data[0].reasonid+"'selected>"+data[0].description +"</option>");
            $('#inputNoteLead-Edit').text(data[0].notes);
            // $('#task').val(data.task);
            // $('#description').val(data.description);
            // $('#btn-save').val("update");

            // $('#myModal').modal('show');
        }) 

        // $.get(url + '/' + task_id, function (data) {
        //     //success data
        //     var i = 0
        //     for (i = 0, len = data.length; i < len; i++) {
        //         console.log(data[i]);
        //     }
            //console.log(data[1]);

            // $('#task_id').val(data.id);
            // $('#task').val(data.task);
            // $('#description').val(data.description);
            // $('#btn-save').val("update");

            $('#modal-lead-assessment-edit').modal('show');
        })
    });

/* Lead Assessement */


  </script>

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endsection