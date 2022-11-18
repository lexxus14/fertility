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
   <form action="{{route('EmbryologyRecordIIUpdate')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
        {{ csrf_field() }}
      <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
      <input type="hidden" name="docId" value="{{$docId}}">
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
              <h3 class="card-title">Embryology Record II</h3>

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
                <input type="date" class="form-control" id="docdate" name="docdate"/>
              </div>  
              <div class="col-md-3">
                <label for="RecordNo" class="col-form-label">Record No</label>
                <input type="text" class="form-control" id="RecordNo" name="RecordNo"/>
              </div> 
              <div class="col-md-3">
                <label for="CycleNo" class="col-form-label">Cycle No</label>
                <input type="text" class="form-control" id="CycleNo" name="CycleNo"/>
              </div> 
                            
            </div>
            <hr>

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
                    <table class="table table-bordered table-striped">
                      <thead>                  
                      <tr>
                        <th colspan="3" class="text-left">
                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Date 0:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="date" name="Day0Date" class="form-control" value="{{$docresult->Day0Date}}">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Time:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="time" name="Day0Time" class="form-control" value="{{$docresult->Day0Time}}">
                            </div>
                          </div>
                          

                            <div class="input-group">
                              <div class="input-group-prepend">
                                <input type="button" value="Embryologist:" class="btn btn-success float-right" data-toggle="modal" id="Day0EmbryologistStaffName" data-target="#open-modal-staff">
                              </div>
                              <!-- /btn-group -->
                              <input type="hidden" class="form-control" name="Day0EmbryologistStaffId" id="Day0EmbryologistStaffId" value="{{$docresult->Day0EmbryologistStaffId}}">
                              <input type="text" class="form-control" id="Day0EmbryologistName" value="{{$docresult->Day0EmbryologistName}}">
                            </div>
                          
                        </th>    
                        <th colspan="3" class="text-left">

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Date 1:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="date" name="Day1Date" class="form-control" value="{{$docresult->Day1Date}}">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Time:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="time" name="Day1Time" class="form-control" value="{{$docresult->Day1Time}}">
                            </div>
                          </div>

                            <div class="input-group">
                              <div class="input-group-prepend">
                                <input type="button" value="Embryologist:" class="btn btn-success float-right" data-toggle="modal" id="Day1EmbryologistStaffName" data-target="#open-modal-staff">
                              </div>
                              <!-- /btn-group -->
                              <input type="hidden" class="form-control" name="Day1EmbryologistStaffId" id="Day1EmbryologistStaffId" value="{{$docresult->Day1EmbryologistStaffId}}">
                              <input type="text" class="form-control" id="Day1EmbryologistName" value="{{$docresult->Day1EmbryologistName}}">
                            </div>

                        </th>  
                        <th  class="text-left">

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Date 3:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="date" name="Day3Date" class="form-control" value="{{$docresult->Day3Date}}">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Time:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="time" name="Day3Time" class="form-control" value="{{$docresult->Day3Time}}">
                            </div>
                          </div>                     

                            <div class="input-group">
                              <div class="input-group-prepend">
                                <input type="button" value="Emb:" class="btn btn-success float-right" data-toggle="modal" id="Day3EmbryologistStaffName" data-target="#open-modal-staff">
                              </div>
                              <!-- /btn-group -->
                              <input type="hidden" class="form-control" name="Day3EmbryologistStaffId" id="Day3EmbryologistStaffId" value="{{$docresult->Day3EmbryologistStaffId}}">
                              <input type="text" class="form-control" id="Day3EmbryologistName" value="{{$docresult->Day3EmbryologistName}}">
                            </div>

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>AH Time:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="time" name="Day3AhTime" class="form-control" value="{{$docresult->Day3AhTime}}">
                            </div>
                          </div> 

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>AH Tec:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="text" name="Day3AhTech" class="form-control" value="{{$docresult->Day3AhTech}}">
                            </div>
                          </div> 

                        </th>    
                        <th class="text-left">

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Date 5:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="date" name="Day5Date" class="form-control" value="{{$docresult->Day5Date}}">
                            </div>
                          </div> 

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Time:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="time" name="Day5Time" class="form-control" value="{{$docresult->Day5Time}}">
                            </div>
                          </div> 

                            <div class="input-group">
                              <div class="input-group-prepend">
                                <input type="button" value="Emb:" class="btn btn-success float-right" data-toggle="modal" id="Day5EmbryologistStaffName" data-target="#open-modal-staff">
                              </div>
                              <!-- /btn-group -->
                              <input type="hidden" class="form-control" name="Day5EmbryologistStaffId" id="Day5EmbryologistStaffId" value="{{$docresult->Day5EmbryologistStaffId}}">
                              <input type="text" class="form-control" id="Day5EmbryologistName" value="{{$docresult->Day5EmbryologistName}}">
                            </div>

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>AH Time:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="time" name="Day5AhTime" class="form-control" value="{{$docresult->Day5AhTime}}">
                            </div>
                          </div> 

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>AH Tec:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="text" name="Day5AhTech" class="form-control"  value="{{$docresult->Day5AhTech}}">
                            </div>
                          </div>

                        </th>     
                        <th class="text-left">

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Date 6:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="date" name="Day6Date" class="form-control" value="{{$docresult->Day6Date}}">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>Time:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="time" name="Day6Time" class="form-control" value="{{$docresult->Day6Time}}">
                            </div>
                          </div>
                          
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <input type="button" value="Emb:" class="btn btn-success float-right" data-toggle="modal" id="Day6EmbryologistStaffName" data-target="#open-modal-staff">
                              </div>
                              <!-- /btn-group -->
                              <input type="hidden" class="form-control" name="Day6EmbryologistStaffId" id="Day6EmbryologistStaffId" value="{{$docresult->Day6EmbryologistStaffId}}">
                              <input type="text" class="form-control" id="Day6EmbryologistName" value="{{$docresult->Day6EmbryologistName}}">
                            </div>


                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>AH Time:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="time" name="Day6AhTime" class="form-control" value="{{$docresult->Day6AhTime}}">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label>AH Tec:</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="text" name="Day6AhTech" class="form-control" value="{{$docresult->Day6AhTech}}">
                            </div>
                          </div>
                          
                        </th>   
                        <th class="text-left">
                          <label>Disposition</label>
                          <label>ET-Transfer</label>
                          <label>C-egg Cyro</label>
                          <label>D-Discard</label>
                        </th>         
                        <th></th>
                      </tr>  
                        <tr>
                          <th>Maturity</th>
                          <th>Remarks</th>
                          <th>ICSI</th>
                          <th>PB</th>
                          <th>PN</th>    
                          <th>Remarks</th>    
                          <th></th>    
                          <th></th>    
                          <th></th>    
                          <th></th>    
                          <th></th>                    
                        </tr>                
                      </thead>
                      <tbody id="tbody">
                        <?php $intctr=1; ?>
                        @foreach($EmbryologyRecordIISubs as $EmbryologyRecordIISub)
                        <tr id="R{{$intctr}}">
                          <td class="row-index text-center">                
                            <input type="text" class="form-control" name="maturity[]" value="{{$EmbryologyRecordIISub->maturity}}">
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" name="Day0remarks[]" value="{{$EmbryologyRecordIISub->Day0remarks}}">
                          </td>
                          <td class="text-center">
                            <input type="text" class="form-control" name="icsi[]" value="{{$EmbryologyRecordIISub->icsi}}">
                          </td>

                          <td class="text-center">
                            <input type="text" class="form-control" name="PB[]" value="{{$EmbryologyRecordIISub->PB}}">
                          </td>

                          <td class="text-center">
                            <input type="text" class="form-control" name="PN[]" value="{{$EmbryologyRecordIISub->PN}}">
                          </td>

                          <td class="text-center">
                            <input type="text" class="form-control" name="Day1remarks[]" value="{{$EmbryologyRecordIISub->Day1remarks}}">
                          </td>

                          <td class="text-center">
                            <input type="text" class="form-control" name="Day3remarks[]" value="{{$EmbryologyRecordIISub->Day3remarks}}">
                          </td>
                          
                          <td class="text-center">
                            <input type="text" class="form-control" name="Day5remarks[]" value="{{$EmbryologyRecordIISub->Day5remarks}}">
                          </td>

                          <td class="text-center">
                            <input type="text" class="form-control" name="Day6remarks[]" value="{{$EmbryologyRecordIISub->Day6remarks}}">
                          </td>

                          <td class="text-center">
                            <input type="text" class="form-control" name="Dispositionremarks[]" value="{{$EmbryologyRecordIISub->Dispositionremarks}}">
                          </td>

                          <td class="text-center">
                            <input type="button" class="btn btn-danger btn-sm remove-medicine-treatment float-right" value="Remove">

                          </td>
                        </tr>  
                        <?php $intctr++; ?>
                        @endforeach                 
                                            
                      </tbody>  
                      <tfoot>
                        <tr>
                           
                        <th colspan="3" class="text-left">
                         
                        </th>  
                        <th colspan="3"   class="text-left">
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label>PT Cal:</label>
                              <input type="text" name="Day1PtCall" class="form-control" value="{{$docresult->Day1PtCall}}">
                            </div>
                            <div class="col-sm-6">
                              <label>Initial:</label>
                              <input type="text" name="Day1Initial" class="form-control" value="{{$docresult->Day1Initial}}">
                            </div>
                          </div>
                          
                        </th>
                        <th  class="text-left">
                            <div class="form-group row">
                            <div class="col-sm-6">
                              <label>PT Cal:</label>
                              <input type="text" name="Day3PtCall" class="form-control"  value="{{$docresult->Day3PtCall}}">
                            </div>
                            <div class="col-sm-6">
                              <label>Initial:</label>
                              <input type="text" name="Day3Initial" class="form-control" value="{{$docresult->Day3Initial}}">
                            </div>
                          </div>
                          
                        </th>    
                        <th class="text-left">
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label>PT Cal:</label>
                              <input type="text" name="Day5PtCall" class="form-control" value="{{$docresult->Day5PtCall}}">
                            </div>
                            <div class="col-sm-6">
                              <label>Initial:</label>
                              <input type="text" name="Day5Initial" class="form-control" value="{{$docresult->Day5Initial}}">
                            </div>
                          </div>
                        </th>     
                        <th class="text-left">
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label>PT Cal:</label>
                              <input type="text" name="Day6PtCall" class="form-control"  value="{{$docresult->Day6PtCall}}">
                            </div>
                            <div class="col-sm-6">
                              <label>Initial:</label>
                              <input type="text" name="Day6Initial" class="form-control" value="{{$docresult->Day6Initial}}">
                            </div>
                          </div>
                        </th>   
                        <th class="text-left">
                        </th>         
                        <th></th>
                      </tr>                        
                      </tfoot>                
                    </table>
                <!-- /.card-body -->
                  
                </div>
              </div>

              <div class="row">
                <div class="card col-12">
                  <div class="card-header">
                    Lot Numbers
                  </div>
                  <div class="card-body">
                    <div class="form-group row">
                      <div class="col-md-2">
                        <label for="AspLotNo">ASP Lot #</label>
                        <input type="text" name="AspLotNo" class="form-control" id="AspLotNo" value="{{$docresult->AspLotNo}}">
                      </div>
                      <div class="col-md-2">
                        <label for="AspExpDate">ASP Date</label>
                        <input type="date" name="AspExpDate" class="form-control" id="AspExpDate" value="{{$docresult->AspExpDate}}">
                      </div>
                      <div class="col-md-2">
                        <label for="ProteinSSSLot">Protein SSS Lot</label>
                        <input type="text" name="ProteinSSSLot" class="form-control" id="ProteinSSSLot" value="{{$docresult->ProteinSSSLot}}">
                      </div>
                      <div class="col-md-2">
                        <label for="ProteinSSSExpDate">Protein SSS Exp Date</label>
                        <input type="date" name="ProteinSSSExpDate" class="form-control" id="ProteinSSSExpDate" value="{{$docresult->ProteinSSSExpDate}}">
                      </div>
                      <div class="col-md-4">
                        <label>Others</label>
                        <input type="text" name="AspOthers" class="form-control" value="{{$docresult->AspOthers}}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-2">
                        <label for="GlobalLotNo">Global Lot #</label>
                        <input type="text" name="GlobalLotNo" class="form-control" id="GlobalLotNo" value="{{$docresult->GlobalLotNo}}">
                      </div>
                      <div class="col-md-2">
                        <label for="GlobalExpDate">Global Date</label>
                        <input type="date" name="GlobalExpDate" class="form-control" id="GlobalExpDate" value="{{$docresult->GlobalExpDate}}">
                      </div>
                      <div class="col-md-2">
                        <label for="mHTFLotNo">mHTF Lot #</label>
                        <input type="text" name="mHTFLotNo" class="form-control" id="mHTFLotNo" value="{{$docresult->mHTFLotNo}}">
                      </div>
                      <div class="col-md-2">
                        <label for="mHTFExpDate">mHT FExp Date</label>
                        <input type="date" name="mHTFExpDate" class="form-control" id="mHTFExpDate" value="{{$docresult->mHTFExpDate}}">
                      </div>
                      <div class="col-md-4">
                        <label>Others</label>
                        <input type="text" name="GlobalOther" class="form-control" value="{{$docresult->GlobalOther}}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-2">
                        <label for="HyluronidaseLogNo">Hyluronidase Log #</label>
                        <input type="text" name="HyluronidaseLogNo" class="form-control" id="HyluronidaseLogNo" value="{{$docresult->HyluronidaseLogNo}}">
                      </div>
                      <div class="col-md-2">
                        <label for="HyluronidaseExpDate">Hyluronidase Exp Date</label>
                        <input type="date" name="HyluronidaseExpDate" class="form-control" id="HyluronidaseExpDate" value="{{$docresult->HyluronidaseExpDate}}">
                      </div>
                      <div class="col-md-2">
                        <label for="OilLotNo">Oil Lot No</label>
                        <input type="text" name="OilLotNo" class="form-control" id="OilLotNo" value="{{$docresult->OilLotNo}}">
                      </div>
                      <div class="col-md-2">
                        <label for="OilExpDate">Oil Exp Date</label>
                        <input type="date" name="OilExpDate" class="form-control" id="OilExpDate" value="{{$docresult->OilExpDate}}">
                      </div>
                      <div class="col-md-4">
                        <label>Others</label>
                        <input type="text" name="GlobalOthers" class="form-control" value="{{$docresult->GlobalOthers}}">
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              
              <hr>
              <div class="row">
                <div class="col-sm-12">
                  <label for="Notes">Notes</label>
                  <textarea class="form-control" id="Notes" name="Notes"> {{$docresult->Notes}}</textarea>
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
                      @if(is_file(public_path($docresult->filelink)))
                      <a href="{{asset($docresult->filelink)}}" target="_blank">Existing File...</a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <a href="{{route('EmbryologyRecordII')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                  <input type="submit" value="Save" class="btn btn-success float-right">
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
              

    $('#Day0EmbryologistStaffName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
       $('#SelectedModal').val("1");
    });

    $('#Day1EmbryologistStaffName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
       $('#SelectedModal').val("2");
    });

    $('#Day3EmbryologistStaffName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
       $('#SelectedModal').val("3");
    });

    $('#Day5EmbryologistStaffName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
       $('#SelectedModal').val("4");
    });
    $('#Day6EmbryologistStaffName').click(function(){
      $('#StaffModalTitle').text('Embryologist');
       $('#SelectedModal').val("5");
    });     

    $('.add-staff').click(function(){

      var med_id = $(this).val();
      var SelectedId = $('#SelectedModal').val();
      url = '{{route('GetStaffInfo')}}';

      $.get(url + '/' + med_id, function (data) {
        console.log(data);


        switch(SelectedId){
          case "1":
            $('#Day0EmbryologistName').val(data.name); 
            $('#Day0EmbryologistStaffId').val(data.id); 
            break;

          case "2":
            $('#Day1EmbryologistName').val(data.name); 
            $('#Day1EmbryologistStaffId').val(data.id); 
            break;

          case "3":
            $('#Day3EmbryologistName').val(data.name); 
            $('#Day3EmbryologistStaffId').val(data.id); 
            break;

          case "4":
            $('#Day5EmbryologistName').val(data.name); 
            $('#Day5EmbryologistStaffId').val(data.id); 
            break;

          default:
            $('#Day6EmbryologistName').val(data.name); 
            $('#Day6EmbryologistStaffId').val(data.id); 
            break;

        }

        $('#SelectedModal').val("0");
      });

      $('#open-modal-staff').modal('toggle'); 

    });

    });

/* Lead Assessement */


  </script>

  <script >
    $(document).ready(function(){

    
    var rowIdx = {{$intctr}};                 
    
    /* Price List */

    $('#AddProcessedSperm').click(function(){
            $('#tbody').append(`<tr id="R${++rowIdx}">
                        <td class="row-index text-center">                
                          <input type="text" class="form-control" name="maturity[]">
                        </td>
                        <td class="text-center">
                          <input type="text" class="form-control" name="Day0remarks[]">
                        </td>
                        <td class="text-center">
                          <input type="text" class="form-control" name="icsi[]">
                        </td>

                        <td class="text-center">
                          <input type="text" class="form-control" name="PB[]">
                        </td>

                        <td class="text-center">
                          <input type="text" class="form-control" name="PN[]">
                        </td>

                        <td class="text-center">
                          <input type="text" class="form-control" name="Day1remarks[]">
                        </td>

                        <td class="text-center">
                          <input type="text" class="form-control" name="Day3remarks[]">
                        </td>
                        
                        <td class="text-center">
                          <input type="text" class="form-control" name="Day5remarks[]">
                        </td>

                        <td class="text-center">
                          <input type="text" class="form-control" name="Day6remarks[]">
                        </td>

                        <td class="text-center">
                          <input type="text" class="form-control" name="Dispositionremarks[]">
                        </td>

                        <td class="text-center">
                          <input type="button" class="btn btn-danger btn-sm remove-medicine-treatment float-right" value="Remove">

                        </td>
                      </tr> `);


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
  </script>

@endsection