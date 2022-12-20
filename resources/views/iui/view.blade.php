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
              <h3 class="card-title">IUI</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group row">     
                <div class="col-md-3">
                  <label for="docdate" class="col-form-label">Date</label>
                  <input type="date" class="form-control" id="docdate" name="docdate" value="{{$docresult->docdate}}" />
                </div>  
                <div class="col-md-3">
                  <label for="AccessionNo" class="col-form-label">Accession No</label>
                  <input type="text" class="form-control" id="AccessionNo" name="AccessionNo" value="{{$docresult->AccessionNo}}"/>
                </div>         
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  Complete of Ejaculation &nbsp
                  
                    <div class="icheck-success d-inline">
                      @if($docresult->IsComplete)
                      <input type="checkbox" name="IsComplete" checked id="IsComplete">
                      @else
                      <input type="checkbox" name="IsComplete" id="IsComplete">
                      @endif
                      <label for="IsComplete">
                        Complete
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsSpilled)
                      <input type="checkbox" name="IsSpilled" checked id="IsSpilled">
                      @else
                      <input type="checkbox" name="IsSpilled" id="IsSpilled">
                      @endif
                      <label for="IsSpilled">
                        Spilled
                      </label>
                    </div> 
                </div>

                <div class="col-md-6">
                  Collected At &nbsp
                  <div class="icheck-success d-inline">
                    @if($docresult->IsHome)
                    <input type="checkbox" name="IsHome" checked id="IsHome">
                    @else
                    <input type="checkbox" name="IsHome" id="IsHome">
                    @endif
                    <label for="IsHome">
                      Home
                    </label>
                  </div>
                  <div class="icheck-success d-inline">
                    @if($docresult->IsOffice)
                    <input type="checkbox" name="IsOffice" checked id="IsOffice">
                    @else
                    <input type="checkbox" name="IsOffice" id="IsOffice">
                    @endif
                    <label for="IsOffice">
                      Office
                    </label>
                  </div>
                </div>
              </div>  

              <div class="form-group row">                
                <div class="col-md-3">
                  <label for="DaysOfAbstinence" class="col-form-label">Days of Abtinence</label>
                  <input type="text" class="form-control" id="DaysOfAbstinence" name="DaysOfAbstinence" value="{{$docresult->DaysOfAbstinence}}" />
                </div>
                <div class="col-md-3">
                  <label for="CompByName">Physician</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="MD:" class="btn btn-success float-right" id="CompByName" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="PhysicianStaffId" id="CompByStaffId" value="{{$docresult->PhysicianStaffId}}">
                    <input type="text" class="form-control" id="CompByStaffName" value="{{$docresult->PhysicianStaffName}}">
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="CollectionTime" class="col-form-label">Collection Time</label>
                  <input type="time" class="form-control" id="CollectionTime" name="CollectionTime" value="{{$docresult->CollectionTime}}" />
                </div>
                <div class="col-md-3">
                  <label for="DeliveryTime" class="col-form-label">Delivery Time</label>
                  <input type="time" class="form-control" id="DeliveryTime" name="DeliveryTime" value="{{$docresult->DeliveryTime}}" />
                </div>                
              </div>

               
              
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <!-- <h3 class="card-title">Responsive Hover Table</h3> -->
                      <div class="row">
                        <div class="col-md-4 text-left">
                          
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
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <!-- <h3 class="card-title">Responsive Hover Table</h3> -->
                      <div class="row">
                        <div class="col-md-4 text-left">
                         <b></b>
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
                            <th>Before Preparation</th>
                            <th></th>
                            <th>Normal Range</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Volume</td>
                            <td><input type="number" class="form-control" name="Volume" value="{{$docresult->Volume}}"> </td>
                            <td>>=1.5ml</td>
                          </tr>
                          <tr>
                            <td>Sperm Concentration</td>
                            <td><input type="number" class="form-control" name="SpermConcentration" value="{{$docresult->SpermConcentration}}"> </td>
                            <td>>=15 Million /ml </td>
                          </tr>
                          <tr>
                            <td>Total Sperm Count</td>
                            <td><input type="number" class="form-control" name="TotalSpermCount" value="{{$docresult->TotalSpermCount}}"> </td>
                            <td>>=39 Million /ml</td>
                          </tr>
                          <tr>
                            <td>pH</td>
                            <td><input type="text" class="form-control" name="pH" value="{{$docresult->pH}}"> </td>
                            <td>>=7.2</td>
                          </tr>
                          <tr>
                            <td>Progressive Motility (a+b)</td>
                            <td> </td>
                            <td>>=39 %</td>
                          </tr>
                          <tr>
                            <td>a. Rapid</td>
                            <td><input type="number" class="form-control" name="ProgRapid" placeholder="%" value="{{$docresult->ProgRapid}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>b. Slow</td>
                            <td><input type="number" class="form-control" name="ProgSlow" placeholder="%" value="{{$docresult->ProgSlow}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>c. Non Progressive</td>
                            <td><input type="number" class="form-control" name="ProgNonProg" placeholder="%" value="{{$docresult->ProgNonProg}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>d. Non Motile</td>
                            <td><input type="number" class="form-control" name="ProgNonMotile" placeholder="%" value="{{$docresult->ProgNonMotile}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Morphology: Strick Criterea [Kruger]</td>
                            <td> </td>
                            <td>>=4 %</td>
                          </tr>
                          <tr>
                            <td>Normal Forms</td>
                            <td><input type="number" class="form-control" name="NorForms" placeholder="%" value="{{$docresult->NorForms}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Abnormal Head</td>
                            <td><input type="number" class="form-control" name="AbHead" placeholder="%" value="{{$docresult->AbHead}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Abnormal Midpiece</td>
                            <td><input type="number" class="form-control" name="AbMidpiece" placeholder="%" value="{{$docresult->AbMidpiece}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Abnormal Tail</td>
                            <td><input type="number" class="form-control" name="AbTail" placeholder="%" value="{{$docresult->AbTail}}"> </td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>    

              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <!-- <h3 class="card-title">Responsive Hover Table</h3> -->
                      <div class="row">
                        <div class="col-md-4 text-left">
                         <b></b>
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
                            <th>After Preparation</th>
                            <th></th>
                            <th>Normal Range</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Volume</td>
                            <td><input type="number" class="form-control" name="AfPreVolume" value="{{$docresult->AfPreVolume}}"> </td>
                            <td>>=1.5ml</td>
                          </tr>
                          <tr>
                            <td>Sperm Concentration</td>
                            <td><input type="number" class="form-control" name="AfPreSpermConcentration" value="{{$docresult->AfPreSpermConcentration}}"> </td>
                            <td>>=15 Million /ml </td>
                          </tr>
                          <tr>
                            <td>Total Sperm Count</td>
                            <td><input type="number" class="form-control" name="AfPreTotalSpermCount" value="{{$docresult->AfPreTotalSpermCount}}"> </td>
                            <td>>=39 Million /ml</td>
                          </tr>
                          <tr>
                            <td>Progressive Motility (a+b)</td>
                            <td> </td>
                            <td>>=39 %</td>
                          </tr>
                          <tr>
                            <td>a. Rapid</td>
                            <td><input type="number" class="form-control" name="AfPreProgRapid" placeholder="%" value="{{$docresult->AfPreProgRapid}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>b. Slow</td>
                            <td><input type="number" class="form-control" name="AfPreProgSlow" placeholder="%" value="{{$docresult->AfPreProgSlow}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>c. Non Progressive</td>
                            <td><input type="number" class="form-control" name="AfPreProgNonProg" placeholder="%" value="{{$docresult->AfPreProgNonProg}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>d. Non Motile</td>
                            <td><input type="number" class="form-control" name="AfPreProgNonMotile" placeholder="%" value="{{$docresult->AfPreProgNonMotile}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Morphology: Strick Criterea [Kruger]</td>
                            <td> </td>
                            <td>>=4 %</td>
                          </tr>
                          <tr>
                            <td>Normal Forms</td>
                            <td><input type="number" class="form-control" name="AfPreNorForms" placeholder="%" value="{{$docresult->AfPreNorForms}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Abnormal Head</td>
                            <td><input type="number" class="form-control" name="AfPreAbHead" placeholder="%" value="{{$docresult->AfPreAbHead}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Abnormal Midpiece</td>
                            <td><input type="number" class="form-control" name="AfPreAbMidpiece" placeholder="%" value="{{$docresult->AfPreAbMidpiece}}"> </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Abnormal Tail</td>
                            <td><input type="number" class="form-control" name="AfPreAbTail" placeholder="%" value="{{$docresult->AfPreAbTail}}"> </td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>       
              

              <div class="form-group row">
                <div class="col-md-2">
                  <label for="TimeAnalyzed">Time Analyzed</label>
                  <input type="time" class="form-control" name="TimeAnalyzed" id="TimeAnalyzed" value="{{$docresult->TimeAnalyzed}}">
                </div>
                <div class="col-md-6">
                  <label for="EmbryologistStaffId">Embryologist</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <input type="button" value="Emb:" class="btn btn-success float-right" id="EmbryologistName" data-toggle="modal" data-target="#open-modal-staff">
                    </div>
                    <!-- /btn-group -->
                    <input type="hidden" class="form-control" name="EmbryologistStaffId" id="EmbryologistStaffId" value="{{$docresult->EmbryologistStaffId}}">
                    <input type="text" class="form-control" id="EmbryologistStaffName" value="{{$docresult->EmbryologistStaffName}}">
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
                  <a href="{{route('IUI')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                  <a href="{{route('PrintIUI')}}/{{$docId}}" target="_blank" class="btn btn-secondary float-right">Print</a>
                </div>
              </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      

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


<script>
$(function () {
  bsCustomFileInput.init();
});
</script>



@endsection