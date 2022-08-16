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
                <div class="col-sm-4 invoice-col">
                  Wife
                  <address>
                    <strong>Wife A A A</strong><br>
                    Birth Date:12/01/1988<br>
                    Married Since:12/2009<br>
                    Contact No: (804) 123-5432<br>
                    Nationality: UAE<br>
                    Address: Dubai<br>
                    Email: wifeaaa@nowhere.com<br>
                    <div class="form-group">
                      <input type="checkbox" id="checkboxPrimary1" checked>
                      <label for="checkboxPrimary1">IVF Before
                      </label>
                      <input type="checkbox" id="checkboxPrimary2" >
                      <label for="checkboxPrimary2">Has Children
                      </label>
                      <input type="checkbox" id="checkboxPrimary3" checked>
                      <label for="checkboxPrimary3">Miscarriage
                      </label>
                  </div>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Husband
                  <address>
                  	<strong>Husband A A A</strong><br>
                    Birth Date:12/01/1988<br>
                    Contact No: (804) 123-5432<br>
                    Nationality: UAE<br>
                    Address: Dubai<br>
                    Email: wifeaaa@nowhere.com<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Profile #007612</b><br>
                  <br>
                  <b>NOTE:</b> 4F3S8J<br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <a href="{{route('GenerateSummary')}}/1" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Generate Summary</a>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
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
    			<div class="callout callout-info">
	              <h5><i class="fas fa-info"></i> Task:</h5>
	            	<div class="row">
            		<div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-info">
			              <div class="inner">
			                <h3>3</h3>

			                <p>Documents</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-user"></i>
			              </div>
			              <a href="{{route('PatientDocument')}}/1" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>
			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-info">
			              <div class="inner">
			                <h3>3</h3>

			                <p>Lab Investigation</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-user"></i>
			              </div>
			              <a href="{{route('PatientLab')}}/1" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>
			          <!-- ./col -->
			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-success">
			              <div class="inner">
			                <h3>3</h3>

			                <p>Doctor's Notes</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-file"></i>
			              </div>
			              <a href="{{route('PatientDoctorNotes')}}/1" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>
			          <!-- ./col -->
			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-warning">
			              <div class="inner">
			                <h3>1</h3>

			                <p>History Assessment</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-user-plus"></i>
			              </div>
			              <a href="{{route('PatientHistory')}}/1" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>
			          <!-- ./col -->
			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-danger">
			              <div class="inner">
			                <h3>1</h3>

			                <p>Pathology / X-Ray</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-chart-pie"></i>
			              </div>
			              <a href="{{route('PatientPathologyXray')}}/1" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>
			          <!-- ./col -->

			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-warning">
			              <div class="inner">
			                <h3>1</h3>

			                <p>Booking</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-arrow-circle-right"></i>
			              </div>
			              <a href="#" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>
			          <!-- ./col -->

			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-warning">
			              <div class="inner">
			                <h3>1</h3>

			                <p>Review</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-user-plus"></i>
			              </div>
			              <a href="#" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>

			          <!-- ./col -->
			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-success">
			              <div class="inner">
			                <h3>3</h3>

			                <p>Result</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-file"></i>
			              </div>
			              <a href="{{route('PatientFertilityResult')}}/1" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>
			          <!-- ./col -->
			        </div>
	            </div>
    		</div>
    		</div>
    	</div>
    </section>
		<section class="content"> 
    	<div class="container-fluid">
    		<div class="row">
    		<div class="col-12">
    			<div class="callout callout-info">
	              <h5><i class="fas fa-info"></i> Lead:</h5>
	            	<div class="row">
			          <!-- ./col -->
			          
			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-success">
			              <div class="inner">
			                <h3>1</h3>

			                <p>Price List</p>
			              </div>
			              <div class="icon">
			                <i class="ion ion-stats-bars"></i>
			              </div>
			              <a href="{{route('PatientPriceList')}}/1" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>
			          <!-- ./col -->
			          
			        </div>
	            </div>
          <!-- Lead Assessment Table -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lead Assesment Table</h3>
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
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>1</td>
                    <td>1/25/2022</td>
                    <td>
                    	<div class="progress mb-3">
			                  <div class="progress-bar bg-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
			                    <span class="sr-only">40% Complete (success)</span>
			                  </div>
			                </div>

                    </td>

                    <td>Financial</td>
                    <td></td>
                  </tr> 
                  <tr>
                    <td>2</td>
                    <td>2/27/2022</td>
                    <td>
                    	<div class="progress mb-3">
			                  <div class="progress-bar bg-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
			                    <span class="sr-only">70% Complete (success)</span>
			                  </div>
			                </div>

                    </td>

                    <td>Financial</td>
                    <td>Ready on the month of April</td>
                  </tr>            
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Assessment</th>
                    <th>Reason</th>
                    <th>Notes</th>
                  </tr>
                  </tfoot>
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
                <h3 class="card-title">Lead Reminder Table</h3>
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
                    <th>Notes</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>1</td>
                    <td>1/27/2022</td>
                    <td>
                    	9:30 AM
                    </td>

                    <td>Financial</td>
                    <td>Contact Lead Patient Husband 4 for Laboratory</td>
                  </tr> 
                  <tr>
                    <td>2</td>
                    <td>2/27/2022</td>
                    <td>
                    	2:00  PM
                    </td>

                    <td>Follow up</td>
                    <td>Ready on the month of April</td>
                  </tr>            
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Assessment</th>
                    <th>Reason</th>
                    <th>Notes</th>
                  </tr>
                  </tfoot>
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
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#example2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    $('#example3').DataTable({
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
@endsection