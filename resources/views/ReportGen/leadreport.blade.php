@extends('layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lead Assesstment Report</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- <a href="{{route('SystemUserCreate')}}" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-show"><b>Search</b></a> -->
                <form  id="formSubmit">
                  <div class="row">
                  
                  <div class="col-3"> 
                  <div class="form-group">
                    <label>Reason</label>
                  <br>
                    @foreach($reasons as $reason)
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="chkReason[]" value="{{$reason->id}}">
                      <label class="form-check-label">{{$reason->description}}</label>
                    </div>
                    @endforeach
                  </div>  
                  </div>               
                  
                    <div class="col-2">
                      <div class="form-group">
                        <div class="input-group">
                          <label>Rate Range:</label>
                          <div class="input-group">
                            <input type="number" max="5" min="1" name="RateFrom" id="RateFrom" value="1" class="form-control" placeholder="From">
                            <input type="number" max="5" min="1" name="RateTo" id="RateTo" value = "5" class="form-control" placeholder="To">
                          </div>
                        </div>
                      </div>
                    </div>  
                  
                  <div class="col-4">
                  <div class="form-group">
                    <label>Date range:</label>
                    <input type="hidden" name="DateFrom" id="DateFrom" value="0">
                    <input type="hidden" name="DateTo" id="DateTo" value="0">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control float-right" id="reservation">
                      <div class="input-group-append">
                      <button type="submit" class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                      </button>
                    </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                  </div>
                
                  </div>
                </form>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div class="row">          
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lead Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="LeadReportResult">
              
              <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
              <td>No</td>
              <td style="width: 8%">Date</td>
              <td>Nurse</td>
              <td>Main Contact</td>
              <td>Reason</td>
              <td style="width: 10%">Rate</td>
              <td>Note</td>
              </tr>
              </thead>
              <tbody>
                <?php $intctr =1 ?>
              @foreach($results as $result)
              <tr>
                <td><a href="{{route('LeadView')}}/{{$result->patientid}}">{{$intctr++}}</a></td>
                <td>{{$result->date}}</td>
                <td>{{$result->StaffName}}</td>
                <td><a href="{{route('LeadView')}}/{{$result->patientid}}">{{$result->MainContactPerson}}</a></td>
                <td>{{$result->Reason}}</td>
                <td>{{$result->assessmentrate}}</td>
                <td>{{$result->notes}}</td>
              </tr>
              @endforeach
              <tbody>
              </tbody>
              </table>
              
                 
                  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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

<!---jQuery ajax Insert multiple checkbox value --->
<script type="text/javascript">
  $(document).ready(function(){
      $("#formSubmit").on("submit",function(e){
          e.preventDefault();
          var $this        = $(this); //submit button selector using ID
          var $caption        = $this.html();// We store the html content of the submit button
          var form      = "#formSubmit"; //defined the #form ID
          var formData        = $(form).serializeArray(); //serialize the form into array
          var route       = $(form).attr('action');

          
          
            $.ajax({
              url : "{{ route('LeadAction') }}",
              type: "GET",
              cache: false,
              data : formData,
              success:function(data){
              var report = "";
              report = '<table id="example1" class="table table-bordered table-striped">';
              report = report + '<thead>';
              report = report + '<tr>';
              report = report + '<td>No</td>';
              report = report + '<td style="width: 8%">Date</td>';
              report = report + '<td>Nurse</td>';
              report = report + '<td>Main Contact</td>';
              report = report + '<td>Reason</td>';
              report = report + '<td style="width: 10%">Rate</td>';
              report = report + '<td>Note</td>';
              report = report + '</tr>';
              report = report + '</thead>';
              report = report + '<tbody>';

              for (i = 0, len = data.length; i < len; i++) {
                  console.log(data[i]);
                  report = report + "<tr><td>"+data[i].id+"</td><td>"+data[i].date+"</td><td>"+data[i].StaffName+"</td><td>"+"<a href='{{route('LeadView')}}/"+data[i].patientid+"'>"+data[i].MainContactPerson+"</a></td><td>"+data[i].Reason+"</td><td>"+data[i].assessmentrate+"</td><td>"+data[i].notes+"</td></tr>";
              }
              report = report + '<tbody>';
              report = report + '</tbody>';
              report = report + '</table>';
              
              $('#LeadReportResult').empty();
              $('#LeadReportResult').append(report);
                
              }
            });    
          
      });
  });
</script>

<script >
    $(document).ready(function(){



      $('#RateFrom').keyup(function() {        
        if($(this).val()> $('#RateTo').val()){
          alert('Should be lower than ' + $('#RateTo').val());
        }
      });

      $('#RateTo').keyup(function() {
        if($(this).val() < $('#RateFrom').val()){
          alert('Should be higher than ' + $('#RateFrom').val());
        }
      });

      $( "#reservation" ).change(function() {
          const str = $(this).val();
          const result = str.split('-');

          var formattedDate = new Date(result[0]);
          var formattedDate1 = new Date(result[1]);
          var d = formattedDate.getDate();
          var m =  formattedDate.getMonth();
          m += 1;  // JavaScript months are 0-11
          var y = formattedDate.getFullYear();

          $('#DateFrom').val(y + "-" + m + "-" + d);

          d = formattedDate1.getDate();
          m =  formattedDate1.getMonth();
          m += 1;  // JavaScript months are 0-11
          y = formattedDate1.getFullYear();


          $('#DateTo').val(y + "-" + m + "-" + d);
      });
    });
</script>

  <script>
  $(function () {
    //Date range picker
    $('#reservation').daterangepicker({

        format: 'L'
      
    })

    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
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
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": ["excel", "pdf", "print"],
      "searching": false,
      "ordering": true,
      "paging": false,
      "info": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


  });
</script>
@endsection