@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Price List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Advanced Form</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Price List Form</h3>
              </div>
              <form action="{{route('PriceListStore')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="card-body p-0">
                <div class="bs-stepper">
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Patient</span>
                      </button>
                    </div>
                    <div class="line"></div>
                    
                  </div>
                  <div class="bs-stepper-content">
                    
                    <!-- your steps content here -->                      
                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Name:</label>
                            Wife A A A
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Address:</label>
                            Dubai
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Email Address:</label>
                            wifeaaa@nowhere.com
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Contact No:</label>
                            000123456
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Nationality:</label>
                            UAE
                          </div>
                        </div>
                      </div>
                    
                  </div>

                  <!-- Husband -->
                  <div class="bs-stepper-header" role="tablist">
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Treatment</span>
                      </button>
                    </div>
                    <div class="line"></div>
                  </div>

                  <div class="bs-stepper-content">

                    <!-- your steps content here -->                      
                      <div class="row">
                                  <div class="col-12">
                                    <div class="card">
                                      <div class="card-header">
                                        <h3 class="card-title">List of Treatment</h3>

                                        <div class="card-tools">
                                          <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                            <div class="input-group-append">
                                              <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                          <thead>
                                            <tr>
                                              <th>ID</th>
                                              <th>Treatment</th>
                                              <th>Qty</th>
                                              <th>Price</th>
                                              <th>Total</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>183</td>
                                              <td>Treatment 1</td>
                                              <td>4</td>
                                              <td><span class="tag tag-success">100</span></td>
                                              <td>400</td>
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
                                        <h3 class="card-title">List of Medicine</h3>

                                        <div class="card-tools">
                                          <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                            <div class="input-group-append">
                                              <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                          <thead>
                                            <tr>
                                              <th>ID</th>
                                              <th>Medicine</th>
                                              <th>Qty</th>
                                              <th>Price</th>
                                              <th>Total</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>183</td>
                                              <td>Medicine 1</td>
                                              <td>4</td>
                                              <td><span class="tag tag-success">100</span></td>
                                              <td>400</td>
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
                                        <h3 class="card-title">Total</h3><br>
                                        
                                        <div class="col-sm-4">
                                          <!-- text input -->
                                          <div class="form-group">
                                            <label>Total Amount to be paid:</label>
                                            AED: 800.00
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                      </div>                 
                    
                  </div>

              
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save" class="btn btn-success float-right">
                  </div>
                </div> 
              </div>
            </div>
            <!-- /.card -->
          </form>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 <script type="text/javascript">
    $(function () { 
       //Date picker
    $('#birthdate').datetimepicker({
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
@endsection