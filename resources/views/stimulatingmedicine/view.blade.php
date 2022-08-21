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
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Stimulating Medicine</h3>
          </div>
          <div class="card-body">
            @foreach($docresults as $docresult)

              <input type="hidden" name="txtDocId" value="{{$docId}}">
              <input type="hidden" name="txtStiPhaseId" value="{{$StiPhaseId}}">
              <div class="modal-body">
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">                  
                      <label>Start Date</label>                      
                        <input type="date" class="form-control" name="txtDocDate" value="{{$docresult->docdate}}">
                    </div>
                  </div>                
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>Cycle Day</label>                 
                      <input type="number" name="CycleNo" placeholder="Number" class="form-control" value="{{$docresult->CycleNo}}">
                    </div>
                  </div>
                </div>
                <div class="row">                
                  <div class="col-2">
                    <div class="form-group">
                      <label>AM</label>
                      <input type="number" name="MedDoseAM" class="form-control" value="{{$docresult->MedDoseAM}}">
                    </div>
                  </div>
                  <div class="col-2">
                    <label>Unit</label>
                    <select name="UnitIdAM" class="form-control">
                      @foreach($medicinesunits as $medunit)
                        @if($medunit->id==$docresult->UnitIdAM)
                          <option selected value="{{$medunit->id}}">{{$medunit->ShortSymbol}}</option>
                        @else
                          <option selected value="{{$medunit->id}}">{{$medunit->ShortSymbol}}</option>
                        @endif
                      @endforeach
                    </select>                  
                  </div>
                  <div class="col-8">
                    <label>Medicine</label>
                    <div class="input-group">
                      <input class="form-control" type="text" id="txtAmMedicine" value="{{$docresult->MedAm}}">
                      <input type="hidden" name="MedIdAM" id="MedIdAM" value="{{$docresult->MedIdAM}}">                      
                    </div>
                  </div>
                </div> 
                <div class="row">                
                  <div class="col-2">
                    <div class="form-group">
                      <label>PM</label>
                      <input type="number" name="MedDosePM" class="form-control" value="{{$docresult->MedDosePM}}">
                    </div>
                  </div>
                  <div class="col-2">
                    <label>Unit</label>
                    <select name="UnitIdPM" class="form-control">
                      @foreach($medicinesunits as $medunit)
                        @if($medunit->id==$docresult->UnitIdPM)
                          <option selected value="{{$medunit->id}}">{{$medunit->ShortSymbol}}</option>
                        @else
                          <option selected value="{{$medunit->id}}">{{$medunit->ShortSymbol}}</option>
                        @endif
                      @endforeach
                    </select>                  
                  </div>
                  <div class="col-8">
                    <label>Medicine</label>
                    <div class="input-group">
                      <input class="form-control" type="text" id="txtPmMedicine" value="{{$docresult->MedPm}}">
                      <input type="hidden" name="MedIdPM" id="txtPmMedicineId" value="{{$docresult->MedIdPM}}">
                      
                    </div>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Breakfast</label>
                    </div>
                    <textarea name="Breakfast" class="form-control">{{$docresult->Breakfast}}</textarea>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Lunch</label>
                    </div>
                    <textarea name="Lunch" class="form-control">{{$docresult->Lunch}}</textarea>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Dinner</label>
                    </div>
                    <textarea name="Dinner" class="form-control">{{$docresult->Dinner}}</textarea>
                  </div>
                </div> 
                <hr>
                <div class="row">                
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Other Medicine</label>
                      
                      <table class="table table-bordered">
                      <thead>
                        <tr>                        
                          <th>Medicine</th>
                          <th>Dosage</th>
                          <th>Unit</th>
                        </tr>
                      </thead>
                      <tbody id="tbody">
                        <?php $intctr=1; ?>
                        @foreach($subdocresults as $subdocresult)
                        <?php $intctr++; ?>
                        <tr id="R{{$intctr}}">                    
                          <td>{{$subdocresult->Medicine}}<input type="hidden" class="medid" name="MedId[]" value="{{$subdocresult->MedId}}"></td>
                          <td>
                            <input type="number" name="dose[]" class="form-control" value="{{$subdocresult->dose}}">
                          </td>
                          <td>
                            <select name="UnitId[]" class="form-control">
                              @foreach($medicinesunits as $medunit)
                                @if($medunit->id==$subdocresult->UnitId)
                                  <option selected value="{{$medunit->id}}">{{$medunit->ShortSymbol}}</option>
                                @else
                                  <option value="{{$medunit->id}}">{{$medunit->ShortSymbol}}</option>
                                @endif
                              @endforeach
                            </select> 
                          </td>
                          
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>    
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Notes</label>
                      <textarea name="Notes" class="form-control">{{$docresult->Notes}}</textarea>
                    </div>
                  </div>
                </div> 
              </div>            
              <div class="modal-footer justify-content-between">
                <a href="{{route('StimulatingMedicine')}}/{{$StiPhaseId}}" class="btn btn-default">Cancel</a>
              </div>
    
            @endforeach
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>

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