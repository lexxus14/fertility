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
      $intIsPatient=0;
      $intTotalRecDoc=0;
      $intTotalRecLab=0;
      $TotalRecDocNote=0;
      $intTotalRecHisAssessment=0;
      $intTotalPathXray=0;
      $intTotalEggCollected=0;
      $intTotalEggFertilized=0;
      $intTotalEggFertized=0;
      $intTotalGoodEmbryo=0;
      $intTotalFrozen=0;
    ?>
    
      @foreach($patients as $patient)

      <?php
        $strMainContactPerson = $patient->MainContactPerson;
        $strMainContactNo = $patient->MainContactNo;
        $strMainEmail = $patient->MainEmail;
        $intPatientId=$patient->id;
        $intIsPatient=$patient->IsPatient;
      ?>
      
    @include('patientmenu.patientmenu')
    
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

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="{{route('LeadEdit')}}/{{$intPatientId}}" rel="noopener" class="btn btn-info"><i class="fas fa-pencil-alt"></i> Edit</a>
                  <!-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
                  <a href="{{route('GenerateSummary')}}/{{$intPatientId}}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Generate Summary</a>
                  <a href="{{route('LeadPrint')}}/{{$intPatientId}}" rel="noopener" target="_blank" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </a>
                </div>

              </div>
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
                <h3 class="card-title"><b>Lead Assesment</b></h3>
                <button class="btn btn-success float-right open-modal-lead-assessment" value="{{$intPatientId}}" data-toggle="modal" data-target="#modal-lead-assessment" style="margin-right: 5px;">
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
                    <th>Assessment</th>
                    <th>Reason</th>
                    <th>Notes</th>
                    <th>Action</th>
                  </tr>                  
                  </thead>
                  <tbody>
                    <?php
                      $intctr = 0;
                    ?>
                  @foreach($leadassessments as $leadassessment)
                  <?php 
                    $intctr++;
                  ?>
                  <tr>
                    <td>{{$intctr}}</td>
                    <td>{{$leadassessment->date}}</td>
                    <td>
                      <input type="hidden" value="{{$leadassessment->assessmentrate}}">
                      <?php                        
                      for($int_a = 1;$int_a<=$leadassessment->assessmentrate;$int_a++){
                        ?>
                        <a >
                        <i class="fas fa-star" style="color:#FFD700;"> </i> </a>
                        <?php
                      }

                      ?>                        
                    </td>
                    <td>{{$leadassessment->description}}</td>
                    <td>{{$leadassessment->notes}}</td>
                    <td>
                      <a class="btn btn-primary btn-sm float-right" href="{{route('LeadAssView')}}/{{$leadassessment->id}}">
                        <i class="fas fa-folder"></i>
                              View
                      </a>

                      <a class="btn btn-info btn-sm float-right" href="{{route('LeadAssEdit')}}/{{$leadassessment->id}}">
                        <i class="fas fa-pencil-alt"></i> Edit
                      </a>                       

                        <button type="button" class="btn btn-danger btn-sm open-modal-delete-lead-assessment float-right" data-toggle="modal" data-target="#modal-delete-lead-assessment" value="{{$leadassessment->id}}"> <i class="fas fa-trash">
                              </i>Delete
                        </button>
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

          <!-- Reminder Table -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Reminders</b></h3>
                <button class="btn btn-success float-right open-modal-lead-reminder" value="{{$intPatientId}}" data-toggle="modal" data-target="#modal-lead-reminder" style="margin-right: 5px;">
                  <i class="fas fa-pencil-alt"></i> New
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Reason</th>
                    <th>Is Read</th>
                    <th>Notes</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $intctr =0; ?>
                  @foreach($leadreminders as $leadreminder)
                  <?php $intctr++; ?>
                  <tr>
                    <td>{{$intctr}}</td>
                    <td>{{$leadreminder->date_reminder}}</td>
                    <td>
                    	{{$leadreminder->time_reminder}}
                    </td>

                    <td>{{$leadreminder->description}}</td>
                    <td>
                      @if($leadreminder->is_read==1)
                      Yes
                      @else
                      Not yet
                      @endif
                    </td>
                    <td>{{$leadreminder->notes}}</td>
                    <td>
                      
                      <a class="btn btn-primary btn-sm float-right" href="{{route('LeadReminderView')}}/{{$leadreminder->id}}">
                        <i class="fas fa-folder"></i>
                              View
                      </a>

                      <a class="btn btn-info btn-sm float-right" href="{{route('LeadReminderEdit')}}/{{$leadreminder->id}}">
                        <i class="fas fa-pencil-alt"></i> Edit
                      </a>                       

                      <button type="button" class="btn btn-danger btn-sm open-modal-delete-lead-reminder float-right" data-toggle="modal" data-target="#modal-delete-lead-reminder" value="{{$leadreminder->id}}"> <i class="fas fa-trash">
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

          <!-- Price List Table -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Price List</b></h3>
                <a href ="{{route('PriceListCreate')}}/{{$intPatientId}}" class="btn btn-success float-right" style="margin-right: 5px;">
                  <i class="fas fa-pencil-alt"></i> New
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example3" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Notes</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $intctr = 0;
                    ?>
                    @foreach($pricelists as $pricelist)
                    <?php
                    $intctr++;
                    ?>
                  <tr>
                    <td>{{$intctr}}</td>
                    <td>{{$pricelist->pricelistdate}}</td>
                    <td>
                     {{$pricelist->total_amount}}
                    </td>

                    <td>{{$pricelist->notes}}</td>
                    <td>
                      <a class="btn btn-primary btn-sm float-right" href="{{route('PriceListView')}}/{{$pricelist->id}}">
                        <i class="fas fa-folder"></i>
                              View
                      </a>

                      <a class="btn btn-info btn-sm float-right" href="{{route('PriceListEdit')}}/{{$pricelist->id}}">
                        <i class="fas fa-pencil-alt"></i> Edit
                      </a>                       

                      <button type="button" class="btn btn-danger btn-sm open-modal-delete-price-list float-right" data-toggle="modal" data-target="#modal-delete-price-list" value="{{$pricelist->id}}"> <i class="fas fa-trash">
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
  <!-- /.content-wrapper -->

    <!-- Modal Lead Assessment -->
      <div class="modal fade" id="modal-lead-reminder">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Lead Reminder</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form id="quickForm-lead-reminder" action="{{route('LeadReminderStore')}}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
              <input type="hidden" name="txtTransactionSource" value="LeadSource">
            <div class="modal-body">
              <div class="row">
                <div class="col-4">
                    <div class="form-group">
                      <label>Date</label>
                      <div class="input-group date" id="lead-date-reminder" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" name="txtLeadDateReminder" data-target="#lead-date-reminder"/>
                          <div class="input-group-append" data-target="#lead-date-reminder" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Time</label>
                      <div class="input-group date" id="lead-time-reminder" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" name="txtLeadTimeReminder" data-target="#lead-time-reminder"/>
                          <div class="input-group-append" data-target="#lead-time-reminder" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-clock"></i></div>
                          </div>
                      </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                      <label>Staff</label>
                      <select class="form-control select2" name="cmbStaffReminder" style="width: 100%;">
                         @foreach($staffs as $staff)
                            <option value="{{$staff->id}}">{{$staff->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Reason</label>
                        <select class="form-control select2" name="cmbReasonReminder" style="width: 100%;">
                           @foreach($reasons as $reason)
                              <option value="{{$reason->id}}">{{$reason->description}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <div class="form-group">
                        <label>Note</label>
                        <textarea id="inputNoteLead-Edit" name="txtnotereminder" class="form-control" rows="4"></textarea>
                      </div>                      
                    </div>
                </div>
              </div>        
            </div>
            
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
              <input type="hidden" id="patient_id" name="patient_id" value="0">
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

  <!-- Modal Lead Assessment -->
      <div class="modal fade" id="modal-lead-assessment">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Lead Assessment</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form id="quickForm-lead-assessment" action="{{route('LeadAssStore')}}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
            <div class="modal-body">
              <div class="row">
                <div class="col-4">
                    <div class="form-group">
                      <label>Date</label>
                      <div class="input-group date" id="lead-date" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" name="txtLeadDate" data-target="#lead-date"/>
                          <div class="input-group-append" data-target="#lead-date" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                      <label>Staff</label>
                      <select class="form-control select2" name="cmbStaff" style="width: 100%;">
                         @foreach($staffs as $staff)
                            <option value="{{$staff->id}}">{{$staff->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Reason</label>
                        <select class="form-control select2" name="cmbReason" style="width: 100%;">
                           @foreach($reasons as $reason)
                              <option value="{{$reason->id}}">{{$reason->description}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <div class="form-group">
                        <label>Note</label>
                        <textarea id="inputNoteLead-Edit" name="txtnoteassessment" class="form-control" rows="4"></textarea>
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
                    </div>
                </div>
              </div>   
              <div class="row">
                <div class="card">
                    <div class="card-body text-center"> 
                      <input type="hidden" id="myratings" value="0" name="txtRating"> 
                      <span class="myratings">0</span>
                        <h4 class="mt-1">Assessment Rate</h4>
                        <fieldset class="rating"> 
                          <input type="radio" id="star5" name="rating" value="5" />
                          <label class="full  fas" for="star5" title="Awesome - 5 stars"></label> 

                          <!-- <input type="radio" id="star4half" name="rating" value="4.5" />
                          <label class="half fas" for="star4half" title="Pretty good - 4.5 stars"></label>  -->

                          <input type="radio"  id="star4" name="rating" value="4" />
                          <label class="full fas" for="star4" title="Pretty good - 4 stars"></label> 

                       <!--    <input type="radio" id="star3half" name="rating" value="3.5" />
                          <label class="half fas" for="star3half" title="Meh - 3.5 stars"></label>  -->

                          <input type="radio" id="star3" name="rating" value="3" />
                          <label class="full fas" for="star3" title="Meh - 3 stars"></label> 

                         <!--  <input type="radio" id="star2half" name="rating" value="2.5" />
                          <label class="half fas" for="star2half" title="Kinda bad - 2.5 stars"></label>  -->

                          <input type="radio" id="star2" name="rating" value="2" />
                          <label class="full fas" for="star2" title="Kinda bad - 2 stars"></label> 

                         <!--  <input type="radio" id="star1half" name="rating" value="1.5" />
                          <label class="half fas" for="star1half" title="Meh - 1.5 stars"></label>  -->

                          <input type="radio" id="star1" name="rating" value="1" />
                          <label class="full fas" for="star1" title="Sucks big time - 1 star"></label> 

                       <!--    <input type="radio" id="starhalf" name="rating" value="0.5" />
                          <label class="half fas" for="starhalf" title="Sucks big time - 0.5 stars"></label>  -->

                          <input type="radio" class="reset-option" name="rating" value="reset" /> 
                        </fieldset>
                    </div>
                </div>

              </div>

            </div>
            
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
              <input type="hidden" id="patient_id" name="patient_id" value="0">
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="modal-delete-lead-assessment">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you to delete this lead assessment?</p>
            </div>
            <form method="POST" action="{{route('LeadAssDelete')}}">
              {{ csrf_field() }}
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete</button>
              </div>
              <input type="hidden" id="del_id-lead-assessment" name="del_id" value="0">
              <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="modal-delete-lead-reminder">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you to delete this lead reminder?</p>
            </div>
            <form method="POST" action="{{route('LeadReminderDelete')}}">
              {{ csrf_field() }}
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete</button>
              </div>
              <input type="hidden" id="del_id-lead-reminder" name="del_id" value="0">
              <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="modal-delete-price-list">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you to delete this price list?</p>
            </div>
            <form method="POST" action="{{route('PriceListDelete')}}">
              {{ csrf_field() }}
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete</button>
              </div>
              <input type="hidden" id="del_id-price-list" name="del_id" value="0">
              <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
              <input type="hidden" name="txtTransactionSource" value="LeadSource">
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


 <script type="text/javascript">
    $(function () { 
       //Date picker
    $('#lead-date').datetimepicker({
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

    /*Price List*/
    $('.open-modal-delete-price-list').click(function(data){
      var id = $(this).val();
      $('#del_id-price-list').val(id);
    });

    /* Lead Reminder */
    $('#lead-date-reminder').datetimepicker({
        format: 'L'
    });

    $('#lead-time-reminder').datetimepicker({
        format: 'hh:mm A'
    });

    $('.open-modal-lead-reminder').click(function(data){
      var id = $(this).val();
      $('#patient_id').val(id);
    });

    $('.open-modal-delete-lead-reminder').click(function(data){
      var id = $(this).val();
      $('#del_id-lead-reminder').val(id);
    });

    $('#quickForm-lead-reminder').validate({
    rules: {
      txtLeadTimeReminder: {
        required: true
      },
      txtLeadDateReminder: {
        required: true
      },
    },
    messages: {
      txtLeadTimeReminder: {
        required: "Please enter the time"
      },
      txtLeadDateReminder: {
        required: "Please provide the date."
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

    /* Lead Assessement */
    $('.open-modal-lead-assessment').click(function(data){
      var id = $(this).val();
      $('#patient_id').val(id);
    });

    $('.open-modal-delete-lead-assessment').click(function(data){
      var id = $(this).val();
      $('#del_id-lead-assessment').val(id);
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

/* end Lead Assessement */

    

  </script>

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endsection