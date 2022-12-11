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
    @foreach($docresults as $docresult)
   <form action="{{route('FETpage2Update')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
        {{ csrf_field() }}
      <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
      <input type="hidden" name="FETiD" value="{{$DocId}}">
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
              <h3 class="card-title">FET Form 2</h3>

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
                        <input type="date" class="form-control" value="{{$docresult->docdate}}" name="docdate"/>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-2">
                    <div class="form-group">
                      <label>Lupron Start Date</label>
                        <input type="date" class="form-control" value="{{$docresult->LupronStartDate}}" name="LupronStartDate"/>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                      <label>CD2</label>
                        <input type="date" class="form-control" value="{{$docresult->CD2Date}}" name="CD2Date"/>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                    <div class="form-group">
                      <label>Uterine Position</label>
                      <input type="text" name="UterinePosition" value="{{$docresult->UterinePosition}}" class="form-control">
                    </div>                   

                </div>
                <div class="col-4">
                    <div class="form-group">
                      <label>Measurment</label>
                      <input type="number" name="Measurement" value="{{$docresult->Measurement}}" placeholder="mm" class="form-control">
                    </div>                   

                </div>                
              </div>
              <div class="row">
                <div class="col-6">
                <!-- /.card-header -->
                    <!-- <table id="example1" class="table table-bordered table-striped"> -->
                    <table  class="table table-bordered table-striped">
                      <thead>                  
                      <tr>
                        <th>#</th>
                        <th>Diagnosis</th>
                      </tr>                  
                      </thead>
                      <tbody id="tbody">
                        <?php 
                          $intctr = 0;
                        ?>
                        @foreach($FETPage2DiagnosisSubs as $FETPage2DiagnosisSub)
                        <tr id="R{{$intctr}}">
                          <?php $intctr++; ?>
                          <td class="row-index text-center">
                            <input type="hidden" name="FETPage2sId[]" value="{{$FETPage2DiagnosisSub->id}}">
                            <p>{{$intctr}}</p>
                          </td>
                          <td class="text-center">
                            {{$FETPage2DiagnosisSub->description}}
                          </td>
                        </tr>
                        @endforeach 
                      
        
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label>HIPPA#</label>
                    <input type="text" name="HIPPA" value="{{$docresult->HIPPA}}" class="form-control">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>CD1 Estradiol</label>
                    <input type="text" name="CD1Etradiol" value="{{$docresult->CD1Etradiol}}" class="form-control">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>CD1 PRL</label>
                    <input type="text" name="CD1PRL" value="{{$docresult->CD1PRL}}" class="form-control">
                  </div>
                </div>
              </div>   
              <div class="row">
                <div class="col-12">
                <!-- /.card-header -->
                    <!-- <table id="example1" class="table table-bordered table-striped"> -->
                    <table  class="table table-bordered table-striped">
                      <thead>                  
                      <tr>
                        <th>CD No</th>
                        <th>Date</th>
                        <th>Ultrasound</th>
                        <th>Lining</th>
                        <th>Estradiol</th>
                        <th>Notes</th>
                      </tr>                  
                      </thead>
                      <tbody id="tbody_cd">
                        <?php
                          $ctr=0;
                        ?>
                        @foreach($FETPage2CDSubs as $FETPage2CDSub)
                        <tr id="RCD{{$ctr}}">
                          <?php $ctr++; ?>
                          <td class="row-index text-center">
                            <input type="number" class="form-control" name="CDNo[]" value="{{$FETPage2CDSub->CDNo}}">
                          </td>
                          <td class="text-center">
                            <input type="date" class="form-control" name="CDDate[]" value="{{$FETPage2CDSub->CDDate}}">
                          </td>
                          <td class="text-center">
                            <div class="form-group row">
                              <label for="rt" class="col-sm-2 col-form-label">RT</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="rt" name="RT[]" placeholder="RT" value="{{$FETPage2CDSub->RT}}">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="lt" class="col-sm-2 col-form-label">LT</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="lt" name="LT[]" placeholder="LT" value="{{$FETPage2CDSub->LT}}">
                              </div>
                            </div>
                          </td>        
                          <td class="text-center">
                            <input type="text" class="form-control" name="Lining[]" value="{{$FETPage2CDSub->Lining}}">
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" name="Estradiol[]" value="{{$FETPage2CDSub->Estradiol}}">
                          </td>
                          <td class="text-center">
                            <textarea name="Notes[]" class="form-control">{{$FETPage2CDSub->Notes}} </textarea>
                          </td>
                        </tr>
                        @endforeach                     
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                      <div class="form-group">
                        <label>Note</label>
                        <textarea id="inputNoteLead-Edit" name="txtnotes" class="form-control" rows="4">{{$docresult->Notes}}</textarea>
                      </div>                      
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-2">
                  <div class="form-group">
                    <label>Blood Type</label>
                    <input type="text" name="BloodType" value="{{$docresult->BloodType}}" class="form-control">
                  </div> 
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label>FET Date</label>
                    <input type="date" name="FETDate" value="{{$docresult->FETDate}}" class="form-control">
                  </div> 
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label>Embros</label>
                    <input type="text" name="Embros" value="{{$docresult->Embros}}"  class="form-control">
                  </div> 
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label>Trans</label>
                    <input type="text" name="Trans" value="{{$docresult->Trans}}" class="form-control">
                  </div> 
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label>Cyro</label>
                    <input type="text" name="Cryo" value="{{$docresult->Cryo}}" class="form-control">
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
                  <a href="{{route('FETpage2')}}/{{$PhaseId}}" class="btn btn-secondary">Cancel</a>
                  <a href="{{route('PrintFETpage2')}}/{{$PhaseId}}/{{$DocId}}" target="_blank" class="btn btn-secondary float-right">Print</a>
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

  <!-- Modal Medicine Treatement -->
      <div class="modal fade" id="open-modal-medicine-treatment">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Diagnosis</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>


            <div class="modal-body">
              <div class="row">
                <div class="col-12">

                  <table id="example3" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Description</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $intctr =0;
                    ?>
                    @foreach($doctorDiagnosis as $doctorDiagnosi)
                    <?php
                    $intctr++; 
                    ?>
                    <tr>
                      <td>{{$intctr}}</td>
                      <td>{{$doctorDiagnosi->description}}</td>

                      <td><button type="button" class="btn btn-success add-medicine-treatment" value="{{$doctorDiagnosi->id}}">Add</button> </td>
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
    $("#example4").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    $('#example3').DataTable({
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

    <script >
    $(document).ready(function(){
    var rowIdx = {{$intctr}};
    var rowIdx_cd = {{$ctr}};        
    
    $('#add_cd').click(function(){
      
      $('#tbody_cd').append(`<tr id="RCD${++rowIdx_cd}">
        <td class="row-index text-center">
          <input type="number" class="form-control" name="CDNo[]" value="${rowIdx_cd}">
        </td>
        <td class="text-center">
          <input type="date" class="form-control" name="CDDate[]">
        </td>
        <td class="text-center">
          <div class="form-group row">
            <label for="rt" class="col-sm-2 col-form-label">RT</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="rt" name="RT[]" placeholder="RT">
            </div>
          </div>
          <div class="form-group row">
            <label for="lt" class="col-sm-2 col-form-label">LT</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="lt" name="LT[]" placeholder="LT">
            </div>
          </div>
        </td>        
        <td class="text-center">
          <input type="text" class="form-control" name="Lining[]">
        </td>
        <td class="text-center">
          <input type="text" class="form-control" name="Estradiol[]">
        </td>
        <td class="text-center">
          <textarea name="Notes[]" class="form-control"> </textarea>
        </td>
        </tr>`);
    });

    // jQuery button click event to remove a row.
    $('#tbody_cd').on('click', '.remove-cd', function () {


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
                  var dig = parseInt(id.substring(3));

                  // Modifying row index.
                  idx.html(`${dig - 1}`);

                  // Modifying row id.
                  $(this).attr('id', `RCD${dig - 1}`);
      });

      // Removing the current row.
      $(this).closest('tr').remove();

      // Decreasing total number of rows by 1.
      rowIdx_cd--;
    });

    /* Price List */

    $('.add-medicine-treatment').click(function(){

      var med_id = $(this).val();
      url = '{{route('DoctorDiagnosInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);
            $('#tbody').append(`<tr id="R${++rowIdx}">
              <td class="row-index text-center">
              <input type="hidden" name="DiagnosisID[]" value="${data.id}">
                <p>${rowIdx}</p>
              </td>
              <td class="text-center">
              ${data.description}
              </td>
              </tr>`);
      });

    });


    // jQuery button click event to remove a row.
    $('#tbody').on('click', '.remove-medicine-treatment', function () {

      var med_value = 0;
      var total_amount =0;
      var totalPayableAmount = 0;

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

    $('.open-modal-lead-assessment').click(function(data){
      var id = $(this).val();
      $('#patient_id').val(id);
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