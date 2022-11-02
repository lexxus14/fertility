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
   <form action="{{route('SpermThawingStore')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
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
              <h3 class="card-title">Sperm Thawing</h3>

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
              <b>PRC Processed Sperm</b>
              <div class="row">
                <div class="form-group">
                <div class="col-12">
                  <input type="button" value="Add" class="btn btn-success float-right" id="AddProcessedSperm">
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
                        <th style="width: 100px"># Of Vials</th>
                        <th>Date Recovered</th>
                        <th>Office</th>
                        <th>Specimen Type</th>
                        <th style="width: 40px">Action</th>
                      </tr>                  
                      </thead>
                      <tbody id="tbody">
                        
                      
        
                      </tbody>                  
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>      
              <div class="form-group row">
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Completed by:" class="btn btn-success float-right" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="CompByStaffId" id="CompByStaffId" value="0">
                    <input type="text" class="form-control" id="CompByStaffName">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="Notes">
                    Notes
                  </label>
                  <textarea class="form-control" name="Notes" rows="4"></textarea>
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
                  <a href="{{route('SpermThawing')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
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
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Staff</h4>
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

    
    var rowIdx = 0;                 
    
    /* Price List */

    $('#AddProcessedSperm').click(function(){

            $('#tbody').append(`<tr id="R${++rowIdx}">
              <td class="row-index text-center">                
                <input type="text" class="form-control" name="NoOfVials[]" value="1">
              </td>
              <td class="text-center">
                <input type="date" class="form-control" name="DateRecovered[]" >
              </td>
              <td class="text-center">
                <input type="text" class="form-control" name="Office[]" value="DHCC">
              </td>
              <td class="text-left">
                  <div class="form-group">
                  <input type="hidden" value="0" name="IsFresh[]"  id="IsFreshVal${rowIdx}">
                    <div class="icheck-success d-inline">                  
                      <input type="checkbox" id="F${rowIdx}" class="IsFresh">
                      <label for="F${rowIdx}">
                        Fresh
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                  <input type="hidden" value="0" name="IsTESEPESAMESA[]"  id="IsTESEPESAMESAVal${rowIdx}">
                    <div class="icheck-success d-inline">
                      <input type="checkbox"  id="T${rowIdx}" class="IsTESEPESAMESA">
                      <label for="T${rowIdx}">
                        TESA PESA MESA
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                  <input type="hidden" value="0" name="IsPrevFroz[]"  id="IsPrevFrozVal${rowIdx}">
                    <div class="icheck-success d-inline">
                      <input type="checkbox"  id="P${rowIdx}" class="IsPrevFroz">
                      <label for="P${rowIdx}">
                        Previously Frozen
                      </label>
                    </div>
                  </div>
              </td>
              <td class="text-center">
                <input type="button" class="btn btn-danger btn-sm remove-medicine-treatment float-right" value="Remove">

                </td>
              </tr>`);


    });


    $('.add-staff').click(function(){

      var med_id = $(this).val();
      url = '{{route('GetStaffInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);
        $('#CompByStaffName').val(data.name); 
        $('#CompByStaffId').val(data.id); 
      });

      $('#open-modal-staff').modal('toggle'); 

    });

    // jQuery button click event to remove a row.
    $('#tbody').on('click', '.IsFresh', function () {

      var id = $(this).attr('id');
      var dig = parseInt(id.substring(1));

      var curval = $('#IsFreshVal'+dig).val();
      if(curval==0)
      {
        $('#IsFreshVal'+dig).val(1);
      }
      else
      {
         $('#IsFreshVal'+dig).val(0);
      }

    });

    $('#tbody').on('click', '.IsTESEPESAMESA', function () {

      var id = $(this).attr('id');
      var dig = parseInt(id.substring(1));

      var curval = $('#IsTESEPESAMESAVal'+dig).val();
      if(curval==0)
      {
        $('#IsTESEPESAMESAVal'+dig).val(1);
      }
      else
      {
         $('#IsTESEPESAMESAVal'+dig).val(0);
      }

    });

    $('#tbody').on('click', '.IsPrevFroz', function () {

      var id = $(this).attr('id');
      var dig = parseInt(id.substring(1));

      var curval = $('#IsPrevFrozVal'+dig).val();
      if(curval==0)
      {
        $('#IsPrevFrozVal'+dig).val(1);
      }
      else
      {
         $('#IsPrevFrozVal'+dig).val(0);
      }

    });

    $('#tbody').on('click', '.remove-medicine-treatment', function () {


      // Getting all the rows next to the row
      // containing the clicked button
      var child = $(this).closest('tr').nextAll();

      // // Iterating across all the rows
      // // obtained to change the index
      // child.each(function () {

      //             // Getting <tr> id.
      //             var id = $(this).attr('id');

      //             // Getting the <p> inside the .row-index class.
      //             var idx = $(this).children('.row-index').children('p');

      //             // Gets the row number from <tr> id.
      //             var dig = parseInt(id.substring(1));

      //             // Modifying row index.
      //             idx.html(`${dig - 1}`);

      //             // Modifying row id.
      //             $(this).attr('id', `R${dig - 1}`);
      // });

      // Removing the current row.
      $(this).closest('tr').remove();

      // Decreasing total number of rows by 1.
      // rowIdx--;
    });

    });

/* Lead Assessement */


  </script>
@endsection