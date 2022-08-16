@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div> --><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php $intTotalLead=0; ?>
                @foreach($TotalLeads as $TotalLead)
                <h3>{{$TotalLead->TotalLead}}</h3>
                <?php $intTotalLead = $TotalLead->TotalLead; ?>
                @endforeach
                <p>Leads</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="{{route('LeadIndex')}}" class="small-box-footer">
                View <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                @foreach($TotalPatients as $TotalPatient)
                <h3>{{$TotalPatient->TotalPatient}}</h3>
                @endforeach

                <p>In-Patient</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="{{route('PatientIndex')}}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->


        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">

            <!-- Booking List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Booking Schedule
                </h3>

                <!-- <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                  </ul>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Patient</th>
                    <th>Staff</th>
                    <th>Status</th>
                    <th>Notes</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $intctr =0; ?>
                  @foreach($PatientBookings as $PatientBooking)
                  <?php $intctr++; ?>
                  <tr>
                    <td>{{$intctr}}</td>
                    <td>{{$PatientBooking->docdate}}</td>                    
                    <td>
                      {{$PatientBooking->bookedtime}}
                    </td> 
                    <td>{{$PatientBooking->MainContactPerson}}</td>
                    <td>{{$PatientBooking->name}}</td>                   
                    <td>{{$PatientBooking->description}}</td>                   
                    <td>{{$PatientBooking->notes}}</td>
                    <td>
                      
                      <a class="btn btn-primary btn-sm float-right" href="{{route('PatientBookingShow')}}/{{$PatientBooking->id}}">
                        <i class="fas fa-search"></i>
                              View
                      </a>

                    </td>
                  </tr> 
                  @endforeach
                  </tbody>
                </table>
                {!! $leadreminders->links('pagination') !!}
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer clearfix">
                <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
              </div> -->
            </div>
            <!-- /.card -->

            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Appointment/Reminder
                </h3>

                <!-- <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                  </ul>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Patient</th>
                    <th>Staff</th>
                    <th>Reason</th>
                    <th>Notes</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $intctr =0; ?>
                  @foreach($leadreminders as $leadreminder)
                  @if($leadreminder->is_read!=1)
                  <?php $intctr++; ?>
                  <tr>
                    <td>{{$intctr}}</td>
                    <td>{{$leadreminder->date_reminder}}</td>                    
                    <td>
                      {{$leadreminder->time_reminder}}
                    </td> 
                    <td>{{$leadreminder->MainContactPerson}}</td>
                    <td>{{$leadreminder->name}}</td>                   
                    <td>{{$leadreminder->description}}</td>                   
                    <td>{{$leadreminder->notes}}</td>
                    <td>
                      
                      <a class="btn btn-primary btn-sm float-right" href="{{route('LeadReminderView')}}/{{$leadreminder->id}}">
                        <i class="fas fa-search"></i>
                              View
                      </a>

                    </td>
                  </tr> 
                  @endif
                  @endforeach
                  </tbody>
                </table>
                {!! $leadreminders->links('pagination') !!}
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer clearfix">
                <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
              </div> -->
            </div>
            <!-- /.card -->

         

            <!-- solid sales graph -->
            <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  In Patient
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-transparent">
                <div class="row">

                  @foreach($LeadSourcesTotals as $LeadSourcesTotal)
                  <div class="col-4 text-center">
                    <?php 
                      $intPercentPerLeadSource = ($LeadSourcesTotal->TotalLeadSource / $intTotalLead) * 100;
                    ?>
                    <input type="text" class="knob" data-readonly="true" value="{{number_format($intPercentPerLeadSource,2)}}" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                  <div class="text-white">{{$LeadSourcesTotal->description}}</div>
                  </div>
                  @endforeach
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php $intTotalInPatientJan =0 ?>
  @foreach($InPatientJanMonthlyTotals as $TotalJanLead)
    <?php $intTotalInPatientJan =  $intTotalInPatientJan+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalInPatientFeb =0 ?>
  @foreach($InPatientFebMonthlyTotals as $TotalJanLead)
    <?php $intTotalInPatientFeb =  $intTotalInPatientFeb+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalInPatientMar =0 ?>
  @foreach($InPatientMarMonthlyTotals as $TotalJanLead)
    <?php $intTotalInPatientMar =  $intTotalInPatientMar+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalInPatientApr =0 ?>
  @foreach($InPatientAprMonthlyTotals as $TotalJanLead)
    <?php $intTotalInPatientApr =  $intTotalInPatientApr+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalInPatientMay =0 ?>
  @foreach($InPatientMayMonthlyTotals as $TotalJanLead)
    <?php $intTotalInPatientMay =  $intTotalInPatientMay+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalInPatientJun =0 ?>
  @foreach($InPatientJunMonthlyTotals as $TotalJanLead)
    <?php $intTotalInPatientJun =  $intTotalInPatientJun+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalInPatientJul =0 ?>
  @foreach($InPatientJulMonthlyTotals as $TotalJanLead)
    <?php $intTotalInPatientJul =  $intTotalInPatientJul+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalInPatientAug =0 ?>
  @foreach($InPatientAugMonthlyTotals as $TotalJanLead)
    <?php $intTotalInPatientAug =  $intTotalInPatientAug+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalInPatientSep =0 ?>
  @foreach($InPatientSepMonthlyTotals as $TotalJanLead)
    <?php $intTotalInPatientSep =  $intTotalInPatientSep+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalInPatientOct =0 ?>
  @foreach($InPatientOctMonthlyTotals as $TotalJanLead)
    <?php $intTotalInPatientOct =  $intTotalInPatientOct+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalInPatientNov =0 ?>
  @foreach($InPatientNovMonthlyTotals as $TotalJanLead)
    <?php $intTotalInPatientNov =  $intTotalInPatientNov+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalInPatientDec =0 ?>
  @foreach($InPatientDecMonthlyTotals as $TotalJanLead)
    <?php $intTotalInPatientDec =  $intTotalInPatientDec+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalLeadJan =0 ?>
  @foreach($LeadJanMonthlyTotals as $TotalJanLead)
    <?php $intTotalLeadJan =  $intTotalLeadJan+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalLeadFeb =0 ?>
  @foreach($LeadFebMonthlyTotals as $TotalJanLead)
    <?php $intTotalLeadFeb =  $intTotalLeadFeb+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalLeadMar =0 ?>
  @foreach($LeadMarMonthlyTotals as $TotalJanLead)
    <?php $intTotalLeadMar =  $intTotalLeadMar+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalLeadApr =0 ?>
  @foreach($LeadAprMonthlyTotals as $TotalJanLead)
    <?php $intTotalLeadApr =  $intTotalLeadApr+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalLeadMay =0 ?>
  @foreach($LeadMayMonthlyTotals as $TotalJanLead)
    <?php $intTotalLeadMay =  $intTotalLeadMay+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalLeadJun =0 ?>
  @foreach($LeadJunMonthlyTotals as $TotalJanLead)
    <?php $intTotalLeadJun =  $intTotalLeadJun+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalLeadJul =0 ?>
  @foreach($LeadJulMonthlyTotals as $TotalJanLead)
    <?php $intTotalLeadJul =  $intTotalLeadJul+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalLeadAug =0 ?>
  @foreach($LeadAugMonthlyTotals as $TotalJanLead)
    <?php $intTotalLeadAug =  $intTotalLeadAug+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalLeadSep =0 ?>
  @foreach($LeadSepMonthlyTotals as $TotalJanLead)
    <?php $intTotalLeadSep =  $intTotalLeadSep+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalLeadOct =0 ?>
  @foreach($LeadOctMonthlyTotals as $TotalJanLead)
    <?php $intTotalLeadOct =  $intTotalLeadOct+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalLeadNov =0 ?>
  @foreach($LeadNovMonthlyTotals as $TotalJanLead)
    <?php $intTotalLeadNov =  $intTotalLeadNov+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach

  <?php $intTotalLeadDec =0 ?>
  @foreach($LeadDecMonthlyTotals as $TotalJanLead)
    <?php $intTotalLeadDec =  $intTotalLeadDec+$TotalJanLead->TotalJanLeads;   ?>
  @endforeach
<script type="text/javascript">
/*

 **/

$(function () {

  'use strict'

  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  })
  $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move')

  // jQuery UI sortable for the todo list
  $('.todo-list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999
  })

  // bootstrap WYSIHTML5 - text editor
  $('.textarea').summernote()

  $('.daterange').daterangepicker({
    ranges   : {
      'Today'       : [moment(), moment()],
      'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month'  : [moment().startOf('month'), moment().endOf('month')],
      'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate  : moment()
  }, function (start, end) {
    window.alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
  })

  /* jQueryKnob */
  $('.knob').knob()

  // The Calender
  $('#calendar').datetimepicker({
    format: 'L',
    inline: true
  })

  // SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').overlayScrollbars({
    height: '250px'
  })

  
  // Sales graph chart
  var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d');
  //$('#revenue-chart').get(0).getContext('2d');

  var salesGraphChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December'],
    datasets: [
      {
        label               : 'In Patient',
        fill                : false,
        borderWidth         : 2,
        lineTension         : 0,
        spanGaps : true,
        borderColor         : '#ffc107',
        pointRadius         : 3,
        pointHoverRadius    : 7,
        pointColor          : '#ffc107',
        pointBackgroundColor: '#ffc107',
        data                : [<?php echo $intTotalInPatientJan; ?>, <?php echo $intTotalInPatientFeb; ?>, <?php echo $intTotalInPatientMar; ?>, <?php echo $intTotalInPatientApr; ?>, <?php echo $intTotalInPatientMay; ?>, <?php echo $intTotalInPatientJun; ?>, <?php echo $intTotalInPatientJul; ?>, <?php echo $intTotalInPatientAug; ?>, <?php echo $intTotalInPatientSep; ?>, <?php echo $intTotalInPatientOct; ?>, <?php echo $intTotalInPatientNov; ?>, <?php echo $intTotalInPatientDec; ?>]
      },
      {
        label               : 'Lead',
        fill                : false,
        borderWidth         : 2,
        lineTension         : 0,
        spanGaps : true,
        borderColor         : '#28a745',
        pointRadius         : 3,
        pointHoverRadius    : 7,
        pointColor          : '#28a745',
        pointBackgroundColor: '#28a745',
        data                : [<?php echo $intTotalLeadJan; ?>, <?php echo $intTotalLeadFeb; ?>, <?php echo $intTotalLeadMar; ?>, <?php echo $intTotalLeadApr; ?>, <?php echo $intTotalLeadMay; ?>, <?php echo $intTotalLeadJun; ?>, <?php echo $intTotalLeadJul; ?>, <?php echo $intTotalLeadAug; ?>, <?php echo $intTotalLeadSep; ?>, <?php echo $intTotalLeadOct; ?>, <?php echo $intTotalLeadNov; ?>, <?php echo $intTotalLeadDec; ?>]
      },
      {
        label               : 'Total',
        fill                : false,
        borderWidth         : 2,
        lineTension         : 0,
        spanGaps : true,
        borderColor         : '#ee4983',
        pointRadius         : 3,
        pointHoverRadius    : 7,
        pointColor          : '#ee4983',
        pointBackgroundColor: '#ee4983',
        data                : [<?php echo $intTotalLeadJan + $intTotalInPatientJan; ?>, <?php echo $intTotalLeadFeb+$intTotalInPatientFeb; ?>, <?php echo $intTotalLeadMar + $intTotalInPatientMar; ?>, <?php echo $intTotalLeadApr + $intTotalInPatientApr; ?>, <?php echo $intTotalLeadMay + $intTotalInPatientMay; ?>, <?php echo $intTotalLeadJun + $intTotalInPatientJun; ?>, <?php echo $intTotalLeadJul + $intTotalInPatientJul; ?>, <?php echo $intTotalLeadAug + $intTotalInPatientAug; ?>, <?php echo $intTotalLeadSep + $intTotalInPatientSep; ?>, <?php echo $intTotalLeadOct + $intTotalInPatientOct; ?>, <?php echo $intTotalLeadNov + $intTotalInPatientNov; ?>, <?php echo $intTotalLeadDec + $intTotalInPatientDec; ?>]
      }
    ]
  }

  var salesGraphChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: true,
    },
    scales: {
      xAxes: [{
        ticks : {
          fontColor: '#efefef',
        },
        gridLines : {
          display : false,
          color: '#efefef',
          drawBorder: false,
        }
      }],
      yAxes: [{
        ticks : {
          stepSize: 5000,
          fontColor: '#efefef',
        },
        gridLines : {
          display : true,
          color: '#efefef',
          drawBorder: false,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var salesGraphChart = new Chart(salesGraphChartCanvas, { 
      type: 'line', 
      data: salesGraphChartData, 
      options: salesGraphChartOptions
    }
  )

})

</script>
@endsection
