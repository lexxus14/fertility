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
   <form action="{{route('FreshFormPage2Update')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
        {{ csrf_field() }}
      <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
      <input type="hidden" name="FreshFormId" value="{{$DocId}}">
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
              <h3 class="card-title">Short Protocol</h3>

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
                    <label>ICSI</label>
                      <input type="text" class="form-control" value="{{$docresult->ICSI}}" name="ICSI"/>
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label>Egg Freezing</label>
                      <input type="text" class="form-control" value="{{$docresult->EggFreezing}}" name="EggFreezing"/>
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
                      <label>CD 2</label>
                      <input type="text" class="form-control" value="{{$docresult->CD2}}" name="CD2">
                    </div>
                  </div>
                  
                  <div class="col-4">
                    <div class="form-group">
                      <label>Protocol</label>
                      <input type="text" class="form-control" value="{{$docresult->Protocol}}" name="Protocol">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-2">
                      <div class="form-group">
                        <label>FSH</label>
                          <input type="text" class="form-control" value="{{$docresult->FSH}}" name="FSH"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>Estradiol</label>
                          <input type="text" class="form-control" value="{{$docresult->Estradiol}}" name="txtEstradiol"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>AMH</label>
                          <input type="text" class="form-control" value="{{$docresult->AMH}}" name="AMH"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>CBC Date</label>
                          <input type="date" class="form-control" value="{{$docresult->CBCDate}}" name="CBCDate"/>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-2">
                      <div class="form-group">
                        <label>Uterine Position</label>
                          <input type="text" class="form-control" value="{{$docresult->UterinePosition}}" name="UterinePosition"/>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label>Measurement</label>
                          <input type="number" class="form-control" value="{{$docresult->Measurement}}" name="Measurement" placeholder="mm" />
                      </div>
                  </div>                
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <div class="icheck-success d-inline">
                        @if($docresult->IsConsent==1)
                        <input type="checkbox" name="IsConsent" checked id="chkConcent">
                        @else
                        <input type="checkbox" name="IsConsent" id="chkConcent">
                        @endif
                        <label for="chkConcent">
                          Consent
                        </label>
                      </div>
                      <div class="icheck-success d-inline">
                        @if($docresult->IsCBC==1)
                        <input type="checkbox" name="IsCBC" checked id="IsCBC">
                        @else
                        <input type="checkbox" name="IsCBC" id="IsCBC">
                        @endif
                        <label for="IsCBC">
                          CBC
                        </label>
                      </div>                    
                      <div class="icheck-success d-inline">
                        @if($docresult->WallaceYesNo==1)
                        <input type="checkbox" name="WallaceYesNo" checked id="WallaceYesNo">
                        @else
                        <input type="checkbox" name="WallaceYesNo" id="WallaceYesNo">
                        @endif
                        <label for="WallaceYesNo">
                          Wallace
                        </label>
                      </div>
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
                            <input type="number" class="form-control" name="CDNo[]" value="{{$FETPage2CDSub->CycleNo}}">
                          </td>
                          <td class="text-center">
                            <input type="date" class="form-control" name="CDDate[]" value="{{$FETPage2CDSub->CycleDate}}">
                          </td>
                          <td class="text-center">
                            <div class="form-group row">
                              <label for="rt" class="col-sm-2 col-form-label">RT</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="rt" name="RT[]" placeholder="RT" value="{{$FETPage2CDSub->UltrasoundRT}}">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="lt" class="col-sm-2 col-form-label">LT</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="lt" name="LT[]" placeholder="LT" value="{{$FETPage2CDSub->UltrasoundLT}}">
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
                <div class="col-12">
                  <a href="{{route('FreshFormPage2')}}/{{$PhaseId}}" class="btn btn-secondary">Cancel</a>
                  <a href="{{route('FreshFormPage2Print')}}/{{$PhaseId}}/{{$DocId}}" target="_blank" class="btn btn-secondary float-right">Print</a>
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


<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endsection