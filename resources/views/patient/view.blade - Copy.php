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
    @if($PatientId==1 )
        <section class="content"> 
    	<div class="container-fluid">
    		<div class="row">
    		<div class="col-12">
    			<div class="callout callout-info">
	              <h5><i class="fas fa-info"></i> In Patient:</h5>
	            	<div class="row">
			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-info">
			              <div class="inner">
			                <h3>3</h3>

			                <p>Patient Medication</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-user"></i>
			              </div>
			              <a href="{{route('PatientMedication')}}/1" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>
			          <!-- ./col -->
			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-success">
			              <div class="inner">
			                <h3>1</h3>

			                <p>Patient Treatment</p>
			              </div>
			              <div class="icon">
			                <i class="ion ion-stats-bars"></i>
			              </div>
			              <a href="{{route('PatientTreatment')}}/1" class="small-box-footer">
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

			                <p>Eggs Collected</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-user-plus"></i>
			              </div>
			              <a href="{{route('PatientEggCollected')}}/1" class="small-box-footer">
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

			                <p>Eggs Fertilized</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-chart-pie"></i>
			              </div>
			              <a href="{{route('PatientEggFertilized')}}/1" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>
			          <!-- ./col -->

			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-info">
			              <div class="inner">
			                <h3>1</h3>

			                <p>Good Embryo</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-user"></i>
			              </div>
			              <a href="{{route('PatientGoodEmbryo')}}/1" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>
			          <!-- ./col -->

			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-success">
			              <div class="inner">
			                <h3>1</h3>

			                <p>Transferred Embryo</p>
			              </div>
			              <div class="icon">
			                <i class="ion ion-stats-bars"></i>
			              </div>
			              <a href="{{route('PatientTransferredEmbryo')}}/1" class="small-box-footer">
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

			                <p>Frozen Embryo</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-user-plus"></i>
			              </div>
			              <a href="{{route('PatientFrozenEmbryo')}}/1" class="small-box-footer">
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

			                <p>Biopsy Study</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-chart-pie"></i>
			              </div>
			              <a href="{{route('PatientBiopsyStudy')}}/1" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>

			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-danger">
			              <div class="inner">
			                <h3>1</h3>

			                <p>Biopsy Result</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-chart-pie"></i>
			              </div>
			              <a href="{{route('PatientBiopsyResult')}}/1" class="small-box-footer">
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
    @endif
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
			            <div class="small-box bg-warning">
			              <div class="inner">
			                <h3>1</h3>

			                <p>Lead Assessment</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-user-plus"></i>
			              </div>
			              <a href="{{route('LeadAssessmentIndex')}}/1" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>
			          <div class="col-lg-3 col-6">
			            <!-- small card -->
			            <div class="small-box bg-info">
			              <div class="inner">
			                <h3>3</h3>

			                <p>Consultation</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-user"></i>
			              </div>
			              <a href="{{route('PatientConsultation')}}/1" class="small-box-footer">
			                View <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
			          </div>
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
    		</div>
    		</div>
    	</div>
    </section>
  </div>
  <!-- /.content-wrapper -->
@endsection