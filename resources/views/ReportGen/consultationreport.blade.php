@extends('layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Consultation Report</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- <a href="{{route('SystemUserCreate')}}" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-show"><b>Search</b></a> -->
                <form>
                
                <hr>
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
                    <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                    </button>
                  </div>
                  </div>

                  <!-- /.input group -->
                </div>
                <hr>
                               
                </form>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-9">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Consultation Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <td>No</td>
                    <td>Date</td>
                    <td>Lead/Patient</td>
                    <td>Description</td>
                    <td>In Cycle</td>
                    <td>Note</td>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $intctr=0; $intTotalCycle=0;?>
                    @foreach($results as $result)

                  <tr>
                    <?php $intctr++; $intTotalCycle = $intTotalCycle + $result->incycle; ?>
                    <td>{{$intctr}}</td>
                    <td>{{$result->docdate}}</td>
                    <td>{{$result->MainContactPerson}}</td>
                    <td>{{$result->description}}</td>
                    <td>{{$result->incycle}}</td>
                    <td>
                      {{$result->notes}}
                    </td>
                  </tr>
                    @endforeach                        
                  </tbody>
                  <tfoot>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$intTotalCycle}} </td>
                    <td></td>
                  </tfoot>
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
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "searching": true,
      "ordering": true,
      "paging": false,
      "info": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


  });
</script>
@endsection