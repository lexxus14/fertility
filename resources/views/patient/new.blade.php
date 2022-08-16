@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Patient</h1>
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
                <h3 class="card-title">Patient Form</h3>
              </div>
              <form action="{{route('PatientStore')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="card-body p-0">
                <div class="bs-stepper">
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Wife</span>
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
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Birth Date</label>
                            <div class="input-group date" id="birthdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#birthdate"/>
                                <div class="input-group-append" data-target="#birthdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Married Since</label>
                            <div class="input-group date" id="marrieddate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#marrieddate"/>
                                <div class="input-group-append" data-target="#marrieddate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Contact No</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Nationality</label>
                            <select class="form-control select2" style="width: 100%;">
                              <option selected="selected">UAE</option>
                              <option>Egypt</option>
                              <option>Jordan</option>
                              <option>Lebanon</option>
                              <option>Oman</option>
                              <option>Qatar</option>
                              <option>Saudi Arabia</option>
                              <option>Syria</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <div class="icheck-primary d-inline">
                              <input type="checkbox" id="checkboxPrimary1" >
                              <label for="checkboxPrimary1">IVF Before
                              </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="icheck-primary d-inline">
                              <input type="checkbox" id="checkboxPrimary2" >
                              <label for="checkboxPrimary2">Has Children
                              </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="icheck-primary d-inline">
                              <input type="checkbox" id="checkboxPrimary3">
                              <label for="checkboxPrimary3">Miscarriage
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                  </div>

                  <!-- Husband -->
                  <div class="bs-stepper-header" role="tablist">
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Husband</span>
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
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Birth Date</label>
                            <div class="input-group date" id="husbandbirthdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#husbandbirthdate"/>
                                <div class="input-group-append" data-target="#husbandbirthdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Nationality</label>
                            <select class="form-control select2" style="width: 100%;">
                              <option selected="selected">UAE</option>
                              <option>Egypt</option>
                              <option>Jordan</option>
                              <option>Lebanon</option>
                              <option>Oman</option>
                              <option>Qatar</option>
                              <option>Saudi Arabia</option>
                              <option>Syria</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Contact No</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            
                          </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="customFile">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                          </div>
                          <div class="form-group">
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