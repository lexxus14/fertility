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
    	<div class="container-fluid">
    		<div class="row">
	    		<div class="col-12">
	          <!-- Lead Assessment Table -->
	          <div class="col-md-12">
	            <div class="card">
	              <div class="card-header">
	                <h3 class="card-title"><b>Patient Consultation</b></h3>
	                <button class="btn btn-success float-right open-modal-lead-assessment" value="{{$intPatientId}}" data-toggle="modal" data-target="#modal-show" style="margin-right: 5px;">
	                  <i class="fas fa-pencil-alt"></i> New
	                </button>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	                <table id="example1" class="table table-bordered table-striped">
	                  <thead>                  
	                  <tr>
	                    <th>No</th>
	                    <th>Date</th>
	                    <th>Description</th>
                      <th>In Cycle</th>
	                    <th>Notes</th>
	                    <th>Action</th>
	                  </tr>                  
	                  </thead>
	                  <tbody>
	                    <?php
		                      $intctr = 0;
		                    ?>
		                  @foreach($docresult as $result)<!-- lab foreach -->
		                  <?php 
		                    $intctr++;
		                  ?>
		                  <tr>
		                    <td>{{$intctr}}</td>
		                    <td>{{$result->docdate}}</td>
		                    <td>{{$result->description}}</td>
                        <td>{{$result->incycle}}</td>
		                    <td>{{$result->notes}}</td>
		                    <td>
		                      <a class="btn btn-primary btn-sm float-right" href="{{route('ConsultationView')}}/{{$result->id}}">
		                        <i class="fas fa-folder"></i>
		                              View
		                      </a>

		                      <a class="btn btn-info btn-sm float-right" href="{{route('ConsultationEdit')}}/{{$result->id}}">
		                        <i class="fas fa-pencil-alt"></i> Edit
		                      </a>                       

	                        <button type="button" class="btn btn-danger btn-sm open-modal-delete float-right" data-toggle="modal" data-target="#modal-delete" value="{{$result->id}}"> <i class="fas fa-trash">
	                              </i>Delete
	                        </button>
	                      </td>
		                  </tr> 
	                     @endforeach      
	                  </tbody>                  
	                </table>
	              </div>
	              <!-- /.card-body -->
	            </div>
	            <!-- /.card -->
	            
	          </div>
	          <!-- /.col -->
	    		</div>
    		</div>
    	</div>
    </section>
</div>

    <!-- Modal Lead Assessment -->
      <div class="modal fade" id="modal-show">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Patient Consultation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form id="quickForm" action="{{route('ConsultationStore')}}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
            <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
            <input type="hidden" name="txtDocSource" value="LeadSource">
            <div class="modal-body">
              <div class="row">
                <div class="col-4">
                    <div class="form-group">
                      <label>Date</label>
                      <div class="input-group date" id="doc-date" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" name="txtDocDate" data-target="#doc-date"/>
                          <div class="input-group-append" data-target="#doc-date" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                    </div>
                </div>
                <div class="col-12">
                		<div class="form-group">
                			<label>Description</label>
                			<input type="text" class="form-control" name="txtdescription" placeholder="Enter Description">
                		</div>
                    <div class="form-group">
                      <label>In Cycle</label>
                      <input type="number" value="1" class="form-control" name="intInCycle">
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        <textarea id="inputNoteLead-Edit" name="txtnotes" class="form-control" rows="4"></textarea>
                    
                    </div>
                </div>
              </div>  
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="inputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>      
            </div>            
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
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
            <form method="POST" action="{{route('ConsultationDelete')}}">
              {{ csrf_field() }}
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete</button>
              </div>
              <input type="hidden" id="del_id" name="del_id" value="0">
              <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
            </form>
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
  	/* Lead Reminder */
    $('#doc-date').datetimepicker({
        format: 'L'
    });

    $('.open-modal-delete').click(function(data){
      var id = $(this).val();
      $('#del_id').val(id);
    });

    $('#quickForm').validate({
    rules: {
      txtdescription: {
        required: true
      },

    },
    messages: {

      txtdescription: {
        required: "Please provide the description."
      }
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
  });
  </script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "searching": true,
      "autoWidth": false,
      "ordering": false,
      "paging": true,
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


<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endsection