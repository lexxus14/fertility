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
      $intStiMedId=0;
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
	                <h3 class="card-title"><b>Stimulating Medicine</b></h3>
	                <button class="btn btn-success float-right open-modal-lead-assessment" data-toggle="modal" data-target="#modal-show" style="margin-right: 5px;">
	                  <i class="fas fa-pencil-alt"></i> New
	                </button>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	                <table id="example1" class="table table-bordered table-striped">
	                  <thead>                  
	                  <tr>
	                    <th>Cycle Day</th>
                      <th>Stimulating Medications</th>
	                    <th>Date</th>
	                    <th>Breakfast</th>
                      <th>Lunch</th>
                      <th>Dinner</th>
                      <th>Other Medicine</th>
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
		                    <td>{{$result->CycleNo}}</td>
		                    <td>AM&nbsp{{$result->MedDoseAM}}{{$result->MuPMSymbol}}&nbsp{{$result->MedAm}}
                          <br/>PM&nbsp{{$result->MedDosePM}}{{$result->MuPMSymbol}}&nbsp{{$result->MedPm}}
                        </td>
                        <td>{{$result->docdate}}</td>
		                    <td>{{$result->Breakfast}}</td>
                        <td>{{$result->Lunch}}</td>
                        <td>{{$result->Dinner}}</td>
                        <td>
                          <?php 
                          $strsql ="SELECT dose, m.description as Medicine,mu.ShortSymbol FROM `stimedothmedsubs`
                                    INNER JOIN medicines m on m.id = stimedothmedsubs.MedId
                                    INNER JOIN medicineunits mu on mu.id = stimedothmedsubs.UnitId
                                    WHERE StimulatingMedicationsid =". $result->id;
                  
                          $subdocresults = DB::select($strsql);

                          foreach($subdocresults as $subdocresult )
                          {
                            echo $subdocresult->Medicine.'&nbsp'.$subdocresult->dose.'&nbsp'.$subdocresult->ShortSymbol.'<br/>';
                          }
                          ?>

                        </td>

                        <td>{{$result->Notes}}</td>
		                    <td>
		                      <a class="btn btn-primary btn-sm float-right" href="{{route('StimulatingMedicineShow')}}/{{$StiPhaseId}}/{{$result->id}}">
		                        <i class="fas fa-folder"></i>
		                              View
		                      </a>

		                      <a class="btn btn-info btn-sm float-right" href="{{route('StimulatingMedicineEdit')}}/{{$StiPhaseId}}/{{$result->id}}">
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
              <h4 class="modal-title">Stimulating Medicine</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form id="quickForm" action="{{route('StimulatingMedicineStore')}}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
            <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
            <input type="hidden" name="StimulatingMedicationsid" value="{{$StiPhaseId}}">
            <div class="modal-body">
              <div class="row">
                <div class="col-4">
                  <div class="form-group">                  
                    <label>Start Date</label>                      
                      <input type="date" class="form-control" name="txtDocDate">
                  </div>
                </div>                
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>CD No.</label>
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">                  
                    <input type="number" name="CycleFrom" placeholder="From" class="form-control">
                  </div>
                </div> 
                <div class="col-2">
                  <div class="form-group">                  
                    <input type="number" name="CycleTo" placeholder="To" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">                
                <div class="col-2">
                  <div class="form-group">
                    <label>AM</label>
                    <input type="number" name="MedDoseAM" class="form-control">
                  </div>
                </div>
                <div class="col-2">
                  <label>Unit</label>
                  <select name="UnitIdAM" class="form-control">
                    @foreach($medicinesunits as $medunit)
                    <option value="{{$medunit->id}}">{{$medunit->ShortSymbol}}</option>
                    @endforeach
                  </select>                  
                </div>
                <div class="col-8">
                  <label>Medicine</label>
                  <div class="input-group">
                    <input class="form-control" type="text" id="txtAmMedicine">
                    <input type="hidden" name="MedIdAM" id="MedIdAM" value="0">
                    <div class="input-group-append">
                      <button class="btn btn-success" data-toggle="modal" data-target="#modal-add-am-med" type="button">
                        <i class="fas fa-search"> Search </i>
                      </button>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="row">                
                <div class="col-2">
                  <div class="form-group">
                    <label>PM</label>
                    <input type="number" name="MedDosePM" class="form-control">
                  </div>
                </div>
                <div class="col-2">
                  <label>Unit</label>
                  <select name="UnitIdPM" class="form-control">
                    @foreach($medicinesunits as $medunit)
                    <option value="{{$medunit->id}}">{{$medunit->ShortSymbol}}</option>
                    @endforeach
                  </select>                  
                </div>
                <div class="col-8">
                  <label>Medicine</label>
                  <div class="input-group">
                    <input class="form-control" type="text" id="txtPmMedicine">
                    <input type="hidden" name="MedIdPM" id="txtPmMedicineId" value="0">
                    <div class="input-group-append">
                      <button class="btn btn-success" data-toggle="modal" data-target="#modal-add-pm-med" type="button">
                        <i class="fas fa-search"> Search </i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>  
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Breakfast</label>
                  </div>
                  <textarea name="Breakfast" class="form-control">Baby Aspirin 1 tablet</textarea>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Lunch</label>
                  </div>
                  <textarea name="Lunch" class="form-control">Prenatal Vitamins 1 Tablet</textarea>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Dinner</label>
                  </div>
                  <textarea name="Dinner" class="form-control">Prednisolone 1 tablet</textarea>
                </div>
              </div> 
              <hr>
              <div class="row">                
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Other Medicine</label>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add-med">Add Med</button>
                    <table class="table table-bordered">
                    <thead>
                      <tr>                        
                        <th>Medicine</th>
                        <th>Dosage</th>
                        <th>Unit</th>
                        <th style="width: 10px">Action</th>
                      </tr>
                    </thead>
                    <tbody id="tbody">
                      
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>    
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Notes</label>
                    <textarea name="Notes" class="form-control"></textarea>
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
    <!-- Modal delete -->
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
            <form method="POST" action="{{route('StimulatingMedicineDelete')}}">
              {{ csrf_field() }}
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete</button>
              </div>
              <input type="hidden" id="del_id" name="del_id" value="0">
              <input type="hidden" name="txtDocId" value="{{$StiPhaseId}}">
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!-- /.modal -->

    <!-- Add Med Modal-->
      <div class="modal fade" id="modal-add-med">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Search Medicine</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card-body">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>                  
                    <tr>                      
                      <th>Medicine</th>
                      <th>Action</th>
                    </tr>                  
                    </thead>
                    <tbody>
                      @foreach($medicines as $medicine)
                      <tr>
                        <td>{{$medicine->description}}</td>
                        <td>
                          <button class="btn btn-success btn-sm float-right add-other-medicine" value="{{$medicine->id}}">
                            <i class="fas fa-plus"></i>
                                  Add
                          </button>                          
                        </td>
                      </tr>
                      @endforeach      
                    </tbody>                  
                  </table>
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
    <!-- /.Add Med Modal -->

    <!-- Add AM Med Modal-->
      <div class="modal fade" id="modal-add-am-med">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Search Medicine</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card-body">
                  <table id="example3" class="table table-bordered table-striped">
                    <thead>                  
                    <tr>                      
                      <th>Medicine</th>
                      <th>Action</th>
                    </tr>                  
                    </thead>
                    <tbody>
                      @foreach($medicines as $medicine)
                      <tr>
                        <td>{{$medicine->description}}</td>
                        <td>
                          <button type="button" class="btn btn-success btn-sm float-right add-medicine-am" value="{{$medicine->id}}"><i class="fas fa-plus"></i>Add</button>                         
                        </td>
                      </tr>
                      @endforeach      
                    </tbody>                  
                  </table>
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
    <!-- /.Add AM Med Modal -->

    <!-- Add PM Med Modal-->
      <div class="modal fade" id="modal-add-pm-med">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Search Medicine</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card-body">
                  <table id="example4" class="table table-bordered table-striped">
                    <thead>                  
                    <tr>                      
                      <th>Medicine</th>
                      <th>Action</th>
                    </tr>                  
                    </thead>
                    <tbody>
                      @foreach($medicines as $medicine)
                      <tr>
                        <td>{{$medicine->description}}</td>
                        <td>
                          <button class="btn btn-success btn-sm float-right add-medicine-pm" value="{{$medicine->id}}">
                            <i class="fas fa-plus"></i>
                                  Add
                          </button>                          
                        </td>
                      </tr>
                      @endforeach      
                    </tbody>                  
                  </table>
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
    <!-- /.Add PM Med Modal -->
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

    $('.add-medicine-am').click(function(){
      var med_id = $(this).val();
      url = '{{route('GetMedInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);   
        $('#txtAmMedicine').val(data.description);
        $('#MedIdAM').val(data.id);
      });
    });

    $('.add-medicine-pm').click(function(){
      var med_id = $(this).val();
      url = '{{route('GetMedInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);   
        $('#txtPmMedicine').val(data.description);
        $('#txtPmMedicineId').val(data.id);
      });
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

    var rowIdx = 0;

  $('.add-other-medicine').click(function(){

      var med_id = $(this).val();
      url = '{{route('GetMedInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);
            $('#tbody').append(`<tr id="R${++rowIdx}">                    
                <td>${data.description}<input type="hidden" class="medid" name="MedId[]" value="${data.id}"></td>
                <td>
                  <input type="number" name="dose[]" class="form-control">
                </td>
                <td>
                  <select name="UnitId[]" class="form-control">
                    @foreach($medicinesunits as $medunit)
                    <option value="{{$medunit->id}}">{{$medunit->ShortSymbol}}</option>
                    @endforeach
                  </select> 
                </td>
                <td><button class="btn btn-danger btn-sm remove-other-medicine float-right">Remove</button></td>
              </tr>`);
      });

    });

  // jQuery button click event to remove a row.
    $('#tbody').on('click', '.remove-other-medicine', function () {

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
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#example2").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "searching": true,
      "autoWidth": false,
      "ordering": false,
      "paging": true,
      "info": false
    });
    $("#example3").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "searching": true,
      "autoWidth": false,
      "ordering": false,
      "paging": true,
      "info": false
    });
    $("#example4").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "searching": true,
      "autoWidth": false,
      "ordering": false,
      "paging": true,
      "info": false
    });
  });
</script>


<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endsection